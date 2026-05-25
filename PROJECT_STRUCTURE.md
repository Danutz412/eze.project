# EzePost Project Structure

## 📂 Project Organization

The project is organized into member-specific folders, making it easy to identify each team member's contributions for presentations and evaluations.

```
eze.project/
├── ezepost-app/                           # Main Laravel application (shared core)
│   ├── app/
│   │   ├── Models/                        # Shared models (User, EzepostUser, etc.)
│   │   ├── Services/                      # Shared services (ControllingStringService)
│   │   └── Http/Kernel.php
│   ├── database/
│   │   ├── migrations/                    # All database migrations
│   │   └── seeders/
│   ├── routes/
│   │   ├── web.php                        # Main routes file
│   │   ├── auth.php                       # Authentication routes
│   │   └── public.php                     # Public routes
│   ├── config/                            # Laravel configuration
│   ├── bootstrap/                         # Laravel bootstrap
│   ├── public/                            # Public assets
│   ├── .env                               # Environment configuration
│   ├── composer.json                      # PHP dependencies
│   ├── IMPLEMENTATION_SUMMARY.md          # Complete implementation guide
│   └── QUICK_TEST_GUIDE.md               # Quick testing guide
│
├── member1-auth-setup Dan/                # Dan's work
│   ├── Controllers/Auth/                  # All authentication controllers
│   ├── Middleware/CheckAccountStatus.php  # Account locking middleware
│   ├── views/auth/                        # All auth views (login, register, etc.)
│   └── README.md                          # Dan's documentation
│
├── member2-frontend-landing Tania/        # Tania's work
│   ├── Controllers/                       # Public page controllers
│   ├── views/public/                      # Landing pages (home, pricing, etc.)
│   └── README.md                          # Tania's documentation
│
├── member3-customer-dashboard Iva/        # Iva's work
│   ├── Controllers/Customer/              # Customer controllers
│   ├── views/customer/                    # Customer views (dashboard, transfers, teams)
│   ├── views/layouts/customer.blade.php   # Customer layout
│   └── README.md                          # Iva's documentation
│
├── member4-admin-panel/                   # Emil's work (YOU)
│   ├── Controllers/Admin/                 # Admin controllers
│   ├── Middleware/IsAdmin.php             # Admin middleware
│   ├── views/admin/                       # Admin views (dashboard, customers, etc.)
│   ├── views/layouts/admin.blade.php      # Admin layout
│   └── README.md                          # Emil's documentation
│
├── member5-stripe-subscription Iulian/    # Iulian's work
│   ├── Controllers/                       # Subscription controllers
│   ├── views/subscription/                # Subscription views
│   └── README.md                          # Iulian's documentation
│
├── member6-docker-pdf-docs Boris/         # Boris's work
│   ├── docker/                            # Docker configuration
│   ├── pdf-templates/                     # PDF templates
│   ├── Dockerfile                         # Docker image definition
│   ├── docker-compose.yml                 # Docker compose configuration
│   └── README.md                          # Boris's documentation
│
└── PROJECT_STRUCTURE.md                   # This file
```

## 👥 Team Members & Responsibilities

### **Member 1 - Dan (Authentication & User Management)**
**Folder:** `member1-auth-setup Dan/`

**Responsibilities:**
- ✅ User registration with account type selection (Personal/Business)
- ✅ Login system with selection page
- ✅ Password reset and email verification
- ✅ User group management (user_group field)
- ✅ Controlling string generation on registration
- ✅ Account status middleware (CheckAccountStatus)
- ✅ Integration with admin blocking system

**Key Files:**
- `Controllers/Auth/RegisteredUserController.php`
- `Controllers/Auth/AuthenticatedSessionController.php`
- `Middleware/CheckAccountStatus.php`
- `views/auth/login-select.blade.php`
- `views/auth/register.blade.php`

---

### **Member 2 - Tania (Frontend & Landing Pages)**
**Folder:** `member2-frontend-landing Tania/`

**Responsibilities:**
- Public landing pages
- Home page
- Pricing page
- Download page
- About/Contact pages
- Public UI/UX design

**Key Files:**
- `views/public/home.blade.php`
- `views/public/pricing.blade.php`
- `views/public/download.blade.php`

---

### **Member 3 - Iva (Customer Dashboard & Transfers)**
**Folder:** `member3-customer-dashboard Iva/`

**Responsibilities:**
- ✅ Customer dashboard with statistics
- ✅ File transfer management (create, send, view)
- ✅ Transfer history (sent, received, viewed)
- ✅ Team management (create, invite, settings)
- ✅ Customer panel UI with sidebar navigation
- ✅ Integration with admin panel switcher

**Key Files:**
- `Controllers/Customer/DashboardController.php`
- `Controllers/Customer/TransferController.php`
- `Controllers/Customer/TeamController.php`
- `views/customer/dashboard.blade.php`
- `views/customer/transfers/create.blade.php`
- `views/layouts/customer.blade.php`

---

### **Member 4 - Emil (Admin Panel) - YOU**
**Folder:** `member4-admin-panel/`

**Responsibilities:**
- ✅ Admin dashboard with system statistics
- ✅ Customer management (view, block/unblock)
- ✅ Account locking system
- ✅ Controlling string management
- ✅ Invoice creation for customers
- ✅ Transfer management (view all transfers)
- ✅ Team and plan management
- ✅ Admin panel UI with dark theme
- ✅ Panel switcher for easy navigation

