/**
 * SITUNEO DIGITAL - Language Switcher
 * ID/EN language toggle
 */

(function() {
    const langBtns = document.querySelectorAll('.lang-btn');

    langBtns.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const lang = this.getAttribute('href').split('=')[1];

            // Update URL with language parameter
            const url = new URL(window.location);
            url.searchParams.set('lang', lang);
            window.location.href = url.toString();
        });
    });
})();
