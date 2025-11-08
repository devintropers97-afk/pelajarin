<?php
/**
 * Formatting Helper Functions
 *
 * Date, number, currency, and text formatting functions
 *
 * @package SITUNEO
 * @subpackage Helpers
 */

// Prevent direct access
defined('SITUNEO_ACCESS') or die('Direct access not permitted');

/**
 * Format Indonesian currency
 */
function format_rupiah($amount, $include_symbol = true) {
    $formatted = number_format($amount, 0, ',', '.');

    if ($include_symbol) {
        return 'Rp ' . $formatted;
    }

    return $formatted;
}

/**
 * Format currency (alias for format_rupiah)
 */
function currency($amount, $include_symbol = true) {
    return format_rupiah($amount, $include_symbol);
}

/**
 * Format number with Indonesian format
 */
function format_number($number, $decimals = 0) {
    return number_format($number, $decimals, ',', '.');
}

/**
 * Format percentage
 */
function format_percentage($number, $decimals = 0) {
    return number_format($number, $decimals, ',', '.') . '%';
}

/**
 * Format date to Indonesian format
 */
function format_date($date, $format = null) {
    if (!$date) {
        return '-';
    }

    if ($format === null) {
        $format = DATE_FORMAT;
    }

    $timestamp = is_numeric($date) ? $date : strtotime($date);

    if (!$timestamp) {
        return '-';
    }

    // Indonesian month names
    $months = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    // Indonesian day names
    $days = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];

    $formatted = date($format, $timestamp);

    // Replace English month names with Indonesian
    foreach ($months as $num => $name) {
        $formatted = str_replace(date('F', mktime(0, 0, 0, $num, 1)), $name, $formatted);
        $formatted = str_replace(date('M', mktime(0, 0, 0, $num, 1)), substr($name, 0, 3), $formatted);
    }

    // Replace English day names with Indonesian
    foreach ($days as $eng => $indo) {
        $formatted = str_replace($eng, $indo, $formatted);
        $formatted = str_replace(substr($eng, 0, 3), substr($indo, 0, 3), $formatted);
    }

    return $formatted;
}

/**
 * Format datetime to Indonesian format
 */
function format_datetime($datetime, $format = null) {
    if ($format === null) {
        $format = DATETIME_FORMAT;
    }

    return format_date($datetime, $format);
}

/**
 * Format time
 */
function format_time($time, $format = null) {
    if ($format === null) {
        $format = TIME_FORMAT;
    }

    if (!$time) {
        return '-';
    }

    $timestamp = is_numeric($time) ? $time : strtotime($time);
    return date($format, $timestamp);
}

/**
 * Format date for humans (relative)
 */
function date_for_humans($date) {
    $timestamp = is_numeric($date) ? $date : strtotime($date);
    $diff = time() - $timestamp;

    // Future dates
    if ($diff < 0) {
        $diff = abs($diff);
        if ($diff < 60) {
            return 'dalam ' . $diff . ' detik';
        } elseif ($diff < 3600) {
            return 'dalam ' . floor($diff / 60) . ' menit';
        } elseif ($diff < 86400) {
            return 'dalam ' . floor($diff / 3600) . ' jam';
        } else {
            return format_date($date, 'd F Y');
        }
    }

    // Past dates
    if ($diff < 60) {
        return 'baru saja';
    } elseif ($diff < 3600) {
        $minutes = floor($diff / 60);
        return $minutes . ' menit yang lalu';
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . ' jam yang lalu';
    } elseif ($diff < 172800) { // 2 days
        return 'Kemarin ' . format_time($date);
    } elseif ($diff < 604800) { // 1 week
        $days = floor($diff / 86400);
        return $days . ' hari yang lalu';
    } else {
        return format_date($date, 'd F Y');
    }
}

/**
 * Truncate text with proper word boundary
 */
