<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\EzepostTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TransferController extends Controller
{
    protected function getUserId()
    {
        return auth()->user()->ezepostUser?->id;
    }

    public function sent(Request $request)
    {
        $userId = $this->getUserId();
        
        $transfers = EzepostTracking::with(['receiverUser', 'senderUser'])
            ->where('sender_ezepost_user_id', $userId)
            ->when($request->search, fn($q, $search) =>
                $q->where('file_name', 'like', "%{$search}%")
            )
            ->latest('created_at')
            ->paginate(20);

        return view('customer.transfers.sent', compact('transfers'));
    }

    public function received(Request $request)
    {
        $userId = $this->getUserId();
        
        $transfers = EzepostTracking::with(['receiverUser', 'senderUser'])
            ->where('receiver_ezepost_user_id', $userId)
            ->when($request->search, fn($q, $search) =>
                $q->where('file_name', 'like', "%{$search}%")
            )
            ->when($request->status == 'unread', fn($q) =>
                $q->where('is_viewed', false)
            )
            ->when($request->status == 'read', fn($q) =>
                $q->where('is_viewed', true)
            )
            ->latest('created_at')
            ->paginate(20);

        return view('customer.transfers.received', compact('transfers'));
    }

    public function viewed(Request $request)
    {
        $userId = auth()->id();
        
        $transfers = EzepostTracking::with(['receiverUser', 'senderUser'])
            ->where(function ($q) use ($userId) {
                $q->where('sender_user_id', $userId)
                  ->orWhere('receiver_user_id', $userId);
            })
            ->where('is_viewed', true)
            ->whereNotNull('viewed_at')
            ->when($request->search, fn($q, $search) =>
                $q->where('file_name', 'like', "%{$search}%")
            )
            ->latest('viewed_at')
            ->paginate(20);

        return view('customer.transfers.viewed', compact('transfers'));
    }

    public function sentToday()
    {
        $userId = $this->getUserId();
        
        $transfers = EzepostTracking::with(['receiverUser', 'senderUser'])
            ->where('sender_ezepost_user_id', $userId)
            ->whereDate('created_at', Carbon::today())
            ->latest('created_at')
            ->paginate(20);

        return view('customer.transfers.sent-today', compact('transfers'));
    }

    public function receivedToday()
    {
        $userId = $this->getUserId();
        
        $transfers = EzepostTracking::with(['receiverUser', 'senderUser'])
            ->where('receiver_ezepost_user_id', $userId)
            ->whereDate('created_at', Carbon::today())
            ->latest('created_at')
            ->paginate(20);

        return view('customer.transfers.received-today', compact('transfers'));
    }

    public function viewedToday()
    {
        $userId = auth()->id();
        
        $transfers = EzepostTracking::with(['receiverUser', 'senderUser'])
            ->where(function ($q) use ($userId) {
                $q->where('sender_user_id', $userId)
                  ->orWhere('receiver_user_id', $userId);
            })
            ->where('is_viewed', true)
            ->whereDate('viewed_at', Carbon::today())
            ->latest('viewed_at')
            ->paginate(20);

        return view('customer.transfers.viewed-today', compact('transfers'));
    }

    public function download($id)
    {
        $transfer = EzepostTracking::findOrFail($id);
        
        // Check if user has access to this file
        // Allow if user is admin, sender, or receiver
        $hasAccess = auth()->user()->is_admin ?? false;
        $hasAccess = $hasAccess || $transfer->sender_user_id == auth()->id();
        $hasAccess = $hasAccess || $transfer->receiver_user_id == auth()->id();
        
        if (!$hasAccess) {
            abort(403, 'Unauthorized access to this file.');
        }

        // Mark as viewed when user downloads (both sender and receiver)
        $transfer->update([
            'is_viewed' => true,
            'viewed_at' => now(),
        ]);

        // Check if file exists in storage
        if (!$transfer->file_path || !Storage::disk('public')->exists($transfer->file_path)) {
            // If file doesn't exist, return a dummy file for demo purposes
            return response()->streamDownload(function() use ($transfer) {
                echo "Demo file content for: " . $transfer->file_name;
            }, $transfer->file_name);
        }

        // Download the actual file
        return Storage::disk('public')->download($transfer->file_path, $transfer->file_name);
    }

    public function destroy(EzepostTracking $transfer)
    {
        $userId = $this->getUserId();
        
        // Only sender can delete
        if ($transfer->sender_ezepost_user_id != $userId) {
            abort(403, 'You can only delete files you sent.');
        }

        $transfer->delete();

        return back()->with('success', 'Transfer deleted successfully.');
    }

    public function generatePdf(EzepostTracking $transfer)
    {
        // Check if user has access to this transfer (sender or receiver)
        if ($transfer->sender_user_id != auth()->id() && $transfer->receiver_user_id != auth()->id()) {
            abort(403, 'Unauthorized access to this transfer.');
        }

        // Load transfer with relationships
        $transfer->load(['senderUser', 'receiverUser']);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.transfer-receipt', compact('transfer'));
        return $pdf->download('ezepost-receipt-' . $transfer->transfer_reference . '.pdf');
    }

    public function create()
    {
        return view('customer.transfers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_email' => 'required|email',
            'file' => 'required|file|max:102400', // 100MB
            'message' => 'nullable|string|max:1000',
            'notify_recipient' => 'nullable|boolean',
            'require_password' => 'nullable|boolean',
            'track_download' => 'nullable|boolean',
            'expiration' => 'nullable|integer',
        ]);

        // Get recipient user (may be null if not registered)
        $recipientUser = \App\Models\User::where('email', $validated['recipient_email'])->first();

        // Handle file upload
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('transfers', 'public');

        // Calculate expiration
        $expiresAt = null;
        $expirationHours = (int)($validated['expiration'] ?? 168);
        if ($expirationHours > 0) {
            $expiresAt = now()->addHours($expirationHours);
        }

        // Create transfer using User relationships
        $transfer = EzepostTracking::create([
            'sender_user_id' => auth()->id(),
            'receiver_user_id' => $recipientUser ? $recipientUser->id : null,
            'transfer_reference' => 'UID-' . uniqid(),
            'file_name' => $fileName,
            'file_path' => $filePath,
            'file_size' => $file->getSize(),
            'message' => $validated['message'] ?? null,
            'controlstring' => \Illuminate\Support\Str::random(20),
            'is_viewed' => false,
            'notify_recipient' => $validated['notify_recipient'] ?? true,
            'require_password' => $validated['require_password'] ?? false,
            'track_download' => $validated['track_download'] ?? true,
            'expires_at' => $expiresAt,
        ]);

        // Send email notification if requested
        if ($validated['notify_recipient'] ?? true) {
            \Illuminate\Support\Facades\Mail::to($validated['recipient_email'])
                ->send(new \App\Mail\FileTransferNotification($transfer));
        }

        return redirect()->route('customer.transfers.sent')
            ->with('success', 'File sent successfully to ' . $validated['recipient_email']);
    }
}
