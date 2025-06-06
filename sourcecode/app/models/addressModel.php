<?php 

class AddressModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAddressByRID($rid) {
        $query = "SELECT * FROM restaurant_address WHERE r_id = $rid ORDER BY branch ASC";
        $res = $this->db->select($query);
        if($res) {
            return $res->fetch_all(MYSQLI_ASSOC);
        } else $res;
    }
    public function getAddressByID($aid) {
        $query = "SELECT * FROM restaurant_address WHERE aid = $aid";
        $res = $this->db->select($query);
        return $res->fetch_all(MYSQLI_ASSOC)[0];
    }
}
