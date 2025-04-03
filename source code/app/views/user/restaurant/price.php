<div class="container py-5">
  <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 10px;">
    <div class="container">
      <ol class="py-3 mb-0 breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo $path ?>user/home/homepage" class="text-decoration-none" style="color: #666;">
            <i class="bi bi-house-door-fill me-1"></i>Trang chủ
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <i class="bi bi-currency-dollar me-1"></i>Bảng giá
        </li>
      </ol>
    </div>
  </nav>
  <div class="card" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
    <div class="p-4 card-body">
      <!-- Header -->
      <div class="mb-4 text-center">
        <h2 class="text-uppercase fw-bold" style="color: #2c3e50;">
          Bảng Giá Nhà Hàng
          <div style="height: 4px; width: 50px; background: #e74c3c; margin: 15px auto;"></div>
        </h2>
      </div>

      <!-- Restaurant Cards -->
      <div class="table-responsive">
        <table class="table align-middle table-hover" style="border-collapse: separate; border-spacing: 0 15px; ">
          <thead>
            <tr style="background: #f8f9fa;">
              <th class="px-4 py-3 text-center" style="border-radius: 10px 0 0 10px;">#</th>
              <th class="px-4 py-3">Tên nhà hàng</th>
              <th class="px-4 py-3 text-center">Thời gian</th>
              <th class="px-4 py-3">Địa chỉ</th>
              <th class="px-4 py-3 text-center">Đánh giá</th>
              <th class="px-4 py-3 text-center">Giá người lớn</th>
              <th class="px-4 py-3 text-center">Giá trẻ em</th>
              <th class="px-4 py-3 text-center" style="border-radius: 0 10px 10px 0;"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['restaurant'] as $res) { ?>
              <tr style="background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <td class="px-4 py-3 text-center fw-bold" style="border-radius: 10px 0 0 10px;">
                  <?php echo $res['rid'] ?>
                </td>
                <td class="px-1 py-3">
                  <a href="<?php echo $path ?>user/restaurant/restaurant_detail/<?php echo $res['rid'] ?>"
                    class="text-decoration-none fw-semibold" style="color: #2c3e50;">
                    <?php echo $res['restaurant_name'] ?>
                    <?php if ($res['discount'] > 0) { ?>
                      <span class="ms-2 badge bg-danger">Giảm <?php echo $res['discount'] ?>%</span>
                    <?php } ?>
                  </a>
                </td>
                <td class="px-2 py-3 text-center">
                  <i class="bi bi-clock me-2" style="color: #3498db;"></i>
                  <?php echo $res['open_time'] ?>
                </td>
                <td class="px-2 py-3">
                  <i class="bi bi-geo-alt me-2" style="color: #e74c3c;"></i>
                  <?php echo $res['address'] ?>
                </td>
                <td class="px-2 py-3 text-center">
                  <?php for ($i = 0; $i < $res['res_rate']; $i++) { ?>
                    <i class="bi bi-star-fill" style="color: #f1c40f;"></i>
                  <?php } ?>
                </td>
                <td class="px-4 py-3 text-center">
                  <?php if ($res['discount'] > 0) { ?>
                    <div class="text-decoration-line-through text-muted">
                      <?php echo ($res['original_adult_price']) ?> đ
                    </div>
                  <?php } ?>
                  <div class="fw-bold" style="color: #e74c3c;">
                    <?php echo ($res['adult_price']) ?> đ
                  </div>
                </td>
                <td class="px-4 py-3 text-center">
                  <?php if ($res['discount'] > 0) { ?>
                    <div class="text-decoration-line-through text-muted">
                      <?php echo ($res['original_child_price']) ?> đ
                    </div>
                  <?php } ?>
                  <div class="fw-bold" style="color: #e74c3c;">
                    <?php echo ($res['child_price']) ?> đ
                  </div>
                </td>
                <td class="px-2 py-3 text-center" style="border-radius: 0 10px 10px 0;">
                  <a href="<?php echo $path ?>user/restaurant/booking/<?php echo $res['rid'] ?>" class="px-3 btn"
                    style="background: #e74c3c; color: white; border-radius: 20px; transition: all 0.3s ease;">
                    <i class="bi bi-calendar-check me-2"></i>Đặt ngay
                  </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="mt-4 d-flex justify-content-center">
        <nav aria-label="Page navigation">
          <ul class="pagination" style="gap: 5px;">
            <li class="page-item <?php if ($data['currentPage'] == 1) {
              echo "disabled";
            } ?>">
              <a href="<?php echo $path ?>user/restaurant/list_price/<?php echo $data['currentPage'] - 1 ?>"
                class="page-link" style="border-radius: 8px; color: #e74c3c; border: 1px solid #e74c3c;">
                <i class="bi bi-chevron-left"></i>
              </a>
            </li>

            <?php for ($i = 1; $i <= $data['maxPage']; $i++) { ?>
              <li class="page-item <?php if ($i == $data['currentPage']) {
                echo 'active';
              } ?>">
                <a <?php if ($i != $data['currentPage']) { ?>
                    href="<?php echo $path ?>user/restaurant/list_price/<?php echo $i ?>" <?php } ?> class="page-link"
                  style="border-radius: 8px; <?php if ($i == $data['currentPage']) {
                    echo 'background: #e74c3c; border-color: #e74c3c;';
                  } else {
                    echo 'color: #e74c3c; border: 1px solid #e74c3c;';
                  } ?>">
                  <?php echo $i ?>
                </a>
              </li>
            <?php } ?>

            <li class="page-item <?php if ($data['currentPage'] == $data['maxPage']) {
              echo "disabled";
            } ?>">
              <a href="<?php echo $path ?>user/restaurant/list_price/<?php echo $data['currentPage'] + 1 ?>"
                class="page-link" style="border-radius: 8px; color: #e74c3c; border: 1px solid #e74c3c;">
                <i class="bi bi-chevron-right"></i>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>