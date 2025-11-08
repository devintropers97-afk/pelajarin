<?php
session_start();
require_once '../includes/auth.php';

// Require client role
requireRole('client');

$pageTitle = 'Client Dashboard - SITUNEO';
$baseURL = '../';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #1E5C99 0%, #0F3057 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .dashboard-container { background: white; padding: 60px; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); text-align: center; max-width: 600px; }
        h1 { color: #0F3057; margin-bottom: 20px; font-size: 32px; }
        .user-info { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .user-info p { margin: 8px 0; color: #495057; }
        .badge { display: inline-block; padding: 6px 16px; background: #007bff; color: white; border-radius: 20px; font-size: 14px; font-weight: 600; margin-top: 10px; }
        .btn { display: inline-block; padding: 14px 32px; background: #dc3545; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; margin-top: 20px; transition: all 0.3s; }
        .btn:hover { background: #c82333; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(220,53,69,0.3); }
        .coming-soon { color: #6c757d; margin-top: 30px; font-style: italic; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>👤 Client Dashboard</h1>
        <div class="user-info">
            <p><strong>Selamat Datang!</strong></p>
            <p><?php echo htmlspecialchars($_SESSION['full_name'] ?? 'Client'); ?></p>
            <p>Email: <?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?></p>
            <span class="badge">CLIENT</span>
        </div>
        <p class="coming-soon">📦 Order management & invoices coming in BATCH 7-9</p>
        <a href="../auth/logout.php" class="btn">Logout</a>
    </div>
</body>
</html>
