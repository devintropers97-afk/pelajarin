<?php
/**
 * ========================================
 * SITUNEO DIGITAL - User Management Functions
 * CRUD operations for users
 * ========================================
 */

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../auth.php';

// Create new user
function createUser($data) {
    try {
        $db = getDB();

        // Hash password
        $hashedPassword = hashPassword($data['password']);

        // Generate verification token if email verification is required
        $verificationToken = generateSecureToken(32);

        // Generate referral code for partners
        $referralCode = null;
        if ($data['role'] === 'partner') {
            $referralCode = generateReferralCode();
        }

        // Prepare SQL
        $sql = "INSERT INTO users (
            email,
            password,
            full_name,
            role,
            phone,
            company_name,
            referral_code,
            referred_by,
            email_verification_token,
            email_verified,
            status,
            created_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $db->prepare($sql);

        $result = $stmt->execute([
            $data['email'],
            $hashedPassword,
            $data['full_name'],
            $data['role'] ?? 'client',
            $data['phone'] ?? null,
            $data['company_name'] ?? null,
            $referralCode,
            $data['referred_by'] ?? null,
            $verificationToken,
            0, // email_verified = 0 by default
            'active'
        ]);

        if ($result) {
            $userId = $db->lastInsertId();

            // Log activity
            logActivity($userId, 'user_registered', 'User registered with email: ' . $data['email']);

            return [
                'success' => true,
                'user_id' => $userId,
                'verification_token' => $verificationToken
            ];
        }

        return ['success' => false, 'error' => 'Failed to create user'];

    } catch (PDOException $e) {
        error_log("User creation error: " . $e->getMessage());
        return ['success' => false, 'error' => 'Database error: ' . $e->getMessage()];
    }
}

// Get user by email
function getUserByEmail($email) {
    try {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Get user error: " . $e->getMessage());
        return null;
    }
}

// Get user by ID
function getUserByIdFull($userId) {
    try {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Get user error: " . $e->getMessage());
        return null;
    }
}

// Update user
function updateUser($userId, $data) {
    try {
        $db = getDB();

        $fields = [];
        $values = [];

        // Build dynamic update query
        if (isset($data['full_name'])) {
            $fields[] = "full_name = ?";
            $values[] = $data['full_name'];
        }
        if (isset($data['phone'])) {
            $fields[] = "phone = ?";
            $values[] = $data['phone'];
        }
        if (isset($data['company_name'])) {
            $fields[] = "company_name = ?";
            $values[] = $data['company_name'];
        }
        if (isset($data['avatar'])) {
            $fields[] = "avatar = ?";
            $values[] = $data['avatar'];
        }
        if (isset($data['email_verified'])) {
            $fields[] = "email_verified = ?";
            $values[] = $data['email_verified'];
        }
        if (isset($data['status'])) {
            $fields[] = "status = ?";
            $values[] = $data['status'];
        }

        if (empty($fields)) {
            return ['success' => false, 'error' => 'No fields to update'];
        }

        $fields[] = "updated_at = NOW()";
        $values[] = $userId;

        $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute($values);

        if ($result) {
            logActivity($userId, 'user_updated', 'User profile updated');
            return ['success' => true];
        }

        return ['success' => false, 'error' => 'Failed to update user'];

    } catch (PDOException $e) {
        error_log("User update error: " . $e->getMessage());
        return ['success' => false, 'error' => 'Database error'];
    }
}

// Update password
function updateUserPassword($userId, $newPassword) {
    try {
        $db = getDB();

        $hashedPassword = hashPassword($newPassword);

        $stmt = $db->prepare("UPDATE users SET password = ?, updated_at = NOW() WHERE id = ?");
        $result = $stmt->execute([$hashedPassword, $userId]);

        if ($result) {
            logActivity($userId, 'password_changed', 'User changed password');
            return ['success' => true];
        }

        return ['success' => false, 'error' => 'Failed to update password'];

    } catch (PDOException $e) {
        error_log("Password update error: " . $e->getMessage());
        return ['success' => false, 'error' => 'Database error'];
    }
}

