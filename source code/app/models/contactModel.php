<?php 

class ContactModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $query = "SELECT * FROM contact";
        $res = $this->db->select($query);
        if($res) {
            return $res->fetch_all(MYSQLI_ASSOC);
        } else return $res;
    }

    public function insertContact($name, $phone, $email, $description, $address) {
        $query = "INSERT INTO contact
        (name, phone, email, description, address)
        VALUES ('$name', '$phone', '$email', '$description', '$address')";
        $res = $this->db->insert($query);
        return $res;
    }
}