function truncate($text, $length = 100, $suffix = '...') {
    if (mb_strlen($text) <= $length) {
        return $text;
    }

    $truncated = mb_substr($text, 0, $length);

    // Find last space
    $last_space = mb_strrpos($truncated, ' ');

    if ($last_space !== false) {
        $truncated = mb_substr($truncated, 0, $last_space);
    }

    return $truncated . $suffix;
}

/**
 * Excerpt (truncate HTML safely)
 */
function excerpt($html, $length = 200) {
    $text = strip_tags($html);
    return truncate($text, $length);
}

/**
 * Format phone number (Indonesian)
 */
function format_phone($phone) {
    if (empty($phone)) {
        return '-';
    }

    // Remove non-numeric characters
    $phone = preg_replace('/[^0-9]/', '', $phone);

    // Format based on length
    if (strlen($phone) >= 11) {
        // 0812-3456-7890
        return substr($phone, 0, 4) . '-' . substr($phone, 4, 4) . '-' . substr($phone, 8);
    } elseif (strlen($phone) >= 10) {
        // 021-1234-5678
        return substr($phone, 0, 3) . '-' . substr($phone, 3, 4) . '-' . substr($phone, 7);
    }

    return $phone;
}

/**
 * Format WhatsApp number for wa.me link
 */
function whatsapp_link($phone, $message = '') {
    // Remove non-numeric
    $phone = preg_replace('/[^0-9]/', '', $phone);

    // Convert to international format
    if (substr($phone, 0, 1) === '0') {
        $phone = '62' . substr($phone, 1);
    } elseif (substr($phone, 0, 2) !== '62') {
        $phone = '62' . $phone;
    }

    $url = 'https://wa.me/' . $phone;

    if ($message) {
        $url .= '?text=' . urlencode($message);
    }

    return $url;
}

/**
 * Format file size
 */
function format_filesize($bytes) {
    return format_bytes($bytes);
}

/**
 * Format status badge
 */
function status_badge($status) {
    $badges = [
        'active' => '<span class="badge bg-success">Aktif</span>',
        'inactive' => '<span class="badge bg-secondary">Tidak Aktif</span>',
        'pending' => '<span class="badge bg-warning">Menunggu</span>',
        'completed' => '<span class="badge bg-success">Selesai</span>',
        'cancelled' => '<span class="badge bg-danger">Dibatalkan</span>',
        'processing' => '<span class="badge bg-info">Diproses</span>',
        'paid' => '<span class="badge bg-success">Lunas</span>',
        'unpaid' => '<span class="badge bg-danger">Belum Bayar</span>',
        'partial' => '<span class="badge bg-warning">Sebagian</span>',
        'approved' => '<span class="badge bg-success">Disetujui</span>',
        'rejected' => '<span class="badge bg-danger">Ditolak</span>',
    ];

    return $badges[$status] ?? '<span class="badge bg-secondary">' . ucfirst($status) . '</span>';
}

/**
 * Format order status
 */
function order_status($status) {
    $statuses = [
        'pending' => 'Menunggu Pembayaran',
        'processing' => 'Sedang Diproses',
        'completed' => 'Selesai',
        'cancelled' => 'Dibatalkan',
    ];

    return $statuses[$status] ?? ucfirst($status);
}

/**
 * Format payment status
 */
function payment_status($status) {
    $statuses = [
        'unpaid' => 'Belum Dibayar',
        'partial' => 'Dibayar Sebagian',
        'paid' => 'Lunas',
        'refunded' => 'Dikembalikan',
    ];

    return $statuses[$status] ?? ucfirst($status);
}

/**
 * Format pricing model label
 */
function pricing_model_label($model) {
    $labels = [
        'one_time' => 'Beli Putus',
        'subscription' => 'Sewa Bulanan',
        'both' => 'Beli Putus & Sewa',
        'one_time_only' => 'Beli Putus Saja',
        'subscription_only' => 'Sewa Saja',
    ];

    return $labels[$model] ?? ucfirst($model);
}

/**
 * Format boolean to Yes/No
 */
