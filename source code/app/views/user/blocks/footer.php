<!-- Footer -->
<footer class="py-4" style="background: #2c3e50;">
    <!-- Social Media Section -->
    <div class="container mb-3">
        <div class="py-2 row align-items-center" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div class="col-lg-6">
                <h6 class="mb-0 text-white">Kết nối với chúng tôi</h6>
            </div>
            <div class="col-lg-6">
                <div class="gap-2 d-flex justify-content-lg-end">
                    <a href="#" class="social-link">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="bi bi-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Footer Content -->
    <div class="container">
        <div class="row g-4">
            <!-- About Column -->
            <div class="col-lg-4">
                <h5 class="mb-2 text-white">
                    <i class="bi bi-gem me-2"></i>5SRestaurant
                </h5>
                <p class="small text-white-50">
                    5SRestaurant là nền tảng đặt chỗ trực tuyến, giúp thực khách tìm kiếm và lựa chọn nhà hàng đúng ý gần nhất.
                </p>
            </div>

            <!-- Contact Info Column -->
            <div class="col-lg-4">
                <h6 class="mb-2 text-white">Thông Tin Liên Hệ</h6>
                <div class="gap-2 d-flex flex-column small">
                    <div class="d-flex align-items-center text-white-50">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        <span><?php echo $data['general']['address'] ?></span>
                    </div>
                    <div class="d-flex align-items-center text-white-50">
                        <i class="bi bi-telephone-fill me-2"></i>
                        <span><?php echo $data['general']['phone'] ?></span>
                    </div>
                    <div class="d-flex align-items-center text-white-50">
                        <i class="bi bi-printer-fill me-2"></i>
                        <span><?php echo $data['general']['hotline'] ?></span>
                    </div>
                    <div class="d-flex align-items-center text-white-50">
                        <i class="bi bi-envelope-fill me-2"></i>
                        <span><?php echo $data['general']['email'] ?></span>
                    </div>
                </div>
            </div>

            <!-- Banking Info Column -->
            <div class="col-lg-4">
                <h6 class="mb-2 text-white">Thông Tin Chuyển Khoản</h6>
                <div class="gap-2 d-flex flex-column small">
                    <div class="d-flex align-items-center text-white-50">
                        <i class="bi bi-person-bounding-box me-2"></i>
                        <span><?php echo $data['general']['fullname'] ?></span>
                    </div>
                    <div class="d-flex align-items-center text-white-50">
                        <i class="bi bi-person-vcard me-2"></i>
                        <span><?php echo $data['general']['bankID'] ?></span>
                    </div>
                    <div class="d-flex align-items-center text-white-50">
                        <i class="bi bi-bank me-2"></i>
                        <span><?php echo $data['general']['bank_name'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="container">
        <div class="pt-3 mt-3 text-center" style="border-top: 1px solid rgba(255,255,255,0.1);">
            <p class="mb-0 small text-white-50">
                © <?php echo date('Y'); ?> 5SRestaurant. All rights reserved.
                <a href="https://5SRestaurant.com/" class="text-decoration-none" style="color: #e74c3c;">5SRestaurant.com</a>
            </p>
        </div>
    </div>
</footer>

<style>
.social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: #e74c3c;
    transform: translateY(-2px);
}
</style>
<!-- Nhúng file JS chứa class SeoManager -->
<?php
$path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
echo '<script src="' . $path . 'js/seoManager.js"></script>';
?>

<script>
    // Khởi tạo đối tượng SeoManager với thông tin của trang hiện tại
    // `autoUpdate: true` (mặc định) sẽ tự động gọi this.updateAll() khi DOMContentLoaded
    const seoUpdater = new SeoManager({
        pageTitle: "<?php echo addslashes($pageSpecificTitle); ?>",
        metaDescriptionContent: "<?php echo addslashes($pageSpecificDescription); ?>",
        metaKeywordsContent: "<?php echo addslashes($pageSpecificKeywords); ?>",
        ogImageContent: "<?php echo addslashes($pageSpecificOgImage); ?>",
        ogUrlContent: "<?php echo isset($ogUrl) ? addslashes($ogUrl) : ''; ?>",
        ogType: "<?php echo addslashes($ogType); ?>", // Loại trang cụ thể (ví dụ: 'website', 'article')
        ogSiteName: "<?php echo addslashes($ogSiteName); ?>",
        canonicalHref: "<?php echo isset($canonicalUrl) ? addslashes($canonicalUrl) : ''; ?>",
        // autoUpdate: true, // Mặc định là true, không cần ghi rõ nếu muốn tự động chạy
    });
    
    // Thêm log để theo dõi trạng thái SEO
    console.log("SEO Manager initialized for: " + document.title);
</script>