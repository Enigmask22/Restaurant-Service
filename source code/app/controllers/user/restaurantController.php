<?php
require_once __DIR__ . '/../../helpers/EmailHelper.php';
class RestaurantController extends Controller
{
    private $category;
    private $model_category;

    private $general;
    private $model_general;

    private $model_restaurant;
    private $model_comment;
    private $model_address;
    private $model_booking;
    private $model_image;

    public function __construct()
    {
        $this->model_category = $this->model('CategoryModel');
        $this->model_general = $this->model('GeneralModel');
        $this->model_restaurant = $this->model('RestaurantModel');
        $this->model_comment = $this->model('CommentModel');
        $this->model_address = $this->model('AddressModel');
        $this->model_booking = $this->model('BookingModel');
        $this->model_image = $this->model('ImageModel');

        $this->category = $this->model_category->getAll();
        $this->general = $this->model_general->getAll();
    }

    public function format_price($restaurant)
    {
        for ($i = 0; $i < count($restaurant); $i++) {
            $original_adult_price = $restaurant[$i]['original_adult_price'];
            $original_child_price = $restaurant[$i]['original_child_price'];

            if ($restaurant[$i]['discount'] > 0) {
                $restaurant[$i]['original_adult_price'] = number_format($original_adult_price, 0, ',', '.');
                $restaurant[$i]['original_child_price'] = number_format($original_child_price, 0, ',', '.');
                $restaurant[$i]['adult_price'] = number_format($original_adult_price * (100 - $restaurant[$i]['discount']) / 100, 0, ',', '.');
                $restaurant[$i]['child_price'] = number_format($original_child_price * (100 - $restaurant[$i]['discount']) / 100, 0, ',', '.');
            } else {
                $restaurant[$i]['adult_price'] = number_format($original_adult_price, 0, ',', '.');
                $restaurant[$i]['child_price'] = number_format($original_child_price, 0, ',', '.');
            }
        }
        return $restaurant;
    }
    private function format_price_single($restaurant)
    {
        $original_adult_price = $restaurant['original_adult_price'];
        $original_child_price = $restaurant['original_child_price'];

        if ($restaurant['discount'] > 0) {
            $restaurant['original_adult_price'] = number_format($original_adult_price, 0, ',', '.');
            $restaurant['original_child_price'] = number_format($original_child_price, 0, ',', '.');
            $restaurant['adult_price'] = number_format($original_adult_price * (100 - $restaurant['discount']) / 100, 0, ',', '.');
            $restaurant['child_price'] = number_format($original_child_price * (100 - $restaurant['discount']) / 100, 0, ',', '.');
        } else {
            $restaurant['adult_price'] = number_format($original_adult_price, 0, ',', '.');
            $restaurant['child_price'] = number_format($original_child_price, 0, ',', '.');
        }
        return $restaurant;
    }

    public function list_res($cateid = 0, $page = 1, $search = '')
    {
        $each_page = 6;

        // Xử lý từ khóa tìm kiếm từ GET
        if (isset($_GET['search'])) {
            $search = trim($_GET['search']); // Xóa khoảng trắng thừa
        }

        if ($cateid == -1) {
            // Tìm kiếm theo từ khóa
            $maxSearch = $this->model_restaurant->countBySearch($search); // Cần thêm hàm mới
            $category_name = 'Kết quả tìm kiếm: ' . htmlspecialchars($search);
        } else {
            $maxSearch = $this->model_restaurant->countById($cateid);
            if ($cateid == 0) {
                $category_name = 'Các kiểu nhà hàng';
            } else {
                $category_name = $this->model_category->getCategoryNameByID($cateid);
            }
        }

        $maxPage = ceil($maxSearch / $each_page);
        $start = ($page - 1) * $each_page;

        if ($cateid == -1) {
            $restaurant = $this->model_restaurant->searchRestaurants($search, $start, $each_page); // Cần thêm hàm mới
        } else {
            $restaurant = $this->model_restaurant->getAllCategory($cateid, $start, $each_page);
        }

        if ($restaurant) {
            $restaurant = $this->format_price($restaurant);
        }

        $this->renderUser('layout', [
            'page' => 'restaurant/list',
            'category' => $this->category,
            'category_name' => $category_name,
            'restaurant' => $restaurant,
            'maxPage' => $maxPage,
            'currentPage' => $page,
            'category_id' => $cateid,
            'search' => $search,
            'general' => $this->general
        ]);
    }

    public function checkEmail($email)
    {
        $require = "/(.{1}).*(@{1})(.{1}).*((\.){1})(.{1}).*/";
        if (preg_match($require, $email))
            return true;
        else
            return false;
    }

