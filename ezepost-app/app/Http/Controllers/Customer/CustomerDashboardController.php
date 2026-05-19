<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\EzepostTracking;

class CustomerDashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        $recentActivity = EzepostTracking::where(function ($q) use ($user) {
                $q->where('sender_user_id', $user->id)
                  ->orWhere('receiver_user_id', $user->id);
            })
            ->with(['senderUser', 'receiverUser'])
            ->latest('created_at')
            ->take(5)
            ->get();

        // Fetch all teams
        $teams = \App\Models\Team::with('owner')
            ->get();

        return view('customer.dashboard', [
            'sent' => EzepostTracking::where('sender_user_id', $user->id)->count(),
            'received' => EzepostTracking::where('receiver_user_id', $user->id)->count(),
            'viewed' => EzepostTracking::where(function ($q) use ($user) {
                $q->where('sender_user_id', $user->id)
                  ->orWhere('receiver_user_id', $user->id);
            })->where('status', 'viewed')
             ->whereDate('viewed_at', today())
             ->count(),
            'recentActivity' => $recentActivity,
            'teams' => $teams,
        ]);
    }
}
