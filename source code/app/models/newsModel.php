<?php 

class NewsModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllByPage($start, $page, $find='') {
        if($find != '') $query = "SELECT * FROM news WHERE title like '%$find%' LIMIT $start, $page";
        else $query = "SELECT * FROM news LIMIT $start, $page";

        $res = $this->db->select($query);
        if($res) return $res->fetch_all(MYSQLI_ASSOC);
        else return $res;
    }

    public function getAllByID($nid) {
        $query = "SELECT * FROM news WHERE nsid = $nid";
        $res = $this->db->select($query);
        if($res) return $res->fetch_all(MYSQLI_ASSOC)[0];
        else return $res;
    }

    public function get3() {
        $query = "SELECT * FROM news ORDER BY RAND() LIMIT 3";
        $res = $this->db->select($query);
        if($res) return $res->fetch_all(MYSQLI_ASSOC);
        else return $res;
    }

    public function getTotalNews($find='') {
        if($find != '') $query = "SELECT COUNT(*) FROM news WHERE title like '%$find%'";
        else $query = "SELECT COUNT(*) FROM news";

        $res = $this->db->select($query);
        return $res->fetch_all(MYSQLI_ASSOC)[0]['COUNT(*)'];
    }

    public function getRelatedRes($nid) {
        $query = "SELECT * FROM related_restaurant, restaurant WHERE nid=$nid and related_restaurant.r_id = restaurant.rid";
        $res = $this->db->select($query);
        if($res) return $res->fetch_all(MYSQLI_ASSOC);
        else return $res;
    }
}
