<?php

class BookingController extends Controller
{
    private $model_booking;
    private $booking;
    private $url;

    public function __construct()
    {
        $this->model_booking = $this->model('BookingModel');
        $this->booking = json_decode($this->model_booking->getAll());
        $this->url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
    }
    public function index()
    {
        // Lấy thông tin filter từ URL
        $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : null;

        // Validate dates
        if ($startDate && !$this->isValidDate($startDate)) {
            $startDate = null;
        }
        if ($endDate && !$this->isValidDate($endDate)) {
            $endDate = null;
        }

        $this->booking = $this->model_booking->getBookingsByRestaurant(
            $_SESSION['restaurant-id'],
            $startDate,
            $endDate
        );

        $this->renderRestaurant('layout', [
            'page' => 'tabs/booking/booking',
            'bookings' => $this->booking,
            'restaurant_id' => $_SESSION['restaurant-id']
        ]);
    }
    public function deleteData($data)
    {
        $this->renderRestaurant('layout', ['page' => 'tabs/booking/delete', 'datar' => $data]);
    }
    public function updateData($data)
    {
        $this->renderRestaurant('layout', ['page' => 'tabs/booking/update', 'result' => $data]);
    }
    public function details($bid = null)
    {
        if ($bid == null) {
            header('Location:' . $this->url . 'restaurant/booking');
        }
        $data = json_decode($this->model_booking->getBookingById($bid));
        $this->renderRestaurant('layout', ['page' => 'tabs/booking/details', 'booking' => $data]);
    }
    public function deleteBooking($bid = null)
    {
        if ($bid == null) {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . 'restaurant/booking');
        }
        $this->deleteData($this->model_booking->deleteBooking($bid));
    }
    public function updateStatus($bid = null)
    {
        if ($bid == null) {
            header('Location:' . $this->url . 'restaurant/booking');
        }
        $status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT);

        if ($status == 1) {
            $this->updateData($this->model_booking->updateStatus($bid, 1));
        } else if ($status == 2) {
            $this->updateData($this->model_booking->updateStatus($bid, 2));
        } else if ($status == 3) {
            $this->updateData($this->model_booking->updateStatus($bid, 3));
        } else {
            header('Location:' . $this->url . 'restaurant/booking');
        }
    }
    private function isValidDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
}