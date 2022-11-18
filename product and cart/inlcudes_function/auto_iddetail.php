<?php
require '../../config/connectDB.php';
// xử lý tăng mã tự động bản order
$sql = "SELECT MAX(ID_Detail) as ID_Detail FROM `order_details` WHERE 1";
$results = mysqli_query($conn, $sql);
$get = mysqli_fetch_array($results);
// ví dụ Detail0000001
$ID_Detail = null;  
// $detail = Detail
// $detail = substr($get['ID_Detail'], 0, -7);
$detail = "Detail";
// $number
$number =  substr($get['ID_Detail'], -7);
// chuyển chuỗi thành số
$number = (int)$number;
// tăng thêm 1
$number += 1;
switch ($number) {
    case $number < 10:
        $ID_Detail = $detail . "000000" . $number;
        break;
    case $number >= 10 && $number < 100:
        $ID_Detail = $detail . "00000" . $number;
        break;
    case $number >= 100 && $number < 1000:
        $ID_Detail = $detail . "0000" . $number;
        break;
    case $number >= 1000 && $number < 10000:
        $ID_Detail = $detail . "000" . $number;
        break;
    case $number >= 10000 && $number < 100000:
        $ID_Detail = $detail . "00" . $number;
        break;
    case $number >= 100000 && $number < 1000000:
        $ID_Detail = $detail . "0" . $number;
        break;
    case $number >= 1000000 && $number < 10000000:
        $ID_Detail = $detail  . $number;
        break;
    case $number >= 10000000 && $number < 100000000:
        $ID_Detail = "null";
        break;
}
