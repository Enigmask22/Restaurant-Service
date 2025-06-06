<?php

class RestaurantController extends Controller
{
    private $model_restaurant;
    private $model_category;

    public function __construct()
    {
        $this->model_restaurant = $this->model('restaurantModel');
        $this->model_category = $this->model('categoryModel');
    }

    public function index()
    {
        if (isset($_SESSION['isAdmin'])) {
            $this->renderAdmin('layout', ['page' => 'tabs/restaurant/restaurant', 'restaurant_data' => $this->model_restaurant->getAllRestaurant()]);
        } else {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . '/user/home/homepage');
        }
    }
    public function addRestaurant()
    {
        if (isset($_SESSION['isAdmin'])) {
            $this->renderAdmin('layout', ['page' => 'tabs/restaurant/addRestaurant', 'category' => $this->model_category->getAll()]);
        } else {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . '/user/home/homepage');
        }
    }

    public function restaurant_detail($rid)
    {
        if (isset($_SESSION['isAdmin'])) {
            $this->renderAdmin('layout', ['page' => 'tabs/restaurant/detailRestaurant', 'rid' => $rid, 'restaurant_data' => $this->model_restaurant->getAllById($rid)]);
        } else {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . '/user/home/homepage');
        }
    }

    public function deleteAddress($rid, $aid, $branch)
    {
        $this->model_restaurant->deleteAddress($aid, $branch);
        $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        header('Location:' . $url . "admin/restaurant/restaurant_detail/" . $rid);
    }
    public function changeRestaurant($rid)
    {
        if (isset($_POST['returnSubmit'])) {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . "admin/restaurant");
        } else {
            // Xử lý upload hình ảnh
            $image_url = $_POST['image']; // Giữ URL hiện tại làm mặc định

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
                                    // Cập nhật URL hình ảnh
                                    $image_url = $result['fileUrl'];
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

            $res_mail = $_POST['res_mail'];

            // Cập nhật thông tin nhà hàng với URL hình ảnh mới hoặc giữ nguyên URL cũ
            $result = $this->model_restaurant->updateRestaurant(
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
                $image_url,
                null,
                $_POST['discount'],
                $res_mail
            );
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . "admin/restaurant/restaurant_detail/" . $rid);
        }
    }

    public function addAddress()
    {
        if (isset($_POST['changeAddress'])) {
            $this->changeAddress($_POST['r_id'], $_POST['aid'], $_POST['branch'], $_POST['location'], $_POST['description']);
        } else {
            $this->model_restaurant->addAddress($_POST['location'], $_POST['description'], $_POST['branch'], $_POST['rid']);
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . "admin/restaurant/restaurant_detail/" . $_POST['rid']);
        }
    }
    public function changeAddress($rid, $aid, $branch, $location, $description)
    {
        $this->model_restaurant->updateAddress($location, $description, $branch, $aid, $rid);
        $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        header('Location:' . $url . "admin/restaurant/restaurant_detail/" . $rid);
    }

    public function delete_Restaurant($rid)
    {
        $check = $this->model_restaurant->deleteRestaurant($rid);
        $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        $this->renderAdmin('layout', ['page' => 'tabs/restaurant/delete', 'datar' => $check]);
    }
    public function add_Restaurant()
    {
        if (isset($_POST['restaurantSubmit'])) {
            // Xử lý upload hình ảnh
            $image_url = '';

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
                                    // Lấy URL hình ảnh để lưu vào avatar
                                    $image_url = $result['fileUrl'];
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

            // Thêm nhà hàng với URL hình ảnh đã upload
            $result = $this->model_restaurant->addRestaurant(
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
                $image_url,
                $_POST['cate_id'],
                null
            );

            // Thêm địa chỉ cho nhà hàng
            if ($result) {
                $rid = $this->model_restaurant->getLastInsertId();
                $this->model_restaurant->addAddress(
                    $_POST['location'],
                    $_POST['location_description'],
                    $_POST['address'],
                    $rid
                );
            }

            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . "admin/restaurant");
        } else {
            $category = $this->model_category->getAll();
            $this->renderAdmin('layout', [
                'page' => 'restaurant/addRestaurant',
                'category' => $category
            ]);
        }
    }
}