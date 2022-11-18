<?php
// kết nối cơ sở dữ liệu db_watch
require '../config/connectDB.php';
session_start();
// if đầu tiên kiểm tra $_SESSION['CurrentUser'] nếu không tồn tại thì role và id = null và ngược lại gán cho $Role và $ID dùng truy vấn
if ((isset($_SESSION['CurrentUser']['ID'])) && (isset($_SESSION['CurrentUser']['Role']))) {
    $Role = $_SESSION['CurrentUser']['Role'];
    $ID = $_SESSION['CurrentUser']['ID'];
} else {
    $Role = null;
    $ID = null;
}
$queryHistoryOrder = "SELECT a.Create_At,c.Name,a.Quantity,a.Price,a.Total as Total_OrderDetail,c.Image FROM `order_details` a inner JOIN orders b on a.ID_Order=b.ID_Order INNER JOIN products c on a.ID_Product=c.ID_Product WHERE 1 and b.ID_Customer='$ID'";
$resultHistoryOrder = mysqli_query($conn, $queryHistoryOrder);
$total = 0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../thuvienweb/bootstrap-5.2.0-beta1-dist/bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css and javascript/style.css">
    <script src="../thuvienweb/bootstrap-5.2.0-beta1-dist/bootstrap-5.2.0-beta1-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../thuvienweb/fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="../thuvienweb/fontawesome-free-6.1.2-web/css/all.min.css">
    <script src="../thuvienweb/fontawesome-free-6.1.2-web/js/all.min.js"></script>
    <script src="../thuvienweb/fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/js/all.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- thư viện sweet aler  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>TC Watch - Lịch sử giỏ hàng</title>
</head>

<body>
    <div class="body-product-cart">
        <?php
        // thêm file navbar menu
        include "../header_footer/header.php";
        ?>
        <div class="body-cart mt-5" <?php if (mysqli_num_rows($resultHistoryOrder) == 0) echo 'style="display: none;"'; ?>>
            <div class="container-fluid">
                <div class="row">
                    <div class="row pb-3"><strong class=" d-flex justify-content-center" style="font-size: 30px; font-family: 'Oswald', sans-serif;">LỊCH SỬ MUA HÀNG</strong></div>
                    <div class="col cart">
                        <table>
                            <thead>
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
                                        <p>Thời gian</p>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($row = mysqli_fetch_array($resultHistoryOrder)) : ?>
                                    <tr>
                                        <td>
                                            <?php echo $i ?>
                                        </td>
                                        <td style="width: 8%;">
                                            <div class="divimg"><img src="..//img/image_products_home/<?php $img1 = explode(",", $row['Image']);
                                                                                                        echo $img1[0] ?>" alt="" srcset=""></div>
                                        </td>
                                        <td style="width: 26%;"><span><?php echo $row['Name'] ?></span></td>
                                        <td>
                                            <p><?php echo number_format($row['Price']) . " VNĐ"; ?></p>
                                        </td>
                                        <td>
                                            <?php echo $row['Quantity'] ?>
                                        </td>
                                        <td>
                                            <p><?php echo number_format($row['Total_OrderDetail']) . " VNĐ";
                                                $total += $row['Total_OrderDetail']; ?></p>
                                        </td>
                                        <td>
                                            <?php echo date("d-m-Y", strtotime($row['Create_At'])); ?>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endwhile; ?>
                                <tr>
                                    <td style="text-align: start;" colspan="4">
                                        <a href="shop.php"><button type="button" class="buttonBack"><i class="fa-solid fa-arrow-left" id="iconback"></i>Tiếp tục xem sản phẩm</button></a>
                                    </td>
                                    <td style="text-align: end;" colspan="3">
                                        <strong>Tổng tiền</strong> <strong style="color: red;"> <?php echo number_format($total) . " VNĐ"; ?></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="message-history-cart" <?php if (mysqli_num_rows($resultHistoryOrder) == 0) echo 'style="display: block;"';
                                            else echo 'style="display: none;"'; ?>>
            <div class="row pb-3"><strong class=" d-flex justify-content-center" style="font-size: 30px; font-family: 'Oswald', sans-serif;">LỊCH SỬ ĐẶT HÀNG CỦA BẠN</strong></div>
            <img id='imgcart' src='../img/cat.gif' alt=''>
            <h4 id='mesag-cart'>
                <p>Lịch sử đặt hàng hiện tại trống, quay lại trang shop đặt hàng ngày nào!</p>
            </h4>
            <a href='shop.php' id='back-to-shop'><button type='button' class='buttonBack'><i class='fa-solid fa-arrow-left' id='iconback'></i>Tiếp tục xem sản phẩm</button></a>
        </div>
        <?php
        // thêm file footer
        include "../header_footer/footer.php";
        ?>
    </div>
</body>

</html>