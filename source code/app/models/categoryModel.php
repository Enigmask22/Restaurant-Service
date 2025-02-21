<?php 

class CategoryModel {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $query = "SELECT * FROM category";
        $res = $this->db->select($query);
        if($res) {
            return $res->fetch_all(MYSQLI_ASSOC);
        } else return array();
    }   

    public function getCategoryNameByID($cateid) {
        $query = "SELECT * FROM category WHERE cateid = $cateid";
        $res = $this->db->select($query);
        return $res->fetch_all(MYSQLI_ASSOC)[0]['category_name'];
    }
    public function getAllCategory() {
        $query = "SELECT cateid, category_name, category_img, COUNT(restaurant.cate_id) as num_res
        FROM category LEFT JOIN restaurant ON category.cateid = restaurant.cate_id
        GROUP BY category.cateid
        HAVING num_res > 0 LIMIT 6";
        $res = $this->db->select($query);
        return $res->fetch_all(MYSQLI_ASSOC);
    }
    public function getCategoryInfo() {
        $query = "SELECT cateid, category_name, category_img, COUNT(rid) as num_res
        FROM category LEFT JOIN restaurant ON category.cateid = restaurant.cate_id
        GROUP BY category.cateid";
        $res = $this->db->select($query);
        $data = [];
        if($query) {
            while($row = mysqli_fetch_assoc($res)) {
                array_push($data, $row);
            }
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        else return false;
    }
    public function addCategory($category_name, $category_img) {
        $query = "INSERT INTO category
        (category_name, category_img)
        VALUES ('$category_name', '$category_img')";
        $res = $this->db->insert($query);
        return $res;
    }
    public function deleteCategory($cateid) {
        $query1 = "SELECT * FROM restaurant WHERE cate_id = $cateid";
        $res1 = $this->db->select($query1);
        if($res1 && mysqli_num_rows($res1) > 0) {
            return 1;
        }
        $query2 = "DELETE FROM category WHERE cateid = $cateid";
        $res2 = $this->db->delete($query2);
        if($res2) return 0;
        else return 2;
    }
    public function updateCategory($cateid, $category_name, $category_img) {
        $query = "UPDATE category SET category_name = '$category_name', category_img = '$category_img' WHERE cateid = $cateid";
        $res = $this->db->update($query);
        if($query) {
            return true;
        } else return false;
    }
    public function getCategoryInfoByID($cateid) {
        $query = "SELECT * FROM category WHERE cateid=$cateid";
        $res = $this->db->select($query);
        if($res) return mysqli_fetch_assoc($res);
        else return false;
    }
}