<?php
if (isset($_SESSION['user-id'])) {
  $user_id = $_SESSION['user-id'];
}
// echo ''.$user_id.'';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>5SRestaurant</title>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,700;1,100;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $path ?>/css/page.css">
  <link rel="stylesheet" href="<?php echo $path ?>/css/style.css">
  <link rel="stylesheet" href="<?php echo $path ?>/css/user.css">
  <link rel="stylesheet" href="<?php echo $path ?>/css/responsive.css">
  <style>
    .has-fixed-nav {
      padding-top: 76px;
      /* Điều chỉnh giá trị này bằng với chiều cao của navbar */
    }
  </style>
</head>

<body class="has-fixed-nav">
  <nav class="navbar navbar-expand-lg fixed-top"
    style="background: rgba(255, 255, 255, 0.95); box-shadow: 0 2px 20px rgba(0,0,0,0.1);">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="<?php echo $path ?>img/logo.avif" alt="5SR Logo" width="45" height="45" class="me-2">
        <span style="font-size: 1.5rem; font-weight: 700; color: #2c3e50;">5SR</span>
      </a>

      <!-- Mobile Toggle -->
      <button class="border-0 navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <i class="bi bi-list" style="font-size: 1.8rem; color: #2c3e50;"></i>
      </button>

      <!-- Main Navigation -->
      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="mx-auto navbar-nav">
          <li class="nav-item">
            <a class="px-3 nav-link" href="<?php echo $path ?>user/home/homepage">
              <i class="bi bi-house-door"></i> Trang chủ
            </a>
          </li>
          <li class="nav-item">
            <a class="px-3 nav-link" href="<?php echo $path ?>user/home/introduction">
              <i class="bi bi-info-circle"></i> Giới thiệu
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="px-3 nav-link dropdown-toggle" href="<?php echo $path ?>user/restaurant/list_res/0">
              <i class="bi bi-houses"></i> Nhà hàng
            </a>
            <ul class="border-0 shadow-sm dropdown-menu">
              <?php foreach ($data['category'] as $category) { ?>
                <li>
                  <a class="py-2 dropdown-item"
                    href="<?php echo $path ?>user/restaurant/list_res/<?php echo $category['cateid'] ?>">
                    <?php echo $category['category_name'] ?>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
          <li class="nav-item">
            <a class="px-3 nav-link" href="<?php echo $path ?>user/restaurant/list_price">
              <i class="bi bi-coin"></i> Bảng giá
            </a>
          </li>
          <li class="nav-item">
            <a class="px-3 nav-link" href="<?php echo $path ?>user/news/list_news">
              <i class="bi bi-newspaper"></i> Tin tức
            </a>
          </li>
          <li class="nav-item">
            <a class="px-3 nav-link" href="<?php echo $path ?>user/home/photo">
              <i class="bi bi-images"></i> Hình ảnh
            </a>
          </li>
          <li class="nav-item">
            <a class="px-3 nav-link" href="<?php echo $path ?>user/home/contact">
              <i class="bi bi-person-rolodex"></i> Liên hệ
            </a>
          </li>
        </ul>

        <!-- Right Side Items -->
        <!-- User Account -->
        <div class="ms-auto">
          <div class="dropdown">
            <a class="gap-2 nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle fs-4"></i>
              <span class="fw-medium">Tài khoản</span>
            </a>
            <?php if (isset($user_id)) { ?>
              <ul class="border-0 shadow-sm dropdown-menu dropdown-menu-end" style="width: 250px;">
                <li class="px-4 py-3 text-center">
                  <span class="fw-bold text-primary fs-6">THÔNG TIN TÀI KHOẢN</span>
                </li>
                <li>
                  <hr class="mx-2 dropdown-divider">
                </li>
                <li>
                  <a class="px-4 py-2 dropdown-item d-flex align-items-center" href="<?php echo $path ?>user/account/">
                    <i class="bi bi-person me-3 fs-5"></i>
                    <span>Thông tin cá nhân</span>
                  </a>
                </li>
                <li>
                  <a class="px-4 py-2 dropdown-item d-flex align-items-center"
                    href="<?php echo $path ?>user/account/manageBooking">
                    <i class="bi bi-menu-button-wide me-3 fs-5"></i>
                    <span>Quản lý đặt nhà hàng</span>
                  </a>
                </li>
                <li>
                  <a class="px-4 py-2 dropdown-item d-flex align-items-center"
                    href="<?php echo $path ?>user/account/changePassword">
                    <i class="bi bi-lock me-3 fs-5"></i>
                    <span>Đổi mật khẩu</span>
                  </a>
                </li>
                <li>
                  <hr class="mx-2 dropdown-divider">
                </li>
                <li>
                  <a class="px-4 py-2 dropdown-item d-flex align-items-center text-danger"
                    href="<?php echo $path ?>user/account/logout">
                    <i class="bi bi-box-arrow-right me-3 fs-5"></i>
                    <span>Đăng xuất</span>
                  </a>
                </li>
              </ul>
            <?php } else { ?>
              <div class="border-0 shadow-sm dropdown-menu dropdown-menu-end" style="width: 250px;">
                <div class="p-4 text-center">
                  <h6 class="mb-3 text-primary fw-bold">THÔNG TIN TÀI KHOẢN</h6>
                  <a href="<?php echo $path ?>authen/home/login" class="py-2 btn btn-primary w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập
                  </a>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </nav>