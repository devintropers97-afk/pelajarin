<?php
/**
 * SITUNEO DIGITAL - Security Functions
 * CSRF, XSS Protection, Rate Limiting
 */

/**
 * Generate CSRF Token
 */
function generateCSRFToken() {
    if (empty($_SESSION[CSRF_TOKEN_NAME])) {
        $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
    }
    return $_SESSION[CSRF_TOKEN_NAME];
}

/**
 * Verify CSRF Token
 */
function verifyCSRFToken($token) {
    if (empty($_SESSION[CSRF_TOKEN_NAME]) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION[CSRF_TOKEN_NAME], $token);
}

/**
 * Get CSRF Token HTML Input
 */
function csrf_field() {
    $token = generateCSRFToken();
    return '<input type="hidden" name="csrf_token" value="' . $token . '">';
}

/**
 * XSS Filter
 */
function xss_clean($data) {
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key] = xss_clean($value);
        }
        return $data;
    }

    // Remove null bytes
    $data = str_replace(chr(0), '', $data);

    // Fix &entity\n;
    $data = str_replace('&amp;', '&', $data);
    $data = preg_replace('/&\#([0-9]+);?/', '&#\1;', $data);
    $data = preg_replace('/&\#[Xx]([0-9A-Fa-f]+);?/', '&#x\1;', $data);

    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

    // Remove namespaced elements
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

    return $data;
}

/**
 * Rate Limiting
 */
function checkRateLimit($identifier, $maxAttempts = 5, $timeWindow = 900) {
    $key = 'rate_limit_' . $identifier;

    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = [
            'attempts' => 1,
            'first_attempt' => time()
        ];
        return true;
    }

    $elapsed = time() - $_SESSION[$key]['first_attempt'];

    // Reset if time window expired
    if ($elapsed > $timeWindow) {
        $_SESSION[$key] = [
            'attempts' => 1,
            'first_attempt' => time()
        ];
        return true;
    }

    // Increment attempts
    $_SESSION[$key]['attempts']++;

    // Check if exceeded
    if ($_SESSION[$key]['attempts'] > $maxAttempts) {
        $remainingTime = $timeWindow - $elapsed;
        return [
            'allowed' => false,
            'remaining_time' => $remainingTime,
            'message' => 'Terlalu banyak percobaan. Silakan coba lagi dalam ' . ceil($remainingTime / 60) . ' menit.'
        ];
    }

    return true;
}

/**
 * Reset Rate Limit
 */
function resetRateLimit($identifier) {
    $key = 'rate_limit_' . $identifier;
    unset($_SESSION[$key]);
}

/**
 * SQL Injection Prevention (sudah di-handle oleh PDO prepared statements)
 * Ini fungsi tambahan untuk validasi input
 */
function preventSQLInjection($input) {
    // Remove SQL keywords
    $sql_keywords = ['SELECT', 'INSERT', 'UPDATE', 'DELETE', 'DROP', 'CREATE', 'ALTER', 'EXEC', 'EXECUTE', 'UNION', 'DECLARE'];

    foreach ($sql_keywords as $keyword) {
        $input = preg_replace('/' . $keyword . '/i', '', $input);
    }

    return $input;
}

/**
 * Validate Password Strength
 */
function validatePasswordStrength($password) {
    $errors = [];

    if (strlen($password) < PASSWORD_MIN_LENGTH) {
        $errors[] = 'Password minimal ' . PASSWORD_MIN_LENGTH . ' karakter';
    }

    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = 'Password harus mengandung huruf kecil';
    }

    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = 'Password harus mengandung huruf besar';
    }

    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = 'Password harus mengandung angka';
    }

    return [
        'valid' => empty($errors),
        'errors' => $errors
    ];
}

/**
 * Secure File Upload Validation
 */
