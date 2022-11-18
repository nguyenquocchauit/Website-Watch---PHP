<?php
require '../../config/connectDB.php';
$message = array();
$message['key'] = $_POST['action'];

if (isset($_POST['action']) && ($_POST['action'] == 'insert')) 
{
    if(isset($_POST['idbrand']))
    {
        $idbrand = $_POST['idbrand'];
        $sql = "SELECT * FROM brands WHERE ID_Brand='$idbrand'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            if(isset($_POST['namebrand']))
            {
                $namebrand = $_POST['namebrand'];
                $sql = "SELECT * FROM brands WHERE Name ='$namebrand'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) == 0) {
                    $addbrand = "INSERT INTO brands(ID_Brand, Name) VALUES ('$idbrand','$namebrand')";
                    $resultaddbrand = mysqli_query($conn, $addbrand);
                    $message['key'] = "Thêm thành công";
                }
                else 
                $message['key'] = "Trùng tên nhãn hàng";
            }
        }  else 
        $message['key'] = "Trùng mã nhãn hàng";
    }
}

echo json_encode($message) ;
?>
