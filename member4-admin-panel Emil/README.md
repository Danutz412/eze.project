# Member 4 - Admin Panel (Emil)

## 📋 Responsibilities
Complete admin panel implementation with user management, account locking, and controlling string system.

## ✅ Features Implemented

### 1. **Admin Dashboard**
- Overview of system statistics
- Customer metrics (total, active, individuals, organizations)
- Quick access to all admin functions

### 2. **Customer Management**
- View all customers with pagination
- Customer details page
- **Block/Unblock users** - Prevent users from transferring files
- Create invoices for customers
- View customer's teams and invoices

### 3. **Account Locking System**
- Block user functionality (sets `status='locked'` and controlling string to `0`)
- Unblock user functionality (sets `status='active'` and controlling string to `1`)
- Integrated with `CheckAccountStatus` middleware
- Locked users cannot access `/customer/transfers/create`

### 4. **Controlling String Management**
- 20-character controlling string system
- Format: `[State][Group][Plan][Users][Size][Reserved]`
- Admin can lock/unlock accounts via controlling string
- Service class for string manipulation

### 5. **Admin Navigation**
- Dashboard
- Customers (list, view, block/unblock)
- Transfers (view all transfers)
- Plans (subscription plans)
- Teams (team management)
- Invoices (invoice management)

### 6. **Panel Switcher**
- Easy switching between Admin and Customer panels
- "Switch to Customer Panel" button in admin sidebar
- Seamless navigation for admin users

## 📁 Files Structure

```
member4-admin-panel/
├── Controllers/
│   └── Admin/
│       ├── AdminDashboardController.php
│       ├── CustomerManagementController.php
│       └── TransferController.php
├── Middleware/
│   └── IsAdmin.php
├── views/
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   ├── customers/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   ├── transfers/
│   │   │   ├── index.blade.php
│   │   │   └── create.blade.php
│   │   ├── plans/
│   │   │   └── index.blade.php
│   │   ├── teams/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   └── invoices/
│   │       ├── index.blade.php
│   │       └── pdf.blade.php
│   └── layouts/
│       └── admin.blade.php
└── README.md
```

## 🔑 Key Controllers

### **AdminDashboardController.php**
- Displays admin dashboard with statistics
- Shows total customers, active customers, individuals, organizations

### **CustomerManagementController.php**
- `index()` - List all customers
- `show()` - View customer details
- `block()` - Block user (lock account)
- `unblock()` - Unblock user (unlock account)
- `createInvoice()` - Create invoice for customer

### **IsAdmin Middleware**
- Checks if user has `is_admin = 1`
- Redirects non-admin users to customer dashboard

## 🎨 Views

### **admin.blade.php** (Layout)
- Dark theme admin layout
- Sidebar navigation
- "Switch to Customer Panel" button
- User profile section

### **dashboard.blade.php**
- Statistics cards
- Customer metrics
- Quick links to admin sections

### **customers/index.blade.php**
- Paginated customer list
- Search functionality
- Quick actions (view, block/unblock)

### **customers/show.blade.php**
- Customer details
- Block/Unblock buttons
- Customer's teams
- Customer's invoices
- Create invoice form

## 🔧 Technical Implementation

### **Account Locking**
```php
// Block user
public function block(User $user, ControllingStringService $stringService)
{
    $user->ezepostUser->update([
        'status' => 'locked',
        'controlstring' => $stringService->lock($user->ezepostUser->controlstring),
    ]);
}

// Unblock user
public function unblock(User $user, ControllingStringService $stringService)
{
    $user->ezepostUser->update([
        'status' => 'active',
        'controlstring' => $stringService->unlock($user->ezepostUser->controlstring),
    ]);
}
```

### **Controlling String Format**
```
Position | Meaning              | Values
---------|---------------------|---------------------------
0        | Account State       | 0=Locked, 1=Active
1        | User Group          | 0=Personal, 1=Business
2        | Subscription Plan   | 0=Top-up, 1=Starter, 2=Basic, 3=Premium
3        | Team Size           | 0=1-9, 1=10-19, 2=20-29, ..., 9=90-100
4        | Package Size        | 0=50MB, 1=100MB, 2=150MB, 3=200MB, 9=subscription
5-19     | Reserved            | 0 (for future use)
```

## 🛣️ Routes

```php
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/', function() { return redirect()->route('admin.dashboard'); });
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
    
    Route::get('/customers', [CustomerManagementController::class, 'index'])->name('customers.index');
    Route::get('/customers/{user}', [CustomerManagementController::class, 'show'])->name('customers.show');
    Route::post('/customers/{user}/block', [CustomerManagementController::class, 'block'])->name('customers.block');
    Route::post('/customers/{user}/unblock', [CustomerManagementController::class, 'unblock'])->name('customers.unblock');
    Route::post('/customers/{user}/invoice', [CustomerManagementController::class, 'createInvoice'])->name('customers.create-invoice');
    
    // ... other admin routes
});
```

## 🧪 Testing

### **Test Admin Access**
1. Login as admin: `admin@example.com` / `password`
2. Go to: `http://127.0.0.1:8002/admin`
3. Should see admin dashboard

### **Test Account Locking**
1. Go to `/admin/customers`
2. Click on a customer
3. Click "Block User"
4. Logout and login as that user
5. Try to access `/customer/transfers/create`
6. Should be redirected with error message

### **Test Panel Switcher**
1. Login as admin
2. Click "Switch to Customer Panel" in sidebar
3. Should redirect to customer dashboard
4. Click "Switch to Admin Panel"
5. Should redirect to admin dashboard

## 📊 Database Interactions

### **Users Table**
- `is_admin` - Flag to identify admin users

### **EzepostUser Table**
- `status` - `active` or `locked`
- `controlstring` - 20-character control string
- `user_group` - 0 (Personal) or 1 (Business)

## 🎯 Key Achievements

✅ Complete admin panel with all CRUD operations
✅ User blocking/unblocking system
✅ Controlling string implementation
✅ Panel switcher for easy navigation
✅ Professional admin UI with dark theme
✅ Integration with customer management
✅ Invoice creation functionality
✅ Team and transfer management

## 👤 Developer
**Emil Vaklinov**
- Admin Panel Development
- User Management System
- Account Locking Implementation
- Controlling String System
