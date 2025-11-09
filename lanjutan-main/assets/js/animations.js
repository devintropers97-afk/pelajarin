/**
 * SITUNEO DIGITAL - GSAP Animations
 * Advanced animations menggunakan GSAP
 */

(function() {
    // Check if GSAP is loaded
    if (typeof gsap === 'undefined') {
        console.warn('GSAP not loaded');
        return;
    }

    // Register ScrollTrigger
    if (typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
    }

    // ===== HERO ANIMATIONS =====
    function animateHero() {
        const heroTimeline = gsap.timeline();

        heroTimeline
            .from('.hero-badge', {
                opacity: 0,
                y: -30,
                duration: 0.8,
                ease: 'back.out(1.7)'
            })
            .from('.hero-title', {
                opacity: 0,
                y: 30,
                duration: 0.8,
                ease: 'power3.out'
            }, '-=0.4')
            .from('.hero-subtitle', {
                opacity: 0,
                y: 20,
                duration: 0.8,
                ease: 'power3.out'
            }, '-=0.4')
            .from('.hero-description', {
                opacity: 0,
                y: 20,
                duration: 0.8
            }, '-=0.4')
            .from('.hero-buttons .btn', {
                opacity: 0,
                y: 20,
                stagger: 0.2,
                duration: 0.6
            }, '-=0.4')
            .from('.hero-stat-item', {
                opacity: 0,
                y: 20,
                stagger: 0.15,
                duration: 0.6
            }, '-=0.2');
    }

    // ===== CARD ANIMATIONS (on scroll) =====
    function animateCards() {
        const cards = document.querySelectorAll('.card-premium, .service-card, .pricing-card, .portfolio-card');

        cards.forEach((card, index) => {
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: 'top 80%',
                    toggleActions: 'play none none none'
                },
                opacity: 0,
                y: 50,
                duration: 0.8,
                delay: index * 0.1,
                ease: 'power3.out'
            });
        });
    }

    // ===== SECTION TITLE ANIMATIONS =====
    function animateSectionTitles() {
        const titles = document.querySelectorAll('.section-title');

        titles.forEach(title => {
            gsap.from(title, {
                scrollTrigger: {
                    trigger: title,
                    start: 'top 80%',
                    toggleActions: 'play none none none'
                },
                opacity: 0,
                scale: 0.8,
                duration: 1,
                ease: 'back.out(1.7)'
            });
        });
    }

    // ===== STATS COUNTER ANIMATION =====
    function animateStats() {
        const stats = document.querySelectorAll('[data-count]');

        stats.forEach(stat => {
            const target = parseInt(stat.getAttribute('data-count'));

            ScrollTrigger.create({
                trigger: stat,
                start: 'top 80%',
                once: true,
                onEnter: function() {
                    gsap.to(stat, {
                        innerHTML: target,
                        duration: 2,
                        snap: { innerHTML: 1 },
                        onUpdate: function() {
                            stat.textContent = Math.floor(this.targets()[0].innerHTML).toLocaleString('id-ID');
                        }
                    });
                }
            });
        });
    }

    // ===== INIT ALL ANIMATIONS =====
    document.addEventListener('DOMContentLoaded', function() {
        // Hero animations
        if (document.querySelector('.hero-section')) {
            setTimeout(animateHero, 1000);
        }

        // Scroll-triggered animations
        animateCards();
        animateSectionTitles();
        animateStats();
    });

})();
