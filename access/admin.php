<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrators TCWatch</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0
        }

        body {
            width: 100%;
            margin: 0 auto;
            max-width: 1350px;
            font-family: 'Oswald', sans-serif;
            background: #F0E4E4;
        }

        .form_hoa {
            width: 40%;
            margin: auto;
        }

        .form_hoa>.box_login {
            width: 100%;
            margin-top: 30%;
            background-color: #d5d5d5;
            box-shadow: 0 0 2px #000;
            border-radius: 10px;
            padding: 20px;
            box-sizing: border-box;
        }

        .box_login form h2 {
            text-align: center;
            color: #000;
            font-size: 30px;
        }

        .box_login form>div {
            padding: 5px 0px;
        }

        .box_login form label {
            padding: 3px 0;
            display: block;
            font-weight: bold;
        }

        .box_login form input {
            width: 100%;
            border: none;
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .box_login form button {
            width: 100%;
            border: none;
            background: #333;
            color: #fff;
            padding: 11px;
            border-radius: 5px;
            box-sizing: border-box;
            text-align: center;
            font-size: 20px;
        }
    </style>
    <script>
        $(document).ready(function() {
            
            /* LOGIN FORM */
            $("#login").submit(function() {
                var _username = $("input[type='text']").val();
                var _password = $("input[type='password']").val();
                console.log(_username, _password);
                if (_username == "" || _username.length == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Thông báo!',
                        text: 'Email hoặc Username không được để trống!',
                        timer: 1500,
                        timerProgressBar: true,

                    })

                } else if (_password == "" || _password.length == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Thống báo!',
                        text: 'Bạn quên nhập mật khẩu!',
                        timer: 1500,
                        timerProgressBar: true,

                    })
                } else {

                    $.ajax({
                        type: "POST",
                        url: "login_admin.php",
                        data: {
                            username: _username,
                            password: _password
                        },
                        cache: false,
                        success: function(result) {
                            /* check array  */
                            var n = result.search("Unknown database");
                            if (n > 0) {
                                alert("Database không đúng!");
                            } else {
                                /* Convert json to array */
                                var data = JSON.parse(result);
                                console.log(data);
                                if (data['message'] == 0)
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thống báo!',
                                        text: 'Đăng nhập thành công!',
                                        timer: 1500,
                                        timerProgressBar: true,

                                    }).then((result) => {
                                        // hoàn thành xong chuyển tới trang home
                                        var file = data['success'];
                                        window.location.href = "../" + file;
                                    })
                            }
                        },
                        error: function(request, status, error) {
                            alert(status);
                        }
                    });

                }

                return false;
            });

        });
    </script>

</head>

<body>
    <div class="form_hoa">
        <div class="box_login">
            <form action="" method="POST" id="login">
                <h2>Quản Trị TCWatch</h2>
                <div class="row-item">
                    <label for="username">Email or Username</label>
                    <input type="text" name="username" placeholder="Enter Email or Username" value="<?php echo (isset($_GET['username']) ? $_GET['username'] : '') ?>" />
                </div>
                <div class="row-item">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter Password" />
                </div>
                <div class="row-item">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>