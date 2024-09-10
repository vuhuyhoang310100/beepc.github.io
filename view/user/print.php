<?php
require '../../vendor/autoload.php';
require '../../config/db.php';
require '../../models/product.php';
$db = new Database;
$product = new SanPham($db->getConnection());

use Dompdf\Dompdf;

if (isset($_GET['cardid'])) {
    $id = $_GET['cardid'];
    $sql = "SELECT * FROM carts where cart_id = $id";
    $row = $db->executeQueryOne($sql);
}
if (!empty($id)) {
    $sql = "SELECT * FROM cart_details where cart_id = $id";
    $rows = $db->executeQueryAll($sql);
    $sum = 0;
}



$html =  '<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif; 
        }
        .th-right {
            text-align: right;
        }
        .container {
            width: 100%;
        }
        h2 {
            text-align: center;
        }
        .table, .table-tr > .table-th, .table-td{
            border: 1px solid black;
            width: 100%;
            border-collapse: collapse;
        }
        .table-tr{
            background-color: #c6bebe;
        }
        .table-td{
            text-align:center;}
    </style>
</head>
<body>
<div class="container">
        <h2>Hoá đơn</h2>
        <hr>
    <table>
        <tr>
            <th class="th-right">Tên khách hàng: </th>
            <td>' . $row['fullname'] . '</td>
        </tr>
        <tr>
            <th class="th-right">Mã đơn hàng: </th>
            <td>' . $row['code_cart'] . '</td>
        </tr>
        <tr>
            <th class="th-right">Số điện thoại: </th>
            <td>' . $row['telephone'] . '</td>
        </tr>
        <tr>
            <th class="th-right">Ngày mua hàng: </th>
            <td>' . $row['cart_date'] . '</td>
        </tr>
    </table>
    <table class="table">
        <tr class="table-tr">
            <th class="table-th">Tên sản phẩm</th>
            <th class="table-th">Số lượng</th>
            <th class="table-th">Đơn giá</th>
            <th class="table-th">Thành tiền</th>
        </tr>';
foreach ($rows as $value) {
    $sum += $value['price'];
    $price = $product->get_price_byid($value['product_id']);
    $html .= '<tr>
        <td class="table-td">' . $value['name'] . '</td>
        <td class="table-td">' . $value['quantity'] . '</td>
        <td class="table-td">' . number_format($price, 0, ',', '.') . ' vnđ</td>
        <td class="table-td">' . number_format($value['price'], 0, ',', '.') . ' vnđ</td>
    </tr>';}
if ($sum >= 20000000) {
    $ship = "Miễn phí";} else {
    $ship = number_format(50000, 0, ',', '.') . ' vnđ';}
$html .= '
<tr>
<td class="table-td" colspan="3">Ship: </td>
<td class="table-td" style="color:red;">' . $ship . '</>
</tr>
<tr>
<td class="table-td" colspan="3">VAT: </td>
<td class="table-td" style="color:red;"> 5%</>
</tr>
<tr>
<td class="table-td" colspan="3">Tổng thanh toán: </td>
<td class="table-td" style="color:red;">' . number_format($row['total'], 0, ',', '.') . ' vnđ</>
</tr>
</table>
</div>
</body>
</html>';
$dompdf = new DOMPDF();
$dompdf->loadHtml($html, 'UTF-8');
$dompdf->setPaper('A4');
$dompdf->render();
$dompdf->stream();
