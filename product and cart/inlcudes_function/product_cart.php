<?php
// kết nối cơ sở dữ liệu db_watch
//require '../../config/connectDB.php';
// khởi tạo session
session_start();
$array_message = array();
// nếu session[cart] không tồn tại thì khởi tạo
if (!isset($_SESSION['cart']))
    $_SESSION['cart'] = [];
else
    $array_message['quantity-cart'] = sizeof($_SESSION['cart']);

// nếu get[delcart] tồn tại và =1 thì session[cart] bằng rỗng. Tức xóa hết sản phẩm trong giỏ hàng
$message_cart = "";
if (isset($_GET['delcart']) && $_GET['delcart'] == 1) {
    unset($_SESSION['cart']);
    $message_cart = "
            <img id='imgcart' src='../img/cat.gif' alt=''>
            <h4 id='mesag-cart'><p>Giỏ hàng hiện tại trống, quay lại trang shop đặt hàng</p></h4>
            <a href='shop.php' id='back-to-shop'><button type='button' class='buttonBack'><i class='fa-solid fa-arrow-left' id='iconback'></i>Tiếp tục xem sản phẩm</button></a>
            ";
    header("Location: Gio-Hang.php");
    exit();
}

// nếu get[delid] tồn tại  session[cart] sẽ xóa sản phẩm thứ $i.
//array_splice(mãng,vị trí,số phần tử)
if (isset($_GET['delid']) && $_GET['delid'] >= 0) {
    array_splice($_SESSION['cart'], $_GET['delid'], 1);
    header("Location: Gio-Hang.php");
    exit();
}

