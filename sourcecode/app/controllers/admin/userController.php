<?php

class UserController extends Controller {
    private $model_user; private $user; private $url;

    public function __construct() {
        $this->model_user = $this->model('userModel');
        $this->url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        $this->user = json_decode($this->model_user->getAll());
    }

    public function index() {
        if(isset($_SESSION['isAdmin'])) {
            $this->renderAdmin('layout', ['page' => 'tabs/user/user', 'user' => $this->user]);
        } else {
            // $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $this->url . '/user/home/homepage');
        }
    }
    public function viewData($data) {
        $this->user = json_decode($this->model_user->getAll());
        if(isset($_SESSION['isAdmin'])) {
            var_dump($data);
            $this->renderAdmin('layout', ['page' => 'tabs/user/data', 'datar' => $data]);
        } else {
            // $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $this->url . '/user/home/homepage');
        }
    }
    public function deleteUser($uid = null) {
        if(isset($_SESSION['isAdmin'])) {
            if($uid == null) {
                header("Location:" . $this->url . 'admin/user/');
            } 
            $this->viewData($this->model_user->deleteUser($uid));
        } else {
            // $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' .$this->url . '/user/home/homepage');
        }
    }
}