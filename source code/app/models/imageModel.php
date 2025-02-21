<?php 

class ImageModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $query = "SELECT DISTINCT * FROM restaurant_image
        JOIN restaurant ON restaurant.rid = restaurant_image.r_id
        ORDER BY RAND() LIMIT 25";
        $res = $this->db->select($query);
        if($res) {
            return $res->fetch_all(MYSQLI_ASSOC);
        } else return $res;
    }

    public function getImageByRID($rid) {
        $query = "SELECT * FROM restaurant_image WHERE r_id = $rid";
        $res = $this->db->select($query);
        if($res) {
            return $res->fetch_all(MYSQLI_ASSOC);
        } else return $res;
    }
}
