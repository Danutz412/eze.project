<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ControllingStringService;
use Illuminate\Http\Request;

class CustomerManagementController extends Controller
{
    public function index()
    {
        $customers = User::with('ezepostUser')->latest()->paginate(20);
        return view('admin.customers.index', compact('customers'));
    }

    public function block(User $user, Request $request, ControllingStringService $stringService)
    {
        $user->update(['account_status' => 'locked']);

        if ($user->ezepostUser) {
            $user->ezepostUser->update([
                'desktop_account_status' => 'locked',
                'controllingstring' => $stringService->lock($user->ezepostUser->controllingstring),
            ]);
        }

        return back()->with('success', 'Customer blocked.');
    }

    public function unblock(User $user, ControllingStringService $stringService)
    {
        $user->update(['account_status' => 'active']);

        if ($user->ezepostUser) {
            $user->ezepostUser->update([
                'desktop_account_status' => 'active',
                'controllingstring' => $stringService->unlock($user->ezepostUser->controllingstring),
            ]);
        }

        return back()->with('success', 'Customer unblocked.');
    }
}
