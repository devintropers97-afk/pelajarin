<?php
session_start();

$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'id';
$_SESSION['lang'] = $lang;

$text = [
    'id' => [
        'meta_description' => 'Tentang SITUNEO - Platform Website Profesional Berbasis AI yang menghubungkan bisnis dengan freelancer terbaik.',
        'nav_home' => 'Beranda', 'nav_about' => 'Tentang', 'nav_services' => 'Layanan',
        'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Harga', 'nav_blog' => 'Blog',
        'nav_contact' => 'Kontak', 'nav_login' => 'Masuk', 'nib_label' => 'NIB Terdaftar',
        'page_title' => 'Tentang Kami',
        'page_subtitle' => 'Kenali lebih dekat platform yang mengubah cara bisnis membuat website',
        'philosophy_title' => 'Filosofi Nama SITUNEO',
        'philosophy_text' => '<strong>SITU</strong> berasal dari kata "Situs" dalam Bahasa Indonesia yang berarti Website. <strong>NEO</strong> berasal dari bahasa Yunani "νέος/neos" yang berarti "New" atau "Baru". Jadi, SITUNEO adalah kombinasi sempurna yang melambangkan "Website Baru" atau "Platform Website Modern" yang inovatif dan selalu terdepan.',
        'mission_title' => 'Misi Kami',
        'mission_text' => 'Mendemokratisasi akses ke website profesional dengan menghubungkan bisnis dari semua ukuran dengan freelancer berkualitas tinggi melalui platform berbasis AI yang efisien.',
        'vision_title' => 'Visi Kami',
        'vision_text' => 'Menjadi platform #1 di Indonesia untuk pembuatan website profesional yang terjangkau, cepat, dan berkualitas tinggi.',
        'values_title' => 'Nilai-Nilai Kami',
        'team_title' => 'Tim Kami',
        'why_title' => 'Mengapa Memilih Kami?',
        'stats_title' => 'Pencapaian Kami'
    ],
    'en' => [
        'meta_description' => 'About SITUNEO - AI-Powered Professional Website Platform connecting businesses with the best freelancers.',
        'nav_home' => 'Home', 'nav_about' => 'About', 'nav_services' => 'Services',
        'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Pricing', 'nav_blog' => 'Blog',
        'nav_contact' => 'Contact', 'nav_login' => 'Login', 'nib_label' => 'Registered NIB',
        'page_title' => 'About Us',
        'page_subtitle' => 'Get to know the platform that is changing the way businesses create websites',
        'philosophy_title' => 'SITUNEO Name Philosophy',
        'philosophy_text' => '<strong>SITU</strong> comes from the word "Situs" in Indonesian which means Website. <strong>NEO</strong> comes from the Greek "νέος/neos" which means "New". Thus, SITUNEO is the perfect combination symbolizing "New Website" or "Modern Website Platform" that is innovative and always ahead.',
        'mission_title' => 'Our Mission',
        'mission_text' => 'Democratizing access to professional websites by connecting businesses of all sizes with high-quality freelancers through an efficient AI-powered platform.',
        'vision_title' => 'Our Vision',
        'vision_text' => 'To become the #1 platform in Indonesia for affordable, fast, and high-quality professional website creation.',
        'values_title' => 'Our Values',
        'team_title' => 'Our Team',
        'why_title' => 'Why Choose Us?',
        'stats_title' => 'Our Achievements'
    ]
];

$t = $text[$lang];
$pageTitle = ($lang === 'en' ? 'About Us - SITUNEO' : 'Tentang Kami - SITUNEO');
$baseURL = '/';

include 'components/layout/header.php';
include 'components/layout/navigation.php';
?>

<!-- Hero Section -->
<section class="hero" style="padding-top: 140px; padding-bottom: 60px;">
    <div class="container">
        <div class="hero-content" data-aos="fade-up">
            <h1><?php echo $t['page_title']; ?></h1>
            <p><?php echo $t['page_subtitle']; ?></p>
        </div>
    </div>
</section>

