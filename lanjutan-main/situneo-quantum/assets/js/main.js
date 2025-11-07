/**
 * SITUNEO DIGITAL - Main JavaScript
 * Core functionality
 */

(function() {
    'use strict';

    // ===== INIT =====
    document.addEventListener('DOMContentLoaded', function() {
        initLoadingScreen();
        initNetworkBackground();
        initScrollEffects();
        initOrderNotifications();
        initSmoothScroll();
    });

    // ===== LOADING SCREEN =====
    function initLoadingScreen() {
        const loadingScreen = document.getElementById('loadingScreen');

        window.addEventListener('load', function() {
            setTimeout(function() {
                loadingScreen.classList.add('hidden');
                setTimeout(function() {
                    loadingScreen.style.display = 'none';
                }, 500);
            }, 800);
        });
    }

    // ===== SCROLL EFFECTS =====
    function initScrollEffects() {
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            const backToTop = document.getElementById('backToTop');

            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            // Back to top button
            if (window.scrollY > 300) {
                backToTop.style.display = 'flex';
            } else {
                backToTop.style.display = 'none';
            }
        });

        // Reveal on scroll
        const reveals = document.querySelectorAll('.reveal');

        function revealOnScroll() {
            reveals.forEach(function(element) {
                const windowHeight = window.innerHeight;
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;

                if (elementTop < windowHeight - elementVisible) {
                    element.classList.add('active');
                }
            });
        }

        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll(); // Initial check
    }

    // ===== SMOOTH SCROLL =====
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');

                if (href !== '#' && document.querySelector(href)) {
                    e.preventDefault();

                    document.querySelector(href).scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    // ===== BACK TO TOP =====
    window.scrollToTop = function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    };

    // ===== FAQ ACCORDION =====
    function initFAQ() {
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(function(item) {
            const question = item.querySelector('.faq-question');

            question.addEventListener('click', function() {
                // Close other items
                faqItems.forEach(function(otherItem) {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                    }
                });

                // Toggle current item
                item.classList.toggle('active');
            });
        });
    }

    // Init FAQ if exists
    if (document.querySelector('.faq-item')) {
        initFAQ();
    }

    // ===== PORTFOLIO FILTER =====
    function initPortfolioFilter() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const portfolioItems = document.querySelectorAll('.portfolio-item');

        filterBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');

                // Update active button
                filterBtns.forEach(function(b) {
                    b.classList.remove('active');
                });
                this.classList.add('active');

                // Filter items
                portfolioItems.forEach(function(item) {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                        setTimeout(function() {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        }, 10);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        setTimeout(function() {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
    }

    // Init portfolio filter if exists
    if (document.querySelector('.filter-btn')) {
        initPortfolioFilter();
    }

    // ===== FORM VALIDATION =====
    window.validateForm = function(form) {
        let isValid = true;
        const inputs = form.querySelectorAll('[required]');

        inputs.forEach(function(input) {
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
            }

            // Email validation
            if (input.type === 'email' && input.value.trim()) {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(input.value)) {
                    input.classList.add('is-invalid');
                    isValid = false;
                }
            }

            // Phone validation (Indonesia)
            if (input.type === 'tel' && input.value.trim()) {
                const phonePattern = /^(\+62|62|0)8[0-9]{8,11}$/;
                if (!phonePattern.test(input.value.replace(/\s/g, ''))) {
                    input.classList.add('is-invalid');
                    isValid = false;
                }
            }
        });

        return isValid;
    };

    // Auto-remove invalid class on input
    document.querySelectorAll('input, textarea, select').forEach(function(input) {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    });

    // ===== COUNT UP ANIMATION =====
    function countUp(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);

        const timer = setInterval(function() {
            start += increment;
            if (start >= target) {
                element.textContent = target.toLocaleString('id-ID');
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(start).toLocaleString('id-ID');
            }
        }, 16);
    }

    // Init count up for stats
    const stats = document.querySelectorAll('.hero-stat-number, .stats-value');
    let counted = false;

    function checkStats() {
        if (counted) return;

        stats.forEach(function(stat) {
            const rect = stat.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom >= 0) {
                const target = parseInt(stat.getAttribute('data-count') || stat.textContent.replace(/[^0-9]/g, ''));
                countUp(stat, target);
                counted = true;
            }
        });
    }

    window.addEventListener('scroll', checkStats);
    checkStats();

    // ===== COPY TO CLIPBOARD =====
    window.copyToClipboard = function(text) {
        navigator.clipboard.writeText(text).then(function() {
            showAlert('success', 'Copied to clipboard!');
        }).catch(function(err) {
            console.error('Failed to copy:', err);
            showAlert('error', 'Failed to copy');
        });
    };

    // ===== SHOW ALERT =====
    window.showAlert = function(type, message) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999;" role="alert">
                <i class="bi bi-${type === 'success' ? 'check-circle' : 'x-circle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', alertHtml);

        // Auto remove after 3 seconds
        setTimeout(function() {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }, 3000);
    };

})();