    public function checkPhone($phone)
    {
        if (ctype_digit($phone))
            return true;
        else
            return false;
    }

    public function restaurant_detail($rid)
    {
        $this->model_restaurant->updateViews($rid);
        $restaurant = $this->model_restaurant->getRestaurantById($rid);

        $category_name = $this->model_category->getCategoryNameByID($restaurant['cate_id']);

        $email = '';
        $fullname = '';
        $phone = '';
        $content = '';
        $error_email = '';
        $error_fullname = '';
        $error_phone = '';
        $error_content = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Email
            if (!isset($_POST['email']) || !$this->checkEmail($_POST['email'])) {
                $error_email = 'Email không hợp lệ';
            } else
                $email = $_POST['email'];

            // Fullname
            if (!isset($_POST['fullname']) || strlen($_POST['fullname']) < 1) {
                $error_fullname = 'Họ tên không hợp lệ';
            } else
                $fullname = $_POST['fullname'];

            // Phone
            if (!isset($_POST['phone']) || !$this->checkPhone($_POST['phone'])) {
                $error_phone = 'Số điện thoại không hợp lệ';
            } else
                $phone = $_POST['phone'];

            // Content
            if (!isset($_POST['content']) || strlen($_POST['content']) < 1) {
                $error_content = 'Nội dung không hợp lệ';
            } else
                $content = $_POST['content'];


            if ($email && $fullname && $phone && $content) {
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $time = date('Y-m-d H:i:s');

                $this->model_comment->insertComment([
                    'r_id' => $restaurant['rid'],
                    'name' => $fullname,
                    'phone' => $phone,
                    'email' => $email,
                    'cmt' => $content,
                    'time' => $time
                ]);
            }
        }

        $comment = $this->model_comment->getAllByResID($rid);
        $address = $this->model_address->getAddressByRID($rid);
        if ($restaurant)
            $restaurant = $this->format_price_single($restaurant);
        $img = $this->model_image->getImageByRID($rid);

        // Thêm code để lấy hình ảnh
        $imageModel = $this->model('ImageModel');
        $images = $imageModel->getImagesByRestaurantId($rid);