// kiểm tra nút bấm thêm giỏ hàng 
if (isset($_POST['action']) && $_POST['action'] == "additems") {
    $image = $_POST['productImage'];
    $quantity = $_POST['productQuantity'];
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $ID = $_POST['productID'];

    // kiểm tra sản phẩm có trong giỏ hàng hay chưa?
    // $check kiểm tra có tìm được sản phẩm giỏ hàng hay không 
    // $check = 0 : không tìm thấy sản phẩm trùng
    // $check = 1 : Tìm thấy sản phẩm trùng

    $check = 0;
    for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i][0] == $ID) {
            $check = 1;

            // cập nhật số lượng
            $quantityNew = $quantity + $_SESSION['cart'][$i][4];

            // thêm lại vào giỏ hàng
            $_SESSION['cart'][$i][4] = $quantityNew;
            //thoát vòng lặp
            break;
        }
    }
    // $check = 0 không thấy sản phẩm trùng tiến hành thêm sản phẩm như bình thường
    if ($check == 0) {
        $product = [$ID, $name, $image, $price, $quantity];
        $_SESSION['cart'][] = $product;
    }
}
function Show_Cart()
{
    if (isset($_SESSION['cart']) && (is_array($_SESSION['cart']))) {
        // lấy thời gian hệ thống
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $timeNow = date("Y-m-d H:i:s");
        // kiểm tra người dùng đã đăng nhập hay chưa, nếu chưa thì không được đặt hàng
        if (isset($_SESSION['CurrentUser']['ID']) && isset($_SESSION['CurrentUser']['Role'])) {
            $CurrentUser =  $_SESSION['CurrentUser']['ID'];
            $IDUser = $_SESSION['CurrentUser']['Role'];
        } else {
            $CurrentUser = "null";
            $IDUser = "null";
        }
        // nếu giỏ hàng $_SESSION['cart']) tồn tại thì in ra
        if (sizeof($_SESSION['cart']) > 0) {
            $sum = 0;

            // in thẻ html table 
            echo '
            <table>
                <tr class="tr1">
                    <td>
                        <p>STT</p>
                    </td>
                    <td>
                        <p>Sản phẩm</p>
                    </td>
                    <td>
                        <p>Tên sản phẩm</p>
                    </td>
                    <td>
                        <p>Giá</p>
                    </td>
                    <td>
                        <p>Số lượng</p>
                    </td>
                    <td>
                        <p>Tổng</p>
                    </td>
                    <td>
                        <p>Xóa</p>
                    </td>
                </tr>
                <tbody>
            
            ';
            for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
                $name = $_SESSION['cart'][$i][1];
                $image = $_SESSION['cart'][$i][2];
                $price = $_SESSION['cart'][$i][3];
                $quanti = $_SESSION['cart'][$i][4];

                // kiểm tra không được đặt quá giới hạn là 5 sản phẩm và đặt lại số lượng giỏ hàng là 5 là tối đa
                if ($quanti >= 5) {
                    $quanti = 5;
                    $_SESSION['cart'][$i][4] = 5;
                }

                $total = $price * $quanti;
                $sum += $total;
                echo '
                <tr>
                    <td>
                        ' . ($i + 1) . '
                    </td>
                    <td style="width: 15%;">
                        <div class="divimg"><img src="../img/image_products_home/' . ($image) . '" alt="" srcset=""></div>
                    </td>
                    <td style="width: 26%;"><span>' . ($name) . '</span></td>
                    <td>
                        <p>' . (number_format($price)) . ' VNĐ</p>
                    </td>
                    <td>
                        <div class="quantity numbers-row">
                            <div class="row">
                                <div class="col-4 d-flex justify-content-end pt-1 asc"></div>
                                <div class="col-4 inpqan">
                                    <input type="text" class="form-control inpquantity" name="" id="" value="' . ($quanti) . '">
                                    <input type="hidden" name="" class="ID_Quantity" value="' . $i . '">
                                </div>
                                <div class="col-4 d-flex justify-content-start pt-1 desc"></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p>' . (number_format($total)) . ' VNĐ</p>
                    </td>
                    <td><a href="Gio-Hang.php?delid=' . ($i) . '"><i class="fa-regular fa-circle-xmark"></i></a></td>
                 </tr>
            ';
            }
            echo '
                    <tr class="tr1">
                        <td></td>
                        <td colspan="1">
                            <p>Tổng tiền</p>
                        </td>
                        <td colspan="5" style="text-align: end;color: red;">
                            <p>' . (number_format($sum)) . ' VNĐ</p>
                        </td>
                    </tr>
                    <tr class="tr1">
                        <td></td>
                        <td colspan="1">
                            <p>Giao hàng</p>
                        </td>
                        <td colspan="5" style="text-align: end;">
                            <p>Giao hàng miễn phí</p>
                        </td>
                    </tr>
                        <td></td>
                            <td style="text-align: end;">
                                <a href="shop.php"><button type="button" class="buttonBack"><i class="fa-solid fa-arrow-left" id="iconback"></i>Tiếp tục xem sản phẩm</button></a>
                            </td>
                            <td style="text-align: center;">
                                <a href="Gio-Hang.php?delcart=1"><button type="button" class="buttonDelete" ><i class="fa-solid fa-trash"></i> Xóa giỏ hàng</button></a>
                            </td>
                            <td colspan="4" style="text-align: end;">
                                <form action="" method="post" >
                                    <button type="button" class="buttonBuy" name="buttonBuy"><i class="fa-solid fa-pen-to-square"></i> Đặt hàng</button>
                                    <input type="hidden" class="CurrentUser" value="' . ($CurrentUser) . '">
                                    <input type="hidden" class="IDUser" value="' . ($IDUser) . '">
                                    <input type="hidden" class="timeNow" value="' . ($timeNow) . '">
                                    <input type="hidden" class="sum" value="' . ($sum) . '">
                                </form>
                            </td>
                    </tr>
                </tbody>
            </table>
        ';
        } else {
            echo "
            <img id='imgcart' src='../img/cat.gif' alt=''>
            <h4 id='mesag-cart'><p>Giỏ hàng hiện tại trống, quay lại trang shop đặt hàng</p></h4>
            <a href='shop.php' id='back-to-shop'><button type='button' class='buttonBack'><i class='fa-solid fa-arrow-left' id='iconback'></i>Tiếp tục xem sản phẩm</button></a>
            
            ";
        }
    }
}
?>