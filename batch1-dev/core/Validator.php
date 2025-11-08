<?php
/**
 * Validator Class
 *
 * Form validation with Indonesian error messages
 * Supports various validation rules
 *
 * @package SITUNEO
 * @subpackage Core
 */

class Validator {
    /**
     * Validation errors
     */
    private $errors = [];

    /**
     * Data to validate
     */
    private $data = [];

    /**
     * Validation rules
     */
    private $rules = [];

    /**
     * Custom error messages
     */
    private $messages = [];

    /**
     * Field labels
     */
    private $labels = [];

    /**
     * Constructor
     */
    public function __construct($data = [], $rules = [], $messages = [], $labels = []) {
        $this->data = $data;
        $this->rules = $rules;
        $this->messages = $messages;
        $this->labels = $labels;
    }

    /**
     * Create validator instance
     */
    public static function make($data, $rules, $messages = [], $labels = []) {
        return new self($data, $rules, $messages, $labels);
    }

    /**
     * Validate data
     */
    public function validate() {
        foreach ($this->rules as $field => $rules) {
            $rules_array = is_string($rules) ? explode('|', $rules) : $rules;

            foreach ($rules_array as $rule) {
                $this->validateRule($field, $rule);
            }
        }

        return empty($this->errors);
    }

    /**
     * Validate single rule
     */
    private function validateRule($field, $rule) {
        // Parse rule and parameters
        $parameters = [];
        if (strpos($rule, ':') !== false) {
            list($rule, $params) = explode(':', $rule, 2);
            $parameters = explode(',', $params);
        }

        $value = $this->data[$field] ?? null;
        $label = $this->labels[$field] ?? $field;

        // Call validation method
        $method = 'validate' . ucfirst($rule);

        if (method_exists($this, $method)) {
            $result = $this->$method($value, $parameters, $field);

            if (!$result) {
                $this->addError($field, $rule, $parameters, $label);
            }
        }
    }

    /**
     * Add error
     */
    private function addError($field, $rule, $parameters, $label) {
        // Check for custom message
        $message_key = "{$field}.{$rule}";
        if (isset($this->messages[$message_key])) {
            $message = $this->messages[$message_key];
        } else {
            $message = $this->getDefaultMessage($rule, $label, $parameters);
        }

        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }

