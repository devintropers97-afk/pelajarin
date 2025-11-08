/**
 * SITUNEO - Main JavaScript
 * Following "fix wajib" design exactly
 */

(function() {
    'use strict';

    /* ==========================================================================
       LOADING SCREEN
       ========================================================================== */
    window.addEventListener('load', function() {
        const loadingScreen = document.getElementById('loading-screen');

        setTimeout(function() {
            loadingScreen.classList.add('hidden');

            // Remove from DOM after animation
            setTimeout(function() {
                if (loadingScreen && loadingScreen.parentNode) {
                    loadingScreen.parentNode.removeChild(loadingScreen);
                }
            }, 500);
        }, 1500);
    });

    /* ==========================================================================
       NETWORK PARTICLE BACKGROUND (80 PARTICLES)
       ========================================================================== */
    class NetworkBackground {
        constructor() {
            this.canvas = document.getElementById('network-canvas');
            if (!this.canvas) return;

            this.ctx = this.canvas.getContext('2d');
            this.particles = [];
            this.particleCount = 80;
            this.connectionDistance = 150;
            this.mouse = { x: null, y: null, radius: 150 };

            this.init();
            this.animate();
            this.setupEventListeners();
        }

        init() {
            this.resize();
            this.createParticles();
        }

        resize() {
            this.canvas.width = window.innerWidth;
            this.canvas.height = window.innerHeight;
        }

        createParticles() {
            this.particles = [];
            for (let i = 0; i < this.particleCount; i++) {
                this.particles.push({
                    x: Math.random() * this.canvas.width,
                    y: Math.random() * this.canvas.height,
                    vx: (Math.random() - 0.5) * 0.5,
                    vy: (Math.random() - 0.5) * 0.5,
                    radius: Math.random() * 2 + 1
                });
            }
        }

        connectParticles() {
            for (let i = 0; i < this.particles.length; i++) {
                for (let j = i + 1; j < this.particles.length; j++) {
                    const dx = this.particles[i].x - this.particles[j].x;
                    const dy = this.particles[i].y - this.particles[j].y;
                    const distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < this.connectionDistance) {
                        const opacity = 1 - (distance / this.connectionDistance);
                        this.ctx.strokeStyle = `rgba(255, 180, 0, ${opacity * 0.2})`;
                        this.ctx.lineWidth = 1;
                        this.ctx.beginPath();
                        this.ctx.moveTo(this.particles[i].x, this.particles[i].y);
                        this.ctx.lineTo(this.particles[j].x, this.particles[j].y);
                        this.ctx.stroke();
                    }
                }
            }
        }

        updateParticles() {
            for (let particle of this.particles) {
                particle.x += particle.vx;
                particle.y += particle.vy;

                // Bounce off edges
                if (particle.x < 0 || particle.x > this.canvas.width) {
                    particle.vx = -particle.vx;
                }
                if (particle.y < 0 || particle.y > this.canvas.height) {
                    particle.vy = -particle.vy;
                }

                // Mouse interaction
                if (this.mouse.x !== null && this.mouse.y !== null) {
                    const dx = this.mouse.x - particle.x;
                    const dy = this.mouse.y - particle.y;
                    const distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < this.mouse.radius) {
                        const force = (this.mouse.radius - distance) / this.mouse.radius;
                        particle.x -= (dx / distance) * force * 2;
                        particle.y -= (dy / distance) * force * 2;
                    }
                }
            }
        }

        drawParticles() {
            for (let particle of this.particles) {
                this.ctx.fillStyle = 'rgba(255, 180, 0, 0.6)';
                this.ctx.beginPath();
                this.ctx.arc(particle.x, particle.y, particle.radius, 0, Math.PI * 2);
                this.ctx.fill();
            }
        }

        animate() {
            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
            this.connectParticles();
            this.updateParticles();
            this.drawParticles();
            requestAnimationFrame(() => this.animate());
        }

        setupEventListeners() {
            window.addEventListener('resize', () => {
                this.resize();
                this.createParticles();
            });

            window.addEventListener('mousemove', (e) => {
                this.mouse.x = e.clientX;
                this.mouse.y = e.clientY;
            });

            window.addEventListener('mouseleave', () => {
                this.mouse.x = null;
                this.mouse.y = null;
            });
        }
    }

    // Initialize Network Background
    if (document.getElementById('network-canvas')) {
        new NetworkBackground();
    }

    /* ==========================================================================
       NAVBAR SCROLL EFFECTS
       ========================================================================== */
    const navbar = document.getElementById('navbar');
    let lastScrollTop = 0;

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Add scrolled class
        if (scrollTop > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        lastScrollTop = scrollTop;
    });

    /* ==========================================================================
       COUNTER ANIMATIONS
       ========================================================================== */
    function animateCounter(element, start, end, duration) {
        let startTime = null;

        function animation(currentTime) {
            if (!startTime) startTime = currentTime;
            const progress = Math.min((currentTime - startTime) / duration, 1);

            const current = Math.floor(progress * (end - start) + start);
            element.textContent = current.toLocaleString();

            if (progress < 1) {
                requestAnimationFrame(animation);
            } else {
                element.textContent = end.toLocaleString();
            }
        }

        requestAnimationFrame(animation);
    }

    // Intersection Observer for counters
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                entry.target.classList.add('counted');
                const target = parseInt(entry.target.getAttribute('data-target'));
                animateCounter(entry.target, 0, target, 2000);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.stat-number').forEach(counter => {
        counterObserver.observe(counter);
    });

    /* ==========================================================================
       AOS (ANIMATE ON SCROLL) INITIALIZATION
       ========================================================================== */
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });
    }

    /* ==========================================================================
       SMOOTH SCROLL FOR ANCHOR LINKS
       ========================================================================== */
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');

            if (href === '#' || href === '') return;

            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const offsetTop = target.offsetTop - 80;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    /* ==========================================================================
       FAQ ACCORDION
       ========================================================================== */
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');

        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');

            // Close all items
            faqItems.forEach(otherItem => {
                otherItem.classList.remove('active');
            });

            // Open clicked item if it wasn't active
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });

    /* ==========================================================================
       PORTFOLIO FILTER
       ========================================================================== */
    const portfolioFilters = document.querySelectorAll('.portfolio-filter');
    const portfolioItems = document.querySelectorAll('.portfolio-card');

    if (portfolioFilters.length > 0) {
        portfolioFilters.forEach(filter => {
            filter.addEventListener('click', function() {
                // Update active filter
                portfolioFilters.forEach(f => f.classList.remove('active'));
                this.classList.add('active');

                const filterValue = this.getAttribute('data-filter');

                // Filter items
                portfolioItems.forEach(item => {
                    if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        }, 10);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
    }

    /* ==========================================================================
       SERVICE DIVISION FILTER
       ========================================================================== */
    const divisionFilters = document.querySelectorAll('.division-filter');
    const serviceCards = document.querySelectorAll('.service-card');

    if (divisionFilters.length > 0) {
        divisionFilters.forEach(filter => {
            filter.addEventListener('click', function() {
                // Update active filter
                divisionFilters.forEach(f => f.classList.remove('active'));
                this.classList.add('active');

                const divisionValue = this.getAttribute('data-division');

                // Filter service cards
                serviceCards.forEach(card => {
                    if (divisionValue === 'all' || card.getAttribute('data-division') === divisionValue) {
                        card.style.display = 'block';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 10);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
    }

    /* ==========================================================================
       SEARCH FUNCTIONALITY
       ========================================================================== */
    const searchInput = document.getElementById('serviceSearch');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            serviceCards.forEach(card => {
                const title = card.querySelector('.service-title').textContent.toLowerCase();
                const desc = card.querySelector('.card-text')?.textContent.toLowerCase() || '';

                if (title.includes(searchTerm) || desc.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    /* ==========================================================================
       PRICE CALCULATOR
       ========================================================================== */
    const calculatorForm = document.getElementById('calculatorForm');

    if (calculatorForm) {
        const templateSelect = document.getElementById('templateSelect');
        const categorySelect = document.getElementById('categorySelect');
        const featuresCheckboxes = document.querySelectorAll('.feature-checkbox');
        const estimatedPrice = document.getElementById('estimatedPrice');

        function calculatePrice() {
            let basePrice = 0;

            // Template price
            if (templateSelect) {
                const templatePrice = parseInt(templateSelect.value) || 0;
                basePrice += templatePrice;
            }

            // Category multiplier
            if (categorySelect) {
                const categoryMultiplier = parseFloat(categorySelect.value) || 1;
                basePrice *= categoryMultiplier;
            }

            // Features
            let featuresPrice = 0;
            featuresCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    featuresPrice += parseInt(checkbox.getAttribute('data-price')) || 0;
                }
            });

            const totalPrice = basePrice + featuresPrice;

            if (estimatedPrice) {
                estimatedPrice.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
            }
        }

        // Event listeners
        if (templateSelect) {
            templateSelect.addEventListener('change', calculatePrice);
        }
        if (categorySelect) {
            categorySelect.addEventListener('change', calculatePrice);
        }
        featuresCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', calculatePrice);
        });

        // Initial calculation
        calculatePrice();
    }

    /* ==========================================================================
       FORM VALIDATION & SUBMISSION
       ========================================================================== */
    const contactForm = document.getElementById('contactForm');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form data
            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;

            // Disable button
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';

            // Simulate API call
            setTimeout(() => {
                // Success
                submitButton.innerHTML = '<i class="fas fa-check"></i> Terkirim!';
                submitButton.style.background = '#4CAF50';

                // Reset form
                this.reset();

                // Show success message
                alert('Terima kasih! Pesan Anda telah terkirim. Tim kami akan segera menghubungi Anda.');

                // Reset button
                setTimeout(() => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                    submitButton.style.background = '';
                }, 3000);
            }, 2000);
        });
    }

    /* ==========================================================================
       CAREER APPLICATION FORM
       ========================================================================== */
    const careerForm = document.getElementById('careerForm');

    if (careerForm) {
        careerForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;

            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';

            setTimeout(() => {
                submitButton.innerHTML = '<i class="fas fa-check"></i> Lamaran Terkirim!';
                submitButton.style.background = '#4CAF50';

                this.reset();

                alert('Terima kasih atas lamaran Anda! Tim HR kami akan meninjau dan menghubungi Anda segera.');

                setTimeout(() => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                    submitButton.style.background = '';
                }, 3000);
            }, 2500);
        });
    }

    /* ==========================================================================
       IMAGE LAZY LOADING
       ========================================================================== */
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            }
        });
    }, { rootMargin: '50px' });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });

    /* ==========================================================================
       TESTIMONIAL SLIDER (if needed)
       ========================================================================== */
    const testimonialSlider = document.querySelector('.testimonial-slider');

    if (testimonialSlider) {
        let currentSlide = 0;
        const slides = testimonialSlider.querySelectorAll('.testimonial-card');
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.display = i === index ? 'block' : 'none';
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        }

        // Auto slide
        setInterval(nextSlide, 5000);

        // Navigation buttons (if exist)
        const prevBtn = document.querySelector('.testimonial-prev');
        const nextBtn = document.querySelector('.testimonial-next');

        if (prevBtn) prevBtn.addEventListener('click', prevSlide);
        if (nextBtn) nextBtn.addEventListener('click', nextSlide);

        // Initialize
        showSlide(currentSlide);
    }

    /* ==========================================================================
       PRICING TABLE HOVER EFFECTS
       ========================================================================== */
    const pricingCards = document.querySelectorAll('.pricing-card');

    pricingCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });

        card.addEventListener('mouseleave', function() {
            if (!this.classList.contains('featured')) {
                this.style.transform = '';
            } else {
                this.style.transform = 'scale(1.05)';
            }
        });
    });

    /* ==========================================================================
       BLOG SEARCH
       ========================================================================== */
    const blogSearch = document.getElementById('blogSearch');

    if (blogSearch) {
        blogSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const blogCards = document.querySelectorAll('.blog-card');

            blogCards.forEach(card => {
                const title = card.querySelector('.blog-title')?.textContent.toLowerCase() || '';
                const excerpt = card.querySelector('.blog-excerpt')?.textContent.toLowerCase() || '';

                if (title.includes(searchTerm) || excerpt.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    /* ==========================================================================
       SCROLL ANIMATIONS
       ========================================================================== */
    const scrollElements = document.querySelectorAll('.scroll-animate');

    const elementInView = (el, offset = 100) => {
        const elementTop = el.getBoundingClientRect().top;
        return (elementTop <= (window.innerHeight || document.documentElement.clientHeight) - offset);
    };

    const displayScrollElement = (element) => {
        element.classList.add('scrolled');
    };

    const handleScrollAnimation = () => {
        scrollElements.forEach((el) => {
            if (elementInView(el, 100)) {
                displayScrollElement(el);
            }
        });
    };

    window.addEventListener('scroll', handleScrollAnimation);

    /* ==========================================================================
       PREVENT CONTEXT MENU ON IMAGES (Optional Security)
       ========================================================================== */
    document.querySelectorAll('img').forEach(img => {
        img.addEventListener('contextmenu', (e) => {
            // Uncomment to disable right-click on images
            // e.preventDefault();
        });
    });

    /* ==========================================================================
       UTILITY FUNCTIONS
       ========================================================================== */

    // Format Currency
    window.formatCurrency = function(number) {
        return 'Rp ' + number.toLocaleString('id-ID');
    };

    // Format Date
    window.formatDate = function(dateString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    };

    // Copy to Clipboard
    window.copyToClipboard = function(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Disalin ke clipboard!');
        });
    };

    // Share on Social Media
    window.shareOnSocial = function(platform, url, title) {
        let shareUrl = '';

        switch(platform) {
            case 'facebook':
                shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                break;
            case 'twitter':
                shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`;
                break;
            case 'linkedin':
                shareUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(url)}&title=${encodeURIComponent(title)}`;
                break;
            case 'whatsapp':
                shareUrl = `https://wa.me/?text=${encodeURIComponent(title + ' ' + url)}`;
                break;
        }

        if (shareUrl) {
            window.open(shareUrl, '_blank', 'width=600,height=400');
        }
    };

    /* ==========================================================================
       CONSOLE CREDITS
       ========================================================================== */
    console.log('%cSITUNEO', 'font-size: 48px; font-weight: bold; background: linear-gradient(90deg, #FFB400, #FFD700); -webkit-background-clip: text; -webkit-text-fill-color: transparent;');
    console.log('%cPlatform Website Profesional Berbasis AI', 'font-size: 14px; color: #1E5C99;');
    console.log('%cDeveloped with ❤️ by SITUNEO Team', 'font-size: 12px; color: #FFB400;');

})();
