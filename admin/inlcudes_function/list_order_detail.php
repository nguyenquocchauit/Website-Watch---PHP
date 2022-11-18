<?php

// if (!isset($_SESSION['CurrentUser']['ID']) && !isset($_SESSION['CurrentUser']['Role']) && $_SESSION['CurrentUser']['Role'] != 'Admin') {
//     header('Location: ../../home.php');
//     exit();
// }
function Show_List_Order_Detail($conn, $IDOrder, $IDCus)
{

    $sql = "SELECT a.ID_Detail as IDDetail, a.ID_Product as IDProduct, c.Image,b.Create_At as CreateAt,a.Quantity,a.Price,a.Total FROM `order_details` a inner join orders b on a.ID_Order=b.ID_Order inner join products c on c.ID_Product = a.ID_Product WHERE 1 AND b.ID_Order='$IDOrder'";
    $result = mysqli_query($conn, $sql);
    //////////////////
    //  TÌM TỔNG SỐ RECORDS

    $total_records = mysqli_num_rows($result);


    //  TÌM LIMIT VÀ CURRENT_PAGE
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 5;

    //  TÍNH TOÁN TOTAL_PAGE VÀ START
    // tổng số trang
    $total_page = ceil($total_records / $limit);

    // Giới hạn current_page trong khoảng 1 đến total_page
    if ($current_page > $total_page) {
        $current_page = $total_page;
    } else if ($current_page < 1) {
        $current_page = 1;
    }

    // Tìm Start
    $start = ($current_page - 1) * $limit;
    $sql = "SELECT a.ID_Detail as IDDetail, a.ID_Product as IDProduct, c.Image,b.Create_At as CreateAt,a.Quantity,a.Price,a.Total FROM `order_details` a inner join orders b on a.ID_Order=b.ID_Order inner join products c on c.ID_Product = a.ID_Product WHERE 1 AND b.ID_Order='$IDOrder' LIMIT $start, $limit";
    $result = mysqli_query($conn, $sql);
    $sqlName = "SELECT CONCAT(First_Name,' ',Last_Name) as name FROM `customers` WHERE 1 and ID_Customer='$IDCus'";
    $resultName = mysqli_query($conn, $sqlName);
    $rowName = mysqli_fetch_array($resultName);
    $name = explode(" ", $rowName['name']);
    $name = $name[(sizeof($name) - 2)] . " " . $name[(sizeof($name) - 1)];
    echo '
    <h4 class="text-center mb-5">Chi tiết hóa đơn <p>' . ($name) . '</p> </h4> 
    <div class=""mb-4></div>
          <table class="">
             <tr class="tr1">
             <td>
                   <p>STT</p>   
                </td>
                <td>
                   <p>Mã chi tiết đặt hàng</p>
                </td>
                <td>
                   <p>Mã sản phẩm</p>
                </td>
                <td>
                   <p>Sản phẩm</p>
                </td>
                <td>
                   <p>Thời gian</p>
                </td>
                <td>
                   <p>Số lượng</p>
                </td>
                <td>
                   <p>Giá</p>
                </td>
                <td>
                   <p>Tổng</p>
                </td>
             </tr>
    ';
    $i = 1;
    while ($row = mysqli_fetch_array($result)) {
        $img1 = explode(",", $row['Image']);
        echo '
        <tr>
            <td>' . ($i) . '</td>
            <td>
                <p>' . ($row['IDDetail']) . '</p>
            </td>
            <td>
                <p>' . ($row['IDProduct']) . '</p>
            </td>
            <td>
                <img src="../img/image_products_home/' . ($img1[0]) . '" alt="" srcset="">
            </td>
            <td>
                <p>' . (date("d-m-Y", strtotime($row['CreateAt']))) . '</p>
            </td>
            <td>
                <p>' . ($row['Quantity']) . '</p>
            </td>
            <td>
                <p>' . (number_format($row['Price'])) . ' VNĐ</p>
            </td>
            <td>
                <p>' . (number_format($row['Total'])) . ' VNĐ</p>
            </td>
        </tr>
    ';
        $i++;
    }
    echo '</table>';
    echo '<div class="pagination modal-2 mb-4">';
    if ($total_page > 1) {
        // BƯỚC 7: HIỂN THỊ PHÂN TRANG
        // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
        if ($current_page > 1 && $total_page > 1) {
            echo '<a href="Chi-tiet-dat-hang-cua-khach-hang.php?&id=' . ($IDOrder) . '&page=' . (1) . '"> &laquo; </a>  ';
            echo '<a href="Chi-tiet-dat-hang-cua-khach-hang.php?&id=' . ($IDOrder) . '&page=' . ($current_page - 1) . '"> &lt; </a>  ';
        }
        // Lặp khoảng giữa
        for ($i = 1; $i <= $total_page; $i++) {
            // Nếu là trang hiện tại thì hiển thị thẻ span
            // ngược lại hiển thị thẻ a
            if ($i == $current_page) {
                echo '<a>' . $i . '</a>  ';
            } else {
                echo '<a href="Chi-tiet-dat-hang-cua-khach-hang.php?&id=' . ($IDOrder) . '&page=' . $i . '">' . $i . '</a>  ';
            }
        }
        // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
        if ($current_page < $total_page && $total_page > 1) {
            echo '<a href="Chi-tiet-dat-hang-cua-khach-hang.php?&id=' . ($IDOrder) . '&page=' . ($current_page + 1) . '"> &gt; </a>  ';
            echo '<a href="Chi-tiet-dat-hang-cua-khach-hang.php?&id=' . ($IDOrder) . '&page=' . ($total_page) . '"> &raquo; </a>  ';
        }
    }
    echo '</div>';
}
