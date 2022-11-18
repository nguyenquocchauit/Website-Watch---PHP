<?php
session_start();
// kết nối cơ sở dữ liệu db_watch
require '../config/connectDB.php';


if (isset($_GET["gender"]) == true) {
    $idgender = $_GET['gender'];
    $genderlink  = $_GET['gender'];
} else {
    $idgender = '';
    $genderlink = '';
}

if (isset($_GET["brand"]) == true) {
    $idbrand = $_GET['brand'];
    $brandlink = $_GET['brand'];
} else {
    $idbrand = '';
    $brandlink = '';
}

if (($idbrand != null)) {
    $idbrand = "AND brands.ID_Brand = '$idbrand'";
}
if ($idgender != null) {
    $idgender = "AND gender.ID_Gender = '$idgender'";
}
// // select brand
$brand = "SELECT brands.Name, brands.ID_Brand 
FROM products JOIN brands ON products.ID_Brand = brands.ID_Brand 
JOIN gender ON products.ID_Gender = gender.ID_Gender 
WHERE 1 $idgender
GROUP by brands.name;
";
$resultbrand = mysqli_query($conn, $brand);

/// select product

$product = "SELECT DISTINCT gender.ID_Gender, brands.ID_Brand , products.Name as 'Name_Product',brands.Name as 'Name_Brand',products.ID_Product as ID_Product , Price , Image , Discount
FROM products JOIN brands ON products.ID_Brand = brands.ID_Brand
JOIN gender ON products.ID_Gender = gender.ID_Gender
WHERE 1 $idbrand  $idgender
 ";
$resultproduct = mysqli_query($conn, $product);
//////////////////
// BƯỚC 2: TÌM TỔNG SỐ RECORDS

$total_records = mysqli_num_rows($resultproduct);


// BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 4;

// BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
// tổng số trang
$total_page = ceil($total_records / $limit);

// Giới hạn current_page trong khoảng 1 đến total_page
if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}

// Tìm Start
$start = ($current_page - 1) * $limit;

// BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
// Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
$product =  "SELECT DISTINCT gender.ID_Gender, brands.ID_Brand , products.Name as 'Name_Product',brands.Name as 'Name_Brand',ID_Product, Price , Image , Discount
 FROM products JOIN brands ON products.ID_Brand = brands.ID_Brand
 JOIN gender ON products.ID_Gender = gender.ID_Gender
 WHERE 1 $idbrand  $idgender LIMIT $start, $limit";
$resultproduct = mysqli_query($conn, $product);
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


    <title>TC WATCH - Sản phẩm</title>
</head>

