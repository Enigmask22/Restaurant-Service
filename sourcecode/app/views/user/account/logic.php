<?php
$response = "<div class='border-0 modal-content'>
    <div class='text-white modal-header bg-primary'>
        <h5 class='modal-title' id='exampleModalLabel'>
            <i class='bi bi-receipt me-2'></i>Booking Restaurant
        </h5>
        <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal' aria-label='Close'></button>
    </div>
    
    <div class='p-4 modal-body'>
        <!-- Thông tin khách hàng -->
        <div class='mb-4 border-0 shadow-sm card'>
            <div class='py-3 card-header bg-light'>
                <h6 class='mb-0 card-title'>
                    <i class='bi bi-person-circle me-2'></i>Thông tin khách hàng
                </h6>
            </div>
            <div class='card-body'>
                <div class='row g-3'>
                    <div class='col-md-6'>
                        <p class='mb-1 text-muted'>Họ và tên</p>
                        <p class='fw-medium'>{$data['booking']['fullname']}</p>
                    </div>
                    <div class='col-md-6'>
                        <p class='mb-1 text-muted'>Email</p>
                        <p class='fw-medium'>{$data['booking']['email']}</p>
                    </div>
                    <div class='col-md-6'>
                        <p class='mb-1 text-muted'>Điện thoại</p>
                        <p class='fw-medium'>{$data['booking']['phone']}</p>
                    </div>
                    <div class='col-md-6'>
                        <p class='mb-1 text-muted'>Địa chỉ</p>
                        <p class='fw-medium'>{$data['booking']['address']}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thông tin đặt chỗ -->
        <div class='mb-4 border-0 shadow-sm card'>
            <div class='py-3 card-header bg-light'>
                <h6 class='mb-0 card-title'>
                    <i class='bi bi-calendar-check me-2'></i>Thông tin đặt chỗ
                </h6>
            </div>
            <div class='card-body'>
                <div class='row g-3'>
                    <div class='col-md-6'>
                        <p class='mb-1 text-muted'>Ngày Booking</p>
                        <p class='fw-medium'>{$data['booking']['createdAt']}</p>
                    </div>
                    <div class='col-md-6'>
                        <p class='mb-1 text-muted'>Ngày khởi hành</p>
                        <p class='fw-medium'>{$data['booking']['date']}</p>
                    </div>
                    <div class='col-12'>
                        <p class='mb-1 text-muted'>Trạng thái</p>";

switch ($data['booking']['status']) {
    case 0:
        $response .= "<span class='badge bg-warning'>Đang xử lý</span>";
        break;
    case 1:
        $response .= "<span class='badge bg-info'>Đã xác nhận</span>";
        break;
    case 2:
        $response .= "<span class='badge bg-success'>Đã hoàn thành</span>";
        break;
    case 3:
        $response .= "<span class='badge bg-danger'>Đã hủy</span>";
        break;
}

$response .= "</div>
                </div>
            </div>
        </div>

        <!-- Chi tiết đơn hàng -->
        <div class='border-0 shadow-sm card'>
            <div class='py-3 card-header bg-light'>
                <h6 class='mb-0 card-title'>
                    <i class='bi bi-cart-check me-2'></i>Thông tin đặt nhà hàng
                </h6>
            </div>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-borderless'>
                        <thead class='table-light'>
                            <tr>
                                <th>Nhà hàng</th>
                                <th class='text-center'>Người lớn</th>
                                <th class='text-center'>Trẻ em</th>
                                <th class='text-end'>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class='fw-medium'>{$data['booking']['restaurant_name']}</td>
                                <td class='text-center'>{$data['booking']['adult_num']}</td>
                                <td class='text-center'>{$data['booking']['child_num']}</td>
                                <td class='text-end'>{$data['booking']['money']} VNĐ</td>
                            </tr>
                        </tbody>
                        <tfoot class='table-light'>
                            <tr>
                                <td colspan='3' class='fw-bold'>Tổng thanh toán</td>
                                <td class='text-end fw-bold text-danger'>{$data['booking']['money']} VNĐ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class='modal-footer bg-light'>";

if ($data['booking']['status'] == 0 || $data['booking']['status'] == 1) {
    $response .= "<form action='{$data['path']}user/restaurant/cancel_booking/{$data['booking']['bid']}' method='POST'>
            <input type='hidden' name='bid' value='{$data['booking']['bid']}'>
            <button type='submit' class='btn btn-danger' name='cancel-order'>
                <i class='bi bi-x-circle me-2'></i>Hủy đơn hàng
            </button>
        </form>";
}
$response .= "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>
            <i class='bi bi-x-circle me-2'></i>Đóng
        </button>
    </div>
</div>";

echo $response;
