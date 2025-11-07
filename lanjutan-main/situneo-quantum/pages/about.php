<?php
// Set page title
$pageTitle = 'Tentang Kami - SITUNEO DIGITAL | Agency Digital Terpercaya Sejak 2020';
$pageDescription = 'Kenali SITUNEO DIGITAL lebih dekat. Partner digital terpercaya sejak 2020 dengan 500+ client puas. NIB Resmi, tim profesional, dan komitmen untuk kesuksesan bisnis Anda.';

// Include header
include __DIR__ . '/../includes/header.php';

// Multi-language text
$text = [
    'id' => [
        'hero_title' => 'Tentang SITUNEO DIGITAL',
        'hero_subtitle' => 'Partner Digital Terpercaya untuk Kesuksesan Bisnis Anda',
        'hero_desc' => 'Sejak 2020, kami telah membantu 500+ bisnis tumbuh dan sukses di era digital',
        'section_story' => 'Cerita Kami',
        'section_vision' => 'Visi & Misi',
        'section_values' => 'Nilai-Nilai Kami',
        'section_team' => 'Tim Profesional Kami',
        'section_timeline' => 'Perjalanan Kami',
        'section_why' => 'Kenapa Pilih Kami?',
        'section_stats' => 'Pencapaian Kami',
        'section_cta' => 'Siap Bergabung dengan 500+ Client Kami?',
        'btn_contact' => 'Hubungi Kami',
        'btn_demo' => 'Request Demo Gratis',
        'story_text' => 'SITUNEO DIGITAL lahir dari passion untuk membantu bisnis Indonesia go digital. Berawal dari tim kecil di 2020, kini kami telah berkembang menjadi agency digital terpercaya dengan 500+ client di seluruh Indonesia.',
        'vision_title' => 'Visi Kami',
        'vision_text' => 'Menjadi agency digital terdepan di Indonesia yang menghadirkan solusi inovatif dan berkualitas tinggi untuk setiap bisnis.',
        'mission_title' => 'Misi Kami',
        'mission_1' => 'Memberikan layanan digital berkualitas tinggi dengan harga terjangkau',
        'mission_2' => 'Membantu UMKM dan bisnis besar go digital dengan mudah',
        'mission_3' => 'Inovasi terus-menerus untuk solusi terbaik',
        'mission_4' => 'Membangun kemitraan jangka panjang dengan client',
        'value_1_title' => 'Profesionalisme',
        'value_1_desc' => 'Kami bekerja dengan standar profesional tertinggi',
        'value_2_title' => 'Inovasi',
        'value_2_desc' => 'Selalu menggunakan teknologi terkini',
        'value_3_title' => 'Integritas',
        'value_3_desc' => 'Transparansi dan kejujuran dalam setiap layanan',
        'value_4_title' => 'Customer First',
        'value_4_desc' => 'Kepuasan client adalah prioritas utama',
    ],
    'en' => [
        'hero_title' => 'About SITUNEO DIGITAL',
        'hero_subtitle' => 'Trusted Digital Partner for Your Business Success',
        'hero_desc' => 'Since 2020, we\'ve helped 500+ businesses grow and succeed in the digital era',
        'section_story' => 'Our Story',
        'section_vision' => 'Vision & Mission',
        'section_values' => 'Our Values',
        'section_team' => 'Our Professional Team',
        'section_timeline' => 'Our Journey',
        'section_why' => 'Why Choose Us?',
        'section_stats' => 'Our Achievements',
        'section_cta' => 'Ready to Join Our 500+ Clients?',
        'btn_contact' => 'Contact Us',
        'btn_demo' => 'Request Free Demo',
        'story_text' => 'SITUNEO DIGITAL was born from a passion to help Indonesian businesses go digital. Starting as a small team in 2020, we have now grown into a trusted digital agency with 500+ clients across Indonesia.',
        'vision_title' => 'Our Vision',
        'vision_text' => 'To become the leading digital agency in Indonesia, delivering innovative and high-quality solutions for every business.',
        'mission_title' => 'Our Mission',
        'mission_1' => 'Provide high-quality digital services at affordable prices',
        'mission_2' => 'Help SMEs and large businesses go digital easily',
        'mission_3' => 'Continuous innovation for the best solutions',
        'mission_4' => 'Build long-term partnerships with clients',
        'value_1_title' => 'Professionalism',
        'value_1_desc' => 'We work with the highest professional standards',
        'value_2_title' => 'Innovation',
        'value_2_desc' => 'Always using the latest technology',
        'value_3_title' => 'Integrity',
        'value_3_desc' => 'Transparency and honesty in every service',
        'value_4_title' => 'Customer First',
        'value_4_desc' => 'Client satisfaction is our top priority',
    ]
];

