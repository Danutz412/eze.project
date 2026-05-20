# Member 1 - Authentication & User Management (Dan)

## 📋 Responsibilities
Complete authentication system, user registration with account types, and account status management.

## ✅ Features Implemented

### 1. **User Registration**
- Registration form with account type selection
- Personal Account (user_group = 0)
- Business Account (user_group = 1)
- Automatic EzepostUser record creation
- Controlling string generation on registration

### 2. **Login System**
- Login selection page (Personal vs Corporate)
- Standard login form
- Password reset functionality
- Email verification

### 3. **User Group Management**
- Database field `user_group` in `ezepost_user` table
- Distinction between Personal and Business accounts
- Integration with controlling string system

### 4. **Account Status Middleware**
- `CheckAccountStatus` middleware
- Prevents locked users from transferring files
- Checks both `status` field and controlling string
- Applied to transfer routes

### 5. **Controlling String Generation**
- 20-character string generated on registration
- Format: `[State][Group][Plan][Users][Size][Reserved]`
- Default: `10000000000000000000` (Active Personal, Top-up)

## 📁 Files Structure

```
member1-auth-setup Dan/
├── Controllers/
│   └── Auth/
│       ├── AuthenticatedSessionController.php
│       ├── ConfirmablePasswordController.php
│       ├── EmailVerificationNotificationController.php
│       ├── EmailVerificationPromptController.php
│       ├── NewPasswordController.php
│       ├── PasswordController.php
│       ├── PasswordResetLinkController.php
│       ├── RegisteredUserController.php
│       └── VerifyEmailController.php
├── Middleware/
│   └── CheckAccountStatus.php
├── views/
│   └── auth/
│       ├── confirm-password.blade.php
│       ├── forgot-password.blade.php
│       ├── login-select.blade.php
│       ├── login.blade.php
│       ├── register.blade.php
│       ├── reset-password.blade.php
│       └── verify-email.blade.php
└── README.md
```

## 🔑 Key Controllers

### **RegisteredUserController.php**
- Handles user registration
- Validates user input including `user_group`
- Creates User and EzepostUser records
- Generates controlling string
- Auto-login after registration

### **AuthenticatedSessionController.php**
- Handles login
- Redirects to customer dashboard after login

### **CheckAccountStatus Middleware**
- Checks if user account is locked
- Validates both `status` field and controlling string
- Redirects locked users with error message

## 🎨 Views

### **login-select.blade.php**
- Two-column layout
- Personal Account option
- Corporate Account option
- Links to actual login form

### **register.blade.php**
- Registration form with:
  - Name
  - Email
  - **Account Type dropdown** (Personal/Business)
  - Password
  - Password confirmation

### **login.blade.php**
- Standard login form
- Email and password fields
- Remember me checkbox
- Forgot password link

## 🔧 Technical Implementation

### **Registration with User Group**
```php
public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'user_group' => ['required', 'in:0,1'],
    ]);

    $user = User::create([...]);
    
    // Generate controlling string
    $controllingString = $this->generateControllingString($request->user_group);
    
    // Create EzepostUser
    EzepostUser::create([
        'user_id' => $user->id,
        'user_group' => $request->user_group,
        'controlstring' => $controllingString,
        // ...
    ]);
}
```

### **Account Status Check**
```php
public function handle(Request $request, Closure $next): Response
{
    $user = auth()->user();
    
    if ($user && $user->ezepostUser) {
        if ($ezepostUser->status === 'locked') {
            return redirect()->route('customer.dashboard')
                ->with('error', 'Your account has been locked.');
        }
        
        if ($this->controllingStringService->isLocked($ezepostUser->controlstring)) {
            return redirect()->route('customer.dashboard')
                ->with('error', 'Your account has been locked.');
        }
    }
    
    return $next($request);
}
```

## 🛣️ Routes

```php
Route::middleware('guest')->group(function () {
    Route::get('login', function () {
        return view('auth.login-select');
    })->name('login');

    Route::get('login/form', [AuthenticatedSessionController::class, 'create'])
        ->name('login.form');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);
});

// Protected routes with account status check
Route::get('/transfers/create', [TransferController::class, 'create'])
    ->middleware('account.active')
    ->name('customer.transfers.create');
```

## 🧪 Testing

### **Test Registration**
1. Go to: `http://127.0.0.1:8002/register`
2. Fill in form and select "Personal Account" or "Business Account"
3. Submit
4. Check database:
```sql
SELECT u.name, u.email, eu.user_group, eu.controlstring, eu.status 
FROM users u 
LEFT JOIN ezepost_user eu ON u.id = eu.user_id 
ORDER BY u.id DESC LIMIT 1;
```

### **Test Login Selection**
1. Go to: `http://127.0.0.1:8002/login`
2. Should see two-column page
3. Click either "Login" button
4. Should redirect to login form

### **Test Account Locking**
1. Admin blocks a user
2. Logout and login as blocked user
3. Try to access `/customer/transfers/create`
4. Should be redirected with error

## 📊 Database Schema

### **Migration: add_user_group_to_ezepost_user_table**
```php
Schema::table('ezepost_user', function (Blueprint $table) {
    $table->tinyInteger('user_group')->default(0)->after('user_id')
        ->comment('0=Personal, 1=Business');
});
```

### **EzepostUser Fields**
- `user_group` - 0 (Personal) or 1 (Business)
- `controlstring` - 20-character control string
- `status` - `active` or `locked`

## 🎯 Key Achievements

✅ Complete authentication system (login, register, password reset)
✅ User group distinction (Personal vs Business)
✅ Controlling string generation on registration
✅ Account status middleware
✅ Login selection page
✅ Integration with admin blocking system

## 👤 Developer
**Dan**
- Authentication System
- User Registration with Account Types
- Account Status Middleware
- Login Flow Implementation