<!-- Philosophy Section -->
<section style="padding: 60px 0;">
    <div class="container">
        <div class="card" style="max-width: 900px; margin: 0 auto; text-align: center;" data-aos="fade-up">
            <div class="card-icon" style="margin: 0 auto;">
                <i class="fas fa-lightbulb"></i>
            </div>
            <h2 class="card-title"><?php echo $t['philosophy_title']; ?></h2>
            <p class="card-text" style="font-size: 17px; line-height: 1.8;">
                <?php echo $t['philosophy_text']; ?>
            </p>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section style="padding: 60px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 30px;">
            <div class="card" data-aos="fade-up" data-aos-delay="100">
                <div class="card-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 class="card-title"><?php echo $t['mission_title']; ?></h3>
                <p class="card-text"><?php echo $t['mission_text']; ?></p>
            </div>

            <div class="card" data-aos="fade-up" data-aos-delay="200">
                <div class="card-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 class="card-title"><?php echo $t['vision_title']; ?></h3>
                <p class="card-text"><?php echo $t['vision_text']; ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section style="padding: 60px 0; background: rgba(0,0,0,0.2);">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $t['values_title']; ?></span></h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
            <div class="card" data-aos="fade-up" data-aos-delay="100">
                <div class="card-icon"><i class="fas fa-heart"></i></div>
                <h3 class="card-title"><?php echo $lang === 'en' ? 'Customer First' : 'Pelanggan Utama'; ?></h3>
                <p class="card-text"><?php echo $lang === 'en' ? 'Customer satisfaction is our top priority' : 'Kepuasan pelanggan adalah prioritas utama kami'; ?></p>
            </div>

            <div class="card" data-aos="fade-up" data-aos-delay="200">
                <div class="card-icon"><i class="fas fa-rocket"></i></div>
                <h3 class="card-title"><?php echo $lang === 'en' ? 'Innovation' : 'Inovasi'; ?></h3>
                <p class="card-text"><?php echo $lang === 'en' ? 'Always innovating with the latest technology' : 'Selalu berinovasi dengan teknologi terkini'; ?></p>
            </div>

            <div class="card" data-aos="fade-up" data-aos-delay="300">
                <div class="card-icon"><i class="fas fa-shield-alt"></i></div>
                <h3 class="card-title"><?php echo $lang === 'en' ? 'Integrity' : 'Integritas'; ?></h3>
                <p class="card-text"><?php echo $lang === 'en' ? 'Transparency and honesty in every service' : 'Transparansi dan kejujuran dalam setiap layanan'; ?></p>
            </div>

            <div class="card" data-aos="fade-up" data-aos-delay="400">
                <div class="card-icon"><i class="fas fa-users"></i></div>
                <h3 class="card-title"><?php echo $lang === 'en' ? 'Collaboration' : 'Kolaborasi'; ?></h3>
                <p class="card-text"><?php echo $lang === 'en' ? 'Building strong partnerships with clients and freelancers' : 'Membangun kemitraan yang kuat dengan klien dan freelancer'; ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section style="padding: 60px 0;">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $t['team_title']; ?></span></h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; max-width: 1000px; margin: 0 auto;">
            <?php
            $team = [
                ['name' => 'Devin Hartono', 'role' => ($lang === 'en' ? 'CEO & Founder' : 'CEO & Pendiri'), 'img' => 'Devin+Hartono'],
                ['name' => 'Budi Santoso', 'role' => ($lang === 'en' ? 'CTO' : 'CTO'), 'img' => 'Budi+Santoso'],
                ['name' => 'Sarah Martinez', 'role' => ($lang === 'en' ? 'Head of Design' : 'Kepala Desain'), 'img' => 'Sarah+Martinez'],
                ['name' => 'Maya Putri', 'role' => ($lang === 'en' ? 'Customer Success' : 'Customer Success'), 'img' => 'Maya+Putri']
            ];

            foreach ($team as $index => $member):
            ?>
            <div class="card" style="text-align: center;" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>">
                <div style="width: 120px; height: 120px; margin: 0 auto 20px; border-radius: 50%; overflow: hidden; border: 4px solid var(--gold-start);">
                    <img src="https://ui-avatars.com/api/?name=<?php echo $member['img']; ?>&background=1E5C99&color=fff&size=120" alt="<?php echo $member['name']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3 class="card-title" style="margin-bottom: 5px;"><?php echo $member['name']; ?></h3>
                <p class="card-text" style="color: var(--gold-start); font-weight: 600;"><?php echo $member['role']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section style="padding: 60px 0; background: rgba(0,0,0,0.2);">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $t['why_title']; ?></span></h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
            <div class="card" data-aos="fade-up" data-aos-delay="100">
                <div class="card-icon"><i class="fas fa-check-circle"></i></div>
                <h3 class="card-title"><?php echo $lang === 'en' ? 'Proven Quality' : 'Kualitas Terbukti'; ?></h3>
                <p class="card-text"><?php echo $lang === 'en' ? '500+ successful projects with 98% customer satisfaction' : '500+ proyek sukses dengan tingkat kepuasan 98%'; ?></p>
            </div>

            <div class="card" data-aos="fade-up" data-aos-delay="200">
                <div class="card-icon"><i class="fas fa-bolt"></i></div>
                <h3 class="card-title"><?php echo $lang === 'en' ? 'Fast Process' : 'Proses Cepat'; ?></h3>
                <p class="card-text"><?php echo $lang === 'en' ? 'AI-powered workflow for 50% faster website creation' : 'Alur kerja berbasis AI untuk pembuatan 50% lebih cepat'; ?></p>
            </div>

            <div class="card" data-aos="fade-up" data-aos-delay="300">
                <div class="card-icon"><i class="fas fa-dollar-sign"></i></div>
                <h3 class="card-title"><?php echo $lang === 'en' ? 'Affordable' : 'Harga Terjangkau'; ?></h3>
                <p class="card-text"><?php echo $lang === 'en' ? 'Prices up to 70% cheaper than traditional agencies' : 'Harga hingga 70% lebih murah dari agensi tradisional'; ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section style="padding: 60px 0;">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $t['stats_title']; ?></span></h2>
        </div>

        <div class="stats">
            <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-number" data-target="500">0</div>
                <div class="stat-label"><?php echo $lang === 'en' ? 'Happy Customers' : 'Pelanggan Puas'; ?></div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-number" data-target="800">0</div>
                <div class="stat-label"><?php echo $lang === 'en' ? 'Websites Created' : 'Website Tercipta'; ?></div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-number" data-target="150">0</div>
                <div class="stat-label"><?php echo $lang === 'en' ? 'Verified Freelancers' : 'Freelancer Terverifikasi'; ?></div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-number" data-target="98">0</div>
                <div class="stat-label"><?php echo $lang === 'en' ? '% Satisfaction Rate' : '% Tingkat Kepuasan'; ?></div>
            </div>
        </div>
    </div>
</section>

<?php
include 'components/layout/footer.php';
include 'components/layout/whatsapp-float.php';
?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
