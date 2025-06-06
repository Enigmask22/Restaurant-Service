<div class="container py-5">
    <!-- Breadcrumb với style mới -->
    <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 10px;">
        <div class="container">
            <ol class="py-3 mb-0 breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo $path ?>user/home/homepage" class="text-decoration-none" style="color: #666;">
                        <i class="bi bi-house-door-fill me-1"></i>Trang chủ
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <i class="bi bi-info-circle me-1"></i>Giới thiệu
                </li>
            </ol>
        </div>
    </nav>

    <!-- Content chính -->
    <div class="mt-4 card" style="border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
        <div class="p-4 card-body">
            <!-- Header -->
            <div class="mb-5 text-center">
                <h2 class="text-uppercase fw-bold" style="color: #2c3e50; position: relative; display: inline-block;">
                    VỀ CHÚNG TÔI
                    <div style="height: 4px; width: 50px; background: #e74c3c; margin: 10px auto;"></div>
                </h2>
            </div>

            <!-- Company Info -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-4" style="background: #f8f9fa; border-radius: 10px;">
                        <h4 class="mb-4 text-center fw-bold" style="color: #2c3e50;">
                            Công ty TNHH Dịch Vụ Đặt Nhà Hàng 5SRestaurant
                        </h4>

                        <!-- History Section -->
                        <div class="mb-5">
                            <h5 class="mb-3 fw-bold" style="color: #e74c3c;">
                                <i class="bi bi-clock-history me-2"></i>
                                Thời gian thành lập và quá trình phát triển
                            </h5>
                            <p class="text-justify" style="line-height: 1.8;">
                                Công ty <span class="fw-bold">TNHH Dịch Vụ Đặt Nhà Hàng 5SRestaurant</span> được thành
                                lập vào năm 2024...
                            </p>
                        </div>

                        <!-- Services Section -->
                        <div class="mb-5">
                            <h5 class="mb-3 fw-bold" style="color: #e74c3c;">
                                <i class="bi bi-gear-fill me-2"></i>
                                Lĩnh vực hoạt động
                            </h5>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="card h-100"
                                        style="border: none; background: white; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                                        <div class="card-body">
                                            <h6 class="mb-3 fw-bold"><i class="bi bi-star-fill me-2"
                                                    style="color: #f1c40f;"></i>Dịch vụ chính</h6>
                                            <ul class="list-unstyled">
                                                <li class="mb-2">
                                                    <i class="bi bi-check2-circle me-2" style="color: #2ecc71;"></i>
                                                    Đặt bàn tại các nhà hàng cao cấp
                                                </li>
                                                <li class="mb-2">
                                                    <i class="bi bi-check2-circle me-2" style="color: #2ecc71;"></i>
                                                    Đặt tiệc sinh nhật, sự kiện đặc biệt
                                                </li>
                                                <li class="mb-2">
                                                    <i class="bi bi-check2-circle me-2" style="color: #2ecc71;"></i>
                                                    Tổ chức tiệc cưới, hội nghị
                                                </li>
                                                <li class="mb-2">
                                                    <i class="bi bi-check2-circle me-2" style="color: #2ecc71;"></i>
                                                    Dịch vụ đặt món trước
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card h-100"
                                        style="border: none; background: white; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                                        <div class="card-body">
                                            <h6 class="mb-3 fw-bold"><i class="bi bi-shield-check me-2"
                                                    style="color: #3498db;"></i>Dịch vụ hỗ trợ</h6>
                                            <ul class="list-unstyled">
                                                <li class="mb-2">
                                                    <i class="bi bi-headset me-2" style="color: #2ecc71;"></i>
                                                    Tư vấn 24/7 qua hotline
                                                </li>
                                                <li class="mb-2">
                                                    <i class="bi bi-chat-dots me-2" style="color: #2ecc71;"></i>
                                                    Hỗ trợ đặt bàn trực tuyến
                                                </li>
                                                <li class="mb-2">
                                                    <i class="bi bi-shield-check me-2" style="color: #2ecc71;"></i>
                                                    Bảo đảm hoàn tiền
                                                </li>
                                                <li class="mb-2">
                                                    <i class="bi bi-gift me-2" style="color: #2ecc71;"></i>
                                                    Ưu đãi sinh nhật
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Criteria Section -->
                        <div class="mb-5">
                            <h5 class="mb-3 fw-bold" style="color: #e74c3c;">
                                <i class="bi bi-trophy-fill me-2"></i>
                                Tiêu chí hoạt động
                            </h5>
                            <div class="row g-4">
                                <?php
                                $criteria = [
                                    ['icon' => 'bi-shield-check', 'text' => 'Đảm bảo chất lượng dịch vụ'],
                                    ['icon' => 'bi-shop', 'text' => 'Hợp tác với các nhà hàng uy tín'],
                                    ['icon' => 'bi-currency-dollar', 'text' => 'Giá cả cạnh tranh, minh bạch'],
                                    ['icon' => 'bi-lightning-charge', 'text' => 'Quy trình đặt bàn nhanh chóng'],
                                    ['icon' => 'bi-credit-card', 'text' => 'Thanh toán linh hoạt'],
                                    ['icon' => 'bi-headset', 'text' => 'Hỗ trợ 24/7']
                                ];
                                foreach ($criteria as $item) { ?>
                                    <div class="col-md-4">
                                        <div class="p-3 text-center"
                                            style="background: white; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                                            <i class="bi <?= $item['icon'] ?> fs-3 mb-2" style="color: #e74c3c;"></i>
                                            <p class="mb-0"><?= $item['text'] ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Achievement Section -->
                        <div class="p-4 text-center" style="background: #2c3e50; color: white; border-radius: 10px;">
                            <h5 class="mb-3 fw-bold">Thành quả đạt được</h5>
                            <p class="mb-0" style="line-height: 1.8;">
                                [...]
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Links -->
            <div class="mt-5">
                <h5 class="mb-3 fw-bold" style="color: #2c3e50;">
                    <i class="bi bi-link-45deg me-2"></i>
                    Tin liên quan
                </h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <a href="" class="card text-decoration-none" style="border: none; transition: transform 0.3s;">
                            <div class="card-body">
                                <i class="bi bi-journal-text me-2"></i>
                                Hướng dẫn đặt bàn
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="card text-decoration-none" style="border: none; transition: transform 0.3s;">
                            <div class="card-body">
                                <i class="bi bi-credit-card me-2"></i>
                                Hướng dẫn thanh toán
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Thiết lập SEO cho trang giới thiệu
$pageSpecificTitle = "Về Chúng Tôi - Nhà Hàng Buffet 5SR | Câu Chuyện & Đam Mê Ẩm Thực";
$pageSpecificDescription = "Tìm hiểu về hành trình xây dựng Nhà hàng Buffet 5SR, đội ngũ tâm huyết và cam kết mang đến trải nghiệm ẩm thực buffet 5 sao đẳng cấp tại Quận 10, TP.HCM.";
$pageSpecificKeywords = "về buffet 5sr, giới thiệu nhà hàng 5sr, câu chuyện buffet 5sr, đội ngũ đầu bếp 5sr, nhà hàng buffet uy tín quận 10";
$pageSpecificOgImage = 'https://restaurant-dth.s3.ap-southeast-2.amazonaws.com/og-images/about-us.png'; // Ảnh banner trang giới thiệu hoặc ảnh đội ngũ
$ogSiteName = "Nhà hàng Buffet 5SR";
$ogType = "restaurant:introduction"; // Hoặc 'profile' nếu tập trung vào người sáng lập
?>