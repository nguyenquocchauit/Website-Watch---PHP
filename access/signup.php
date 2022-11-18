<?php
require '../config/connectDB.php';
$array_message = array();
/*
    array_message['message'] = 0 : thêm thành công
    array_message['username'] = 1 : username đã tồn tại, =-1 là không tồn tại
    array_message['email'] = 2 : email đã tồn tại, =-1 là không tồn tại
    array_message['message'] = -1 : Check đúng. không xãy ra lỗi =1 hoặc = 2
*/

if (isset($_POST['name']) && isset($_POST['email']) &&  isset($_POST['phone']) &&  isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['create_at'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];
    $create_at = $_POST['create_at'];

    if (str_contains($email, '@') == true && str_contains($email, '.') == true) {
        // truy vấn tồn tại email trong db
        $sql = "SELECT * FROM customers WHERE Email='" . $email . "'";
        $result = mysqli_query($conn, $sql);
        // kiểm tra email đã tồn tại chưa
        if (mysqli_num_rows($result) == 0) {
            $array_message['email'] = -1;
            $array_message['message'] = -1;
        } else
            $array_message['email'] = 2; // đã tồn tại 
    }
    //Username k có khoảng trắng và có trùng không
    if ((str_contains($username, " ")) == false) {
        // truy vấn tồn tại username trong db
        $sql = "SELECT * FROM customers WHERE UserName='" . $username . "'";
        $result = mysqli_query($conn, $sql);
        // kiểm tra username đã tồn tại chưa
        if (mysqli_num_rows($result) == 0) {
            $array_message['message'] = -1;
            $array_message['username'] = -1;
        } else
            $array_message['username'] = 1; // đã tồn tại 
    }

    // kiểm tra user name và email không tồn tại thì hành động thêm
    if ($array_message['message'] == -1 && $array_message['email'] == -1 && $array_message['username'] == -1) {

        // xử lý tách name thành 2 phần last name và first name
        $name = explode(" ", $name);
        $last_name = $name[(sizeof($name) - 1)];
        $first_name = null;
        for ($i = 0; $i < (sizeof($name) - 1); $i++) {
            $first_name .= $name[$i] . " ";
        }
        // loại bỏ khoảng trắng cuối cùng trong chuỗi
        $first_name = trim($first_name);
        //thêm file lấy tự động mã khách hàng
        include_once "../customers/inlcudes_function/auto_idcustomer.php";

        $sql = " INSERT INTO customers(`ID_Customer`, `First_Name`, `Last_Name`, `Phone`, `Email`, `UserName`, `Password`, `Address`, `Create_At`, `ID_Role`)
        VALUES ('$ID_Customer','$first_name','$last_name','$phone','$email','$username','$pass','Nha Trang','$create_at','User')";
        $result = mysqli_query($conn, $sql);
        $array_message['message'] = 0;
        $array_message['success'] = 'home.php';
        //$array_message['message'] = $ID_Customer;
    }
}

echo json_encode($array_message);
