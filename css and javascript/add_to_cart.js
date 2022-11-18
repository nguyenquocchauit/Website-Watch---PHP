$(document).ready(function () {
    // Bắt sự kiện click thêm giỏ hàng thêm hiệu ứng animation tới icon giỏ hàng
    $('.add-to-cart').on('click', function () {
        var cart = $('.shopping-cart');
        var imgtodrag = $(this).parent('.product-item-desc-button-submit').parent('.product-item-desc').parent(".product-item").find(".product-item-img").find("img").eq(0);
        // tìm đúng các value của phần tử theo vị trí nút button được click 
        var _productID = $(this).parent('.product-item-desc-button-submit').find(".productID").val();
        var _productName = $(this).parent('.product-item-desc-button-submit').find(".productName").val();
        var _productImage = $(this).parent('.product-item-desc-button-submit').find(".productImage").val();
        var _productQuantity = $(this).parent('.product-item-desc-button-submit').find(".productQuantity").val();
        var _productPrice = $(this).parent('.product-item-desc-button-submit').find(".productPrice").val();
        var _actionFrom = $(this).parent('.product-item-desc-button-submit').find(".actionFrom").val();

        if (imgtodrag) {
            // tạo phần tử sao chép giống phần tử cha. Tức là copy ra 1 ảnh như vậy

            var imgclone = imgtodrag.clone()
                .offset({
                    //offset lấy vị trí top & left của img gốc
                    top: imgtodrag.offset().top,
                    left: imgtodrag.offset().left
                })
                .css({
                    // thiết lập css
                    'opacity': '0.5',
                    'position': 'absolute',
                    'height': '250px',
                    'width': '200px',
                    'z-index': '100'
                })
                .appendTo($('body') /* thêm vào body hiển thị ra giao diện*/)
                .animate({
                    // animation cho img tới giỏ hàng
                    top: cart.offset().top + 10,
                    left: cart.offset().left + 10,
                    width: 75,
                    height: 75,
                    position: "absolute",
                }, 1000);
            imgclone.animate({
                'width': 0,
                'height': 0

            }, function () {
                if (_actionFrom == "home.php")
                    url = 'product and cart/inlcudes_function/product_cart.php';
                else
                    url = 'inlcudes_function/product_cart.php';
                console.log(_productID, _productName, _productImage, _productQuantity, _productPrice);
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        action: "additems",
                        productID: _productID,
                        productName: _productName,
                        productImage: _productImage,
                        productQuantity: _productQuantity,
                        productPrice: _productPrice,
                    },
                    success: function (data) {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function () {
                            /*
                                readyState ==1 : UNSENT
                                readyState ==2 : OPENED
                                readyState ==3 : LOADING
                                readyState ==4 : DONE

                                UNSENT: 0
                                OPENED: 0
                                LOADING: 200
                                DONE: 200
                                
                                responseText trả về từ file được send
                            */
                            if (this.readyState == 4 && this.status == 200) {

                                document.getElementById("quantity-shopping-cart").innerHTML = this.responseText;
                            }
                        }
                        // gọi file quantity_shopping_cart.php xử lý tổng sản phẩm trong giỏ hàng
                        xmlhttp.open("GET", "../product and cart/inlcudes_function/quantity_shopping_cart.php");
                        xmlhttp.send();
                    }
                });
                Swal.fire({
                    position: 'top-end',
                    //icon: 'success',
                    imageUrl: '../img/image_products_home/' + _productImage,
                    imageWidth: 70,
                    imageHeight: 90,
                    title: 'Đã thêm sản phẩm ' + _productName.toLowerCase() + ' vào giỏ hàng!',
                    showConfirmButton: false,
                    timer: 1300
                });
                $(this).detach()
            });
        }
    });
});