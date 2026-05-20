# 🚀 Quick Test Guide - EzePost

## 🔐 Test Credentials

### Admin Account
- **Email:** `admin@example.com`
- **Password:** `password`
- **Access:** Full admin panel + customer panel

### Test User (if needed)
- Register a new user at `/register`

---

## ✅ Quick Tests (5 minutes)

### 1️⃣ **Test Registration with Account Type** (1 min)
```
1. Go to: http://127.0.0.1:8002/register
2. Fill form and select "Personal Account" or "Business Account"
3. Submit
4. ✅ Should redirect to customer dashboard
5. ✅ Check database: SELECT * FROM ezepost_user ORDER BY id DESC LIMIT 1;
   - user_group should be 0 or 1
   - controlstring should be 20 characters
```

### 2️⃣ **Test Login Selection Page** (30 sec)
```
1. Logout
2. Go to: http://127.0.0.1:8002/login
3. ✅ Should see two-column page (Personal vs Corporate)
4. Click either "Login" button
5. ✅ Should see login form
```

### 3️⃣ **Test Admin Panel Switcher** (30 sec)
```
1. Login as admin@example.com
2. ✅ See blue box: "Switch to Admin Panel" in sidebar
3. Click it
4. ✅ Should see admin dashboard
5. ✅ See "Switch to Customer Panel" button
6. Click it
7. ✅ Back to customer dashboard
```

### 4️⃣ **Test Account Locking** (1 min)
```
1. Login as admin
2. Go to: http://127.0.0.1:8002/admin/customers
3. Click on any customer
4. Click "Block User"
5. ✅ Success message appears
6. Logout and login as that user
7. Try to go to: http://127.0.0.1:8002/customer/transfers/create
8. ✅ Should be redirected with error: "Your account has been locked"
9. Login as admin again
10. Unblock the user
11. ✅ User can now access transfers
```

### 5️⃣ **Test PDF Receipt** (1 min)
```
1. Login as any user
2. Send a test transfer (if none exist)
3. Go to: http://127.0.0.1:8002/customer/transfers/sent
4. Click "Download Receipt" or go to:
   http://127.0.0.1:8002/customer/transfers/{id}/generate-pdf
5. ✅ PDF should download with:
   - EzePost branding
   - Transfer details
   - Sender/receiver info
   - File details
```

### 6️⃣ **Test Team Invitation Email** (1 min)
```
Prerequisites: Mailtrap configured in .env

1. Login as any user
2. Go to: http://127.0.0.1:8002/teams/settings
3. Click "Add Member"
4. Enter: test@example.com
5. Select role: Administrator
6. Click "Send Invitation"
7. ✅ Success message
8. Check Mailtrap inbox
9. ✅ Email should appear with invitation
```

---

## 🗄️ Database Quick Checks

### Check User Group
```sql
SELECT u.name, u.email, eu.user_group, eu.controlstring, eu.status 
FROM users u 
LEFT JOIN ezepost_user eu ON u.id = eu.user_id 
ORDER BY u.id DESC 
LIMIT 5;
```

### Check Controlling String Format
```sql
SELECT 
    username,
    controlstring,
    SUBSTRING(controlstring, 1, 1) as state,
    SUBSTRING(controlstring, 2, 1) as user_group,
    SUBSTRING(controlstring, 3, 1) as plan,
    status
FROM ezepost_user
ORDER BY id DESC
LIMIT 5;
```

### Check Locked Accounts
```sql
SELECT u.name, u.email, eu.status, eu.controlstring
FROM users u
JOIN ezepost_user eu ON u.id = eu.user_id
WHERE eu.status = 'locked' OR SUBSTRING(eu.controlstring, 1, 1) = '0';
```

---

## 🔧 If Something Doesn't Work

### Clear All Caches
```bash
cd /Users/emilvaklinov/Desktop/eze.project/ezepost-app
php artisan optimize:clear
```

### Check Migrations
```bash
php artisan migrate:status
```

### Reset Admin Password
```bash
mysql -u root ezepost -e "UPDATE users SET password = '\$2y\$12\$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewY5NANClx6Hxmq6' WHERE email = 'admin@example.com'"
```

### Check Mailtrap Config
```bash
grep MAIL /Users/emilvaklinov/Desktop/eze.project/ezepost-app/.env
```

---

## 📊 Expected Controlling String Examples

| Account Type | Status | Plan    | String Example       | Meaning |
|-------------|--------|---------|---------------------|---------|
| Personal    | Active | Top-up  | 10000000000000000000 | Active Personal, Top-up plan |
| Business    | Active | Top-up  | 11000000000000000000 | Active Business, Top-up plan |
| Personal    | Locked | Top-up  | 00000000000000000000 | Locked Personal, Top-up plan |
| Business    | Active | Premium | 11300000000000000000 | Active Business, Premium plan |

---

## ✅ Success Indicators

- ✅ Registration creates both `users` and `ezepost_user` records
- ✅ Controlling string is exactly 20 characters
- ✅ Locked users cannot access `/customer/transfers/create`
- ✅ PDF receipts download successfully
- ✅ Admin can switch between panels easily
- ✅ Team invitation emails appear in Mailtrap
- ✅ Login selection page shows before login form

---

## 📝 Notes

- All caches have been cleared
- All migrations are applied
- PDF library (dompdf) is installed
- Middleware is registered and applied
- Admin password is reset to: `password`

**Everything is ready for testing!** 🎉
