<?php
/**
 * Analytics Helper Functions
 */

function track_page_view($page, $user_id = null) {
    $db = Database::getInstance();
    
    return $db->insert('analytics_page_views', [
        'user_id' => $user_id,
        'page' => $page,
        'ip_address' => get_ip(),
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
        'referrer' => $_SERVER['HTTP_REFERER'] ?? null,
        'created_at' => date('Y-m-d H:i:s')
    ]);
}

function track_event($event_name, $event_data = null, $user_id = null) {
    $db = Database::getInstance();
    
    return $db->insert('analytics_events', [
        'user_id' => $user_id,
        'event_name' => $event_name,
        'event_data' => is_array($event_data) ? json_encode($event_data) : $event_data,
        'ip_address' => get_ip(),
        'created_at' => date('Y-m-d H:i:s')
    ]);
}

function get_popular_services($limit = 10) {
    $db = Database::getInstance();
    
    return $db->query("
        SELECT s.*, COUNT(o.id) as order_count
        FROM services s
        LEFT JOIN orders o ON s.id = o.service_id
        WHERE s.is_active = 1
        GROUP BY s.id
        ORDER BY order_count DESC
        LIMIT $limit
    ")->fetchAll();
}
