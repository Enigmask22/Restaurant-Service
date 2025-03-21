<?php
require_once '../../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable('../');
$dotenv->load();
require_once '../app/bridge.php';
session_start();
$route = new Router();
