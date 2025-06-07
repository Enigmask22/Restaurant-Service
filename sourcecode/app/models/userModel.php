<?php

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function signUser($email, $uname, $password, $role)
    {
        $query = "INSERT INTO user (email, uname, password, role) VALUES ('$email', '$uname', '$password', '$role')";
        $res = $this->db->insert($query);
        return $res;
    }

    public function getAll()
    {
        $query = "SELECT `uid`, `name`, `phone`, `email`, `address` FROM user WHERE role = 'U'";
        $query = $this->db->select($query);
        $res = [];
        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                array_push($res, $row);
            }
            return json_encode($res, JSON_UNESCAPED_UNICODE);
        } else
            return false;
    }

    public function getUserById($uid)
    {
        $query = "SELECT u.*, f.* FROM `user` u LEFT JOIN `file` f ON u.avatar_id = f.fid WHERE u.uid = $uid";
        $res = $this->db->select($query);
        // echo '<pre>';
        // var_dump($res->fetch_all(MYSQLI_ASSOC)[0]);
        // echo '</pre>';
        return $res->fetch_all(MYSQLI_ASSOC)[0];
    }
    public function updateUser($uid, $name, $phone, $address)
    {
        $query = "UPDATE user SET name = '$name', phone = '$phone', address = '$address' WHERE uid = $uid";
        $res = $this->db->update($query);
        return $res;
    }

    public function updatePass($email, $password)
    {
        $query = "UPDATE user SET password = '$password' WHERE email = '$email'";
        $res = $this->db->update($query);
        return $res;
    }

    public function deleteUser($uid)
    {
        $query_check = "SELECT * FROM booking WHERE u_id = $uid";
        $res_check = $this->db->select($query_check);
        if ($res_check) {
            $query1 = "DELETE FROM booking WHERE u_id = $uid";
            $query2 = "DELETE FROM user WHERE uid = $uid";
            if ($query1)
                $res1 = $this->db->delete($query1);
            $res2 = $this->db->delete($query2);
            if ($res2)
                return 1;
            else
                return 0;
        } else {
            $query2 = "DELETE FROM user WHERE uid = $uid";
            $res2 = $this->db->delete($query2);
            if ($res2)
                return true;
            else
                return false;
        }
    }

    public function existUser($email)
    {
        $query = "SELECT * FROM user WHERE email = '$email'";
        $res = $this->db->select($query);
        return $res;
    }

    public function existUserName($uname)
    {
        $query = "SELECT * FROM user WHERE uname = '$uname'";
        $res = $this->db->select($query);
        return $res;
    }
    public function updateAvatar($uid, $avatar_id)
    {
        $query = "UPDATE user SET avatar_id = '$avatar_id' WHERE uid = $uid";
        $res = $this->db->update($query);
        return $res;
    }

    /**
     * Lấy user theo Google ID
     */
    public function getUserByGoogleId($googleId)
    {
        $query = "SELECT * FROM user WHERE google_id = '$googleId'";
        $res = $this->db->select($query);

        if ($res && $res->num_rows > 0) {
            return $res->fetch_assoc();
        }
        return null;
    }

    /**
     * Tạo hoặc cập nhật user từ Google OAuth
     */
    public function createOrUpdateGoogleUser($googleData)
    {
        $googleId = $googleData['id'];
        $email = $googleData['email'];
        $name = $googleData['name'] ?? '';
        $picture = $googleData['picture'] ?? '';

        // Kiểm tra user đã tồn tại theo Google ID
        $existingUser = $this->getUserByGoogleId($googleId);

        if ($existingUser) {
            // Cập nhật thông tin user hiện có
            $query = "UPDATE user SET name = '$name', google_picture = '$picture', email = '$email' WHERE google_id = '$googleId'";
            $this->db->update($query);
            return $existingUser['uid'];
        }

        // Kiểm tra user đã tồn tại theo email
        $emailCheck = $this->existUser($email);
        if ($emailCheck && $emailCheck->num_rows > 0) {
            // Liên kết Google account với tài khoản hiện có
            $userData = $emailCheck->fetch_assoc();
            $query = "UPDATE user SET google_id = '$googleId', google_picture = '$picture', name = '$name' WHERE email = '$email'";
            $this->db->update($query);
            return $userData['uid'];
        }

        // Tạo user mới
        $username = $this->generateUniqueUsername($name, $email);
        $query = "INSERT INTO user (email, uname, name, google_id, google_picture, role) VALUES ('$email', '$username', '$name', '$googleId', '$picture', 'U')";

        $result = $this->db->insert($query);
        if ($result) {
            // Lấy ID của user vừa tạo
            $newUser = $this->existUser($email);
            if ($newUser && $newUser->num_rows > 0) {
                return $newUser->fetch_assoc()['uid'];
            }
        }

        return false;
    }

    /**
     * Tạo username duy nhất từ tên và email
     */
    public function generateUniqueUsername($name, $email)
    {
        // Tạo username từ tên hoặc email
        $baseName = '';
        if (!empty($name)) {
            // Loại bỏ ký tự đặc biệt và khoảng trắng
            $baseName = preg_replace('/[^a-zA-Z0-9]/', '', $name);
        }

        if (empty($baseName) || strlen($baseName) < 3) {
            // Sử dụng phần trước @ của email
            $emailParts = explode('@', $email);
            $baseName = preg_replace('/[^a-zA-Z0-9]/', '', $emailParts[0]);
        }

        $baseName = strtolower($baseName);

        // Đảm bảo độ dài tối thiểu
        if (strlen($baseName) < 6) {
            $baseName .= rand(1000, 9999);
        } else {
            $baseName = substr($baseName, 0, 10); // Giới hạn độ dài
        }

        // Kiểm tra và tạo username duy nhất
        $username = $baseName;
        $counter = 1;

        while (true) {
            $check = $this->existUserName($username);
            if (!$check || $check->num_rows == 0) {
                break;
            }
            $username = $baseName . $counter;
            $counter++;
        }

        return $username;
    }
}