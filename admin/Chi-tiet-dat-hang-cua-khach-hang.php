<?php
session_start();
if ($_SESSION['CurrentUser']['Role'] == "User" && $_SESSION['CurrentUser']['Role'] != "Admin") {
   header('Location: ../../home.php');
   exit();
} else if (!isset($_GET['idorder']) || !isset($_GET['idcus'])) {
   header('Location: ../../home.php');
   exit();
}
require '../config/connectDB.php';
include 'inlcudes_function/list_order_detail.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <link rel="stylesheet" href="../thuvienweb/bootstrap-5.2.0-beta1-dist/bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="../css and javascript/style.css">
   <script src="../css and javascript/download_excel.js"></script>
   <script src="../thuvienweb/bootstrap-5.2.0-beta1-dist/bootstrap-5.2.0-beta1-dist/js/bootstrap.bundle.min.js"></script>
   <link rel="stylesheet" href="../thuvienweb/fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
   <link rel="stylesheet" href="../thuvienweb/fontawesome-free-6.1.2-web/css/all.min.css">
   <script src="../thuvienweb/fontawesome-free-6.1.2-web/js/all.min.js"></script>
   <script src="../thuvienweb/fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/js/all.min.js"></script>

   <!-- thư viện sweet aler  -->
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <title>TC Watch - Danh sách chi tiết đặt hàng</title>
</head>

<body>
   <?php
   // thêm file navbar menu
   include "../header_footer/header.php";
   ?>
   <div class="body-list-order-detail-customer">
      <div class="container-fluid pt-4">

         <?php
         if (isset($_GET['idorder']) && isset($_GET['idcus']))
            Show_List_Order_Detail($conn, $_GET['idorder'], $_GET['idcus']);
         ?>

      </div>
   </div>

   <?php
   // thêm file footer
   include "../header_footer/footer.php";
   ?>
</body>

</html>