**Key Files:**
- `Controllers/Admin/AdminDashboardController.php`
- `Controllers/Admin/CustomerManagementController.php`
- `Middleware/IsAdmin.php`
- `views/admin/dashboard.blade.php`
- `views/admin/customers/index.blade.php`
- `views/admin/customers/show.blade.php`
- `views/layouts/admin.blade.php`

---

### **Member 5 - Iulian (Stripe Subscription)**
**Folder:** `member5-stripe-subscription Iulian/`

**Responsibilities:**
- Stripe payment integration
- Subscription management
- Plan upgrades/downgrades
- Top-up functionality
- Webhook handling
- Payment portal

**Key Files:**
- `Controllers/SubscriptionController.php`
- `views/subscription/portal.blade.php`

---

### **Member 6 - Boris (Docker & PDF Documentation)**
**Folder:** `member6-docker-pdf-docs Boris/`

**Responsibilities:**
- ✅ Docker configuration
- ✅ PDF receipt templates
- ✅ PDF generation for transfers
- Docker compose setup
- Deployment documentation

**Key Files:**
- `pdf-templates/transfer-receipt.blade.php`
- `Dockerfile`
- `docker-compose.yml`

---

## 🚀 How to Run the Application

### **Prerequisites:**
- PHP 8.2+
- MySQL
- Composer
- Node.js & NPM

### **Setup:**
```bash
cd /Users/emilvaklinov/Desktop/eze.project/ezepost-app

# Install dependencies
composer install
npm install

# Configure environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Start server
php artisan serve --port=8002
```

### **Access:**
- **Application:** http://127.0.0.1:8002
- **Login:** http://127.0.0.1:8002/login
- **Register:** http://127.0.0.1:8002/register
- **Admin Panel:** http://127.0.0.1:8002/admin

### **Test Credentials:**
- **Admin:** `admin@example.com` / `password`

---

## 📊 Database Schema

### **Core Tables:**
- `users` - Main user accounts
- `ezepost_user` - Extended user data with controlling string
- `ezepost_tracking` - File transfers
- `teams` - Team management
- `team_members` - Team membership
- `team_invitations` - Team invites
- `plans` - Subscription plans
- `invoices` - Customer invoices

### **Key Fields:**
- `users.is_admin` - Admin flag
- `ezepost_user.user_group` - 0=Personal, 1=Business
- `ezepost_user.controlstring` - 20-character control string
- `ezepost_user.status` - active/locked

---

## 🔧 Shared Components

### **Models** (in `ezepost-app/app/Models/`)
- `User.php`
- `EzepostUser.php`
- `EzepostTracking.php`
- `Team.php`
- `TeamMember.php`
- `TeamInvitation.php`
- `Plan.php`
- `Invoice.php`

### **Services** (in `ezepost-app/app/Services/`)
- `ControllingStringService.php` - Manages 20-character control strings

### **Middleware** (in `ezepost-app/app/Http/Middleware/`)
- `IsAdmin.php` - Admin access control (Member 4)
- `CheckAccountStatus.php` - Account locking (Member 1)

---

## 📝 Documentation

Each member folder contains:
- **README.md** - Detailed documentation of their work
- **Controllers/** - Their specific controllers
- **views/** - Their specific views
- **Middleware/** - Their specific middleware (if any)

### **Main Documentation:**
- `ezepost-app/IMPLEMENTATION_SUMMARY.md` - Complete implementation guide
- `ezepost-app/QUICK_TEST_GUIDE.md` - Quick testing checklist
- `PROJECT_STRUCTURE.md` - This file

---

## 🎯 Presentation Guidelines

Each team member can present their work by:

1. **Show their folder** - Demonstrate clear separation of work
2. **Explain their controllers** - Walk through the logic
3. **Demo their views** - Show the UI they built
4. **Run their features** - Live demonstration
5. **Show their README** - Documentation of achievements

### **Example Presentation Flow (Emil - Admin Panel):**
1. Open `member4-admin-panel/` folder
2. Show `Controllers/Admin/CustomerManagementController.php`
3. Explain block/unblock functionality
4. Demo admin dashboard at `/admin`
5. Show customer blocking in action
6. Reference `README.md` for complete feature list

---

## ✅ Current Status

**Completed:**
- ✅ Authentication system
- ✅ Customer dashboard
- ✅ Admin panel
- ✅ User management
- ✅ Account locking
- ✅ PDF receipts
- ✅ Team management
**In Progress:**
- ⏳ Stripe integration (Iulian)
- ⏳ Landing pages (Tania)
- ⏳ Docker setup (Boris)

---

## 🔗 Git Workflow

**Current Branch:** `feature/user-management-and-pdf-receipts`

**To push changes:**
```bash
cd /Users/emilvaklinov/Desktop/eze.project/ezepost-app
git add .
git commit -m "Your commit message"
git push origin feature/user-management-and-pdf-receipts
```

---

## 📞 Support

For questions about specific components, contact the responsible team member:
- **Authentication:** Dan
- **Landing Pages:** Tania
- **Customer Dashboard:** Iva
- **Admin Panel:** Emil
- **Stripe:** Iulian
- **Docker/PDF:** Boris
