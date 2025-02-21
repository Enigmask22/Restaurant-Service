<?php 

class Controller {
    protected function renderAdmin($view, $data = []) {
        extract($data);
        require '../app/views/admin/' . $view . '.php';
    }
    protected function renderUser($view, $data = []) {
        extract($data);
        require '../app/views/user/' . $view . '.php';
    }
    protected function renderAuthen($view, $data = []) {
        extract($data);
        require '../app/views/authen/' . $view . '.php';
    }
    protected function model($model) {
        if(file_exists('../app/models/' . $model . '.php')) {
            require_once '../app/models/' . $model . '.php';
            if(class_exists($model)) {
                $model = new $model();
                return $model;
            }
        }
        return false;
    }
}
