<!-- WhatsApp Float Button -->
<div class="whatsapp-float" id="whatsappFloat">
    <button class="whatsapp-btn" id="whatsappBtn">
        <i class="fab fa-whatsapp"></i>
        <div class="whatsapp-pulse"></div>
    </button>

    <!-- WhatsApp Popup Chat Preview -->
    <div class="whatsapp-popup" id="whatsappPopup">
        <div class="whatsapp-popup-header">
            <div class="whatsapp-avatar">
                <img src="https://ui-avatars.com/api/?name=SITUNEO+Support&background=25D366&color=fff&size=40" alt="Support">
                <span class="online-indicator"></span>
            </div>
            <div class="whatsapp-info">
                <h5>SITUNEO Support</h5>
                <p><?php echo $t['whatsapp_status'] ?? 'Online - Siap Membantu'; ?></p>
            </div>
            <button class="whatsapp-close" id="whatsappClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="whatsapp-popup-body">
            <div class="whatsapp-message">
                <div class="message-bubble">
                    <p><?php echo $t['whatsapp_greeting'] ?? 'Halo! 👋 Ada yang bisa kami bantu?'; ?></p>
                    <span class="message-time">
                        <?php echo date('H:i'); ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="whatsapp-popup-footer">
            <a href="https://wa.me/6281234567890?text=<?php echo urlencode($t['whatsapp_default_message'] ?? 'Halo SITUNEO, saya tertarik dengan layanan Anda.'); ?>" target="_blank" class="whatsapp-send-btn">
                <i class="fab fa-whatsapp"></i>
                <span><?php echo $t['whatsapp_chat_now'] ?? 'Chat Sekarang'; ?></span>
            </a>
        </div>
    </div>
</div>

<!-- Order Notification Popup (Random) -->
<div class="order-notification" id="orderNotification">
    <div class="order-notification-content">
        <div class="order-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="order-info">
            <p class="order-name" id="orderName">Budi Santoso</p>
            <p class="order-service" id="orderService"><?php echo $t['order_purchased'] ?? 'Baru saja memesan'; ?> <strong>Website Company Profile</strong></p>
            <p class="order-time" id="orderTime">5 <?php echo $t['minutes_ago'] ?? 'menit yang lalu'; ?></p>
        </div>
        <button class="order-close" id="orderClose">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<!-- Back to Top Button -->
<button class="back-to-top" id="backToTop">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
// WhatsApp Popup Toggle
document.addEventListener('DOMContentLoaded', function() {
    const whatsappBtn = document.getElementById('whatsappBtn');
    const whatsappPopup = document.getElementById('whatsappPopup');
    const whatsappClose = document.getElementById('whatsappClose');

    if (whatsappBtn) {
        whatsappBtn.addEventListener('click', function() {
            whatsappPopup.classList.toggle('active');
        });
    }

    if (whatsappClose) {
        whatsappClose.addEventListener('click', function() {
            whatsappPopup.classList.remove('active');
        });
    }

    // Close popup when clicking outside
    document.addEventListener('click', function(event) {
        const whatsappFloat = document.getElementById('whatsappFloat');
        if (!whatsappFloat.contains(event.target) && whatsappPopup.classList.contains('active')) {
            whatsappPopup.classList.remove('active');
        }
    });
});

// Order Notification - Random Popup
const orderData = [
    { name: 'Budi Santoso', service: '<?php echo $t['service_company_profile'] ?? 'Website Company Profile'; ?>', time: '5 <?php echo $t['minutes_ago'] ?? 'menit yang lalu'; ?>' },
    { name: 'Siti Nurhaliza', service: '<?php echo $t['service_online_store'] ?? 'Toko Online'; ?>', time: '12 <?php echo $t['minutes_ago'] ?? 'menit yang lalu'; ?>' },
    { name: 'Ahmad Yani', service: '<?php echo $t['service_landing_page'] ?? 'Landing Page'; ?>', time: '23 <?php echo $t['minutes_ago'] ?? 'menit yang lalu'; ?>' },
    { name: 'Dewi Lestari', service: '<?php echo $t['service_blog'] ?? 'Website Blog'; ?>', time: '35 <?php echo $t['minutes_ago'] ?? 'menit yang lalu'; ?>' },
    { name: 'Rudi Hartono', service: '<?php echo $t['service_portfolio'] ?? 'Website Portfolio'; ?>', time: '48 <?php echo $t['minutes_ago'] ?? 'menit yang lalu'; ?>' }
];

function showOrderNotification() {
    const notification = document.getElementById('orderNotification');
    const randomOrder = orderData[Math.floor(Math.random() * orderData.length)];

    document.getElementById('orderName').textContent = randomOrder.name;
    document.getElementById('orderService').innerHTML = '<?php echo $t['order_purchased'] ?? 'Baru saja memesan'; ?> <strong>' + randomOrder.service + '</strong>';
    document.getElementById('orderTime').textContent = randomOrder.time;

    notification.classList.add('show');

    setTimeout(() => {
        notification.classList.remove('show');
    }, 8000);
}

// Show notification randomly
setTimeout(() => {
    showOrderNotification();
    setInterval(showOrderNotification, 45000); // Every 45 seconds
}, 5000); // First show after 5 seconds

// Close order notification
document.getElementById('orderClose').addEventListener('click', function() {
    document.getElementById('orderNotification').classList.remove('show');
});

// Back to Top Button
window.addEventListener('scroll', function() {
    const backToTop = document.getElementById('backToTop');
    if (window.pageYOffset > 300) {
        backToTop.classList.add('show');
    } else {
        backToTop.classList.remove('show');
    }
});

document.getElementById('backToTop').addEventListener('click', function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
</script>
