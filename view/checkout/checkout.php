<?php
if (isset($_SESSION['id_user'])) {
    $user_detail = $usermod->getdetailsbyid($_SESSION['id_user']);
    $email = $usermod->getuserbyid($_SESSION['id_user']);
    if ($user_detail !== null && $email !== null) {
        $iduser = $_SESSION['id_user'];
        $fullname = $user_detail['fullname'];
        $emailuser = $email['email'];
        $tel = $user_detail['tel'];
        $add = $user_detail['address'];
    } else {
        // Xử lý trường hợp khi kết quả trả về null

    }
} ?>

<div class="container-fluid"> <a href="index.php?act=cart" class="btn btn-secondary mt-2">Trở lại</a>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">

            <div class="col-sm-8 d-flex justify-content-center align-items-center">
                <form action="" method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="text-align: center; ">
                                    <h3 class="h3 mt-3 text-danger">Thông tin nhận hàng</h3>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: right; padding-right: 30px; width: 150px;" class="align-bottom">
                                    <label for="fullname" class="form-label">Họ tên: </label>
                                </td>
                                <td><input type="text" class="form-control size" id="fullname" placeholder="Nhập họ tên"
                                        name="fullname" value="<?php echo isset($fullname) ? $fullname : ''; ?>"
                                        required>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 30px; width: 150px;" class="align-bottom">
                                    <label for="email" class="form-label">Email: </label>
                                </td>
                                <td><input type="email" class="form-control size" id="email" placeholder="Nhập email"
                                        name="email" value="<?php echo isset($emailuser) ? $emailuser : ''; ?>"
                                        required>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 30px;" class="align-bottom"><label
                                        for="sdt" class="form-label">Số điện thoại: </label></td>
                                <td><input type="text" class="form-control size" id="sdt"
                                        placeholder="Nhập số điện thoại" name="tel"
                                        value="<?php echo isset($tel) ? $tel : ''; ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 30px;" class="align-middle"><label
                                        for="address" class="form-label">Địa chỉ: </label></td>
                                <td><input type="text" class="form-control size" id="sdt" placeholder="Nhập địa chỉ"
                                        name="address" value="<?php echo isset($add) ? $add : ''; ?>" required>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td style="text-align: right; padding-right: 30px;" class="align-bottom"><label for=""
                                        class="form-label">Phương thức thanh toán:</label></td>
                                <td>
                                    <select class="form-select" id="paymentMethod" name="paymentMethod">
                                        <option value="1">Tiền mặt</option>
                                        <option value="2">Chuyển khoản ngân hàng</option>
                                        <option value="3">VNPay</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding-right: 30px;" class="align-bottom"><label for=""
                                        class="form-label">Cách thức nhận hàng:</label></td>
                                <td><input type="radio" class="form-check-input" id="radio3" name="shipmethod"
                                        value="ship" checked>
                                    <label class="form-check-label" for="radio3">Giao hàng tận nơi</label><br>
                                </td>
                            </tr>

                            <!-- <tr>
                            <td>&nbsp;</td>
                            <td style="text-align: center;">
                                <input type="radio" class="form-check-input" id="radio3" name="delivery_option"
                                    value="ship" checked>
                                <label class="form-check-label" for="radio3">Giao hàng tận nơi</label><br>
                                <button type="button" class="btn btn-primary mt-3" onClick="dongy()">Đặt hàng</button>
                            </td>
                        </tr> -->
                        </tfoot>
                    </table>

            </div>
            <div class="col-sm-4">
                <div class="mt-lg-0">
                    <div class="card border shadow-none">
                        <div class="card-header bg-transparent border-bottom py-3 px-4">
                            <h5 class="font-size-16 mb-0">Đơn hàng của bạn</h5>
                        </div>
                        <div class="card-body p-4 pt-2">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Tổng đơn hàng:</td>
                                            <td class="text-end">
                                                <?php echo number_format($_SESSION['total'], 0, ',', '.') . ' vnđ'; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Voucher giảm giá: </td>
                                            <td class="text-end">
                                                <?php echo  number_format($_SESSION['voucher'], 0, ',', '.') . ' vnđ'; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Phí ship: </td>
                                            <!-- Nếu trên 20.000.000 thì miễn phí ship, ngược lại thì 50000 -->
                                            <td class="text-end"><span class="text-danger"><?php
                                                                                            if ($_SESSION['total'] >= 20000000) {
                                                                                                $fee = "Miễn phí";
                                                                                                echo $fee;
                                                                                            } else {
                                                                                                $fee = 50000;
                                                                                                echo number_format($fee, 0, ',', '.') . ' vnđ';
                                                                                            } ?></span></td>
                                        </tr>
                                        <tr class="bg-light">
                                            <th>Tổng thanh toán :</th>
                                            <td class="text-end">
                                                <span class="fw-bold">
                                                    <?php
                                                    if ($fee == "Miễn phí") {
                                                        $ship = 0;
                                                    } else {
                                                        $ship = $fee;
                                                    }
                                                    $_SESSION['totalall'] = $_SESSION['total'] - $_SESSION['voucher'] + $ship;
                                                    echo number_format($_SESSION['totalall'], 0, ',', '.') . ' vnđ';
                                                    ?>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="center d-flex justify-content-center align-self-center mt-3">

                                <button type="submit" name="redirect" class="btn btn-primary">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>