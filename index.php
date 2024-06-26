<?php
session_start();
ob_start();

include 'config/db.php';
require_once 'config/vnpay.php';
require 'mail/sendmail.php';
include "global.php";
include "models/product.php";
include "models/category.php";
include "models/user.php";
include "models/cart.php";
include "models/rating.php";
include "models/comment.php";
include "view/layout/header.php";
include "admin/func/switch.php";


?>
<?php
if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
}

?>
<?php
if ((isset($_GET['act'])) && ($_GET['act'] != "")) {
        $act = $_GET['act'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentDate = date('Y-m-d H:i:s');
        switch ($act) {
                case 'product':
                        $sanpham = new SanPham($conn);

                        if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                        } else {
                                $id = 0;
                        }
                        if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                        } else {
                                $page = 1;
                        }
                        if ($page == '' || $page == 1) {
                                $begin = 0;
                        } else {
                                $begin = ($page * 9) - 9;
                        }

                        $products = $sanpham->showsp($id, $begin);
                        if (isset($_POST['productid'])) {
                                $id = $_POST['productid'];
                                $name = $_POST['name'];
                                $img = $_POST['img'];
                                $price = $_POST['price'];
                                if (isset($_POST['quantity']) && ($_POST['quantity']) > 0) {
                                        $count = $_POST['quantity'];
                                } else {
                                        $count = 1;
                                }
                                $temp = 0;
                                $total = $price * $count;
                                $i = 0;
                                //Kiểm tra sản phẩm trùng nhau
                                foreach ($_SESSION['cart'] as $item) {
                                        if ($item[1] == $name) {
                                                $newcount = $count + $item[4];
                                                $_SESSION['cart'][$i][4] = $newcount;
                                                $_SESSION['cart'][$i][5] = $newcount * $_SESSION['cart'][$i][3];
                                                $temp = 1;
                                                break;
                                        }
                                        $i++;
                                }
                                if ($temp == 0) {
                                        $product = [$id, $name, $img, $price, $count, $total];
                                        array_push($_SESSION['cart'], $product);
                                        $_SESSION['cart_count'] = count($_SESSION['cart']);
                                }
                                echo '<div class="d-flex justify-content-end align-items-end">
                                <div id="myAlert" style="margin-bottom:0;" class="w-25 alert alert-success alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0,0,256,256">
                                <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="translate(0,-21.33333) scale(5.33333,5.33333)"><path d="M44,24c0,11.045 -8.955,20 -20,20c-11.045,0 -20,-8.955 -20,-20c0,-11.045 8.955,-20 20,-20c11.045,0 20,8.955 20,20z" fill="#4caf50"></path><path d="M34.602,14.602l-13.602,13.597l-5.602,-5.598l-2.797,2.797l8.399,8.403l16.398,-16.402z" fill="#ccff90"></path></g></g>
                                </svg> Thêm vào giỏ hàng thành công.
                              </div></div>';
                        }
                        include "view/layout/sidebar.php";
                        include "view/product/product.php";
                        break;
                case 'rating':
                        $rating = new Rating($conn);
                        $ratingValue = $_POST['ratingValue'];
                        $product_id = $_POST['product_id'];
                        $user_id = $_SESSION['id_user'];
                        $rating->insert_rating($product_id, $user_id, $ratingValue);
                        break;
                case 'login':
                        if (isset($_SESSION['registration_success']) && $_SESSION['registration_success']) {
                                echo "<script>alert('Bạn đã đăng ký thành công!');</script>";
                                header("Location: auth/login.php");
                                unset($_SESSION['registration_success']);
                        }
                        header("Location: auth/login.php");
                        break;
                case 'register':
                case 'logout':
                        unset($_SESSION['role']);
                        unset($_SESSION['username']);
                        unset($_SESSION['email']);
                        unset($_SESSION['cart']);
                        unset($_SESSION['id_user']);
                        unset($_SESSION['save-sucess']);
                        header("Location: index.php ");
                        break;
                case 'delcart':
                        if (isset($_SESSION['cart'])) {
                                unset($_SESSION['cart']);
                        }
                        include "view/order/form.php";
                        break;
                case 'productdetails':
                        $sanpham = new SanPham($conn);
                        if (isset($_GET['pdt']) && $_GET['pdt'] > 0) {
                                $pdt = $_GET['pdt'];
                                $spct = $sanpham->showspct($pdt);
                                $img = USER_PATH . $spct['img'];
                                // Fix trường hợp không có $pdt 05/03/2024
                                if ($pdt != $spct['product_id']) {
                                        header("Location: index.php?act=product");
                                } else {
                                        $countreview = $sanpham->countreview($pdt);
                                        if (isset($_POST['addcart'])) {
                                                $id = $_POST['productid'];
                                                $name = $_POST['name'];
                                                $img = $_POST['img'];
                                                $price = $_POST['price'];
                                                if (isset($_POST['quantity']) && ($_POST['quantity']) > 0) {
                                                        $count = $_POST['quantity'];
                                                } else {
                                                        $count = 1;
                                                }
                                                $temp = 0;
                                                $total = $price * $count;
                                                $i = 0;
                                                // Kiểm tra sản phẩm trùng nhau
                                                foreach ($_SESSION['cart'] as $item) {
                                                        if ($item[1] == $name) {
                                                                $newcount = $count + $item[4];
                                                                $_SESSION['cart'][$i][4] = $newcount;
                                                                $_SESSION['cart'][$i][5] = $newcount * $_SESSION['cart'][$i][3];
                                                                $temp = 1;
                                                                break;
                                                        }
                                                        $i++;
                                                }
                                                if ($temp == 0) {
                                                        $product = [$id, $name, $img, $price, $count, $total];
                                                        array_push($_SESSION['cart'], $product);
                                                        $_SESSION['cart_count'] = count($_SESSION['cart']);
                                                }
                                                echo '<script>alert("Success");</script>';
                                        }
                                }
                                include "view/product/productdetails.php";
                        } else {
                                header("Location: index.php?act=product");
                        }
                        break;
                case 'thanks':
                        include "view/checkout/thanks.php";
                        break;
                case 'checkout':
                        date_default_timezone_set('Asia/Ho_Chi_Minh');

                        $usermod = new User($conn);
                        $cart = new Cart($conn);
                        if (empty($_SESSION['cart'])) {
                                header("Location: index.php?act=cart");
                        }
                        if (isset($_POST['success'])) {
                                if (!empty($_POST['voucher'])) {
                                        $infovoucher = $cart->getinfovoucher($_POST['voucher']);
                                        $startDate = isset($infovoucher['start']) ? $infovoucher['start'] : null;
                                        $endDate = isset($infovoucher['end']) ? $infovoucher['end'] : null;
                                        $value = isset($infovoucher['discount_rate']) ? $infovoucher['discount_rate'] : null;
                                        if ($startDate !== null && $endDate !== null) {
                                                $currentDateTime = new DateTime($currentDate);
                                                $startDateTime = new DateTime($startDate);
                                                $endDateTime = new DateTime($endDate);
                                                if ($currentDateTime >=  $startDateTime && $currentDateTime <= $endDateTime) {
                                                        $_SESSION['voucher'] = $value;
                                                } else {
                                                        $_SESSION['voucher'] = 0;
                                                }
                                        } else {
                                                // Xử lý trường hợp không có giá trị hợp lệ cho ngày bắt đầu hoặc kết thúc
                                                $_SESSION['voucher'] = 0;
                                        }
                                } else {
                                        $_SESSION['voucher'] = 0;
                                }
                        }
                        if (isset($_POST['redirect'])) {
                                $fullname = $_POST['fullname'];
                                $tel = $_POST['tel'];
                                $add = $_POST['address'];
                                $paymentMethod = $_POST['paymentMethod'];
                                if (!isset($_SESSION['id_user'])) {
                                        $emailuser = $_POST['email'];
                                        $username = "bee" . rand(1, 999);
                                        $password = md5("123456");
                                        $iduser = $usermod->addandgetlastid($username, $password, $emailuser);
                                } else {
                                        $user_detail = $usermod->getdetailsbyid($_SESSION['id_user']);
                                        $email = $usermod->getuserbyid($_SESSION['id_user']);
                                        $iduser = $_SESSION['id_user'];
                                        $fullname = $user_detail['fullname'];
                                        $emailuser = $email['email'];
                                }

                                $codecart = "BeeTech" . rand(0, 999);
                                //Sử dụng phương thức để trả về id vừa insert
                                if ($paymentMethod == 1 || $paymentMethod == 2) {
                                        $idcart = $cart->insertcart($codecart, $iduser, $fullname, $add, $emailuser, $tel, $_SESSION['totalall'], $paymentMethod);
                                        if ($idcart) {
                                                foreach ($_SESSION['cart'] as $cartdetails) {
                                                        $id_sanpham = $cartdetails['0'];
                                                        $soluong = $cartdetails['4'];
                                                        $name = $cartdetails['1'];
                                                        $price = $cartdetails['3'];
                                                        $total = $cartdetails['5'];
                                                        $addcartdetails = $cart->insertcart_details($idcart, $id_sanpham, $name, $soluong, $total);
                                                }
                                                $mailaddress = $emailuser;
                                                $title = "Cảm ơn quý khách đã đặt hàng tại Bee-Tech";
                                                $content = "<h5>Đơn hàng bao gồm: </h5>";
                                                $content .= "<h5>Mã hoá đơn: " . $codecart . "</h5>";
                                                $sum = 0;
                                                foreach ($_SESSION['cart'] as $key) {
                                                        $sum += $key[5];
                                                        $content .= "<ul class='list-group list-group-flush'>

                                                                   <li class='list-group-item'>Tên sản phẩm: " . $key[1] . "</li>
                                                                   <li class='list-group-item'>Số lượng: " . $key[4] . "</li>
                                                                   <li class='list-group-item'>Đơn giá: " . $key[3] . "</li>
                                                                   <li class='list-group-item'>Thành tiền: " . $key[5] . "</li>
                                                                 </ul>";
                                                }
                                                $content .= "<h4>Tổng hoá đơn: " . $sum . "</h4>";
                                                $mail = new Mailer();
                                                $mail->sendmail($title, $content, $mailaddress, $fullname);
                                                unset($_SESSION['cart']);
                                                header("Location: index.php?act=thanks");

                                                // xử lý vnpay method
                                        }
                                } else {
                                        $vnp_TxnRef = $codecart; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
                                        $vnp_OrderInfo = 'Thanh toán bằng VNPAY';
                                        $vnp_OrderType = 'Hoá đơn tại cửa hàng Bee-tech';
                                        $vnp_Amount = $_SESSION['totalall'];
                                        $vnp_Locale = 'vn';
                                        $vnp_BankCode = 'NCB';
                                        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                                        //Add Params of 2.0.1 Version
                                        $vnp_ExpireDate = $expire;
                                        $inputData = array(
                                                "vnp_Version" => "2.1.0",
                                                "vnp_TmnCode" => $vnp_TmnCode,
                                                "vnp_Amount" => $vnp_Amount * 100,
                                                "vnp_Command" => "pay",
                                                "vnp_CreateDate" => date('YmdHis'),
                                                "vnp_CurrCode" => "VND",
                                                "vnp_IpAddr" => $vnp_IpAddr,
                                                "vnp_Locale" => $vnp_Locale,
                                                "vnp_OrderInfo" => $vnp_OrderInfo,
                                                "vnp_OrderType" => $vnp_OrderType,
                                                "vnp_ReturnUrl" => $vnp_Returnurl,
                                                "vnp_TxnRef" => $vnp_TxnRef,
                                                "vnp_ExpireDate" => $vnp_ExpireDate
                                        );

                                        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                                                $inputData['vnp_BankCode'] = $vnp_BankCode;
                                        }
                                        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                                        //         $inputData['vnp_Bill_State'] = $vnp_Bill_State;
                                        // }

                                        //var_dump($inputData);
                                        ksort($inputData);
                                        $query = "";
                                        $i = 0;
                                        $hashdata = "";
                                        foreach ($inputData as $key => $value) {
                                                if ($i == 1) {
                                                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                                                } else {
                                                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                                                        $i = 1;
                                                }
                                                $query .= urlencode($key) . "=" . urlencode($value) . '&';
                                        }

                                        $vnp_Url = $vnp_Url . "?" . $query;
                                        if (isset($vnp_HashSecret)) {
                                                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                                                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                                        }
                                        $returnData = array(
                                                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
                                        );
                                        if (isset($_POST['redirect'])) {
                                                $_SESSION['codecart'] = $codecart;

                                                $idcart = $cart->insertcart($_SESSION['codecart'], $iduser, $fullname, $add, $emailuser, $tel, $_SESSION['totalall'], $paymentMethod);
                                                if ($idcart) {
                                                        foreach ($_SESSION['cart'] as $cartdetails) {

                                                                $id_sanpham = $cartdetails['0'];
                                                                $soluong = $cartdetails['4'];
                                                                $name = $cartdetails['1'];
                                                                $price = $cartdetails['3'];
                                                                $total = $cartdetails['5'];
                                                                $addcartdetails = $cart->insertcart_details($idcart, $id_sanpham, $name, $soluong, $total);
                                                        }
                                                }
                                                header('Location: ' . $vnp_Url);
                                                $mailaddress = $emailuser;
                                                $title = "Cảm ơn quý khách đã đặt hàng tại Bee-Tech";
                                                $content = "<h5>Đơn hàng bao gồm: </h5>";
                                                $content .= "<h5>Mã hoá đơn: " . $codecart . "</h5>";
                                                $sum = 0;
                                                foreach ($_SESSION['cart'] as $key) {
                                                        $sum += $key[5];
                                                        $content .= "<ul class='list-group list-group-flush'>
        
                                                                           <li class='list-group-item'>Tên sản phẩm: " . $key[1] . "</li>
                                                                           <li class='list-group-item'>Số lượng: " . $key[4] . "</li>
                                                                           <li class='list-group-item'>Đơn giá: " . $key[3] . "</li>
                                                                           <li class='list-group-item'>Thành tiền: " . $key[5] . "</li>
                                                                         </ul>";
                                                }
                                                $content .= "<h4>Tổng hoá đơn: " . $sum . "</h4>";
                                                $mail = new Mailer();
                                                $mail->sendmail($title, $content, $mailaddress, $fullname);
                                                unset($_SESSION['cart']);
                                                die();
                                        } else {
                                                echo json_encode($returnData);
                                        }
                                }
                        }
                        include "view/checkout/checkout.php";
                        break;

                case 'cart':
                        $cart = new Cart($conn);
                        $_SESSION['total'] = 0;
                        $_SESSION['subtotal'] = 0;
                        include "view/order/form.php";
                        break;
                case 'userinfo':
                        $usermod = new User($conn);
                        if (isset($_SESSION['id_user'])) {
                                $user_details = $usermod->getuserdetailsbyid($_SESSION['id_user']);
                                if ($user_details->num_rows > 0) {
                                        $row_user = $user_details->fetch_assoc();
                                        $fullname = $row_user['fullname'];
                                        $sex = $row_user['sex'];
                                        $tel = $row_user['tel'];
                                        $address = $row_user['address'];
                                        unset($_SESSION['username']);
                                        $_SESSION['username'] = $fullname;
                                } else {
                                        $fullname = "";
                                        $sex = "";
                                        $tel = "";
                                        $email = "";
                                        $address = "";
                                }
                        }
                        include "view/user/userinfo.php";
                        break;
                case 'changepassword':
                        $usermod = new User($conn);
                        if (isset($_SESSION['id_user'])) {
                                $user_details = $usermod->getuserbyid($_SESSION['id_user']);
                                $password = $user_details['passwd'];
                        }
                        if (isset($_POST['update'])) {
                                $oldpw = md5($_POST['oldpw']);
                                $newpw = md5($_POST['newpw']);
                                $c_newpw = md5($_POST['c_newpw']);
                                $msg = "";
                                if ($oldpw != $password) {
                                        $msg = "Mật khẩu cũ không chính xác !!!";
                                } else {
                                        if ($newpw != $c_newpw) {
                                                $msg = "Xác nhận mật khẩu mới phải trùng với mật khẩu mới";
                                        } else {
                                                if ($usermod->update_passwd($newpw, $_SESSION['id_user'])) {
                                                        $msg = "Đổi mật khẩu thành công !!!";
                                                }
                                        }
                                }
                        }
                        include "view/user/changepw.php";
                        break;
                case 'history':
                        $cart = new Cart($conn);
                        if (isset($_SESSION['id_user'])) {
                                $id = $_SESSION['id_user'];
                        } else {
                                $id = 0;
                        }
                        if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                        } else {
                                $page = 1;
                        }
                        if ($page == '' || $page == 1) {
                                $begin = 0;
                        } else {
                                $begin = ($page * 9) - 9;
                        }
                        $showcart = $cart->showcart_byiduser($_SESSION['id_user'], $begin);
                        include "view/user/history.php";
                        break;
                        // case 'print':
                        //         require('tfpdf/tfpdf.php');
                        //         $pdf = new \tFPDF();
                        //         $cart = new Cart($conn);

                        //         $pdf->AddPage("0");

                        //         // Add a Unicode font (uses UTF-8)
                        //         $pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
                        //         $pdf->SetFont('DejaVu', '', 14);

                        //         // Load a UTF-8 string from a file and print it
                        //         // $txt = file_get_contents('HelloWorld.txt');
                        //         // $pdf->Write(8, $txt);

                        //         // Select a standard font (uses windows-1252)
                        //         if (isset($_GET['idcart'])) {
                        //                 $id = $_GET['idcart'];
                        //                 $cart_details = $cart->printcart_details($id);
                        //         }
                        //         $pdf->Write(10, 'Đơn hàng của bạn gồm có:');
                        //         $pdf->Ln(10);

                        //         $width_cell = array(5, 35, 80, 20, 30, 40);

                        //         $pdf->Cell($width_cell[0], 10, 'ID', 1, 0, 'C', true);
                        //         $pdf->Cell($width_cell[1], 10, 'Mã hàng', 1, 0, 'C', true);
                        //         $pdf->Cell($width_cell[2], 10, 'Tên sản phẩm', 1, 0, 'C', true);
                        //         $pdf->Cell($width_cell[3], 10, 'Số lượng', 1, 0, 'C', true);
                        //         $pdf->Cell($width_cell[5], 10, 'Tổng tiền', 1, 1, 'C', true);
                        //         $pdf->SetFillColor(235, 236, 236);
                        //         $fill = false;
                        //         $i = 0;
                        //         foreach ($cart_details as $key) {
                        //                 $i++;
                        //                 $pdf->Cell($width_cell[0], 10, $i, 1, 0, 'C', $fill);
                        //                 $pdf->Cell($width_cell[1], 10, $key['product_id'], 1, 0, 'C', $fill);
                        //                 $pdf->Cell($width_cell[2], 10, $key['name'], 1, 0, 'C', $fill);
                        //                 $pdf->Cell($width_cell[3], 10, $key['quantity'], 1, 0, 'C', $fill);
                        //                 $pdf->Cell($width_cell[5], 10, number_format($key['price']), 1, 0, 'C', $fill);
                        //                 $fill = !$fill;
                        //         }
                        //         $pdf->Write(10, 'Cảm ơn bạn đã đặt hàng tại Bee-tech.');
                        //         $pdf->Ln(10);
                        //         $pdf->Output();
                        //         break;
                case 'cartdetails':
                        $cart = new Cart($conn);
                        $product = new SanPham($conn);
                        if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                        } else {
                                $id = 0;
                        }
                        if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                        } else {
                                $page = 1;
                        }
                        if ($page == '' || $page == 1) {
                                $begin = 0;
                        } else {
                                $begin = ($page * 9) - 9;
                        }
                        $list = $cart->showcart_details($id, $begin);
                        include "view/user/cartdetails.php";
                        break;
                case 'ad':
                        $cart = new Cart($conn);
                        $event = $cart->showevent();
                        include "view/contact/About.php";
                        break;
                case 'checkcart':
                        $cart = new Cart($conn);
                        if (isset($_POST['submit'])) {
                                $code = $_POST['search'];
                        }
                        $order = $cart->show_order($code);
                        include 'view/check/checkcart.php';
                        break;
                case 'eventdetails':
                        $cart = new Cart($conn);
                        if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                        }
                        $detailsevent = $cart->showeventdetails($id);
                        include "view/event/eventdetails.php";
                        break;

                case 'admin':
                        header("Location: admin/index.php");
                        break;
        }
} else {

        $product = new SanPham($conn);
        $reviews = new Comment($conn);

        $newproduct  = $product->new_product();
        $bestseller = $product->bestseller_product();
        include "view/home/home.php";
}
$conn->closeConnection();
?>
<?php
include "view/layout/footer.php";
ob_end_flush(); ?>