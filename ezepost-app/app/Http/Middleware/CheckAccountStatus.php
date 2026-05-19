<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\ControllingStringService;

class CheckAccountStatus
{
    protected $controllingStringService;

    public function __construct(ControllingStringService $controllingStringService)
    {
        $this->controllingStringService = $controllingStringService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        
        if ($user && $user->ezepostUser) {
            $ezepostUser = $user->ezepostUser;
            
            // Check if account is locked via status field
            if ($ezepostUser->status === 'locked') {
                return redirect()->route('customer.dashboard')
                    ->with('error', 'Your account has been locked. Please contact support.');
            }
            
            // Check if account is locked via controlling string
            if ($this->controllingStringService->isLocked($ezepostUser->controlstring)) {
                return redirect()->route('customer.dashboard')
                    ->with('error', 'Your account has been locked. Please contact support.');
            }
        }
        
        return $next($request);
    }
}
