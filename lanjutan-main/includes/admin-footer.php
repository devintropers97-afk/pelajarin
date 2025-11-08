            </div>
            <!-- End Page Content -->

            <!-- Footer -->
            <footer class="dashboard-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        &copy; <?= date('Y') ?> SITUNEO DIGITAL. All rights reserved.
                    </div>
                    <div class="text-muted small">
                        Version 1.0.0 | <a href="/docs" class="text-gold">Documentation</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="/assets/js/main.js"></script>

    <!-- Sidebar Toggle -->
    <script>
    document.getElementById('sidebarToggle')?.addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('collapsed');
        document.querySelector('.dashboard-content').classList.toggle('expanded');
    });
    </script>
</body>
</html>
