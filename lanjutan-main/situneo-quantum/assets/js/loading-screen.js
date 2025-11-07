/**
 * SITUNEO DIGITAL - Loading Screen
 */

(function() {
    const loadingScreen = document.getElementById('loadingScreen');

    if (!loadingScreen) return;

    window.addEventListener('load', function() {
        setTimeout(function() {
            loadingScreen.classList.add('hidden');

            setTimeout(function() {
                loadingScreen.style.display = 'none';
            }, 500);
        }, 800);
    });
})();
