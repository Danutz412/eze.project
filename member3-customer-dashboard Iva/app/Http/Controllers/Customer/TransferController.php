<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\EzepostTracking;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index(Request $request)
    {
        $ezepostUser = auth()->user()->ezepostUser;

        $transfers = EzepostTracking::query()
            ->where(function ($q) use ($ezepostUser) {
                $q->where('sender_ezepost_user_id', $ezepostUser->id)
                  ->orWhere('receiver_ezepost_user_id', $ezepostUser->id);
            })
            ->when($request->search, fn($q, $search) =>
                $q->where('transfer_reference', 'like', "%{$search}%")
                  ->orWhere('file_names', 'like', "%{$search}%")
            )
            ->orderByDesc('transferred_at')
            ->paginate(15);

        return view('customer.transfers.index', compact('transfers'));
    }
}
