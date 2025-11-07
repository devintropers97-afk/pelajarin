/**
 * SITUNEO - Main JavaScript
 * Website Era Baru untuk Bisnis Digital
 */

(function() {
    'use strict';

    // ========================================
    // 1. INITIALIZATION
    // ========================================
    document.addEventListener('DOMContentLoaded', function() {
        initAOS();
        initGSAP();
        initParticleNetwork();
        initNavigation();
        initScrollProgress();
        initBackToTop();
        initNewsletter();
        initLazyLoading();
        initSmoothScroll();
    });

    // ========================================
    // 2. AOS (Animate On Scroll) INIT
    // ========================================
    function initAOS() {
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100,
                delay: 100
            });
        }
    }

    // ========================================
    // 3. GSAP ANIMATIONS
    // ========================================
    function initGSAP() {
        if (typeof gsap === 'undefined') return;

        // Register ScrollTrigger plugin
        if (typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
        }

        // Animate hero elements
        const heroTimeline = gsap.timeline({ defaults: { ease: 'power3.out' } });

        if (document.querySelector('.hero-subtitle')) {
            heroTimeline.from('.hero-subtitle', {
                y: 50,
                opacity: 0,
                duration: 0.8
            });
        }

        if (document.querySelector('.hero-title')) {
            heroTimeline.from('.hero-title', {
                y: 50,
                opacity: 0,
                duration: 0.8
            }, '-=0.4');
        }

        if (document.querySelector('.hero-description')) {
            heroTimeline.from('.hero-description', {
                y: 50,
                opacity: 0,
                duration: 0.8
            }, '-=0.4');
        }

        if (document.querySelector('.hero-cta')) {
            heroTimeline.from('.hero-cta', {
                y: 50,
                opacity: 0,
                duration: 0.8
            }, '-=0.4');
        }

        if (document.querySelector('.hero-stats')) {
            heroTimeline.from('.hero-stats', {
                y: 50,
                opacity: 0,
                duration: 0.8
            }, '-=0.2');
        }

        // Animate cards on scroll
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: 'top 80%',
                    toggleActions: 'play none none none'
                },
                y: 50,
                opacity: 0,
                duration: 0.6,
                delay: index * 0.1
            });
        });

        // Parallax effect for sections
        const sections = document.querySelectorAll('.section');
        sections.forEach(section => {
            gsap.to(section, {
                scrollTrigger: {
                    trigger: section,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: 1
                },
                y: -50,
                ease: 'none'
            });
        });
    }

    // ========================================
    // 4. PARTICLE NETWORK BACKGROUND
    // ========================================
    function initParticleNetwork() {
        const canvas = document.getElementById('particle-canvas');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        let particlesArray = [];
        let mouse = {
            x: null,
            y: null,
            radius: 150
        };

        // Set canvas size
        function setCanvasSize() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        setCanvasSize();

        // Mouse move event
        window.addEventListener('mousemove', function(e) {
            mouse.x = e.x;
            mouse.y = e.y;
        });

        // Resize event
        window.addEventListener('resize', function() {
            setCanvasSize();
            init();
        });

        // Particle class
        class Particle {
            constructor(x, y, directionX, directionY, size, color) {
                this.x = x;
                this.y = y;
                this.directionX = directionX;
                this.directionY = directionY;
                this.size = size;
                this.color = color;
            }

            // Draw particle
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
                ctx.fillStyle = this.color;
                ctx.fill();
            }

            // Update particle position
            update() {
                // Bounce off edges
                if (this.x + this.size > canvas.width || this.x - this.size < 0) {
                    this.directionX = -this.directionX;
                }
                if (this.y + this.size > canvas.height || this.y - this.size < 0) {
                    this.directionY = -this.directionY;
                }

                // Check collision with mouse
                let dx = mouse.x - this.x;
                let dy = mouse.y - this.y;
                let distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < mouse.radius + this.size) {
                    if (mouse.x < this.x && this.x < canvas.width - this.size * 10) {
                        this.x += 10;
                    }
                    if (mouse.x > this.x && this.x > this.size * 10) {
                        this.x -= 10;
                    }
                    if (mouse.y < this.y && this.y < canvas.height - this.size * 10) {
                        this.y += 10;
                    }
                    if (mouse.y > this.y && this.y > this.size * 10) {
                        this.y -= 10;
                    }
                }

                // Move particle
                this.x += this.directionX;
                this.y += this.directionY;

                // Draw particle
                this.draw();
            }
        }

        // Create particles
        function init() {
            particlesArray = [];
            let numberOfParticles = (canvas.width * canvas.height) / 15000;

            for (let i = 0; i < numberOfParticles; i++) {
                let size = (Math.random() * 3) + 1;
                let x = (Math.random() * ((canvas.width - size * 2) - (size * 2)) + size * 2);
                let y = (Math.random() * ((canvas.height - size * 2) - (size * 2)) + size * 2);
                let directionX = (Math.random() * 0.4) - 0.2;
                let directionY = (Math.random() * 0.4) - 0.2;
                let color = 'rgba(30, 92, 153, 0.8)';

                particlesArray.push(new Particle(x, y, directionX, directionY, size, color));
            }
        }

        // Connect particles
        function connect() {
            for (let a = 0; a < particlesArray.length; a++) {
                for (let b = a; b < particlesArray.length; b++) {
                    let dx = particlesArray[a].x - particlesArray[b].x;
                    let dy = particlesArray[a].y - particlesArray[b].y;
                    let distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < 120) {
                        let opacity = 1 - (distance / 120);
                        ctx.strokeStyle = `rgba(255, 180, 0, ${opacity * 0.3})`;
                        ctx.lineWidth = 1;
                        ctx.beginPath();
                        ctx.moveTo(particlesArray[a].x, particlesArray[a].y);
                        ctx.lineTo(particlesArray[b].x, particlesArray[b].y);
                        ctx.stroke();
                    }
                }
            }
        }

        // Animation loop
        function animate() {
            requestAnimationFrame(animate);
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            for (let i = 0; i < particlesArray.length; i++) {
                particlesArray[i].update();
            }

            connect();
        }

        init();
        animate();
    }

    // ========================================
    // 5. NAVIGATION SCROLL EFFECTS
    // ========================================
    function initNavigation() {
        const navbar = document.getElementById('mainNav');
        if (!navbar) return;

        let lastScroll = 0;

        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;

            // Add scrolled class
            if (currentScroll > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            lastScroll = currentScroll;
        });

        // Close mobile menu when clicking on a link
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        const navbarCollapse = document.querySelector('.navbar-collapse');

        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (navbarCollapse.classList.contains('show')) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                    bsCollapse.hide();
                }
            });
        });
    }

    // ========================================
    // 6. SCROLL PROGRESS BAR
    // ========================================
    function initScrollProgress() {
        const progressBar = document.getElementById('scrollProgressBar');
        if (!progressBar) return;

        window.addEventListener('scroll', function() {
            const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (window.pageYOffset / windowHeight) * 100;
            progressBar.style.width = scrolled + '%';
        });
    }

    // ========================================
    // 7. BACK TO TOP BUTTON
    // ========================================
    function initBackToTop() {
        const backToTop = document.getElementById('backToTop');
        if (!backToTop) return;

        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });

        backToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // ========================================
    // 8. NEWSLETTER SUBSCRIPTION
    // ========================================
    function initNewsletter() {
        const form = document.getElementById('newsletterForm');
        if (!form) return;

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const emailInput = form.querySelector('input[name="email"]');
            const submitButton = form.querySelector('button[type="submit"]');
            const email = emailInput.value.trim();

            if (!email) return;

            // Disable button
            submitButton.disabled = true;
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Loading...';

            try {
                const response = await fetch('/api/newsletter-subscribe.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ email: email })
                });

                const data = await response.json();

                if (data.success) {
                    showAlert('success', 'Terima kasih! Anda telah berhasil subscribe newsletter kami.');
                    emailInput.value = '';
                } else {
                    showAlert('danger', data.message || 'Terjadi kesalahan. Silakan coba lagi.');
                }
            } catch (error) {
                showAlert('danger', 'Terjadi kesalahan koneksi. Silakan coba lagi.');
            } finally {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            }
        });
    }

    // ========================================
    // 9. LAZY LOADING IMAGES
    // ========================================
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const src = img.getAttribute('data-src');

                        if (src) {
                            img.src = src;
                            img.removeAttribute('data-src');
                            img.classList.add('loaded');
                        }

                        observer.unobserve(img);
                    }
                });
            });

            const images = document.querySelectorAll('img[data-src]');
            images.forEach(img => imageObserver.observe(img));
        } else {
            // Fallback for browsers that don't support IntersectionObserver
            const images = document.querySelectorAll('img[data-src]');
            images.forEach(img => {
                const src = img.getAttribute('data-src');
                if (src) {
                    img.src = src;
                    img.removeAttribute('data-src');
                }
            });
        }
    }

    // ========================================
    // 10. SMOOTH SCROLL FOR ANCHOR LINKS
    // ========================================
    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');

        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');

                if (href === '#' || href === '#!') return;

                const target = document.querySelector(href);

                if (target) {
                    e.preventDefault();
                    const offsetTop = target.offsetTop - 80; // Account for fixed navbar

                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    // ========================================
    // 11. COUNTER ANIMATION
    // ========================================
    function animateCounter(element, target, duration = 2000) {
        let current = 0;
        const increment = target / (duration / 16); // 60 FPS
        const suffix = element.getAttribute('data-suffix') || '';
        const prefix = element.getAttribute('data-prefix') || '';

        const timer = setInterval(() => {
            current += increment;

            if (current >= target) {
                current = target;
                clearInterval(timer);
            }

            element.textContent = prefix + Math.floor(current).toLocaleString() + suffix;
        }, 16);
    }

    // Initialize counters when in viewport
    const counterElements = document.querySelectorAll('[data-count]');

    if (counterElements.length > 0 && 'IntersectionObserver' in window) {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const target = parseInt(element.getAttribute('data-count'));
                    animateCounter(element, target);
                    counterObserver.unobserve(element);
                }
            });
        }, { threshold: 0.5 });

        counterElements.forEach(el => counterObserver.observe(el));
    }

    // ========================================
    // 12. ALERT HELPER
    // ========================================
    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
        alertDiv.style.zIndex = '9999';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

        document.body.appendChild(alertDiv);

        setTimeout(() => {
            alertDiv.classList.remove('show');
            setTimeout(() => alertDiv.remove(), 300);
        }, 5000);
    }

    // ========================================
    // 13. FORM VALIDATION HELPER
    // ========================================
    window.validateForm = function(formId) {
        const form = document.getElementById(formId);
        if (!form) return false;

        const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }
        });

        // Email validation
        const emailInputs = form.querySelectorAll('input[type="email"]');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        emailInputs.forEach(input => {
            if (input.value && !emailRegex.test(input.value)) {
                input.classList.add('is-invalid');
                isValid = false;
            }
        });

        return isValid;
    };

    // ========================================
    // 14. RECAPTCHA HELPER
    // ========================================
    window.executeRecaptcha = async function(action) {
        if (typeof grecaptcha === 'undefined') {
            console.warn('reCAPTCHA not loaded');
            return null;
        }

        try {
            const token = await grecaptcha.execute(window.RECAPTCHA_SITE_KEY || '', { action: action });
            return token;
        } catch (error) {
            console.error('reCAPTCHA error:', error);
            return null;
        }
    };

    // ========================================
    // 15. EXPORT FUNCTIONS TO GLOBAL SCOPE
    // ========================================
    window.SITUNEO = {
        showAlert: showAlert,
        validateForm: validateForm,
        executeRecaptcha: executeRecaptcha,
        animateCounter: animateCounter
    };

})();
