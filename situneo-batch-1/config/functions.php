<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Core Functions
 * Global helper functions
 * ========================================
 */

/**
 * Sanitize input string
 */
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Redirect to URL
 */
function redirect($url) {
    header('Location: ' . $url);
    exit();
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Require login (redirect if not logged in)
 */
function requireLogin() {
    if (!isLoggedIn()) {
        redirect(SITE_URL . '/auth/login.php');
    }
}

/**
 * Get current user data
 */
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }

    try {
        $db = getDB();
        $stmt = $db->prepare("
            SELECT u.*, p.*
            FROM users u
            LEFT JOIN user_profiles p ON u.id = p.user_id
            WHERE u.id = ?
        ");
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        return null;
    }
}

/**
 * Check user role
 */
function hasRole($role) {
    if (!isLoggedIn()) {
        return false;
    }
    return $_SESSION['user_role'] === $role;
}

/**
 * Require specific role
 */
function requireRole($role) {
    requireLogin();
    if (!hasRole($role)) {
        redirect(SITE_URL . '/index.php?error=unauthorized');
    }
}

/**
 * Format currency (Indonesian Rupiah)
 */
function formatRupiah($amount) {
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

/**
 * Format date to Indonesian format
 */
function formatDate($date, $format = 'd M Y') {
    $months = [
        1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
        5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
        9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
    ];

    $timestamp = is_numeric($date) ? $date : strtotime($date);
    $formatted = date($format, $timestamp);

    // Replace English month names with Indonesian
    foreach ($months as $num => $name) {
        $formatted = str_replace(date('M', mktime(0, 0, 0, $num, 1)), $name, $formatted);
    }

    return $formatted;
}

/**
 * Time ago function (berapa lama yang lalu)
 */
function timeAgo($datetime) {
    $timestamp = is_numeric($datetime) ? $datetime : strtotime($datetime);
    $diff = time() - $timestamp;

    if ($diff < 60) {
        return $diff . ' detik yang lalu';
    } elseif ($diff < 3600) {
        $mins = floor($diff / 60);
        return $mins . ' menit yang lalu';
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . ' jam yang lalu';
    } elseif ($diff < 2592000) {
        $days = floor($diff / 86400);
        return $days . ' hari yang lalu';
    } else {
        return formatDate($datetime);
    }
}

/**
 * Generate random string
 */
function generateRandomString($length = 32) {
    return bin2hex(random_bytes($length / 2));
}

/**
 * Generate order number
 */
function generateOrderNumber() {
    return 'ORD-' . date('Ymd') . '-' . strtoupper(substr(generateRandomString(8), 0, 6));
}

/**
 * Generate invoice number
 */
function generateInvoiceNumber() {
    return 'INV-' . date('Ymd') . '-' . strtoupper(substr(generateRandomString(8), 0, 6));
}

/**
 * Send email (basic function, can be extended with PHPMailer)
 */
function sendEmail($to, $subject, $message, $headers = '') {
    if (empty($headers)) {
        $headers = "From: " . COMPANY_NAME . " <" . COMPANY_EMAIL . ">\r\n";
        $headers .= "Reply-To: " . COMPANY_EMAIL . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    }

    return mail($to, $subject, $message, $headers);
}

/**
 * Log activity
 */
function logActivity($action, $description = null, $user_id = null) {
    try {
        $db = getDB();

        if ($user_id === null && isLoggedIn()) {
            $user_id = $_SESSION['user_id'];
        }

        $stmt = $db->prepare("
            INSERT INTO activity_logs (user_id, action, description, ip_address, user_agent)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $user_id,
            $action,
            $description,
            $_SERVER['REMOTE_ADDR'] ?? null,
            $_SERVER['HTTP_USER_AGENT'] ?? null
        ]);

        return true;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Flash message system
 */
function setFlash($type, $message) {
    $_SESSION['flash_type'] = $type; // success, error, warning, info
    $_SESSION['flash_message'] = $message;
}

function getFlash() {
    if (isset($_SESSION['flash_message'])) {
        $flash = [
            'type' => $_SESSION['flash_type'],
            'message' => $_SESSION['flash_message']
        ];
        unset($_SESSION['flash_type']);
        unset($_SESSION['flash_message']);
        return $flash;
    }
    return null;
}

/**
 * Check CSRF token
 */
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = generateRandomString(64);
    }
    return $_SESSION['csrf_token'];
}

function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Pagination helper
 */
function getPagination($total, $current_page = 1, $per_page = ITEMS_PER_PAGE) {
    $total_pages = ceil($total / $per_page);
    $offset = ($current_page - 1) * $per_page;

    return [
        'total' => $total,
        'per_page' => $per_page,
        'current_page' => $current_page,
        'total_pages' => $total_pages,
        'offset' => $offset,
        'has_prev' => $current_page > 1,
        'has_next' => $current_page < $total_pages
    ];
}

/**
 * Get setting value
 */
function getSetting($key, $default = null) {
    try {
        $db = getDB();
        $stmt = $db->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
        $stmt->execute([$key]);
        $result = $stmt->fetch();

        return $result ? $result['setting_value'] : $default;
    } catch (PDOException $e) {
        return $default;
    }
}

/**
 * Update setting value
 */
function updateSetting($key, $value) {
    try {
        $db = getDB();
        $stmt = $db->prepare("
            INSERT INTO settings (setting_key, setting_value)
            VALUES (?, ?)
            ON DUPLICATE KEY UPDATE setting_value = ?
        ");
        $stmt->execute([$key, $value, $value]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Upload file helper
 */
function uploadFile($file, $destination_dir, $allowed_types = null) {
    if (!isset($file['error']) || is_array($file['error'])) {
        return ['success' => false, 'message' => 'Invalid file upload'];
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'Upload error: ' . $file['error']];
    }

    if ($file['size'] > MAX_UPLOAD_SIZE) {
        return ['success' => false, 'message' => 'File too large. Maximum ' . (MAX_UPLOAD_SIZE / 1024 / 1024) . ' MB'];
    }

    if ($allowed_types && !in_array($file['type'], $allowed_types)) {
        return ['success' => false, 'message' => 'File type not allowed'];
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = generateRandomString(16) . '.' . $extension;
    $destination = $destination_dir . '/' . $filename;

    if (!is_dir($destination_dir)) {
        mkdir($destination_dir, 0755, true);
    }

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return ['success' => true, 'filename' => $filename, 'path' => $destination];
    }

    return ['success' => false, 'message' => 'Failed to move uploaded file'];
}
