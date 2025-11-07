<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Homepage
 * Entry point - redirects to homepage
 * ========================================
 */

require_once 'config/init.php';

// If installer exists and database not set up, redirect to installer
if (file_exists('installer.php')) {
    try {
        $db = getDB();
        $stmt = $db->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (count($tables) == 0) {
            header('Location: installer.php');
            exit();
        }
    } catch (Exception $e) {
        header('Location: installer.php');
        exit();
    }
}

// Redirect to homepage (will be created in next session)
header('Location: pages/home.php');
exit();