        $this->renderUser('layout', ['page' => 'restaurant/detail', 'category' => $this->category, 'restaurant' => $restaurant, 'address' => $address, 'comment' => $comment, 'email_error' => $error_email, 'fullname_error' => $error_fullname, 'phone_error' => $error_phone, 'content_error' => $error_content, 'category_name' => $category_name, 'imgs' => $img, 'images' => $images, 'general' => $this->general]);
    }

    public function list_price($page = 1)
    {
        $each_page = 5;
        $maxPage = $this->model_restaurant->countById();
        $max = ceil($maxPage / $each_page);

        $start = ($page - 1) * $each_page;

        $restaurant = $this->model_restaurant->getAllCategory(0, $start, $each_page);
        if ($restaurant)
            $restaurant = $this->format_price($restaurant);

        $this->renderUser('layout', ['page' => 'restaurant/price', 'category' => $this->category, 'restaurant' => $restaurant, 'maxPage' => $max, 'currentPage' => $page, 'general' => $this->general]);

    }
    public function booking($rid, $uid = null)
    {
        $pass = false;

        $restaurant = $this->model_restaurant->getRestaurantById($rid);
        // Format giá trước khi hiển thị
        $restaurant = $this->format_price_single($restaurant);

        $email = '';
        $fullname = '';
        $phone = '';
        $address = '';
        $error_email = '';
        $error_fullname = '';
        $error_phone = '';
        $error_address = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['email']) || !$this->checkEmail($_POST['email'])) {
                $error_email = 'Email không hợp lệ';
            } else
                $email = $_POST['email'];

            if (!isset($_POST['fullname']) || strlen($_POST['fullname']) < 1) {
                $error_fullname = 'Họ tên không hợp lệ';
            } else
                $fullname = $_POST['fullname'];

            if (!isset($_POST['phone']) || !$this->checkPhone($_POST['phone'])) {
                $error_phone = 'Số điện thoại không hợp lệ';
            } else
                $phone = $_POST['phone'];

            if (!isset($_POST['address']) || strlen($_POST['address']) < 1) {
                $error_address = 'Địa chỉ không hợp lệ';
            } else
                $address = $_POST['address'];

            if ($email && $fullname && $phone && $address) {
                $adult_num = $_POST['adult_count'];
                $child_num = $_POST['child_count'];
                $date = $_POST['depart_date'];
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $created_at = date('Y-m-d H:i:s');

                // Sử dụng giá đã giảm để tính tổng tiền
                $adult_price = $restaurant['discount'] > 0 ?
                    (float) str_replace('.', '', $restaurant['adult_price']) :
                    (float) $restaurant['adult_price'];
                $child_price = $restaurant['discount'] > 0 ?
                    (float) str_replace('.', '', $restaurant['child_price']) :
                    (float) $restaurant['child_price'];

                $total_price = $adult_num * $adult_price + $child_num * $child_price;

                $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : 'restaurant';
                $payment_code = isset($_POST['payment_code']) ? $_POST['payment_code'] : '';
                $status = ($payment_method === 'transfer' && !empty($payment_code)) ? 1 : 0;

                $this->model_booking->insertBooking([
                    "adult_num" => $adult_num,
                    "child_num" => $child_num,
                    "date" => $date,
                    "money" => $total_price,
                    "fullname" => $fullname,
                    "address" => $address,
                    "phone" => $phone,
                    "email" => $email,
                    "u_id" => $uid,
                    "r_id" => $rid,
                    "createdAt" => $created_at,
                    "status" => $status,
                    "payment_method" => $payment_method,
                ]);

                $emailHelper = new EmailHelper();
                $bookingData = [
                    'restaurant_name' => $restaurant['restaurant_name'],
                    'fullname' => $fullname,
                    'usr_mail' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'date' => $date,
                    'adult_num' => $adult_num,
                    'child_num' => $child_num,
                    'money' => $total_price,
                    'res_mail' => $restaurant['res_mail'],
                    'status' => $status,
                ];
                $emailHelper->sendBookingConfirmation($bookingData);

                $pass = true;
            }
        }

        $this->renderUser('layout', ['page' => 'restaurant/booking', 'category' => $this->category, 'restaurant' => $restaurant, 'email_error' => $error_email, 'fullname_error' => $error_fullname, 'phone_error' => $error_phone, 'address_error' => $error_address, 'general' => $this->general, 'isSuccess' => $pass]);
    }

    public function cancel_booking($bid)
    {
        $res = $this->model_booking->updateStatus($bid, 3);
        $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

        if (!$res) {
            $_SESSION['message'] = '<script>toastr.error("Có lỗi xảy ra khi hủy đơn hàng")</script>';
        } else {
            $_SESSION['message'] = '<script>toastr.success("Hủy đơn hàng thành công")</script>';
        }

        header('location:' . $url . 'user/account/manageBooking');
    }

    public function make_booking($rid)
    {
        $restaurant = $this->model_restaurant->getRestaurantById($rid);

        $email = '';
        $fullname = '';
        $phone = '';
        $address = '';
        $error_email = '';
        $error_fullname = '';
        $error_phone = '';
        $error_address = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['email']) || !$this->checkEmail($_POST['email'])) {
                $error_email = 'Email không hợp lệ';
            } else
                $email = $_POST['email'];

            if (!isset($_POST['fullname']) || strlen($_POST['fullname']) < 1) {
                $error_fullname = 'Họ tên không hợp lệ';
            } else
                $fullname = $_POST['fullname'];

            if (!isset($_POST['phone']) || !$this->checkPhone($_POST['phone'])) {
                $error_phone = 'Số điện thoại không hợp lệ';
            } else
                $phone = $_POST['phone'];

            if (!isset($_POST['address']) || strlen($_POST['address']) < 1) {
                $error_address = 'Địa chỉ không hợp lệ';
            } else
                $address = $_POST['address'];

            if ($email && $fullname && $phone && $address) {
                $adult_num = $_POST['adult_count'];
                $child_num = $_POST['child_count'];
                $date = $_POST['depart_date'];
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $created_at = date('Y-m-d H:i:s');
                $total_price = $adult_num * $restaurant['adult_price'] + $child_num * $restaurant['child_price'];

                $this->model_booking->insertBooking([
                    "adult_num" => $adult_num,
                    "child_num" => $child_num,
                    "date" => $date,
                    "money" => $total_price,
                    "fullname" => $fullname,
                    "address" => $address,
                    "phone" => $phone,
                    "email" => $email,
                    "u_id" => 1,
                    "r_id" => $rid,
                    "createdAt" => $created_at
                ]);
                $pass = true;
            }
        }

        $this->renderUser('layout', ['page' => 'restaurant/booking', 'category' => $this->category, 'restaurant' => $restaurant, 'email_error' => $error_email, 'fullname_error' => $error_fullname, 'phone_error' => $error_phone, 'address_error' => $error_address]);

    }
}