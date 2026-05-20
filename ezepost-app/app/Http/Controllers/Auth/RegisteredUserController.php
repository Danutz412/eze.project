<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EzepostUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_group' => ['required', 'in:0,1'],
            'username' => ['nullable', 'string', 'max:255', 'unique:ezepost_user,username'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate controlling string (20 characters)
        $controllingString = $this->generateControllingString($request->user_group);

        // Create EzepostUser record
        EzepostUser::create([
            'user_id' => $user->id,
            'user_group' => $request->user_group,
            'username' => $request->username ?? strtolower(str_replace(' ', '', $request->name)),
            'vepost_addr' => $request->email,
            'password' => Hash::make($request->password),
            'controlstring' => $controllingString,
            'balance' => 0.00,
            'vepost_counter' => '10',
            'status' => 'active',
            'free_send_left' => '5',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('customer.dashboard', absolute: false));
    }

    /**
     * Generate a 20-character controlling string based on user group and subscription
     * Format: [State][Group][Plan][Users][Size][...reserved...]
     */
    private function generateControllingString($userGroup)
    {
        // Index 0: State (1=Active, 0=Locked)
        $state = '1';
        
        // Index 1: Group (0=Personal, 1=Business)
        $group = (string)$userGroup;
        
        // Index 2: Plan (0=Top-up, 1=Starter, 2=Basic, 3=Premium)
        $plan = '0'; // Default to top-up
        
        // Index 3: Users count (0 = 1-9 users)
        $users = '0';
        
        // Index 4: Size (0=50MB, 1=100MB, 2=150MB, 3=200MB, 9=subscription)
        $size = '0';
        
        // Indexes 5-19: Reserved for future use (set to 0)
        $reserved = str_repeat('0', 15);
        
        return $state . $group . $plan . $users . $size . $reserved;
    }
}
