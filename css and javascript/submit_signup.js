$(document).ready(function () {


    // loại khoảng trắng của ô input tên dăng nhập
    $('#username').on('keypress', function (e) {
        if (e.which == 32) {
            return false;
        }
    });
    // loại khoảng trắng của ô input sdt
    $('#phone').on('keypress', function (e) {
        if (e.which == 32) {
            return false;
        }
    });
    $('#email').on('keypress', function (e) {
        if (e.which == 32) {
            return false;
        }
    });
    // loại khoảng trắng của ô input password
    $('#password_signup').on('keypress', function (e) {
        if (e.which == 32) {
            return false;
        }
    });
    // loại khoảng trắng của ô input confirm password
    $('#confirm_password_signup').on('keypress', function (e) {
        if (e.which == 32) {
            return false;
        }
    });

    const validateEmail = (email) => {
        return email.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    };

    /////////////////////////////signup
    $("#submitsignup").submit(function () {
       
        var _create_at = $("#create_at").val();
        var _name = $("#name").val();
        var _email = $("#email").val();
        _email = _email.toLowerCase();
        var _phone = $("#phone").val();
        var _username = $("#username").val();
        var _pass = $("#password_signup").val();
        var _checkpass = $("#confirm_password_signup").val();
        if (_name == "" || _name.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo!',
                text: 'Họ tên không được để trống!',
                timer: 1500,
                timerProgressBar: true,
            })
        } else if (_email == "" || _email.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo!',
                text: 'Email không được để trống!',
                timer: 1500,
                timerProgressBar: true,
            })

        } else if (_phone == "" || _phone.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo!',
                text: 'Số điện thoại không được để trống!',
                timer: 1500,
                timerProgressBar: true,
            })
        } else if (_username == "" || _username.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo!',
                text: 'Tên đăng nhập không được để trống!',
                timer: 1500,
                timerProgressBar: true,
            })
        } else if (_pass == "" || _pass.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo!',
                text: 'Mật khẩu không được để trống!',
                timer: 1500,
                timerProgressBar: true,
            })
        } else if (_checkpass == "" || _checkpass.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo!',
                text: 'Xác nhận mật khẩu không được để trống!',
                timer: 1500,
                timerProgressBar: true,
            })
        } else if (_checkpass != _pass) {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo!',
                text: 'Xác nhận mật khẩu sai, vui lòng kiểm tra lại!',
                timer: 1500,
                timerProgressBar: true,
            })
        } else if (validateEmail(_email) == null) {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo!',
                text: 'Không đúng định dạng Email',
                html: 'Ví dụ: tcwatch@gmail.com',
                timer: 2000,
                timerProgressBar: true,
            })
        } else if (_pass.length < 6) {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo!',
                text: 'Mật khẩu tối thiểu 6 kí tự',
                timer: 1500,
                timerProgressBar: true,
            })
        } else if (_phone.length < 10 || _phone.length > 10) {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo!',
                text: 'Số điện thoại phải là 10 số',
                html: 'Ví dụ: 0123456789',
                timer: 2000,
                timerProgressBar: true,
            })
        } else {
            $.ajax({
                type: "POST",
                url: "../access/signup.php",
                data: {
                    create_at: _create_at,
                    name: _name,
                    email: _email,
                    phone: _phone,
                    username: _username,
                    pass: _pass,
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
                        console.log(data);
                        if (data['message'] == 0) {
                            // sử dụng thư viện sweetaler thông báo cho đẹp :v
                            Swal.fire({
                                icon: 'success',
                                title: 'Đăng ký thành công!',
                                timer: 1000,
                                timerProgressBar: true,
                            }).then((result) => {
                                // hoàn thành xong chuyển tới trang home
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    $.ajax({
                                        type: "POST",
                                        url: "../access/login.php",
                                        data: {
                                            username: _username,
                                            password: _pass
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
                                                }
                                            }
                                        },
                                        error: function (request, status, error) {
                                            alert(status);
                                        }
                                    });
                                }
                            })
                        } else if (data['email'] == 2) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thông báo!',
                                text: 'Email đã tồn tại!',
                                timer: 1500,
                                timerProgressBar: true,
                            })
                        } else if (data['username'] == 1) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thông báo!',
                                text: 'Tên đăng nhập đã tồn tại!',
                                timer: 1500,
                                timerProgressBar: true,
                            })
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