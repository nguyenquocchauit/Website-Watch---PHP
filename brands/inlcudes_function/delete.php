<?php
require '../../config/connectDB.php';

$message = array();
$message['key'] = $_POST['action'];


if (isset($_POST['action']) && isset($_POST['idbrand']) && ($_POST['action'] == 'delete'))
{
    $idbrand = $_POST['idbrand'];
    $deletebrand = "DELETE FROM brands WHERE ID_Brand='$idbrand' ";
    $resultdeletebrand = mysqli_query($conn, $deletebrand);
    $message['key'] = "Xóa thành công";
}
echo json_encode($message) ;
?>
