<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Input Validation
 * Validation functions for user input
 * ========================================
 */

// Validate email format and uniqueness
function validateEmail($email, $checkUnique = false, $excludeUserId = null) {
    $errors = [];

    // Check if email is empty
    if (empty($email)) {
        $errors[] = 'Email is required';
        return $errors;
    }

    // Check email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
        return $errors;
    }

    // Check if email is unique (if required)
    if ($checkUnique) {
        require_once __DIR__ . '/../../config/database.php';
        $db = getDB();

        if ($excludeUserId) {
            $stmt = $db->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
            $stmt->execute([$email, $excludeUserId]);
        } else {
            $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
        }

        if ($stmt->fetch()) {
            $errors[] = 'Email already registered';
        }
    }

    return $errors;
}

// Validate password strength
function validatePassword($password, $confirmPassword = null) {
    $errors = [];

    // Check if password is empty
    if (empty($password)) {
        $errors[] = 'Password is required';
        return $errors;
    }

    // Check minimum length
    if (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters';
    }

    // Check for uppercase letter
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = 'Password must contain at least one uppercase letter';
    }

    // Check for lowercase letter
    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = 'Password must contain at least one lowercase letter';
    }

    // Check for number
    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = 'Password must contain at least one number';
    }

    // Check password confirmation
    if ($confirmPassword !== null && $password !== $confirmPassword) {
        $errors[] = 'Passwords do not match';
    }

    return $errors;
}

// Validate full name
function validateFullName($name) {
    $errors = [];

    // Check if name is empty
    if (empty($name)) {
        $errors[] = 'Full name is required';
        return $errors;
    }

    // Check minimum length
    if (strlen($name) < 3) {
        $errors[] = 'Full name must be at least 3 characters';
    }

    // Check maximum length
    if (strlen($name) > 100) {
        $errors[] = 'Full name is too long (max 100 characters)';
    }

    // Check for valid characters (letters, spaces, hyphens, apostrophes)
    if (!preg_match("/^[a-zA-Z\s\-']+$/", $name)) {
        $errors[] = 'Full name can only contain letters, spaces, hyphens, and apostrophes';
    }

    return $errors;
}

// Validate phone number
function validatePhone($phone, $required = false) {
    $errors = [];

    // Check if required
    if ($required && empty($phone)) {
        $errors[] = 'Phone number is required';
        return $errors;
    }

    // Skip validation if empty and not required
    if (empty($phone)) {
        return $errors;
    }

    // Remove common separators
    $cleanPhone = preg_replace('/[\s\-\(\)]/', '', $phone);

    // Check format (Indonesian phone numbers)
    if (!preg_match('/^(\+?62|0)[0-9]{9,12}$/', $cleanPhone)) {
        $errors[] = 'Invalid phone number format';
    }

    return $errors;
}

// Validate referral code
function validateReferralCode($code, $checkExists = false) {
    $errors = [];

    // Check if code is empty (optional field)
    if (empty($code)) {
        return $errors;
    }

    // Check format (10 alphanumeric characters)
    if (!preg_match('/^[A-Z0-9]{10}$/', $code)) {
        $errors[] = 'Invalid referral code format (must be 10 alphanumeric characters)';
        return $errors;
    }

    // Check if code exists (if required)
    if ($checkExists) {
        require_once __DIR__ . '/../../config/database.php';
        $db = getDB();

        $stmt = $db->prepare("SELECT id FROM users WHERE referral_code = ? AND role = 'partner' AND status = 'active'");
        $stmt->execute([$code]);

        if (!$stmt->fetch()) {
            $errors[] = 'Invalid referral code';
        }
    }

    return $errors;
}

// Sanitize input
function sanitizeInput($data) {
    if (is_array($data)) {
        return array_map('sanitizeInput', $data);
    }

    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

// Validate token format
function validateToken($token) {
    if (empty($token)) {
        return false;
    }

    // Check if token is hexadecimal (64 characters)
    return preg_match('/^[a-f0-9]{64}$/', $token);
}

// Check if token is expired
function isTokenExpired($createdAt, $expiryHours = 24) {
    $createdTime = strtotime($createdAt);
    $expiryTime = $createdTime + ($expiryHours * 3600);

    return time() > $expiryTime;
}

// Validate form CSRF token
function validateCSRFFormToken() {
    if (!isset($_POST['csrf_token'])) {
        return false;
    }

    require_once __DIR__ . '/../session.php';
    return verifyCSRFToken($_POST['csrf_token']);
}

// General form validation
function validateForm($data, $rules) {
    $errors = [];

    foreach ($rules as $field => $rule) {
        $value = $data[$field] ?? '';

        // Required field check
        if (isset($rule['required']) && $rule['required'] && empty($value)) {
            $errors[$field][] = ucfirst($field) . ' is required';
            continue;
        }

        // Skip further validation if field is empty and not required
        if (empty($value) && !isset($rule['required'])) {
            continue;
        }

        // Email validation
        if (isset($rule['email']) && $rule['email']) {
            $emailErrors = validateEmail($value, $rule['unique'] ?? false);
            if (!empty($emailErrors)) {
                $errors[$field] = array_merge($errors[$field] ?? [], $emailErrors);
            }
        }

        // Minimum length
        if (isset($rule['min']) && strlen($value) < $rule['min']) {
            $errors[$field][] = ucfirst($field) . ' must be at least ' . $rule['min'] . ' characters';
        }

        // Maximum length
        if (isset($rule['max']) && strlen($value) > $rule['max']) {
            $errors[$field][] = ucfirst($field) . ' must not exceed ' . $rule['max'] . ' characters';
        }

        // Pattern match
        if (isset($rule['pattern']) && !preg_match($rule['pattern'], $value)) {
            $errors[$field][] = $rule['message'] ?? ucfirst($field) . ' format is invalid';
        }
    }

    return $errors;
}

// Sanitize filename for uploads
function sanitizeFilename($filename) {
    // Remove any path components
    $filename = basename($filename);

    // Remove special characters
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);

    // Remove multiple underscores
    $filename = preg_replace('/_+/', '_', $filename);

    return strtolower($filename);
}
