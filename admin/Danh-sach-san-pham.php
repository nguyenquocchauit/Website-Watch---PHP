<?php
session_start();
if (isset($_SESSION['CurrentUser']['Role']) == false || $_SESSION['CurrentUser']['Role'] == "User") {
    header('Location: ../../home.php');
    exit();
}
// kết nối cơ sở dữ liệu db_watch
require '../config/connectDB.php';
include 'inlcudes_function/list-products.php';

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
    <script src="../css and javascript/choose_gender_brand.js"></script>
    <script src="../css and javascript/update_delete_product.js"></script>
    <script src="../thuvienweb/bootstrap-5.2.0-beta1-dist/bootstrap-5.2.0-beta1-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../thuvienweb/fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="../thuvienweb/fontawesome-free-6.1.2-web/css/all.min.css">
    <script src="../thuvienweb/fontawesome-free-6.1.2-web/js/all.min.js"></script>
    <script src="../thuvienweb/fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/js/all.min.js"></script>

    <!-- thư viện sweet aler  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>TC WATCH - Danh sách sản phẩm</title>
</head>

<body>
    <?php
    // thêm file navbar menu
    include "../header_footer/header.php";
    ?>
    <div class="body-list-products">
        <div class="header mt-2">
            <h4>Danh sách sản phẩm</h4>
        </div>
        <div class="btn-group float-end mb-1" role="group" aria-label="Basic mixed styles example">
            <button type="button " class="btn btn-danger ">Hết sản phẩm</button>
            <button type="button " class="btn btn-success">Đang giảm giá</button>
        </div>
        <table class="table mt-3">
            <thead class="table-dark">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Mã sản phẩm</th>
                    <th scope="col" style="width: 15%;">Tên</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col" style="width: 7%;">Số lượng kho</th>
                    <th scope="col">Giá niêm yết</th>
                    <th scope="col" style="width: 5%;">Giảm giá</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Ngày chỉnh sửa</th>
                    <th scope="col" style="width: 5%;">
                        <select class="form-select form-select-lg form-select-brand" id="brand" aria-label=".form-select-lg example">
                            <option value="brand" selected>Hãng </option></a>
                            <?php if (mysqli_num_rows($resultBrand)) while ($rowBrand = mysqli_fetch_array($resultBrand)) : ?>
                                <option value="<?php echo $rowBrand['ID_Brand'] ?>" <?php if ($rowBrand['ID_Brand'] == $idbrand) echo "selected"; ?>> <?php echo $rowBrand['Name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </th>
                    <th scope="col" style="width: 8%;">
                        <select class="form-select form-select-lg form-select-gender" id="gender" aria-label=".form-select-lg example">
                            <option value="type" selected>Loại</option>
                            <?php if (mysqli_num_rows($resultGender)) while ($rowGender = mysqli_fetch_array($resultGender)) : ?>
                                <option value="<?php echo $rowGender['ID_Gender'] ?>" <?php if ($rowGender['ID_Gender'] == $idgender) echo "selected"; ?>> <?php echo $rowGender['Name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </th>
                    <th scope="col" style="width: 2%;">Sửa</th>
                    <th scope="col" style="width: 2%;">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if (mysqli_num_rows($result)) while ($row = mysqli_fetch_array($result)) : ?>
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><a href="Chi-tiet_san-pham.php?idpro=<?php echo $row['ID_Product']; ?>"><?php echo $row['ID_Product']; ?></a></td>
                        <td><?php echo $row['Name_Product']; ?></td>
                        <td><img class="img" src="../img/image_products_home/<?php $img1 = explode(",", $row['Image']);
                                                                                echo $img1[0]; ?>" alt=""></td>
                        <td class="<?php if ($row['Quantity'] == 0) echo 'table-danger'; ?>"><?php echo $row['Quantity']; ?></td>
                        <td><?php echo number_format($row['Price']) . " VNĐ"; ?></td>
                        <td class="<?php if ($row['Discount'] != 0) echo 'table-success' ?>"><?php $discount = $row['Discount'];
                                                                                                $percent = round((float)$discount * 100) . '%';
                                                                                                echo $percent ?></td>
                        <td><?php echo date("d-m-Y", strtotime($row['Create_At'])); ?></td>
                        <td><?php echo date("d-m-Y", strtotime($row['Update_At'])); ?></td>
                        <td><?php echo $row['Name_Brand']; ?></td>
                        <td><?php echo $row['Name_Gender']; ?></td>
                        <td><a href="Chi-tiet_san-pham.php?idpro=<?php echo $row['ID_Product']; ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td class="delete-submit">
                            <a class="delete-product" href="#"><i class="fa-solid fa-trash"></i></a>
                            <input type="hidden" class="inp_ID" name="" value="<?php echo $row['ID_Product']; ?>">
                        </td>
                    </tr>
                <?php $i++;
                endwhile; ?>
            </tbody>
        </table>
        <div class="pagination modal-2 mb-2">
            <?php
            if ($total_page > 1) {
                // BƯỚC 7: HIỂN THỊ PHÂN TRANG
                // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
                if ($current_page > 1 && $total_page > 1) {
                    echo '<a href="Danh-sach-san-pham.php?brand=' . ($idbrand) . '&gender=' . ($idgender) . '&page=' . (1) . '"> &laquo; </a>  ';
                    echo '<a href="Danh-sach-san-pham.php?brand=' . ($idbrand) . '&gender=' . ($idgender) . '&page=' . ($current_page - 1) . '"> &lt; </a>  ';
                }
                // Lặp khoảng giữa
                for ($i = 1; $i <= $total_page; $i++) {
                    // Nếu là trang hiện tại thì hiển thị thẻ span
                    // ngược lại hiển thị thẻ a
                    if ($i == $current_page) {
                        echo '<a>' . $i . '</a>  ';
                    } else {
                        echo '<a href="Danh-sach-san-pham.php?brand=' . ($idbrand) . '&gender=' . ($idgender) . '&page=' . $i . '">' . $i . '</a>  ';
                    }
                }
                // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
                if ($current_page < $total_page && $total_page > 1) {
                    echo '<a href="Danh-sach-san-pham.php?brand=' . ($idbrand) . '&gender=' . ($idgender) . '&page=' . ($current_page + 1) . '"> &gt; </a>  ';
                    echo '<a href="Danh-sach-san-pham.php?brand=' . ($idbrand) . '&gender=' . ($idgender) . '&page=' . ($total_page) . '"> &raquo; </a>  ';
                }
            }
            ?>
        </div>
        <!-- lưu 2 giá trị của id brand và id gender dùng để truy vấn theo hãng hoặc giới tính -->
        <input type="hidden" name="" id="inp-id-brand" value="<?php echo $idbrand ?>">
        <input type="hidden" name="" id="inp-id-gender" value="<?php echo $idgender ?>">
    </div>
    <?php
    // thêm file footer
    include "../header_footer/footer.php";
    ?>
</body>

</html>