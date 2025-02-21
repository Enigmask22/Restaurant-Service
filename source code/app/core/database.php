<?php

class Database {
    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "";
    private static $db = "restaurant";

    public static $conn;
    public static $err;

    public function __construct() {
        $this->connectDatabase();
    }
    public function connectDatabase() {
        try {
            self::$conn = new mysqli(self::$host, self::$user, self::$pass, self::$db);
            if(self::$conn->connect_error) {
                throw new Exception(self::$conn->connect_error);
            }
            mysqli_set_charset(self::$conn, "utf8");
            return self::$conn;
        } catch (PDOException $e) {
            self::$err = $e->getMessage();
            echo self::$err;
        }
    }
    public function closeDB() {
        self::$conn->close();
    }
    public function select($query) {
        $res = self::$conn->query($query) or die($this->conn->error . __LINE__);
        if(!$res) {
            return false;
        }
        return $res;
    }
    public function insert($query) {
        $res = self::$conn->query($query) or die($this->conn->error . __LINE__);
        if(!$res) {
            return false;
        }
        return $res;
    }
    public function update($query) {
        $res = self::$conn->query($query) or die($this->conn->error . __LINE__);
        if(!$res) {
            return false;
        }
        return $res;
    }
    public function delete($query) {
        $res = self::$conn->query($query) or die($this->conn->error . __LINE__);
        if(!$res) {
            return false;
        }
        return $res;
    }
}