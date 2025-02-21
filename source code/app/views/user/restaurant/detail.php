

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
          <a href="<?php echo $path ?>user/restaurant/list_res/<?php echo $data['restaurant']['cate_id'] ?>"
            class="text-decoration-none" style="color: #666;">
            <i class="bi bi-grid-fill me-1"></i><?php echo $data['category_name'] ?>
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <i class="bi bi-shop me-1"></i><?php echo $data['restaurant']['restaurant_name']; ?>
        </li>
      </ol>
    </div>
  </nav>
  <!-- Restaurant Header -->
  <div class="mb-4 card" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
    <div class="p-4 card-body">
      <h2 class="mb-4 text-uppercase" style="color: #2c3e50;">
        <?php echo $data['restaurant']['restaurant_name'] ?>
      </h2>

      <!-- Price Info -->
      <div class="mb-4 row">
        <div class="col-md-6">
          <div class="d-flex align-items-center">
            <div class="p-3 rounded-circle me-3" style="background: #f8f9fa;">
              <i class="bi bi-person-fill fs-4" style="color: #e74c3c;"></i>
            </div>
            <div>
              <p class="mb-0 text-muted">Giá người lớn</p>
              <h4 class="mb-0" style="color: #e74c3c;"><?php echo($data['restaurant']['adult_price']) ?> đ
              </h4>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex align-items-center">
            <div class="p-3 rounded-circle me-3" style="background: #f8f9fa;">
              <i class="bi bi-person-heart fs-4" style="color: #e74c3c;"></i>
            </div>
            <div>
              <p class="mb-0 text-muted">Giá trẻ em (dưới 10 tuổi)</p>
              <h4 class="mb-0" style="color: #e74c3c;"><?php echo($data['restaurant']['child_price']) ?> đ
              </h4>
            </div>
          </div>
        </div>
      </div>

      <!-- Restaurant Info -->
      <div class="mb-4 row g-3">
        <div class="col-md-4">
          <div class="p-3 d-flex align-items-center" style="background: #f8f9fa; border-radius: 10px;">
            <i class="bi bi-clock fs-4 me-3" style="color: #3498db;"></i>
            <div>
              <p class="mb-0 text-muted">Giờ mở cửa</p>
              <p class="mb-0 fw-bold"><?php echo $data['restaurant']['open_time'] ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-3 d-flex align-items-center" style="background: #f8f9fa; border-radius: 10px;">
            <i class="bi bi-geo-alt fs-4 me-3" style="color: #e74c3c;"></i>
            <div>
              <p class="mb-0 text-muted">Địa chỉ</p>
              <p class="mb-0 fw-bold"><?php echo $data['restaurant']['address'] ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-3 d-flex align-items-center" style="background: #f8f9fa; border-radius: 10px;">
            <i class="bi bi-star-fill fs-4 me-3" style="color: #f1c40f;"></i>
            <div>
              <p class="mb-0 text-muted">Đánh giá</p>
              <div>
                <?php for ($i = 0; $i < $data['restaurant']['res_rate']; $i++) { ?>
                  <i class="bi bi-star-fill" style="color: #f1c40f;"></i>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Booking Button -->
      <div class="text-center">
        <a href="<?php echo $path ?>user/restaurant/booking/<?php echo $data['restaurant']['rid'] ?>"
          class="px-5 btn btn-lg"
          style="background: #e74c3c; color: white; border-radius: 30px; transition: all 0.3s ease;">
          <i class="bi bi-calendar-check me-2"></i>Đặt nhà hàng ngay
        </a>
      </div>
    </div>
  </div>

  <!-- Tabs Section -->
  <div class="card" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
    <div class="p-4 card-body">
      <ul class="mb-4 nav nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-address-tab" data-bs-toggle="pill" data-bs-target="#pills-address"
            type="button" role="tab" aria-selected="true">
            <i class="bi bi-geo-alt me-2"></i>Địa chỉ
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-overview-tab" data-bs-toggle="pill" data-bs-target="#pills-overview"
            type="button" role="tab" aria-selected="false">
            <i class="bi bi-info-circle me-2"></i>Tổng quan
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery"
            type="button" role="tab" aria-selected="false">
            <i class="bi bi-images me-2"></i>Hình ảnh
          </button>
        </li>
      </ul>

      <div class="tab-content" id="pills-tabContent">
        <!-- Address Tab -->
        <div class="tab-pane fade show active" id="pills-address" role="tabpanel">
          <h4 class="mb-4" style="color: #2c3e50;">Chi nhánh nhà hàng</h4>
          <?php if ($data['address']) {
            foreach ($data['address'] as $address) { ?>
              <div class="mb-3 card" style="border: none; background: #f8f9fa; border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title">
                    <i class="bi bi-building me-2" style="color: #e74c3c;"></i>
                    Chi nhánh <?php echo $address['branch'] ?>
                  </h5>
                  <p class="mb-2 card-text ms-4">
                    <i class="bi bi-geo-alt me-2" style="color: #3498db;"></i>
                    <?php echo $address['location'] ?>
                  </p>
                  <p class="mb-0 card-text ms-4">
                    <i class="bi bi-info-circle me-2" style="color: #2ecc71;"></i>
                    <?php echo $address['description'] ?>
                  </p>
                </div>
              </div>
            <?php }
          } else { ?>
            <div class="text-center text-muted">Chưa có thông tin chi nhánh</div>
          <?php } ?>
        </div>

        <!-- Overview Tab -->
        <div class="tab-pane fade" id="pills-overview" role="tabpanel">
          <div class="p-4" style="background: #f8f9fa; border-radius: 10px;">
            <h4 class="mb-4" style="color: #2c3e50;">Giới thiệu</h4>
            <p class="mb-4"><?php echo $data['restaurant']['description'] ?></p>

            <div class="row g-4">
              <div class="col-md-4">
                <div class="card h-100" style="border: none; background: white; border-radius: 10px;">
                  <div class="card-body">
                    <h5 class="card-title" style="color: #2ecc71;">
                      <i class="bi bi-check-circle me-2"></i>Bao gồm
                    </h5>
                    <p class="card-text"><?php echo $data['restaurant']['res_include'] ?></p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card h-100" style="border: none; background: white; border-radius: 10px;">
                  <div class="card-body">
                    <h5 class="card-title" style="color: #e74c3c;">
                      <i class="bi bi-x-circle me-2"></i>Không bao gồm
                    </h5>
                    <p class="card-text"><?php echo $data['restaurant']['res_exclude'] ?></p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card h-100" style="border: none; background: white; border-radius: 10px;">
                  <div class="card-body">
                    <h5 class="card-title" style="color: #3498db;">
                      <i class="bi bi-exclamation-circle me-2"></i>Yêu cầu
                    </h5>
                    <p class="card-text"><?php echo $data['restaurant']['res_condition'] ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Gallery Tab -->
        <div class="tab-pane fade" id="pills-gallery" role="tabpanel">
          <h4 class="mb-4" style="color: #2c3e50;">Thư viện ảnh</h4>
          <div class="row g-4">
            <?php if ($data['imgs']) {
              foreach ($data['imgs'] as $img) { ?>
                <div class="col-md-4">
                  <img src="<?php echo $img['img'] ?>" class="rounded img-fluid"
                    style="width: 100%; height: 250px; object-fit: cover;" alt="">
                </div>
              <?php }
            } else { ?>
              <div class="text-center text-muted">Chưa có hình ảnh</div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Comments Section -->
  <div class="mt-4 card" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
    <div class="p-4 card-body">
      <h4 class="mb-4" style="color: #2c3e50;">Đánh giá & Bình luận</h4>

      <!-- Comment Form -->
      <form action="" method="post" class="mb-5">
        <div class="row g-3">
          <div class="col-md-4">
            <div class="form-floating">
              <input type="text" class="form-control" name="fullname" id="name" placeholder="Họ tên">
              <label for="name">Họ tên</label>
            </div>
            <p class="text-danger small">* <?php echo $data['fullname_error'] ?></p>
          </div>
          <div class="col-md-4">
            <div class="form-floating">
              <input type="email" class="form-control" name="email" id="email" placeholder="Email">
              <label for="email">Email</label>
            </div>
            <p class="text-danger small">* <?php echo $data['email_error'] ?></p>
          </div>
          <div class="col-md-4">
            <div class="form-floating">
              <input type="tel" class="form-control" name="phone_number" id="phone" placeholder="Số điện thoại">
              <label for="phone">Số điện thoại</label>
            </div>
            <p class="text-danger small">* <?php echo $data['phone_error'] ?></p>
          </div>
          <div class="col-12">
            <div class="form-floating">
              <textarea class="form-control" name="content" id="comment" placeholder="Bình luận"
                style="height: 100px"></textarea>
              <label for="comment">Bình luận</label>
            </div>
            <p class="text-danger small">* <?php echo $data['content_error'] ?></p>
          </div>
        </div>
        <button type="submit" class="mt-3 btn" style="background: #e74c3c; color: white;">
          <i class="bi bi-send me-2"></i>Gửi đánh giá
        </button>
      </form>

      <!-- Comments List -->
      <?php if ($data['comment']) {
        foreach ($data['comment'] as $comment) { ?>
          <div class="mb-3 card" style="border: none; background: #f8f9fa; border-radius: 10px;">
            <div class="card-body">
              <div class="mb-2 d-flex justify-content-between">
                <h6 class="mb-2 card-subtitle fw-bold"><?php echo $comment['name'] ?></h6>
                <small class="text-muted"><?php echo $comment['time'] ?></small>
              </div>
              <p class="mb-2 card-text"><?php echo $comment['cmt'] ?></p>
              <?php if ($comment['reply'] != '') { ?>
                <div class="p-3 ms-4" style="background: white; border-radius: 10px;">
                  <div class="mb-2 d-flex align-items-center">
                    <i class="bi bi-person-circle me-2"></i>
                    <h6 class="mb-0">Admin</h6>
                  </div>
                  <p class="mb-0 card-text"><?php echo $comment['reply'] ?></p>
                </div>
              <?php } ?>
            </div>
          </div>
        <?php }
      } else { ?>
        <div class="text-center text-muted">Chưa có bình luận nào</div>
      <?php } ?>
    </div>
  </div>
</div>