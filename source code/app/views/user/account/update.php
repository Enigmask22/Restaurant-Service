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
                    <h5 class="mb-0 card-title fw-bold">CẬP NHẬT THÔNG TIN CÁ NHÂN</h5>
                </div>
                <div class="p-4 card-body">
                    <form action="#" id="update__form" method="post">
                        <div class="mb-3">
                            <label for="full-name" class="form-label">Họ và tên</label>
                            <input name="name" type="text" id="full-name" value="<?=$data['user']['name'] ?? null?>"
                                   class="form-control" placeholder="Họ và tên">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ hiện tại</label>
                            <input name="address" type="text" value="<?=$data['user']['address'] ?? null?>"
                                   class="form-control" id="address" placeholder="Số nhà, đường,...">
                        </div>
                        <div class="mb-3">
                            <label for="phone-number" class="form-label">Số điện thoại</label>
                            <input name="phone" type="text" id="phone-number" value="<?=$data['user']['phone'] ?? null?>"
                                   class="form-control" placeholder="Số điện thoại">
                        </div>
                        <div class="mt-4 text-center">
                            <button type="submit" class="px-4 py-2 btn btn-primary" name="update">
                                <i class="bi bi-save me-2"></i>Cập nhật thông tin
                            </button>
                        </div>
                        <input type="hidden" name='id'>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>