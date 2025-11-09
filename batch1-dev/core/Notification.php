<?php
/**
 * Notification System
 */

class Notification {
    private static $db;
    
    public static function init() {
        self::$db = Database::getInstance();
    }
    
    public static function create($user_id, $title, $message, $type = 'info', $link = null) {
        return self::$db->insert('notifications', [
            'user_id' => $user_id,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'link' => $link,
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
    
    public static function getUnread($user_id, $limit = 10) {
        return self::$db->query("
            SELECT * FROM notifications
            WHERE user_id = :user_id AND is_read = 0
            ORDER BY created_at DESC
            LIMIT $limit
        ", ['user_id' => $user_id])->fetchAll();
    }
    
    public static function markAsRead($notification_id) {
        return self::$db->query("
            UPDATE notifications SET is_read = 1
            WHERE id = :id
        ", ['id' => $notification_id]);
    }
    
    public static function getUnreadCount($user_id) {
        return self::$db->query("
            SELECT COUNT(*) as count FROM notifications
            WHERE user_id = :user_id AND is_read = 0
        ", ['user_id' => $user_id])->fetch()['count'] ?? 0;
    }
}

Notification::init();
