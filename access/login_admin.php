<?php
session_start();
// kết nối cơ sở dữ liệu db_watch
require '../config/connectDB.php';
$array_message = array();
/*
     message : 1 //Tài khoản không tồn tại
     message : 0 //Đăng nhập thành công
     message : -1 //Sai mật khẩu
     message : 2 // username tồn tại
    */
if (isset($_POST['username']) && isset($_POST['password'])) {
    $sqlUserName = null;
    // mysqli_real_escape_string loại bỏ cách ký tự đặc biệt 
    $_username = mysqli_real_escape_string($conn, $_POST['username']);
    // bỏ in hoa tất cả ký tự của tài khoản
    $_username = strtolower($_username);
    // kiểm tra username là email hay tên tài khoản (username)
    if (str_contains($_username, '@') == true && str_contains($_username, '.') == true) {
        $sql = "SELECT * FROM administration WHERE Email='" . $_username . "'";
        $result = mysqli_query($conn, $sql);
        // nếu trả về không tồn tại in ra thông báo và ngược lại gán thêm câu truy vấn username UserName
        if (mysqli_num_rows($result) == 0) {
            $array_message['message'] = 1;
        } else {
            $sqlUserName = "And Email='" . $_username . "'";
            $array_message['message'] = 2;
        }
    } else {
        // nếu tài khoản không chứa khoản trắng thì xử lý
        if ((str_contains($_username, " ")) == false) {

            // truy vấn tồn tại username trong db
            $sql = "SELECT * FROM administration WHERE UserName='" . $_username . "'";
            $result = mysqli_query($conn, $sql);
            // nếu trả không tồn tại in ra thông báo và ngược lại gán thêm câu truy vấn username Email
            if (mysqli_num_rows($result) == 0) {
                $array_message['message'] = 1;
            } else {
                $sqlUserName = "And UserName='" . $_username . "'";
                $array_message['message'] = 2;
            }
        }
    }
    // kiểm tra nếu $array_message['message']==1, tức là username sai thì sẽ không cần kiểm tra password nữa
    if (($array_message['message'] == 2)) {
         $_pass = mysqli_real_escape_string($conn, $_POST['password']);
        // // truy vấn lấy mã người dùng (sau này viết thêm phân quyền (role))
        $sqlLogin = "SELECT * FROM administration WHERE 1 $sqlUserName and Password='" . $_pass . "'";
        $result = mysqli_query($conn, $sqlLogin);
        if (mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_array($result);
            $_SESSION['CurrentUser'] = array(
                'ID' => $row['ID_Administration'],
                'Role' => $row['ID_Role'],
            );
            $array_message['message'] = 0;
            $array_message['success'] = "home.php";
        } else {
            // sai mật khẩu
            $array_message['message'] = -1;
        }
    }
}
echo json_encode($array_message);
