<?php 
// if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'){
//     $web_root = 'https://'.$_SERVER['HTTP_HOST'];
// }else{
//     $web_root = 'http://'.$_SERVER['HTTP_HOST'];
// }
// require_once '../app/core/router.php';
// require_once '../app/core/controller.php';
// require_once '../app/core/database.php';
// require_once '../app/core/aws.php';

$dir = '../app/core';
$files = scandir($dir);
foreach ($files as $file) {
    if (strpos($file, '.php') !== false) {
        require_once $dir . '/' . $file;
    }
}
