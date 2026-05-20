# EzePost - Secure File Transfer Web Application

## 📋 Project Overview

EzePost is a comprehensive Laravel web application for managing secure file transfers. It integrates with a C++ server and Electron desktop application to provide encrypted file transfer services to individuals and organizations.

---

## ✅ IMPLEMENTED FEATURES (Current Status: ~55%)

### 1. Core Infrastructure ✅
- Laravel 13.9.0
- MySQL 8.0 database
- Tailwind CSS styling
- Laravel Breeze authentication
- Responsive modern UI/UX

### 2. Controlling String Service ✅
**File**: `app/Services/ControllingStringService.php`

20-character string format: `[State][Group][Plan][TeamSize][PackageSize] + padding`

**Features:**
- Generate controlling strings from plan data
- Lock/unlock user accounts
- Parse controlling strings
- Update plan codes
- Set individual/business status
- Check active/locked status

**Example**: `11309` = Active(1) Business(1) Premium(3) 1-9Users(0) Unlimited(9)

### 3. Database Structure ✅

**Tables:**
- `users` - Web authentication
- `ezepost_user` - Desktop app data
- `ezepost_tracking` - File transfer records
- `ezepost_block_list` - Blocked users
- `plans` - Subscription plans
- `periods` - Billing periods (monthly/yearly)
- `billing_tables` - Stripe integration

**Seeders:**
- PlanPeriodSeeder (3 plans: Starter, Basic, Premium)

### 4. Public Pages ✅
- **Home** (`/`) - Landing page with hero section
- **Pricing** (`/pricing`) - Plans display with features
- **About** (`/about`) - Company information
- **Contact** (`/contact`) - Contact form
- **Download** (`/download`) - Desktop app downloads (Windows, Mac, Linux)

### 5. Authentication ✅
- User registration
- User login
- Password reset
- Email verification (configured)
- Remember me functionality

### 6. Customer Dashboard ✅
**Route**: `/dashboard`

**Features:**
- Transfer statistics (sent, received, viewed)
- Quick actions menu
- Recent activity display
- Profile management link

### 7. Admin Area ✅
**Routes**: `/admin/*`

**Implemented:**
- Admin dashboard with statistics
- Customer management
  - List all customers
  - View customer details
  - Block/unblock customers
  - Search functionality
- Controlling string integration
- Admin middleware protection

**Admin Dashboard Stats:**
- Total customers
- Active customers
- Individual vs Corporate breakdown
- Total transfers
- Recent users list

### 8. PDF Generation (Partial) ⚠️
- DomPDF library installed
- Basic PDF service created
- Receipt template started

---

## 🚧 REMAINING WORK

### Priority 1: Complete Admin Views (Estimated: 3-4 hours)

**Files Needed:**
1. `resources/views/admin/customers/show.blade.php` - Customer detail view
2. `resources/views/admin/transfers/index.blade.php` - Transfer list
3. `resources/views/admin/plans/index.blade.php` - Plan management

### Priority 2: Stripe Integration (Estimated: 8-10 hours)

**Components:**
1. Subscription Controller
2. Top-up Controller
3. Webhook Controller
4. Customer Portal integration
5. Multi-currency support (GBP, USD, EUR)
6. Subscription upgrade/downgrade
7. Subscription cancellation

**Webhooks to Handle:**
- `customer.subscription.created`
- `customer.subscription.updated`
- `customer.subscription.deleted`
- `invoice.payment_succeeded`
- `invoice.payment_failed`

### Priority 3: Team Management (Estimated: 6-8 hours)

**Features:**
- Create team
- Invite members
- View team activity
- Team leader permissions
- Remove members

### Priority 4: File Transfer Views (Estimated: 4-5 hours)

**Features:**
- List transfers (sent/received)
- Search and filter
- Transfer details
- Download receipt

### Priority 5: Complete PDF Receipts (Estimated: 3-4 hours)

**Template Requirements:**
- Company branding
- Transfer details
- File list (max 5 files)
- Transfer reference
- Date/time stamps

### Priority 6: Docker Setup (Estimated: 2-3 hours)

**Files:**
- `Dockerfile`
- `docker-compose.yml`
- `.dockerignore`
- `docker/nginx/default.conf`

### Priority 7: Additional Features (Estimated: 4-6 hours)

- Email notifications
- Corporate vs Individual registration
- Account locking UI
- Password reset emails

---

## 🚀 QUICK START

### Prerequisites
- PHP 8.1+
- Composer
- MySQL 8.0+
- Node.js (optional)

### Installation

```bash
# Navigate to project
cd ezepost-app

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ezepost
DB_USERNAME=root
DB_PASSWORD=

# Create database
mysql -u root -e "CREATE DATABASE ezepost;"

# Run migrations
php artisan migrate

# Seed initial data
php artisan db:seed --class=PlanPeriodSeeder

# Start server
php artisan serve
```

