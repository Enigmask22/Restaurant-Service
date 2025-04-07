<?php
EnvHelper::loadEnv(__DIR__ . '/../../../.env');
?>

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

        <form class="gap-4 d-lg-flex" method="post" action="<?php echo $path ?>user/restaurant/booking/<?php echo $data['restaurant']['rid'] ?><?php if (isset($user_id)) {
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
                            <input type="text" class="form-control bg-light"
                                value="<?php echo $data['restaurant']['open_time'] ?>" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Địa chỉ</label>
                            <input type="text" class="form-control bg-light"
                                value="<?php echo $data['restaurant']['address'] ?>" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Đánh giá</label>
                            <input type="text" class="form-control bg-light"
                                value="<?php echo $data['restaurant']['res_rate'] ?> sao" disabled>
                        </div>
                    </div>

                    <!-- Thêm phần chọn chi nhánh -->
                    <div class="mb-4">
                        <label class="form-label text-muted">Chọn chi nhánh</label>
                        <select name="branch_id" class="form-select" required>
                            <option value="">-- Vui lòng chọn chi nhánh --</option>
                            <?php if (isset($data['branches']) && !empty($data['branches'])): ?>
                            <?php foreach ($data['branches'] as $branch): ?>
                            <option value="<?php echo $branch['aid']; ?>">
                                Chi nhánh <?php echo $branch['branch']; ?> - <?php echo $branch['location']; ?>
                            </option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <?php if (isset($data['branch_error']) && !empty($data['branch_error'])): ?>
                        <small class="text-danger"><?php echo $data['branch_error'] ?></small>
                        <?php endif; ?>
                    </div>

                    <!-- Booking Details -->
                    <div class="mb-4 row align-items-end">
                        <div class="mb-3 col-lg-6 mb-lg-0">
                            <label class="form-label text-muted">Số lượng người lớn</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                <input name="adult_count" type="number" class="form-control" id="adult_count" value="1"
                                    min="1">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label text-muted">Số lượng trẻ em</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-person-heart"></i></span>
                                <input name="child_count" type="number" class="form-control" id="child_count" value="0"
                                    min="0">
                                <span class="input-group-text text-danger bg-light">dưới 10 tuổi</span>
                            </div>
                        </div>
                    </div>

                    <!-- Price Info -->
                    <div class="mb-4 row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <label class="mb-0 form-label text-muted me-2">Giá người lớn:</label>
                                <?php if ($data['restaurant']['discount'] > 0) { ?>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-danger me-2">Giảm
                                        <?php echo $data['restaurant']['discount'] ?>%</span>
                                    <span class="text-decoration-line-through text-muted me-2">
                                        <?php echo $data['restaurant']['original_adult_price'] ?> đ
                                    </span>
                                    <span class="badge bg-warning" id="adult_price"
                                        value="<?php echo str_replace('.', '', $data['restaurant']['adult_price']) ?>">
                                        <?php echo $data['restaurant']['adult_price'] ?> đ
                                    </span>
                                </div>
                                <?php } else { ?>
                                <span class="badge bg-warning" id="adult_price"
                                    value="<?php echo str_replace('.', '', $data['restaurant']['adult_price']) ?>">
                                    <?php echo $data['restaurant']['adult_price'] ?> đ
                                </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <label class="mb-0 form-label text-muted me-2">Giá trẻ em:</label>
                                <?php if ($data['restaurant']['discount'] > 0) { ?>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-danger me-2">Giảm
                                        <?php echo $data['restaurant']['discount'] ?>%</span>
                                    <span class="text-decoration-line-through text-muted me-2">
                                        <?php echo $data['restaurant']['original_child_price'] ?> đ
                                    </span>
                                    <span class="badge bg-warning" id="child_price"
                                        value="<?php echo str_replace('.', '', $data['restaurant']['child_price']) ?>">
                                        <?php echo $data['restaurant']['child_price'] ?> đ
                                    </span>
                                </div>
                                <?php } else { ?>
                                <span class="badge bg-warning" id="child_price"
                                    value="<?php echo str_replace('.', '', $data['restaurant']['child_price']) ?>">
                                    <?php echo $data['restaurant']['child_price'] ?> đ
                                </span>
                                <?php } ?>
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

                    <!-- Thêm chuyển khoản -->
                    <div class="mb-4">
                        <label class="form-label text-muted">Phương thức thanh toán</label>
                        <div class="gap-2 d-flex flex-column">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method"
                                    id="payment_restaurant" value="restaurant" checked>
                                <label class="form-check-label" for="payment_restaurant">
                                    <i class="bi bi-shop me-2"></i>Thanh toán tại nhà hàng
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_transfer"
                                    value="transfer">
                                <label class="form-check-label" for="payment_transfer">
                                    <i class="bi bi-credit-card me-2"></i>Thanh toán chuyển khoản
                                </label>
                            </div>
                        </div>
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
} ?>" class="modal" tabindex="-1" id="success-booking" aria-hidden="false">
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

