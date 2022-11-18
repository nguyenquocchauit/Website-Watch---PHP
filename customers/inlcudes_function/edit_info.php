<?php
require '../../config/connectDB.php';
$array_message = array();
/*
    message = 0 : thành công
    message = -1 : không xãy ra lỗi
    password = 1 : mật khẩu không chính xác đối với user đang thực hiện thao tác
    email = 1 : email đã tồn tại trong db
    username = 1 : tên đăng nhập đã tồn tại trong db
    
*/
if (
    isset($_POST['IDCustomer']) && isset($_POST['CreateAt']) && isset($_POST['FullName']) &&
    isset($_POST['Phone']) && isset($_POST['Email']) &&  isset($_POST['Action']) &&
    isset($_POST['Address']) && isset($_POST['UserName']) && isset($_POST['PassWord']) && isset($_POST['ChangePassWord'])
) {
    $Action = $_POST['Action'];
    $IDCustomer = $_POST['IDCustomer'];
    $CreateAt = $_POST['CreateAt'];
    $FullName = $_POST['FullName'];
    $Phone = $_POST['Phone'];
    $Email = $_POST['Email'];
    $Address = $_POST['Address'];
    $UserName = $_POST['UserName'];
    $PassWord = $_POST['PassWord'];
    $ChangePassWord = $_POST['ChangePassWord'];

    $array_message['message'] = null;
    // kiểm tra xem đúng mật khẩu của user đó chưa
    $sql = "SELECT * FROM `customers` WHERE Password='$PassWord'";
    $result = mysqli_query($conn, $sql);
    // nếu trả về == 0 tức là mật khẩu không chính xác với user đang thực hiện hành động action
    if (mysqli_num_rows($result) == 0)
        $array_message['password'] = 1;
    else {
        if ($Action == 'changeEmail') {
            //kiểm tra xem email của user thực hiện thay đổi có trùng trong db không
            /*
            true : là tồn tại
            false : không tồn tại
        */
            if (checkEmail($Email, $conn))
                $array_message['email'] = 1;
            else
                $array_message['message'] = -1;
        } else {
            if ($Action == 'changeUserName') {
                //kiểm tra xem email của user thực hiện thay đổi có trùng trong db không
                /*
            true : là tồn tại
            false : không tồn tại
        */
                if (checkUserName($UserName, $conn))
                    $array_message['username'] = 1;
                else
                    $array_message['message'] = -1;
            } else {
                if ($Action == 'changeEmail_UserName') {
                    // kiểm tra email và username có trùng trong db không
                    /*
                    true : là tồn tại
                    false : không tồn tại
                */
                    if (!(checkUserName($UserName, $conn)) && !(checkEmail($Email, $conn)))
                        $array_message['message'] = -1;
                    else {
                        if (checkUserName($UserName, $conn))
                            $array_message['username'] = 1;
                        if (checkEmail($Email, $conn))
                            $array_message['email'] = 1;
                    }
                }
            }
        }
    }
    if($Action == 'none') $array_message['message'] = -1;
    if ($array_message['message'] == -1) {
        if ($ChangePassWord != null)
            $PassWord = $ChangePassWord;

        // xử lý tách FULL NAME thành 2 phần last name và first name
        $FullName = explode(" ", $FullName);
        $last_name = $FullName[(sizeof($FullName) - 1)];
        $first_name = null;
        for ($i = 0; $i < (sizeof($FullName) - 1); $i++) {
            $first_name .= $FullName[$i] . " ";
        }
        // loại bỏ khoảng trắng cuối cùng trong chuỗi
        $first_name = trim($first_name);
        // // thao tác cập nhật
        $sql = "UPDATE `customers` SET `First_Name`='$first_name',`Last_Name`='$last_name',`Phone`='$Phone'
        ,`Email`='$Email',`UserName`='$UserName',`Password`='$PassWord',`Address`='$Address'
        ,`Create_At`='$CreateAt',`ID_Role`='User' WHERE 1 and ID_Customer='$IDCustomer'";
        $result = mysqli_query($conn, $sql);
        $array_message['message'] = 0;
    }
}
echo json_encode($array_message);

function checkEmail($email, $conn)
{
    /*
        true : là tồn tại
        false : không tồn tại
    */
    $sql = "SELECT * FROM `customers` WHERE Email='$email'";
    $result = mysqli_query($conn, $sql);
    // nếu trả về == 0 tức là email không tồn tại trong hệ thống => thay đổi được
    if (mysqli_num_rows($result) != 0)
        return true;
    else
        return false;
}
function checkUserName($UserName, $conn)
{
    /*
        true : là tồn tại
        false : không tồn tại
    */
    $sql = "SELECT * FROM `customers` WHERE UserName='$UserName'";
    $result = mysqli_query($conn, $sql);
    // nếu trả về == 0 tức là username không tồn tại trong hệ thống => thay đổi được
    if (mysqli_num_rows($result) != 0)
        return true;
    else
        return false;
}
