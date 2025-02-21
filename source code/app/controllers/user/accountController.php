<?php 

class accountController extends Controller {
    // USER
    private $user;
    private $model_user;

    // BOOKING
    private $booking;
    private $model_booking;

    // CATEGORY
    private $category;
    private $model_category;

    // GENERAL
    private $general;
    private $model_general;

    public function __construct() {
        $this->model_user = $this->model('userModel');
        $this->model_booking = $this->model('bookingModel');
        $this->model_category = $this->model('categoryModel');
        $this->model_general = $this->model('generalModel');

        $this->category = $this->model_category->getAll();
        $this->general = $this->model_general->getAll();
    }

    public function index() {
        if(isset($_SESSION['user-id'])) {
            $uid = $_SESSION['user-id'];
        }
        $this->user = $this->model_user->getUserById($uid);

        $this->renderUser('layout', ['page' => 'account/index', 'user' => $this->user, 'category' => $this->category, 'general' => $this->general]);
    }
    public function manageBooking() {
        if(isset($_SESSION['user-id'])) {
            $uid = $_SESSION['user-id'];
        } 
        $this->booking = $this->model_booking->getBookingByUid($uid);
        $this->renderUser('layout', ['page' => 'account/manage', 'booking' => $this->booking, 'category' => $this->category, 'general' => $this->general]);
    }

    public function updateUser() {
        if(isset($_SESSION['user-id'])) {
            $uid = $_SESSION['user-id'];
        }
        $this->user = $this->model_user->getUserById($uid);
        $this->renderUser('layout', ['page' => 'account/update', 'user' => $this->user, 'category' => $this->category, 'general' => $this->general]);
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $this->model_user->updateUser($uid, $name, $phone, $address);

            echo '<script type="text/javascript">
                    toastr.success("Cập nhật thành công");
                    window.location.href = "' . $_SERVER['REQUEST_URI'] . '";
                  </script>';
            exit();
        }
    }
    public function logout() {
        if(isset($_SESSION['user-id'])) {
            unset($_SESSION['user-id']);
            unset($_SESSION['orderid']);
            session_unset();
        } else {
            echo '<script type="text/javascript">toastr.error("Có lỗi xảy ra khi đăng xuất")</script>';
        }

        setcookie('Cookieid', '-1', time() - 86400 * 30, '/');
        setcookie('PHPSESSID', '-1', time() - 86400 * 30, '/');
        $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        header("location:" . $url);
    }
    public function changePassword() {
        $this->renderUser('layout', ['page' => 'account/changePassword', 'category' => $this->category, 'general' => $this->general]);
        if(isset($_SESSION['user-id'])) $uid = $_SESSION['user-id'];
        $this->user = $this->model_user->getUserById($uid);
        $save_user = $this->user;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old_password = isset($_POST['password']) ? trim($_POST['password']) : '';
            $new_password = isset($_POST['npassword']) ? trim($_POST['npassword']) : '';
            $confirm_password = isset($_POST['cpassword']) ? trim($_POST['cpassword']) : '';

            $email = $save_user['email'];
            $present_password = $save_user['password'];

            if(empty($old_password) || empty($new_password) || empty($confirm_password)) {
                echo '<script type="text/javascript">toastr.error("Vui lòng điền đẩy đủ các trường")</script>';
            } else if (!password_verify($old_password, $present_password)) {
                echo '<script type="text/javascript">toastr.error("Mật khẩu cũ không đúng")</script>';
            } else if ($new_password !== $confirm_password) {
                echo '<script type="text/javascript">toastr.error("Mật khẩu nhập lại không khớp")</script>';
            } else if (strlen($new_password) < 6 || !preg_match('/[A-Za-z0-9]/', $new_password)) {
                echo '<script type="text/javascript">toastr.error("Mật khẩu phải có ít nhất 6 ký tự, bao gồm chữ cái và số")</script>';
            } else {
                $hash = password_hash($new_password, PASSWORD_DEFAULT);
                $this->model_user->updatePass($email, $hash);
                echo '<script type="text/javascript">toastr.success("Đổi mật khẩu thành công")</script>';
            }
        }
    }
    public function logic() {
        if(isset($_SESSION['user-id'])) {
            $uid = $_SESSION['user-id'];
        }
        // $bid = 1;
        if(isset($_POST['orderid'])) {
            $bid = $_POST['orderid'];
        } else echo "No orderid";
        $this->booking = $this->model_booking->getBookingByBU($uid, $bid);
        $this->booking['money'] = number_format($this->booking['money'],0,',','.');

        $this->renderUser('account/logic', ['page' => 'account/logic', 'category' => $this->category, 'general' => $this->general, 'booking' => $this->booking]);
        
        

    }
}