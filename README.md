# EzePost - Secure File Transfer Web Application

## 📋 Project Overview

EzePost is a comprehensive Laravel web application for managing secure file transfers. It integrates with a C++ server and Electron desktop application to provide encrypted file transfer services to individuals and organizations.

---

## ✅ IMPLEMENTED FEATURES

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

## 📞 Support

**Development Manager**: MH Khan  
**Email**: majid@g3t.uk.com

---

## 📄 License

Proprietary - Group 3 Technology

---

## 🎯 Next Steps

1. Implement Stripe integration
2. Deploy to production

---

**Last Updated**: May 23, 2026  
**Version**: 0.5.6