### Create Admin User

```bash
php artisan tinker
```

```php
$user = User::first(); // or User::find(1)
$user->is_admin = true;
$user->save();
```

### Access Points

- **Website**: http://127.0.0.1:8000
- **Admin Panel**: http://127.0.0.1:8000/admin/dashboard
- **Customer Dashboard**: http://127.0.0.1:8000/dashboard

---

## 📁 PROJECT STRUCTURE

```
ezepost-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── AdminDashboardController.php
│   │   │   │   └── CustomerManagementController.php
│   │   │   ├── Customer/
│   │   │   │   └── CustomerDashboardController.php
│   │   │   ├── Billing/
│   │   │   │   └── StripeCheckoutController.php
│   │   │   └── PublicPageController.php
│   │   └── Middleware/
│   │       └── IsAdmin.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── EzepostUser.php
│   │   ├── EzepostTracking.php
│   │   ├── Plan.php
│   │   └── Period.php
│   └── Services/
│       ├── ControllingStringService.php
│       └── Pdf/
│           └── ReceiptPdfService.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── PlanPeriodSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php
│       │   ├── admin.blade.php
│       │   └── guest.blade.php
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   └── customers/
│       │       └── index.blade.php
│       ├── customer/
│       │   └── dashboard.blade.php
│       ├── public/
│       │   ├── home.blade.php
│       │   ├── pricing.blade.php
│       │   ├── about.blade.php
│       │   ├── contact.blade.php
│       │   └── download.blade.php
│       └── auth/
│           ├── login.blade.php
│           └── register.blade.php
└── routes/
    └── web.php
```

---

## 🔧 CONFIGURATION

### Environment Variables

```env
APP_NAME=EzePost
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ezepost
DB_USERNAME=root
DB_PASSWORD=

# Stripe (Add your keys)
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
```

---

## 🎨 UI/UX Design

- **Framework**: Tailwind CSS
- **Color Scheme**: Blue primary (#3B82F6), with green, purple, orange accents
- **Layout**: Responsive, mobile-first
- **Components**: Cards, tables, forms, buttons, navigation
- **Admin Panel**: Sidebar navigation with dark theme

---

## 🔐 Security Features

1. **Controlling String**: 20-character code for desktop app integration
2. **Account Locking**: Admin can block users from file transfers
3. **Authentication**: Laravel Breeze with email verification
4. **Admin Middleware**: Protected admin routes
5. **CSRF Protection**: All forms protected
6. **Password Hashing**: Bcrypt encryption

---

## 📊 Database Relationships

```
User (1) ──── (1) EzepostUser
EzepostUser (1) ──── (many) EzepostTracking (as sender)
EzepostUser (1) ──── (many) EzepostTracking (as receiver)
Plan (1) ──── (many) Subscriptions
User (1) ──── (many) Teams
Team (1) ──── (many) TeamMembers
```

---

## 🧪 Testing

### Manual Testing Checklist

**Public Pages:**
- [ ] Home page loads
- [ ] Pricing displays plans
- [ ] About page shows information
- [ ] Contact form displays
- [ ] Download page shows all platforms

**Authentication:**
- [ ] User can register
- [ ] User can login
- [ ] User can reset password
- [ ] User can logout

**Customer Dashboard:**
- [ ] Dashboard shows statistics
- [ ] Profile can be edited
- [ ] Transfers display (when data exists)

**Admin Panel:**
- [ ] Admin can access dashboard
- [ ] Customer list displays
- [ ] Admin can block/unblock users
- [ ] Statistics are accurate

---

## 📝 API Endpoints (Future)

For desktop app integration:

```
POST /api/auth/desktop-login
POST /api/transfers/create
GET /api/transfers/{id}
POST /api/transfers/{id}/complete
GET /api/user/controlling-string
```

---

## 🐛 Known Issues

1. **Team Management**: Not yet implemented
2. **Stripe Integration**: Webhooks not configured
3. **PDF Receipts**: Template incomplete
4. **Search**: Not yet functional
5. **Email Notifications**: Not configured

---

## 📞 Support

**Development Manager**: MH Khan  
**Email**: majid@g3t.uk.com

---

## 📄 License

Proprietary - Group 3 Technology

---

## 🎯 Next Steps

1. Complete admin views
2. Implement Stripe integration
3. Add team management
4. Complete PDF receipts
5. Add Docker configuration
6. Set up email notifications
7. Add comprehensive testing
8. Deploy to production

---

**Last Updated**: May 13, 2026  
**Version**: 0.5.5 (55% Complete)
