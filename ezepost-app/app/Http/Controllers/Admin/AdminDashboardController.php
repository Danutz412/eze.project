<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EzepostUser;
use App\Models\EzepostTracking;
use App\Services\ControllingStringService;

class AdminDashboardController extends Controller
{
    public function __invoke(ControllingStringService $controllingString)
    {
        $ezepostUsers = EzepostUser::with('user')->get();
        
        $activeUsers = $ezepostUsers->filter(function($ezepostUser) use ($controllingString) {
            return $controllingString->isActive($ezepostUser->controlstring ?? '00000000000000000000');
        });

        $individualUsers = $ezepostUsers->filter(function($ezepostUser) use ($controllingString) {
            $parsed = $controllingString->parse($ezepostUser->controlstring ?? '00000000000000000000');
            return $parsed['group'] == 0;
        });

        $corporateUsers = $ezepostUsers->filter(function($ezepostUser) use ($controllingString) {
            $parsed = $controllingString->parse($ezepostUser->controlstring ?? '00000000000000000000');
            return $parsed['group'] == 1;
        });

        return view('admin.dashboard', [
            'totalCustomers' => User::count(),
            'activeCustomers' => $activeUsers->count(),
            'individualCustomers' => $individualUsers->count(),
            'corporateCustomers' => $corporateUsers->count(),
            'totalTransfers' => EzepostTracking::count(),
            'recentUsers' => User::latest()->take(10)->get(),
        ]);
    }
}