<!-- Payment Modal -->
<div class="modal fade" id="payment-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="border-0 shadow modal-content">
            <div class="modal-header" style="background: linear-gradient(45deg, #0dcaf0, #0d6efd);">
                <h5 class="text-white modal-title">
                    <i class="bi bi-credit-card-2-front me-2"></i>Thanh toán chuyển khoản
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="p-4 text-center modal-body">
                <div class="mb-4">
                    <p class="mb-1 text-muted">Vui lòng chuyển khoản theo thông tin sau và nhấn "Đã thanh toán" sau khi
                        chuyển
                        thành công:</p>
                    công:</p>
                    <h5 class="mb-3 text-primary" id="payment-amount"></h5>
                </div>

                <div class="p-3 mb-4 bg-light rounded-3">
                    <div class="mb-2 row">
                        <div class="col-5 text-start text-muted">Ngân hàng:</div>
                        <div class="col-7 text-start fw-bold"><?php echo EnvHelper::getEnv('BANK_ID', ''); ?></div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-5 text-start text-muted">Số tài khoản:</div>
                        <div class="col-7 text-start fw-bold"><?php echo EnvHelper::getEnv('ACCOUNT_NO', ''); ?></div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-5 text-start text-muted">Chủ tài khoản:</div>
                        <div class="col-7 text-start fw-bold"><?php echo EnvHelper::getEnv('ACCOUNT_NAME', ''); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-5 text-start text-muted">Nội dung CK:</div>
                        <div class="col-7 text-start fw-bold" id="payment-code"></div>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="mb-2 text-muted">Hoặc quét mã QR để thanh toán:</p>
                    <img src="<?php echo $path ?>public/images/qr-payment.png" alt="QR Code" class="img-fluid"
                        style="max-width: 200px;">
                </div>

                <div class="gap-2 d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-2"></i>Hủy
                    </button>
                    <button type="button" class="btn btn-success" id="confirm-payment-btn">
                        <i class="bi bi-check-circle me-2"></i>Đã thanh toán
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Verification Modal -->
<div class="modal fade" id="verification-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="border-0 shadow modal-content">
            <div class="p-4 text-center modal-body">
                <div class="mb-4 spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h5 class="mb-0">Đang xác nhận thanh toán...</h5>
                <p class="text-muted">Vui lòng đợi trong giây lát</p>
            </div>
        </div>
    </div>
</div>

