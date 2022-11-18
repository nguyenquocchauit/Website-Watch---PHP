<?php
require '../config/connectDB.php';


$brand = "SELECT ID_Brand , Name  FROM brands ";
$resultbrand = mysqli_query($conn, $brand);
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
  <title>TC WATCH - Danh sách nhãn hàng</title>
</head>

<body>
    <?php
    // thêm file navbar menu
    include "../header_footer/header.php";
    ?>
    <div class="listbrand mt-5 mb-5">
        <div class="container">
        <table>
            <tr>
                <td colspan="3" class="text-center tr0"><h3>Danh sách nhãn hàng</h3></td>
            </tr>
            <tr>
                <td colspan="3" class="td1"><button type='submit'><a href="./addbrand.php"><i class="fa fa-circle-plus"></i>Thêm nhãn hàng</a></button></td>
            </tr>
            <tr class="tr1">
                <td>Mã nhãn hàng</td>
                <td>Tên nhãn hàng</td>
                <td>Chức năng</td>
            </tr>
            <?php while ($rowBrand = mysqli_fetch_array($resultbrand)) :   ?>
                <?php
                    $idbrand = $rowBrand['ID_Brand'];
                    $namebrand =$rowBrand['Name'];
                
                echo" <tr>
                <td>$idbrand</td>
                <td>$namebrand</td>
                <td>
                    <button type='submit'><a href='./edit_delete.php?id=$idbrand'><i class='fa-solid fa-pen-to-square'></i></a></button>
                    <button type='submit'><a href='./edit_delete.php?id=$idbrand'><i class='fa-solid fa-trash-can'></i></a></button>
                </td>
            </tr>";
            ?>
            <?php endwhile; ?>
        </table>
        </div>
    </div>
    <?php
    // thêm file footer
    include "../header_footer/footer.php";
    ?>
</body>
</html>