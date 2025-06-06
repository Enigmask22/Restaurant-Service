<?php

class AccountController extends Controller
{
    private $model_restaurant;

    public function __construct()
    {
        $this->model_restaurant = $this->model('RestaurantModel');
    }

    public function index()
    {
        if (isset($_SESSION['isRestaurant'])) {
            $rid = $_SESSION['restaurant-id'];
            $restaurant = $this->model_restaurant->getAllById($rid);
            $this->renderRestaurant('layout', [
                'page' => 'tabs/account/index',
                'restaurant' => $restaurant
            ]);
        } else {
            $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location: ' . $path . 'user/home/homepage');
        }
    }

    public function changePassword()
    {
        if (!isset($_SESSION['isRestaurant'])) {
            $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location: ' . $path . 'user/home/homepage');
            return;
        }

        $rid = $_SESSION['restaurant-id'];
        $restaurant = $this->model_restaurant->getAllById($rid);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old_password = isset($_POST['password']) ? trim($_POST['password']) : '';
            $new_password = isset($_POST['npassword']) ? trim($_POST['npassword']) : '';
            $confirm_password = isset($_POST['cpassword']) ? trim($_POST['cpassword']) : '';

            // Lấy thông tin nhà hàng
            $restaurant_data = $this->model_restaurant->getRestaurantById($rid);
            $current_password = $restaurant_data['password'];

            if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
                echo '<script type="text/javascript">toastr.error("Vui lòng điền đầy đủ các trường")</script>';
            } else if (!password_verify($old_password, $current_password)) {
                echo '<script type="text/javascript">toastr.error("Mật khẩu cũ không đúng")</script>';
            } else if ($new_password !== $confirm_password) {
                echo '<script type="text/javascript">toastr.error("Mật khẩu nhập lại không khớp")</script>';
            } else if (strlen($new_password) < 6 || !preg_match('/[A-Za-z]/', $new_password) || !preg_match('/\d/', $new_password)) {
                echo '<script type="text/javascript">toastr.error("Mật khẩu phải có ít nhất 6 ký tự, bao gồm chữ cái và số")</script>';
            } else {
                // Mã hóa mật khẩu mới
                $hash = password_hash($new_password, PASSWORD_DEFAULT);

                // Cập nhật mật khẩu
                $result = $this->model_restaurant->updatePassword($rid, $hash);

                if ($result) {
                    echo '<script type="text/javascript">toastr.success("Đổi mật khẩu thành công")</script>';
                } else {
                    echo '<script type="text/javascript">toastr.error("Có lỗi xảy ra khi cập nhật mật khẩu")</script>';
                }
            }
        }

        $this->renderRestaurant('layout', [
            'page' => 'tabs/account/changePassword',
            'restaurant' => $restaurant
        ]);
    }
}