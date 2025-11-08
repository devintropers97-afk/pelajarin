<?php
/**
 * Session Class
 *
 * Manages PHP sessions with security features
 *
 * @package SITUNEO
 * @subpackage Core
 */

class Session {
    /**
     * Session started flag
     */
    private static $started = false;

    /**
     * Start session
     */
    public static function start() {
        if (self::$started) {
            return;
        }

        // Configure session settings
        ini_set('session.cookie_httponly', '1');
        ini_set('session.use_only_cookies', '1');
        ini_set('session.cookie_secure', SESSION_SECURE ? '1' : '0');
        ini_set('session.cookie_samesite', SESSION_SAMESITE);
        ini_set('session.gc_maxlifetime', SESSION_LIFETIME);

        // Set session name
        session_name(SESSION_NAME);

        // Set session cookie parameters
        session_set_cookie_params([
            'lifetime' => SESSION_LIFETIME,
            'path' => SESSION_PATH,
            'domain' => SESSION_DOMAIN,
            'secure' => SESSION_SECURE,
            'httponly' => SESSION_HTTPONLY,
            'samesite' => SESSION_SAMESITE
        ]);

        // Start session if not started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        self::$started = true;

        // Regenerate session ID periodically
        if (!self::has('_session_created')) {
            self::set('_session_created', time());
            session_regenerate_id(true);
        } elseif (time() - self::get('_session_created') > 1800) { // 30 minutes
            self::set('_session_created', time());
            session_regenerate_id(true);
        }
    }

    /**
     * Set session data
     */
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * Get session data
     */
    public static function get($key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Check if session key exists
     */
    public static function has($key) {
        return isset($_SESSION[$key]);
    }

    /**
     * Delete session key
     */
    public static function delete($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Clear all session data
     */
    public static function clear() {
        $_SESSION = [];
    }

    /**
     * Destroy session
     */
    public static function destroy() {
        if (self::$started) {
            self::clear();

            // Delete session cookie
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
            self::$started = false;
        }
    }

    /**
     * Flash message (one-time message)
     */
    public static function flash($key, $value = null) {
        if ($value === null) {
            // Get flash message
            $message = self::get('_flash_' . $key);
            self::delete('_flash_' . $key);
            return $message;
        } else {
            // Set flash message
            self::set('_flash_' . $key, $value);
        }
    }

    /**
     * Check if flash message exists
     */
    public static function hasFlash($key) {
        return self::has('_flash_' . $key);
    }

    /**
     * Set success flash message
     */
    public static function flashSuccess($message) {
        self::flash('success', $message);
    }

    /**
     * Set error flash message
     */
    public static function flashError($message) {
        self::flash('error', $message);
    }

    /**
     * Set warning flash message
     */
    public static function flashWarning($message) {
        self::flash('warning', $message);
    }

    /**
     * Set info flash message
     */
    public static function flashInfo($message) {
        self::flash('info', $message);
    }

    /**
     * Get success flash message
     */
    public static function getSuccess() {
        return self::flash('success');
    }

    /**
     * Get error flash message
     */
    public static function getError() {
        return self::flash('error');
    }

    /**
     * Get warning flash message
     */
    public static function getWarning() {
        return self::flash('warning');
    }

    /**
     * Get info flash message
     */
    public static function getInfo() {
        return self::flash('info');
    }

    /**
     * Store old input values (for form repopulation on error)
     */
    public static function flashInput($data) {
        self::set('_old_input', $data);
    }

    /**
     * Get old input value
     */
    public static function old($key, $default = '') {
        $old_input = self::get('_old_input', []);
        return $old_input[$key] ?? $default;
    }

    /**
     * Clear old input
     */
    public static function clearOldInput() {
        self::delete('_old_input');
    }

    /**
     * Get session ID
     */
    public static function id() {
        return session_id();
    }

    /**
     * Regenerate session ID
     */
    public static function regenerate() {
        return session_regenerate_id(true);
    }

    /**
     * Get all session data
     */
    public static function all() {
        return $_SESSION;
    }

    /**
     * Set remember me cookie
     */
    public static function setRememberMe($user_id, $token) {
        if (!REMEMBER_ME_ENABLED) {
            return false;
        }

        $expire = time() + REMEMBER_ME_DURATION;

        // Set cookie
        setcookie(
            'remember_token',
            $token,
            $expire,
            SESSION_PATH,
            SESSION_DOMAIN,
            SESSION_SECURE,
            SESSION_HTTPONLY
        );

        setcookie(
            'remember_user',
            $user_id,
            $expire,
            SESSION_PATH,
            SESSION_DOMAIN,
            SESSION_SECURE,
            SESSION_HTTPONLY
        );

        return true;
    }

    /**
     * Get remember me cookie
     */
    public static function getRememberMe() {
        if (!REMEMBER_ME_ENABLED) {
            return null;
        }

        if (isset($_COOKIE['remember_token']) && isset($_COOKIE['remember_user'])) {
            return [
                'user_id' => $_COOKIE['remember_user'],
                'token' => $_COOKIE['remember_token']
            ];
        }

        return null;
    }

    /**
     * Clear remember me cookie
     */
    public static function clearRememberMe() {
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, SESSION_PATH, SESSION_DOMAIN, SESSION_SECURE, SESSION_HTTPONLY);
        }

        if (isset($_COOKIE['remember_user'])) {
            setcookie('remember_user', '', time() - 3600, SESSION_PATH, SESSION_DOMAIN, SESSION_SECURE, SESSION_HTTPONLY);
        }
    }

    /**
     * Check if session is valid (not expired)
     */
    public static function isValid() {
        if (!self::has('_session_created')) {
            return false;
        }

        $created = self::get('_session_created');
        return (time() - $created) < SESSION_LIFETIME;
    }

    /**
     * Increment a value in session
     */
    public static function increment($key, $amount = 1) {
        $value = self::get($key, 0);
        self::set($key, $value + $amount);
        return $value + $amount;
    }

    /**
     * Decrement a value in session
     */
    public static function decrement($key, $amount = 1) {
        $value = self::get($key, 0);
        self::set($key, $value - $amount);
        return $value - $amount;
    }

    /**
     * Push a value onto a session array
     */
    public static function push($key, $value) {
        $array = self::get($key, []);
        $array[] = $value;
        self::set($key, $array);
    }

    /**
     * Pull a value from session and delete it
     */
    public static function pull($key, $default = null) {
        $value = self::get($key, $default);
        self::delete($key);
        return $value;
    }
}
