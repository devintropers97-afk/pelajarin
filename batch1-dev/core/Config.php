<?php
/**
 * Config Class
 *
 * Manages application configuration with database override support
 * Allows admin to change settings via admin panel without editing code
 *
 * @package SITUNEO
 * @subpackage Core
 */

class Config {
    /**
     * Configuration cache
     */
    private static $config = [];

    /**
     * Loaded from database flag
     */
    private static $db_loaded = false;

    /**
     * Get configuration value
     */
    public static function get($key, $default = null) {
        return self::$config[$key] ?? $default;
    }

    /**
     * Set configuration value
     */
    public static function set($key, $value) {
        self::$config[$key] = $value;
    }

    /**
     * Check if configuration exists
     */
    public static function has($key) {
        return isset(self::$config[$key]);
    }

    /**
     * Get all configuration
     */
    public static function all() {
        return self::$config;
    }

    /**
     * Load configuration from database
     * Overrides default config file values
     */
    public static function loadFromDatabase() {
        if (self::$db_loaded) {
            return;
        }

        try {
            $db = Database::getInstance();

            // Check if settings table exists
            if (!$db->tableExists('settings')) {
                return;
            }

            // Load all active settings
            $settings = $db->select('settings', '*', 'is_active = 1');

            foreach ($settings as $setting) {
                $key = $setting['key'];
                $value = $setting['value'];

                // Unserialize if needed
                if ($setting['is_serialized']) {
                    $value = @unserialize($value);
                }

                // Auto-cast types
                if ($setting['type'] === 'boolean') {
                    $value = (bool) $value;
                } elseif ($setting['type'] === 'integer') {
                    $value = (int) $value;
                } elseif ($setting['type'] === 'float') {
                    $value = (float) $value;
                }

                self::$config[$key] = $value;

                // Also define as constant if not already defined
                $constant_name = strtoupper($key);
                if (!defined($constant_name)) {
                    define($constant_name, $value);
                }
            }

            self::$db_loaded = true;

        } catch (Exception $e) {
            error_log('Config::loadFromDatabase failed: ' . $e->getMessage());
        }
    }

    /**
     * Save configuration to database
     */
    public static function save($key, $value, $category = 'general', $type = 'string') {
        try {
            $db = Database::getInstance();

            // Serialize if array/object
            $is_serialized = is_array($value) || is_object($value);
            if ($is_serialized) {
                $value = serialize($value);
            }

            // Check if exists
            $existing = $db->select('settings', '*', '`key` = :key', [':key' => $key]);

            if (!empty($existing)) {
                // Update
                return $db->update('settings', [
                    'value' => $value,
                    'type' => $type,
                    'category' => $category,
                    'is_serialized' => $is_serialized ? 1 : 0,
                    'updated_at' => date('Y-m-d H:i:s'),
                ], '`key` = :key', [':key' => $key]);
            } else {
                // Insert
                return $db->insert('settings', [
                    'key' => $key,
                    'value' => $value,
                    'category' => $category,
                    'type' => $type,
                    'is_serialized' => $is_serialized ? 1 : 0,
                    'is_active' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

        } catch (Exception $e) {
            error_log('Config::save failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete configuration from database
     */
    public static function delete($key) {
        try {
            $db = Database::getInstance();
            return $db->delete('settings', '`key` = :key', [':key' => $key]);
        } catch (Exception $e) {
            error_log('Config::delete failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get configuration by category
     */
    public static function getByCategory($category) {
        try {
            $db = Database::getInstance();
            return $db->select('settings', '*', 'category = :category AND is_active = 1', [
                ':category' => $category
            ]);
        } catch (Exception $e) {
            error_log('Config::getByCategory failed: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Clear configuration cache
     */
    public static function clearCache() {
        self::$config = [];
        self::$db_loaded = false;
    }

    /**
     * Initialize default settings in database
     */
    public static function initializeDefaults() {
        $defaults = [
            // Site Info
            ['key' => 'site_name', 'value' => SITE_NAME, 'category' => 'general', 'type' => 'string'],
            ['key' => 'site_tagline', 'value' => SITE_TAGLINE, 'category' => 'general', 'type' => 'string'],
            ['key' => 'site_email', 'value' => SITE_EMAIL, 'category' => 'general', 'type' => 'string'],
            ['key' => 'site_phone', 'value' => SITE_PHONE, 'category' => 'general', 'type' => 'string'],

            // Pricing
            ['key' => 'pricing_system_enabled', 'value' => true, 'category' => 'pricing', 'type' => 'boolean'],
            ['key' => 'pricing_currency', 'value' => 'IDR', 'category' => 'pricing', 'type' => 'string'],

            // Commissions
            ['key' => 'commission_enabled', 'value' => true, 'category' => 'freelancer', 'type' => 'boolean'],
            ['key' => 'commission_threshold', 'value' => 50000, 'category' => 'freelancer', 'type' => 'integer'],
            ['key' => 'commission_tier_1', 'value' => 30.00, 'category' => 'freelancer', 'type' => 'float'],
            ['key' => 'commission_tier_2', 'value' => 40.00, 'category' => 'freelancer', 'type' => 'float'],
            ['key' => 'commission_tier_3', 'value' => 50.00, 'category' => 'freelancer', 'type' => 'float'],
            ['key' => 'commission_tier_max', 'value' => 55.00, 'category' => 'freelancer', 'type' => 'float'],

            // Security
            ['key' => 'rate_limit_enabled', 'value' => true, 'category' => 'security', 'type' => 'boolean'],
            ['key' => 'password_min_length', 'value' => 8, 'category' => 'security', 'type' => 'integer'],

            // Email
            ['key' => 'mail_enabled', 'value' => true, 'category' => 'email', 'type' => 'boolean'],
            ['key' => 'mail_driver', 'value' => 'smtp', 'category' => 'email', 'type' => 'string'],

            // Features
            ['key' => 'feature_blog', 'value' => true, 'category' => 'features', 'type' => 'boolean'],
            ['key' => 'feature_portfolio', 'value' => true, 'category' => 'features', 'type' => 'boolean'],
            ['key' => 'feature_live_chat', 'value' => true, 'category' => 'features', 'type' => 'boolean'],

            // Maintenance
            ['key' => 'maintenance_mode', 'value' => false, 'category' => 'maintenance', 'type' => 'boolean'],
        ];

        foreach ($defaults as $setting) {
            self::save(
                $setting['key'],
                $setting['value'],
                $setting['category'],
                $setting['type']
            );
        }
    }
}
