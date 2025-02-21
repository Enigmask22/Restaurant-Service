


<div class="container py-5">
  <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 10px;">
    <div class="container">
      <ol class="py-3 mb-0 breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo $path ?>user/home/homepage" class="text-decoration-none" style="color: #666;">
            <i class="bi bi-house-door-fill me-1"></i>Trang chủ
          </a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo $path ?>user/news/list_news" class="text-decoration-none" style="color: #666;">
            <i class="bi bi-newspaper me-1"></i>Tin tức
          </a>
        </li>
        <li class="breadcrumb-item active">
          <i class="bi bi-file-text me-1"></i><?php echo $data['news']['title']; ?>
        </li>
      </ol>
    </div>
  </nav>

  <div class="mt-3 row g-4">
    <!-- Main Content -->
    <div class="col-lg-8">
      <div class="card" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
        <div class="p-4 card-body">
          <!-- News Header -->
          <h2 class="mb-4 text-uppercase fw-bold" style="color: #2c3e50;">
            <?php echo $data['news']['title'] ?>
          </h2>
          
          <!-- Featured Image -->
          <div class="mb-4 position-relative" style="height: 400px; border-radius: 10px; overflow: hidden;">
            <img src="<?php echo $data['news']['news_image'] ?>" class="w-100 h-100 object-fit-cover" alt="">
          </div>

          <!-- News Content -->
          <div class="news-content">
            <div class="mb-4">
              <p class="lead" style="color: #666;"><?php echo $data['news']['header'] ?></p>
            </div>

            <div class="content-sections">
              <!-- About Restaurant -->
              <div class="p-4 mb-4" style="background: #f8f9fa; border-radius: 10px;">
                <h4 class="mb-3" style="color: #2c3e50;">
                  <i class="bi bi-info-circle me-2"></i>Vài nét về nhà hàng
                </h4>
                <p style="color: #666; line-height: 1.8;"><?php echo $data['news']['intro'] ?></p>
              </div>

              <!-- Restaurant Details -->
              <div class="p-4 mb-4" style="background: #f8f9fa; border-radius: 10px;">
                <h4 class="mb-3" style="color: #2c3e50;">
                  <i class="bi bi-card-text me-2"></i>Chi tiết về nhà hàng
                </h4>
                <p style="color: #666; line-height: 1.8;"><?php echo $data['news']['body'] ?></p>
              </div>

              <!-- Important Notes -->
              <div class="p-4" style="background: #f8f9fa; border-radius: 10px;">
                <h4 class="mb-3" style="color: #2c3e50;">
                  <i class="bi bi-exclamation-circle me-2"></i>Lưu ý khi đến nhà hàng
                </h4>
                <p style="color: #666; line-height: 1.8;"><?php echo $data['news']['footer'] ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
      <div class="card" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
        <div class="p-4 card-body">
          <h4 class="mb-4 text-uppercase fw-bold" style="color: #2c3e50;">
            <i class="bi bi-shop me-2"></i>Nhà hàng liên quan
          </h4>
          
          <?php if ($data['restaurant']) { ?>
            <div class="related-restaurants">
              <?php foreach ($data['restaurant'] as $res) { ?>
                <a href="<?php echo $path ?>/user/restaurant/restaurant_detail/<?php echo $res['rid'] ?>" 
                   class="mb-3 text-decoration-none d-block">
                  <div class="card" style="border: none; box-shadow: 0 3px 10px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                    <div class="row g-0">
                      <div class="col-4">
                        <div style="height: 100px; overflow: hidden;">
                          <img src="<?php echo $res['avatar'] ?>" class="w-100 h-100 object-fit-cover" alt="">
                        </div>
                      </div>
                      <div class="col-8">
                        <div class="p-3 card-body">
                          <h6 class="mb-1 card-title" style="color: #2c3e50;"><?php echo $res['restaurant_name'] ?></h6>
                          <p class="mb-0 card-text" style="color: #666;">
                            Giá: <span style="color: #e74c3c;"><?php echo $res['adult_price'] ?> đ</span>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              <?php } ?>
            </div>
          <?php } else { ?>
            <div class="p-4 text-center" style="color: #666;">
              <i class="mb-2 bi bi-inbox fs-1"></i>
              <p class="mb-0">Không có nhà hàng liên quan</p>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.card:hover {
  transform: translateY(-5px);
}

.news-content {
  font-size: 16px;
  line-height: 1.8;
}

.related-restaurants .card:hover {
  transform: translateY(-3px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}
</style>