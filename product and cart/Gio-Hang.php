<?php
require '../config/connectDB.php';
include "inlcudes_function/product_cart.php";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- thư viện sweet aler  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>TC WATCH - Giỏ hàng</title>
</head>

<body>
    <?php
    // thêm file navbar menu
    include "../header_footer/header.php";
    ?>
    <div class="body-product-cart">
        <div class="body-cart mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="row pb-3"><strong class=" d-flex justify-content-center" style="font-size: 30px; font-family: 'Oswald', sans-serif;">GIỎ HÀNG CỦA BẠN</strong></div>
                    <div class="col cart">
                        <?php Show_Cart(); ?>
                        <?php echo $message_cart ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    // thêm file footer
    include "../header_footer/footer.php";
    ?>
    <script type="text/javascript" src="../css and javascript/up_down_button.js"></script>
    <script type="text/javascript" src="../css and javascript/buy_button.js"></script>
</body>

</html>