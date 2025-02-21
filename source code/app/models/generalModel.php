<?php 

class GeneralModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getGeneral() {
        $query = "SELECT * FROM general LIMIT 1";
        $res = $this->db->select($query);
        if($res) {
            return json_encode($res->fetch_assoc(), JSON_UNESCAPED_UNICODE);
        } else return $res;
    }

    public function updateGeneral($address, $phone, $hotline, $email, $fullname, $bankID, $bank_name) {
        $query = "UPDATE general SET address = '$address', phone = '$phone', hotline = '$hotline', email = '$email', fullname = '$fullname', bankID = '$bankID', bank_name = '$bank_name'
        WHERE true LIMIT 1";
        $res = $this->db->update($query);
        if($res) return true;
        else return false;
    }
    public function getAll() {
        $query = "SELECT * FROM general";
        $res = $this->db->select($query);
        if($res) return $res->fetch_all(MYSQLI_ASSOC)[0];
        else return $res;
    }
}
