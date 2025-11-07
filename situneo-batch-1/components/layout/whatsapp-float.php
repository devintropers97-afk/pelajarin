<!-- WhatsApp Floating Button -->
<div class="whatsapp-float" id="whatsappFloat">
    <a href="https://wa.me/<?php echo str_replace(['+', '-', ' '], '', WHATSAPP_NUMBER); ?>?text=<?php echo urlencode(WHATSAPP_DEFAULT_MESSAGE); ?>"
       target="_blank"
       rel="noopener noreferrer"
       class="whatsapp-button"
       title="Chat via WhatsApp"
       aria-label="Chat via WhatsApp">
        <i class="bi bi-whatsapp"></i>
        <span class="whatsapp-pulse"></span>
    </a>

    <!-- WhatsApp Chat Popup (Optional) -->
    <div class="whatsapp-popup" id="whatsappPopup">
        <div class="whatsapp-popup-header">
            <div class="d-flex align-items-center">
                <div class="whatsapp-avatar me-2">
                    <i class="bi bi-headset"></i>
                </div>
                <div>
                    <h6 class="mb-0">Customer Service</h6>
                    <small class="text-success">
                        <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i> Online
                    </small>
                </div>
            </div>
            <button class="whatsapp-close" id="whatsappClose" aria-label="Close chat">
                <i class="bi bi-x"></i>
            </button>
        </div>

        <div class="whatsapp-popup-body">
            <div class="chat-message">
                <div class="chat-bubble">
                    <p class="mb-2">👋 Halo! Selamat datang di SITUNEO.</p>
                    <p class="mb-0">
                        Ada yang bisa kami bantu? Klik tombol di bawah untuk chat langsung dengan tim kami.
                    </p>
                </div>
                <small class="chat-time"><?php echo date('H:i'); ?></small>
            </div>
        </div>

        <div class="whatsapp-popup-footer">
            <a href="https://wa.me/<?php echo str_replace(['+', '-', ' '], '', WHATSAPP_NUMBER); ?>?text=<?php echo urlencode(WHATSAPP_DEFAULT_MESSAGE); ?>"
               target="_blank"
               rel="noopener noreferrer"
               class="btn btn-success w-100">
                <i class="bi bi-whatsapp me-2"></i>
                Mulai Chat
            </a>
        </div>
    </div>
</div>

<style>
/* WhatsApp Floating Button Styles */
.whatsapp-float {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 9999;
}

.whatsapp-button {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #25D366, #128C7E);
    color: white;
    border-radius: 50%;
    font-size: 28px;
    box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
    transition: all 0.3s ease;
    text-decoration: none;
}

.whatsapp-button:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 30px rgba(37, 211, 102, 0.6);
    color: white;
}

.whatsapp-button i {
    animation: pulse-icon 2s ease-in-out infinite;
}

@keyframes pulse-icon {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

.whatsapp-pulse {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: rgba(37, 211, 102, 0.3);
    animation: pulse-ring 2s ease-out infinite;
    pointer-events: none;
}

@keyframes pulse-ring {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    100% {
        transform: scale(1.5);
        opacity: 0;
    }
}

/* WhatsApp Popup */
.whatsapp-popup {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 320px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.whatsapp-popup.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.whatsapp-popup-header {
    background: linear-gradient(135deg, #25D366, #128C7E);
    color: white;
    padding: 15px;
    border-radius: 12px 12px 0 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.whatsapp-avatar {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.whatsapp-close {
    background: transparent;
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.2s;
}

.whatsapp-close:hover {
    background: rgba(255, 255, 255, 0.1);
}

.whatsapp-popup-body {
    padding: 20px;
    background: #e5ddd5;
    min-height: 150px;
}

.chat-message {
    margin-bottom: 15px;
}

.chat-bubble {
    background: white;
    padding: 12px 15px;
    border-radius: 8px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    position: relative;
}

.chat-bubble::before {
    content: '';
    position: absolute;
    left: -8px;
    top: 10px;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 8px 8px 0;
    border-color: transparent white transparent transparent;
}

.chat-time {
    display: block;
    color: #667781;
    margin-top: 5px;
    font-size: 11px;
}

.whatsapp-popup-footer {
    padding: 15px;
    border-top: 1px solid #e0e0e0;
}

/* Mobile Responsive */
@media (max-width: 576px) {
    .whatsapp-float {
        bottom: 20px;
        right: 20px;
    }

    .whatsapp-button {
        width: 55px;
        height: 55px;
        font-size: 26px;
    }

    .whatsapp-popup {
        width: calc(100vw - 40px);
        right: -10px;
    }
}
</style>

<script>
// WhatsApp Popup Toggle
document.addEventListener('DOMContentLoaded', function() {
    const whatsappButton = document.querySelector('.whatsapp-button');
    const whatsappPopup = document.getElementById('whatsappPopup');
    const whatsappClose = document.getElementById('whatsappClose');

    // Show popup on button click (optional feature)
    // Uncomment if you want popup instead of direct WhatsApp link
    /*
    whatsappButton.addEventListener('click', function(e) {
        e.preventDefault();
        whatsappPopup.classList.toggle('show');
    });

    whatsappClose.addEventListener('click', function() {
        whatsappPopup.classList.remove('show');
    });

    // Close popup when clicking outside
    document.addEventListener('click', function(e) {
        if (!whatsappButton.contains(e.target) && !whatsappPopup.contains(e.target)) {
            whatsappPopup.classList.remove('show');
        }
    });
    */

    // Show/hide button on scroll
    let lastScroll = 0;
    const whatsappFloat = document.getElementById('whatsappFloat');

    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;

        if (currentScroll <= 100) {
            whatsappFloat.style.opacity = '0';
            whatsappFloat.style.pointerEvents = 'none';
        } else {
            whatsappFloat.style.opacity = '1';
            whatsappFloat.style.pointerEvents = 'auto';
        }

        lastScroll = currentScroll;
    });
});
</script>
