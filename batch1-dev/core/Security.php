<?php
/**
 * Security Class
 *
 * Handles security features:
 * - CSRF Protection
 * - XSS Filtering
 * - Input Sanitization
 * - SQL Injection Prevention
 * - Rate Limiting
 *
 * @package SITUNEO
 * @subpackage Core
 */

class Security {
    /**
     * Generate random token
     */
    public static function generateToken($length = 32) {
        return bin2hex(random_bytes($length));
    }

    /**
     * Generate CSRF token
     */
    public static function generateCSRFToken() {
        $token = self::generateToken();
        Session::set(CSRF_TOKEN_NAME, $token);
        Session::set(CSRF_TOKEN_NAME . '_time', time());
        return $token;
    }

    /**
     * Get current CSRF token
     */
    public static function getCSRFToken() {
        if (!Session::has(CSRF_TOKEN_NAME)) {
            return self::generateCSRFToken();
        }

        // Check if token expired
        $token_time = Session::get(CSRF_TOKEN_NAME . '_time', 0);
        if (time() - $token_time > CSRF_TOKEN_EXPIRE) {
            return self::generateCSRFToken();
        }

        return Session::get(CSRF_TOKEN_NAME);
    }

    /**
     * Verify CSRF token
     */
    public static function verifyCSRFToken($token) {
        if (!Session::has(CSRF_TOKEN_NAME)) {
            return false;
        }

        $stored_token = Session::get(CSRF_TOKEN_NAME);
        return hash_equals($stored_token, $token);
    }

    /**
     * Generate CSRF input field
     */
    public static function csrfField() {
        $token = self::getCSRFToken();
        return sprintf(
            '<input type="hidden" name="%s" value="%s">',
            CSRF_TOKEN_NAME,
            htmlspecialchars($token, ENT_QUOTES, 'UTF-8')
        );
    }

    /**
     * Verify CSRF token from POST request
     */
    public static function verifyRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST[CSRF_TOKEN_NAME] ?? '';
            if (!self::verifyCSRFToken($token)) {
                http_response_code(403);
                die('CSRF token validation failed');
            }
        }
    }

    /**
     * Sanitize string input
     */
    public static function sanitize($input, $type = 'string') {
        if (is_array($input)) {
            return array_map(function($item) use ($type) {
                return self::sanitize($item, $type);
            }, $input);
        }

        switch ($type) {
            case 'string':
                return trim(htmlspecialchars($input, ENT_QUOTES, 'UTF-8'));

            case 'email':
                return filter_var(trim($input), FILTER_SANITIZE_EMAIL);

            case 'url':
                return filter_var(trim($input), FILTER_SANITIZE_URL);

            case 'int':
                return filter_var($input, FILTER_SANITIZE_NUMBER_INT);

            case 'float':
                return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            case 'html':
                // Allow some HTML tags
                $allowed_tags = '<p><br><strong><em><u><ul><ol><li><a><img><h1><h2><h3><h4><h5><h6>';
                return strip_tags($input, $allowed_tags);

            case 'plain':
                // Remove all HTML tags
                return strip_tags($input);

            default:
                return trim($input);
        }
    }

    /**
     * Clean input from XSS
     */
    public static function xssClean($data) {
        if (is_array($data)) {
            return array_map([self::class, 'xssClean'], $data);
        }

        // Convert all special characters
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');

        // Remove javascript: and on* attributes
        $data = preg_replace('/javascript:/i', '', $data);
        $data = preg_replace('/on\w+\s*=/i', '', $data);

        return $data;
    }

    /**
     * Escape output for HTML
     */
    public static function escape($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Escape for JavaScript
     */
    public static function escapeJS($string) {
        return json_encode($string, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }

    /**
     * Generate secure password hash
     */
    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verify password against hash
     */
    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    /**
     * Validate password strength
     */
    public static function validatePasswordStrength($password) {
        $errors = [];

        if (strlen($password) < PASSWORD_MIN_LENGTH) {
            $errors[] = 'Password minimal ' . PASSWORD_MIN_LENGTH . ' karakter';
        }

        if (PASSWORD_REQUIRE_UPPERCASE && !preg_match('/[A-Z]/', $password)) {
            $errors[] = 'Password harus mengandung huruf besar';
        }

        if (PASSWORD_REQUIRE_LOWERCASE && !preg_match('/[a-z]/', $password)) {
            $errors[] = 'Password harus mengandung huruf kecil';
        }

        if (PASSWORD_REQUIRE_NUMBER && !preg_match('/[0-9]/', $password)) {
            $errors[] = 'Password harus mengandung angka';
        }

        if (PASSWORD_REQUIRE_SPECIAL && !preg_match('/[^A-Za-z0-9]/', $password)) {
            $errors[] = 'Password harus mengandung karakter spesial';
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors
        ];
    }

    /**
     * Rate limiting check
     */
    public static function checkRateLimit($key, $max_attempts, $window_seconds) {
        if (!RATE_LIMIT_ENABLED) {
            return true;
        }

        $cache_key = 'rate_limit_' . $key;
        $attempts = Session::get($cache_key, []);

        // Clean old attempts outside window
        $current_time = time();
        $attempts = array_filter($attempts, function($timestamp) use ($current_time, $window_seconds) {
            return ($current_time - $timestamp) < $window_seconds;
        });

        // Check if limit exceeded
        if (count($attempts) >= $max_attempts) {
            return false;
        }

        // Add current attempt
        $attempts[] = $current_time;
        Session::set($cache_key, $attempts);

        return true;
    }

    /**
     * Get rate limit info
     */
    public static function getRateLimitInfo($key, $window_seconds) {
        $cache_key = 'rate_limit_' . $key;
        $attempts = Session::get($cache_key, []);

        // Clean old attempts
        $current_time = time();
        $attempts = array_filter($attempts, function($timestamp) use ($current_time, $window_seconds) {
            return ($current_time - $timestamp) < $window_seconds;
        });

        return [
            'attempts' => count($attempts),
            'remaining_time' => !empty($attempts) ? $window_seconds - ($current_time - min($attempts)) : 0
        ];
    }

    /**
     * Encrypt data
     */
    public static function encrypt($data) {
        $key = ENCRYPTION_KEY;
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    /**
     * Decrypt data
     */
    public static function decrypt($data) {
        $key = ENCRYPTION_KEY;
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
    }

    /**
     * Generate random string
     */
    public static function randomString($length = 16, $type = 'alnum') {
        switch ($type) {
            case 'alpha':
                $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'numeric':
                $pool = '0123456789';
                break;
            case 'alnum':
            default:
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
        }

        return substr(str_shuffle(str_repeat($pool, ceil($length / strlen($pool)))), 0, $length);
    }

    /**
     * Generate UUID v4
     */
    public static function generateUUID() {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    /**
     * Generate slug from string
     */
    public static function generateSlug($string) {
        // Convert to lowercase
        $string = strtolower($string);

        // Replace spaces with hyphens
        $string = str_replace(' ', '-', $string);

        // Remove special characters
        $string = preg_replace('/[^a-z0-9\-]/', '', $string);

        // Remove consecutive hyphens
        $string = preg_replace('/-+/', '-', $string);

        // Trim hyphens from ends
        $string = trim($string, '-');

        return $string;
    }

    /**
     * Check if request is AJAX
     */
    public static function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    /**
     * Check if request is POST
     */
    public static function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Check if request is GET
     */
    public static function isGet() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    /**
     * Get client IP address
     */
    public static function getClientIP() {
        $ip_keys = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        ];

        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);

                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }

        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }

    /**
     * Get user agent
     */
    public static function getUserAgent() {
        return $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
    }
}
