<?php
class CategoryController extends Controller
{
    private $model_category;
    private $category;
    private $url;

    public function __construct()
    {
        $this->model_category = $this->model('CategoryModel');
        $this->category = $this->model_category->getCategoryInfo();
        $this->url = str_replace('index.php', '', $_SERVER['PHP_SELF']);
    }

    public function index()
    {
        $this->category = json_decode($this->model_category->getCategoryInfo());
        $this->renderAdmin('layout', ['page' => 'tabs/categories/categories', 'categories' => $this->category]);
    }
    public function deleteData($data)
    {
        $this->renderAdmin('layout', ['page' => 'tabs/categories/delete', 'result' => $data]);
    }
    public function updateData($data)
    {
        $this->renderAdmin('layout', ['page' => 'tabs/categories/update', 'result' => $data]);
    }
    public function addCategory()
    {
        if (isset($_POST['addSubmit'])) {
            // Xử lý upload hình ảnh
            $image_url = '';

            if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['category_image'];

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
                            $result = $awsService->uploadFile($file, 'category-images');

                            if ($result) {
                                $file['path'] = $result['fileUrl'];
                                $file['file_key'] = $result['fileKey'];

                                // Lưu thông tin file vào bảng file
                                $FileModel = $this->model('FileModel');
                                $fileResult = $FileModel->createOne($file);

                                if ($fileResult) {
                                    // Lấy URL hình ảnh để lưu vào category_img
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

            // Thêm danh mục với URL hình ảnh đã upload
            $result = $this->model_category->addCategory($_POST['category_name'], $image_url);

            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . "admin/category?addStatus=" . ($result ? 'success' : 'fail'));
        } else {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . "admin/category");
        }
    }
    public function deleteCategory($cateid = null)
    {
        if ($cateid == null) {
            header('Location:' . $this->url . 'admin/category');
        }
        $data = $this->model_category->deleteCategory($cateid);
        $this->deleteData($data);
    }
    public function changeCategory($cateid = null)
    {
        if ($cateid == null) {
            header('Location:' . $this->url . 'admin/categories');
        }
        $data = $this->model_category->getCategoryInfoByID($cateid);
        $this->renderAdmin('layout', ['page' => 'tabs/categories/editCategory', 'category' => $data]);
    }
    public function updateCategory($cateid = null)
    {
        if (isset($_POST['editSubmit'])) {
            // Xử lý upload hình ảnh
            $image_url = $_POST['category_img']; // Giữ URL hiện tại làm mặc định

            if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['category_image'];

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
                            $result = $awsService->uploadFile($file, 'category-images');

                            if ($result) {
                                $file['path'] = $result['fileUrl'];
                                $file['file_key'] = $result['fileKey'];

                                // Lưu thông tin file vào bảng file
                                $FileModel = $this->model('FileModel');
                                $fileResult = $FileModel->createOne($file);

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

            // Cập nhật danh mục với URL hình ảnh mới hoặc giữ nguyên URL cũ
            $this->model_category->updateCategory($cateid, $_POST['category_name'], $image_url);

            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . "admin/category");
        } else {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . "admin/category");
        }
    }
}