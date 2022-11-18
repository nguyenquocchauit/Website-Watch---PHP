var boxShadowCSS = '0px 3px #1bcf4840';
var borderCSS = '2px solid red';
$(document).ready(function () {
    // loại khoảng trắng của ô input tên dăng nhập
    $('#UserName').on('keypress', function (e) {
        if (e.which == 32) {
            return false;
        }
    });
    // loại khoảng trắng của ô input sdt
    $('#Phone').on('keypress', function (e) {
        if (e.which == 32) {
            return false;
        }
    });
    // loại khoảng trắng của ô input email
    $('#Email').on('keypress', function (e) {
        if (e.which == 32) {
            return false;
        }
    });
    // loại khoảng trắng của ô input password
    $('#PassWord').on('keypress', function (e) {
        if (e.which == 32) {
            return false;
        }
    });
    // loại khoảng trắng của ô input confirm password
    $('#ChangePassWord').on('keypress', function (e) {
        if (e.which == 32) {
            return false;
        }
    });
    // lấy giá trị ban đầu, để kiểm tra trùng trong db
    var _OldEmail = document.getElementById("Email").value;
    var _OldUserName = document.getElementById("UserName").value;

    $("#SaveInfo").on('click', function () {
        var _IDCustomer = document.getElementById("IDCustomer").value;
        var _CreateAt = document.getElementById("CreateAt").value;
        var FullName = document.getElementById("FullName");
        var _FullName = FullName.value;
        var Phone = document.getElementById("Phone");
        var _Phone = Phone.value;
        var Email = document.getElementById("Email");
        var _Email = Email.value;
        var Address = document.getElementById("Address");
        var _Address = Address.value;
        var UserName = document.getElementById("UserName");
        var _UserName = UserName.value;
        var PassWord = document.getElementById("PassWord");
        var _PassWord = PassWord.value;
        var ChangePassWord = document.getElementById("ChangePassWord");
        var _ChangePassWord = ChangePassWord.value;


        if (_FullName == "" || _FullName.length == 0) {
            FullName.style.border = borderCSS;
            FullName.style.boxShadow = boxShadowCSS;
            Swal.fire({
                icon: 'error',
                title: 'Thông báo!',
                text: 'Họ và tên không được để trống!',
                timer: 1500,
                timerProgressBar: true,
            })
        } else {
            FullName.style.border = null;
            FullName.style.boxShadow = null;
            if (_Phone == "" || _Phone.length == 0) {
                Phone.style.border = borderCSS;
                Phone.style.boxShadow = boxShadowCSS;
                Swal.fire({
                    icon: 'error',
                    title: 'Thông báo!',
                    text: 'Số điện thoại không được để trống!',
                    timer: 1500,
                    timerProgressBar: true,
                })
            } else {
                Phone.style.border = null;
                Phone.style.boxShadow = null;
                if (_Email == "" || _Email.length == 0) {
                    Email.style.border = borderCSS;
                    Email.style.boxShadow = boxShadowCSS;
                    Swal.fire({
                        icon: 'error',
                        title: 'Thông báo!',
                        text: 'Email không được để trống!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                }
                else {
                    Email.style.border = null;
                    Email.style.boxShadow = null;
                    if (_Address == "" || _Address.length == 0) {
                        Address.style.border = borderCSS;
                        Address.style.boxShadow = boxShadowCSS;
                        Swal.fire({
                            icon: 'error',
                            title: 'Thông báo!',
                            text: 'Địa chỉ không được để trống!',
                            timer: 1500,
                            timerProgressBar: true,
                        })
                    }
                    else {
                        Address.style.border = null;
                        Address.style.boxShadow = null;
                        if (_UserName == "" || _UserName.length == 0) {
                            UserName.style.border = borderCSS;
                            UserName.style.boxShadow = boxShadowCSS;
                            Swal.fire({
                                icon: 'error',
                                title: 'Thông báo!',
                                text: 'Tên đăng nhập không được để trống!',
                                timer: 1500,
                                timerProgressBar: true,
                            })
                        }
                        else {
                            UserName.style.border = null;
                            UserName.style.boxShadow = null;
                            if (_PassWord == "" || _PassWord.length == 0) {
                                PassWord.style.border = borderCSS;
                                PassWord.style.boxShadow = boxShadowCSS;
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Thông báo!',
                                    text: 'Vui lòng xác nhận lại mật khẩu để lưu thông tin!',
                                    timer: 1500,
                                    timerProgressBar: true,
                                })
                            } else {
                                PassWord.style.border = null;
                                PassWord.style.boxShadow = null;

                                // kiểm tra hành động có thay đổi email với username không
                                var action = 'none';
                                if ((_Email != _OldEmail) && (_UserName != _OldUserName))
                                    action = "changeEmail_UserName";
                                else if (_UserName != _OldUserName)
                                    action = "changeUserName";
                                else if (_Email != _OldEmail)
                                    action = "changeEmail";
                                console.log(action);
                                $.ajax({
                                    type: "POST",
                                    url: "inlcudes_function/edit_info.php",
                                    data: {
                                        Action: action,
                                        IDCustomer: _IDCustomer,
                                        CreateAt: _CreateAt,
                                        FullName: _FullName,
                                        Phone: _Phone,
                                        Email: _Email,
                                        Address: _Address,
                                        UserName: _UserName,
                                        PassWord: _PassWord,
                                        ChangePassWord: _ChangePassWord,
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
                                            if (data['email'] == 1) {
                                                Email.style.border = borderCSS;
                                                Email.style.boxShadow = boxShadowCSS;
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Thông báo!',
                                                    text: 'Email tồn tại!',
                                                    timer: 1500,
                                                    timerProgressBar: true,
                                                })
                                            } else if (data['username'] == 1) {
                                                UserName.style.border = borderCSS;
                                                UserName.style.boxShadow = boxShadowCSS;
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Thông báo!',
                                                    text: 'Tên đăng nhập tồn tại!',
                                                    timer: 1500,
                                                    timerProgressBar: true,
                                                })
                                            } else if (data['password'] == 1) {
                                                PassWord.style.border = borderCSS;
                                                PassWord.style.boxShadow = boxShadowCSS;
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Thông báo!',
                                                    text: 'Mật khẩu đăng nhập không chính xác!',
                                                    timer: 1500,
                                                    timerProgressBar: true,
                                                })
                                            } else if (data['message'] == 0) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Thông báo!',
                                                    text: 'Cập nhật thành công!',
                                                    timer: 1500,
                                                    timerProgressBar: true,
                                                }).then((result) => {
                                                    // hoàn thành xong tải lại trang
                                                    window.location.reload();
                                                })
                                            }
                                        }
                                    }
                                });
                            }
                        }
                    }
                }
            }
        }
    });
});