$t = $text[$lang];
?>

<!-- HERO SECTION -->
<section class="hero-section about-hero" id="about-hero">
    <div class="container">
        <div class="hero-content text-center" data-aos="fade-up">
            <h1 class="hero-title">
                <?= $t['hero_title'] ?>
            </h1>

            <h2 class="hero-subtitle"><?= $t['hero_subtitle'] ?></h2>

            <p class="hero-description"><?= $t['hero_desc'] ?></p>

            <div class="hero-badge">
                <i class="bi bi-patch-check-fill me-2"></i>
                NIB Resmi: <?= COMPANY_NIB ?>
            </div>
        </div>
    </div>
</section>

<!-- STORY SECTION -->
<section class="about-section" id="story">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="section-title text-start"><?= $t['section_story'] ?></h2>

                <p class="text-light fs-5 mb-4">
                    <?= $t['story_text'] ?>
                </p>

                <p class="text-light">
                    Kami percaya bahwa setiap bisnis berhak mendapatkan solusi digital terbaik.
                    Dengan tim profesional, teknologi terkini, dan dedikasi penuh, kami hadir
                    untuk mewujudkan visi digital Anda.
                </p>

                <div class="mt-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-check-circle-fill text-gold fs-4 me-3"></i>
                        <span class="text-light">NIB & NPWP Resmi Terdaftar</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-check-circle-fill text-gold fs-4 me-3"></i>
                        <span class="text-light">500+ Client di Seluruh Indonesia</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-check-circle-fill text-gold fs-4 me-3"></i>
                        <span class="text-light">1200+ Project Selesai</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill text-gold fs-4 me-3"></i>
                        <span class="text-light">Rating 4.9/5.0 dari Customer</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="about-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800"
                         alt="SITUNEO DIGITAL Team"
                         class="img-fluid rounded-4 shadow-premium">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VISION & MISSION -->
<section id="vision-mission">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-up">
                <div class="card-premium h-100">
                    <div class="text-center mb-4">
                        <div class="about-feature-icon d-inline-block">
                            <i class="bi bi-eye-fill"></i>
                        </div>
                        <h3 class="text-gold mt-3"><?= $t['vision_title'] ?></h3>
                    </div>
                    <p class="text-light fs-5 text-center">
                        <?= $t['vision_text'] ?>
                    </p>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card-premium h-100">
                    <div class="text-center mb-4">
                        <div class="about-feature-icon d-inline-block">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <h3 class="text-gold mt-3"><?= $t['mission_title'] ?></h3>
                    </div>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-gold me-2"></i>
                            <?= $t['mission_1'] ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-gold me-2"></i>
                            <?= $t['mission_2'] ?>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-gold me-2"></i>
                            <?= $t['mission_3'] ?>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill text-gold me-2"></i>
                            <?= $t['mission_4'] ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VALUES SECTION -->
<section class="about-section" id="values">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_values'] ?></h2>

        <div class="row g-4 mt-4">
            <?php
            $values = [
                ['icon' => 'award', 'title' => $t['value_1_title'], 'desc' => $t['value_1_desc']],
                ['icon' => 'lightbulb', 'title' => $t['value_2_title'], 'desc' => $t['value_2_desc']],
                ['icon' => 'shield-check', 'title' => $t['value_3_title'], 'desc' => $t['value_3_desc']],
                ['icon' => 'heart', 'title' => $t['value_4_title'], 'desc' => $t['value_4_desc']],
            ];

            $delay = 100;
            foreach ($values as $value):
            ?>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                <div class="card-premium text-center h-100">
                    <div class="about-feature-icon d-inline-block mb-3">
                        <i class="bi bi-<?= $value['icon'] ?>"></i>
                    </div>
                    <h4 class="text-gold"><?= $value['title'] ?></h4>
                    <p class="text-light"><?= $value['desc'] ?></p>
                </div>
            </div>
            <?php
            $delay += 100;
            endforeach;
            ?>
        </div>
    </div>
</section>

