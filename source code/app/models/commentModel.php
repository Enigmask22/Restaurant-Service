<?php 

class CommentModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $query = "SELECT restaurant_name, avatar, name, phone, email, cmt, reply, comid
        FROM restaurant JOIN comment ON restaurant.rid = comment.r_id";
        $res = $this->db->select($query);
        $data = [];
        if($res) {
            while($row = mysqli_fetch_assoc($res)) {
                array_push($data, $row);
            }
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        else return false;
    }
    public function addReply($comid, $reply) {
        $query = "UPDATE comment SET reply = '$reply' WHERE comid = $comid";
        $res = $this->db->update($query);
        if($res) return true;
        else return false;
    }
    public function getAllByComID($comid) {
        $query = "SELECT restaurant_name, avatar, name, phone, email, cmt, reply, comid
        FROM restaurant JOIN comment ON restaurant.rid = comment.r_id
        WHERE comid = $comid";
        $res = $this->db->select($query);
        if($res) {
            $data = mysqli_fetch_assoc($res);
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        else return false;
    }

    public function deleteComment($comid) {
        $query = "DELETE FROM comment WHERE comid=$comid";
        $res = $this->db->delete($query);
        if($res) return true;
        else return false;
    }

    public function getAllByResID($rid) {
        $query = "SELECT * FROM comment WHERE r_id = $rid ORDER BY time DESC";
        $res = $this->db->select($query);
        if($res) return $res->fetch_all(MYSQLI_ASSOC);
        else return $res;
    }

    public function getCommentByID($comid) {
        $query = "SELECT * FROM comment WHERE comid = $comid";
        $res = $this->db->select($query);
        if($res) return $res->fetch_all(MYSQLI_ASSOC)[0];
        else return $res;
    }

    public function insertComment($data) {
        $r_id = $data['r_id'];
        $name = $data['name'];
        $phone = $data['phone'];
        $email = $data['email'];
        $cmt = $data['cmt'];
        $time = $data['time'];

        $query = "INSERT INTO comment (r_id, name, phone, email, cmt, reply, time)
        VALUES ($r_id, '$name', '$phone', '$email', '$cmt', '', '$time')";
        $res = $this->db->insert($query);
        return $res;
    }
}
