$(function () {

    // bắt sự kiện ấn nút đặt hành nếu chưa đăng nhập thì thông báo phải đăng nhập
    $(".buttonBuy").on("click", function () {
        var $button = $(this);
        var CurrentUser = $button.parent().find(".CurrentUser").val();
        var IDUser = $button.parent().find(".IDUser").val();
        var sum = $button.parent().find(".sum").val();
        var timeNow = $button.parent().find(".timeNow").val();

        if (CurrentUser == "null") {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo',
                text: 'Bạn vui lòng đăng nhập để tiến hành đặt hàng. Cảm ơn!',
                confirmButtonText: 'Đăng nhập',
            }).then((result) => {
                // click vào đăng nhập thì show modal đăng nhập
                if (result.isConfirmed) {
                    $('#login').modal('show');
                }
            })
        } else if (IDUser == "Admin") {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo',
                text: 'Hiện tại bạn đang là quản trị viên nên không thể đặt hàng được!',
            })
        } else {

            $.ajax({
                type: 'POST',
                url: 'inlcudes_function/order.php',
                data: {
                    ID_Customer: CurrentUser,
                    Create_At: timeNow,
                    Total: sum,
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    console.log(data);
                    if (data['message'] == 0) {
                        // sử dụng thư viện sweetaler thông báo cho đẹp :v
                        let timerInterval
                        Swal.fire({
                            title: 'Đặt hàng thành công!',
                            html: 'Quay lại trang chủ trong <strong></strong> giây tới.',
                            //icon: "success",
                            imageUrl: '../img/cat.gif',
                            imageWidth: 315,
                            imageHeight: 230,
                            timer: 1500,
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
                            title: 'Thông báo',
                            text: 'Bạn chưa cập nhật địa chỉ giao hàng!',
                            confirmButtonText: 'Cập nhật',
                        }).then((result) => {
                            // click vào đăng nhập thì show modal đăng nhập
                            if (result.isConfirmed) {
                                window.location.href = "../../customers/Chi-tiet.php";
                            }
                        })
                    }
                }
            });
        }
    });
});