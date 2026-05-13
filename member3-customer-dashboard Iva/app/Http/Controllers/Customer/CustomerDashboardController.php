<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\EzepostTracking;

class CustomerDashboardController extends Controller
{
    public function __invoke()
    {
        $ezepostUser = auth()->user()->ezepostUser;

        return view('customer.dashboard', [
            'sent' => EzepostTracking::where('sender_ezepost_user_id', $ezepostUser->id)->count(),
            'received' => EzepostTracking::where('receiver_ezepost_user_id', $ezepostUser->id)->count(),
            'viewed' => EzepostTracking::where(function ($q) use ($ezepostUser) {
                $q->where('sender_ezepost_user_id', $ezepostUser->id)
                  ->orWhere('receiver_ezepost_user_id', $ezepostUser->id);
            })->where('status', 'viewed')->count(),
        ]);
    }
}
