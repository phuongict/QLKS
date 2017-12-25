<?php
$host = 'localhost';
$port = 3306;
$db_user = 'root';
$db_pass = '';
$db_name ='quanly_khachsan';

$conn = mysqli_connect($host, $db_user, $db_pass, $db_name, $port);

if(mysqli_connect_errno($conn)){
	die('Error connect database: '. mysqli_connect_error());
}
mysqli_set_charset($conn,'utf8');
$GLOBALS['conn'] = $conn;

