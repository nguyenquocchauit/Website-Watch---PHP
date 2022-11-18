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
  <div class="body-contact">
    <div class="container">
      <div class="row">
        <div class="col-6 map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3898.707073357618!2d109.19986871425763!3d12.268091533244315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317067ed31eaa10f%3A0x51786d55cd9a91c9!2zMDIgTmd1eeG7hW4gxJDDrG5oIENoaeG7g3UsIFbEqW5oIFRo4buNLCBOaGEgVHJhbmcsIEtow6FuaCBIw7JhIDY1MDAwMCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1666525466307!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-6 content-contact">
          <div class="form-contact mt-5">
            <form action="sendmail.php" method="post">
              <h3>Liên hệ với chúng tôi</h3>
              <table>
                <tr>
                  <td><input type="text" placeholder="Họ và tên" name="name"></td>
                  <td><input type="text" placeholder="Email" name="email"></td>
                </tr>
                <tr>
                  <td> <input type="text" placeholder="Số điện thoại" name="phone"></td>
                  <td> <input type="text" placeholder="Địa chỉ" name="add"></td>
                </tr>
                <tr>
                  <td colspan="2">
                    <textarea rows="5" cols="82" placeholder="Lời nhắn ..." name="content"></textarea>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div class="d-flex justify-content-center">
                      <button type="submit" name="send">Gửi góp ý</button>
                    </div>
                  </td>
                </tr>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <img src="../product and cart/shop.php" alt="">
  <?php
  // thêm file footer
  include "../header_footer/footer.php";
  ?>

</body>

</html>