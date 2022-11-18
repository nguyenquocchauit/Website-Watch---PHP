$(document).ready(function () {
    // bắt sự kiện hiển thị dropdown lịch sử cart
    // bắt sự kiện phần tử có id show_history_cart show lịch cart
    var obj = document.getElementById('show_history_cart');
    obj.addEventListener('mouseover', function () {
        var x = document.getElementById("dropdown_cart");
        x.classList.add("show");
        // thiết lập thời gian show 2 giây
        setTimeout(function () {
            x.classList.remove("show");
        }, 2000);
    });

    // tìm phần tử con của dropdown_cart là các thẻ li tồn tại
    var obj_hidden = document.getElementById('dropdown_cart').getElementsByClassName('dropdown_hidden')[0];
    obj_hidden.addEventListener('mouseout', function () {
        // di chuyển chuột ra ngoài li sẽ remove class show
        document.getElementById('dropdown_cart').classList.remove("show");
    });
});