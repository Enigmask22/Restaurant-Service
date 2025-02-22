<?php 
$path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
// Trả về đường dẫn của tập tin PHP hiện tại tính từ thư mục gốc của máy chủ.

include 'blocks/header.php';
require_once '../app/views/user/' . $data['page'] . '.php';
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
include 'blocks/footer.php';

