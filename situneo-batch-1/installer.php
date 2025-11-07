<?php
// Check if already installed
if (file_exists(__DIR__ . '/config/.installed')) {
    die('
    <html>
    <head>
        <title>Already Installed</title>
        <style>
            body { font-family: Arial; background: #f5f5f5; padding: 50px; text-align: center; }
            .message { background: white; padding: 40px; border-radius: 10px; max-width: 500px; margin: 0 auto; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
            .icon { font-size: 4rem; color: #28a745; }
            h1 { color: #333; }
            a { color: #007bff; text-decoration: none; font-weight: bold; }
        </style>
    </head>
    <body>
        <div class="message">
            <div class="icon">✅</div>
            <h1>Already Installed</h1>
            <p>SITUNEO DIGITAL has already been installed.</p>
            <p>Please delete <code>installer.php</code> for security.</p>
            <p><a href="index.php">Go to Homepage →</a></p>
        </div>
    </body>
    </html>
    ');
}

session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SITUNEO DIGITAL - Installer Wizard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1E5C99;
            --dark-blue: #0F3057;
            --gold: #FFB400;
        }
        body {
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--primary-blue) 100%);
            min-height: 100vh;
            padding: 50px 0;
        }
        .installer-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .installer-header {
            background: linear-gradient(135deg, #FFD700 0%, #FFB400 100%);
            padding: 30px;
            text-align: center;
        }
        .installer-header h1 {
            color: var(--dark-blue);
            font-weight: 800;
            margin: 0;
        }
        .step-indicator {
            display: flex;
            justify-content: space-between;
            padding: 30px 50px;
            background: #f8f9fa;
        }
        .step {
            flex: 1;
            text-align: center;
            position: relative;
        }
        .step-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #dee2e6;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .step.active .step-circle {
            background: var(--gold);
            color: var(--dark-blue);
        }
        .step.completed .step-circle {
            background: #28a745;
            color: white;
        }
        .btn-installer {
            background: linear-gradient(135deg, #FFD700 0%, #FFB400 100%);
            color: var(--dark-blue);
            font-weight: 700;
            padding: 12px 40px;
            border: none;
            border-radius: 50px;
        }
        .btn-installer:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255,180,0,0.4);
        }
        .requirement-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .requirement-item i {
            font-size: 1.5rem;
            margin-right: 15px;
        }
        .requirement-item.success { border-left: 4px solid #28a745; }
        .requirement-item.error { border-left: 4px solid #dc3545; }
        .requirement-item.pending { border-left: 4px solid #ffc107; }
        .progress-bar-animated {
            background: linear-gradient(90deg, #FFD700, #FFB400, #FFD700);
            background-size: 200% 100%;
            animation: shimmer 2s linear infinite;
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        #install-log {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            max-height: 400px;
            overflow-y: auto;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
        }
        #install-log div {
            margin-bottom: 8px;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="installer-card">
                    <div class="installer-header">
                        <h1><i class="bi bi-rocket-takeoff"></i> SITUNEO DIGITAL</h1>
                        <p class="mb-0" style="color: var(--dark-blue);">Installation Wizard - Automatic Setup</p>
                    </div>

                    <div class="step-indicator">
                        <div class="step active" id="step1-indicator">
                            <div class="step-circle">1</div>
                            <div>Requirements</div>
                        </div>
                        <div class="step" id="step2-indicator">
                            <div class="step-circle">2</div>
                            <div>Database</div>
                        </div>
                        <div class="step" id="step3-indicator">
                            <div class="step-circle">3</div>
                            <div>Admin Account</div>
                        </div>
                        <div class="step" id="step4-indicator">
                            <div class="step-circle">4</div>
                            <div>Installation</div>
                        </div>
                        <div class="step" id="step5-indicator">
                            <div class="step-circle">5</div>
                            <div>Complete</div>
                        </div>
                    </div>

                    <div class="p-5">
                        <!-- STEP 1: Requirements Check -->
                        <div id="step1" class="install-step">
                            <h3 class="mb-4"><i class="bi bi-clipboard-check"></i> System Requirements</h3>
                            <div id="requirements-check">
                                <div class="requirement-item pending" id="req-php">
                                    <i class="bi bi-hourglass-split text-warning"></i>
                                    <div class="flex-grow-1">
                                        <strong>PHP Version</strong>
                                        <div class="text-muted small">Checking PHP version...</div>
                                    </div>
                                </div>
                                <div class="requirement-item pending" id="req-pdo">
                                    <i class="bi bi-hourglass-split text-warning"></i>
                                    <div class="flex-grow-1">
                                        <strong>PDO MySQL</strong>
                                        <div class="text-muted small">Checking PDO support...</div>
                                    </div>
                                </div>
                                <div class="requirement-item pending" id="req-mbstring">
                                    <i class="bi bi-hourglass-split text-warning"></i>
                                    <div class="flex-grow-1">
                                        <strong>mbstring Extension</strong>
                                        <div class="text-muted small">Checking mbstring...</div>
                                    </div>
                                </div>
                                <div class="requirement-item pending" id="req-json">
                                    <i class="bi bi-hourglass-split text-warning"></i>
                                    <div class="flex-grow-1">
                                        <strong>JSON Extension</strong>
                                        <div class="text-muted small">Checking JSON support...</div>
                                    </div>
                                </div>
                                <div class="requirement-item pending" id="req-writable">
                                    <i class="bi bi-hourglass-split text-warning"></i>
                                    <div class="flex-grow-1">
                                        <strong>Directory Permissions</strong>
                                        <div class="text-muted small">Checking write permissions...</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button class="btn btn-installer btn-lg" onclick="checkRequirements()">
                                    <i class="bi bi-arrow-clockwise"></i> Check Requirements
                                </button>
                            </div>
                        </div>

                        <!-- STEP 2: Database Configuration -->
                        <div id="step2" class="install-step" style="display: none;">
                            <h3 class="mb-4"><i class="bi bi-database"></i> Database Configuration</h3>
                            <form id="db-form">
                                <div class="mb-3">
                                    <label class="form-label">Database Host</label>
                                    <input type="text" class="form-control" id="db_host" value="localhost" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Database Name</label>
                                    <input type="text" class="form-control" id="db_name" value="nrrskfvk_situneo_digital" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Database Username</label>
                                    <input type="text" class="form-control" id="db_user" value="nrrskfvk_user_situneo_digital" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Database Password</label>
                                    <input type="password" class="form-control" id="db_pass" value="Devin1922$" required>
                                    <small class="form-text text-muted">Leave blank if no password</small>
                                </div>
                                <div id="db-test-result" class="alert" style="display: none;"></div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-secondary me-2" onclick="goToStep(1)">
                                        <i class="bi bi-arrow-left"></i> Back
                                    </button>
                                    <button type="button" class="btn btn-installer" onclick="testDatabase()">
                                        <i class="bi bi-plug"></i> Test Connection & Continue
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- STEP 3: Admin Account -->
                        <div id="step3" class="install-step" style="display: none;">
                            <h3 class="mb-4"><i class="bi bi-person-badge"></i> Create Admin Account</h3>
                            <form id="admin-form">
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="admin_name" value="Devin Prasetyo Hermawan" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="admin_email" value="admin@situneo.my.id" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" id="admin_password" value="admin123" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="admin_password_confirm" value="admin123" required>
                                </div>
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle"></i>
                                    <strong>Note:</strong> Please change the password after first login for security.
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-secondary me-2" onclick="goToStep(2)">
                                        <i class="bi bi-arrow-left"></i> Back
                                    </button>
                                    <button type="button" class="btn btn-installer" onclick="saveAdminAndContinue()">
                                        <i class="bi bi-arrow-right"></i> Continue to Installation
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- STEP 4: Installation -->
                        <div id="step4" class="install-step" style="display: none;">
                            <h3 class="mb-4"><i class="bi bi-gear"></i> Installing SITUNEO DIGITAL</h3>

                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle"></i>
                                <strong>Important:</strong> Do not close this window during installation!
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Installation Progress</label>
                                <div class="progress" style="height: 30px;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                         id="install-progress" role="progressbar" style="width: 0%">0%</div>
                                </div>
                            </div>

                            <div id="install-log">
                                <div><i class="bi bi-info-circle text-info"></i> Ready to install...</div>
                            </div>

                            <div class="text-center mt-4">
                                <button class="btn btn-installer btn-lg" id="install-btn" onclick="startInstallation()">
                                    <i class="bi bi-rocket-takeoff"></i> Start Installation
                                </button>
                            </div>
                        </div>

                        <!-- STEP 5: Complete -->
                        <div id="step5" class="install-step" style="display: none;">
                            <div class="text-center">
                                <div class="mb-4">
                                    <i class="bi bi-check-circle" style="font-size: 5rem; color: #28a745;"></i>
                                </div>
                                <h2 class="mb-3">Installation Complete!</h2>
                                <p class="lead mb-4">SITUNEO DIGITAL has been successfully installed.</p>

                                <div class="alert alert-success text-start" role="alert">
                                    <h5><i class="bi bi-info-circle"></i> What's Installed:</h5>
                                    <ul id="install-summary">
                                        <li>✅ 70 database tables created</li>
                                        <li>✅ System settings initialized</li>
                                        <li>✅ Freelancer tier system configured</li>
                                        <li>✅ Payment methods configured</li>
                                        <li>✅ Admin account created</li>
                                    </ul>
                                    <div id="admin-credentials" class="mt-3 p-3" style="background: #fff3cd; border-radius: 5px;">
                                        <strong>Admin Login:</strong><br>
                                        <span id="admin-email-display"></span><br>
                                        <span id="admin-pass-display"></span>
                                    </div>
                                </div>

                                <div class="alert alert-danger" role="alert">
                                    <strong><i class="bi bi-shield-exclamation"></i> Security Warning:</strong>
                                    <br>Please <strong>DELETE</strong> the <code>installer.php</code> and <code>installer-ajax.php</code> files from your server immediately!
                                </div>

                                <div class="d-grid gap-3">
                                    <a href="index.php" class="btn btn-installer btn-lg">
                                        <i class="bi bi-house"></i> Go to Homepage
                                    </a>
                                    <a href="admin/login.php" class="btn btn-outline-primary btn-lg">
                                        <i class="bi bi-box-arrow-in-right"></i> Go to Admin Login
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p style="color: white;">
                        <i class="bi bi-c-circle"></i> 2025 SITUNEO DIGITAL - Build Your Future, Today 💙
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let requirementsPassed = false;

        // AJAX Helper
        function ajax(action, data, callback) {
            const formData = new FormData();
            formData.append('action', action);

            for (let key in data) {
                formData.append(key, data[key]);
            }

            fetch('installer-ajax.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(callback)
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please check console.');
            });
        }

        // Step Navigation
        function goToStep(step) {
            document.querySelectorAll('.install-step').forEach(el => el.style.display = 'none');
            document.getElementById('step' + step).style.display = 'block';

            for (let i = 1; i <= 5; i++) {
                const indicator = document.getElementById('step' + i + '-indicator');
                if (i < step) {
                    indicator.className = 'step completed';
                } else if (i === step) {
                    indicator.className = 'step active';
                } else {
                    indicator.className = 'step';
                }
            }
        }

        // STEP 1: Check Requirements
        function checkRequirements() {
            ajax('check_requirements', {}, function(response) {
                const reqs = response.data;

                updateReq('req-php', reqs.php_version);
                updateReq('req-pdo', reqs.pdo);
                updateReq('req-mbstring', reqs.mbstring);
                updateReq('req-json', reqs.json);
                updateReq('req-writable', reqs.writable);

                if (response.success) {
                    requirementsPassed = true;
                    setTimeout(() => {
                        if (confirm('All requirements passed! Continue to database configuration?')) {
                            goToStep(2);
                        }
                    }, 500);
                } else {
                    alert('Some requirements failed. Please fix them before continuing.');
                }
            });
        }

        function updateReq(id, req) {
            const el = document.getElementById(id);
            el.className = 'requirement-item ' + (req.status ? 'success' : 'error');
            el.innerHTML = `
                <i class="bi bi-${req.status ? 'check-circle text-success' : 'x-circle text-danger'}"></i>
                <div class="flex-grow-1">
                    <strong>${el.querySelector('strong').textContent}</strong>
                    <div class="text-muted small">${req.message}</div>
                </div>
            `;
        }

        // STEP 2: Test Database
        function testDatabase() {
            const data = {
                db_host: document.getElementById('db_host').value,
                db_name: document.getElementById('db_name').value,
                db_user: document.getElementById('db_user').value,
                db_pass: document.getElementById('db_pass').value
            };

            const resultDiv = document.getElementById('db-test-result');
            resultDiv.style.display = 'block';
            resultDiv.className = 'alert alert-info';
            resultDiv.innerHTML = '<i class="bi bi-hourglass-split"></i> Testing connection...';

            ajax('test_database', data, function(response) {
                if (response.success) {
                    resultDiv.className = 'alert alert-success';
                    resultDiv.innerHTML = '<i class="bi bi-check-circle"></i> ' + response.message;
                    setTimeout(() => goToStep(3), 1000);
                } else {
                    resultDiv.className = 'alert alert-danger';
                    resultDiv.innerHTML = '<i class="bi bi-x-circle"></i> ' + response.message;
                }
            });
        }

        // STEP 3: Save Admin & Continue
        function saveAdminAndContinue() {
            const pass = document.getElementById('admin_password').value;
            const confirm = document.getElementById('admin_password_confirm').value;

            if (pass !== confirm) {
                alert('Passwords do not match!');
                return;
            }

            const data = {
                admin_name: document.getElementById('admin_name').value,
                admin_email: document.getElementById('admin_email').value,
                admin_password: pass
            };

            ajax('save_admin', data, function(response) {
                if (response.success) {
                    goToStep(4);
                } else {
                    alert('Error: ' + response.message);
                }
            });
        }

        // STEP 4: Start Installation
        function startInstallation() {
            const btn = document.getElementById('install-btn');
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Installing... Please wait!';

            const log = document.getElementById('install-log');
            const progress = document.getElementById('install-progress');

            log.innerHTML = '<div><i class="bi bi-hourglass-split text-warning"></i> Starting installation...</div>';

            ajax('install', {}, function(response) {
                if (response.success) {
                    // Show all steps
                    response.data.steps.forEach((step, index) => {
                        setTimeout(() => {
                            const percent = Math.round(((index + 1) / response.data.steps.length) * 100);
                            progress.style.width = percent + '%';
                            progress.textContent = percent + '%';

                            const icon = step.startsWith('✓') ? 'check-circle text-success' : 'info-circle text-info';
                            log.innerHTML += `<div><i class="bi bi-${icon}"></i> ${step}</div>`;
                            log.scrollTop = log.scrollHeight;

                            if (index === response.data.steps.length - 1) {
                                setTimeout(() => {
                                    document.getElementById('admin-email-display').textContent = 'Email: ' + response.data.admin_email;
                                    document.getElementById('admin-pass-display').textContent = 'Password: ' + response.data.admin_password;
                                    goToStep(5);
                                }, 500);
                            }
                        }, index * 300);
                    });
                } else {
                    log.innerHTML += `<div><i class="bi bi-x-circle text-danger"></i> <strong>ERROR:</strong> ${response.message}</div>`;
                    btn.disabled = false;
                    btn.innerHTML = '<i class="bi bi-arrow-clockwise"></i> Retry Installation';
                }
            });
        }

        // Auto-check requirements on load
        window.addEventListener('load', function() {
            setTimeout(checkRequirements, 1000);
        });
    </script>
</body>
</html>
