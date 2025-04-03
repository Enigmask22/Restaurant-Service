<?php 

class FileModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createOne ($file) {
        $query = "INSERT INTO file (file_name, path, type, size, file_key, file_extension) 
        VALUES ('$file[name]', '$file[path]', '$file[type]', '$file[size]', '$file[file_key]', '$file[file_extension]')";
        $this->db->insert($query);
        $findQuery = "SELECT fid FROM file WHERE file_key = '$file[file_key]'";
        return $this->db->select($findQuery)->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function deleteOne ($fid) {
        $awsService = new AwsS3Service();
        $file = $this->db->select("SELECT * FROM file WHERE fid = $fid")->fetch_all(MYSQLI_ASSOC)[0];
        $awsService->deleteFile($file['file_key']);
        $query = "DELETE FROM file WHERE fid = $fid";
        return $this->db->delete($query);
    }
}