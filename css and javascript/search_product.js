// sử dụng công nghệ AJAX

// bắt sự kiện thay đổi ký tự trong input search. Xử lý đưa dữ liệu ra bên ngoài từ từ khóa tìm kiếm
function search(str) {
    if (str.length != 0) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            /*
                readyState ==1 : UNSENT
                readyState ==2 : OPENED
                readyState ==3 : LOADING
                readyState ==4 : DONE
            */
            /*
                UNSENT: 0
                OPENED: 0
                LOADING: 200
                DONE: 200
             */
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("searchResult").innerHTML = this.responseText;
                
            }
        }
        // gọi file search.php và truyền tham số get search
        xmlhttp.open("GET", "../product and cart/inlcudes_function/search.php?search=" + str, true);
        xmlhttp.send();
        // hiển thị ô kết quả tìm kiếm khi bắt được sự kiện
        document.getElementById("searchResult").classList.toggle("showSearchResult");
    }
};