<?php session_start();

//1. Khai báo đường dẫn các thư mục
define('app_path',__DIR__);
define('layout_path', app_path.'/Views/layout'); // đường dẫn thư mục layout
require_once app_path.'/config/config.php';
define('controller_path',app_path.'/Controllers');
define('model_path',app_path.'/Models');

//nhúng file app vào để chạy
require_once 'Core/app.php';
$app = new MyMVC();
$app->run();



