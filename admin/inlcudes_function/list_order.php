<?php

function Show_List_Order($conn)
{
    $sql = "SELECT a.ID_Order as IDOrder ,a.ID_Customer,a.Create_At as Create_Order,b.Status,b.Description,a.Total FROM `orders` a inner JOIN transaction b on a.ID_Order = b.ID_Order WHERE 1";
    $result = mysqli_query($conn, $sql);
    echo '<h4 class=" mb-1 pt-1">Danh sách khách hàng oder</h4>
    <table class="mb-5">
    <tr>
        <td colspan="6"></td>
        <td><button  type="button" class="btn btn-secondary button-download-excel" id="button-download-excel">Tải file Excel</button></td>
    </tr>
    <tr class="tr1">
        <td>STT</td>
        <td>
            <p>Mã đặt hàng</p>
        </td>
        <td>
            <p>Mã khách hàng</p>
        </td>
        <td>
            <p>Thời gian</p>
        </td>
        <td>
            <p>Trạng thái</p>
        </td>
        <td>
            <p>Mô tả</p>
        </td>
        <td>
            <p>Tổng tiền</p>
        </td>
    </tr>
    ';
    $i = 1;
    while ($row = mysqli_fetch_array($result)) {
        $addclass = null;
        if ($row['Status'] == 'Chưa thanh toán')
            $addclass = 'text-danger';
        else  if ($row['Status'] == 'Đã thanh toán')
            $addclass = 'text-success';
        echo '
        <tr>
            <td>' . ($i) . '</td>
            <td><a class="a-href" href="Chi-tiet-dat-hang-cua-khach-hang.php?idorder=' . ($row['IDOrder']) . '&idcus=' . ($row['ID_Customer']) . '">' . ($row['IDOrder']) . '</a></td>
            <td>' . ($row['ID_Customer']) . '</td>
            <td>' . (date("d-m-Y", strtotime($row['Create_Order']))) . '</td>
            <td  class="status ' . ($addclass) . '">' . ($row['Status']) . '</td>
            <td>' . ($row['Description']) . '</td>
            <td>' . (number_format($row['Total'])) . ' VNĐ</td>
        </tr>
        ';
        $i++;
    }
    echo '</table>';
}
