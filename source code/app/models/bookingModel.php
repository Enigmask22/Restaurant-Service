<?php

class BookingModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $query = "SELECT bid, fullname, phone, status, restaurant_name
        FROM restaurant R JOIN booking B ON R.rid = B.r_id";
        $q = $this->db->select($query);
        $res = [];
        if ($q) {
            while ($row = mysqli_fetch_assoc($q)) {
                array_push($res, $row);
            }
            return json_encode($res, JSON_UNESCAPED_UNICODE);
        } else
            return false;
    }


    public function getBookingById($bid)
    {
        $query = "SELECT *
        FROM restaurant R JOIN booking B ON R.rid = B.r_id
        WHERE bid = $bid";
        $q = $this->db->select($query);
        if ($q) {
            $res = mysqli_fetch_assoc($q);
            return json_encode($res, JSON_UNESCAPED_UNICODE);
        } else
            return false;
    }
    public function getBookingsByRestaurant($rid, $startDate = null, $endDate = null)
    {
        $query = "SELECT b.*, r.restaurant_name 
                 FROM booking b 
                 JOIN restaurant r ON b.r_id = r.rid 
                 WHERE b.r_id = $rid";

        if ($startDate) {
            $query .= " AND DATE(b.createdAt) >= '$startDate'";
        }
        if ($endDate) {
            $query .= " AND DATE(b.createdAt) <= '$endDate'";
        }

        $query .= " ORDER BY b.createdAt DESC";

        $result = $this->db->select($query);
        $bookings = [];

        if ($result) {
            while ($row = mysqli_fetch_object($result)) {
                $bookings[] = $row;
            }
        }

        return $bookings;
    }

    public function deleteBooking($bid)
    {
        $query = "DELETE FROM booking WHERE bid = $bid";
        $res = $this->db->delete($query);
        if ($res)
            return true;
        else
            return false;
    }

    public function updateStatus($bid, $status)
    {
        $query = "UPDATE booking SET status = '$status' WHERE bid = $bid";
        $res = $this->db->update($query);
        if ($res)
            return $status;
        else
            return false;
    }

    public function getBookingByUid($uid)
    {
        $query = "SELECT distinct bid, fullname, email, R.address, phone, `money`,
        createdAt, date, status, restaurant_name
        FROM booking B join restaurant R ON B.r_id = R.rid
        WHERE u_id = $uid";
        $res = $this->db->select($query);
        return $res;
    }
    public function getBookingByBU($uid, $bid)
    {
        $query = "SELECT distinct B.bid, B.status, fullname, email, R.address, phone, money, adult_num, child_num,
        createdAt, date, status, restaurant_name
        FROM booking B join restaurant R ON B.r_id = R.rid
        WHERE B.u_id = $uid AND B.bid = $bid";
        $res = $this->db->select($query);
        return $res->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function insertBooking($data)
    {
        $adult_num = $data['adult_num'];
        $child_num = $data['child_num'];
        $date = $data['date'];
        $money = $data['money'];
        $fullname = $data['fullname'];
        $email = $data['email'];
        $address = $data['address'];
        $phone = $data['phone'];
        $u_id = $data['u_id'];
        $r_id = $data['r_id'];
        $createdAt = $data['createdAt'];
        $status = $data['status'];
        $payment_method = $data['payment_method'];

        if ($u_id) {
            $query = "INSERT INTO `booking` (
            `adult_num`,
            `child_num`,
            `date`,
            `money`,
            `fullname`,
            `address`,
            `phone`,
            `email`,
            `status`,
            `u_id`,
            `r_id`,
            `createdAt`,
            `payment_method`
            ) VALUES (
            $adult_num,
            $child_num,
            '$date',
            $money,
            '$fullname',
            '$address',
            '$phone',
            '$email',
            '$status',
            $u_id,
            $r_id,
            '$createdAt',
            '$payment_method'
            )";
        } else {
            $query = "INSERT INTO `booking` (
            `adult_num`,
            `child_num`,
            `date`,
            `money`,
            `fullname`,
            `address`,
            `phone`,
            `email`,
            `status`,
            `u_id`,
            `r_id`,
            `createdAt`,
            `payment_method`
            ) VALUES (
            $adult_num,
            $child_num,
            '$date',
            $money,
            '$fullname',
            '$address',
            '$phone',
            '$email',
            '$status',
            NULL,
            $r_id,
            '$createdAt',
            '$payment_method'
            )";
        }
        return $this->db->insert($query);
    }

    public function getRestaurantBookingStats()
    {
        $query = "SELECT 
            r.rid,
            r.restaurant_name,
            COUNT(b.bid) as total_bookings,
            SUM(CASE WHEN b.status = 1 THEN 1 ELSE 0 END) as confirmed_bookings
        FROM restaurant r
        LEFT JOIN booking b ON r.rid = b.r_id
        GROUP BY r.rid, r.restaurant_name
        ORDER BY total_bookings DESC";

        $result = $this->db->select($query);
        $stats = [];

        if ($result) {
            while ($row = mysqli_fetch_object($result)) {
                $stats[] = $row;
            }
        }

        return $stats;
    }

    public function getBookingStats($rid, $startDate = null, $endDate = null)
    {
        $query = "SELECT 
            COUNT(*) as total_bookings,
            SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as confirmed_bookings,
            SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as cancelled_bookings,
            SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as pending_bookings
        FROM booking 
        WHERE r_id = $rid";

        if ($startDate) {
            $query .= " AND DATE(createdAt) >= '$startDate'";
        }
        if ($endDate) {
            $query .= " AND DATE(createdAt) <= '$endDate'";
        }

        $result = $this->db->select($query);
        return mysqli_fetch_object($result);
    }
}