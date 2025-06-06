<?php

class RestaurantModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllRestaurant()
    {
        $query = "SELECT * FROM restaurant";
        $res = $this->db->select($query);
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function updateRestaurant(
        $rid,
        $restaurant_name,
        $adult_price,
        $child_price,
        $address,
        $open_time,
        $description,
        $res_include,
        $res_exclude,
        $res_condition,
        $res_rate,
        $avatar,
        $imageid,
        $discount,
        $res_mail
    ) {
        $query_restaurant = "UPDATE restaurant SET `restaurant_name`='$restaurant_name', `original_adult_price`='$adult_price', `original_child_price`='$child_price', `address`='$address', `open_time`='$open_time', `description`='$description', `res_include`='$res_include', `res_exclude`='$res_exclude', `res_condition`='$res_condition', `res_rate`='$res_rate', `discount`='$discount', `avatar`='$avatar', `res_mail`='$res_mail' WHERE `rid`='$rid'";
        $res = $this->db->update($query_restaurant);

        // $query_image = "UPDATE restaurant_image SET `img`='$image' WHERE `r_id`='$rid' OR `imageid`='$imageid'";
        // $img = $this->db->update($query_image);
        // return $res && $img;
        return $res;
    }

    public function deleteRestaurant($rid)
    {

        $query_image = "DELETE FROM restaurant_image WHERE `r_id`='$rid'";
        $query_address = "DELETE FROM restaurant_address WHERE `r_id`='$rid'";
        $query_comment = "DELETE FROM comment WHERE `r_id`='$rid'";
        $query_related = "DELETE FROM related_restaurant WHERE `r_id`='$rid'";

        $img = $this->db->delete($query_image);
        $add = $this->db->delete($query_address);
        $com = $this->db->delete($query_comment);
        $rel = $this->db->delete($query_related);
        // $res = $this->db->delete($query_restaurant);
        if ($query_image || $query_image || $query_comment || $query_related) {
            $img = $this->db->delete($query_image);
            $add = $this->db->delete($query_address);
            $com = $this->db->delete($query_comment);
            $rel = $this->db->delete($query_related);
            if ($img || $add || $com || $rel) {
                $query_restaurant = "DELETE FROM restaurant WHERE `rid`='$rid'";
                $res = $this->db->delete($query_restaurant);
                return true;
            }
        } else {
            $query_restaurant = "DELETE FROM restaurant WHERE `rid`='$rid'";
            $res = $this->db->delete($query_restaurant);
            return true;
        }
        return false;
    }
    public function addRestaurant($data)
    {
        print_r($data);
        $query = sprintf(
            "INSERT INTO restaurant (`restaurant_name`, `adult_price`, `child_price`, `address`, `open_time`, `description`, `res_include`, `res_exclude`, `res_condition`, `cate_id`, `res_rate`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
            $data['restaurant_name'],
            $data['adult_price'],
            $data['child_price'],
            $data['address'],
            $data['open_time'],
            $data['description'],
            $data['res_include'],
            $data['res_exclude'],
            $data['res_condition'],
            $data['cate_id'],
            $data['res_rate']
        );
        $res = mysqli_query(Database::$conn, $query);
        $id = mysqli_insert_id(Database::$conn);

        $insert_image = sprintf("INSERT INTO restaurant_image (`r_id`, `img`) VALUES ('%s', '%s')", $id, $data['img']);
        $res_img = $this->db->insert($insert_image);

        $insert_address = sprintf("INSERT INTO restaurant_address (`r_id`, `location`, `description`) VALUES ('%s', '%s', '%s')", $id, $data['location'], $data['description']);
        $res_address = $this->db->insert($insert_address);

        return $res && $res_img && $res_address;
    }

    public function getAllCategory($cateid = 0, $start = 1, $page_num = 5)
    {
        if (!is_numeric($cateid)) {
            $query = "SELECT * FROM restaurant WHERE cate_id LIKE '%$cateid%' LIMIT $start, $page_num";
        } else if ($cateid != 0) {
            $query = "SELECT * FROM restaurant WHERE cate_id = $cateid LIMIT $start, $page_num";
        } else {
            $query = "SELECT * FROM restaurant LIMIT $start, $page_num";
        }
        $res = $this->db->select($query);
        if ($res) {
            return $res->fetch_all(MYSQLI_ASSOC);
        }
        return $res;
    }
    public function getAllById($rid)
    {
        $query_restaurant = sprintf("SELECT * FROM restaurant WHERE rid = %s", $rid);
        $query_image = sprintf("SELECT * FROM restaurant_image WHERE r_id=%s", $rid);
        $query_address = sprintf("SELECT * FROM restaurant_address WHERE r_id=%s ORDER BY `branch`", $rid);

        $restaurant = $this->db->select($query_restaurant);
        $restaurant = $restaurant ? $restaurant->fetch_all(MYSQLI_ASSOC) : array();

        $image = $this->db->select($query_image);
        $image = $image ? $image->fetch_all(MYSQLI_ASSOC) : array();

        $address = $this->db->select($query_address);
        $address = $address ? $address->fetch_all(MYSQLI_ASSOC) : array();

        return array(
            "restaurant" => $restaurant,
            "image" => $image,
            "address" => $address
        );
    }
    public function addAddress($location, $description, $branch, $r_id)
    {
        $query = "INSERT INTO restaurant_address (`location`, `description`, `branch`, `r_id`) VALUES ('$location', '$description', '$branch', '$r_id')";
        $res = $this->db->insert($query);
        return $res;
    }

    public function deleteAddress($aid, $branch)
    {
        $query = "DELETE FROM restaurant_address WHERE aid = $aid AND branch = '$branch'";
        $delete = $this->db->delete($query);
        return $delete;
    }

    public function updateAddress($location, $description, $branch, $aid, $r_id)
    {
        $query = "UPDATE restaurant_address SET `location`='$location', `description`='$description', `branch`='$branch' WHERE `aid`='$aid' AND `r_id`='$r_id'";
        $res = $this->db->update($query);
        return $res;
    }
    public function updateViews($rid)
    {
        $sql = "UPDATE restaurant SET views_num = views_num + 1 WHERE rid = $rid";
        $res = $this->db->update($sql);
        return $res;
    }
    public function getRestaurantById($rid)
    {
        $query = sprintf("SELECT * FROM restaurant WHERE rid = %s", $rid);
        $res = $this->db->select($query);
        return $res->fetch_all(MYSQLI_ASSOC)[0];
    }
    public function countById($cateid = 0)
    {
        if (!is_numeric($cateid)) {
            $query = "SELECT COUNT(*) FROM restaurant WHERE cate_id LIKE '%$cateid%'";
        } else if ($cateid != 0) {
            $query = "SELECT COUNT(*) FROM restaurant WHERE cate_id = $cateid";
        } else {
            $query = "SELECT COUNT(*) FROM restaurant";
        }
        $res = $this->db->select($query);
        if ($res) {
            return $res->fetch_all(MYSQLI_ASSOC)[0]['COUNT(*)'];
        }
        return 0;
    }
    public function getThree()
    {
        $query = "SELECT DISTINCT * FROM restaurant R JOIN restaurant_address RA ON R.rid = RA.r_id ORDER BY rand() LIMIT 3";
        $res = $this->db->select($query);
        return $res;
    }
    public function getFive()
    {
        $query = "SELECT DISTINCT * FROM restaurant R JOIN restaurant_address RA ON R.rid = RA.r_id ORDER BY rand() LIMIT 5";
        $res = $this->db->select($query);
        return $res;
    }

    public function searchRestaurants($search, $start = 0, $page_num = 6)
    {
        $search = mysqli_real_escape_string(Database::$conn, $search);
        ; // Bảo mật SQL injection
        $query = "SELECT * FROM restaurant WHERE restaurant_name LIKE '%$search%' LIMIT $start, $page_num";
        $res = $this->db->select($query);
        if ($res) {
            return $res->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function countBySearch($search)
    {
        $search = mysqli_real_escape_string(Database::$conn, $search);
        ; // Bảo mật SQL injection
        $query = "SELECT COUNT(*) FROM restaurant WHERE restaurant_name LIKE '%$search%'";
        $res = $this->db->select($query);
        if ($res) {
            return $res->fetch_all(MYSQLI_ASSOC)[0]['COUNT(*)'];
        }
        return 0;
    }

    public function getRestaurantByEmail($email)
    {
        $email = mysqli_real_escape_string(Database::$conn, $email); // Bảo mật SQL injection
        $query = "SELECT * FROM restaurant WHERE res_mail = '$email' LIMIT 1";
        $res = $this->db->select($query);
        if ($res && $res->num_rows > 0) {
            return $res->fetch_assoc();
        }
        return null;
    }

    public function updatePassword($rid, $newPassword)
    {
        $sql = "UPDATE restaurant SET password = '$newPassword' WHERE rid = $rid";
        $res = $this->db->update($sql);
        return $res;
    }
}