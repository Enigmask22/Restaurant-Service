<?php 
class CategoryController extends Controller {
    private $model_category; private $category; private $url;

    public function __construct() {
        $this->model_category = $this->model('categoryModel');
        $this->category = $this->model_category->getCategoryInfo();
        $this->url = str_replace('index.php', '', $_SERVER['PHP_SELF']);
    }

    public function index() {
        $this->category = json_decode($this->model_category->getCategoryInfo());
        $this->renderAdmin('layout', ['page' => 'tabs/categories/categories', 'categories' => $this->category]);
    }
    public function deleteData($data) {
        $this->renderAdmin('layout', ['page' => 'tabs/categories/delete', 'result' => $data]);
    }
    public function updateData($data) {
        $this->renderAdmin('layout', ['page' => 'tabs/categories/update', 'result' => $data]);
    }
    public function addCategory() {
        if(isset($_POST['addSubmit'])) {
            $category_name = $_POST['category_name'];
            $category_img = $_POST['category_img'];

            $data = $this->model_category->addCategory($category_name, $category_img);
            header('Location:'. $this->url . 'admin/category');
        }
    }
    public function deleteCategory($cateid = null) {
        if($cateid == null) {
            header('Location:' . $this->url . 'admin/category');
        }
        $data = $this->model_category->deleteCategory($cateid);
        $this->deleteData($data);
    }
    public function changeCategory($cateid = null) {
        if($cateid == null) {
            header('Location:' . $this->url . 'admin/categories');
        }
        $data = $this->model_category->getCategoryInfoByID($cateid);
        $this->renderAdmin('layout', ['page' => 'tabs/categories/editCategory', 'category' => $data]);
    }
    public function updateCategory($cateid = null) {
        if($cateid == null) {
            echo "<pre>";
            header('Location:' . $this->url . 'admin/categories');
        }
        if(isset($_POST['editSubmit'])) {
            
            $category_name = $_POST["category_name"];
            $category_img = $_POST["category_img"];
            $data = $this->model_category->updateCategory($cateid, $category_name, $category_img);
            $this->updateData($data);
        }
    }
}
