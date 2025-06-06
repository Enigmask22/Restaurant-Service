<?php

class ResimgController extends Controller
{
    private $model_restaurant;
    private $model_image;
    private $model_file;

    public function __construct()
    {
        $this->model_restaurant = $this->model('RestaurantModel');
        $this->model_image = $this->model('ImageModel');
        $this->model_file = $this->model('FileModel');
    }

    public function index()
    {
        if (isset($_SESSION['isRestaurant'])) {
            $rid = $_SESSION['restaurant-id'];
            $restaurant = $this->model_restaurant->getAllById($rid);
            $images = $this->model_image->getImagesByRestaurantId($rid);
            $this->renderRestaurant('layout', [
                'page' => 'tabs/resimg/index',
                'restaurant_data' => $restaurant,
                'images' => $images
            ]);
        } else {
            $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location: ' . $path . 'user/home/homepage');
        }
    }

    public function add_image()
    {
        if (!isset($_SESSION['isRestaurant'])) {
            $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location: ' . $path . 'user/home/homepage');
            return;
        }

        $rid = $_SESSION['restaurant-id'];
        $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['restaurant_image'])) {
            $file = $_FILES['restaurant_image'];

            // Kiểm tra lỗi upload
            if ($file['error'] !== UPLOAD_ERR_OK) {
                echo '<script type="text/javascript">
                        toastr.error("Có lỗi xảy ra khi tải lên file");
                        setTimeout(function() {
                            window.location.href = "' . $path . 'restaurant/resimg";
                        }, 2000);
                    </script>';
                return;
            }

            // Kiểm tra loại file
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($file['type'], $allowed_types)) {
                echo '<script type="text/javascript">
                        toastr.error("Chỉ chấp nhận file hình ảnh (JPEG, PNG, GIF, WEBP)");
                        setTimeout(function() {
                            window.location.href = "' . $path . 'restaurant/resimg";
                        }, 2000);
                    </script>';
                return;
            }

            // Kiểm tra kích thước file (giới hạn 5MB)
            if ($file['size'] > 5 * 1024 * 1024) {
                echo '<script type="text/javascript">
                        toastr.error("Kích thước file không được vượt quá 5MB");
                        setTimeout(function() {
                            window.location.href = "' . $path . 'restaurant/resimg";
                        }, 2000);
                    </script>';
                return;
            }

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
                    $fileResult = $this->model_file->createOne($file);

                    if ($fileResult) {
                        // Lưu thông tin vào bảng restaurant_image
                        $imageResult = $this->model_image->addImage($rid, $fileResult['fid']);

                        $images = $this->model_image->getImagesByRestaurantId($rid);
                        $this->renderRestaurant('layout', [
                            'page' => 'tabs/resimg/index',
                            'images' => $images
                        ]);
                    }
                }

                echo '<script type="text/javascript">
                        toastr.error("Có lỗi xảy ra khi lưu thông tin hình ảnh");
                        setTimeout(function() {
                            window.location.href = "' . $path . 'restaurant/resimg";
                        }, 2000);
                    </script>';

            } catch (Exception $e) {
                echo '<script type="text/javascript">
                        toastr.error("' . $e->getMessage() . '");
                        setTimeout(function() {
                            window.location.href = "' . $path . 'restaurant/resimg";
                        }, 2000);
                    </script>';
            }
        } else {
            // Hiển thị form thêm hình ảnh
            $this->renderRestaurant('layout', [
                'page' => 'tabs/resimg/add'
            ]);
        }
    }

    public function delete_image($imageid)
    {
        if (!isset($_SESSION['isRestaurant'])) {
            $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location: ' . $path . 'user/home/homepage');
            return;
        }

        $rid = $_SESSION['restaurant-id'];
        $path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

        // Xác minh hình ảnh thuộc về nhà hàng này
        $image = $this->model_image->getImageById($imageid);

        if ($image && $image['r_id'] == $rid) {
            $result = $this->model_image->deleteImage($imageid);
            $images = $this->model_image->getImagesByRestaurantId($rid);

            if ($result) {
                // Chuyển hướng về trang quản lý hình ảnh
                header('Location: ' . $path . 'restaurant/resimg');
            } else {
                // Xử lý lỗi
                echo '<script type="text/javascript">
                        toastr.error("Có lỗi xảy ra khi xóa hình ảnh");
                        setTimeout(function() {
                            window.location.href = "' . $path . 'restaurant/resimg";
                        }, 2000);
                      </script>';
            }
        } else {
            // Hình ảnh không thuộc về nhà hàng này hoặc không tồn tại
            header('Location: ' . $path . 'restaurant/resimg');
        }
    }
}