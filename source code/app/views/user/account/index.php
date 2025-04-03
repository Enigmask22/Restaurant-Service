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
        <?php require_once "leftSidebar.php" ?>

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