<?php
function get_paymethod($n)
{
  switch ($n) {
    case '1':
      $method = "Tiền mặt";
      break;
    case '2':
      $method = "Chuyển khoản";
      break;
    case '3':
      $method = "VNPAY";
      break;


    default:
      $method = "Tiền mặt";
      break;
  }
  return $method;
}
function pay_status($n)
{
  switch ($n) {
    case '0':
      $method = "Chưa thanh toán";
      break;
    case '1':
      $method = "Đã thanh toán";
      break;    
  }
  return $method;
}
function cart_status($n)
{
  switch ($n) {
    case '0':
      $method = "Chưa xử lý";
      break;
    case '1':
      $method = "Đã xác nhận";
      break;
    case '2':
      $method = "Đang giao hàng";
      break;
    case '3':
        $method = "Hoàn tất";
        break;


  }
  return $method;
}


function get_paystatus($n)
{
  if ($n == 1) {
    $status = '<div class="form-group">
        <select class="form-control" name="pay_status" id="sel1">
          <option value="0">Chưa thanh toán</option>
          <option value="1" selected>Đã thanh toán</option>
        </select>
      </div>';
  } else {
    $status = '<div class="form-group">
        <select class="form-control" name="pay_status" id="sel1">
          <option value="0" selected>Chưa thanh toán</option>
          <option value="1">Đã thanh toán</option>
        </select>
      </div>';
  }
  return $status;
}
function get_cartstatus2($n)
{
  switch ($n) {
    case '0':
      $method = "Chưa xử lý";
      break;
    case '1':
      $method = "Đã xác nhận";
      break;
    case '2':
      $method = "Đang giao hàng";
      break;
    case '3':
      $method = "Hoàn tất";
      break;
    default:
      $method = "Chưa xử lý";
      break;
  }
  return $method;
}
function get_cartstatus($n)
{
  switch ($n) {
    case '0':
      $status = '<div class="form-group">
      <select class="form-control" name="pay_status" id="sel1" onchang>
        <option value="0" selected>Chưa xử lý</option>
        <option value="1">Đã xác nhận</option>
        <option value="2">Đang giao hàng</option>
        <option value="3">Hoàn tất</option>
      </select>
    </div>';
      break;
    case '1':
      $status = '<div class="form-group">
        <select class="form-control" name="pay_status" id="sel1">
          <option value="0" >Chưa xử lý</option>
          <option value="1" selected>Đã xác nhận</option>
          <option value="2">Đang giao hàng</option>
          <option value="3">Hoàn tất</option>
        </select>
      </div>';
      break;
    case '2':
      $status = '<div class="form-group">
          <select class="form-control" name="pay_status" id="sel1">
            <option value="0">Chưa xử lý</option>
            <option value="1">Đã xác nhận</option>
            <option value="2" selected>Đang giao hàng</option>
            <option value="3">Hoàn tất</option>
          </select>
        </div>';
      break;
    case '3':
      $status = '<div class="form-group">
        <select class="form-control" name="pay_status" id="sel1">
          <option value="0">Chưa xử lý</option>
          <option value="1">Đã xác nhận</option>
          <option value="2">Đang giao hàng</option>
          <option value="3" selected>Hoàn tất</option>
        </select>
      </div>';
      break;

    default:
      $status = '<div class="form-group">
    <select class="form-control" name="pay_status" id="sel1">
      <option value="0" selected>Chưa xử lý</option>
      <option value="1">Đã xác nhận</option>
      <option value="2">Đang giao hàng</option>
      <option value="3" >Hoàn tất</option>
    </select>
  </div>';
      break;
  }
  return $status;
}
