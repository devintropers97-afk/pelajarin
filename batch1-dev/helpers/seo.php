<?php
/**
 * SEO Helper Functions
 */

function generate_meta_tags($title, $description, $keywords = '', $image = null) {
    $site_name = getenv('COMPANY_NAME') ?: 'SITUNEO DIGITAL';
    $site_url = BASE_URL;
    
    $meta = [];
    
    // Basic meta tags
    $meta[] = '<title>' . htmlspecialchars($title) . '</title>';
    $meta[] = '<meta name="description" content="' . htmlspecialchars($description) . '">';
    if ($keywords) {
        $meta[] = '<meta name="keywords" content="' . htmlspecialchars($keywords) . '">';
    }
    
    // Open Graph
    $meta[] = '<meta property="og:title" content="' . htmlspecialchars($title) . '">';
    $meta[] = '<meta property="og:description" content="' . htmlspecialchars($description) . '">';
    $meta[] = '<meta property="og:site_name" content="' . $site_name . '">';
    $meta[] = '<meta property="og:url" content="' . $site_url . $_SERVER['REQUEST_URI'] . '">';
    
    if ($image) {
        $meta[] = '<meta property="og:image" content="' . $image . '">';
    }
    
    // Twitter Card
    $meta[] = '<meta name="twitter:card" content="summary_large_image">';
    $meta[] = '<meta name="twitter:title" content="' . htmlspecialchars($title) . '">';
    $meta[] = '<meta name="twitter:description" content="' . htmlspecialchars($description) . '">';
    
    if ($image) {
        $meta[] = '<meta name="twitter:image" content="' . $image . '">';
    }
    
    return implode("\n", $meta);
}

function generate_sitemap() {
    $db = Database::getInstance();
    $site_url = BASE_URL;
    
    $urls = [];
    
    // Static pages
    $urls[] = ['loc' => $site_url, 'priority' => '1.0'];
    $urls[] = ['loc' => $site_url . 'services', 'priority' => '0.9'];
    $urls[] = ['loc' => $site_url . 'portfolio', 'priority' => '0.8'];
    $urls[] = ['loc' => $site_url . 'about', 'priority' => '0.7'];
    $urls[] = ['loc' => $site_url . 'contact', 'priority' => '0.7'];
    
    // Services
    $services = $db->query("SELECT slug, updated_at FROM services WHERE is_active = 1")->fetchAll();
    foreach ($services as $service) {
        $urls[] = [
            'loc' => $site_url . 'service-detail/' . $service['slug'],
            'lastmod' => date('Y-m-d', strtotime($service['updated_at'])),
            'priority' => '0.8'
        ];
    }
    
    // Generate XML
    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    
    foreach ($urls as $url) {
        $xml .= '<url>';
        $xml .= '<loc>' . htmlspecialchars($url['loc']) . '</loc>';
        if (isset($url['lastmod'])) {
            $xml .= '<lastmod>' . $url['lastmod'] . '</lastmod>';
        }
        if (isset($url['priority'])) {
            $xml .= '<priority>' . $url['priority'] . '</priority>';
        }
        $xml .= '</url>';
    }
    
    $xml .= '</urlset>';
    
    return $xml;
}
