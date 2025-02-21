<?php 

class BookingController extends Controller {
    private $model_booking; private $booking; private $url;

    public function __construct() {
        $this->model_booking = $this->model('bookingModel');
        $this->booking = json_decode($this->model_booking->getAll());
        $this->url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
    }
    public function index() {
        $this->booking = json_decode($this->model_booking->getAll());
        $this->renderAdmin('layout', ['page' => 'tabs/booking/booking', 'bookings' => $this->booking]);
    }
    public function deleteData($data) {
        $this->renderAdmin('layout', ['page' => 'tabs/booking/delete', 'datar' => $data]);
    }
    public function updateData($data) {
        $this->renderAdmin('layout', ['page' => 'tabs/booking/update', 'result' => $data]);
    }
    public function details($bid = null) {
        if($bid == null) {
            header('Location:' . $this->url . 'admin/booking');
        }
        $data = json_decode($this->model_booking->getBookingById($bid));
        $this->renderAdmin('layout', ['page' => 'tabs/booking/details', 'booking' => $data]);
    }
    public function deleteBooking($bid = null) {
        if($bid == null) {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . 'admin/booking');
        }
        $this->deleteData($this->model_booking->deleteBooking($bid));
    }
    public function updateStatus($bid = null) {
        if($bid == null) {
            header('Location:' . $this->url . 'admin/booking');
        } 
        if(isset($_POST['confirmSubmit'])) {
            $this->updateData($this->model_booking->updateStatus($bid, 1));
        } else if(isset($_POST['cancelSubmit'])) {
            $this->updateData($this->model_booking->updateStatus($bid, 2));
        } else {
            header('Location:' . $this->url . 'admin/booking');
        }
    }
}
