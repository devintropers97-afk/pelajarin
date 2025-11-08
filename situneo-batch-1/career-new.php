<?php
session_start();
$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'id';
$_SESSION['lang'] = $lang;

$t = ['id' => ['page_title' => 'Karir', 'nav_home' => 'Beranda', 'nav_about' => 'Tentang', 'nav_services' => 'Layanan', 'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Harga', 'nav_blog' => 'Blog', 'nav_contact' => 'Kontak', 'nav_login' => 'Masuk', 'nib_label' => 'NIB Terdaftar'], 'en' => ['page_title' => 'Career', 'nav_home' => 'Home', 'nav_about' => 'About', 'nav_services' => 'Services', 'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Pricing', 'nav_blog' => 'Blog', 'nav_contact' => 'Contact', 'nav_login' => 'Login', 'nib_label' => 'Registered NIB']][$lang];

$pageTitle = $t['page_title'] . ' - SITUNEO';
$baseURL = '/';

include 'components/layout/header-new.php';
include 'components/layout/navigation-new.php';
?>

<section class="hero" style="padding-top: 140px; padding-bottom: 60px;">
    <div class="container">
        <div class="hero-content" data-aos="fade-up">
            <h1><?php echo $lang === 'en' ? 'Join Our Team' : 'Bergabung dengan Tim Kami'; ?></h1>
            <p><?php echo $lang === 'en' ? 'Build your career with a leading digital platform' : 'Bangun karir Anda bersama platform digital terdepan'; ?></p>
        </div>
    </div>
</section>

<!-- Why Join Us -->
<section style="padding: 60px 0;">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $lang === 'en' ? 'Why Join SITUNEO?' : 'Mengapa Bergabung dengan SITUNEO?'; ?></span></h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
            <?php
            $benefits = [
                ['icon' => 'fa-money-bill-wave', 'title' => ($lang === 'en' ? 'Competitive Salary' : 'Gaji Kompetitif'), 'desc' => ($lang === 'en' ? 'Attractive salary package above industry standards' : 'Paket gaji menarik di atas standar industri')],
                ['icon' => 'fa-user-friends', 'title' => ($lang === 'en' ? 'Great Team' : 'Tim Yang Solid'), 'desc' => ($lang === 'en' ? 'Work with talented and passionate people' : 'Bekerja dengan orang-orang berbakat dan bersemangat')],
                ['icon' => 'fa-chart-line', 'title' => ($lang === 'en' ? 'Career Growth' : 'Pengembangan Karir'), 'desc' => ($lang === 'en' ? 'Clear career path and development opportunities' : 'Jalur karir jelas dan kesempatan berkembang')],
                ['icon' => 'fa-laptop-house', 'title' => ($lang === 'en' ? 'Flexible Work' : 'Kerja Fleksibel'), 'desc' => ($lang === 'en' ? 'Remote work option and flexible hours' : 'Opsi kerja remote dan jam kerja fleksibel')],
                ['icon' => 'fa-heart', 'title' => ($lang === 'en' ? 'Health Insurance' : 'Asuransi Kesehatan'), 'desc' => ($lang === 'en' ? 'Complete health insurance for you and family' : 'Asuransi kesehatan lengkap untuk Anda dan keluarga')],
                ['icon' => 'fa-graduation-cap', 'title' => ($lang === 'en' ? 'Training & Development' : 'Training & Pengembangan'), 'desc' => ($lang === 'en' ? 'Regular training and skill upgrade programs' : 'Program training dan upgrade skill berkala')]
            ];

            foreach ($benefits as $index => $benefit):
            ?>
            <div class="card" style="text-align: center;" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>">
                <div class="card-icon" style="margin: 0 auto;">
                    <i class="fas <?php echo $benefit['icon']; ?>"></i>
                </div>
                <h3 class="card-title"><?php echo $benefit['title']; ?></h3>
                <p class="card-text"><?php echo $benefit['desc']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Open Positions -->
