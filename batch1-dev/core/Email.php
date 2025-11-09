<?php
/**
 * Email Module
 */

class Email {
    private static $config = [];
    
    public static function init() {
        self::$config = [
            'host' => getenv('MAIL_HOST') ?: 'smtp.gmail.com',
            'port' => getenv('MAIL_PORT') ?: 587,
            'username' => getenv('MAIL_USERNAME'),
            'password' => getenv('MAIL_PASSWORD'),
            'from_address' => getenv('MAIL_FROM_ADDRESS'),
            'from_name' => getenv('MAIL_FROM_NAME') ?: 'SITUNEO DIGITAL'
        ];
    }
    
    public static function send($to, $subject, $message, $is_html = true) {
        $headers = [
            'From: ' . self::$config['from_name'] . ' <' . self::$config['from_address'] . '>',
            'Reply-To: ' . self::$config['from_address'],
            'X-Mailer: PHP/' . phpversion()
        ];
        
        if ($is_html) {
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=UTF-8';
        }
        
        return mail($to, $subject, $message, implode("\r\n", $headers));
    }
    
    public static function sendOrderConfirmation($order_id) {
        $db = Database::getInstance();
        $order = $db->query("
            SELECT o.*, u.email, u.name, s.name as service_name
            FROM orders o
            JOIN users u ON o.user_id = u.id
            JOIN services s ON o.service_id = s.id
            WHERE o.id = :id
        ", ['id' => $order_id])->fetch();
        
        if (!$order) return false;
        
        $subject = 'Order Confirmation - ' . $order['order_number'];
        $message = "
            <h2>Order Confirmation</h2>
            <p>Dear {$order['name']},</p>
            <p>Your order has been received!</p>
            <p><strong>Order Number:</strong> {$order['order_number']}</p>
            <p><strong>Service:</strong> {$order['service_name']}</p>
            <p><strong>Amount:</strong> Rp " . number_format($order['total_amount'], 0, ',', '.') . "</p>
            <p>We will process your order shortly.</p>
            <p>Best regards,<br>SITUNEO DIGITAL Team</p>
        ";
        
        return self::send($order['email'], $subject, $message);
    }
}

Email::init();
