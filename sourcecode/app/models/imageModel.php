<?php
class ImageModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $query = "SELECT ri.*, f.path, f.file_key FROM restaurant_image ri
                  LEFT JOIN file f ON ri.imgid = f.fid
                  JOIN restaurant r ON r.rid = ri.r_id
                  ORDER BY RAND() LIMIT 25";
        $res = $this->db->select($query);
        if ($res) {
            return $res->fetch_all(MYSQLI_ASSOC);
        } else
            return $res;
    }

    public function getImageByRID($rid)
    {
        $query = "SELECT ri.*, f.path, f.file_key FROM restaurant_image ri
                  LEFT JOIN file f ON ri.imgid = f.fid
                  WHERE ri.r_id = $rid";
        $res = $this->db->select($query);
        if ($res) {
            return $res->fetch_all(MYSQLI_ASSOC);
        } else
            return $res;
    }

    public function getImagesByRestaurantId($rid)
    {
        $query = "SELECT ri.*, f.path, f.file_key FROM restaurant_image ri
                  LEFT JOIN file f ON ri.imgid = f.fid
                  WHERE ri.r_id = $rid";
        $result = $this->db->select($query);

        if ($result) {
            $num_rows = $result->num_rows;
            error_log("Found $num_rows images for restaurant ID: $rid");

            $data = $result->fetch_all(MYSQLI_ASSOC);
            // Có thể in ra thông tin chi tiết về dữ liệu
            error_log("Image data: " . print_r($data, true));

            return $data;
        } else {
            return [];
        }
    }

    public function getImageById($imageid)
    {
        $query = "SELECT ri.*, f.path, f.file_key FROM restaurant_image ri
                  LEFT JOIN file f ON ri.imgid = f.fid
                  WHERE ri.imageid = $imageid";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function addImage($rid, $fid)
    {
        // Thêm debug để kiểm tra giá trị đầu vào
        error_log("Adding image - RID: $rid, FID: $fid");

        // Chuyển đổi kiểu dữ liệu để đảm bảo là số nguyên
        $rid = (int) $rid;
        $fid = (int) $fid;

        // Sử dụng truy vấn trực tiếp không có dấu nháy đơn cho số nguyên
        $query = "INSERT INTO restaurant_image (r_id, imgid) VALUES ($rid, $fid)";

        // Thực hiện truy vấn và lưu kết quả
        $result = $this->db->insert($query);

        // Ghi log kết quả
        error_log("Insert result: " . ($result ? 'Success' : 'Failed') . " - Query: $query");

        return $result;
    }

    public function deleteImage($imageid)
    {
        // Lấy thông tin imgid trước khi xóa
        $query = "SELECT imgid FROM restaurant_image WHERE imageid = $imageid";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $imgid = $row['imgid'];

            // Xóa bản ghi trong restaurant_image
            $deleteQuery = "DELETE FROM restaurant_image WHERE imageid = $imageid";
            $deleteResult = $this->db->delete($deleteQuery);

            if ($deleteResult && $imgid) {
                // Xóa file từ bảng file và AWS S3
                $fileModel = new FileModel();
                $fileModel->deleteOne($imgid);
            }

            return $deleteResult;
        }

        return false;
    }

    public function getAllWithRestaurantInfo()
    {
        $query = "SELECT ri.*, f.path, f.file_key, r.restaurant_name, r.rid as r_id 
                  FROM restaurant_image ri
                  LEFT JOIN file f ON ri.imgid = f.fid
                  JOIN restaurant r ON r.rid = ri.r_id
                  ORDER BY RAND() LIMIT 20";
        $res = $this->db->select($query);
        if ($res) {
            return $res->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
}