<!-- Thêm vào cuối file, trước thẻ </div> cuối cùng -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const adultCountInput = document.getElementById('adult_count');
    const childCountInput = document.getElementById('child_count');
    const adultPriceElement = document.getElementById('adult_price');
    const childPriceElement = document.getElementById('child_price');
    const totalPriceElement = document.getElementById('total_price');
    const paymentTransferRadio = document.getElementById('payment_transfer');
    const paymentRestaurantRadio = document.getElementById('payment_restaurant');
    const paymentModal = document.getElementById('payment-modal');
    const paymentAmountElement = document.getElementById('payment-amount');
    const paymentCodeElement = document.getElementById('payment-code');

    calculateTotal();
    adultCountInput.addEventListener('change', calculateTotal);
    childCountInput.addEventListener('change', calculateTotal);

    // Xử lý sự kiện khi submit form
    form.addEventListener('submit', function(event) {
        // Nếu chọn thanh toán chuyển khoản
        if (paymentTransferRadio.checked) {
            event.preventDefault(); // Ngăn form submit

            // Lấy thông tin từ form
            const fullname = form.querySelector('input[name="fullname"]').value;
            const email = form.querySelector('input[name="email"]').value;
            const phone = form.querySelector('input[name="phone"]').value;
            const address = form.querySelector('textarea[name="address"]').value;
            const departDate = form.querySelector('input[name="depart_date"]').value;

            // Kiểm tra thông tin bắt buộc
            if (!fullname || !email || !phone || !address || !departDate) {
                // Nếu thiếu thông tin, cho form submit bình thường để hiển thị lỗi
                return true;
            }

            // Tạo mã thanh toán
            const paymentCode = `5SR${Date.now().toString().slice(-6)}`;

            // Tính tổng tiền
            const totalPrice = calculateTotalPrice();

            // Cập nhật thông tin trong modal thanh toán
            paymentAmountElement.textContent = formatNumber(totalPrice) + ' đ';
            paymentCodeElement.textContent = paymentCode;
            console.log(
                'API URL value: <?php echo EnvHelper::getEnv('API_URL', 'default_value_for_testing'); ?>'
            );
            // Tạo URL VietQR
            const bankID = '<?php echo EnvHelper::getEnv('BANK_ID', ''); ?>'; // Mã ngân hàng
            const accountNo = '<?php echo EnvHelper::getEnv('ACCOUNT_NO', ''); ?>'; // Số tài khoản
            const template = '<?php echo EnvHelper::getEnv('QR_TEMPLATE', ''); ?>'; // Mẫu QR
            const amount = totalPrice; // Số tiền
            const description = paymentCode; // Mô tả (mã thanh toán)
            const accountName =
                '<?php echo EnvHelper::getEnv('ACCOUNT_NAME', ''); ?>'; // Tên chủ tài khoản
            const paymentCheckApiUrl =
                '<?php echo EnvHelper::getEnv('API_URL', ''); ?>'; // URL API
            const qrUrl =
                `https://img.vietqr.io/image/${bankID}-${accountNo}-${template}.png?amount=${amount}&addInfo=${description}&accountName=${encodeURIComponent(accountName)}`;

            // Cập nhật hình ảnh QR
            const qrImage = document.querySelector('#payment-modal img');
            qrImage.src = qrUrl;

            // Hiển thị modal thanh toán
            const paymentModalInstance = new bootstrap.Modal(paymentModal);
            paymentModalInstance.show();

            // Xử lý khi người dùng xác nhận đã thanh toán
            document.getElementById('confirm-payment-btn').onclick = function() {
                // Ẩn modal thanh toán
                paymentModalInstance.hide();

                // Hiển thị modal xác nhận thanh toán
                const verificationModal = new bootstrap.Modal(document.getElementById(
                    'verification-modal'));
                verificationModal.show();

                checkPaymentStatus(paymentCheckApiUrl, paymentCode, totalPrice, bankID, accountNo,
                    description,
                    function(success) {
                        if (success) {
                            // Nếu thanh toán thành công
                            setTimeout(function() {
                                verificationModal.hide();

                                // Thêm trường ẩn để lưu mã thanh toán
                                const paymentCodeInput = document.createElement(
                                    'input');
                                paymentCodeInput.type = 'hidden';
                                paymentCodeInput.name = 'payment_code';
                                paymentCodeInput.value =
                                    paymentCode; // Mã thanh toán đã được tạo
                                form.appendChild(paymentCodeInput);

                                // Thêm trường ẩn để lưu phương thức thanh toán
                                const paymentMethodInput = document.createElement(
                                    'input');
                                paymentMethodInput.type = 'hidden';
                                paymentMethodInput.name = 'payment_method';
                                paymentMethodInput.value =
                                    'transfer'; // Xác định đây là thanh toán chuyển khoản
                                form.appendChild(paymentMethodInput);

                                // Submit form sau khi xác nhận
                                form.submit();
                            }, 1000);
                        } else {
                            // Nếu thanh toán thất bại
                            verificationModal.hide();
                            showPaymentFailedModal();
                        }
                    });
            };

            return false; // Ngăn form submit
        }
    });

    // Hàm kiểm tra trạng thái thanh toán
    function checkPaymentStatus(paymentCheckApiUrl, paymentCode, amount, bankID, accountNo, description,
        callback) {
        // Gọi API kiểm tra thanh toán
        // fetch(paymentCheckApiUrl)
        //   .then(response => {
        //     if (!response.ok) {
        //       throw new Error('Network response was not ok');
        //     }
        //     return response.json();
        //   })
        //   .then(responseData => {
        //     // Kiểm tra xem API có trả về lỗi không
        //     if (responseData.error) {
        //       console.error('API returned an error');
        //       callback(false);
        //       return;
        //     }

        //     // Lấy danh sách giao dịch từ API
        //     const transactions = responseData.data;

        //     // Tìm giao dịch khớp với mã thanh toán và số tiền
        //     const matchingTransaction = transactions.filter(transaction => {
        //       // Kiểm tra số tài khoản
        //       const accountMatch = transaction["Số tài khoản"] === accountNo;

        //       // Kiểm tra số tiền
        //       const amountMatch = parseInt(transaction["Giá trị"]) === 10000;

        //       // Kiểm tra mô tả có chứa mã thanh toán
        //       const descriptionMatch = transaction["Mô tả"].includes(description);

        //       console.log('Checking transaction:', transaction);
        //       console.log('Account match:', accountMatch, 'Expected:', accountNo, 'Got:', transaction["Số tài khoản"]);
        //       console.log('Amount match:', amountMatch, 'Expected:', amount, 'Got:', transaction["Giá trị"]);
        //       console.log('Description match:', descriptionMatch, 'Looking for:', description, 'In:', transaction["Mô tả"]);
        //       // Giao dịch hợp lệ khi khớp cả số tài khoản, số tiền và mô tả
        //       return accountMatch && amountMatch && descriptionMatch;
        //     });

        //     if (matchingTransaction.length > 0) {
        //       // Tìm thấy giao dịch khớp
        //       console.log('Found matching transaction:', matchingTransaction);
        //       callback(true);
        //     } else {
        //       // Không tìm thấy giao dịch khớp
        //       console.log('No matching transaction found');
        //       callback(false);
        //     }
        //   })
        //   .catch(error => {
        //     console.error('Error checking payment:', error);
        //     callback(false);
        //   });
        retryCheckPayment(paymentCheckApiUrl, paymentCode, amount, bankID, accountNo, description, callback, 0);
    }

    // Hàm thử lại kiểm tra thanh toán
    function retryCheckPayment(paymentCheckApiUrl, paymentCode, amount, bankID, accountNo, description,
        callback, retryCount) {
        if (retryCount > 3) {
            callback(false); // Đã thử 3 lần, trả về thất bại
            return;
        }

        // Cập nhật thông báo trong modal xác nhận
        const verificationMessage = document.querySelector('#verification-modal p');
        verificationMessage.textContent = `Đang kiểm tra thanh toán (lần ${retryCount}/3)...`;

        // Thử lại sau 3 giây
        setTimeout(function() {
            // Gọi API kiểm tra thanh toán
            fetch(paymentCheckApiUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(responseData => {
                    // Kiểm tra xem API có trả về lỗi không
                    if (responseData.error) {
                        console.error('API returned an error');
                        retryCheckPayment(paymentCheckApiUrl, paymentCode, amount, bankID,
                            accountNo, description, callback, retryCount + 1);
                        return;
                    }

                    // Lấy danh sách giao dịch từ API
                    const transactions = responseData.data;

                    // Tìm giao dịch khớp với mã thanh toán và số tiền
                    const matchingTransaction = transactions.filter(transaction => {
                        // Kiểm tra số tài khoản
                        const accountMatch = transaction["Số tài khoản"] === accountNo;

                        // Kiểm tra số tiền
                        const amountMatch = parseInt(transaction["Giá trị"]) === amount;

                        // Kiểm tra mô tả có chứa mã thanh toán
                        const descriptionMatch = transaction["Mô tả"].includes(description);


                        console.log('Checking transaction:', transaction);
                        console.log('Account match:', accountMatch, 'Expected:', accountNo,
                            'Got:', transaction["Số tài khoản"]);
                        console.log('Amount match:', amountMatch, 'Expected:', amount,
                            'Got:', transaction["Giá trị"]);
                        console.log('Description match:', descriptionMatch, 'Looking for:',
                            description, 'In:', transaction["Mô tả"]);
                        // Giao dịch hợp lệ khi khớp cả số tài khoản, số tiền và mô tả
                        return accountMatch && amountMatch && descriptionMatch;
                    });

                    if (matchingTransaction.length > 0) {
                        // Tìm thấy giao dịch khớp
                        console.log('Found matching transaction:', matchingTransaction);
                        callback(true);
                    } else {
                        // Không tìm thấy giao dịch khớp, thử lại
                        console.log('No matching transaction found, retrying...');
                        retryCheckPayment(paymentCheckApiUrl, paymentCode, amount, bankID,
                            accountNo, description, callback, retryCount + 1);
                    }
                })
                .catch(error => {
                    console.error('Error checking payment:', error);
                    retryCheckPayment(paymentCheckApiUrl, paymentCode, amount, bankID, accountNo,
                        description, callback, retryCount + 1);
                });
        }, 3000);
    }

    // Hàm hiển thị modal thanh toán thất bại
    function showPaymentFailedModal() {
        // Tạo modal thông báo thanh toán thất bại nếu chưa có
        if (!document.getElementById('payment-failed-modal')) {
            const modalHTML = `
        <div class="modal fade" id="payment-failed-modal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="border-0 shadow modal-content">
              <div class="text-white modal-header bg-danger">
                <h5 class="modal-title">
                  <i class="bi bi-exclamation-triangle-fill me-2"></i>Thanh toán thất bại
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="p-4 text-center modal-body">
                <i class="mb-4 bi bi-x-circle-fill text-danger display-1"></i>
                <h5 class="mb-3">Không tìm thấy giao dịch của bạn</h5>
                <p class="mb-4 text-muted">Vui lòng kiểm tra lại giao dịch chuyển khoản hoặc thử lại sau.</p>
                <div class="gap-2 d-flex justify-content-center">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                  </button>
                  <button type="button" class="btn btn-primary" id="retry-payment-btn">
                    <i class="bi bi-arrow-repeat me-2"></i>Thử lại
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      `;

            // Thêm modal vào body
            const modalContainer = document.createElement('div');
            modalContainer.innerHTML = modalHTML;
            document.body.appendChild(modalContainer);

            // Xử lý sự kiện nút thử lại
            document.getElementById('retry-payment-btn').addEventListener('click', function() {
                // Ẩn modal thất bại
                const paymentFailedModal = bootstrap.Modal.getInstance(document.getElementById(
                    'payment-failed-modal'));
                paymentFailedModal.hide();

                // Hiển thị lại modal thanh toán
                const paymentModalInstance = new bootstrap.Modal(paymentModal);
                paymentModalInstance.show();
            });
        }

        // Hiển thị modal thất bại
        const paymentFailedModal = new bootstrap.Modal(document.getElementById('payment-failed-modal'));
        paymentFailedModal.show();
    }

    // Hàm tính tổng tiền
    function calculateTotal() {
        const totalPrice = calculateTotalPrice();
        totalPriceElement.textContent = formatNumber(totalPrice) + ' đ';
    }

    // Hàm tính tổng tiền dựa trên số lượng người và giá
    function calculateTotalPrice() {
        const adultCount = parseInt(adultCountInput.value) || 0;
        const childCount = parseInt(childCountInput.value) || 0;
        const adultPrice = parseInt(adultPriceElement.getAttribute('value')) || 0;
        const childPrice = parseInt(childPriceElement.getAttribute('value')) || 0;

        return adultCount * adultPrice + childCount * childPrice;
    }

    // Hàm định dạng số tiền
    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
});
</script>



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