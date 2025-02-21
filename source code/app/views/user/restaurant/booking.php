

<div class="py-5 container-fluid booking" style="background-color: #f8f9fa;">
  <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 10px;">
    <div class="container">
      <ol class="py-3 mb-0 breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo $path ?>user/home/homepage" class="text-decoration-none" style="color: #666;">
            <i class="bi bi-house-door-fill me-1"></i>Trang chủ
          </a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo $path ?>user/restaurant/restaurant_detail/<?php echo $data['restaurant']['rid'] ?>"
            class="text-decoration-none" style="color: #666;">
            <i class="bi bi-shop me-1"></i><?php echo $data['restaurant']['restaurant_name'] ?>
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <i class="bi bi-calendar-check me-1"></i>Đặt nhà hàng
        </li>
      </ol>
    </div>
  </nav>
  <div class="mx-auto w-75">
    <h2 class="mb-5 text-center position-relative">
      <span class="px-4 py-2 position-relative">
        ĐẶT NHÀ HÀNG
        <div class="bottom-0 position-absolute start-0 end-0"
          style="height: 2px; background: linear-gradient(90deg, transparent, #0dcaf0, transparent);"></div>
      </span>
    </h2>

    <form class="gap-4 d-lg-flex" method="post"
      action="<?php echo $path ?>user/restaurant/booking/<?php echo $data['restaurant']['rid'] ?><?php if (isset($user_id)) {
              echo '/' . $user_id;
            } ?>">
      <!-- Restaurant Service Section -->
      <div class="bg-white border-0 shadow-sm col-lg-8 rounded-4">
        <div class="border-bottom" style="background: linear-gradient(45deg, #0dcaf0, #0d6efd);">
          <h5 class="p-3 mb-0 text-white">
            <i class="bi bi-building me-2"></i>Dịch vụ nhà hàng
          </h5>
        </div>

        <div class="p-4">
          <!-- Restaurant Name -->
          <div class="mb-4">
            <label class="form-label text-muted">Tên nhà hàng</label>
            <input type="text" class="form-control bg-light"
              value="<?php echo $data['restaurant']['restaurant_name'] ?>" disabled>
          </div>

          <!-- Restaurant Info -->
          <div class="mb-4 row">
            <div class="col-md-4">
              <label class="form-label text-muted">Giờ mở cửa</label>
              <input type="text" class="form-control bg-light" value="<?php echo $data['restaurant']['open_time'] ?>"
                disabled>
            </div>
            <div class="col-md-4">
              <label class="form-label text-muted">Địa chỉ</label>
              <input type="text" class="form-control bg-light" value="<?php echo $data['restaurant']['address'] ?>"
                disabled>
            </div>
            <div class="col-md-4">
              <label class="form-label text-muted">Đánh giá</label>
              <input type="text" class="form-control bg-light" value="<?php echo $data['restaurant']['res_rate'] ?> sao"
                disabled>
            </div>
          </div>

          <!-- Booking Details -->
          <div class="mb-4 row align-items-end">
            <div class="mb-3 col-lg-6 mb-lg-0">
              <label class="form-label text-muted">Số lượng người lớn</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                <input name="adult_count" type="number" class="form-control" id="adult_count" value="1" min="1">
              </div>
            </div>
            <div class="col-lg-6">
              <label class="form-label text-muted">Số lượng trẻ em</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-person-heart"></i></span>
                <input name="child_count" type="number" class="form-control" id="child_count" value="0" min="0">
                <span class="input-group-text text-danger bg-light">dưới 10 tuổi</span>
              </div>
            </div>
          </div>

          <!-- Price Info -->
          <div class="mb-4 row">
            <div class="col-md-6">
              <div class="d-flex align-items-center">
                <label class="mb-0 form-label text-muted me-2">Giá người lớn:</label>
                <span class="badge bg-warning" id="adult_price"
                  value="<?php echo $data['restaurant']['adult_price'] ?>"><?php echo $data['restaurant']['adult_price'] ?>
                  đ</span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex align-items-center">
                <label class="mb-0 form-label text-muted me-2">Giá trẻ em:</label>
                <span class="badge bg-warning" id="child_price"
                  value="<?php echo $data['restaurant']['child_price'] ?>"><?php echo $data['restaurant']['child_price'] ?>
                  đ</span>
              </div>
            </div>
          </div>

          <!-- Date & Total -->
          <div class="row align-items-end">
            <div class="col-lg-6">
              <label class="form-label text-muted">Chọn ngày đặt</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-calendar3"></i></span>
                <input required name="depart_date" type="date" class="form-control" value=""
                  min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="text-end">
                <label class="form-label text-muted d-block">Tổng tiền</label>
                <span class="fs-4 fw-bold text-primary" id="total_price"></span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Contact Information Section -->
      <div class="bg-white border-0 shadow-sm col-lg-3 rounded-4">
        <div class="border-bottom" style="background: linear-gradient(45deg, #ffc107, #fd7e14);">
          <h5 class="p-3 mb-0 text-white">
            <i class="bi bi-person-lines-fill me-2"></i>Thông tin liên lạc
          </h5>
        </div>

        <div class="p-4">
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
              <input type="text" class="form-control" placeholder="Họ tên" name="fullname">
            </div>
            <small class="text-danger"><?php echo $data['fullname_error'] ?></small>
          </div>

          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text bg-light"><i class="bi bi-telephone"></i></span>
              <input type="text" class="form-control" placeholder="Số điện thoại" name="phone">
            </div>
            <small class="text-danger"><?php echo $data['phone_error'] ?></small>
          </div>

          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
              <input type="text" class="form-control" placeholder="Email" name="email">
            </div>
            <small class="text-danger"><?php echo $data['email_error'] ?></small>
          </div>

          <div class="mb-4">
            <div class="input-group">
              <span class="input-group-text bg-light"><i class="bi bi-geo-alt"></i></span>
              <textarea name="address" class="form-control" rows="3" placeholder="Địa chỉ"></textarea>
            </div>
            <small class="text-danger"><?php echo $data['address_error'] ?></small>
          </div>

          <button class="btn btn-primary w-100" type="submit">
            <i class="bi bi-check2-circle me-2"></i>Đặt nhà hàng
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Success Modal -->
<div style="<?php if ($data['isSuccess']) {
  echo 'display:block;';
} ?>" class="modal" tabindex="-1" id="success-booking"
  aria-hidden="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="border-0 shadow modal-content">
      <div class="p-5 text-center modal-body">
        <i class="mb-4 bi bi-check-circle-fill text-success display-1"></i>
        <h4 class="mb-3 modal-title">Đặt nhà hàng thành công</h4>
        <p class="mb-4 text-muted">Cảm ơn quý khách đã tin tưởng 5SR</p>
        <a href="<?php echo $path ?>user/home/homepage" class="px-4 btn btn-primary">
          <i class="bi bi-house me-2"></i>Về trang chủ
        </a>
      </div>
    </div>
  </div>
</div>

<style>
  .booking {
    background-image: linear-gradient(to right top, rgba(13, 202, 240, 0.05), rgba(13, 110, 253, 0.05));
  }

  .form-control:disabled {
    background-color: #f8f9fa !important;
    opacity: 1;
  }

  .form-control:focus {
    border-color: #0dcaf0;
    box-shadow: 0 0 0 0.25rem rgba(13, 202, 240, 0.25);
  }

  .input-group-text {
    border: none;
  }

  .modal-dialog {
    margin-top: 10vh;
  }
</style>