<?php
session_start();
// kết nối cơ sở dữ liệu db_watch
require '../../config/connectDB.php';
// xử lý tăng mã tự động bản order
$sql = "SELECT MAX(ID_Order) as ID_Order FROM `orders` WHERE 1";
$results = mysqli_query($conn, $sql);
$get = mysqli_fetch_array($results);
// ví dụ Order0000001
$ID_Order = null;
// // $order = Order
// $order = substr($get['ID_Order'], 0, -7);
$order ="Order";
// $number
$number =  substr($get['ID_Order'], -7);
// chuyển chuỗi thành số
$number = (int)$number;
// tăng thêm 1
$number += 1;
switch ($number) {
    case $number < 10:
        $ID_Order = $order . "000000" . $number;
        break;
    case $number >= 10 && $number < 100:
        $ID_Order = $order . "00000" . $number;
        break;
    case $number >= 100 && $number < 1000:
        $ID_Order = $order . "0000" . $number;
        break;
    case $number >= 1000 && $number < 10000:
        $ID_Order = $order . "000" . $number;
        break;
    case $number >= 10000 && $number < 100000:
        $ID_Order = $order . "00" . $number;
        break;
    case $number >= 100000 && $number < 1000000:
        $ID_Order = $order . "0" . $number;
        break;
    case $number >= 1000000 && $number < 10000000:
        $ID_Order = $order  . $number;
        break;
    case $number >= 10000000 && $number < 100000000:
        $ID_Order = "null";
        break;
}
// kết xử lý tăng mã tự động bản order


