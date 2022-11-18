$(document).ready(function () {



    // Bắt sự kiện click thêm giỏ hàng thêm hiệu ứng animation tới icon giỏ hàng
    $('.button-update').on('click', function () {

        // For Multiple Files:
        var file = $('#imageButton').prop("files");
        // Making the form object
        var form = new FormData();
        // Adding the image to the form
        //form.append("image", file[0]);
        for (var i = 0; i <= file.length - 1; i++) {

            form.append("files[]", file[i]);
        }
        for (const value of form.values()) {
            console.log(value.name + " & " + value.size);
        }
        console.log(file.length);
        // The AJAX call
        $.ajax({
            url: 'inlcudes_function/update_product.php',
            type: "POST",
            data: form,
            contentType: false,
            processData: false,
            success: function (result) {
                var data = JSON.parse(result);
                console.log(data);
                //document.write(result);
            }
        });


    });







    $('.delete-product').on('click', function () {
        var $click = $(this);
        var _ID_Product = $click.parent(".delete-submit").find(".inp_ID").val();
        console.log(_ID_Product);
        Swal.fire({
            title: 'Bạn chắc chắn muốn xóa?',
            text: "Xóa sẽ không thể nào hoàn tác!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButtonText: "Thoát",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: 'inlcudes_function/delete_product.php',
                    data: {
                        action: "delete",
                        ID_Product: _ID_Product,
                    },
                    success: function (data) {
                        var data = JSON.parse(data);
                        console.log(data);
                        if (data['message'] == 0) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Đã xóa!',
                                timer: 1200,
                                timerProgressBar: true,
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) { window.location.href = "Danh-sach-san-pham.php"; }
                            })

                        }
                    }
                })

            }
        })
    });
});