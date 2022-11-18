<?php
require '../../config/connectDB.php';

// Lọc dữ liệu excel 
function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}
if (isset($_GET['Action']) && $_GET['Action'] == 'download-list-order') {
    // Tên tệp Excel để tải xuống
    $fileName = "DS đặt hàng của KH_" . date('d-m-Y') . ".xls";
    // Tên cột
    $fields = array('Mã đặt hàng', 'Mã khách hàng', 'Thời gian', 'Trạng thái', 'Mô tả', 'Tổng tiền');
    // Hiển thị tên cột dưới dạng hàng đầu tiên
    $excelData = implode("\t", array_values($fields)) . "\n";
    // Tìm nạp bản ghi từ cơ sở dữ liệu
    $sql = "SELECT a.ID_Order as IDOrder ,a.ID_Customer,a.Create_At as Create_Order,b.Status,b.Description,a.Total 
    FROM `orders` a inner JOIN transaction b on a.ID_Order = b.ID_Order WHERE 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $create_at = date("d-m-Y", strtotime($row['Create_Order']));
            $total = number_format($row['Total']) . " VNĐ";
            $lineData = array($row['IDOrder'], $row['ID_Customer'], $create_at, $row['Status'], $row['Description'], $total);
            array_walk($lineData, 'filterData');
            $excelData .= implode("\t", array_values($lineData)) . "\n";
            $array_message['message'] = 0;
        }
    } else {
        $excelData .= 'Không có dữ liệu' . "\n";
    }
    
    // Tiêu đề để tải xuống
    header("Content-Type: application/vnd.ms-excel", "charset=utf-8");
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Cache-Control: max-age=0");
    mb_convert_encoding($excelData, 'UTF-8');
    // Kết xuất dữ liệu excel
    echo $excelData;

    exit;
}