        $this->errors[$field][] = $message;
    }

    /**
     * Get default error message
     */
    private function getDefaultMessage($rule, $label, $parameters) {
        $messages = [
            'required' => "{$label} wajib diisi",
            'email' => "{$label} harus berupa email yang valid",
            'min' => "{$label} minimal {$parameters[0]} karakter",
            'max' => "{$label} maksimal {$parameters[0]} karakter",
            'numeric' => "{$label} harus berupa angka",
            'integer' => "{$label} harus berupa bilangan bulat",
            'alpha' => "{$label} hanya boleh berisi huruf",
            'alphanumeric' => "{$label} hanya boleh berisi huruf dan angka",
            'url' => "{$label} harus berupa URL yang valid",
            'phone' => "{$label} harus berupa nomor telepon yang valid",
            'unique' => "{$label} sudah digunakan",
            'exists' => "{$label} tidak ditemukan",
            'same' => "{$label} harus sama dengan {$parameters[0]}",
            'different' => "{$label} harus berbeda dengan {$parameters[0]}",
            'in' => "{$label} harus salah satu dari: " . implode(', ', $parameters),
            'date' => "{$label} harus berupa tanggal yang valid",
            'before' => "{$label} harus sebelum {$parameters[0]}",
            'after' => "{$label} harus setelah {$parameters[0]}",
            'confirmed' => "Konfirmasi {$label} tidak cocok",
            'password' => "{$label} tidak memenuhi persyaratan keamanan",
        ];

        return $messages[$rule] ?? "{$label} tidak valid";
    }

    /**
     * Get errors
     */
    public function errors() {
        return $this->errors;
    }

    /**
     * Check if has errors
     */
    public function fails() {
        return !empty($this->errors);
    }

    /**
     * Check if validation passed
     */
    public function passes() {
        return empty($this->errors);
    }

    /**
     * Get first error for field
     */
    public function first($field) {
        return $this->errors[$field][0] ?? null;
    }

    /**
     * Get all errors for field
     */
    public function get($field) {
        return $this->errors[$field] ?? [];
    }

    /**
     * Get all errors as flat array
     */
    public function all() {
        $all_errors = [];
        foreach ($this->errors as $field_errors) {
            $all_errors = array_merge($all_errors, $field_errors);
        }
        return $all_errors;
    }

    // =========================================================================
    // VALIDATION RULES
    // =========================================================================

    /**
     * Required validation
     */
    private function validateRequired($value, $parameters, $field) {
        if (is_null($value)) {
            return false;
        }

        if (is_string($value) && trim($value) === '') {
            return false;
        }

        if (is_array($value) && empty($value)) {
            return false;
        }

        return true;
    }

    /**
     * Email validation
     */
    private function validateEmail($value, $parameters, $field) {
        if (empty($value)) {
            return true; // Allow empty unless required
        }

        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Minimum length validation
     */
    private function validateMin($value, $parameters, $field) {
        if (empty($value)) {
            return true;
        }

        $min = $parameters[0] ?? 0;
        return mb_strlen($value) >= $min;
    }

    /**
     * Maximum length validation
     */
    private function validateMax($value, $parameters, $field) {
        if (empty($value)) {
            return true;
        }

        $max = $parameters[0] ?? 0;
        return mb_strlen($value) <= $max;
    }

    /**
     * Numeric validation
     */
    private function validateNumeric($value, $parameters, $field) {
        if (empty($value)) {
            return true;
        }

        return is_numeric($value);
    }

    /**
     * Integer validation
     */
    private function validateInteger($value, $parameters, $field) {
        if (empty($value)) {
            return true;
        }

        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }

    /**
     * Alpha validation (letters only)
     */
    private function validateAlpha($value, $parameters, $field) {
        if (empty($value)) {
            return true;
        }

        return preg_match('/^[a-zA-Z]+$/', $value);
    }

    /**
     * Alphanumeric validation
     */
    private function validateAlphanumeric($value, $parameters, $field) {
        if (empty($value)) {
            return true;
        }

        return preg_match('/^[a-zA-Z0-9]+$/', $value);
    }

    /**
     * URL validation
     */
    private function validateUrl($value, $parameters, $field) {
        if (empty($value)) {
            return true;
        }

        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Phone validation (Indonesian format)
     */
    private function validatePhone($value, $parameters, $field) {
        if (empty($value)) {
            return true;
        }

        // Indonesian phone: 08xx, 62xxx, +62xxx
        return preg_match('/^(\+62|62|0)[0-9]{9,13}$/', $value);
    }

    /**
     * Unique validation (check database)
     */
    private function validateUnique($value, $parameters, $field) {
        if (empty($value)) {
            return true;
        }

        $table = $parameters[0] ?? null;
        $column = $parameters[1] ?? $field;
        $except_id = $parameters[2] ?? null;

        if (!$table) {
            return true;
        }

        try {
            $db = Database::getInstance();

            $where = "`{$column}` = :value";
            $params = [':value' => $value];

            if ($except_id) {
                $where .= " AND id != :except_id";
                $params[':except_id'] = $except_id;
            }

            $result = $db->select($table, 'COUNT(*) as count', $where, $params);
            return $result[0]['count'] == 0;

        } catch (Exception $e) {
            error_log('Validator::validateUnique() failed: ' . $e->getMessage());
            return true; // Don't fail validation on DB error
        }
    }

    /**
     * Exists validation (check if value exists in database)
     */
    private function validateExists($value, $parameters, $field) {
        if (empty($value)) {
            return true;
        }

        $table = $parameters[0] ?? null;
        $column = $parameters[1] ?? 'id';

        if (!$table) {
            return true;
        }

        try {
            $db = Database::getInstance();
            $result = $db->select($table, 'COUNT(*) as count', "`{$column}` = :value", [':value' => $value]);
            return $result[0]['count'] > 0;

        } catch (Exception $e) {
            error_log('Validator::validateExists() failed: ' . $e->getMessage());
            return true;
        }
    }

    /**
     * Same validation (field must match another field)
     */
    private function validateSame($value, $parameters, $field) {
        $other_field = $parameters[0] ?? null;

        if (!$other_field) {
            return true;
        }

        return $value === ($this->data[$other_field] ?? null);
    }

    /**
     * Different validation
     */
    private function validateDifferent($value, $parameters, $field) {
        $other_field = $parameters[0] ?? null;

        if (!$other_field) {
            return true;
        }

        return $value !== ($this->data[$other_field] ?? null);
    }

    /**
     * In validation (value must be in list)
     */
    private function validateIn($value, $parameters, $field) {
        if (empty($value)) {
            return true;
        }

        return in_array($value, $parameters);
    }

    /**
     * Date validation
     */
    private function validateDate($value, $parameters, $field) {
        if (empty($value)) {
            return true;
        }

        $timestamp = strtotime($value);
        return $timestamp !== false && $timestamp > 0;
    }

    /**
     * Before date validation
     */
    private function validateBefore($value, $parameters, $field) {
        if (empty($value)) {
            return true;
        }

        $date = strtotime($value);
        $before_date = strtotime($parameters[0] ?? 'now');

        return $date < $before_date;
    }

    /**
     * After date validation
     */
    private function validateAfter($value, $parameters, $field) {
        if (empty($value)) {
            return true;
        }

        $date = strtotime($value);
        $after_date = strtotime($parameters[0] ?? 'now');

        return $date > $after_date;
    }

    /**
     * Confirmed validation (password confirmation)
     */
    private function validateConfirmed($value, $parameters, $field) {
        $confirmation_field = $field . '_confirmation';
        $confirmation_value = $this->data[$confirmation_field] ?? null;

        return $value === $confirmation_value;
    }

    /**
     * Password strength validation
     */
    private function validatePassword($value, $parameters, $field) {
        if (empty($value)) {
            return true;
        }

        $validation = Security::validatePasswordStrength($value);
        return $validation['valid'];
    }

    /**
     * Quick validation (static helper)
     */
    public static function quick($data, $rules, $messages = [], $labels = []) {
        $validator = new self($data, $rules, $messages, $labels);

        if (!$validator->validate()) {
            Session::flashError(implode('<br>', $validator->all()));
            Session::flashInput($data);
            return false;
        }

        return true;
    }
}
