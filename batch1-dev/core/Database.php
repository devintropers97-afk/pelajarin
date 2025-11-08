<?php
/**
 * Database Class
 *
 * PDO-based database wrapper with singleton pattern
 * Provides secure database operations for SITUNEO
 *
 * @package SITUNEO
 * @subpackage Core
 */

class Database {
    /**
     * PDO instance
     */
    private static $instance = null;
    private $pdo = null;
    private $statement = null;

    /**
     * Query statistics
     */
    private $query_count = 0;
    private $query_log = [];

    /**
     * Private constructor (Singleton pattern)
     */
    private function __construct() {
        $this->connect();
    }

    /**
     * Get singleton instance
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Establish database connection
     */
    private function connect() {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            DB_HOST,
            DB_NAME,
            DB_CHARSET
        );

        $options = unserialize(PDO_OPTIONS);

        $attempts = 0;
        $max_attempts = DB_RETRY_ATTEMPTS;

        while ($attempts < $max_attempts) {
            try {
                $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
                return;
            } catch (PDOException $e) {
                $attempts++;
                if ($attempts >= $max_attempts) {
                    throw new Exception('Database connection failed: ' . $e->getMessage());
                }
                sleep(DB_RETRY_DELAY);
            }
        }
    }

    /**
     * Get PDO instance (for advanced queries)
     */
    public function getPDO() {
        return $this->pdo;
    }

    /**
     * Prepare SQL statement
     *
     * @param string $sql SQL query
     * @param array $params Optional parameters to bind automatically
     * @return self
     */
    public function query($sql, $params = []) {
        $start_time = microtime(true);

        $this->statement = $this->pdo->prepare($sql);

        // Auto-bind params if provided
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                // Add colon prefix if not present
                $param_key = is_string($key) && strpos($key, ':') === 0 ? $key : ':' . $key;
                $this->bind($param_key, $value);
            }
        }

        if (DB_LOG_QUERIES) {
            $this->query_log[] = [
                'sql' => $sql,
                'params' => $params,
                'time' => 0,
                'timestamp' => date('Y-m-d H:i:s')
            ];
        }

        return $this;
    }

    /**
     * Bind values to prepared statement
     */
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($param, $value, $type);
        return $this;
    }

    /**
     * Execute prepared statement
     */
    public function execute() {
        $start_time = microtime(true);

        $result = $this->statement->execute();

        $execution_time = microtime(true) - $start_time;

        if (DB_LOG_QUERIES && !empty($this->query_log)) {
            $last_index = count($this->query_log) - 1;
            $this->query_log[$last_index]['time'] = $execution_time;

            if (DB_SLOW_QUERY_TIME > 0 && $execution_time > DB_SLOW_QUERY_TIME) {
                error_log(sprintf(
                    "[SLOW QUERY - %.4fs] %s",
                    $execution_time,
                    $this->query_log[$last_index]['sql']
                ));
            }
        }

        $this->query_count++;

        return $result;
    }

    /**
     * Get all results
     */
    public function fetchAll() {
        $this->execute();
        return $this->statement->fetchAll();
    }

    /**
     * Get single row
     */
    public function fetch() {
        $this->execute();
        return $this->statement->fetch();
    }

    /**
     * Get single value
     */
    public function fetchColumn($column = 0) {
        $this->execute();
        return $this->statement->fetchColumn($column);
    }

    /**
     * Get row count
     */
    public function rowCount() {
        return $this->statement->rowCount();
    }

    /**
     * Get last insert ID
     */
    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }

    /**
     * Begin transaction
     */
    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    /**
     * Commit transaction
     */
    public function commit() {
        return $this->pdo->commit();
    }

    /**
     * Rollback transaction
     */
    public function rollBack() {
        return $this->pdo->rollBack();
    }

    /**
     * Get query count
     */
    public function getQueryCount() {
        return $this->query_count;
    }

    /**
     * Get query log
     */
    public function getQueryLog() {
        return $this->query_log;
    }

    /**
     * SELECT query helper
     */
    public function select($table, $columns = '*', $where = null, $params = []) {
        $sql = "SELECT {$columns} FROM {$table}";

        if ($where) {
            $sql .= " WHERE {$where}";
        }

        $this->query($sql);

        foreach ($params as $key => $value) {
            $this->bind($key, $value);
        }

        return $this->fetchAll();
    }

    /**
     * INSERT query helper
     */
    public function insert($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";

        $this->query($sql);

        foreach ($data as $key => $value) {
            $this->bind(":{$key}", $value);
        }

        return $this->execute();
    }

    /**
     * UPDATE query helper
     */
    public function update($table, $data, $where, $where_params = []) {
        $set = [];
        foreach (array_keys($data) as $key) {
            $set[] = "{$key} = :{$key}";
        }
        $set_clause = implode(', ', $set);

        $sql = "UPDATE {$table} SET {$set_clause} WHERE {$where}";

        $this->query($sql);

        foreach ($data as $key => $value) {
            $this->bind(":{$key}", $value);
        }

        foreach ($where_params as $key => $value) {
            $this->bind($key, $value);
        }

        return $this->execute();
    }

    /**
     * DELETE query helper
     */
    public function delete($table, $where, $params = []) {
        $sql = "DELETE FROM {$table} WHERE {$where}";

        $this->query($sql);

        foreach ($params as $key => $value) {
            $this->bind($key, $value);
        }

        return $this->execute();
    }

    /**
     * Check if table exists
     */
    public function tableExists($table) {
        $sql = "SHOW TABLES LIKE :table";
        $this->query($sql);
        $this->bind(':table', $table);
        return $this->fetch() !== false;
    }

    /**
     * Prevent cloning
     */
    private function __clone() {}

    /**
     * Prevent unserialization
     */
    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
}
