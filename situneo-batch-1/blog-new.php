<?php
session_start();
$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'id';
$_SESSION['lang'] = $lang;

$t = ['id' => ['page_title' => 'Blog', 'nav_home' => 'Beranda', 'nav_about' => 'Tentang', 'nav_services' => 'Layanan', 'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Harga', 'nav_blog' => 'Blog', 'nav_contact' => 'Kontak', 'nav_login' => 'Masuk', 'nib_label' => 'NIB Terdaftar'], 'en' => ['page_title' => 'Blog', 'nav_home' => 'Home', 'nav_about' => 'About', 'nav_services' => 'Services', 'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Pricing', 'nav_blog' => 'Blog', 'nav_contact' => 'Contact', 'nav_login' => 'Login', 'nib_label' => 'Registered NIB']][$lang];

$pageTitle = $t['page_title'] . ' - SITUNEO';
$baseURL = '/';

include 'components/layout/header-new.php';
include 'components/layout/navigation-new.php';
?>

<section class="hero" style="padding-top: 140px; padding-bottom: 60px;">
    <div class="container">
        <div class="hero-content" data-aos="fade-up">
            <h1><?php echo $lang === 'en' ? 'Our Blog' : 'Blog Kami'; ?></h1>
            <p><?php echo $lang === 'en' ? 'Tips, tutorials, and the latest news about web development' : 'Tips, tutorial, dan berita terbaru seputar web development'; ?></p>
        </div>
    </div>
</section>