function validateSecureUpload($file, $allowedTypes = [], $maxSize = null) {
    // Check if file exists
    if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
        return ['valid' => false, 'error' => 'No file uploaded'];
    }

    // Check upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['valid' => false, 'error' => 'Upload error code: ' . $file['error']];
    }

    // Check file size
    $maxSize = $maxSize ?? MAX_UPLOAD_SIZE;
    if ($file['size'] > $maxSize) {
        return ['valid' => false, 'error' => 'File terlalu besar. Maksimal: ' . formatFileSize($maxSize)];
    }

    // Check MIME type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!empty($allowedTypes) && !in_array($mimeType, $allowedTypes)) {
        return ['valid' => false, 'error' => 'Tipe file tidak diizinkan'];
    }

    // Check file extension
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $dangerousExtensions = ['php', 'phtml', 'php3', 'php4', 'php5', 'exe', 'sh', 'bat', 'com', 'pif', 'scr'];

    if (in_array($extension, $dangerousExtensions)) {
        return ['valid' => false, 'error' => 'Ekstensi file berbahaya'];
    }

    // Check double extension
    if (substr_count($file['name'], '.') > 1) {
        return ['valid' => false, 'error' => 'Nama file tidak valid'];
    }

    return ['valid' => true, 'mime' => $mimeType, 'extension' => $extension];
}

/**
 * Sanitize Filename
 */
function sanitizeFilename($filename) {
    // Remove special characters
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);

    // Remove multiple dots
    $filename = preg_replace('/\.+/', '.', $filename);

    // Remove leading/trailing dots and spaces
    $filename = trim($filename, '. ');

    return $filename;
}

/**
 * Prevent Directory Traversal
 */
function preventDirectoryTraversal($path) {
    // Remove ../ and ..\
    $path = str_replace(['../', '..\\'], '', $path);

    // Remove leading slashes
    $path = ltrim($path, '/\\');

    return $path;
}

/**
 * Secure Session Start
 */
function secureSessionStart() {
    if (session_status() === PHP_SESSION_NONE) {
        // Session cookie parameters
        $cookieParams = [
            'lifetime' => SESSION_LIFETIME,
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'],
            'secure' => true, // HTTPS only
            'httponly' => true, // No JavaScript access
            'samesite' => 'Strict' // CSRF protection
        ];

        session_set_cookie_params($cookieParams);
        session_name(SESSION_NAME);
        session_start();

        // Regenerate session ID periodically
        if (!isset($_SESSION['last_regeneration'])) {
            $_SESSION['last_regeneration'] = time();
        } elseif (time() - $_SESSION['last_regeneration'] > 1800) { // 30 minutes
            session_regenerate_id(true);
            $_SESSION['last_regeneration'] = time();
        }
    }
}

/**
 * Destroy Session Securely
 */
function secureSessionDestroy() {
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    session_destroy();
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Check user role
 */
function hasRole($role) {
    return isLoggedIn() && isset($_SESSION['user_role']) && $_SESSION['user_role'] === $role;
}

/**
 * Check if user is admin
 */
function isAdmin() {
    return hasRole('admin');
}

/**
 * Check if user is client
 */
function isClient() {
    return hasRole('client');
}

/**
 * Check if user is freelancer
 */
function isFreelancer() {
    return hasRole('freelancer');
}

/**
 * Require Login
 */
function requireLogin($redirectTo = '/auth/login.php') {
    if (!isLoggedIn()) {
        $_SESSION['redirect_after_login'] = getCurrentURL();
        redirect($redirectTo);
    }
}

/**
 * Require Role
 */
function requireRole($role, $redirectTo = '/') {
    requireLogin();

    if (!hasRole($role)) {
        $_SESSION['error'] = 'Anda tidak memiliki akses ke halaman ini.';
        redirect($redirectTo);
    }
}

/**
 * Require Admin
 */
function requireAdmin() {
    requireRole('admin', '/');
}

/**
 * Log Activity
 */
function logActivity($userId, $action, $description = null) {
    global $pdo;

    try {
        $sql = "INSERT INTO user_activities (user_id, action, description, ip_address, user_agent)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $userId,
            $action,
            $description,
            getUserIP(),
            getUserAgent()
        ]);

        return true;
    } catch (PDOException $e) {
        error_log("Failed to log activity: " . $e->getMessage());
        return false;
    }
}
