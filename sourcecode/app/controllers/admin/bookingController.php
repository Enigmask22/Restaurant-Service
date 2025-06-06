<?php

class BookingController extends Controller
{
    private $model_booking;
    private $model_restaurant;
    private $booking;
    private $url;

    public function __construct()
    {
        $this->model_booking = $this->model('BookingModel');
        $this->model_restaurant = $this->model('RestaurantModel');
        $this->booking = json_decode($this->model_booking->getAll());
        $this->url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
    }

    public function index()
    {
        $restaurants = $this->model_booking->getRestaurantBookingStats();
        $this->renderAdmin('layout', [
            'page' => 'tabs/booking/restaurant_bookings',
            'restaurants' => $restaurants
        ]);
    }

    public function restaurant_detail($rid = null)
    {
        if ($rid == null) {
            header('Location: ' . $this->url . 'admin/booking');
            exit();
        }

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

        $restaurant = $this->model_restaurant->getRestaurantById($rid);
        $bookings = $this->model_booking->getBookingsByRestaurant($rid, $startDate, $endDate);
        $stats = $this->model_booking->getBookingStats($rid, $startDate, $endDate);

        $this->renderAdmin('layout', [
            'page' => 'tabs/booking/booking',
            'restaurant_name' => $restaurant['restaurant_name'],
            'restaurant_id' => $rid,
            'bookings' => $bookings,
            'stats' => $stats
        ]);
    }

    // Helper method để validate date
    private function isValidDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    public function deleteData($data)
    {
        $this->renderAdmin('layout', ['page' => 'tabs/booking/delete', 'datar' => $data]);
    }
    public function updateData($data)
    {
        $this->renderAdmin('layout', ['page' => 'tabs/booking/update', 'result' => $data]);
    }
    public function details($bid = null)
    {
        if ($bid == null) {
            header('Location:' . $this->url . 'admin/booking');
        }
        $data = json_decode($this->model_booking->getBookingById($bid));
        $this->renderAdmin('layout', ['page' => 'tabs/booking/details', 'booking' => $data]);
    }
    public function deleteBooking($bid = null)
    {
        if ($bid == null) {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header('Location:' . $url . 'admin/booking');
        }
        $this->deleteData($this->model_booking->deleteBooking($bid));
    }
    public function updateStatus($bid = null)
    {
        if ($bid == null) {
            header('Location:' . $this->url . 'admin/booking');
        }
        $status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT);

        if ($status == 1) {
            $this->updateData($this->model_booking->updateStatus($bid, 1));
        } else if ($status == 2) {
            $this->updateData($this->model_booking->updateStatus($bid, 2));
        } else if ($status == 3) {
            $this->updateData($this->model_booking->updateStatus($bid, 3));
        } else {
            header('Location:' . $this->url . 'admin/booking');
        }
    }
}