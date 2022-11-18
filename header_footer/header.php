<?php


// include 'config/connectDB.php';
// lấy tên trang để active menu
$curPageName = $_SERVER["SCRIPT_NAME"];
$curPageName = explode("/", $curPageName);
$curPageName = $curPageName[(sizeof($curPageName) - 1)];
// $curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
// //đăng xuất. kiểm tra khi ấn nút đăng xuất chứa logout = 1 thì xóa $_SESSION['CurrentUser']
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    unset($_SESSION['CurrentUser']);
}
// if đầu tiên kiểm tra $_SESSION['CurrentUser'] nếu không tồn tại thì role và id = null và ngược lại gán cho $Role và $ID dùng truy vấn
if ((isset($_SESSION['CurrentUser']['ID'])) && (isset($_SESSION['CurrentUser']['Role']))) {
    $Role = $_SESSION['CurrentUser']['Role'];
    $ID = $_SESSION['CurrentUser']['ID'];
} else {
    $Role = null;
    $ID = null;
}
// lấy tên người dùng hiện thông quan session[currentuser] chứa id và role(user or admin)
// kiểm tra session chứa role là admin hay user

if ($Role == "Admin")
    $queryCurrenUser = "SELECT CONCAT(administration.First_Name,' ',administration.Last_Name) AS currentUserName FROM administration WHERE ID_Administration='" . $ID . "'";
else
    $queryCurrenUser = "SELECT CONCAT(customers.First_Name,' ',customers.Last_Name) AS currentUserName FROM customers WHERE ID_Customer='" . $ID . "'";

// truy vấn tìm kiếm currentuser thông qua if in line 23
$resultCurrenUser = mysqli_query($conn, $queryCurrenUser);
// lấy dữ liệu các hãng đồng hồ có trong danh mục sản phẩm theo giới tính nam và nữ
$queryMen = "SELECT DISTINCT b.Name,b.ID_Brand FROM products a inner join brands b on a.ID_Brand = b.ID_Brand WHERE ID_Gender = 'IDM'";
$resultMen = mysqli_query($conn, $queryMen);
$queryWomen = "SELECT DISTINCT b.Name,b.ID_Brand FROM products a inner join brands b on a.ID_Brand = b.ID_Brand WHERE ID_Gender = 'IDWM'";
$resultWomen = mysqli_query($conn, $queryWomen);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
    <!-- thư viện sweet aler  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- include file ẩn hiện password -->
    <script type="text/javascript" src="../css and javascript/hidden_show_password.js"></script>
    <!-- include file tìm kiếm sản phẩm trên thành tìm kiếm -->
    <script type="text/javascript" src="../css and javascript/search_product.js"></script>
    <!-- include file khởi động hoặc load lại trang sẽ hiển thị số lượng sản phẩm hiện có trong giỏ hàng -->
    <script type="text/javascript" src="../css and javascript/quantity_cart_onload_body.js"></script>
    <!-- include file hiển thị danh mục xem lịch sử đặt hàng -->
    <script type="text/javascript" src="../css and javascript/dropdown_history_cart.js"></script>
    <!-- include file xử lý thêm sản phẩm vào giỏ hàng -->
    <script type="text/javascript" src="../css and javascript/add_to_cart.js"></script>
    <!-- include file xử lý đăng nhập -->
    <script type="text/javascript" src="../css and javascript/submit_login.js"></script>
    <!-- inlcude file xử lý đăng ký thông tin khách hàng -->
    <script type="text/javascript" src="../css and javascript/submit_signup.js"></script>

</head>

