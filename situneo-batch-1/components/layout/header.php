<!DOCTYPE html>
<html lang="<?php echo $lang ?? 'id'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- SEO Meta Tags -->
    <title><?php echo $page_title ?? 'SITUNEO - Website Era Baru untuk Bisnis Digital Anda'; ?></title>
    <meta name="description" content="<?php echo $page_description ?? 'SITUNEO: Platform pembuatan website profesional dengan 1500+ template. Beli Putus Rp 350K atau Sewa Rp 150K/bulan. Website era baru untuk bisnis Anda!'; ?>">
    <meta name="keywords" content="website, jasa pembuatan website, website murah, website profesional, situneo, digital agency">
    <meta name="author" content="SITUNEO Digital">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:title" content="<?php echo $page_title ?? 'SITUNEO - Website Era Baru'; ?>">
    <meta property="og:description" content="<?php echo $page_description ?? 'Platform pembuatan website profesional dengan 1500+ template'; ?>">
    <meta property="og:image" content="<?php echo SITE_URL; ?>/assets/images/og-image.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="twitter:title" content="<?php echo $page_title ?? 'SITUNEO - Website Era Baru'; ?>">
    <meta property="twitter:description" content="<?php echo $page_description ?? 'Platform pembuatan website profesional dengan 1500+ template'; ?>">
    <meta property="twitter:image" content="<?php echo SITE_URL; ?>/assets/images/og-image.jpg">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo SITE_URL; ?>/assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo SITE_URL; ?>/assets/images/favicon-16x16.png">
    <link rel="apple-touch-icon" href="<?php echo SITE_URL; ?>/assets/images/apple-touch-icon.png">

    <!-- Preconnect to CDNs for better performance -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- AOS (Animate On Scroll) -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/main.css?v=<?php echo filemtime(__DIR__ . '/../../assets/css/main.css'); ?>">

    <!-- Page-specific CSS -->
    <?php if (isset($page_css)): ?>
        <link rel="stylesheet" href="<?php echo SITE_URL . $page_css; ?>?v=<?php echo filemtime(__DIR__ . '/../../' . ltrim($page_css, '/')); ?>">
    <?php endif; ?>

    <!-- reCAPTCHA v3 -->
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo RECAPTCHA_SITE_KEY; ?>" async defer></script>

    <!-- Structured Data for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "SITUNEO Digital",
        "url": "<?php echo SITE_URL; ?>",
        "logo": "<?php echo SITE_URL; ?>/assets/images/logo.png",
        "description": "Platform pembuatan website profesional dengan 1500+ template",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Jl. Digital No. 123",
            "addressLocality": "Jakarta",
            "addressCountry": "ID"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+62-821-xxxx-xxxx",
            "contactType": "Customer Service",
            "availableLanguage": ["Indonesian", "English"]
        },
        "sameAs": [
            "https://facebook.com/situneo",
            "https://instagram.com/situneo",
            "https://twitter.com/situneo",
            "https://linkedin.com/company/situneo"
        ]
    }
    </script>
</head>
<body class="<?php echo $body_class ?? ''; ?>">

    <!-- Canvas for Particle Network Background -->
    <canvas id="particle-canvas"></canvas>

    <!-- Circuit Pattern Overlay -->
    <div class="circuit-overlay"></div>

    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="skip-to-main visually-hidden-focusable">Skip to main content</a>

    <!-- Navigation -->
    <?php include __DIR__ . '/navigation.php'; ?>
