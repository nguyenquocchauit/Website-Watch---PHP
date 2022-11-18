$(document).ready(function () {

    // Bắt sự kiện chọn hãng trong ds sản phẩm
    $('#brand').on('change', function () {
        // tìm đến tag option
        var option = $(this).find('option:selected');
        // lấy giá trị option được select
        var value = option.val();
        // kiểm tra giá trị id gender có đang được select không 
        var id_gender = $('#inp-id-gender').val();
        // nếu tồn tại thì gán vào trong đường dẫn và ngược lại
        if (id_gender.lenght != 0 && id_gender != "")
            window.location.href = "Danh-sach-san-pham.php?brand=" + value + "&gender=" + id_gender + "&page";
        else
            window.location.href = "Danh-sach-san-pham.php?brand=" + value + "&gender=&page";
    });

    // Bắt sự kiện chọn loại giới tính trong ds sản phẩm
    $('#gender').on('change', function () {
        // tìm đến tag option
        var option = $(this).find('option:selected');
        // lấy giá trị option được select
        var value = option.val();
        console.log(value);
        // kiểm tra giá trị id brand có đang được select không 
        var id_brand = $('#inp-id-brand').val();
        // nếu tồn tại thì gán vào trong đường dẫn và ngược lại
        if (id_brand.lenght != 0 && id_brand != "")
            window.location.href = "Danh-sach-san-pham.php?brand=&gender=" + value + "&page";
        else
            window.location.href = "Danh-sach-san-pham.php?brand=" + id_brand + "&gender=" + value + "&page";
    });
}); 