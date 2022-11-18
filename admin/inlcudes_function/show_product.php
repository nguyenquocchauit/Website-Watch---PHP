<?php
// lấy sản phẩm
$sql = "SELECT * FROM `products` WHERE 1 and ID_Product='" . ($idpro) . "'";
$result = mysqli_query($conn, $sql);
$rowProduct = mysqli_fetch_array($result);
// lấy tên hãng
$sql = "SELECT * FROM `brands`";
$resultBrand = mysqli_query($conn, $sql);
// lấy tên loại
$sql = "SELECT * FROM `gender`";
$resultGender = mysqli_query($conn, $sql);

// xử lý lấy đường dẫn đúng theo gender và brand truy xuất ảnh 
$genderlink = null;
$brandlink = null;
$idlink = null;
switch ($rowProduct['ID_Gender']) {
    case "IDM":
        $genderlink = "Men";
        break;
    case "IDWM":
        $genderlink = "Women";
        break;
}
switch ($rowProduct['ID_Brand']) {
    case "Avia":
        $brandlink = "aviator";
        break;
    case "Baby":
        $brandlink = "baby-g";
        break;
    case "Bentley":
        $brandlink = "bentley";
        break;
    case "Citizen":
        $brandlink = "citizen";
        break;
    case "Olym":
        $brandlink = "olym-pianus";
        break;
    case "Shock":
        $brandlink = "g-shock";
        break;
}
