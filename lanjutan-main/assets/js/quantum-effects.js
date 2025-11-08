/**
 * SITUNEO DIGITAL - QUANTUM EFFECTS
 * Hover Glow & Parallax Scroll Effects
 */

// ===== HOVER GLOW EFFECT UNTUK BUTTONS =====
document.addEventListener('DOMContentLoaded', function() {

    // Apply hover glow to all buttons
    const buttons = document.querySelectorAll('button, .btn-gold, .btn-outline-gold, a.btn');

    buttons.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 0 20px var(--gold)';
        });

        btn.addEventListener('mouseleave', function() {
            // Reset to original shadow
            if(this.classList.contains('btn-gold')) {
                this.style.boxShadow = 'var(--shadow-gold-sm)';
            } else {
                this.style.boxShadow = 'none';
            }
        });
    });

    // ===== PARALLAX SCROLL EFFECT =====
    const parallaxElements = document.querySelectorAll('[data-parallax]');

    if(parallaxElements.length > 0) {
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;

            parallaxElements.forEach(element => {
                const speed = element.dataset.parallax || 0.5;
                const yPos = -(scrolled * speed);
                element.style.transform = `translateY(${yPos}px)`;
            });
        });
    }

    // ===== REVEAL ON SCROLL =====
    const revealElements = document.querySelectorAll('.reveal');

    const revealOnScroll = () => {
        revealElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            if(elementTop < windowHeight - 100) {
                element.classList.add('active');
            }
        });
    };

    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll(); // Initial check

    // ===== CARD HOVER GLOW =====
    const cards = document.querySelectorAll('.card-premium, .card-glass');

    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.boxShadow = 'var(--shadow-gold-md)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.boxShadow = 'var(--shadow-md)';
        });
    });

    // ===== SMOOTH SCROLL TO TOP =====
    const backToTop = document.getElementById('backToTop');

    if(backToTop) {
        window.addEventListener('scroll', function() {
            if(window.pageYOffset > 300) {
                backToTop.style.display = 'flex';
            } else {
                backToTop.style.display = 'none';
            }
        });
    }

    // ===== NAVBAR SCROLL EFFECT =====
    const navbar = document.querySelector('.navbar-premium');

    if(navbar) {
        window.addEventListener('scroll', function() {
            if(window.pageYOffset > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // ===== TEXT SHIMMER ON HOVER =====
    const shimmerTexts = document.querySelectorAll('.hero-title, .section-title');

    shimmerTexts.forEach(text => {
        text.addEventListener('mouseenter', function() {
            this.classList.add('shimmer');
        });

        text.addEventListener('mouseleave', function() {
            setTimeout(() => {
                this.classList.remove('shimmer');
            }, 3000);
        });
    });

    console.log('✨ Quantum Effects Loaded - Teknologi Rasa Mewah');
});

// ===== SCROLL TO TOP FUNCTION =====
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}
