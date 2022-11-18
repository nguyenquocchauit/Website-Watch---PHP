<?php
require '../config/connectDB.php';

// if (isset($_POST['insert'])) 
// {
//     if(isset($_POST['idbrand']))
//     {
//         $idbrand = $_POST['idbrand'];

//         $sql = "SELECT * FROM brands WHERE ID_Brand='$idbrand'";
//         $result = mysqli_query($conn, $sql);
//         if (mysqli_num_rows($result) == 0) {
//             if(isset($_POST['namebrand']))
//             {
//                 $namebrand = $_POST['namebrand'];
//                 $sql = "SELECT * FROM brands WHERE Name ='$namebrand'";
//                 $result = mysqli_query($conn, $sql);
//                 if (mysqli_num_rows($result) == 0) {
//                     $addbrand = "INSERT INTO brands(ID_Brand, Name) VALUES ('$idbrand','$namebrand')";
//                     $resultaddbrand = mysqli_query($conn, $addbrand);
//                     echo"<script>
//                             alert('Thêm thành công');
//                         </script>";
//                 }
//                 else 
//                     echo"<script>
//                             alert('Trùng tên nhãn hàng');
//                         </script>";
//             }
//         }  else 
//             echo"<script>
//                     alert('Trùng mã nhãn hàng');
//                 </script>";
//     }
// }


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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../css and javascript/edit_delete_brand.js"></script>
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
            <div>
                <table>
                    <tr>
                        <td colspan="4">
                            <h4>Thêm nhãn hàng</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Mã nhãn hàng :</p>
                        </td>
                        <td><input type="text" name="idbrand" value="" class="form-control" id="idbrand" ></td>
                        <td>
                            <p>Tên nhãn hàng :</p>
                        </td>
                        <td><input type="text" name="namebrand" value="" class="form-control" id="namebrand" ></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <button type="submit" name="insert" class="btn btn-success" id="insert">Thêm <i class="fa-solid fa-plus"></i></button>
                            <button type="submit" name="back" class="btn btn-primary "><a href="./listbrand.php">Quay lại <i class="fa-solid fa-circle-chevron-left"></i></a></button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <?php
    // thêm file footer
    include "../header_footer/footer.php";
    ?>
</body>

</html>
