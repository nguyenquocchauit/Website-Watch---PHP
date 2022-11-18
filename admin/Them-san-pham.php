<?php
// kết nối cơ sở dữ liệu db_watch
require '../config/connectDB.php';
include 'inlcudes_function/show_brand_gender.php';
include 'inlcudes_function/auto_idproduct.php';



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
    <script type="text/javascript">
        $(document).ready(function() {
            const input_image = [
                [],
                [],
                [],
                [],
                [],
                [],
            ];
            // Bắt sự kiện click thêm giỏ hàng thêm hiệu ứng animation tới icon giỏ hàng
            $(".image-product").change(function() {
                var _input = $(this).val();
                var _image = $(this).parent('.add-image-product').find(".file-image").find("img");
                var reader = new FileReader();
                // sự kiện onload thay đổi src từ đường dẫn sang base64 để preview image
                reader.onload = function(e) {
                    _image.attr('src', e.target.result);
                }
                // đọc data từ thẻ input (this), chuyển đổi data sang base64
                reader.readAsDataURL(this.files[0]);
                // thêm data từ input(this) vào variable input_image để xử lý 
                switch ($(this).attr('id')) {
                    case 'file-input-product-1':
                        add_replace_input(0, _input);
                        break;
                    case 'file-input-product-2':
                        add_replace_input(1, _input);
                        break;
                    case 'file-input-product-3':
                        add_replace_input(2, _input);
                        break;
                    case 'file-input-product-4':
                        add_replace_input(3, _input);
                        break;
                    case 'file-input-product-5':
                        add_replace_input(4, _input);
                        break;
                    case 'file-input-product-6':
                        add_replace_input(5, _input);
                        break;
                }
                console.log(input_image);
            });
            $('.button-add-image').on('click', function() {
                var _input_1 = $('#file-input-product-1').val();
                var _input_2 = $('#file-input-product-2').val();
                var _input_3 = $('#file-input-product-3').val();
                var _input_4 = $('#file-input-product-4').val();
                var _input_5 = $('#file-input-product-5').val();
                var _input_6 = $('#file-input-product-6').val();
                // true: input chưa được thêm ảnh và ngược lại với else
                // kiểm tra các input đã được thêm ảnh chưa và thông báo
                if (check_empty(_input_1) && check_empty(_input_2) && check_empty(_input_3) && check_empty(_input_4) && check_empty(_input_5) && check_empty(_input_6))
                    Swal.fire({
                        icon: 'error',
                        title: 'Thông báo!',
                        text: 'Vui lòng nhập đủ 6 ảnh!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                else if (check_empty(_input_1))
                    Swal.fire({
                        icon: 'error',
                        title: 'Thông báo!',
                        text: 'Vui lòng nhập ảnh thứ nhất!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                else if (check_empty(_input_2))
                    Swal.fire({
                        icon: 'error',
                        title: 'Thông báo!',
                        text: 'Vui lòng nhập ảnh thứ hai!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                else if (check_empty(_input_3))
                    Swal.fire({
                        icon: 'error',
                        title: 'Thông báo!',
                        text: 'Vui lòng nhập ảnh thứ ba!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                else if (check_empty(_input_4))
                    Swal.fire({
                        icon: 'error',
                        title: 'Thông báo!',
                        text: 'Vui lòng nhập ảnh thứ bốn!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                else if (check_empty(_input_5))
                    Swal.fire({
                        icon: 'error',
                        title: 'Thông báo!',
                        text: 'Vui lòng nhập ảnh thứ năm!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                else if (check_empty(_input_6))
                    Swal.fire({
                        icon: 'error',
                        title: 'Thông báo!',
                        text: 'Vui lòng nhập ảnh thứ sáu!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
            });

            // function thêm input vào array input_image, nếu đã tồn tại trước đó thì thay thế
            function add_replace_input(i, input) {
                if (input_image[i].length === 0)
                    input_image[i].push(input);
                else
                    input_image[i][0] = input;
            }

            function check_empty(input) {
                // true: input chưa được thêm ảnh và ngược lại với else
                if (input.lenght == 0 || input == "")
                    return true;
                return false;
            }
        });
    </script>
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
                        <input type="text" class="form-control" value="<?php echo $ID_Product ?>" id="IDProduct" name="IDProduct" readonly>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Tên sản phẩm</span>
                        <input type="text" class="form-control" value="" id="Name" name="Name">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Hãng</span>
                        <select class="form-select form-select-lg form-select-brand" id="brand" aria-label=".form-select-lg example">
                            <?php if (mysqli_num_rows($resultBrand)) while ($rowBrand = mysqli_fetch_array($resultBrand)) : ?>
                                <option value="<?php echo $rowBrand['ID_Brand'] ?>"> <?php echo $rowBrand['Name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Loại</span>
                        <select class="form-select form-select-lg form-select-gender" id="gender" aria-label=".form-select-lg example">
                            <?php if (mysqli_num_rows($resultGender)) while ($rowGender = mysqli_fetch_array($resultGender)) : ?>
                                <option value="<?php echo $rowGender['ID_Gender'] ?>"> <?php echo $rowGender['Name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Số lượng kho</span>
                        <input type="text" class="form-control" value="" id="" name="">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Giá niêm yết</span>
                        <input type="text" class="form-control" value="" id="" name="">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Giảm giá</span>
                        <input type="text" class="form-control" value="" id="" name="">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group ">
                        <label class="input-group-text" for="Image">Ảnh</label>
                        <button type="button" class="btn btn-secondary button-back" style="width: 77%;" data-bs-target="#myModal_Add-Product" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fa-solid fa-image"></i> Thêm ảnh</button>
                        <!-- <input type="file" class="form-control" id="Image" name="Image" multiple> -->
                        <!-- <form action="" method="post" enctype="multipart/form-data">
                            <input type="file" name="image[]" accept="image/*" id="imageButton" multiple />
                        </form> -->
                    </div>
                </div>
                <div class="row p-2">
                    <div class="input-group flex-nowrap ">
                        <span class="input-group-text" id="addon-wrapping">Mô tả</span>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-6 d-flex justify-content-end"><button type="button" class="btn btn-warning button-back"><i class="fa-solid fa-arrow-left"></i> Quay lại</button></div>
                    <div class="col-6 d-flex justify-content-center"><button type="button" class="btn btn-success button-update"><i class="fa-solid fa-floppy-disk"></i>Thêm</button></div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
    <?php
    // thêm file footer
    include "../header_footer/footer.php";
    ?>
    <!-- Modal Add image for product -->
    <div class="modal fade" id="myModal_Add-Product" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header mx-auto">
                    <h5 class="modal-title" id="staticBackdropLabel">Thêm ảnh cho sản phẩm</h5>
                    <button type="button" class="btn-close btn-close-add-product" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="row pb-2">
                    <div class="col-4 d-flex justify-content-center add-image-product">
                        <label for="file-input-product-1" class="file-image">
                            <img id="image-product-1" src="../img/default-image.jpg" alt="" srcset="" style="width:150px;height: 160px;">
                        </label>
                        <input class="image-product" type="file" id="file-input-product-1" style="display:none;">
                    </div>
                    <div class="col-4 d-flex justify-content-center add-image-product">
                        <label for="file-input-product-2" class="file-image">
                            <img src="../img/default-image.jpg" alt="" srcset="" style="width:150px;height: 160px;">
                        </label>
                        <input class="image-product" type="file" id="file-input-product-2" style="display:none;">
                    </div>
                    <div class="col-4 d-flex justify-content-center add-image-product">
                        <label for="file-input-product-3" class="file-image">
                            <img src="../img/default-image.jpg" alt="" srcset="" style="width:150px;height: 160px;">
                        </label>
                        <input class="image-product" type="file" id="file-input-product-3" style="display:none;">
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-4 d-flex justify-content-center add-image-product">
                        <label for="file-input-product-4" class="file-image">
                            <img src="../img/default-image.jpg" alt="" srcset="" style="width:150px;height: 160px;">
                        </label>
                        <input class="image-product" type="file" id="file-input-product-4" style="display:none;">
                    </div>
                    <div class="col-4 d-flex justify-content-center add-image-product">
                        <label for="file-input-product-5" class="file-image">
                            <img src="../img/default-image.jpg" alt="" srcset="" style="width:150px;height: 160px;">
                        </label>
                        <input class="image-product" type="file" id="file-input-product-5" style="display:none;">
                    </div>
                    <div class="col-4 d-flex justify-content-center add-image-product">
                        <label for="file-input-product-6" class="file-image">
                            <img src="../img/default-image.jpg" alt="" srcset="" style="width:150px;height: 160px;">
                        </label>
                        <input class="image-product" type="file" id="file-input-product-6" style="display:none;">
                    </div>
                </div>
                <div class="row pt-2">
                    <p style="color:red;text-align: center;">Vui lòng nhập đủ 6 ảnh</p>
                    <div class="col-12 d-flex justify-content-center"><button type="button" class="btn btn-success button-add-image"><i class="fa-solid fa-floppy-disk"></i> Thêm</button></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>