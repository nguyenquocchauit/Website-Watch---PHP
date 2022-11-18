<?php
require '../../config/connectDB.php';
$array_message = [];
if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['ID_Product']) && $_POST['ID_Product'] !=null) {
    $id = $_POST['ID_Product'];
    $sql = "DELETE FROM `products` WHERE ID_Product='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result == true)
        $array_message['message'] = 0;
}
echo json_encode($array_message);
