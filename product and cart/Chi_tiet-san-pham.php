<?php
// kết nối cơ sở dữ liệu db_watch
require '../config/connectDB.php';
session_start();
// kết nối cơ sở dữ liệu db_watch
require '../config/connectDB.php';
// nếu get gender,id,brand không có thì không truy cập được trang, sẽ quay về shop.php
if (isset($_GET["gender"]) == false || isset($_GET["brand"]) == false || isset($_GET["id"]) == false) {
    header('Location: shop.php');
}
if (isset($_GET["gender"]) == true) {
    $idgender = $_GET['gender'];
} else {
    $idgender = '';
}

if (isset($_GET["brand"]) == true) {
    $idbrand = $_GET['brand'];
} else {
    $idbrand = '';
}
if (isset($_GET["id"]) == true) {
    $idproduct = $_GET['id'];
} else {
    $idproduct = '';
}
// xử lý lấy đường dẫn đúng theo gender và brand truy xuất ảnh 
$genderlink = null;
$brandlink = null;
$idlink = null;
switch ($idgender) {
    case "IDM":
        $genderlink = "Men";
        break;
    case "IDWM":
        $genderlink = "Women";
        break;
}
switch ($idbrand) {
    case "Avia":
        $brandlink = "aviator";
        break;
    case "Baby":
        $brandlink = "baby-g";
        break;
    case "Bentley":
        $brandlink = "bentley";
        break;
    case "Citizen":
        $brandlink = "citizen";
        break;
    case "Olym":
        $brandlink = "olym-pianus";
        break;
    case "Shock":
        $brandlink = "g-shock";
        break;
}
// lấy sản phẩm
$queryDetail = "SELECT * FROM `products` WHERE 1 and ID_Brand='$idbrand' AND ID_Gender='$idgender' AND ID_Product='$idproduct'";
$resultDetail = mysqli_query($conn, $queryDetail);
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
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <title>TC WATCH - Chi tiết sản phẩm</title>
</head>

<body>

    <div class="body-product-details">
        <?php
        // thêm file navbar menu
        include "../header_footer/header.php";
        ?>
        <div class="bodydetail mt-5 mb-4">
            <div class="container">
                <?php if (mysqli_num_rows($resultDetail) != 0) : $rowDetail = mysqli_fetch_array($resultDetail) ?>
                    <div class="row">
                        <div class="col-6">
                            <table>
                                <tr>
                                    <td colspan="4">
                                        <div class="slide">
                                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                                                <div class="carousel-indicators">
                                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active btnslide" aria-current="true" aria-label="Slide 1"></button>
                                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="btnslide" aria-label="Slide 2"></button>
                                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class="btnslide" aria-label="Slide 3"></button>
                                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" class="btnslide" aria-label="Slide 4"></button>
                                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" class="btnslide" aria-label="Slide 5"></button>
                                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" class="btnslide" aria-label="Slide 6"></button>
                                                </div>
                                                <div class="carousel-inner">
                                                    <?php $i = 0;
                                                    $active = true;
                                                    while ($i <= 5) : ?>
                                                        <div class="carousel-item <?php echo ($active == true) ? "active" : "" ?>">
                                                            <!-- lấy ảnh đầu tiên trong db đúng đường theo folder sản phẩm, còn lại 5 ảnh khác dùng chung ảnh cat.gif (vì dung lượng ảnh lớn nên cắt bớt) -->
                                                            <img src="../img<?php if($i==0) echo "/images/".$genderlink . "/" . $brandlink;?>/<?php $img1 = explode(",", $rowDetail['Image']);
                                                                                                                                                        echo $img1[$i] ?>" class="d-block w-100" alt="...">
                                                        </div>
                                                    <?php $i++;
                                                        $active = false;
                                                    endwhile; ?>
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                                    <span class="glyphicon carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                                    <span class="glyphicon  carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tr>
                            </table>
                        </div>
                        <div class="col-6">
                            <h3><?php echo $rowDetail['Name'] ?></h3>
                            <div class="price d-flex " style="font-size: 20px;" <?php if ($rowDetail['Discount'] == 0) echo 'style=" justify-content: start; margin: 0px; font-size: 20px;"'; ?>>

                                <?php if ($rowDetail['Discount'] != 0) : ?>
                                    <p class="price-pre">
                                        <!-- number_format dùng định dạng số theo kiểu đơn vị tiền tệ -->
                                        <?php echo number_format($rowDetail['Price']) . " VNĐ" ?>
                                    </p>
                                <?php endif; ?>
                                <p style="color: red;font-size: 20px;">
                                    <!-- xử lý in giá bán sau khi áp dụng giảm giá -->
                                    <?php
                                    $price = $rowDetail['Price'];
                                    $price = $price - ($price * $rowDetail['Discount']);
                                    echo number_format($price) . " VNĐ";
                                    ?>
                                </p>
                                <div class="sale" <?php if ($rowDetail['Discount'] == 0) echo 'style="opacity:0;"'; ?>>
                                    <!-- đổi số thập phân sang dạng phần trăm -->
                                    <?php $discount = $rowDetail['Discount'];
                                    $percent = round((float)$discount * 100) . '%';
                                    echo "-" . $percent;
                                    ?>
                                </div>
                            </div>
                            <h4>Giới thiệu:</h4>
                            <div>
                                <p><?php echo ($rowDetail['Description']) ?></p>
                            </div>
                            <div class="d-flex ">
                                <div class="">
                                    <form action="Gio-Hang.php" method="post">
                                        <button type="submit" class="btn btn-light detail-add-to-cart" name="add-to-cart"><i class="fa-solid fa-cart-plus"></i> Đặt mua</button>
                                        <input type="hidden" name="action" class="action" value="additems"></input>
                                        <input type="hidden" name="productID" class="productID" value="<?php echo $rowDetail['ID_Product'] ?>"></input>
                                        <input type="hidden" name="productQuantity" class="productQuantity" value="1"></input>
                                        <input type="hidden" name="productName" class="productName" value="<?php echo $rowDetail['Name'] ?>"></input>
                                        <input type="hidden" name="productPrice" class="productPrice" value="<?php
                                                                                                                $price = $rowDetail['Price'];
                                                                                                                $price = $price - ($price * $rowDetail['Discount']);
                                                                                                                echo ($price);
                                                                                                                ?>"></input>
                                        <input type="hidden" name="productImage" class="productImage" value="<?php $img1 = explode(",", $rowDetail['Image']);
                                                                                                                echo $img1[0] ?>"></input>
                                    </form>
                                </div>
                            </div>
                            <div class="mt-5">
                                <h3>Thanh toán</h3>
                                <table>
                                    <tr>
                                        <td><img class="imgpay" src="../img/logo-techcombank.jpg" alt=""></td>
                                        <td><img class="imgpay" src="../img/logo-paypal.jpg" alt="" srcset=""></td>
                                        <td><img class="imgpay" src="../img/logo-techcombank.jpg" alt="" srcset=""></td>
                                    </tr>
                                    <tr>
                                        <td><img class="imgpay" src="../img/logo-vcb.jpg" alt=""></td>
                                        <td><img class="imgpay" src="../img/logo-techcombank.jpg" alt="" srcset=""></td>
                                        <td><img class="imgpay" src="../img/logo-mastercard.jpg" alt=""></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
        // thêm file footer
        include "../header_footer/footer.php";
        ?>
    </div>
</body>

</html>