function yes_no($value) {
    return $value ? 'Ya' : 'Tidak';
}

/**
 * Format boolean to Active/Inactive
 */
function active_status($value) {
    return $value ? 'Aktif' : 'Tidak Aktif';
}

/**
 * Highlight search term in text
 */
function highlight($text, $search) {
    if (empty($search)) {
        return $text;
    }

    return preg_replace('/(' . preg_quote($search, '/') . ')/i', '<mark>$1</mark>', $text);
}

/**
 * Convert newlines to <br>
 */
function nl2br_safe($text) {
    return nl2br(e($text));
}

/**
 * Make clickable links in text
 */
function make_links_clickable($text) {
    $pattern = '/(https?:\/\/[^\s]+)/i';
    return preg_replace($pattern, '<a href="$1" target="_blank">$1</a>', $text);
}

/**
 * Format address (multi-line to single line)
 */
function format_address($address) {
    if (empty($address)) {
        return '-';
    }

    return str_replace(["\r\n", "\n", "\r"], ', ', $address);
}

/**
 * Format social media username
 */
function format_social($username, $platform) {
    if (empty($username)) {
        return '-';
    }

    // Remove @ if present
    $username = ltrim($username, '@');

    $urls = [
        'instagram' => 'https://instagram.com/',
        'facebook' => 'https://facebook.com/',
        'twitter' => 'https://twitter.com/',
        'tiktok' => 'https://tiktok.com/@',
        'youtube' => 'https://youtube.com/',
        'linkedin' => 'https://linkedin.com/in/',
    ];

    $url = $urls[$platform] ?? '#';

    return '<a href="' . $url . $username . '" target="_blank">@' . $username . '</a>';
}

/**
 * Format star rating
 */
function star_rating($rating, $max = 5) {
    $full_stars = floor($rating);
    $half_star = ($rating - $full_stars) >= 0.5 ? 1 : 0;
    $empty_stars = $max - $full_stars - $half_star;

    $html = '';

    for ($i = 0; $i < $full_stars; $i++) {
        $html .= '<i class="bi bi-star-fill text-warning"></i>';
    }

    if ($half_star) {
        $html .= '<i class="bi bi-star-half text-warning"></i>';
    }

    for ($i = 0; $i < $empty_stars; $i++) {
        $html .= '<i class="bi bi-star text-warning"></i>';
    }

    return $html;
}

/**
 * Format list to comma-separated string
 */
function format_list($array, $separator = ', ', $last_separator = ' dan ') {
    if (empty($array)) {
        return '';
    }

    if (count($array) === 1) {
        return $array[0];
    }

    if (count($array) === 2) {
        return implode($last_separator, $array);
    }

    $last = array_pop($array);
    return implode($separator, $array) . $last_separator . $last;
}

/**
 * Format initials from name
 */
function get_initials($name) {
    $words = explode(' ', $name);
    $initials = '';

    foreach ($words as $word) {
        if (!empty($word)) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
    }

    return substr($initials, 0, 2);
}

/**
 * Format color from string (for avatars)
 */
function string_to_color($string) {
    $hash = md5($string);
    $color = '#' . substr($hash, 0, 6);
    return $color;
}

/**
 * Format table column (auto-detect type and format)
 */
function format_column($value, $type = 'auto') {
    if ($type === 'auto') {
        // Auto-detect type
        if (is_numeric($value) && $value >= 1000) {
            $type = 'number';
        } elseif (strtotime($value) && strlen($value) > 5) {
            $type = 'date';
        } elseif (is_bool($value) || $value === '0' || $value === '1') {
            $type = 'boolean';
        } else {
            $type = 'text';
        }
    }

    switch ($type) {
        case 'currency':
            return format_rupiah($value);
        case 'number':
            return format_number($value);
        case 'date':
            return format_date($value);
        case 'datetime':
            return format_datetime($value);
        case 'boolean':
            return yes_no($value);
        case 'text':
        default:
            return e($value);
    }
}
