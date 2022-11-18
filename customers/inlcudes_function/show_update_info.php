<?php 

$sql = "SELECT * FROM `customers` WHERE 1 and ID_Customer='$CurrentUser' and ID_Role='$IDUser' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

