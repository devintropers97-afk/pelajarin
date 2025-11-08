        </div>
        <!-- End Page Content -->

        <!-- Footer -->
        <footer class="admin-footer">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">&copy; <?= date('Y') ?> <strong>SITUNEO DIGITAL</strong>. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0">NIB: <?= COMPANY_NIB ?> | Version 1.0</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- End Main Content -->
</div>
<!-- End Admin Layout -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS Animation -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Main JS -->
<script src="<?= url('assets/js/main.js') ?>"></script>

<!-- Admin Custom JS -->
<script>
    // Initialize AOS
    AOS.init({
        duration: 600,
        once: true
    });

    // Mobile sidebar toggle
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.admin-sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 992) {
                if (!sidebar.contains(e.target) && !sidebarToggle?.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
    });

    // Confirm delete actions
    document.querySelectorAll('[data-confirm-delete]').forEach(function(element) {
        element.addEventListener('click', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                e.preventDefault();
            }
        });
    });

    // Auto-hide alerts
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>

<style>
    .admin-footer {
        background: var(--white);
        border-top: 1px solid var(--gray-200);
        padding: 1.5rem 2rem;
        margin-top: auto;
    }

    .admin-footer p {
        font-size: 0.875rem;
        color: var(--gray-600);
    }
</style>

</body>
</html>
