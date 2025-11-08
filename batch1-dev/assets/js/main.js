/**
 * SITUNEO DIGITAL - Main JavaScript
 * Interactive Features & Animations
 */

(function() {
    'use strict';

    // =========================================================================
    // 1. NETWORK PARTICLE ANIMATION
    // =========================================================================
    const NetworkAnimation = {
        init() {
            const canvas = document.getElementById('networkBg');
            if (!canvas) return;

            const ctx = canvas.getContext('2d');
            let particles = [];
            let animationId;

            // Set canvas size
            const resizeCanvas = () => {
                canvas.width = canvas.offsetWidth;
                canvas.height = canvas.offsetHeight;
            };

            // Particle class
            class Particle {
                constructor() {
                    this.x = Math.random() * canvas.width;
                    this.y = Math.random() * canvas.height;
                    this.vx = (Math.random() - 0.5) * 0.5;
                    this.vy = (Math.random() - 0.5) * 0.5;
                    this.radius = Math.random() * 2 + 1;
                }

                update() {
                    this.x += this.vx;
                    this.y += this.vy;

                    // Bounce off edges
                    if (this.x < 0 || this.x > canvas.width) this.vx *= -1;
                    if (this.y < 0 || this.y > canvas.height) this.vy *= -1;
                }

                draw() {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                    ctx.fillStyle = 'rgba(59, 130, 246, 0.6)';
                    ctx.fill();
                }
            }

            // Create particles
            const createParticles = () => {
                const particleCount = Math.min(Math.floor(canvas.width / 10), 100);
                particles = [];
                for (let i = 0; i < particleCount; i++) {
                    particles.push(new Particle());
                }
            };

            // Draw connections
            const drawConnections = () => {
                for (let i = 0; i < particles.length; i++) {
                    for (let j = i + 1; j < particles.length; j++) {
                        const dx = particles[i].x - particles[j].x;
                        const dy = particles[i].y - particles[j].y;
                        const distance = Math.sqrt(dx * dx + dy * dy);

                        if (distance < 150) {
                            ctx.beginPath();
                            ctx.strokeStyle = `rgba(59, 130, 246, ${0.2 * (1 - distance / 150)})`;
                            ctx.lineWidth = 1;
                            ctx.moveTo(particles[i].x, particles[i].y);
                            ctx.lineTo(particles[j].x, particles[j].y);
                            ctx.stroke();
                        }
                    }
                }
            };

            // Animation loop
            const animate = () => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                particles.forEach(particle => {
                    particle.update();
                    particle.draw();
                });

                drawConnections();

                animationId = requestAnimationFrame(animate);
            };

            // Initialize
            resizeCanvas();
            createParticles();
            animate();

            // Handle resize
            window.addEventListener('resize', () => {
                resizeCanvas();
                createParticles();
            });

            // Stop animation when tab is not visible (performance)
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    cancelAnimationFrame(animationId);
                } else {
                    animate();
                }
            });
        }
    };

    // =========================================================================
    // 2. COUNTER ANIMATION
    // =========================================================================
    const CounterAnimation = {
        init() {
            const counters = document.querySelectorAll('.counter');
            if (!counters.length) return;

            const animateCounter = (element) => {
                const target = parseInt(element.getAttribute('data-target'));
                const duration = 2000; // 2 seconds
                const step = target / (duration / 16); // 60fps

                let current = 0;
                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    element.textContent = Math.floor(current).toLocaleString('id-ID');
                }, 16);
            };

            // Intersection Observer for triggering animation
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                        animateCounter(entry.target);
                        entry.target.classList.add('animated');
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach(counter => observer.observe(counter));
        }
    };

    // =========================================================================
    // 3. NAVBAR SCROLL EFFECT
    // =========================================================================
    const NavbarScroll = {
        init() {
            const navbar = document.getElementById('mainNavbar');
            if (!navbar) return;

            let lastScroll = 0;

            window.addEventListener('scroll', () => {
                const currentScroll = window.pageYOffset;

                // Add scrolled class
                if (currentScroll > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }

                // Hide/show navbar on scroll
                if (currentScroll > lastScroll && currentScroll > 500) {
                    navbar.style.transform = 'translateY(-100%)';
                } else {
                    navbar.style.transform = 'translateY(0)';
                }

                lastScroll = currentScroll;
            });
        }
    };

    // =========================================================================
    // 4. BACK TO TOP BUTTON
    // =========================================================================
    const BackToTop = {
        init() {
            const btn = document.getElementById('backToTop');
            if (!btn) return;

            // Show/hide button
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    btn.classList.add('show');
                } else {
                    btn.classList.remove('show');
                }
            });

            // Scroll to top
            btn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
    };

    // =========================================================================
    // 5. SMOOTH SCROLL FOR ANCHOR LINKS
    // =========================================================================
    const SmoothScroll = {
        init() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href === '#' || href === '#!') return;

                    const target = document.querySelector(href);
                    if (!target) return;

                    e.preventDefault();

                    const offsetTop = target.offsetTop - 80; // Account for fixed navbar

                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                });
            });
        }
    };

    // =========================================================================
    // 6. FORM VALIDATION
    // =========================================================================
    const FormValidation = {
        init() {
            const forms = document.querySelectorAll('.needs-validation');
            if (!forms.length) return;

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!form.checkValidity()) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                    form.classList.add('was-validated');
                });
            });
        }
    };

    // =========================================================================
    // 7. AUTO-DISMISS ALERTS
    // =========================================================================
    const AutoDismissAlerts = {
        init() {
            const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
            if (!alerts.length) return;

            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000); // Auto-dismiss after 5 seconds
            });
        }
    };

    // =========================================================================
    // 8. LAZY LOAD IMAGES
    // =========================================================================
    const LazyLoadImages = {
        init() {
            const images = document.querySelectorAll('img[data-src]');
            if (!images.length) return;

            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));
        }
    };

    // =========================================================================
    // 9. PRICING TOGGLE (ONE-TIME VS SUBSCRIPTION)
    // =========================================================================
    const PricingToggle = {
        init() {
            const toggleBtns = document.querySelectorAll('[data-pricing-toggle]');
            if (!toggleBtns.length) return;

            toggleBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const mode = this.getAttribute('data-pricing-toggle');
                    const container = this.closest('[data-pricing-container]');

                    // Update active state
                    container.querySelectorAll('[data-pricing-toggle]').forEach(b => {
                        b.classList.remove('active');
                    });
                    this.classList.add('active');

                    // Show/hide pricing
                    container.querySelectorAll('[data-pricing-type]').forEach(el => {
                        if (el.getAttribute('data-pricing-type') === mode || mode === 'both') {
                            el.style.display = '';
                        } else {
                            el.style.display = 'none';
                        }
                    });
                });
            });
        }
    };

    // =========================================================================
    // 10. AJAX FORM SUBMIT
    // =========================================================================
    const AjaxForm = {
        init() {
            const forms = document.querySelectorAll('[data-ajax-form]');
            if (!forms.length) return;

            forms.forEach(form => {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('[type="submit"]');
                    const originalText = submitBtn.innerHTML;

                    // Show loading state
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Loading...';

                    try {
                        const response = await fetch(this.action, {
                            method: this.method || 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]')?.content
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            // Show success message
                            this.reset();
                            alert(data.message || 'Success!');
                        } else {
                            // Show error message
                            alert(data.message || 'An error occurred');
                        }
                    } catch (error) {
                        console.error('Form submission error:', error);
                        alert('An error occurred. Please try again.');
                    } finally {
                        // Restore button
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }
                });
            });
        }
    };

    // =========================================================================
    // 11. COPY TO CLIPBOARD
    // =========================================================================
    const CopyToClipboard = {
        init() {
            const copyBtns = document.querySelectorAll('[data-copy-text]');
            if (!copyBtns.length) return;

            copyBtns.forEach(btn => {
                btn.addEventListener('click', async function() {
                    const text = this.getAttribute('data-copy-text');
                    const originalText = this.innerHTML;

                    try {
                        await navigator.clipboard.writeText(text);
                        this.innerHTML = '<i class="bi bi-check"></i> Copied!';

                        setTimeout(() => {
                            this.innerHTML = originalText;
                        }, 2000);
                    } catch (error) {
                        console.error('Copy failed:', error);
                    }
                });
            });
        }
    };

    // =========================================================================
    // 12. TOOLTIP & POPOVER INITIALIZATION
    // =========================================================================
    const InitializeBootstrapComponents = {
        init() {
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(tooltipTriggerEl => {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Initialize popovers
            const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            popoverTriggerList.map(popoverTriggerEl => {
                return new bootstrap.Popover(popoverTriggerEl);
            });
        }
    };

    // =========================================================================
    // 13. SEARCH FUNCTIONALITY
    // =========================================================================
    const SearchFeature = {
        init() {
            const searchInputs = document.querySelectorAll('[data-search-input]');
            if (!searchInputs.length) return;

            searchInputs.forEach(input => {
                const targetSelector = input.getAttribute('data-search-target');
                const items = document.querySelectorAll(targetSelector);

                input.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase().trim();

                    items.forEach(item => {
                        const text = item.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
        }
    };

    // =========================================================================
    // 14. MOBILE MENU CLOSE ON CLICK
    // =========================================================================
    const MobileMenuClose = {
        init() {
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            const navbarCollapse = document.querySelector('.navbar-collapse');

            if (!navbarCollapse) return;

            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                            toggle: true
                        });
                    }
                });
            });
        }
    };

    // =========================================================================
    // 15. INITIALIZE ALL MODULES
    // =========================================================================
    const App = {
        init() {
            // Wait for DOM to be ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', () => {
                    this.initializeModules();
                });
            } else {
                this.initializeModules();
            }
        },

        initializeModules() {
            NetworkAnimation.init();
            CounterAnimation.init();
            NavbarScroll.init();
            BackToTop.init();
            SmoothScroll.init();
            FormValidation.init();
            AutoDismissAlerts.init();
            LazyLoadImages.init();
            PricingToggle.init();
            AjaxForm.init();
            CopyToClipboard.init();
            InitializeBootstrapComponents.init();
            SearchFeature.init();
            MobileMenuClose.init();

            console.log(' SITUNEO DIGITAL - Application initialized');
        }
    };

    // Start the application
    App.init();

})();
