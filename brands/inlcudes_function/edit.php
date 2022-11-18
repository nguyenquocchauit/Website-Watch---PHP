<?php
require '../../config/connectDB.php';

$message = array();
$message['key'] = $_POST['action'];

    if (isset($_POST['action']) && ($_POST['action'] == 'edit') && isset($_POST['namebrand'])) 
    {
        $idbrand = $_POST['idbrand'];
        $namebrand = $_POST['namebrand'];
        $editbrand = "UPDATE brands SET Name='$namebrand' WHERE ID_Brand='$idbrand'";
        $resulteditbrand = mysqli_query($conn, $editbrand);
        $message['key'] = "Sửa thành công";
    }
echo json_encode($message) ;
?>