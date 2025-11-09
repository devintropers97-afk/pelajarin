<?php
/**
 * SITUNEO DIGITAL - Helper Functions
 * Fungsi-fungsi helper yang sering dipakai
 */

/**
 * Format Rupiah
 */
function formatRupiah($number) {
    return 'Rp ' . number_format($number, 0, ',', '.');
}

/**
 * Format Number
 */
function formatNumber($number, $decimals = 0) {
    return number_format($number, $decimals, ',', '.');
}

/**
 * Time Ago (Berapa lama yang lalu)
 */
function timeAgo($datetime) {
    $timestamp = strtotime($datetime);
    $now = time();
    $diff = $now - $timestamp;

    if ($diff < 60) {
        return 'Baru saja';
    } elseif ($diff < 3600) {
        $minutes = floor($diff / 60);
        return $minutes . ' menit yang lalu';
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . ' jam yang lalu';
    } elseif ($diff < 604800) {
        $days = floor($diff / 86400);
        return $days . ' hari yang lalu';
    } else {
        return date('d M Y, H:i', $timestamp);
    }
}

/**
 * Format Date Indonesia
 */
function formatDateIndo($date, $format = 'd F Y') {
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    $hari = [
        'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];

    $timestamp = strtotime($date);
    $day = date('d', $timestamp);
    $month = $bulan[date('n', $timestamp)];
    $year = date('Y', $timestamp);
    $dayName = $hari[date('l', $timestamp)];

    if ($format == 'd F Y') {
        return $day . ' ' . $month . ' ' . $year;
    } elseif ($format == 'l, d F Y') {
        return $dayName . ', ' . $day . ' ' . $month . ' ' . $year;
    } else {
        return date($format, $timestamp);
    }
}

/**
 * Sanitize Input
 */
function sanitize($input) {
    if (is_array($input)) {
        foreach ($input as $key => $value) {
            $input[$key] = sanitize($value);
        }
        return $input;
    }
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate Email
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate Phone (Indonesia)
 */
function validatePhone($phone) {
    // Remove spaces, dashes, parentheses
    $phone = preg_replace('/[^0-9+]/', '', $phone);

    // Check if starts with +62 or 0 or 62
    if (preg_match('/^(\+62|62|0)8[0-9]{8,11}$/', $phone)) {
        return true;
    }
    return false;
}

/**
 * Format Phone to WhatsApp Format (628xxx)
 */
function formatPhoneWA($phone) {
    $phone = preg_replace('/[^0-9]/', '', $phone);

    if (substr($phone, 0, 1) == '0') {
        $phone = '62' . substr($phone, 1);
    } elseif (substr($phone, 0, 2) == '62') {
        $phone = $phone;
    }

    return $phone;
}

/**
 * Generate Random String
 */
function generateRandomString($length = 32) {
    return bin2hex(random_bytes($length / 2));
}

/**
 * Generate Order Number
 */
function generateOrderNumber() {
    return 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
}

/**
 * Generate Invoice Number
 */
function generateInvoiceNumber() {
    return 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
}

/**
 * Generate Payment Code
 */
function generatePaymentCode() {
    return 'PAY-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
}

/**
 * Generate Ticket Number
 */
function generateTicketNumber() {
    return 'TKT-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
}

/**
 * Generate Withdrawal Number
 */
function generateWithdrawalNumber() {
    return 'WD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
}

/**
 * Generate Demo Request Number
 */
function generateDemoRequestNumber() {
    return 'DEMO-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
}

/**
 * Generate Referral Code
 */
function generateReferralCode($name) {
    $code = strtoupper(substr(preg_replace('/[^a-zA-Z0-9]/', '', $name), 0, 4));
    $code .= strtoupper(substr(uniqid(), -4));
    return $code;
}

/**
 * Hash Password
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

/**
 * Verify Password
 */
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Truncate Text
 */
function truncate($text, $length = 100, $suffix = '...') {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . $suffix;
}

/**
 * Slugify String
 */
function slugify($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    $text = trim($text, '-');
    return $text;
}

/**
 * Upload File
 */
function uploadFile($file, $destination, $allowed_types = [], $max_size = null) {
    if (!isset($file['error']) || is_array($file['error'])) {
        return ['success' => false, 'message' => 'Invalid file upload'];
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'Upload error: ' . $file['error']];
    }

    // Check file size
    $max_size = $max_size ?? MAX_UPLOAD_SIZE;
    if ($file['size'] > $max_size) {
        return ['success' => false, 'message' => 'File terlalu besar. Maksimal: ' . formatFileSize($max_size)];
    }

    // Check file type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!empty($allowed_types) && !in_array($mime, $allowed_types)) {
        return ['success' => false, 'message' => 'Tipe file tidak diizinkan'];
    }

    // Generate unique filename
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '-' . time() . '.' . $extension;
    $filepath = $destination . '/' . $filename;

    // Create directory if not exists
    if (!is_dir($destination)) {
        mkdir($destination, 0755, true);
    }

    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $filepath)) {
        return ['success' => false, 'message' => 'Gagal memindahkan file'];
    }

    return [
        'success' => true,
        'filename' => $filename,
        'filepath' => $filepath,
        'size' => $file['size'],
        'type' => $mime
    ];
}

