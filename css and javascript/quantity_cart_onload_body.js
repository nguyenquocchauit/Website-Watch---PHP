$(document).ready(function () {
    // tải lại trang sẽ hiển thị lại số lượng sản phẩm trong giỏ hàng lưu tại session[cart]
    window.onload = function () {
        /*
            Các đối tượng XMLHttpRequest (XHR) được sử dụng để tương tác với các máy chủ. 
            Bạn có thể truy xuất dữ liệu từ một URL mà không cần phải làm mới toàn bộ trang. 
            Điều này cho phép một trang Web chỉ cập nhật một phần của trang mà không làm gián đoạn những gì người dùng đang làm.
        */
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
    };
});