<body>
    <div class="header sticky-top" id="header">
        <form action="" method="post">
            <div class="header-contact">
                <div class="container">
                    <div class="row">
                        <div class="left col-6 row">
                            <div class="header-icon col-2">
                                <a href="#">
                                    <i class="fa-brands fa-facebook-f icons"></i>
                                </a>
                                <a href="#">
                                    <i class="fa-brands fa-instagram icons"></i>
                                </a>
                                <a href="#">
                                    <i class="fa-brands fa-twitter icons"></i>
                                </a>
                            </div>
                            <div class="header-add col-10">
                                <a href="../home.php">
                                    <p class="">
                                        <i id="iconhouse" class="fa-sharp fa-solid fa-house"></i>
                                        <strong>SHOP: </strong>2 Nguyễn Đình Chiểu, Nha Trang, Khánh Hòa
                                    </p>
                                </a>

                            </div>
                        </div>
                        <div class="center col-2">

                        </div>
                        <div class="right col-4 ">
                            <input type="hidden" id="currentUserHDSD" value="<?php echo $ID;  ?>">
                            <input type="hidden" id="currentUserHDSD-home" value="<?php echo $curPageName ?>">
                            <p class="">
                                <i id="iconphone" class="fa-solid fa-phone-volume"></i>
                                <strong>HOTLINE: </strong>038 655 5555 |
                                <?php
                                if (mysqli_num_rows($resultCurrenUser) != 0) :
                                    $rowCurrenUser = mysqli_fetch_array($resultCurrenUser);
                                    // chuyển đổ chuỗi thành mãng
                                    $currentUser = explode(" ", $rowCurrenUser['currentUserName']);
                                    // kiểm tra số lượng phần tử trong mảng
                                    $sizeof = sizeof($currentUser);
                                    // ex: Nguyễn Quốc Châu -> $sizeof = 3
                                    // lấy tên (sizeof-1) và tên đệm (sizeof-2) gần nhất với tên.  
                                    $currentUser = $currentUser[($sizeof - 2)] . " " . $currentUser[($sizeof - 1)];
                                ?>
                                    <a href="../customers/Chi-tiet.php" style="color:white;font-size: 18px;"><i class="fa-solid fa-user"></i></a>
                                    <strong><?php echo $currentUser;  ?></strong>

                                    <button type="button" name="logout" class="btn btn-dark"><a href="<?php echo $curPageName ?>?logout=1" style="color:#f1f1f1"><i class="fa-solid fa-right-from-bracket"></i></a></button>
                                    <!-- <i class="fa-solid fa-right-from-bracket" onclick="logout()"></i> -->

                                <?php else : ?>
                                    <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#login">Đăng nhập</button> &nbsp;
                                    <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#signup">Đăng ký</button>
                                <?php endif; ?>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="header-menu " id="header-menu">
            <div class="container">
                <div class="row">
                    <div class="col-5 menu">
                        <nav class="navbar navbar-expand-lg ">
                            <div class="container-fluid">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link  <?php if ($curPageName == "home.php") echo "active";
                                                                else echo "" ?>" aria-current="page" href="../home.php">TRANG CHỦ</a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link <?php if ($curPageName == "news.php") echo "active";
                                                                else echo "" ?>" href="#">TIN TỨC</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle <?php if (isset($_GET['gender']) && $_GET['gender'] == "IDM") echo "active";
                                                                                else echo "" ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                NAM
                                            </a>
                                            <ul class="dropdown-menu">
                                                <!-- duyệt các hãng thuộc giới tính nam, thẻ a có đường dẫn tới file shop chứa brand, giới tính tương tứng -->
                                                <?php while ($rowMen = mysqli_fetch_array($resultMen)) : ?>
                                                    <li><a class="dropdown-item" href="<?php if ($curPageName == "home.php" or $curPageName == "contact.php" or $curPageName == "Chi-tiet.php" or $curPageName == "Chi-tiet-dat-hang-cua-khach-hang.php") echo "../product and cart/" ?>shop.php?gender=IDM&brand=<?php echo $rowMen['ID_Brand'] ?>"><?php echo $rowMen['Name'] ?></a></li>
                                                <?php endwhile; ?>
                                            </ul>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle  <?php if (isset($_GET['gender']) && $_GET['gender'] == "IDWM") echo "active";
                                                                                else echo "" ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                NỮ
                                            </a>
                                            <ul class="dropdown-menu">
                                                <!-- duyệt các hãng thuộc giới tính nữ, thẻ a có đường dẫn tới file shop chứa brand, giới tính tương tứng -->
                                                <?php while ($rowWomen = mysqli_fetch_array($resultWomen)) : ?>
                                                    <li><a class="dropdown-item" href="<?php if ($curPageName == "home.php" or $curPageName == "contact.php" or $curPageName == "Chi-tiet.php" or $curPageName == "Chi-tiet-dat-hang-cua-khach-hang.php") echo "../product and cart/" ?>shop.php?gender=IDWM&brand=<?php echo $rowWomen['ID_Brand'] ?>"><?php echo $rowWomen['Name'] ?></a></li>
                                                <?php endwhile; ?>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if ($curPageName == "contact.php") echo "active";
                                                                else echo "" ?>" href="../contact/contact.php">LIÊN HỆ</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="logo col-2">
                        <img id="logo" src="<?php if ($curPageName != "home.php") echo "." ?>./img/tcwlogo.png" alt="" srcset="">
                    </div>
                    <div class="col-5 row right searchbtn">
                        <div class="col-7">
                            <div class="input-group">
                                <div id="search-autocomplete" class="form-outline">
                                    <input onkeyup="search(this.value)" type="search" id="form1" class="form-control" placeholder="Tìm kiếm..." />
                                </div>
                                <button type="button" class="btn" style="border-bottom-right-radius: 10px;border-top-right-radius: 10px;">
                                    <i class="fa fa-search"></i>
                                </button>
                                <div id="searchResult" class="dropdown-content dWSearchResult">
                                    <!-- hiển thị kết quả tìm kiếm sản phẩm -->
                                    <p><span id="searchResult"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 cartbtn">
                            <ul class="navbar-nav">
                                <li class="nav-item ">
                                    <a href="../product and cart/Gio-Hang.php" id="show_history_cart" class="nav-link <?php if ($curPageName == "Gio-Hang.php") echo "active";
                                                                                                                        else echo "" ?>">
                                        <span class="header-cart-title">GIỎ HÀNG
                                            <i style="color: black;" class="fa-solid fa-cart-shopping mx-2 shopping-cart"></i>
                                            <span style="position: absolute;top: 0%;color:#b31212;">
                                                <p id="quantity-shopping-cart"></p>
                                            </span>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu " id="dropdown_cart" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 42px);">
                                        <li class="dropdown_hidden"><a class="dropdown-item " href="../product and cart/Lich-su-dat-hang.php">Lịch sử đặt hàng</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <!-- Modal-Login -->
    <form action="" method="POST" id="submitLogin">
        <div class="modal fade text-center" id="login" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header mx-auto">
                        <h5 class="modal-title" id="staticBackdropLabel">Đăng Nhập</h5>
                        <button type="button" class="btn-close btn-close-login" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form">
                            <div>
                                <label class="form-label float-start">
                                    <h5>Tên đăng nhập</h5>
                                </label>
                                <input type="text" placeholder="Email hoặc tên đăng nhập" id="usernameLogin" name="userName" class="input w-100 form-control">
                                <p id="validationUserName" style="color: red;display:block"></p>
                            </div>
                            <div>
                                <label class="form-label float-start">
                                    <h5>Mật khẩu</h5>
                                </label>
                                <input type="password" placeholder="Mật khẩu" id="passwordLogin" name="passWord" class="input w-100 form-control ">
                                <span onclick="show_hidden_password_login()" class="changePasword"><i id="icon" class="fas fa-eye"></i></span>
                                <p id="validationPassWord" style="color: red;display:block"></p>
                            </div>
                            <div class="forgetPass">
                                <a href="#" data-bs-target="#myModal_Forgotten_password" data-bs-toggle="modal" data-bs-dismiss="modal">Quên mật khẩu?</a>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button href="#" class="btn btn-primary btn-block mt-3 w-100">Đăng Nhập</button>
                        <p>Chưa có tài khoản? <a href="#" style="text-decoration: none;" data-bs-target="#signup" data-bs-toggle="modal" data-bs-dismiss="modal">Đăng Ký Ngay</a></p>
                        <button type="button" class="btn btn-block mt-3 w-100" style="background: gray;" onclick="location.href='../access/admin.php';">Đăng nhập quản trị viên</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Modal-SignUp -->
    <form action="" method="POST" id="submitsignup">
        <div class="modal fade" id="signup" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header mx-auto">
                        <h5 class="modal-title" id="staticBackdropLabel">Đăng Ký</h5>
                        <button type="button" class="btn-close btn-close-signup" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">
                                        <h5>Họ và Tên</h5>
                                    </label>
                                    <input id="create_at" type="hidden" value="<?php // lấy thời gian hệ thống
                                                                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                                                $timeNow = date("Y-m-d H:i:s");
                                                                                echo $timeNow; ?>">
                                    <input class="w-100 form-control" type="text" placeholder="Họ và tên" name="name" id="name" pattern="[A-Za-z]{}">
                                    <p id="validationName" style="color: red;display:block"></p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">
                                        <h5>Email</h5>
                                    </label>
                                    <input class="w-100 form-control" type="text" placeholder="Email" name="email" id="email">
                                    <p id="validationEmail" style="color: red;display:block"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" style="padding-top: 10px;">
                                        <h5>Số di động</h5>
                                    </label>
                                    <input class="w-100 form-control" type="text" placeholder="Số di động" name="phone" id="phone">
                                    <p id="validationPhone" style="color: red;display:block"></p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" style="padding-top: 10px;">
                                        <h5>Tên đăng nhập</h5>
                                    </label>
                                    <input class="w-100 form-control" type="text" placeholder="Tên đăng nhập" name="username" id="username">
                                    <p id="validationUserName" style="color: red;display:block"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label" style="padding-top: 10px;">
                                        <h5>Mật khẩu</h5>
                                    </label>
                                    <input class="w-100 form-control" type="password" id="password_signup" placeholder="Mật khẩu" name="pass" id="pass">
                                    <span onclick="show_hidden_password()" class="changePasword_Singup"><i id="icon" class="fas fa-eye"></i></span>
                                    <p id="validationPass" style="color: red;display:block"></p>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" style="padding-top: 10px;">
                                        <h5>Nhập lại mật khẩu</h5>
                                    </label>
                                    <input class="w-100 form-control" type="password" id="confirm_password_signup" placeholder="Nhập lại mật khẩu" name="checkpass" id="checkpass">
                                    <span onclick="confirm_show_hidden_password()" class="changePasword_Singup"><i id="icon" class="fas fa-eye"></i></span>
                                    <p id="validationCheckPass" style="color: red;display:none"></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button href="#" class="btn btn-primary btn-block mt-3 w-100">Đăng Ký</button>
                        <p>Đã có tài khoản? <a href="#" style="text-decoration: none;" data-bs-target="#login" data-bs-toggle="modal" data-bs-dismiss="modal">Đăng Nhập Ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Modal-Forgotten-password -->
    <div class="modal fade" id="myModal_Forgotten_password" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header mx-auto">
                    <h5 class="modal-title" id="staticBackdropLabel">Khôi phục mật khẩu</h5>
                    <button type="button" class="btn-close btn-close-forget" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div>
                            <label class="form-label">
                                <h5>Tên đăng nhập</h5>
                            </label>
                            <input class="w-100 form-control" type="text" placeholder="Tên đăng nhập">
                        </div>
                        <div>
                            <label class="form-label" style="padding-top: 10px;">
                                <h5>Số di động hoặc Email</h5>
                            </label>
                            <input class="w-100 form-control" type="text" placeholder="Số di động hoặc Email">
                        </div>
                        <div>
                            Liên hệ Page Shop <a href="https://www.facebook.com/NguyenQuocChau.NhaTrang" style="text-decoration: none;">Tại đây</a>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <p>Đã có tài khoản? <a href="#" style="text-decoration: none;" data-bs-target="#login" data-bs-toggle="modal" data-bs-dismiss="modal">Đăng Nhập Ngay</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>