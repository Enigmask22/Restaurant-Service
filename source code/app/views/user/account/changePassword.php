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
    <div class="row g-4">
        <!-- Sidebar -->
        <div class="col-lg-3">
            <div class="border-0 shadow-sm card rounded-3">
                <div class="p-4 text-center card-body">
                    <div class="mb-4">
                        <img src="https://static.vecteezy.com/system/resources/previews/013/042/571/original/default-avatar-profile-icon-social-media-user-photo-in-flat-style-vector.jpg" 
                             class="rounded-circle img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                        <h5 class="mt-3 mb-0">Xin chào</h5>
                    </div>
                    
                    <div class="list-group list-group-flush">
                        <a href="<?php echo $path ?>user/account" 
                           class="py-3 list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-person fs-5 me-3"></i>
                            <span>Thông tin cá nhân</span>
                        </a>
                        <a href="<?php echo $path ?>user/account/manageBooking" 
                           class="py-3 list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-menu-button-wide fs-5 me-3"></i>
                            <span>Quản lý đặt nhà hàng</span>
                        </a>
                        <a href="<?php echo $path ?>user/account/changePassword" 
                           class="py-3 list-group-item list-group-item-action d-flex align-items-center active">
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
                    <h5 class="mb-0 card-title">
                        <i class="bi bi-shield-lock me-2"></i>Đổi mật khẩu
                    </h5>
                </div>
                <div class="p-4 card-body">
                    <form id="update__form" method="post" class="mx-auto max-w-md">
                        <!-- Mật khẩu cũ -->
                        <div class="mb-4">
                            <label class="form-label fw-medium">Mật khẩu cũ</label>
                            <div class="input-group">
                                <input type="password" 
                                       name="password" 
                                       id="password1" 
                                       class="form-control" 
                                       required>
                                <button class="btn btn-outline-secondary" 
                                        type="button" 
                                        id="togglePassword1">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Mật khẩu mới -->
                        <div class="mb-4">
                            <label class="form-label fw-medium">Mật khẩu mới</label>
                            <div class="input-group">
                                <input type="password" 
                                       name="npassword" 
                                       id="password2" 
                                       class="form-control" 
                                       required>
                                <button class="btn btn-outline-secondary" 
                                        type="button" 
                                        id="togglePassword2">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Nhập lại mật khẩu mới -->
                        <div class="mb-4">
                            <label class="form-label fw-medium">Nhập lại mật khẩu mới</label>
                            <div class="input-group">
                                <input type="password" 
                                       name="cpassword" 
                                       id="password3" 
                                       class="form-control" 
                                       required>
                                <button class="btn btn-outline-secondary" 
                                        type="button" 
                                        id="togglePassword3">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" 
                                    name="update" 
                                    class="px-5 btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Cập nhật mật khẩu
                            </button>
                        </div>

                        <input type="hidden" name="id">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
document.querySelectorAll('[id^="togglePassword"]').forEach(button => {
    button.addEventListener('click', function() {
        const input = this.parentElement.querySelector('input');
        const icon = this.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        }
    });
});
</script>