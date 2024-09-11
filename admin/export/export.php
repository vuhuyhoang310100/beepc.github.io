<?php
include_once ('../../config/db.php');
include_once('../../global.php');
include('../func/switch.php');
require_once('./PhpXlsxGenerator.php');
require_once('../../models/cart.php');


$fileName = "orders-data_".date('Y-m-d').".xlsx";

$excelData[] = array('ID','Tên khách hàng','Địa chỉ','Email','Điện thoại','Tổng tiền','Phương thức thanh toán','Trạng thái thanh toán','Trạng thái đơn hàng','Ngày đặt');

$order = new Cart($conn);

$query = $conn->executeQueryAll("SELECT * FROM carts ORDER BY cart_id ASC");

    foreach ($query as $item) {
        $pay_status = pay_status($order->showpay_status($item['cart_id']));
        $cart_status = cart_status($order->showcart_status($item['cart_id']));
        $lineData = array($item['cart_id'],$item['fullname'],$item['address'],$item['email'],$item['telephone'],$item['total'],get_paymethod($item['pay_method']),$pay_status,$cart_status,$item['cart_date']);
        $excelData[] = $lineData;


    }

    $xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
    $xlsx->downloadAs($fileName); 
    exit;



?>
