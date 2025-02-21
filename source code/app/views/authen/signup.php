<?php
$path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']) . 'authen/';
require_once '../app/views/authen/' . $data['page'] . '.php';
