<?php 

class GeneralController extends Controller {
    private $model_general; private $general;

    public function __construct() {
        $this->model_general = $this->model('GeneralModel');
        $this->general = json_decode($this->model_general->getGeneral());
    }

    public function index() {
        $this->renderAdmin('layout', ['page' => 'tabs/contact/contact', 'contact' => $this->general]);
    }
    public function viewData($data) {
        $this->renderAdmin('layout', ['page' => 'tabs/contact/data', 'result' => $data]);
    }
    public function getContact() {
        $this->general = json_decode($this->general);
        print_r($this->general);
    }
    public function updateContact() {
        if(isset($_POST["contactSubmit"])) {
            $address = $_POST["address"];
            $phone = $_POST["phone"];
            $hotline = $_POST["hotline"];
            $email = $_POST["email"];
            $fullname = $_POST["fullname"];
            $bankID = $_POST["bankID"];
            $bank_name = $_POST["bank_name"];

            $data = $this->model_general->updateGeneral($address, $phone, $hotline, $email, $fullname, $bankID, $bank_name);
            $this->viewData($data);
        }
    }
}