/**
 * SITUNEO DIGITAL - Order Notification Popup
 * Notifikasi pesanan baru (kiri bawah)
 */

(function() {
    const notifications = [
        { name: 'Budi Santoso', service: 'Website Toko Online', time: '2 menit yang lalu', location: 'Jakarta' },
        { name: 'Sarah Wijaya', service: 'SEO Premium', time: '5 menit yang lalu', location: 'Bandung' },
        { name: 'Ahmad Fauzi', service: 'Company Profile', time: '8 menit yang lalu', location: 'Surabaya' },
        { name: 'Rina Kusuma', service: 'Chatbot AI', time: '12 menit yang lalu', location: 'Yogyakarta' },
        { name: 'Dedi Prasetyo', service: 'Google Ads', time: '15 menit yang lalu', location: 'Semarang' }
    ];

    let currentIndex = 0;
    let notificationInterval;

    function showNotification() {
        const notification = document.getElementById('orderNotification');
        if (!notification) return;

        const data = notifications[currentIndex];

        notification.querySelector('.notification-text').textContent =
            `${data.name} dari ${data.location} baru saja memesan ${data.service}`;
        notification.querySelector('.notification-time').textContent = data.time;

        notification.classList.add('show');

        setTimeout(function() {
            notification.classList.remove('show');
        }, 5000);

        currentIndex = (currentIndex + 1) % notifications.length;
    }

    // Mulai notifikasi setelah 5 detik
    setTimeout(function() {
        showNotification();

        // Ulangi setiap 15 detik
        notificationInterval = setInterval(showNotification, 15000);
    }, 5000);

    window.closeOrderNotification = function() {
        const notification = document.getElementById('orderNotification');
        if (notification) {
            notification.classList.remove('show');
        }
    };
})();
