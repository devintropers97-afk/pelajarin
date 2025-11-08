<?php
/**
 * Logout Handler
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

// Ensure user is logged in before logging out
if (Auth::check()) {
    $user = Auth::user();

    // Log the logout activity
    $db = Database::getInstance();
    $db->insert('activity_logs', [
        'user_id' => $user['id'],
        'action' => 'logout',
        'description' => 'User logged out',
        'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
        'created_at' => date('Y-m-d H:i:s')
    ]);

    // Perform logout
    Auth::logout();

    Session::flashSuccess('Anda telah berhasil logout. Sampai jumpa lagi!');
} else {
    Session::flashInfo('Anda sudah logout.');
}

// Redirect to login page
Router::redirect('login');
