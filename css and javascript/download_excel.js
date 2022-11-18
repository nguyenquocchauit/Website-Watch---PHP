$(document).ready(function () {
    $("#button-download-excel").on("click", function () {

        $.ajax({
            type: "GET",
            url: "inlcudes_function/download_file_excel.php",
            data: {
                Action: "download-list-order",
            },
            cache: false,
            success: function (result) {
                window.open('inlcudes_function/download_file_excel.php?Action=download-list-order');
            }
        });
    })
});