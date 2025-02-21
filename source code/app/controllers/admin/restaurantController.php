<?php 

class RestaurantController extends Controller {
    private $model_restaurant; private $model_category;

    public function __construct() {
        $this->model_restaurant = $this->model('restaurantModel');
        $this->model_category = $this->model('categoryModel');
    }

    public function index() {
        if(isset($_SESSION['isAdmin'])) {
            $this->renderAdmin('layout', ['page' => 'tabs/restaurant/restaurant', 'restaurant_data' => $this->model_restaurant->getAllRestaurant()]);
        } else {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . '/user/home/homepage');
        }
    }
    public function addRestaurant() {
        if(isset($_SESSION['isAdmin'])) {
            $this->renderAdmin('layout', ['page' => 'tabs/restaurant/addRestaurant', 'category' => $this->model_category->getAll()]);
        } else {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . '/user/home/homepage');
        }
    }

    public function restaurant_detail($rid) {
        if(isset($_SESSION['isAdmin'])) {
            $this->renderAdmin('layout', ['page' => 'tabs/restaurant/detailRestaurant', 'rid' => $rid, 'restaurant_data' => $this->model_restaurant->getAllById($rid)]);
        } else {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . '/user/home/homepage');
        }
    }

    public function deleteAddress($rid, $aid, $branch) {
        $this->model_restaurant->deleteAddress($aid, $branch);
        $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        header('Location:' . $url . "admin/restaurant/restaurant_detail/" . $rid);
    }
    public function changeRestaurant($rid) {
        if(isset($_POST['returnSubmit'])) {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . "admin/restaurant");
        }
        else {
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
                (int)$_POST['res_rate'],
                $_POST['image'],
                null
            );
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . "admin/restaurant/restaurant_detail/" . $rid);
        }
    }

    public function addAddress() {
        if(isset($_POST['changeAddress'])) {
            $this->changeAddress($_POST['r_id'], $_POST['aid'], $_POST['branch'], $_POST['location'], $_POST['description']);
        } else {
            $this->model_restaurant->addAddress($_POST['location'], $_POST['description'], $_POST['branch'], $_POST['rid']);
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . "admin/restaurant/restaurant_detail/" . $_POST['rid']);
        }
    }
    public function changeAddress($rid, $aid, $branch, $location, $description) {
        $this->model_restaurant->updateAddress($location, $description, $branch, $aid, $rid);
        $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        header('Location:' . $url . "admin/restaurant/restaurant_detail/" . $rid);
    }

    public function delete_Restaurant($rid) {
        $check = $this->model_restaurant->deleteRestaurant($rid);
        $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        $this->renderAdmin('layout', ['page' => 'tabs/restaurant/delete', 'datar' => $check]);
    }
    public function add_Restaurant() {
        if(isset($_POST['returnSubmit'])) {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . 'admin/restaurant');
        } else {
            $this->model_restaurant->addRestaurant($_POST);
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . 'admin/restaurant');
        }
    }
}