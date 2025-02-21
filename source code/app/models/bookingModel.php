<?php 

class BookingModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $query = "SELECT bid, fullname, phone, status, restaurant_name
        FROM restaurant R JOIN booking B ON R.rid = B.r_id";
        $q = $this->db->select($query);
        $res = [];
        if ($q) {
            while($row = mysqli_fetch_assoc($q)) {
                array_push($res, $row);
            }
            return json_encode($res, JSON_UNESCAPED_UNICODE);
        }
        else return false;
    }

    public function getBookingById($bid) {
        $query = "SELECT *
        FROM restaurant R JOIN booking B ON R.rid = B.r_id
        WHERE bid = $bid";
        $q = $this->db->select($query);
        if($q) {
            $res = mysqli_fetch_assoc($q);
            return json_encode($res, JSON_UNESCAPED_UNICODE);
        }
        else return false;
    }

    public function deleteBooking($bid) {
        $query = "DELETE FROM booking WHERE bid = $bid";
        $res = $this->db->delete($query);
        if($res) return true;
        else return false;
    }

    public function updateStatus($bid, $status) {
        $query = "UPDATE booking SET status = '$status' WHERE bid = $bid";
        $res = $this->db->update($query);
        if($res) return $status;
        else return false;
    }

    public function getBookingByUid($uid) {
        $query = "SELECT distinct bid, fullname, email, R.address, phone, `money`,
        createdAt, date, status, restaurant_name
        FROM booking B join restaurant R ON B.r_id = R.rid
        WHERE u_id = $uid";
        $res = $this->db->select($query);
        return $res;
    }
    public function getBookingByBU($uid, $bid) {
        $query = "SELECT distinct fullname, email, R.address, phone, money, adult_num, child_num,
        createdAt, date, status, restaurant_name
        FROM booking B join restaurant R ON B.r_id = R.rid
        WHERE B.u_id = $uid AND B.bid = $bid";
        $res = $this->db->select($query);
        return $res->fetch_all(MYSQLI_ASSOC)[0];
    }
    
    public function insertBooking($data) {
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

        if($u_id) {
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
            `createdAt`
            ) VALUES (
            $adult_num,
            $child_num,
            '$date',
            $money,
            '$fullname',
            '$address',
            '$phone',
            '$email',
            '0',
            $u_id,
            $r_id,
            '$createdAt'
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
            `createdAt`
            ) VALUES (
            $adult_num,
            $child_num,
            '$date',
            $money,
            '$fullname',
            '$address',
            '$phone',
            '$email',
            '0',
            NULL,
            $r_id,
            '$createdAt'
            )";
        }
        return $this->db->insert($query);
    }
}