// css màu input nếu đăng nhập có xãy ra lỗi
var boxShadowCSS = '0px 3px #1bcf4840';
var borderCSS = '2px solid red';
$(document).ready(function () {
    // bắt sự kiện đăng nhập (username và password) xử lý tại file login.php 
    // loại khoảng trắng của ô input tên dăng nhập
    $('#usernameLogin').on('keypress', function (e) {
        if (e.which == 32) {
            return false;
        }
    });
    // hiển thông thông báo sử dụng tính năng xem chi tiết tài khoản và lịch sử đặt hàng khi ở trang home 
    var currentUserHDSD = document.getElementById("currentUserHDSD").value;
    var currentUserHDSD_home = document.getElementById("currentUserHDSD-home").value;
    console.log(currentUserHDSD);
    if((currentUserHDSD !=null && currentUserHDSD.length !=0) && currentUserHDSD_home == "home.php"){
        Swal.fire({
            title: 'HDSD tính năng cơ bản',
            confirmButtonText: 'Đã hiểu',
            customClass: 'swal-wide',
            imageUrl: '../img/hdsd.png',
            imageWidth: 770,
            imageHeight: 450,
            imageAlt: 'Custom image',
        })
    }
    // bắt sự kiện đăng nhập
    $("#submitLogin").submit(function () {
        var usernameLogin = document.getElementById("usernameLogin");
        var passwordLogin = document.getElementById("passwordLogin");
        var _username = $("#usernameLogin").val();
        var _password = $("#passwordLogin").val();
        console.log(_username, _password);
        if (_username == "" || _username.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo!',
                text: 'Tài khoản không được để trống!',
                timer: 1500,
                timerProgressBar: true,
            })


            usernameLogin.style.border = borderCSS;
            usernameLogin.style.boxShadow = boxShadowCSS;
            passwordLogin.style.border = null;
            passwordLogin.style.boxShadow = null;
        } else if (_password == "" || _password.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo!',
                text: 'Mật khẩu không được để trống!',
                timer: 1500,
                timerProgressBar: true,
            })
            passwordLogin.style.border = borderCSS;
            passwordLogin.style.boxShadow = boxShadowCSS;
            usernameLogin.style.border = null;
            usernameLogin.style.boxShadow = null;
        } else {
            usernameLogin.style.border = null;
            usernameLogin.style.boxShadow = null;
            passwordLogin.style.border = null;
            passwordLogin.style.boxShadow = null;
            $.ajax({
                type: "POST",
                url: "../access/login.php",
                data: {
                    username: _username,
                    password: _password
                },
                cache: false,
                success: function (result) {
                    /* check array  */
                    var n = result.search("Unknown database");
                    if (n > 0) {
                        alert("Database không đúng!");
                    } else {
                        /* Convert json to array */
                        var data = JSON.parse(result);
                        // dùng console.log xem biến in ra ở trên trình duyệt ở mục console . debug cho dễ
                        console.log(data);
                        if (data['message'] == 0) {
                            // sử dụng thư viện sweetaler thông báo cho đẹp :v
                            let timerInterval
                            Swal.fire({
                                title: 'Đăng nhập thành công!',
                                html: 'Đang đăng nhập vào Website <strong></strong> giây.',
                                //icon: "success",
                                imageUrl: '../img/cat.gif',
                                imageWidth: 315,
                                imageHeight: 230,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    // thiết lập thời gian theo giây, ban đầu là millisecond
                                    timerInterval = setInterval(() => {
                                        Swal.getHtmlContainer().querySelector('strong')
                                            .textContent = (Swal.getTimerLeft() / 1000)
                                                .toFixed(0)
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                // hoàn thành xong chuyển tới trang home
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    var file = data['success'];
                                    window.location.href = "../" + file;
                                    
                                }
                            })

                        } else if (data['message'] == 1) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thông báo!',
                                text: 'Tài khoản không tồn tại!',
                                timer: 1500,
                                timerProgressBar: true,
                            })
                            usernameLogin.style.border = borderCSS;
                            usernameLogin.style.boxShadow = boxShadowCSS;
                            passwordLogin.style.border = null;
                            passwordLogin.style.boxShadow = null;
                        } else if (data['message'] == -1) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thông báo!',
                                text: 'Mật khẩu sai!',
                                timer: 1500,
                                timerProgressBar: true,
                            })
                            passwordLogin.style.border = borderCSS;
                            passwordLogin.style.boxShadow = boxShadowCSS;
                            usernameLogin.style.border = null;
                            usernameLogin.style.boxShadow = null;
                        }
                    }
                },
                error: function (request, status, error) {
                    alert(status);
                }
            });
        }
        return false;
    });
});