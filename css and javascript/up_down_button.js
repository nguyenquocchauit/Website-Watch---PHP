$(function() {
    // thêm nút tăng giảm vào trước và sau input số lượng
    $(".numbers-row").find(".desc").append('<button class="btnquantity buttonn">+</button>')
    $(".numbers-row").find(".asc").append('<button class="btnquantity buttonn">-</button>')
    // bắt sự kiện click vào nút tăng giảm số lượng trong giỏ hàng
    $(".buttonn").on("click", function() {

        var $button = $(this);
        // lấy giá trị của thẻ input hiển thị
        var oldValue = $button.parent().parent().find(".inpqan").find(".inpquantity").val();
        // lấy vị trí. tức là id sản phẩm theo value của input
        var ID_quantity = $button.parent().parent().find(".inpqan").find(".ID_Quantity").val();
        // kiểm tra số lượng trên 5 thì không được đặt hàng phải liên hệ tư vấn viên
        console.log(oldValue);
        if (oldValue >= 5 && ($button.text() == "+")) {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo',
                text: 'Khách hàng đặt trên 5 sản phẩm vui lòng trao đổi trực tiếp với tư vấn viên. Cảm ơn!',
                footer: '<a href="">Liên hệ</a>'
            })
        } else {
            // nếu là + thì cập nhật input thêm 1 và ngược lại với -
            if ($button.text() == "+") {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            //console.log(oldValue);
            // xử lý tăng giảm bằng file quantity_cart.php
            $.ajax({
                type: 'POST',
                url: 'inlcudes_function/quantity_cart.php',
                data: {
                    itemID: ID_quantity,
                    quantity: newVal
                },
                success: function(data) {
                    var datas = JSON.parse(data);
                    console.log(datas);
                    if (datas['message'] == 0) {
                        window.location.href = datas['success'];
                    }
                }
            });
        }
        // thay đổi giá trị của input
        // $button.parent().parent().find(".inpqan").find(".inpquantity").val(newVal);

    });
});
