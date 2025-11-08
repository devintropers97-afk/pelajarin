<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Email Functions
 * Email sending and templates
 * ========================================
 */

// Email configuration
define('MAIL_FROM', 'noreply@situneo.com');
define('MAIL_FROM_NAME', 'SITUNEO Digital');
define('SITE_URL', 'https://situneo.com'); // Update with actual domain

// Send email (using PHP mail function - can be replaced with SMTP)
function sendEmail($to, $subject, $htmlBody, $plainBody = '') {
    try {
        // Set headers
        $headers = [
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=UTF-8',
            'From: ' . MAIL_FROM_NAME . ' <' . MAIL_FROM . '>',
            'Reply-To: ' . MAIL_FROM,
            'X-Mailer: PHP/' . phpversion()
        ];

        // Send email
        $result = mail($to, $subject, $htmlBody, implode("\r\n", $headers));

        if ($result) {
            error_log("Email sent to: " . $to);
            return ['success' => true];
        }

        error_log("Failed to send email to: " . $to);
        return ['success' => false, 'error' => 'Failed to send email'];

    } catch (Exception $e) {
        error_log("Email error: " . $e->getMessage());
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

// Get email template
function getEmailTemplate($body, $title = 'SITUNEO Digital') {
    return '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $title . '</title>
        <style>
            body {
                font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
                line-height: 1.6;
                color: #333;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .email-container {
                max-width: 600px;
                margin: 20px auto;
                background-color: #ffffff;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            .email-header {
                background: linear-gradient(135deg, #0F3057 0%, #1E5C99 100%);
                color: #ffffff;
                padding: 30px;
                text-align: center;
            }
            .email-header h1 {
                margin: 0;
                font-size: 28px;
                font-weight: 700;
            }
            .email-header .logo {
                font-size: 40px;
                margin-bottom: 10px;
            }
            .email-body {
                padding: 40px 30px;
            }
            .email-body h2 {
                color: #0F3057;
                margin-top: 0;
            }
            .btn {
                display: inline-block;
                padding: 14px 30px;
                background: linear-gradient(135deg, #1E5C99 0%, #0F3057 100%);
                color: #ffffff !important;
                text-decoration: none;
                border-radius: 6px;
                font-weight: 600;
                margin: 20px 0;
                text-align: center;
            }
            .btn:hover {
                opacity: 0.9;
            }
            .email-footer {
                background-color: #f8f9fa;
                padding: 20px 30px;
                text-align: center;
                font-size: 12px;
                color: #6c757d;
                border-top: 1px solid #e9ecef;
            }
            .email-footer a {
                color: #1E5C99;
                text-decoration: none;
            }
            .divider {
                height: 1px;
                background: linear-gradient(90deg, transparent, #e9ecef, transparent);
                margin: 20px 0;
            }
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="email-header">
                <div class="logo">🌐</div>
                <h1>SITUNEO</h1>
            </div>
            <div class="email-body">
                ' . $body . '
            </div>
            <div class="email-footer">
                <p>© ' . date('Y') . ' SITUNEO Digital. All rights reserved.</p>
                <p>
                    <a href="' . SITE_URL . '">Visit Website</a> |
                    <a href="' . SITE_URL . '/contact.php">Contact Support</a> |
                    <a href="' . SITE_URL . '/pages/privacy-policy.php">Privacy Policy</a>
                </p>
                <p style="margin-top: 15px; font-size: 11px;">
                    This is an automated email. Please do not reply to this message.
                </p>
            </div>
        </div>
    </body>
    </html>
    ';
}

// Send verification email
function sendVerificationEmail($email, $name, $token) {
    $verifyUrl = SITE_URL . '/auth/verify-email.php?token=' . $token;

    $body = '
        <h2>Welcome to SITUNEO, ' . htmlspecialchars($name) . '! 🎉</h2>
        <p>Thank you for registering with SITUNEO Digital. We\'re excited to have you on board!</p>
        <p>To complete your registration and activate your account, please verify your email address by clicking the button below:</p>
        <p style="text-align: center;">
            <a href="' . $verifyUrl . '" class="btn">Verify Email Address</a>
        </p>
        <div class="divider"></div>
        <p style="font-size: 13px; color: #6c757d;">
            If the button doesn\'t work, copy and paste this link into your browser:<br>
            <a href="' . $verifyUrl . '">' . $verifyUrl . '</a>
        </p>
        <p style="font-size: 13px; color: #6c757d; margin-top: 20px;">
            <strong>Note:</strong> This verification link will expire in 24 hours for security reasons.
        </p>
        <p style="font-size: 13px; color: #6c757d;">
            If you didn\'t create an account with SITUNEO, please ignore this email.
        </p>
    ';

    $html = getEmailTemplate($body, 'Verify Your Email - SITUNEO');

    return sendEmail($email, 'Verify Your Email Address - SITUNEO', $html);
}

// Send password reset email
function sendPasswordResetEmail($email, $name, $token) {
    $resetUrl = SITE_URL . '/auth/reset-password.php?token=' . $token;

    $body = '
        <h2>Password Reset Request</h2>
        <p>Hello ' . htmlspecialchars($name) . ',</p>
        <p>We received a request to reset the password for your SITUNEO account. If you made this request, click the button below to reset your password:</p>
        <p style="text-align: center;">
            <a href="' . $resetUrl . '" class="btn">Reset Password</a>
        </p>
        <div class="divider"></div>
        <p style="font-size: 13px; color: #6c757d;">
            If the button doesn\'t work, copy and paste this link into your browser:<br>
            <a href="' . $resetUrl . '">' . $resetUrl . '</a>
        </p>
        <p style="font-size: 13px; color: #6c757d; margin-top: 20px;">
            <strong>Security Notice:</strong> This password reset link will expire in 1 hour for your security.
        </p>
        <p style="font-size: 13px; color: #dc3545; font-weight: 600;">
            ⚠️ If you didn\'t request a password reset, please ignore this email or contact support if you have concerns about your account security.
        </p>
    ';

    $html = getEmailTemplate($body, 'Reset Your Password - SITUNEO');

    return sendEmail($email, 'Reset Your Password - SITUNEO', $html);
}

// Send welcome email (after email verification)
function sendWelcomeEmail($email, $name, $role) {
    $dashboardUrl = SITE_URL . '/' . $role . '/dashboard.php';

    $body = '
        <h2>Welcome to SITUNEO! 🚀</h2>
        <p>Hello ' . htmlspecialchars($name) . ',</p>
        <p>Your email has been successfully verified! You now have full access to all SITUNEO features.</p>
        <p>Here\'s what you can do next:</p>
        <ul style="line-height: 2;">
            <li>✅ Complete your profile</li>
            <li>✅ Browse our services</li>
            <li>✅ Start your first project</li>
            <li>✅ Connect with professionals</li>
        </ul>
        <p style="text-align: center;">
            <a href="' . $dashboardUrl . '" class="btn">Go to Dashboard</a>
        </p>
        <div class="divider"></div>
        <p>If you have any questions, our support team is here to help 24/7.</p>
        <p>Best regards,<br><strong>The SITUNEO Team</strong></p>
    ';

    $html = getEmailTemplate($body, 'Welcome to SITUNEO');

    return sendEmail($email, 'Welcome to SITUNEO - Let\'s Get Started!', $html);
}

// Send password changed notification
function sendPasswordChangedEmail($email, $name) {
    $body = '
        <h2>Password Changed Successfully</h2>
        <p>Hello ' . htmlspecialchars($name) . ',</p>
        <p>This email confirms that your password was successfully changed.</p>
        <p><strong>Changed on:</strong> ' . date('F j, Y, g:i a') . '</p>
        <div class="divider"></div>
        <p style="font-size: 13px; color: #dc3545; font-weight: 600;">
            ⚠️ If you didn\'t make this change, please contact our support team immediately to secure your account.
        </p>
        <p style="text-align: center; margin-top: 20px;">
            <a href="' . SITE_URL . '/contact.php" class="btn">Contact Support</a>
        </p>
    ';

    $html = getEmailTemplate($body, 'Password Changed - SITUNEO');

    return sendEmail($email, 'Your Password Was Changed - SITUNEO', $html);
}

// Send partner registration email
function sendPartnerWelcomeEmail($email, $name, $referralCode) {
    $dashboardUrl = SITE_URL . '/partner/dashboard.php';

    $body = '
        <h2>Welcome to SITUNEO Partner Program! 🤝</h2>
        <p>Hello ' . htmlspecialchars($name) . ',</p>
        <p>Congratulations! Your partner account has been created successfully.</p>
        <p><strong>Your Referral Code:</strong> <span style="background: #f8f9fa; padding: 8px 15px; border-radius: 4px; font-family: monospace; font-size: 16px; font-weight: 700; color: #0F3057;">' . $referralCode . '</span></p>
        <p>Share this code with your network to earn commissions on every successful project!</p>
        <div class="divider"></div>
        <h3>Partner Benefits:</h3>
        <ul style="line-height: 2;">
            <li>💰 Earn up to 20% commission</li>
            <li>📊 Real-time analytics dashboard</li>
            <li>🎯 Marketing materials & tools</li>
            <li>🏆 Performance bonuses</li>
        </ul>
        <p style="text-align: center;">
            <a href="' . $dashboardUrl . '" class="btn">Access Partner Dashboard</a>
        </p>
        <p>Let\'s build something great together!</p>
    ';

    $html = getEmailTemplate($body, 'Welcome Partner - SITUNEO');

    return sendEmail($email, 'Welcome to SITUNEO Partner Program!', $html);
}
