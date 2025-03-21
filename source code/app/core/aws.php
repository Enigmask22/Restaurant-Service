<?php
use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class AwsS3Service {
    private $s3Client;
    private $bucketName;

    public function __construct() {
        $this->s3Client = new S3Client([
            'region' => 'ap-southeast-2', // Thay bằng region của bạn
            'version' => 'latest',
            'credentials' => [
                'key' => $_ENV['YOUR_AWS_ACCESS_KEY'], // Thay bằng Access Key của bạn
                'secret' => $_ENV['YOUR_AWS_SECRET_KEY'], // Thay bằng Secret Key của bạn
            ]
        ]);
        
        $this->bucketName = $_ENV['BUCKET_NAME']; // Thay bằng tên bucket của bạn
    }

    // Hàm upload file lên S3
    public function uploadFile($file, $folder) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("File upload error: " . $file['error']);
        }
        
        $fileTmpPath = $file['tmp_name'];
        $fileName = $folder . '/' . time() . '_' . $file['name'];
        $fileType = $file['type'];

        var_dump([
            'Bucket' => $this->bucketName,
            'Key' => $fileName,
            'SourceFile' => $fileTmpPath,
            'ContentType' => $fileType,
        ]);

        try {
            $result = $this->s3Client->putObject([
                'Bucket' => $this->bucketName,
                'Key' => $fileName,
                'SourceFile' => $fileTmpPath,
                'ContentType' => $fileType,
            ]);
            if ($result['@metadata']['statusCode'] !== 200) {
                throw new Exception("Error uploading file: " . $result['@metadata']['statusCode']);
            }
            return [
                'fileKey' => $fileName,
                'fileUrl' => $result['ObjectURL'],
            ];
        } catch (AwsException $e) {
            throw new Exception("Error uploading file: " . $e->getMessage());
        }
    }

    // Hàm lấy URL file từ S3
    public function getFileUrl($fileKey) {
        return $this->s3Client->getObjectUrl($this->bucketName, $fileKey);
    }

    // Hàm xóa file khỏi S3
    public function deleteFile($fileKey) {
        try {
            $this->s3Client->deleteObject([
                'Bucket' => $this->bucketName,
                'Key' => $fileKey,
            ]);
            return true;
        } catch (AwsException $e) {
            throw new Exception("Error deleting file: " . $e->getMessage());
        }
    }
}