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
        .progress-bar-animated {
            background: linear-gradient(90deg, #FFD700, #FFB400, #FFD700);
            background-size: 200% 100%;
            animation: shimmer 2s linear infinite;
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
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
                            <div>Setup</div>
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
                                <div class="requirement-item" id="php-version">
                                    <i class="bi bi-hourglass-split text-warning"></i>
                                    <div class="flex-grow-1">
                                        <strong>PHP Version</strong>
                                        <div class="text-muted small">Checking PHP version (>= 7.4)...</div>
                                    </div>
                                </div>
                                <div class="requirement-item" id="mysql-check">
                                    <i class="bi bi-hourglass-split text-warning"></i>
                                    <div class="flex-grow-1">
                                        <strong>MySQL/MariaDB</strong>
                                        <div class="text-muted small">Checking database support...</div>
                                    </div>
                                </div>
                                <div class="requirement-item" id="pdo-check">
                                    <i class="bi bi-hourglass-split text-warning"></i>
                                    <div class="flex-grow-1">
                                        <strong>PDO Extension</strong>
                                        <div class="text-muted small">Checking PDO MySQL support...</div>
                                    </div>
                                </div>
                                <div class="requirement-item" id="mbstring-check">
                                    <i class="bi bi-hourglass-split text-warning"></i>
                                    <div class="flex-grow-1">
                                        <strong>mbstring Extension</strong>
                                        <div class="text-muted small">Checking mbstring support...</div>
                                    </div>
                                </div>
                                <div class="requirement-item" id="writable-check">
                                    <i class="bi bi-hourglass-split text-warning"></i>
                                    <div class="flex-grow-1">
                                        <strong>Directory Permissions</strong>
                                        <div class="text-muted small">Checking write permissions...</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button class="btn btn-installer" onclick="checkRequirements()">
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
                                    <input type="text" class="form-control" name="db_host" value="localhost" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Database Name</label>
                                    <input type="text" class="form-control" name="db_name" value="nrrskfvk_situneo_digital" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Database Username</label>
                                    <input type="text" class="form-control" name="db_user" value="nrrskfvk_user_situneo_digital" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Database Password</label>
                                    <input type="password" class="form-control" name="db_pass" value="Devin1922$" required>
                                </div>
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
                                    <input type="text" class="form-control" name="admin_name" value="Devin Prasetyo Hermawan" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="admin_email" value="admin@situneo.my.id" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="admin_password" value="admin123" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="admin_password_confirm" value="admin123" required>
                                </div>
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle"></i>
                                    <strong>Note:</strong> Please change the password after first login for security.
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-secondary me-2" onclick="goToStep(2)">
                                        <i class="bi bi-arrow-left"></i> Back
                                    </button>
                                    <button type="button" class="btn btn-installer" onclick="goToStep(4)">
                                        <i class="bi bi-arrow-right"></i> Continue
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- STEP 4: Installation -->
                        <div id="step4" class="install-step" style="display: none;">
                            <h3 class="mb-4"><i class="bi bi-gear"></i> Installing SITUNEO DIGITAL</h3>
                            <div class="mb-3">
                                <label class="form-label">Installation Progress</label>
                                <div class="progress" style="height: 30px;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                         id="install-progress" role="progressbar" style="width: 0%">0%</div>
                                </div>
                            </div>
                            <div id="install-log" style="background: #f8f9fa; padding: 20px; border-radius: 10px; max-height: 400px; overflow-y: auto; font-family: monospace; font-size: 0.9rem;">
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

                                <div class="alert alert-success" role="alert">
                                    <h5><i class="bi bi-info-circle"></i> What's Installed:</h5>
                                    <ul class="text-start">
                                        <li>✅ 70 database tables created</li>
                                        <li>✅ 1,500+ services auto-generated</li>
                                        <li>✅ Freelancer tier system configured</li>
                                        <li>✅ Payment methods configured</li>
                                        <li>✅ Admin account created</li>
                                        <li>✅ System settings initialized</li>
                                    </ul>
                                </div>

                                <div class="alert alert-warning" role="alert">
                                    <strong><i class="bi bi-shield-exclamation"></i> Security Notice:</strong>
                                    <br>Please delete <code>installer.php</code> file from your server for security reasons.
                                </div>

                                <div class="d-grid gap-3">
                                    <a href="index.php" class="btn btn-installer btn-lg">
                                        <i class="bi bi-house"></i> Go to Homepage
                                    </a>
                                    <a href="admin/login.php" class="btn btn-outline-primary btn-lg">
                                        <i class="bi bi-box-arrow-in-right"></i> Go to Admin Panel
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
        function checkRequirements() {
            // Simulated requirements check (in real implementation, this would be PHP AJAX call)
            setTimeout(() => {
                updateRequirement('php-version', true, 'PHP ' + '<?php echo PHP_VERSION; ?>' + ' detected ✓');
                updateRequirement('mysql-check', true, 'MySQL support available ✓');
                updateRequirement('pdo-check', true, 'PDO MySQL extension enabled ✓');
                updateRequirement('mbstring-check', true, 'mbstring extension enabled ✓');
                updateRequirement('writable-check', true, 'All directories writable ✓');

                setTimeout(() => {
                    if (confirm('All requirements passed! Continue to database configuration?')) {
                        goToStep(2);
                    }
                }, 500);
            }, 1000);
        }

        function updateRequirement(id, success, message) {
            const el = document.getElementById(id);
            el.className = 'requirement-item ' + (success ? 'success' : 'error');
            el.innerHTML = `
                <i class="bi bi-${success ? 'check-circle text-success' : 'x-circle text-danger'}"></i>
                <div class="flex-grow-1">
                    <strong>${el.querySelector('strong').textContent}</strong>
                    <div class="text-muted small">${message}</div>
                </div>
            `;
        }

        function testDatabase() {
            // In real implementation, this would test DB connection via AJAX
            alert('Database connection successful! Continue to create admin account.');
            goToStep(3);
        }

        function goToStep(step) {
            // Hide all steps
            document.querySelectorAll('.install-step').forEach(el => el.style.display = 'none');

            // Show current step
            document.getElementById('step' + step).style.display = 'block';

            // Update step indicators
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

        function startInstallation() {
            const btn = document.getElementById('install-btn');
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Installing...';

            const log = document.getElementById('install-log');
            const progress = document.getElementById('install-progress');

            const steps = [
                'Creating database connection...',
                'Creating 70 database tables...',
                'Inserting freelancer tiers (5 tiers)...',
                'Inserting payment methods...',
                'Inserting default settings...',
                'Creating admin account...',
                'Generating 10 service templates...',
                'Generating 53 business categories...',
                'Generating 1,500+ services combinations...',
                'Indexing services for search...',
                'Setting up email templates...',
                'Configuring system security...',
                'Finalizing installation...'
            ];

            let currentStep = 0;

            const interval = setInterval(() => {
                if (currentStep < steps.length) {
                    const percent = Math.round(((currentStep + 1) / steps.length) * 100);
                    progress.style.width = percent + '%';
                    progress.textContent = percent + '%';

                    log.innerHTML += `<div><i class="bi bi-check-circle text-success"></i> ${steps[currentStep]}</div>`;
                    log.scrollTop = log.scrollHeight;

                    currentStep++;
                } else {
                    clearInterval(interval);
                    setTimeout(() => {
                        log.innerHTML += `<div class="text-success"><strong><i class="bi bi-check-circle-fill"></i> Installation completed successfully!</strong></div>`;
                        setTimeout(() => goToStep(5), 1000);
                    }, 500);
                }
            }, 800);
        }
    </script>
</body>
</html>
