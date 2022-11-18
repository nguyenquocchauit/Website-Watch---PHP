<?php
session_start();
// kết nối cơ sở dữ liệu db_watch
require '../config/connectDB.php';
// xử lý tăng mã tự động bản customer
$sql = "SELECT MAX(ID_Customer) as ID_Customer FROM `customers` WHERE 1";
$results = mysqli_query($conn, $sql);
$get = mysqli_fetch_array($results);
// ví dụ MaKH00001
$ID_Customer = null;
// // $MaKH = MaKH
// $MaKH = substr($get['ID_Customer'], 0, -7);
$MaKH = "MaKH";
// $number
$number =  substr($get['ID_Customer'], -5);
// chuyển chuỗi thành số
$number = (int)$number;
// tăng thêm 1
$number += 1;
switch ($number) {
    case $number < 10:
        $ID_Customer = $MaKH . "0000" . $number;
        break;
    case $number >= 10 && $number < 100:
        $ID_Customer = $MaKH . "000" . $number;
        break;
    case $number >= 100 && $number < 1000:
        $ID_Customer = $MaKH . "00" . $number;
        break;
    case $number >= 1000 && $number < 10000:
        $ID_Customer = $MaKH . "0" . $number;
        break;
    case $number >= 10000 && $number < 100000:
        $ID_Customer = $MaKH  . $number;
        break;
    case $number >= 1000000 && $number < 10000000:
        $ID_Customer = "null";
        break;
}
// kết xử lý tăng mã tự động bản customer