<section style="padding: 60px 0; background: rgba(0,0,0,0.2);">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $lang === 'en' ? 'Open Positions' : 'Posisi Terbuka'; ?></span></h2>
        </div>

        <div style="display: grid; gap: 25px; max-width: 900px; margin: 0 auto;">
            <?php
            $jobs = [
                ['title' => 'Full Stack Web Developer', 'type' => 'Full Time', 'location' => 'Jakarta / Remote', 'salary' => 'Rp 8-15JT'],
                ['title' => 'UI/UX Designer', 'type' => 'Full Time', 'location' => 'Jakarta / Remote', 'salary' => 'Rp 6-12JT'],
                ['title' => 'Digital Marketing Specialist', 'type' => 'Full Time', 'location' => 'Jakarta', 'salary' => 'Rp 5-10JT'],
                ['title' => 'Customer Service Representative', 'type' => 'Full Time', 'location' => 'Jakarta', 'salary' => 'Rp 4-7JT'],
                ['title' => 'Sales Executive', 'type' => 'Full Time', 'location' => 'Jakarta', 'salary' => 'Rp 5-10JT + Komisi']
            ];

            foreach ($jobs as $index => $job):
            ?>
            <div class="card" style="padding: 25px;" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 20px;">
                    <div style="flex: 1;">
                        <h3 class="card-title" style="margin-bottom: 10px;"><?php echo $job['title']; ?></h3>
                        <div style="display: flex; gap: 20px; flex-wrap: wrap; color: var(--text-light); font-size: 14px;">
                            <span><i class="fas fa-briefcase" style="color: var(--gold-start); margin-right: 5px;"></i><?php echo $job['type']; ?></span>
                            <span><i class="fas fa-map-marker-alt" style="color: var(--gold-start); margin-right: 5px;"></i><?php echo $job['location']; ?></span>
                            <span><i class="fas fa-dollar-sign" style="color: var(--gold-start); margin-right: 5px;"></i><?php echo $job['salary']; ?></span>
                        </div>
                    </div>
                    <a href="#applyForm" class="btn-primary" style="padding: 10px 24px; font-size: 14px;">
                        <?php echo $lang === 'en' ? 'Apply Now' : 'Lamar Sekarang'; ?>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Application Form -->
<section id="applyForm" style="padding: 60px 0;">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $lang === 'en' ? 'Apply for Position' : 'Lamar Posisi'; ?></span></h2>
        </div>

        <div class="card" style="max-width: 700px; margin: 0 auto;" data-aos="fade-up">
            <form id="careerForm">
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;"><?php echo $lang === 'en' ? 'Full Name' : 'Nama Lengkap'; ?></label>
                    <input type="text" class="form-control" placeholder="<?php echo $lang === 'en' ? 'Your full name' : 'Nama lengkap Anda'; ?>" required>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Email</label>
                        <input type="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;"><?php echo $lang === 'en' ? 'Phone' : 'Telepon'; ?></label>
                        <input type="tel" class="form-control" placeholder="<?php echo $lang === 'en' ? 'Phone number' : 'Nomor telepon'; ?>" required>
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;"><?php echo $lang === 'en' ? 'Position Applied' : 'Posisi yang Dilamar'; ?></label>
                    <select class="form-control" required>
                        <option value=""><?php echo $lang === 'en' ? '-- Select Position --' : '-- Pilih Posisi --'; ?></option>
                        <?php foreach ($jobs as $job): ?>
                        <option value="<?php echo $job['title']; ?>"><?php echo $job['title']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;"><?php echo $lang === 'en' ? 'Upload CV/Resume (PDF)' : 'Upload CV/Resume (PDF)'; ?></label>
                    <input type="file" class="form-control" accept=".pdf" required>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;"><?php echo $lang === 'en' ? 'Cover Letter' : 'Surat Lamaran'; ?></label>
                    <textarea class="form-control" rows="6" placeholder="<?php echo $lang === 'en' ? 'Tell us why you are the best fit for this position...' : 'Ceritakan mengapa Anda cocok untuk posisi ini...'; ?>" required></textarea>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
                    <i class="fas fa-paper-plane"></i>
                    <span><?php echo $lang === 'en' ? 'Submit Application' : 'Kirim Lamaran'; ?></span>
                </button>
            </form>
        </div>
    </div>
</section>

<?php
include 'components/layout/footer-new.php';
include 'components/layout/whatsapp-float-new.php';
?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="assets/js/main-new.js"></script>

</body>
</html>