<!-- TEAM SECTION -->
<section id="team">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_team'] ?></h2>

        <p class="section-subtitle" data-aos="fade-up">
            Tim berpengalaman yang siap membantu kesuksesan bisnis Anda
        </p>

        <div class="row g-4 mt-4">
            <?php
            $team = [
                [
                    'name' => 'Devin Prasetyo Hermawan',
                    'position' => 'CEO & Founder',
                    'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
                    'desc' => 'Visioner di balik SITUNEO DIGITAL dengan pengalaman 7+ tahun di bidang digital',
                    'linkedin' => '#',
                    'email' => 'devin@situneo.my.id'
                ],
                [
                    'name' => 'Budi Santoso',
                    'position' => 'CTO - Chief Technology Officer',
                    'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400',
                    'desc' => 'Expert technology dengan spesialisasi AI, Cloud Computing, dan Web Development',
                    'linkedin' => '#',
                    'email' => 'budi@situneo.my.id'
                ],
                [
                    'name' => 'Sarah Wijaya',
                    'position' => 'Creative Director',
                    'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400',
                    'desc' => 'Desainer handal dengan portfolio 300+ project design yang stunning',
                    'linkedin' => '#',
                    'email' => 'sarah@situneo.my.id'
                ],
                [
                    'name' => 'Maya Putri',
                    'position' => 'Head of Digital Marketing',
                    'image' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=400',
                    'desc' => 'Spesialis marketing digital dengan track record meningkatkan sales 500%',
                    'linkedin' => '#',
                    'email' => 'maya@situneo.my.id'
                ],
            ];

            $delay = 100;
            foreach ($team as $member):
            ?>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                <div class="card-premium team-card">
                    <div class="team-image-wrapper">
                        <img src="<?= $member['image'] ?>"
                             alt="<?= $member['name'] ?>"
                             class="team-image">
                    </div>
                    <div class="team-info">
                        <h4 class="text-gold"><?= $member['name'] ?></h4>
                        <p class="text-bright-gold mb-3"><?= $member['position'] ?></p>
                        <p class="text-light small"><?= $member['desc'] ?></p>
                        <div class="team-social mt-3">
                            <a href="<?= $member['linkedin'] ?>" class="btn btn-sm btn-outline-gold me-2">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="mailto:<?= $member['email'] ?>" class="btn btn-sm btn-outline-gold">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $delay += 100;
            endforeach;
            ?>
        </div>
    </div>
</section>

<!-- TIMELINE SECTION -->
<section class="about-section" id="timeline">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_timeline'] ?></h2>

        <p class="section-subtitle" data-aos="fade-up">
            Dari startup kecil hingga menjadi agency terpercaya
        </p>

        <div class="timeline-wrapper mt-5">
            <?php
            $timeline = [
                [
                    'year' => '2020',
                    'title' => 'Awal Perjalanan',
                    'desc' => 'SITUNEO DIGITAL didirikan dengan tim 3 orang. Fokus pada pembuatan website untuk UMKM.',
                    'stats' => '15 Client Pertama'
                ],
                [
                    'year' => '2021',
                    'title' => 'Ekspansi Layanan',
                    'desc' => 'Menambah layanan SEO, Digital Marketing, dan Branding. Tim berkembang menjadi 10 orang.',
                    'stats' => '100+ Client'
                ],
                [
                    'year' => '2022',
                    'title' => 'Teknologi AI',
                    'desc' => 'Mengintegrasikan AI dan automation. Meluncurkan layanan Chatbot AI dan Dashboard Analytics.',
                    'stats' => '250+ Client'
                ],
                [
                    'year' => '2023',
                    'title' => 'Legalitas Resmi',
                    'desc' => 'Mendapatkan NIB dan NPWP resmi. Membuka kantor di 3 kota besar Indonesia.',
                    'stats' => '400+ Client'
                ],
                [
                    'year' => '2024',
                    'title' => 'Layanan 232+',
                    'desc' => 'Ekspansi besar-besaran dengan 232+ jenis layanan. Sistem freelancer dan referral diluncurkan.',
                    'stats' => '500+ Client'
                ],
                [
                    'year' => '2025',
                    'title' => 'Agency Terbaik',
                    'desc' => 'Target menjadi #1 Digital Agency di Indonesia dengan teknologi terdepan.',
                    'stats' => 'Target: 1000+ Client'
                ],
            ];

            foreach ($timeline as $index => $item):
            $position = $index % 2 === 0 ? 'left' : 'right';
            $delay = 100 + ($index * 100);
            ?>
            <div class="timeline-item timeline-<?= $position ?>" data-aos="fade-<?= $position ?>" data-aos-delay="<?= $delay ?>">
                <div class="timeline-badge">
                    <span class="timeline-year"><?= $item['year'] ?></span>
                </div>
                <div class="timeline-content card-premium">
                    <h4 class="text-gold"><?= $item['title'] ?></h4>
                    <p class="text-light"><?= $item['desc'] ?></p>
                    <div class="badge badge-gold mt-2">
                        <i class="bi bi-graph-up-arrow me-2"></i>
                        <?= $item['stats'] ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- STATS SECTION -->
