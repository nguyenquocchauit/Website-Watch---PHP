<?php 
// lấy tên hãng
$sql = "SELECT * FROM `brands`";
$resultBrand = mysqli_query($conn, $sql);
// lấy tên loại
$sql = "SELECT * FROM `gender`";
$resultGender = mysqli_query($conn, $sql);

?>