/**
 * Delete File
 */
function deleteFile($filepath) {
    if (file_exists($filepath)) {
        return unlink($filepath);
    }
    return false;
}

/**
 * Format File Size
 */
function formatFileSize($bytes) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));
    return round($bytes, 2) . ' ' . $units[$pow];
}

/**
 * Get User IP Address
 */
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

/**
 * Get User Agent
 */
function getUserAgent() {
    return $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
}

/**
 * Redirect
 */
function redirect($url, $permanent = false) {
    if ($permanent) {
        header('HTTP/1.1 301 Moved Permanently');
    }
    header('Location: ' . $url);
    exit;
}

/**
 * JSON Response
 */
function jsonResponse($data, $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

/**
 * Check if AJAX Request
 */
function isAjax() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

/**
 * Get Current URL
 */
function getCurrentURL() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    return $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * Get Status Badge HTML
 */
function getStatusBadge($status) {
    $badges = [
        'active' => '<span class="badge bg-success">Active</span>',
        'inactive' => '<span class="badge bg-secondary">Inactive</span>',
        'pending' => '<span class="badge bg-warning">Pending</span>',
        'suspended' => '<span class="badge bg-danger">Suspended</span>',
        'completed' => '<span class="badge bg-success">Completed</span>',
        'cancelled' => '<span class="badge bg-danger">Cancelled</span>',
        'paid' => '<span class="badge bg-success">Paid</span>',
        'unpaid' => '<span class="badge bg-warning">Unpaid</span>',
        'verified' => '<span class="badge bg-success">Verified</span>',
        'rejected' => '<span class="badge bg-danger">Rejected</span>',
    ];

    return $badges[$status] ?? '<span class="badge bg-secondary">' . ucfirst($status) . '</span>';
}

/**
 * Calculate Tier Level berdasarkan monthly orders
 */
function calculateTierLevel($monthlyOrders) {
    if ($monthlyOrders >= TIER_3_MIN_ORDERS) {
        return 'tier_3';
    } elseif ($monthlyOrders >= TIER_2_MIN_ORDERS) {
        return 'tier_2';
    } else {
        return 'tier_1';
    }
}

/**
 * Get Commission Rate by Tier
 */
function getCommissionRate($tier) {
    $rates = [
        'tier_1' => TIER_1_COMMISSION,
        'tier_2' => TIER_2_COMMISSION,
        'tier_3' => TIER_3_COMMISSION
    ];
    return $rates[$tier] ?? TIER_1_COMMISSION;
}

/**
 * Calculate Commission
 */
function calculateCommission($orderAmount, $tier) {
    $rate = getCommissionRate($tier);
    $commission = ($orderAmount * $rate) / 100;

    // Add bonus for tier 3
    if ($tier === 'tier_3') {
        $bonus = ($orderAmount * TIER_3_BONUS) / 100;
        $commission += $bonus;
    }

    return $commission;
}

/**
 * Calculate Discount for Calculator
 */
function calculateDiscount($totalServices, $totalAmount) {
    $discount = 0;

    if ($totalServices >= 5) {
        $discount = ($totalAmount * DISCOUNT_5_SERVICES) / 100;
    } elseif ($totalServices >= 3) {
        $discount = ($totalAmount * DISCOUNT_3_SERVICES) / 100;
    }

    return $discount;
}

/**
 * Pagination HTML
 */
function getPagination($totalItems, $itemsPerPage, $currentPage, $url) {
    $totalPages = ceil($totalItems / $itemsPerPage);

    if ($totalPages <= 1) {
        return '';
    }

    $html = '<nav><ul class="pagination">';

    // Previous
    if ($currentPage > 1) {
        $html .= '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($currentPage - 1) . '">Previous</a></li>';
    }

    // Pages
    for ($i = 1; $i <= $totalPages; $i++) {
        $active = ($i == $currentPage) ? 'active' : '';
        $html .= '<li class="page-item ' . $active . '"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>';
    }

    // Next
    if ($currentPage < $totalPages) {
        $html .= '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($currentPage + 1) . '">Next</a></li>';
    }

    $html .= '</ul></nav>';

    return $html;
}

/**
 * Debug (hanya jalan kalau DEMO_MODE = true)
 */
function dd($var) {
    if (DEMO_MODE) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        die();
    }
}
