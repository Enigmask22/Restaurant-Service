<?php 
class CustomerController extends Controller {
    private $model_contact;
    public function __construct() {
        $this->model_contact = $this->model('contactModel');
    }

    public function index() {
        $this->renderAdmin('layout', ['page' => 'tabs/customer/customer', 'customer' => $this->model_contact->getAll()]);
    }
}