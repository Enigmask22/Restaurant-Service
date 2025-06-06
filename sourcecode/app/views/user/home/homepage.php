<div>
    <div class="d-flex justify-content-center">
        <div class="flex-row d-flex w-100">
            <div class="slide d-flex align-items-center justify-content-start w-100">
                <div class="gap-2 p-4 mx-5 slide__information d-flex flex-column px-lg-5">
                    <h5 class="text-uppercase lineUp">Nhà hàng sang trọng</h5>
                    <h6 class="text-uppercase lineDown">Q1 - TP HCM</h6>
                    <p class="lineLeft">Giảm giá 15% </p>
                    <button class="primary-button w-25 lineRight">ĐẶT NGAY</button>
                </div>
            </div>
        </div>
    </div>


    <!-- <div class="my-4 a_feature">
        <div class="gap-1 d-flex justify-content-center feature__container flex-column align-items-center w-100">
            <h3 class="text-center text-uppercase">Nhà hàng nổi bật trong tháng</h3>
            <div class="flex-row flex-wrap p-4 feature__img d-flex w-100 justify-content-between">
                <?php
                foreach ($data['restaurant_feature'] as $row) {
                    // var_dump($row);
                
                    ?>
                    <div class="flex-1 container__item d-flex justify-content-center align-items-end">
                        <img src="<?= $row['avatar'] ?>" alt="photo">
                        <div class="p-3 feature d-flex flex-column align-items-center">
                            <h6 class="text-center text-uppercase"><?= $row['restaurant_name'] ?></h6>
                            
                            <p><span class="text-uppercase">Giá </span><?= $row['adult_price'] ?> VNĐ</p>
                            <a href="<?= $path ?>user/restaurant/restaurant_detail/<?= $row['rid'] ?>"><button class="primary-button">ĐẶT NGAY</button></a>
                        </div>
                    </div>
                <?php
                }
                ?>
               
            </div>
        </div>
    </div> -->

    <div class="container py-5">
        <!-- Header -->
        <div class="mb-5 text-center">
            <h2 class="text-uppercase fw-bold" style="color: #2c3e50;">
                Danh Mục Nhà Hàng
                <div style="height: 4px; width: 50px; background: #e74c3c; margin: 15px auto;"></div>
            </h2>
        </div>

        <!-- Categories Grid -->
        <div class="row g-4">
            <?php foreach ($data['other_category'] as $row) { ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100"
                        style="border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                        <!-- Image Container -->
                        <div class="position-relative" style="height: 250px; overflow: hidden;">
                            <img src="<?= $row['category_img'] ?>" class="w-100 h-100" alt="<?= $row['category_name'] ?>"
                                style="object-fit: cover; transition: transform 0.5s ease;">

                            <!-- Category Info Overlay -->
                            <div class="bottom-0 p-4 position-absolute start-0 w-100"
                                style="background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);">
                                <h4 class="mb-2 text-white text-uppercase fw-bold">
                                    <?= $row['category_name'] ?>
                                </h4>
                                <div class="d-flex align-items-center">
                                    <span class="badge" style="background: #e74c3c;">
                                        <i class="bi bi-shop me-2"></i>
                                        <?= $row['num_res'] ?> Nhà hàng
                                    </span>
                                </div>
                            </div>

                            <!-- Hover Overlay -->
                            <a href="<?php echo $path ?>user/restaurant/list_res/<?= $row['cateid'] ?>"
                                class="top-0 opacity-0 position-absolute start-0 w-100 h-100 d-flex align-items-center justify-content-center text-decoration-none"
                                style="background: rgba(231, 76, 60, 0.9); transition: all 0.3s ease;">
                                <div class="text-center text-white">
                                    <i class="mb-3 bi bi-arrow-right-circle fs-1"></i>
                                    <h5 class="mb-0 text-uppercase">Xem Nhà Hàng</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="container my-5">
        <div class="mb-5 text-center">
            <h2 class="text-uppercase fw-bold" style="color: #2c3e50;">
                Nhà hàng chính
                <div style="height: 4px; width: 50px; background: linear-gradient(45deg, #FFD700, #FFA500); margin: 15px auto; border-radius: 2px;"></div>
            </h2>
        </div>
        <div class="row g-4">
            <!-- Nhà hàng chính bên trái -->
            <?php
            for ($i = 0; $i < 1; $i++) {
                $href = $path . 'user/restaurant/restaurant_detail/' . $data['restaurant_five'][$i]['rid'];
                $formatted_price = number_format($data['restaurant_five'][$i]['original_adult_price'], 0, ',', '.');
                ?>
                <div class="col-md-6">
                    <div class="premium-restaurant-card featured-card position-relative h-100">
                        <div class="premium-badge">
                            <i class="bi bi-star-fill"></i>
                            <span>NỔI BẬT</span>
                        </div>
                        <div class="restaurant-image-container">
                            <img src="<?= $data['restaurant_five'][$i]['avatar'] ?>" class="restaurant-image" alt="photo">
                            <div class="image-overlay"></div>
                        </div>
                        <div class="restaurant-content">
                            <div class="restaurant-info">
                                <h4 class="restaurant-name">
                                    <?= $data['restaurant_five'][$i]['restaurant_name'] ?>
                                </h4>
                                <div class="location-info">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span><?= $data['restaurant_five'][$i]['location'] ?></span>
                                </div>
                                <div class="price-section">
                                    <div class="price-label">Giá từ</div>
                                    <div class="price-value"><?= $formatted_price ?> <span class="currency">VNĐ</span></div>
                                </div>
                            </div>
                            <button onclick='location.href="<?php echo $href; ?>"' class="premium-book-btn">
                                <span>ĐẶT BÀN NGAY</span>
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- Grid 2x2 nhà hàng bên phải -->
            <div class="col-md-6">
                <div class="row g-3">
                    <?php for ($i = 1; $i <= 4; $i++) {
                        $href = $path . 'user/restaurant/restaurant_detail/' . $data['restaurant_five'][$i]['rid'];
                        $formatted_price = number_format($data['restaurant_five'][$i]['original_adult_price'], 0, ',', '.');
                        ?>
                        <div class="col-6">
                            <div class="premium-restaurant-card compact-card h-100">
                                <div class="restaurant-image-container">
                                    <img src="<?= $data['restaurant_five'][$i]['avatar'] ?>" class="restaurant-image" alt="photo">
                                    <div class="image-overlay"></div>
                                </div>
                                <div class="restaurant-content">
                                    <div class="restaurant-info">
                                        <h6 class="restaurant-name">
                                            <?= $data['restaurant_five'][$i]['restaurant_name'] ?>
                                        </h6>
                                        <div class="location-info">
                                            <i class="bi bi-geo-alt-fill"></i>
                                            <span><?= $data['restaurant_five'][$i]['location'] ?></span>
                                        </div>
                                        <div class="price-section">
                                            <div class="price-value"><?= $formatted_price ?> <span class="currency">VNĐ</span></div>
                                        </div>
                                    </div>
                                    <button onclick='location.href="<?php echo $href; ?>"' class="premium-book-btn compact">
                                        <span>ĐẶT BÀN</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="my-5 tour__blog">
        <div class="mb-5 text-center">
            <h2 class="text-uppercase fw-bold" style="color: #2c3e50;">
                Tin tức
                <div style="height: 4px; width: 50px; background: #e74c3c; margin: 15px auto;"></div>
            </h2>
        </div>

        <div class="container">
            <div class="row g-4">
                <?php foreach ($data['news'] as $row) { ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 blog-card">
                            <div class="card-img-wrapper" style="height: 250px;">
                                <img src="<?= $row['news_image'] ?>" class="card-img-top w-100 h-100 object-fit-cover"
                                    alt="<?= $row['title'] ?>">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h6 class="mb-3 card-title text-uppercase fw-bold"><?= $row['title'] ?></h6>
                                <p class="card-text flex-grow-1"><?= $row['intro'] ?></p>
                                <a href="<?= $path ?>user/news/detail_news/<?= $row['nsid'] ?>" class="mt-3">
                                    <button class="primary-button w-100">Đọc thêm</button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<style>
    /* Premium Restaurant Card Styles */
    .premium-restaurant-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 255, 255, 0.8);
        position: relative;
    }

    .premium-restaurant-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15), 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .premium-restaurant-card.featured-card {
        background: linear-gradient(145deg, #fff8e1 0%, #ffffff 100%);
        border: 2px solid rgba(255, 215, 0, 0.3);
    }

    .premium-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(45deg, #FFD700, #FFA500);
        color: #2c3e50;
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        z-index: 10;
        box-shadow: 0 4px 12px rgba(255, 215, 0, 0.4);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .premium-badge i {
        font-size: 10px;
    }

    .restaurant-image-container {
        position: relative;
        overflow: hidden;
        height: 400px;
    }

    .compact-card .restaurant-image-container {
        height: 180px;
    }

    .restaurant-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .premium-restaurant-card:hover .restaurant-image {
        transform: scale(1.15) rotate(1deg);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(
            to bottom,
            rgba(0, 0, 0, 0) 0%,
            rgba(0, 0, 0, 0.1) 50%,
            rgba(0, 0, 0, 0.3) 100%
        );
        opacity: 0;
        transition: all 0.4s ease;
    }

    .premium-restaurant-card:hover .image-overlay {
        opacity: 1;
    }

    .restaurant-content {
        padding: 25px;
        display: flex;
        flex-direction: column;
        height: calc(100% - 400px);
        min-height: 200px;
    }

    .compact-card .restaurant-content {
        padding: 15px;
        height: calc(100% - 180px);
        min-height: 150px;
    }

    .restaurant-info {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .restaurant-name {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        line-height: 1.3;
    }

    .location-info {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        color: #7f8c8d;
        font-size: 14px;
        margin-bottom: 15px;
        font-weight: 500;
        min-height: 40px;
        line-height: 1.4;
    }

    .compact-card .location-info {
        font-size: 12px;
        margin-bottom: 10px;
        min-height: 32px;
    }

    .location-info i {
        color: #e74c3c;
        font-size: 12px;
    }

    .price-section {
        margin-top: auto;
        margin-bottom: 20px;
    }

    .compact-card .price-section {
        margin-bottom: 15px;
    }

    .price-label {
        color: #7f8c8d;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .price-value {
        color: #2c3e50;
        font-size: 24px;
        font-weight: 800;
        display: flex;
        align-items: baseline;
        gap: 5px;
    }

    .compact-card .price-value {
        font-size: 18px;
    }

    .currency {
        font-size: 14px;
        color: #7f8c8d;
        font-weight: 500;
    }

    .compact-card .currency {
        font-size: 12px;
    }

    .premium-book-btn {
        background: linear-gradient(45deg, #e74c3c, #c0392b);
        color: white;
        border: none;
        padding: 15px 25px;
        border-radius: 50px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 8px 20px rgba(231, 76, 60, 0.3);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .premium-book-btn.compact {
        padding: 10px 15px;
        font-size: 12px;
    }

    .premium-book-btn:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.3));
        transition: all 0.6s;
    }

    .premium-book-btn:hover:before {
        left: 100%;
    }

    .premium-book-btn:hover {
        background: linear-gradient(45deg, #c0392b, #a93226);
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(231, 76, 60, 0.4);
    }

    .premium-book-btn i {
        transition: transform 0.3s ease;
    }

    .premium-book-btn:hover i {
        transform: translateX(5px);
    }

    /* Premium Restaurant Card Base Styles */
    .premium-restaurant-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 255, 255, 0.8);
        position: relative;
    }

    .premium-restaurant-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15), 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .premium-restaurant-card.featured-card {
        background: linear-gradient(145deg, #fff8e1 0%, #ffffff 100%);
        border: 2px solid rgba(255, 215, 0, 0.3);
    }

    /* Hover Effects for existing cards */
    .card:hover {
        transform: translateY(-5px);
    }

    .card:hover img {
        transform: scale(1.1);
    }

    .card:hover .opacity-0 {
        opacity: 1 !important;
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card, .premium-restaurant-card {
        animation: fadeIn 0.6s ease-out forwards;
    }

    /* Stagger animation for cards */
    .col-md-6:nth-child(1) .card,
    .col-md-6:nth-child(1) .premium-restaurant-card {
        animation-delay: 0.1s;
    }

    .col-md-6:nth-child(2) .card,
    .col-md-6:nth-child(2) .premium-restaurant-card {
        animation-delay: 0.2s;
    }

    .col-6:nth-child(1) .premium-restaurant-card {
        animation-delay: 0.3s;
    }

    .col-6:nth-child(2) .premium-restaurant-card {
        animation-delay: 0.4s;
    }

    .col-6:nth-child(3) .premium-restaurant-card {
        animation-delay: 0.5s;
    }

    .col-6:nth-child(4) .premium-restaurant-card {
        animation-delay: 0.6s;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .premium-restaurant-card {
            margin-bottom: 20px;
        }
        
        .restaurant-image-container {
            height: 250px;
        }
        
        .compact-card .restaurant-image-container {
            height: 200px;
        }
        
        .restaurant-content {
            padding: 20px;
        }
        
        .premium-book-btn {
            padding: 12px 20px;
            font-size: 14px;
        }
        
        .price-value {
            font-size: 20px;
        }
    }

    @media (max-width: 576px) {
        .restaurant-image-container,
        .compact-card .restaurant-image-container {
            height: 200px;
        }
        
        .restaurant-content {
            padding: 15px;
        }
        
        .restaurant-name {
            font-size: 16px;
        }
        
        .price-value {
            font-size: 18px;
        }
    }
</style>


<?php
/* ------ Danh sách mô tả thông tin SEO cho trang chủ ------ */
$pageSpecificTitle = "Buffet 5SR: Hải Sản, Lẩu & Nướng Cao Cấp Quận 10, TP.HCM"; // Tiêu đề trang chủ
$pageSpecificDescription = "Trải nghiệm đại tiệc buffet hơn 150+ món hải sản tươi sống, lẩu nướng đặc sắc tại Nhà hàng Buffet 5SR. Không gian sang trọng, dịch vụ 5 sao. Đặt bàn ngay nhận ưu đãi!"; // Mô tả ngắn gọn về nhà hàng và dịch vụ buffet
$pageSpecificKeywords = "buffet 5sr, nhà hàng buffet quận 10, buffet hải sản tphcm, lẩu nướng cao cấp, đặt bàn buffet, buffet ngon sài gòn, 5sr restaurant"; // Từ khóa SEO liên quan đến nhà hàng và dịch vụ buffet
$pageSpecificOgImage = 'https://restaurant-dth.s3.ap-southeast-2.amazonaws.com/og-images/home.jpeg'; // URL tuyệt đối đến hình ảnh đại diện của trang chủ
$ogSiteName = "Nhà hàng Buffet 5SR"; // Tên trang web hoặc nhà hàng
$ogType = "restaurant:homepage"; // Loại trang, có thể là 'website', 'article', 'product', v.v.
?>