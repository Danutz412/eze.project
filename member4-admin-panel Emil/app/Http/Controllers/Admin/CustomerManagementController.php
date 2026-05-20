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
        if ($user->ezepostUser) {
            $user->ezepostUser->update([
                'status' => '0',
                'controlstring' => $stringService->lock($user->ezepostUser->controlstring),
            ]);
        }

        return back()->with('success', 'Customer blocked.');
    }

    public function unblock(User $user, ControllingStringService $stringService)
    {
        if ($user->ezepostUser) {
            $user->ezepostUser->update([
                'status' => '1',
                'controlstring' => $stringService->unlock($user->ezepostUser->controlstring),
            ]);
        }

        return back()->with('success', 'Customer unblocked.');
    }
}
