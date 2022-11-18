<?php
//session_start();
$array_message = array();
// kết nối cơ sở dữ liệu db_watch
require '../../config/connectDB.php';
include "auto_idorder.php";

/*
    message : 0 //Thêm thành công
    message : 1 //Khách hàng chưa cập nhật địa chỉ
*/
$array_message['message'] = null;
if (isset($_POST['ID_Customer']) && isset($_POST['Create_At']) && isset($_POST['Total'])) {

    $ID_Customer = $_POST['ID_Customer'];
    $Create_At = $_POST['Create_At'];
    $Total_Order = $_POST['Total'];

    $sql = "SELECT customers.Address FROM `customers` WHERE 1 and ID_Customer='$ID_Customer'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if ($row['Address'] == null)
        $array_message['message'] = 1;
    else {
        // kiểm tra khách hàng đã tạo hóa đơn trước đó chưa
        $sql = "SELECT  * FROM `orders` WHERE 1 AND ID_Customer='$ID_Customer'";
        $results = mysqli_query($conn, $sql);
        // kiểm tra đã tồn tại chưa
        if (mysqli_num_rows($results) != 0) {
            $row = mysqli_fetch_array($results);
            $totalOld = $row['Total'];
            $Total_Order = $Total_Order + $totalOld;

            // cập nhật tổng tiền của khách hàng trong bảng order
            $sql = "UPDATE orders SET Total='$Total_Order' WHERE ID_Customer='$ID_Customer'";
            $result = mysqli_query($conn, $sql);

            // thêm chi tiết sản phẩm vào trong order_details
            $ID_Order = $row['ID_Order']; // $row['ID_Order'] lấy lại từ bảng order khi khách hàng đã có order trước đó

            // cập nhật tổng tiền của khách hàng thành công vào bảng order thì tiếp tục thêm order_detail
            if ($result) {
                //sử dụng vòng lặp duyệt tất cả các sản phẩm có trong session[cart] thêm vào database
                for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {

                    // gọi file auto_iddetail.php tăng tự động mã iddetail mỗi vòng lặp
                    include "auto_iddetail.php";
                    $ID_Product = $_SESSION['cart'][$i][0];
                    $Quantity = $_SESSION['cart'][$i][4];
                    $Price = $_SESSION['cart'][$i][3];

                    // tính giá tổng của sp
                    $Total_Product = $Price * $Quantity;

                    // truy vấn thêm vào db
                    $sql = "INSERT INTO `order_details`(`ID_Detail`, `ID_Order`, `ID_Product`, `Create_At`, `Quantity`, `Price`, `Total`) 
            VALUES ('$ID_Detail','$ID_Order','$ID_Product','$Create_At','$Quantity','$Price','$Total_Product')";
                    $result = mysqli_query($conn, $sql);
                    // xử lý thấy message để xử lý ajax bên file product_cart 
                    $array_message['message'] = 0;
                    $array_message['success'] = 'home.php';
                }

                // thêm xong xóa giỏ hàng session[cart]
                unset($_SESSION['cart']);
            }
        }
        // // nếu khách hàng chưa đặt đơn hàng trước đó. Khởi tạo order mới chứa mã khách hàng
        else {
            // truy vấn thêm vào db order
            // gọi file auto_idorder.php lấy mã id tăng tự động. sử dụng 1 lần
            include_once "auto_iddetail.php";
            $sql = "INSERT INTO `orders`(`ID_Order`, `ID_Customer`, `Create_At`, `Total`) 
            VALUES ('$ID_Order','$ID_Customer','$Create_At','$Total_Order')";
            $result = mysqli_query($conn, $sql);

            // thêm khách hàng thành công vào bảng order thì tiếp tục thêm order_detail
            if ($result) {
                // truy vấn thêm vào db order_detail
                //sử dụng vòng lặp duyệt tất cả các sản phẩm có trong session[cart] thêm vào database
                for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {

                    // gọi file auto_iddetail.php tăng tự động mã iddetail mỗi vòng lặp
                    include "auto_iddetail.php";
                    $ID_Product = $_SESSION['cart'][$i][0];
                    $Quantity = $_SESSION['cart'][$i][4];
                    $Price = $_SESSION['cart'][$i][3];

                    // tính giá tổng của sp
                    $Total_Product = $Price * $Quantity;

                    // truy vấn thêm vào db
                    $sql = "INSERT INTO `order_details`(`ID_Detail`, `ID_Order`, `ID_Product`, `Create_At`, `Quantity`, `Price`, `Total`) 
                    VALUES ('$ID_Detail','$ID_Order','$ID_Product','$Create_At','$Quantity','$Price','$Total_Product')";
                    $result = mysqli_query($conn, $sql);
                    // xử lý thấy message để xử lý ajax bên file product_cart 
                    $array_message['message'] = 0;
                    $array_message['success'] = 'home.php';
                }

                // thêm xong xóa giỏ hàng session[cart]
                unset($_SESSION['cart']);
            }
        }
    }
}
echo json_encode($array_message);
