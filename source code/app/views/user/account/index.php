<nav aria-label="breadcrumb">
    <div class="bg-body-secondary hide">
        <ol class="py-2 mx-auto w-75 breadcrumb fs-6">
            <li class="breadcrumb-item">
                <a class="text-black link-underline link-underline-opacity-0 breadcrumb__item" href="<?php echo $path ?>user/home/homepage">
                    Trang chủ
                </a>
            </li>
            <li class="breadcrumb-item active">
                Tài khoản
            </li>
        </ol>
    </div>
</nav>


<div class="container py-5">
    <div class="row">
        <!-- Left Sidebar -->
        <div class="col-lg-3">
            <div class="border-0 shadow-sm card rounded-3">
                <div class="p-4 text-center card-body">
                    <div class="mb-4">
                        <form id="uploadForm" action="<?php echo $path ?>/user/account/uploadFile/<?php echo $data['user']['fid'] ?>" method="POST" enctype="multipart/form-data" style="position: relative;">
                            <div>
                                <?php if (isset($data['user']['path'])): ?>
                                    <img
                                        src="<?= $data['user']['path'] ?>"
                                        class="rounded-circle img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                                <?php else: ?>
                                    <img
                                        src="https://static.vecteezy.com/system/resources/previews/013/042/571/original/default-avatar-profile-icon-social-media-user-photo-in-flat-style-vector.jpg"
                                        class="rounded-circle img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                                <?php endif ?>
                                <div>
                                    <input
                                        type="file"
                                        class="form-control mt-3"
                                        id="avatar"
                                        name="avatar"
                                        style="position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    opacity: 0;
                                    cursor: pointer;
                                    z-index: 1;
                                ">
                                </div>
                            </div>
                            <h5 class="mt-3 mb-0">Xin chào</h5>
                        </form>
                    </div>

                    <div class="list-group list-group-flush">
                        <a href="<?php echo $path ?>user/account"
                            class="py-3 list-group-item list-group-item-action d-flex align-items-center active">
                            <i class="bi bi-person fs-5 me-3"></i>
                            <span>Thông tin cá nhân</span>
                        </a>
                        <a href="<?php echo $path ?>user/account/manageBooking"
                            class="py-3 list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-menu-button-wide fs-5 me-3"></i>
                            <span>Quản lý đặt nhà hàng</span>
                        </a>
                        <a href="<?php echo $path ?>user/account/changePassword"
                            class="py-3 list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-lock fs-5 me-3"></i>
                            <span>Đổi mật khẩu</span>
                        </a>
                        <a href="<?php echo $path ?>user/account/logout"
                            class="py-3 list-group-item list-group-item-action d-flex align-items-center text-danger">
                            <i class="bi bi-box-arrow-right fs-5 me-3"></i>
                            <span>Đăng xuất</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="border-0 shadow-sm card rounded-3">
                <div class="py-3 bg-white card-header">
                    <h5 class="mb-0 card-title fw-bold">THÔNG TIN CÁ NHÂN</h5>
                </div>
                <div class="p-4 card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="mb-1 text-muted d-block">Họ và tên</small>
                                <?php if (isset($data['user']['name'])): ?>
                                    <p class="mb-0 fw-medium"><?= $data['user']['name'] ?></p>
                                <?php else: ?>
                                    <p class="mb-0 text-danger">Bạn cần cập nhật họ và tên</p>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="mb-1 text-muted d-block">Email</small>
                                <?php if (isset($data['user']['email'])): ?>
                                    <p class="mb-0 fw-medium"><?= $data['user']['email'] ?></p>
                                <?php else: ?>
                                    <p class="mb-0 text-danger">Bạn cần cập nhật Email</p>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="mb-1 text-muted d-block">Địa chỉ</small>
                                <?php if ($data['user']['address']): ?>
                                    <p class="mb-0 fw-medium"><?= $data['user']['address'] ?></p>
                                <?php else: ?>
                                    <p class="mb-0 text-danger">Bạn cần cập nhật Địa chỉ</p>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="mb-1 text-muted d-block">Điện thoại</small>
                                <?php if (isset($data['user']['phone'])): ?>
                                    <p class="mb-0 fw-medium"><?= $data['user']['phone'] ?></p>
                                <?php else: ?>
                                    <p class="mb-0 text-danger">Bạn cần cập nhật số điện thoại</p>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="<?php echo $path ?>user/account/updateUser"
                            class="px-4 py-2 btn btn-primary">
                            <i class="bi bi-pencil-square me-2"></i>
                            Cập nhật thông tin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    // Lấy phần tử input
    const fileInput = document.getElementById('avatar');
    const form = document.getElementById('uploadForm');
    // Lắng nghe sự kiện thay đổi
    fileInput.addEventListener('change', function() {
        if (this.files && this.files.length > 0) {
            const fileName = this.files[0].name;
            alert(`Bạn đã chọn file: ${fileName}`);
            form.submit();
            // const formData = new FormData();
            // formData.append('avatar', this.files[0]);

            // const xhr = new XMLHttpRequest();
            // xhr.open('POST', '/user/account/uploadFile', true);

            // xhr.onload = function() {
            //     if (xhr.status === 200) {
            //         alert('File đã được tải lên thành công!');
            //         console.log('Phản hồi:', xhr.responseText);
            //     } else {
            //         alert('Có lỗi xảy ra khi tải file lên!');
            //     }
            // };

            // xhr.onerror = function() {
            //     alert('Lỗi kết nối!');
            // };

            // xhr.send(formData);
        } else {
            alert('Bạn chưa chọn file nào!');
        }
    });
</script>