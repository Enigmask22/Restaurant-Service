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
                <div style="height: 4px; width: 50px; background: #e74c3c; margin: 15px auto;"></div>
            </h2>
        </div>
        <div class="row g-4">
            <!-- Nhà hàng chính bên trái -->
            <?php
            for ($i = 0; $i < 1; $i++) {
                $href = $path . 'user/restaurant/restaurant_detail/' . $data['restaurant_five'][$i]['rid'];
                ?>
                <div class="col-md-6">
                    <div class="card h-100"
                        style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                        <div class="position-relative" style="overflow: hidden;">
                            <img src="<?= $data['restaurant_five'][$i]['avatar'] ?>" class="card-img-top"
                                style="height: 400px; object-fit: cover;" alt="photo">
                            <div class="text-center card-body"
                                style="background: rgba(255, 255, 255, 0.95); padding: 20px;">
                                <h5 class="mb-2 card-title text-uppercase">
                                    <?= $data['restaurant_five'][$i]['restaurant_name'] ?>
                                </h5>
                                <h6 class="mb-2 card-subtitle text-uppercase">
                                    <?= $data['restaurant_five'][$i]['location'] ?>
                                </h6>
                                <p class="card-text"><span class="fw-bold">Giá:
                                    </span><?= $data['restaurant_five'][$i]['original_adult_price'] ?> VNĐ</p>
                                <div style="text-align: center; margin-top: 10px;">
                                    <button onclick='location.href="<?php echo $href; ?>"' class="btn"
                                        style="background-color: #f97316; color: white; padding: 8px 24px; border-radius: 25px; text-transform: uppercase; font-weight: 500; transition: all 0.3s ease; display: inline-block; border: none; cursor: pointer;">
                                        ĐẶT NGAY
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- Grid 2x2 nhà hàng bên phải -->
            <div class="col-md-6">
                <div class="row g-4">
                    <?php for ($i = 1; $i <= 4; $i++) {
                        $href = $path . 'user/restaurant/restaurant_detail/' . $data['restaurant_five'][$i]['rid'];
                        ?>
                        <div class="col-6">
                            <div class="card h-100"
                                style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                                <div class="position-relative" style="overflow: hidden;">
                                    <img src="<?= $data['restaurant_five'][$i]['avatar'] ?>" class="card-img-top"
                                        style="height: 200px; object-fit: cover;" alt="photo">
                                    <div class="card-body">
                                        <h6 class="mb-2 card-title text-uppercase">
                                            <?= $data['restaurant_five'][$i]['restaurant_name'] ?>
                                        </h6>
                                        <p class="mb-2 card-subtitle text-uppercase small">
                                            <?= $data['restaurant_five'][$i]['location'] ?>
                                        </p>
                                        <p class="card-text small"><span class="fw-bold">Giá:
                                            </span><?= $data['restaurant_five'][$i]['original_adult_price'] ?> VNĐ</p>
                                        <div style="text-align: center; margin-top: 10px;">
                                            <button onclick='location.href="<?php echo $href; ?>"' class="btn"
                                                style="background-color: #f97316; color: white; padding: 8px 24px; border-radius: 25px; text-transform: uppercase; font-weight: 500; transition: all 0.3s ease; display: inline-block; border: none; cursor: pointer;">
                                                ĐẶT NGAY
                                            </button>
                                        </div>
                                    </div>
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
    /* Hover Effects */
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

    .card {
        animation: fadeIn 0.5s ease-out forwards;
    }

    /* Stagger animation for cards */
    .col-md-6:nth-child(1) .card {
        animation-delay: 0.1s;
    }

    .col-md-6:nth-child(2) .card {
        animation-delay: 0.2s;
    }

    .col-md-6:nth-child(3) .card {
        animation-delay: 0.3s;
    }

    .col-md-6:nth-child(4) .card {
        animation-delay: 0.4s;
    }

    .col-md-6:nth-child(5) .card {
        animation-delay: 0.5s;
    }

    .col-md-6:nth-child(6) .card {
        animation-delay: 0.6s;
    }

    /* Optional: Add media queries for better mobile experience */
    @media (max-width: 768px) {
        .card {
            margin-bottom: 20px;
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