// Verify email
function verifyUserEmail($token) {
    try {
        $db = getDB();

        // Find user by verification token
        $stmt = $db->prepare("SELECT * FROM users WHERE email_verification_token = ? AND email_verified = 0");
        $stmt->execute([$token]);
        $user = $stmt->fetch();

        if (!$user) {
            return ['success' => false, 'error' => 'Invalid or expired verification token'];
        }

        // Check if token is expired (24 hours)
        if (isTokenExpired($user['created_at'], 24)) {
            return ['success' => false, 'error' => 'Verification token has expired'];
        }

        // Update user
        $stmt = $db->prepare("
            UPDATE users
            SET email_verified = 1,
                email_verification_token = NULL,
                email_verified_at = NOW(),
                updated_at = NOW()
            WHERE id = ?
        ");

        $result = $stmt->execute([$user['id']]);

        if ($result) {
            logActivity($user['id'], 'email_verified', 'User verified email address');
            return ['success' => true, 'user' => $user];
        }

        return ['success' => false, 'error' => 'Failed to verify email'];

    } catch (PDOException $e) {
        error_log("Email verification error: " . $e->getMessage());
        return ['success' => false, 'error' => 'Database error'];
    }
}

// Create password reset token
function createPasswordResetToken($email) {
    try {
        $db = getDB();

        // Check if user exists
        $user = getUserByEmail($email);
        if (!$user) {
            return ['success' => false, 'error' => 'Email not found'];
        }

        // Generate token
        $token = generateSecureToken(32);

        // Delete old tokens
        $stmt = $db->prepare("DELETE FROM password_resets WHERE email = ?");
        $stmt->execute([$email]);

        // Insert new token
        $stmt = $db->prepare("
            INSERT INTO password_resets (email, token, created_at, expires_at)
            VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 1 HOUR))
        ");

        $result = $stmt->execute([$email, $token]);

        if ($result) {
            logActivity($user['id'], 'password_reset_requested', 'User requested password reset');
            return ['success' => true, 'token' => $token, 'user' => $user];
        }

        return ['success' => false, 'error' => 'Failed to create reset token'];

    } catch (PDOException $e) {
        error_log("Password reset token error: " . $e->getMessage());
        return ['success' => false, 'error' => 'Database error'];
    }
}

// Verify password reset token
function verifyPasswordResetToken($token) {
    try {
        $db = getDB();

        $stmt = $db->prepare("
            SELECT pr.*, u.*
            FROM password_resets pr
            JOIN users u ON pr.email = u.email
            WHERE pr.token = ? AND pr.expires_at > NOW() AND pr.used = 0
        ");

        $stmt->execute([$token]);
        $result = $stmt->fetch();

        return $result ?: null;

    } catch (PDOException $e) {
        error_log("Token verification error: " . $e->getMessage());
        return null;
    }
}

// Reset password with token
function resetPasswordWithToken($token, $newPassword) {
    try {
        $db = getDB();

        // Verify token
        $data = verifyPasswordResetToken($token);
        if (!$data) {
            return ['success' => false, 'error' => 'Invalid or expired reset token'];
        }

        // Update password
        $hashedPassword = hashPassword($newPassword);

        $stmt = $db->prepare("UPDATE users SET password = ?, updated_at = NOW() WHERE email = ?");
        $result = $stmt->execute([$hashedPassword, $data['email']]);

        if ($result) {
            // Mark token as used
            $stmt = $db->prepare("UPDATE password_resets SET used = 1 WHERE token = ?");
            $stmt->execute([$token]);

            logActivity($data['id'], 'password_reset', 'User reset password via email');
            return ['success' => true];
        }

        return ['success' => false, 'error' => 'Failed to reset password'];

    } catch (PDOException $e) {
        error_log("Password reset error: " . $e->getMessage());
        return ['success' => false, 'error' => 'Database error'];
    }
}

// Set remember token
function setRememberToken($userId, $token) {
    try {
        $db = getDB();

        $stmt = $db->prepare("UPDATE users SET remember_token = ?, updated_at = NOW() WHERE id = ?");
        $result = $stmt->execute([$token, $userId]);

        return $result;

    } catch (PDOException $e) {
        error_log("Remember token error: " . $e->getMessage());
        return false;
    }
}

// Resend verification email
function resendVerificationEmail($email) {
    try {
        $user = getUserByEmail($email);

        if (!$user) {
            return ['success' => false, 'error' => 'Email not found'];
        }

        if ($user['email_verified'] == 1) {
            return ['success' => false, 'error' => 'Email already verified'];
        }

        // Generate new token
        $token = generateSecureToken(32);

        $db = getDB();
        $stmt = $db->prepare("
            UPDATE users
            SET email_verification_token = ?, updated_at = NOW()
            WHERE email = ?
        ");

        $result = $stmt->execute([$token, $email]);

        if ($result) {
            return ['success' => true, 'token' => $token, 'user' => $user];
        }

        return ['success' => false, 'error' => 'Failed to generate new token'];

    } catch (PDOException $e) {
        error_log("Resend verification error: " . $e->getMessage());
        return ['success' => false, 'error' => 'Database error'];
    }
}
