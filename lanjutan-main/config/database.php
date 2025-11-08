<?php
/**
 * SITUNEO DIGITAL - Database Configuration
 * Database connection menggunakan PDO
 */

// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'nrrskfvk_user_situneo_digital');
define('DB_PASS', 'Devin1922$');
define('DB_NAME', 'nrrskfvk_situneo_digital');
define('DB_CHARSET', 'utf8mb4');

// Create PDO connection
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
    ];

    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

    // Set timezone
    $pdo->exec("SET time_zone = '+07:00'");

} catch (PDOException $e) {
    // Log error (jangan tampilkan ke user)
    error_log("Database Connection Error: " . $e->getMessage());

    // Tampilkan pesan friendly ke user
    die("
    <!DOCTYPE html>
    <html>
    <head>
        <title>Database Connection Error</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #0F3057;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                margin: 0;
            }
            .error-box {
                background: rgba(255,255,255,0.1);
                padding: 40px;
                border-radius: 20px;
                text-align: center;
                border: 2px solid #FFB400;
            }
            h1 { color: #FFB400; }
            p { margin: 20px 0; }
            .contact {
                background: #FFB400;
                color: #0F3057;
                padding: 10px 20px;
                border-radius: 50px;
                text-decoration: none;
                display: inline-block;
                margin-top: 20px;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class='error-box'>
            <h1>⚠️ Database Connection Error</h1>
            <p>Maaf, kami sedang mengalami masalah koneksi database.</p>
            <p>Silakan hubungi admin untuk bantuan.</p>
            <a href='https://wa.me/6283173868915' class='contact'>Hubungi Admin via WhatsApp</a>
        </div>
    </body>
    </html>
    ");
}

// Function untuk query helper
function db_query($query, $params = []) {
    global $pdo;
    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    } catch (PDOException $e) {
        error_log("Query Error: " . $e->getMessage());
        return false;
    }
}

// Function untuk fetch single row
function db_fetch($query, $params = []) {
    $stmt = db_query($query, $params);
    return $stmt ? $stmt->fetch() : false;
}

// Function untuk fetch all rows
function db_fetch_all($query, $params = []) {
    $stmt = db_query($query, $params);
    return $stmt ? $stmt->fetchAll() : [];
}

// Function untuk insert dan return last ID
function db_insert($query, $params = []) {
    global $pdo;
    $stmt = db_query($query, $params);
    return $stmt ? $pdo->lastInsertId() : false;
}

// Function untuk update/delete dan return affected rows
function db_execute($query, $params = []) {
    $stmt = db_query($query, $params);
    return $stmt ? $stmt->rowCount() : false;
}
