<?php

class HomeController extends Controller
{
    private $model_restaurant;
    private $model_booking;
    private $restaurant;

    public function __construct()
    {
        $this->model_restaurant = $this->model('RestaurantModel');
        $this->model_booking = $this->model('BookingModel');
    }

    public function index()
    {
        if (isset($_SESSION['isRestaurant'])) {
            $rid = $_SESSION['restaurant-id'];
            $this->restaurant = $this->model_restaurant->getAllById($rid);
            $this->renderRestaurant('layout', [
                'page' => 'home/index',
                'restaurant' => $this->restaurant
            ]);
        } else {
            $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location: ' . $path . 'user/home/homepage');
        }
    }

    public function restaurant_detail()
    {
        if (isset($_SESSION['isRestaurant'])) {
            $rid = $_SESSION['restaurant-id'];
            $this->restaurant = $this->model_restaurant->getAllById($rid);
            $this->renderRestaurant('layout', [
                'page' => 'tabs/restaurant/detailRestaurant',
                'restaurant_data' => $this->restaurant,
                'rid' => $rid
            ]);
        } else {
            $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location: ' . $path . 'user/home/homepage');
        }
    }

    public function update_restaurant($rid)
    {
        if (isset($_POST['returnSubmit'])) {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . "restaurant/home/restaurant_detail");
        } else {
            // Xử lý các trường dữ liệu khác...

            // Xử lý upload hình ảnh
            if (isset($_FILES['restaurant_image']) && $_FILES['restaurant_image']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['restaurant_image'];

                // Kiểm tra loại file
                $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (in_array($file['type'], $allowed_types)) {
                    // Kiểm tra kích thước file (giới hạn 5MB)
                    if ($file['size'] <= 5 * 1024 * 1024) {
                        try {
                            // Upload file lên AWS S3
                            require_once '../app/core/aws.php';
                            $awsService = new AwsS3Service();
                            $fileName = $file['name'];
                            $file['file_extension'] = pathinfo($fileName, PATHINFO_EXTENSION);
                            $result = $awsService->uploadFile($file, 'restaurant-images');

                            if ($result) {
                                $file['path'] = $result['fileUrl'];
                                $file['file_key'] = $result['fileKey'];

                                // Lưu thông tin file vào bảng file
                                $fileModel = $this->model('FileModel');
                                $fileResult = $fileModel->createOne($file);

                                if ($fileResult) {
                                    // Cập nhật avatar của nhà hàng
                                    $_POST['image'] = $result['fileUrl'];
                                }
                            }
                        } catch (Exception $e) {
                            // Xử lý lỗi
                            echo '<script>alert("Lỗi khi upload hình ảnh: ' . $e->getMessage() . '");</script>';
                        }
                    } else {
                        echo '<script>alert("Kích thước file không được vượt quá 5MB");</script>';
                    }
                } else {
                    echo '<script>alert("Chỉ chấp nhận file hình ảnh (JPEG, PNG, GIF, WEBP)");</script>';
                }
            }

            // Tiếp tục xử lý cập nhật thông tin nhà hàng với $_POST['image']
            $this->model_restaurant->updateRestaurant(
                $rid,
                $_POST['restaurant_name'],
                $_POST['adult_price'],
                $_POST['child_price'],
                $_POST['address'],
                $_POST['open_time'],
                $_POST['description'],
                $_POST['res_include'],
                $_POST['res_exclude'],
                $_POST['res_condition'],
                (int) $_POST['res_rate'],
                $_POST['image'],
                null,
                $_POST['discount']
            );
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . "restaurant/home/restaurant_detail/" . $rid);
        }
    }


    public function update_booking_status($bid, $status)
    {
        if (isset($_SESSION['isRestaurant'])) {
            $rid = $_SESSION['restaurant-id'];

            // Verify that this booking belongs to this restaurant
            $booking = $this->model_booking->getBookingById($bid);
            if ($booking && $booking['r_id'] == $rid) {
                $result = $this->model_booking->updateBookingStatus($bid, $status);
                if ($result) {
                    echo '<script type="text/javascript">toastr.success("Cập nhật trạng thái đặt bàn thành công")</script>';
                } else {
                    echo '<script type="text/javascript">toastr.error("Có lỗi xảy ra khi cập nhật trạng thái")</script>';
                }
            }

            $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location: ' . $path . 'restaurant/home/bookings');
        }
    }
    public function addAddress()
    {
        if (isset($_POST['changeAddress'])) {
            $this->changeAddress($_POST['r_id'], $_POST['aid'], $_POST['branch'], $_POST['location'], $_POST['description']);
        } else {
            $this->model_restaurant->addAddress($_POST['location'], $_POST['description'], $_POST['branch'], $_POST['rid']);
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . "restaurant/home/restaurant_detail/" . $_POST['rid']);
        }
    }
    public function changeAddress($rid, $aid, $branch, $location, $description)
    {
        $this->model_restaurant->updateAddress($location, $description, $branch, $aid, $rid);
        $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        header('Location:' . $url . "restaurant/home/restaurant_detail/" . $rid);
    }
    public function deleteAddress($rid, $aid, $branch)
    {
        $this->model_restaurant->deleteAddress($aid, $branch);
        $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        header('Location:' . $url . "restaurant/home/restaurant_detail/" . $rid);
    }
    public function logout()
    {
        if (isset($_SESSION['restaurant-id'])) {
            unset($_SESSION['restaurant-id']);
            unset($_SESSION['isRestaurant']);
            session_unset();
        }
        $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        header('Location: ' . $path);
    }
}