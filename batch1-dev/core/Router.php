<?php
/**
 * Router Class
 *
 * Simple URL routing system for SITUNEO
 * Handles clean URLs and routes requests to appropriate controllers
 *
 * @package SITUNEO
 * @subpackage Core
 */

class Router {
    /**
     * Route collection
     */
    private static $routes = [];

    /**
     * Current route
     */
    private static $current_route = null;

    /**
     * Route parameters
     */
    private static $params = [];

    /**
     * Base path
     */
    private static $base_path = '';

    /**
     * Initialize router
     */
    public static function init($base_path = '') {
        self::$base_path = rtrim($base_path, '/');
    }

    /**
     * Add GET route
     */
    public static function get($pattern, $callback) {
        self::add('GET', $pattern, $callback);
    }

    /**
     * Add POST route
     */
    public static function post($pattern, $callback) {
        self::add('POST', $pattern, $callback);
    }

    /**
     * Add route for any method
     */
    public static function any($pattern, $callback) {
        self::add('GET|POST', $pattern, $callback);
    }

    /**
     * Add route
     */
    private static function add($method, $pattern, $callback) {
        $pattern = self::$base_path . '/' . trim($pattern, '/');
        $pattern = rtrim($pattern, '/') ?: '/';

        self::$routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'callback' => $callback
        ];
    }

    /**
     * Dispatch route
     */
    public static function dispatch() {
        $request_method = $_SERVER['REQUEST_METHOD'];
        $request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Remove base path
        if (self::$base_path && strpos($request_uri, self::$base_path) === 0) {
            $request_uri = substr($request_uri, strlen(self::$base_path));
        }

        $request_uri = rtrim($request_uri, '/') ?: '/';

        foreach (self::$routes as $route) {
            // Check if method matches
            $methods = explode('|', $route['method']);
            if (!in_array($request_method, $methods)) {
                continue;
            }

            // Convert pattern to regex
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $route['pattern']);
            $pattern = '#^' . $pattern . '$#';

            // Match pattern
            if (preg_match($pattern, $request_uri, $matches)) {
                // Extract parameters
                self::$params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                self::$current_route = $route;

                // Execute callback
                return self::execute($route['callback']);
            }
        }

        // No route found - 404
        self::notFound();
    }

    /**
     * Execute callback
     */
    private static function execute($callback) {
        if (is_callable($callback)) {
            // Callback is a function
            return call_user_func_array($callback, self::$params);
        } elseif (is_string($callback)) {
            // Callback is a file path
            if (file_exists($callback)) {
                extract(self::$params);
                require $callback;
                return;
            }
        } elseif (is_array($callback) && count($callback) === 2) {
            // Callback is [Controller, method]
            list($controller, $method) = $callback;

            if (class_exists($controller)) {
                $instance = new $controller();
                if (method_exists($instance, $method)) {
                    return call_user_func_array([$instance, $method], self::$params);
                }
            }
        }

        // Invalid callback
        self::notFound();
    }

    /**
     * Get current route
     */
    public static function getCurrentRoute() {
        return self::$current_route;
    }

    /**
     * Get route parameters
     */
    public static function getParams() {
        return self::$params;
    }

    /**
     * Get single parameter
     */
    public static function getParam($key, $default = null) {
        return self::$params[$key] ?? $default;
    }

    /**
     * Redirect to URL
     */
    public static function redirect($url, $code = 302) {
        if (!preg_match('#^https?://#', $url)) {
            $url = SITE_URL . '/' . ltrim($url, '/');
        }

        header('Location: ' . $url, true, $code);
        exit;
    }

    /**
     * Redirect back
     */
    public static function back() {
        $referer = $_SERVER['HTTP_REFERER'] ?? SITE_URL;
        self::redirect($referer);
    }

    /**
     * Generate URL from pattern
     */
    public static function url($pattern, $params = []) {
        $url = self::$base_path . '/' . trim($pattern, '/');

        foreach ($params as $key => $value) {
            $url = str_replace('{' . $key . '}', $value, $url);
        }

        return SITE_URL . $url;
    }

    /**
     * Check if current route matches pattern
     */
    public static function is($pattern) {
        if (!self::$current_route) {
            return false;
        }

        return self::$current_route['pattern'] === $pattern;
    }

    /**
     * Get current URL
     */
    public static function currentUrl() {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") .
               "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    /**
     * Get current path
     */
    public static function currentPath() {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    /**
     * 404 Not Found handler
     */
    public static function notFound() {
        http_response_code(404);

        if (file_exists(INCLUDES_PATH . '404.php')) {
            require INCLUDES_PATH . '404.php';
        } else {
            echo '<h1>404 - Page Not Found</h1>';
            echo '<p>The page you are looking for does not exist.</p>';
            echo '<p><a href="' . SITE_URL . '">Back to Home</a></p>';
        }

        exit;
    }

    /**
     * Set custom 404 handler
     */
    public static function set404Handler($callback) {
        self::$not_found_handler = $callback;
    }

    /**
     * Get all routes
     */
    public static function getRoutes() {
        return self::$routes;
    }

    /**
     * Clear all routes
     */
    public static function clear() {
        self::$routes = [];
        self::$current_route = null;
        self::$params = [];
    }
}
