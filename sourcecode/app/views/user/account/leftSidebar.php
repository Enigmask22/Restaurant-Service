<div class="col-lg-3">
    <div class="border-0 shadow-sm card rounded-3">
        <div class="p-4 text-center card-body">
            <div class="mb-4">
                <!-- Debug information -->
                <!-- <div style="background-color: #f8d7da; padding: 10px; margin-bottom: 10px; border-radius: 5px; display: none;" id="debugInfo">
                    <h6>Debug Information:</h6>
                    <pre><?php
                    echo "user data: ";
                    print_r($data['user']);
                    echo "\n\nfid value: ";
                    var_dump(isset($data['user']['fid']) ? $data['user']['fid'] : 'Not set');
                    ?></pre>
                    <button class="btn btn-sm btn-danger" onclick="document.getElementById('debugInfo').style.display='none'">Đóng</button>
                </div>
                <button class="btn btn-sm btn-secondary mb-2"
                    onclick="document.getElementById('debugInfo').style.display='block'">Hiện thông tin debug</button> -->


                <form id="uploadForm"
                    action="<?php echo $path ?>/user/account/uploadFile/<?php echo $data['user']['fid'] ?>"
                    method="POST" enctype="multipart/form-data" style="position: relative;">
                    <div>
                        <?php if (isset($data['user']['path'])): ?>
                        <img src="<?= $data['user']['path'] ?>" class="rounded-circle img-thumbnail"
                            style="width: 120px; height: 120px; object-fit: cover;">
                        <?php else: ?>
                        <img src="https://static.vecteezy.com/system/resources/previews/013/042/571/original/default-avatar-profile-icon-social-media-user-photo-in-flat-style-vector.jpg"
                            class="rounded-circle img-thumbnail"
                            style="width: 120px; height: 120px; object-fit: cover;">
                        <?php endif ?>
                        <div>
                            <input type="file" class="form-control mt-3" id="avatar" name="avatar" style="position: absolute;
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
                <?php
                $url = str_replace("%20", " ", $_SERVER['REQUEST_URI']);
                // nếu ký tự cuối của url là dấu / thì bỏ ký tự đó đi
                if (substr($url, -1) == '/') {
                    $url = substr($url, 0, -1);
                }
                $menuItems = [
                    [
                        "link" => $path . "user/account",
                        "icon" => "bi bi-person",
                        "text" => "Thông tin cá nhân"
                    ],
                    [
                        "link" => $path . "user/account/manageBooking",
                        "icon" => "bi bi-menu-button-wide",
                        "text" => "Quản lý đặt nhà hàng"
                    ],
                    [
                        "link" => $path . "user/account/changePassword",
                        "icon" => "bi bi-lock",
                        "text" => "Đổi mật khẩu"
                    ],
                    [
                        "link" => $path . "user/account/logout",
                        "icon" => "bi bi-box-arrow-right",
                        "text" => "Đăng xuất",
                        "class" => "text-danger"
                    ],
                ];
                ?>

                <!-- Hiển thị menu -->
                <?php foreach ($menuItems as $item): ?>
                <a href="<?= $item['link'] ?>" class="py-3 list-group-item list-group-item-action d-flex align-items-center 
       <?= isset($item['class']) ? $item['class'] : '' ?> 
       <?= ($url == $item['link']) ? 'active' : '' ?>">
                    <i class="<?= $item['icon'] ?> fs-5 me-3"></i>
                    <span><?= $item['text'] ?></span>
                </a>
                <?php endforeach; ?>


            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Toast -->
<div class="toast-container position-fixed bottom-0 start-0 p-3">
    <div id="uploadToast" class="toast border-0 shadow-lg bg-white" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="toast-body text-center">
            <p class="mb-3">Bạn có chắc muốn cập nhật ảnh đại diện?</p>
            <div class="d-flex justify-content-center gap-2">
                <button type="button" class="btn btn-success btn-sm px-4" id="confirmUpload">Đồng ý</button>
                <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="toast">Hủy</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const fileInput = document.getElementById('avatar');
    const form = document.getElementById('uploadForm');
    const toastEl = document.getElementById('uploadToast');
    const toast = new bootstrap.Toast(toastEl);
    const confirmButton = document.getElementById('confirmUpload');

    let fileSelected = false;

    // Khi chọn file, hiện Toast
    fileInput.addEventListener('change', function() {
        if (this.files && this.files.length > 0) {
            fileSelected = true;
            toast.show();
        }
    });

    // Khi nhấn "Đồng ý", submit form
    confirmButton.addEventListener('click', function() {
        if (fileSelected) {
            form.submit();
        }
    });
});
</script>