<section id="stats">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_stats'] ?></h2>

        <div class="row g-4 mt-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card-premium text-center">
                    <div class="display-4 text-gold fw-bold mb-2" data-count="500">0</div>
                    <h4 class="text-light">Happy Clients</h4>
                    <p class="text-muted">Di seluruh Indonesia</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card-premium text-center">
                    <div class="display-4 text-gold fw-bold mb-2" data-count="1200">0</div>
                    <h4 class="text-light">Projects Done</h4>
                    <p class="text-muted">Dengan kualitas terbaik</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card-premium text-center">
                    <div class="display-4 text-gold fw-bold mb-2" data-count="232">0</div>
                    <h4 class="text-light">Services</h4>
                    <p class="text-muted">Layanan lengkap</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card-premium text-center">
                    <div class="display-4 text-gold fw-bold mb-2">
                        <span data-count="4">0</span>.<span data-count="9">0</span>
                    </div>
                    <h4 class="text-light">Rating</h4>
                    <p class="text-muted">Dari 500+ reviews</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHY CHOOSE US -->
<section class="about-section" id="why-us">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_why'] ?></h2>

        <div class="row g-4 mt-4">
            <?php
            $reasons = [
                [
                    'icon' => 'shield-fill-check',
                    'title' => 'Legal & Terpercaya',
                    'desc' => 'NIB & NPWP resmi. Perusahaan legal dengan track record terbukti.'
                ],
                [
                    'icon' => 'clock-history',
                    'title' => 'FREE Demo 24 Jam',
                    'desc' => 'Lihat hasil demo dulu sebelum bayar. Puas baru lanjut!'
                ],
                [
                    'icon' => 'currency-dollar',
                    'title' => 'Harga Terjangkau',
                    'desc' => 'Mulai Rp 350rb/halaman. Paket bundling lebih hemat hingga 50%!'
                ],
                [
                    'icon' => 'headset',
                    'title' => 'Support 24/7',
                    'desc' => 'WhatsApp support nonstop. Masalah langsung dibantu cepat!'
                ],
                [
                    'icon' => 'rocket-takeoff-fill',
                    'title' => 'Teknologi Terkini',
                    'desc' => 'AI, chatbot, cloud, SEO terbaru - semua ada di sini!'
                ],
                [
                    'icon' => 'graph-up-arrow',
                    'title' => 'Hasil Terukur',
                    'desc' => 'ROI jelas dengan analytics dashboard. Data-driven marketing.'
                ],
            ];

            $delay = 100;
            foreach ($reasons as $reason):
            ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                <div class="card-premium h-100">
                    <div class="about-feature-icon mb-3">
                        <i class="bi bi-<?= $reason['icon'] ?>"></i>
                    </div>
                    <h4 class="text-gold"><?= $reason['title'] ?></h4>
                    <p class="text-light"><?= $reason['desc'] ?></p>
                </div>
            </div>
            <?php
            $delay += 100;
            endforeach;
            ?>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section id="cta">
    <div class="container text-center">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_cta'] ?></h2>

        <p class="section-subtitle" data-aos="fade-up">
            Konsultasi GRATIS! Mari wujudkan visi digital Anda bersama kami
        </p>

        <div class="hero-buttons" data-aos="fade-up">
            <a href="/client/demo-request" class="btn btn-gold btn-lg">
                <i class="bi bi-rocket-takeoff me-2"></i>
                <?= $t['btn_demo'] ?>
            </a>
            <a href="/contact" class="btn btn-outline-gold btn-lg">
                <i class="bi bi-envelope me-2"></i>
                <?= $t['btn_contact'] ?>
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
