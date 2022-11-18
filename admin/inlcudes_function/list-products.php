<?php
if (isset($_GET['brand']) && $_GET['brand'] != null) {
    $idbrand = $_GET['brand'];
    $wherebrand = "AND b.ID_Brand='" . ($idbrand) . "'";
} else {
    $idbrand = null;
    $wherebrand = null;
}

if (isset($_GET['gender']) && $_GET['gender'] != null) {
    $idgender = $_GET['gender'];
    $wheregender = "AND c.ID_Gender='" . ($idgender) . "'";
} else {
    $idgender = null;
    $wheregender = null;
}

// lấy tên hãng
$sqlBrand = "SELECT * FROM `brands` WHERE 1";
$resultBrand = mysqli_query($conn, $sqlBrand);
// lấy tên loại
$sqlGender = "SELECT * FROM `gender` WHERE 1";
$resultGender = mysqli_query($conn, $sqlGender);
// lấy dữ liệu sp
$sql = "SELECT a.Name as Name_Product,b.Name as Name_Brand, c.Name as Name_Gender,ID_Product,Description,Image,Quantity,Price,Discount,Create_At,Update_At 
FROM `products` a inner join brands b on a.ID_Brand = b.ID_Brand inner join gender c on c.ID_Gender=a.ID_Gender WHERE 1 $wherebrand  $wheregender";
$result = mysqli_query($conn, $sql);
//////////////////
//  TÌM TỔNG SỐ RECORDS

$total_records = mysqli_num_rows($result);


//  TÌM LIMIT VÀ CURRENT_PAGE
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;

//  TÍNH TOÁN TOTAL_PAGE VÀ START
// tổng số trang
$total_page = ceil($total_records / $limit);

// Giới hạn current_page trong khoảng 1 đến total_page
if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}

// Tìm Start
$start = ($current_page - 1) * $limit;
$sql = "SELECT a.ID_Product,a.Name as Name_Product,b.Name as Name_Brand, c.Name as Name_Gender,Description,Image,Quantity,Price,Discount,Create_At,Update_At 
FROM `products` a inner join brands b on a.ID_Brand = b.ID_Brand inner join gender c on c.ID_Gender=a.ID_Gender WHERE 1 $wherebrand $wheregender LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);
$check = $sql;
