<?php
/**
 * Auth Class
 *
 * Handles user authentication and authorization
 * Supports multiple user roles: admin, client, freelancer
 *
 * @package SITUNEO
 * @subpackage Core
 */

class Auth {
    /**
     * Current user
     */
    private static $user = null;

    /**
     * User roles
     */
    const ROLE_ADMIN = 'admin';
    const ROLE_CLIENT = 'client';
    const ROLE_FREELANCER = 'freelancer';

    /**
     * Check if user is logged in
     */
    public static function check() {
        return Session::has('user_id');
    }

    /**
     * Check if user is guest (not logged in)
     */
    public static function guest() {
        return !self::check();
    }

    /**
     * Get current user
     */
    public static function user() {
        if (self::$user !== null) {
            return self::$user;
        }

        if (!self::check()) {
            return null;
        }

        $user_id = Session::get('user_id');

        try {
            $db = Database::getInstance();
            $user = $db->select('users', '*', 'id = :id AND is_active = 1', [':id' => $user_id]);

            if (!empty($user)) {
                self::$user = $user[0];
                return self::$user;
            }
        } catch (Exception $e) {
            error_log('Auth::user() failed: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Get user ID
     */
    public static function id() {
        $user = self::user();
        return $user['id'] ?? null;
    }

    /**
     * Login user
     */
    public static function login($email, $password, $remember = false) {
        try {
            $db = Database::getInstance();

            // Find user by email
            $users = $db->select('users', '*', 'email = :email AND is_active = 1', [
                ':email' => $email
            ]);

            if (empty($users)) {
                return [
                    'success' => false,
                    'message' => 'Email atau password salah'
                ];
            }

            $user = $users[0];

            // Verify password
            if (!Security::verifyPassword($password, $user['password'])) {
                // Log failed attempt
                self::logLoginAttempt($user['id'], false);

                return [
                    'success' => false,
                    'message' => 'Email atau password salah'
                ];
            }

            // Check email verification
            if (!$user['email_verified']) {
                return [
                    'success' => false,
                    'message' => 'Email belum diverifikasi. Silakan cek email Anda.'
                ];
            }

            // Login successful
            Session::set('user_id', $user['id']);
            Session::set('user_role', $user['role']);
            Session::set('user_email', $user['email']);
            Session::regenerate();

            // Log successful attempt
            self::logLoginAttempt($user['id'], true);

            // Remember me
            if ($remember && REMEMBER_ME_ENABLED) {
                $token = Security::generateToken();
                self::saveRememberToken($user['id'], $token);
                Session::setRememberMe($user['id'], $token);
            }

            // Update last login
            $db->update('users', [
                'last_login' => date('Y-m-d H:i:s'),
                'last_login_ip' => Security::getClientIP()
            ], 'id = :id', [':id' => $user['id']]);

            return [
                'success' => true,
                'message' => 'Login berhasil',
                'user' => $user
            ];

        } catch (Exception $e) {
            error_log('Auth::login() failed: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.'
            ];
        }
    }

    /**
     * Logout user
     */
    public static function logout() {
        // Clear remember me token
        if (Session::has('user_id')) {
            self::clearRememberToken(Session::get('user_id'));
        }

        Session::clearRememberMe();
        Session::destroy();
        Session::start(); // Restart session for flash messages

        return true;
    }

    /**
     * Register new user
     */
    public static function register($data) {
        try {
            $db = Database::getInstance();

            // Check if email exists
            $existing = $db->select('users', 'id', 'email = :email', [
                ':email' => $data['email']
            ]);

            if (!empty($existing)) {
                return [
                    'success' => false,
                    'message' => 'Email sudah terdaftar'
                ];
            }

            // Check if username exists
            if (!empty($data['username'])) {
                $existing = $db->select('users', 'id', 'username = :username', [
                    ':username' => $data['username']
                ]);

                if (!empty($existing)) {
                    return [
                        'success' => false,
                        'message' => 'Username sudah digunakan'
                    ];
                }
            }

            // Hash password
            $password_hash = Security::hashPassword($data['password']);

            // Generate UUID
            $uuid = Security::generateUUID();

            // Generate verification token
            $verification_token = Security::generateToken();

            // Insert user
            $user_data = [
                'uuid' => $uuid,
                'username' => $data['username'] ?? null,
                'email' => $data['email'],
                'password' => $password_hash,
                'role' => $data['role'] ?? self::ROLE_CLIENT,
                'email_verified' => 0,
                'verification_token' => $verification_token,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($db->insert('users', $user_data)) {
                $user_id = $db->lastInsertId();

                // Create user profile
                $db->insert('user_profiles', [
                    'user_id' => $user_id,
                    'full_name' => $data['full_name'] ?? '',
                    'phone' => $data['phone'] ?? null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                // If freelancer, create freelancer profile
                if ($user_data['role'] === self::ROLE_FREELANCER) {
                    $referral_code = strtoupper(substr(md5($user_id . time()), 0, 8));

                    $db->insert('freelancer_profiles', [
                        'user_id' => $user_id,
                        'referral_code' => $referral_code,
                        'current_tier' => 'tier_1',
                        'commission_rate' => 30.00,
                        'status' => 'pending', // Need admin approval
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }

                // TODO: Send verification email
                // Email::sendVerification($data['email'], $verification_token);

                return [
                    'success' => true,
                    'message' => 'Registrasi berhasil. Silakan cek email untuk verifikasi.',
                    'user_id' => $user_id
                ];
            }

            return [
                'success' => false,
                'message' => 'Gagal membuat akun. Silakan coba lagi.'
            ];

        } catch (Exception $e) {
            error_log('Auth::register() failed: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.'
            ];
        }
    }

    /**
     * Verify email
     */
    public static function verifyEmail($token) {
        try {
            $db = Database::getInstance();

            $users = $db->select('users', '*', 'verification_token = :token', [
                ':token' => $token
            ]);

            if (empty($users)) {
                return false;
            }

            $db->update('users', [
                'email_verified' => 1,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'verification_token' => null,
                'updated_at' => date('Y-m-d H:i:s')
            ], 'id = :id', [':id' => $users[0]['id']]);

            return true;

        } catch (Exception $e) {
            error_log('Auth::verifyEmail() failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Check user role
     */
    public static function hasRole($role) {
        $user = self::user();
        return $user && $user['role'] === $role;
    }

    /**
     * Check if user is admin
     */
    public static function isAdmin() {
        return self::hasRole(self::ROLE_ADMIN);
    }

    /**
     * Check if user is client
     */
    public static function isClient() {
        return self::hasRole(self::ROLE_CLIENT);
    }

    /**
     * Check if user is freelancer
     */
    public static function isFreelancer() {
        return self::hasRole(self::ROLE_FREELANCER);
    }

    /**
     * Require authentication
     */
    public static function requireAuth() {
        if (!self::check()) {
            Session::flashError('Silakan login terlebih dahulu');
            Session::set('redirect_after_login', Router::currentUrl());
            Router::redirect(LOGIN_URL);
        }
    }

    /**
     * Require specific role
     */
    public static function requireRole($role) {
        self::requireAuth();

        if (!self::hasRole($role)) {
            http_response_code(403);
            die('Access Forbidden');
        }
    }

    /**
     * Require admin
     */
    public static function requireAdmin() {
        self::requireRole(self::ROLE_ADMIN);
    }

    /**
     * Log login attempt
     */
    private static function logLoginAttempt($user_id, $success) {
        try {
            $db = Database::getInstance();

            $db->insert('login_history', [
                'user_id' => $user_id,
                'ip_address' => Security::getClientIP(),
                'user_agent' => Security::getUserAgent(),
                'success' => $success ? 1 : 0,
                'created_at' => date('Y-m-d H:i:s')
            ]);

        } catch (Exception $e) {
            error_log('Auth::logLoginAttempt() failed: ' . $e->getMessage());
        }
    }

    /**
     * Save remember token
     */
    private static function saveRememberToken($user_id, $token) {
        try {
            $db = Database::getInstance();

            $db->insert('user_sessions', [
                'user_id' => $user_id,
                'token' => hash('sha256', $token),
                'ip_address' => Security::getClientIP(),
                'user_agent' => Security::getUserAgent(),
                'expires_at' => date('Y-m-d H:i:s', time() + REMEMBER_ME_DURATION),
                'created_at' => date('Y-m-d H:i:s')
            ]);

        } catch (Exception $e) {
            error_log('Auth::saveRememberToken() failed: ' . $e->getMessage());
        }
    }

    /**
     * Clear remember token
     */
    private static function clearRememberToken($user_id) {
        try {
            $db = Database::getInstance();
            $db->delete('user_sessions', 'user_id = :user_id', [':user_id' => $user_id]);
        } catch (Exception $e) {
            error_log('Auth::clearRememberToken() failed: ' . $e->getMessage());
        }
    }

    /**
     * Attempt remember me login
     */
    public static function attemptRememberMe() {
        $remember = Session::getRememberMe();

        if (!$remember) {
            return false;
        }

        try {
            $db = Database::getInstance();

            $sessions = $db->select('user_sessions', '*',
                'user_id = :user_id AND token = :token AND expires_at > NOW()',
                [
                    ':user_id' => $remember['user_id'],
                    ':token' => hash('sha256', $remember['token'])
                ]
            );

            if (!empty($sessions)) {
                $user = $db->select('users', '*', 'id = :id AND is_active = 1', [
                    ':id' => $remember['user_id']
                ]);

                if (!empty($user)) {
                    Session::set('user_id', $user[0]['id']);
                    Session::set('user_role', $user[0]['role']);
                    Session::set('user_email', $user[0]['email']);
                    return true;
                }
            }

        } catch (Exception $e) {
            error_log('Auth::attemptRememberMe() failed: ' . $e->getMessage());
        }

        return false;
    }

    /**
     * Reset user cache
     */
    public static function resetCache() {
        self::$user = null;
    }
}
