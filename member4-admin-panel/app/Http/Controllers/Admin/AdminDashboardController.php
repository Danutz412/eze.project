<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'totalCustomers' => User::count(),
            'activeCustomers' => User::where('account_status', 'active')->count(),
            'individualCustomers' => User::where('customer_type', 'individual')->count(),
            'corporateCustomers' => User::where('customer_type', 'corporate')->count(),
        ]);
    }
}
