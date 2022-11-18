<?php
// xử lý tăng mã tự động bản Product
$sql = "SELECT MAX(ID_Product) as ID_Product FROM `products` WHERE 1";
$results = mysqli_query($conn, $sql);
$get = mysqli_fetch_array($results);
// ví dụ Product0001
$ID_Product = null;
$MaKH = "Product";
// $number
$number =  substr($get['ID_Product'], -4);
// chuyển chuỗi thành số
$number = (int)$number;
// tăng thêm 1
$number += 1;
switch ($number) {
    case $number < 10:
        $ID_Product = $MaKH . "000" . $number;
        break;
    case $number >= 10 && $number < 100:
        $ID_Product = $MaKH . "00" . $number;
        break;
    case $number >= 100 && $number < 1000:
        $ID_Product = $MaKH . "0" . $number;
        break;
    case $number >= 1000 && $number < 10000:
        $ID_Product = $MaKH  . $number;
        break;
    case $number >= 1000000 && $number < 10000000:
        $ID_Product = "null";
        break;
}
// kết xử lý tăng mã tự động bản customer