<section style="padding: 60px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 350px; gap: 40px;">
            <!-- Blog Posts -->
            <div>
                <div style="display: grid; gap: 30px;">
                    <?php
                    $posts = [
                        ['title' => ($lang === 'en' ? '10 Tips for Creating SEO-Friendly Websites' : '10 Tips Membuat Website yang SEO-Friendly'), 'excerpt' => ($lang === 'en' ? 'Learn effective strategies to make your website appear on the first page of Google search...' : 'Pelajari strategi efektif untuk membuat website Anda muncul di halaman pertama pencarian Google...'), 'category' => 'SEO', 'date' => '2025-01-05', 'image' => '1432888622747-9eb99fbcfb76'],
                        ['title' => ($lang === 'en' ? 'Latest Design Trends 2025' : 'Tren Design Website Terbaru 2025'), 'excerpt' => ($lang === 'en' ? 'Discover the latest design trends that will dominate the digital world this year...' : 'Temukan tren desain terbaru yang akan mendominasi dunia digital tahun ini...'), 'category' => 'Design', 'date' => '2025-01-03', 'image' => '1542744173-8e7e53415bb0'],
                        ['title' => ($lang === 'en' ? 'How to Choose the Right E-Commerce Platform' : 'Cara Memilih Platform E-Commerce yang Tepat'), 'excerpt' => ($lang === 'en' ? 'Complete guide to choosing an e-commerce platform that suits your business needs...' : 'Panduan lengkap memilih platform e-commerce yang sesuai dengan kebutuhan bisnis Anda...'), 'category' => 'E-Commerce', 'date' => '2025-01-01', 'image' => '1556745757-8d58faf35e7e'],
                        ['title' => ($lang === 'en' ? 'The Importance of Website Speed for Conversions' : 'Pentingnya Kecepatan Website untuk Konversi'), 'excerpt' => ($lang === 'en' ? 'Learn how website loading speed impacts sales and conversions...' : 'Pelajari bagaimana kecepatan loading website mempengaruhi penjualan dan konversi...'), 'category' => 'Performance', 'date' => '2024-12-28', 'image' => '1460925895917-afdab827c52f'],
                        ['title' => ($lang === 'en' ? 'Complete Guide to Creating a Landing Page' : 'Panduan Lengkap Membuat Landing Page yang Efektif'), 'excerpt' => ($lang === 'en' ? 'Step by step to create a high-converting landing page...' : 'Step by step membuat landing page yang mampu mengkonversi dengan tinggi...'), 'category' => 'Tutorial', 'date' => '2024-12-25', 'image' => '1499750310107-1bbf9a32504f'],
                        ['title' => ($lang === 'en' ? 'Website Security: Tips to Protect from Hackers' : 'Keamanan Website: Tips Melindungi dari Hacker'), 'excerpt' => ($lang === 'en' ? 'Important strategies to secure your website from cyber attacks...' : 'Strategi penting untuk mengamankan website Anda dari serangan cyber...'), 'category' => 'Security', 'date' => '2024-12-20', 'image' => '1563986768494-4dee2763ff3f']
                    ];

                    foreach ($posts as $index => $post):
                    ?>
                    <div class="card blog-card" style="padding: 0; overflow: hidden;" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>">
                        <div style="height: 250px; overflow: hidden;">
                            <img src="https://images.unsplash.com/photo-<?php echo $post['image']; ?>?w=800&h=400&fit=crop&q=80" alt="<?php echo $post['title']; ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                        <div style="padding: 30px;">
                            <div style="display: flex; gap: 15px; margin-bottom: 15px; font-size: 14px; color: var(--text-light);">
                                <span style="padding: 4px 12px; background: rgba(255,180,0,0.2); border-radius: 15px; color: var(--gold-start); font-weight: 600;"><?php echo $post['category']; ?></span>
                                <span><i class="fas fa-calendar" style="margin-right: 5px;"></i><?php echo date('d M Y', strtotime($post['date'])); ?></span>
                            </div>
                            <h3 class="blog-title card-title" style="margin-bottom: 12px;"><?php echo $post['title']; ?></h3>
                            <p class="blog-excerpt card-text" style="margin-bottom: 20px;"><?php echo $post['excerpt']; ?></p>
                            <a href="pages/blog-single.php?id=<?php echo $index + 1; ?>" class="btn-primary" style="padding: 10px 24px; font-size: 14px;">
                                <span><?php echo $lang === 'en' ? 'Read More' : 'Baca Selengkapnya'; ?></span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <div style="display: flex; gap: 10px; justify-content: center; margin-top: 40px;" data-aos="fade-up">
                    <button class="btn-secondary" style="padding: 10px 20px; opacity: 0.5;" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="btn-primary" style="padding: 10px 20px;">1</button>
                    <button class="btn-secondary" style="padding: 10px 20px;">2</button>
                    <button class="btn-secondary" style="padding: 10px 20px;">3</button>
                    <button class="btn-secondary" style="padding: 10px 20px;">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Search -->
                <div class="card" style="margin-bottom: 30px;" data-aos="fade-up">
                    <h3 class="card-title" style="margin-bottom: 15px;">
                        <i class="fas fa-search"></i>
                        <?php echo $lang === 'en' ? 'Search' : 'Cari'; ?>
                    </h3>
                    <input type="text" id="blogSearch" class="form-control" placeholder="<?php echo $lang === 'en' ? 'Search articles...' : 'Cari artikel...'; ?>">
                </div>

                <!-- Categories -->
                <div class="card" style="margin-bottom: 30px;" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="card-title" style="margin-bottom: 15px;">
                        <i class="fas fa-folder"></i>
                        <?php echo $lang === 'en' ? 'Categories' : 'Kategori'; ?>
                    </h3>
                    <div style="display: grid; gap: 10px;">
                        <?php
                        $categories = [
                            ['name' => 'SEO', 'count' => 12],
                            ['name' => 'Design', 'count' => 18],
                            ['name' => 'E-Commerce', 'count' => 15],
                            ['name' => 'Tutorial', 'count' => 25],
                            ['name' => 'Performance', 'count' => 8],
                            ['name' => 'Security', 'count' => 10]
                        ];

                        foreach ($categories as $category):
                        ?>
                        <a href="#" style="display: flex; justify-content: space-between; padding: 10px 15px; background: rgba(255,255,255,0.05); border-radius: 8px; transition: var(--transition);" onmouseover="this.style.background='rgba(255,180,0,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                            <span><?php echo $category['name']; ?></span>
                            <span style="color: var(--gold-start); font-weight: 600;"><?php echo $category['count']; ?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Recent Posts -->
                <div class="card" style="margin-bottom: 30px;" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="card-title" style="margin-bottom: 15px;">
                        <i class="fas fa-clock"></i>
                        <?php echo $lang === 'en' ? 'Recent Posts' : 'Artikel Terbaru'; ?>
                    </h3>
                    <div style="display: grid; gap: 15px;">
                        <?php for ($i = 0; $i < 3; $i++): ?>
                        <a href="#" style="display: flex; gap: 15px; padding: 12px; background: rgba(255,255,255,0.05); border-radius: 8px; transition: var(--transition);" onmouseover="this.style.background='rgba(255,180,0,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                            <div style="width: 60px; height: 60px; border-radius: 8px; overflow: hidden; flex-shrink: 0;">
                                <img src="https://images.unsplash.com/photo-<?php echo $posts[$i]['image']; ?>?w=100&h=100&fit=crop&q=80" alt="<?php echo $posts[$i]['title']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div>
                                <div style="font-size: 14px; font-weight: 600; margin-bottom: 5px; color: var(--white);"><?php echo substr($posts[$i]['title'], 0, 50); ?>...</div>
                                <div style="font-size: 12px; color: var(--text-light);"><?php echo date('d M Y', strtotime($posts[$i]['date'])); ?></div>
                            </div>
                        </a>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- Tags -->
                <div class="card" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="card-title" style="margin-bottom: 15px;">
                        <i class="fas fa-tags"></i>
                        Tags
                    </h3>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        <?php
                        $tags = ['Web Design', 'SEO', 'WordPress', 'JavaScript', 'React', 'E-Commerce', 'UI/UX', 'Marketing', 'Security', 'Performance'];
                        foreach ($tags as $tag):
                        ?>
                        <a href="#" style="padding: 6px 15px; background: rgba(255,255,255,0.05); border-radius: 20px; font-size: 13px; transition: var(--transition);" onmouseover="this.style.background='rgba(255,180,0,0.2)'; this.style.color='var(--gold-start)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.color='var(--white)'"><?php echo $tag; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
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
