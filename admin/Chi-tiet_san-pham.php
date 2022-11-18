<?php
// kết nối cơ sở dữ liệu db_watch
require '../config/connectDB.php';
if (isset($_GET['idpro']) && $_GET['idpro'] == null) {
    header('Location: Danh-sach-san-pham.php');
    exit();
} else {
    $idpro = $_GET['idpro'];
}
include 'inlcudes_function/show_product.php';

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
    <script src="../css and javascript/update_delete_product.js"></script>
    <script src="../thuvienweb/bootstrap-5.2.0-beta1-dist/bootstrap-5.2.0-beta1-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../thuvienweb/fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="../thuvienweb/fontawesome-free-6.1.2-web/css/all.min.css">
    <script src="../thuvienweb/fontawesome-free-6.1.2-web/js/all.min.js"></script>
    <script src="../thuvienweb/fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/js/all.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <!-- thư viện sweet aler  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>TC WATCH - Chi tiết sản phẩm</title>
</head>

<body>
    <?php
    // thêm file navbar menu
    include "../header_footer/header.php";
    ?>
    <div class="body-detail-product">
        <div class="row">
            <div class="row pt-1 pb-3"><strong class=" d-flex justify-content-center" style="font-size: 30px; font-family: 'Oswald', sans-serif;">THÔNG TIN CHI TIẾT</strong></div>
        </div>
        <div class="row detail-product">
            <div class="col-2"></div>
            <div class="col-4">
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
                                <img src="../img<?php if ($i == 0) echo "/images/" . $genderlink . "/" . $brandlink; ?>/<?php $img1 = explode(",", $rowProduct['Image']);
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
            <div class="col-4 p-2 ">
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Mã sản phẩm</span>
                        <input type="text" class="form-control" value="<?php echo $rowProduct['ID_Product'] ?>" id="IDProduct" name="IDProduct" readonly>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Tên sản phẩm</span>
                        <input type="text" class="form-control" value="<?php echo $rowProduct['Name'] ?>" id="Name" name="Name">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Hãng</span>
                        <select class="form-select form-select-lg form-select-brand" id="brand" aria-label=".form-select-lg example">
                            <?php if (mysqli_num_rows($resultBrand)) while ($rowBrand = mysqli_fetch_array($resultBrand)) : ?>
                                <option value="<?php echo $rowBrand['ID_Brand'] ?>" <?php if ($rowBrand['ID_Brand'] == $rowProduct['ID_Brand']) echo "selected" ?>> <?php echo $rowBrand['Name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Loại</span>
                        <select class="form-select form-select-lg form-select-gender" id="gender" aria-label=".form-select-lg example">
                            <?php if (mysqli_num_rows($resultGender)) while ($rowGender = mysqli_fetch_array($resultGender)) : ?>
                                <option value="<?php echo $rowGender['ID_Gender'] ?>" <?php if ($rowGender['ID_Gender'] == $rowProduct['ID_Gender']) echo "selected" ?>> <?php echo $rowGender['Name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Số lượng kho</span>
                        <input type="text" class="form-control" value="<?php echo $rowProduct['Quantity'] ?>" id="" name="">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Giá niêm yết</span>
                        <input type="text" class="form-control" value="<?php echo number_format($rowProduct['Price']) . " VNĐ"; ?>" id="" name="">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Giảm giá</span>
                        <input type="text" class="form-control" value="<?php $discount = $rowProduct['Discount'];
                                                                        $percent = round((float)$discount * 100) . '%';
                                                                        echo $percent  ?>" id="" name="">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Ngày tạo</span>
                        <input type="text" class="form-control" value="<?php echo $rowProduct['Create_At'] ?>" id="" name="" readonly>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Ngày chỉnh sửa</span>
                        <input type="text" class="form-control" value="<?php echo $rowProduct['Update_At'] ?>" id="" name="" readonly>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group ">
                        <label class="input-group-text" for="Image">Ảnh</label>
                        <button type="button" class="btn btn-secondary button-back" style="width: 77%;"><i class="fa-solid fa-image"></i> Chỉnh sửa ảnh</button>
                        <!-- <input type="file" class="form-control" id="Image" name="Image" multiple> -->
                        <!-- <form action="" method="post" enctype="multipart/form-data">
                            <input type="file" name="image[]" accept="image/*" id="imageButton" multiple />
                        </form> -->
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Mô tả</span>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $rowProduct['Description'] ?></textarea>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-4 d-flex justify-content-end"><button type="button" class="btn btn-warning button-back"><i class="fa-solid fa-arrow-left"></i> Quay lại</button></div>
                    <div class="col-4 d-flex justify-content-center"><button type="button" class="btn btn-success button-update"><i class="fa-solid fa-floppy-disk"></i> Cập nhật</button></div>
                    <div class="col-4 d-flex justify-content-start"><button type="button" class="btn btn-danger button-delete"><i class="fa-solid fa-trash"></i> Xóa</button></div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
    <?php
    // thêm file footer
    include "../header_footer/footer.php";
    ?>
</body>

</html>