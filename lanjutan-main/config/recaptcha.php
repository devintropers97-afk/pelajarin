<?php
/**
 * SITUNEO DIGITAL - reCAPTCHA Configuration
 * Google reCAPTCHA v3 settings
 */

// reCAPTCHA v3 Keys (isi nanti dengan key asli dari Google)
define('RECAPTCHA_SITE_KEY', ''); // Public key (untuk frontend)
define('RECAPTCHA_SECRET_KEY', ''); // Secret key (untuk backend)
define('RECAPTCHA_ENABLED', false); // Set true kalau sudah dapat key

/**
 * Verify reCAPTCHA Token
 */
function verify_recaptcha($token, $action = 'submit') {
    // Jika reCAPTCHA disabled atau demo mode, return true
    if (!RECAPTCHA_ENABLED || DEMO_MODE || empty(RECAPTCHA_SECRET_KEY)) {
        return true;
    }

    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => RECAPTCHA_SECRET_KEY,
        'response' => $token,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);

    // Check if verification successful
    if (isset($response['success']) && $response['success'] === true) {
        // Check score (0.0 - 1.0, higher is better)
        if (isset($response['score']) && $response['score'] >= 0.5) {
            return true;
        }
    }

    return false;
}

/**
 * Get reCAPTCHA HTML (untuk form)
 */
function get_recaptcha_html($action = 'submit') {
    if (!RECAPTCHA_ENABLED || empty(RECAPTCHA_SITE_KEY)) {
        return '';
    }

    return '
    <script src="https://www.google.com/recaptcha/api.js?render=' . RECAPTCHA_SITE_KEY . '"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute("' . RECAPTCHA_SITE_KEY . '", {action: "' . $action . '"})
            .then(function(token) {
                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "recaptcha_token";
                input.value = token;
                document.forms[0].appendChild(input);
            });
        });
    </script>
    ';
}
