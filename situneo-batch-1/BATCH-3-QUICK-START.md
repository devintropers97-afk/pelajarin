# BATCH 3: Quick Start Guide

## 🚀 IMMEDIATE SETUP (5 Minutes)

### 1. **Update Email Configuration**
Edit `/includes/functions/email.php`:
```php
define('SITE_URL', 'https://yourdomain.com'); // Change this!
```

### 2. **Create Placeholder Dashboards**
Create these 3 files or login will fail:

**File:** `/admin/dashboard.php`
```php
<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/auth.php';
requireLogin();
requireRole('admin');
$pageTitle = 'Admin Dashboard';
?>
<!DOCTYPE html>
<html>
<head><title><?php echo $pageTitle; ?></title></head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
    <p>Role: <?php echo $_SESSION['user_role']; ?></p>
    <a href="/auth/logout.php">Logout</a>
</body>
</html>
```

**File:** `/client/dashboard.php`
```php
<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/auth.php';
requireLogin();
requireRole('client');
$pageTitle = 'Client Dashboard';
?>
<!DOCTYPE html>
<html>
<head><title><?php echo $pageTitle; ?></title></head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
    <p>Role: <?php echo $_SESSION['user_role']; ?></p>
    <a href="/auth/logout.php">Logout</a>
</body>
</html>
```

**File:** `/partner/dashboard.php`
```php
<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/auth.php';
requireLogin();
requireRole('partner');
$pageTitle = 'Partner Dashboard';

// Get referral code
$db = getDB();
$stmt = $db->prepare("SELECT referral_code FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$referralCode = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html>
<head><title><?php echo $pageTitle; ?></title></head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
    <p>Role: <?php echo $_SESSION['user_role']; ?></p>
    <p>Your Referral Code: <strong><?php echo $referralCode; ?></strong></p>
    <a href="/auth/logout.php">Logout</a>
</body>
</html>
```

### 3. **Verify Database Tables**
Run this SQL to check if tables exist:
```sql
SHOW TABLES LIKE 'users';
SHOW TABLES LIKE 'password_resets';
SHOW TABLES LIKE 'activity_logs';

-- Check users table columns
DESCRIBE users;
```

If `password_resets` doesn't exist, create it:
```sql
CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

If `activity_logs` doesn't exist (optional but recommended):
```sql
CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `activity_type` varchar(50) NOT NULL,
  `description` text,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `activity_type` (`activity_type`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

---

## 🧪 QUICK TEST (2 Minutes)

### **Test 1: Registration**
1. Open browser: `http://yourdomain.com/auth/register.php`
2. Fill form with test data
3. Submit
4. Check for success message
5. Check email inbox

### **Test 2: Login**
1. Open: `http://yourdomain.com/auth/login.php`
2. Login with test account
3. Should redirect to dashboard

### **Test 3: Logout**
1. Click logout link
2. Should redirect to login
3. Try accessing dashboard - should redirect to login

---

## 📧 EMAIL TROUBLESHOOTING

### **Email not sending?**

**Option 1: Use SMTP (Recommended)**
Install PHPMailer:
```bash
composer require phpmailer/phpmailer
```

Update `/includes/functions/email.php`:
```php
use PHPMailer\PHPMailer\PHPMailer;

function sendEmail($to, $subject, $htmlBody) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your@gmail.com';
    $mail->Password = 'app_password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    
    $mail->setFrom('noreply@situneo.com', 'SITUNEO Digital');
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $htmlBody;
    $mail->isHTML(true);
    
    return $mail->send();
}
```

**Option 2: Test mail() function**
```bash
php -r "mail('test@example.com', 'Test', 'Test message');"
```

---

## 🔐 SECURITY CHECKLIST

Before going live:

- [ ] Change `SITE_URL` in email.php
- [ ] Enable HTTPS and set `session.cookie_secure = 1`
- [ ] Test email delivery (send test emails)
- [ ] Create all dashboard pages
- [ ] Verify database tables exist
- [ ] Test on different browsers
- [ ] Test on mobile devices
- [ ] Enable error logging (disable display_errors)
- [ ] Add reCAPTCHA to forms (optional)
- [ ] Set up database backups

---

## 🐛 COMMON ERRORS & FIXES

### **Error: "Call to undefined function getDB()"**
**Fix:** Include database.php at top of file:
```php
require_once __DIR__ . '/../../config/database.php';
```

### **Error: "Headers already sent"**
**Fix:** Remove any whitespace before `<?php` tags

### **Error: "Session not persisting"**
**Fix:** Check session save path is writable:
```bash
chmod 777 /var/lib/php/sessions
```

### **Error: "Redirect loop"**
**Fix:** Create dashboard pages (see Step 2 above)

### **Error: "Email not verified"**
**Fix:** Manually update database:
```sql
UPDATE users SET email_verified = 1 WHERE email = 'test@example.com';
```

---

## 📱 ACCESS URLS

- Login: `/auth/login.php`
- Register Client: `/auth/register.php`
- Register Partner: `/auth/register-partner.php`
- Forgot Password: `/auth/forgot-password.php`
- Logout: `/auth/logout.php`

---

## 💡 PRO TIPS

1. **Development Mode**: Set short session timeout for testing
   ```php
   // In session.php, change:
   ini_set('session.gc_maxlifetime', 300); // 5 minutes
   ```

2. **Email Testing**: Use Mailtrap.io for development email testing

3. **Database Seed**: Create test users manually:
   ```sql
   INSERT INTO users (email, password, full_name, role, email_verified, status, created_at)
   VALUES ('admin@test.com', '$2y$12$...', 'Admin User', 'admin', 1, 'active', NOW());
   ```

4. **Password for Testing**: Use `password_hash('password123', PASSWORD_BCRYPT)`

---

**Questions? Check BATCH-3-AUTH-SUMMARY.md for full documentation**
