<!DOCTYPE html>
<html lang="<?php echo $lang === 'en' ? 'en' : 'id'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo $t['meta_description'] ?? 'SITUNEO - Jasa Pembuatan Website Profesional Berbasis AI. Platform Digital yang Menghubungkan Bisnis dengan Freelancer Terbaik.'; ?>">
    <meta name="keywords" content="jasa pembuatan website, website profesional, jasa web design, pembuatan website murah, website bisnis, landing page, toko online, web developer Indonesia">
    <meta name="author" content="SITUNEO Digital">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo $t['og_title'] ?? 'SITUNEO - Platform Website Profesional Berbasis AI'; ?>">
    <meta property="og:description" content="<?php echo $t['meta_description'] ?? 'Buat website profesional dengan mudah. Hubungkan bisnis Anda dengan freelancer terbaik.'; ?>">
    <meta property="og:image" content="<?php echo $baseURL ?? '/'; ?>assets/images/og-image.jpg">
    <meta property="og:url" content="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $t['og_title'] ?? 'SITUNEO - Platform Website Profesional'; ?>">
    <meta name="twitter:description" content="<?php echo $t['meta_description'] ?? 'Buat website profesional dengan mudah.'; ?>">
    <meta name="twitter:image" content="<?php echo $baseURL ?? '/'; ?>assets/images/twitter-card.jpg">

    <title><?php echo $pageTitle ?? 'SITUNEO - Platform Website Profesional Berbasis AI'; ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo $baseURL ?? '/'; ?>assets/images/favicon.png">
    <link rel="apple-touch-icon" href="<?php echo $baseURL ?? '/'; ?>assets/images/apple-touch-icon.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo $baseURL ?? '/'; ?>assets/css/main-new.css">

    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "SITUNEO",
        "description": "Platform Website Profesional Berbasis AI",
        "url": "<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>",
        "logo": "<?php echo $baseURL ?? '/'; ?>assets/images/logo.png",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+62-812-3456-7890",
            "contactType": "Customer Service",
            "areaServed": "ID",
            "availableLanguage": ["Indonesian", "English"]
        },
        "sameAs": [
            "https://facebook.com/situneo",
            "https://twitter.com/situneo",
            "https://instagram.com/situneo",
            "https://linkedin.com/company/situneo"
        ]
    }
    </script>
</head>
<body>
    <!-- Loading Screen -->
    <div id="loading-screen">
        <div class="loading-content">
            <div class="logo-container">
                <div class="rotating-border"></div>
                <div class="logo-pulse">
                    <i class="fas fa-globe"></i>
                </div>
            </div>
            <div class="loading-text">SITUNEO</div>
            <div class="loading-spinner">
                <div class="spinner-dot"></div>
                <div class="spinner-dot"></div>
                <div class="spinner-dot"></div>
            </div>
        </div>
    </div>

    <!-- Network Particle Background -->
    <canvas id="network-canvas"></canvas>

    <!-- Circuit Pattern Overlay -->
    <div class="circuit-pattern"></div>
