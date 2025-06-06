
<div class="container py-5">
    <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 10px;">
        <div class="container">
            <ol class="py-3 mb-0 breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo $path ?>user/home/homepage" class="text-decoration-none" style="color: #666;">
                        <i class="bi bi-house-door-fill me-1"></i>Trang chủ
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <i class="bi bi-envelope-fill me-1"></i>Liên hệ
                </li>
            </ol>
        </div>
    </nav>
    <div class="row g-4">
        <!-- Left Column - Contact Info -->
        <div class="col-lg-5">
            <div class="card h-100" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                <div class="p-4 card-body">
                    <!-- Contact Information -->
                    <div class="mb-5">
                        <h3 class="mb-4 fw-bold" style="color: #2c3e50;">
                            Thông Tin Liên Hệ
                            <div style="height: 3px; width: 50px; background: #e74c3c; margin-top: 10px;"></div>
                        </h3>
                        <div class="gap-4 d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <div class="p-3 rounded-circle me-3" style="background: #f8f9fa;">
                                    <i class="bi bi-geo-alt-fill" style="color: #e74c3c; font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted">Địa chỉ</p>
                                    <p class="mb-0 fw-semibold"><?php echo $data['general']['address'] ?></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="p-3 rounded-circle me-3" style="background: #f8f9fa;">
                                    <i class="bi bi-telephone-fill" style="color: #3498db; font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted">Điện thoại</p>
                                    <p class="mb-0 fw-semibold"><?php echo $data['general']['phone'] ?></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="p-3 rounded-circle me-3" style="background: #f8f9fa;">
                                    <i class="bi bi-printer-fill" style="color: #2ecc71; font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted">Hotline</p>
                                    <p class="mb-0 fw-semibold"><?php echo $data['general']['hotline'] ?></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="p-3 rounded-circle me-3" style="background: #f8f9fa;">
                                    <i class="bi bi-envelope-fill" style="color: #9b59b6; font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted">Email</p>
                                    <p class="mb-0 fw-semibold"><?php echo $data['general']['email'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Banking Information -->
                    <div>
                        <h3 class="mb-4 fw-bold" style="color: #2c3e50;">
                            Thông Tin Chuyển Khoản
                            <div style="height: 3px; width: 50px; background: #e74c3c; margin-top: 10px;"></div>
                        </h3>
                        <div class="gap-4 d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <div class="p-3 rounded-circle me-3" style="background: #f8f9fa;">
                                    <i class="bi bi-person-bounding-box" style="color: #f1c40f; font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted">Chủ tài khoản</p>
                                    <p class="mb-0 fw-semibold"><?php echo $data['general']['fullname'] ?></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="p-3 rounded-circle me-3" style="background: #f8f9fa;">
                                    <i class="bi bi-person-vcard" style="color: #e67e22; font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted">Số tài khoản</p>
                                    <p class="mb-0 fw-semibold"><?php echo $data['general']['bankID'] ?></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="p-3 rounded-circle me-3" style="background: #f8f9fa;">
                                    <i class="bi bi-bank" style="color: #16a085; font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted">Ngân hàng</p>
                                    <p class="mb-0 fw-semibold"><?php echo $data['general']['bank_name'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Contact Form -->
        <div class="col-lg-7">
            <div class="card" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                <div class="p-4 card-body">
                    <h3 class="mb-4 fw-bold" style="color: #2c3e50;">
                        Liên Hệ Chúng Tôi
                        <div style="height: 3px; width: 50px; background: #e74c3c; margin-top: 10px;"></div>
                    </h3>
                    <form method="post" class="needs-validation">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="fullname" id="floatingName"
                                        placeholder="Họ tên" required>
                                    <label for="floatingName">Họ tên</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="address" id="floatingAddress"
                                        placeholder="Địa chỉ" required>
                                    <label for="floatingAddress">Địa chỉ</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" name="phone" id="floatingPhone"
                                        placeholder="Điện thoại" required>
                                    <label for="floatingPhone">Điện thoại</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" id="floatingEmail"
                                        placeholder="Email" required>
                                    <label for="floatingEmail">Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="description" id="floatingDescription"
                                        placeholder="Mô tả" style="height: 150px" required></textarea>
                                    <label for="floatingDescription">Mô tả</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="py-3 btn w-100"
                                    style="background: #e74c3c; color: white; border-radius: 10px;">
                                    <i class="bi bi-send me-2"></i>GỬI THÔNG TIN LIÊN HỆ
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #e74c3c;
        box-shadow: 0 0 0 0.25rem rgba(231, 76, 60, 0.25);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        transition: all 0.3s ease;
    }
</style>

<?php
// Thiết lập SEO cho trang liên hệ
$pageSpecificTitle = "Liên Hệ Nhà Hàng Buffet 5SR | Đặt Bàn & Hỗ Trợ";
$pageSpecificDescription = "Liên hệ với Nhà hàng Buffet 5SR để đặt bàn, giải đáp thắc mắc hoặc góp ý. Chúng tôi luôn sẵn sàng phục vụ bạn tại Quận 10, TP.HCM. Gọi ngay hoặc gửi form!";
$pageSpecificKeywords = "liên hệ buffet 5sr, đặt bàn buffet 5sr, địa chỉ nhà hàng 5sr, số điện thoại buffet 5sr, hỗ trợ khách hàng";
$pageSpecificOgImage = 'https://restaurant-dth.s3.ap-southeast-2.amazonaws.com/og-images/contact-us.jpg';
$ogSiteName = "Nhà hàng Buffet 5SR";
$ogType = "restaurant:contact"; // Hoặc 'contact_point' nếu schema.org được dùng sâu hơn
?>