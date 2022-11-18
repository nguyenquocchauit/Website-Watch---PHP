<?php
session_start();
// kết nối cơ sở dữ liệu db_watch
require '../config/connectDB.php';
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
  <title>TC WATCH - Liên hệ</title>
</head>

<body>
  <?php
  // thêm file navbar menu
  include "../header_footer/header.php";
  ?>
  <div class="body-contact-tb ">
    <div class="container">
      <div class="row">
        <div class="col-2"></div>
        <div class="col-4">
          <img src="../img/cat.gif" alt="" srcset="">
        </div>
        <div class="col-5">
          <div class="mt-5">
            <h4 >Gửi mail thành công !</h4>
            <h5>Xin chờ phản hồi trong giây lát . Xin cảm ơn !</h5>
          </div>
          <div class="mt-5">
            <a href="./contact.php">Quay lại</a>
          </div>
        </div>
        <div class="col-1"></div>
      </div>
    </div>
  </div>
  <?php
  // thêm file footer
  include "../header_footer/footer.php";
  ?>

</body>
</html>