<body>
    <div class="header">
        <?php
        // thêm file navbar menu
        include "../header_footer/header.php";
        ?>
    </div>

    <div class="bodyshop d-flex">
        <div class="sidebar">
            <nav id="sidebarMenu" class="collapse d-lg-block sidebar sticky-top collapse bg-light">
                <div class="position-sticky">
                    <div class="list-group list-group-flush mx-3 mt-4">
                        <a href="" class="list-group-item list-group-item-action py-2 ripple title" aria-current="true">
                            <span>DANH MỤC SẢN PHẨM </span>
                        </a>
                        <?php while ($rowBrand = mysqli_fetch_array($resultbrand)) :
                            $active = "";
                            if ($brandlink == $rowBrand['ID_Brand'])
                                $active = "active";
                        ?>
                            <a class="list-group-item list-group-item-action py-2 ripple <?php echo $active ?> " href="shop.php?gender=<?php echo "$genderlink" ?>&brand=<?php echo $rowBrand['ID_Brand'] ?>&page=1">
                                <span> <?php echo $rowBrand['Name'] ?> </span>
                            </a>
                        <?php endwhile; ?>
                    </div>
                </div>
            </nav>
        </div>
        <div class="product-shop mt-5">
            <div class="item d-flex">
                <?php while ($rowProduct = mysqli_fetch_array($resultproduct)) :   ?>
                    <div class="prd mt-5">
                        <div class="sale" <?php if ($rowProduct['Discount'] == 0) echo 'style="opacity:0;"'; ?>>
                            <!-- đổi số thập phân sang dạng phần trăm -->
                            <?php
                            $discount = $rowProduct['Discount'];
                            $percent = round((float)$discount * 100) . '%';
                            echo "-" . $percent;
                            ?>
                        </div>
                        <div class="product product-item">
                            <div class="img product-item-img">
                                <img alt="" src="../img/image_products_home/<?php $img1 = explode(",", $rowProduct['Image']);
                                                                            echo $img1[0] ?>">
                            </div>
                            <div class="textleft product-item-desc">
                                <div class="name"><a href=""> <?php echo $rowProduct['Name_Product'] ?></a></div>
                                <div class="price d-flex" <?php if ($rowProduct['Discount'] == 0) echo 'style="justify-content: center;"'; ?>>
                                    <?php if ($rowProduct['Discount'] != 0) : ?>
                                        <p class="price-pre">
                                            <!-- number_format dùng định dạng số theo kiểu đơn vị tiền tệ -->
                                            <?php echo number_format($rowProduct['Price']) . " VNĐ" ?>
                                        </p>
                                    <?php endif; ?>
                                    <p>
                                        <!-- xử lý in giá bán sau khi áp dụng giảm giá -->
                                        <?php
                                        $price = $rowProduct['Price'];
                                        $price = $price - ($price * $discount);
                                        echo number_format($price) . " VNĐ";
                                        ?>
                                    </p>
                                </div>
                                <div class="product-item-desc-button-submit button-submit">
                                    <!-- kiểm tra nếu genderlink và brandlink trong href xem chi tiết bằng null. thì truy vấn từ id_product lấy ra genderlink và brandlink -->
                                    <a href="Chi_tiet-san-pham.php?gender=<?php if($genderlink=='') echo $rowProduct['ID_Gender']; else echo $genderlink ?>&brand=<?php if($brandlink=='') echo $rowProduct['ID_Brand']; else echo $brandlink ?>&id=<?php echo $rowProduct['ID_Product'] ?>"><button type="submit" class="btn btn-light watch-detail" name="watch-detail"><i class="fa-solid fa-eye"></i> Chi tiết </a></button>
                                    <button type="submit" class="btn btn-light add-to-cart" name="add-to-cart"><i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ</button>
                                    <input type="hidden" name="productID" class="productID" value="<?php echo $rowProduct['ID_Product'] ?>"></input>
                                    <input type="hidden" name="productQuantity" class="productQuantity" value="1"></input>
                                    <input type="hidden" name="productName" class="productName" value="<?php echo $rowProduct['Name_Product'] ?>"></input>
                                    <input type="hidden" name="productPrice" class="productPrice" value="<?php echo $price ?>"></input>
                                    <input type="hidden" name="productImage" class="productImage" value="<?php echo $img1[0] ?>"></input>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <div class="pagination modal-2">
        <?php
        if ($total_page > 2) {
            // BƯỚC 7: HIỂN THỊ PHÂN TRANG
            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            if ($current_page > 1 && $total_page > 1) {
                echo '<a href="shop.php?gender=' . $genderlink . '&brand=' . $brandlink . '&page=' . (1) . '"> &laquo; </a>  ';
                echo '<a href="shop.php?gender=' . $genderlink . '&brand=' . $brandlink . '&page=' . ($current_page - 1) . '"> &lt; </a>  ';
            }
            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++) {
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $current_page) {
                    echo '<a>' . $i . '</a>  ';
                } else {
                    echo '<a href="shop.php?gender=' . $genderlink . '&brand=' . $brandlink . '&page=' . $i . '">' . $i . '</a>  ';
                }
            }
            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($current_page < $total_page && $total_page > 1) {
                echo '<a href="shop.php?gender=' . $genderlink . '&brand=' . $brandlink . '&page=' . ($current_page + 1) . '"> &gt; </a>  ';
                echo '<a href="shop.php?gender=' . $genderlink . '&brand=' . $brandlink . '&page=' . ($total_page) . '"> &raquo; </a>  ';
            }
        }
        ?>
    </div>
    <div class="footer mt-5">
        <?php
        // thêm file navbar menu
        include "../header_footer/footer.php";
        ?>
    </div>
</body>

</html>