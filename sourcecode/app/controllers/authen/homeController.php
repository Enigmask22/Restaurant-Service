<?php

class HomeController extends Controller
{
    private $model_user;
    private $model_restaurant;
    private $googleOAuth;

    public function __construct()
    {
        require_once '../app/helpers/GoogleOAuthHelper.php';
        $this->model_user = $this->model('UserModel');
        $this->model_restaurant = $this->model('RestaurantModel');
        $this->googleOAuth = new GoogleOAuthHelper();
    }

    public function signup()
    {
        $this->renderAuthen('signup', ['page' => 'login']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            $err = [];
            if (empty($username) || strlen($username) < 6) {
                $err = "Username phải có ít nhất 6 ký tự";
            } else if (empty($password) || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
                $err = "Password phải có ít nhất 1 chữ cái và 1 số";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $err = "Email không hợp lệ";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $data = $this->model_user->existUser($email);
                if ($data->num_rows > 0) {
                    $err = "Email đã tồn tại";
                } else {
                    $err = "";
                }
            }

            if (!$err) {
                $this->model_user->signUser($email, $username, $hash, 'U');
                echo '<script type="text/javascript">toastr.success("Đăng ký thành công")</script>';
            } else {
                echo '<script type="text/javascript">toastr.error("' . htmlspecialchars($err, ENT_QUOTES, 'UTF-8') . '")</script>';
            }
        }
    }
    public function login()
    {
        error_reporting(0);
        $this->renderAuthen('login', ['page' => 'login']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $acc = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $err = "";

            if (strlen($acc) < 6 || !$acc) {
                $err = "Tên đăng nhập phải có ít nhất 6 ký tự";
            } else if (strlen($password) < 6 || !$password) {
                $err = "Password phải có ít nhất 6 ký tự";
            } else {
                $restaurant_data = $this->model_restaurant->getRestaurantByEmail($acc);
                if ($restaurant_data && password_verify($password, $restaurant_data['password'])) {
                    $_SESSION['restaurant-id'] = $restaurant_data['rid'];
                    $_SESSION['isRestaurant'] = true;
                    $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
                    header('Location: ' . $path . 'restaurant/home/restaurant_detail');
                    return;
                }
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $data = $this->model_user->existUser($acc);
                $data1 = $this->model_user->existUserName($acc);
                if ($data->num_rows > 0 || $data1->num_rows > 0) {
                    if ($data->num_rows > 0) {
                        $user_data = $data->fetch_assoc();
                        $hash = $user_data["password"];
                    } else {
                        $user_data = $data1->fetch_assoc();
                        $hash = $user_data["password"];
                    }

                    setcookie('Cookieid', $user_data['uid'], time() + 86400 * 30, "/");

                    if (password_verify($password, $hash)) {
                        $_SESSION['user-id'] = $user_data['uid'];
                        if ($user_data['role'] == 'A') {
                            $_SESSION['isAdmin'] = true;
                            $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
                            header('Location: ' . $path . 'admin/user');
                            return;
                        }
                    } else {
                        $err = "Mật khẩu không đúng";
                    }
                } else {
                    $err = "Tài khoản không tồn tại";
                }
            }
            if ($err) {
                echo '<script type="text/javascript">toastr.error("' . htmlspecialchars($err, ENT_QUOTES, 'UTF-8') . '")</script>';
                $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            } else {
                $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
                header('Location: ' . $path . 'user/home/homepage');
            }
        }
    }

    /**
     * Chuyển hướng đến Google OAuth
     */
    public function google_login()
    {
        try {
            $authUrl = $this->googleOAuth->getAuthUrl();
            header('Location: ' . $authUrl);
            exit();
        } catch (Exception $e) {
            error_log('Google OAuth Error: ' . $e->getMessage());
            $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location: ' . $path . 'authen/home/login?error=oauth_failed');
            exit();
        }
    }

    /**
     * Xử lý callback từ Google OAuth
     */
    public function google_callback()
    {
        try {
            // Kiểm tra có authorization code không
            if (!isset($_GET['code'])) {
                throw new Exception('Authorization code not found');
            }

            $code = $_GET['code'];
            $state = $_GET['state'] ?? null;

            // Lấy thông tin user từ Google
            $googleUserData = $this->googleOAuth->handleCallback($code, $state);

            // Tạo hoặc cập nhật user trong database
            $userId = $this->model_user->createOrUpdateGoogleUser($googleUserData);

            if (!$userId) {
                throw new Exception('Failed to create or update user');
            }

            // Đăng nhập user vào hệ thống
            $_SESSION['user-id'] = $userId;
            setcookie('Cookieid', $userId, time() + 86400 * 30, "/");

            // Kiểm tra role để chuyển hướng
            $userData = $this->model_user->getUserById($userId);
            $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

            if ($userData['role'] == 'A') {
                $_SESSION['isAdmin'] = true;
                header('Location: ' . $path . 'admin/user');
            } else {
                header('Location: ' . $path . 'user/home/homepage');
            }
            exit();
        } catch (Exception $e) {
            error_log('Google OAuth Callback Error: ' . $e->getMessage());
            $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

            // Tạo thông báo lỗi cho user
            $_SESSION['login_error'] = 'Đăng nhập Google thất bại. Vui lòng thử lại.';
            header('Location: ' . $path . 'authen/home/login');
            exit();
        }
    }
}