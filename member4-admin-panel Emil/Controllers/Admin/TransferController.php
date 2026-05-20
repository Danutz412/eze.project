<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EzepostTracking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransferController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'recipient_email' => 'required|email|exists:users,email',
            'file' => 'required|file|max:102400', // 100MB
            'message' => 'nullable|string|max:1000',
        ]);

        $recipient = User::where('email', $validated['recipient_email'])->first();
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('transfers', 'public');

        $tracking = EzepostTracking::create([
            'sender_user_id' => auth()->id(),
            'receiver_user_id' => $recipient->id,
            'file_name' => $fileName,
            'file_path' => $filePath,
            'file_size' => $file->getSize(),
            'message' => $validated['message'] ?? null,
            'controlstring' => Str::random(20),
            'is_viewed' => false,
            'status' => 'sent',
        ]);

        return redirect()->route('admin.transfers.index')
            ->with('success', 'File sent successfully!');
    }

    public function download(EzepostTracking $transfer)
    {
        if (!file_exists(storage_path('app/public/' . $transfer->file_path))) {
            abort(404, 'File not found.');
        }

        $transfer->update(['is_viewed' => true]);

        return response()->download(storage_path('app/public/' . $transfer->file_path), $transfer->file_name);
    }

    public function receive(Request $request)
    {
        $validated = $request->validate([
            'tracking_id' => 'required|string',
        ]);

        $transfer = EzepostTracking::where('controlstring', $validated['tracking_id'])
            ->where('receiver_user_id', auth()->id())
            ->firstOrFail();

        $transfer->update(['is_viewed' => true, 'status' => 'received']);

        return redirect()->route('admin.transfers.index')
            ->with('success', 'Transfer received successfully!');
    }
}
