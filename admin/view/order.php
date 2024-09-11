<div class="w-75" style="margin: 20 20 20 300   ;">
    <div class="d-flex align-items-center">
        <div>            <h3 class>Danh sách đơn hàng</h3>
        </div>
        <div class="ml-3 mb-2">             <a href="export/export.php" alt="" class="btn btn-success">Export</a>
        </div>
    </div>
    <div class="container">
        <form method="POST" action="">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sel1">Trạng thái thanh toán</label>
                        <select name="tttt" required class="form-control" id="sel1">
                            <option selected>-- Chọn trạng thái thanh toán --</option>
                            <option value="0"
                                <?= isset($_POST['tttt']) == true ? ($_POST['tttt'] == 0 ? 'selected' : '') : '' ?>>Chưa
                                thanh toán</option>
                            <option value="1"
                                <?= isset($_POST['tttt']) == true ? ($_POST['tttt'] == 1 ? 'selected' : '') : '' ?>>Đã
                                thanh toán</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sel2">Trạng thái đơn hàng</label>
                        <select name="ttdh" required class="form-control" id="sel2">
                            <option selected>-- Chọn trạng thái đơn hàng --</option>
                            <option value="0"
                                <?= isset($_POST['ttdh']) == true ? ($_POST['ttdh'] == 0 ? 'selected' : '') : '' ?>>Chưa
                                xử lý</option>
                            <option value="1"
                                <?= isset($_POST['ttdh']) == true ? ($_POST['ttdh'] == 1 ? 'selected' : '') : '' ?>>Đã
                                xác nhận</option>
                            <option value="2"
                                <?= isset($_POST['ttdh']) == true ? ($_POST['ttdh'] == 2 ? 'selected' : '') : '' ?>>Đang
                                giao hàng</option>
                            <option value="3"
                                <?= isset($_POST['ttdh']) == true ? ($_POST['ttdh'] == 3 ? 'selected' : '') : '' ?>>Hoàn
                                tất</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mt-1">
                    <br>
                    <button type="submit" name="post" class="btn btn-primary mt-2 text-align-center">Filter</button>
                    <a href="index.php?admin=order" class="btn btn-secondary mt-2 text-align-center">Reset</a>

                </div>
        </form>
    </div>
</div>
<table class="table table-hover table-striped">
    <thead>
        <th class="text-center">Mã đơn hàng</th>
        <th class="text-center">Tên KH</th>
        <th class="text-center">Địa chỉ</th>
        <th class="text-center">Điện thoại</th>
        <th class="text-center">Tổng tiền</th>
        <th class="text-center">PT thanh toán</th>
        <th class="text-center">TT thanh toán</th>
        <th class="text-center">TT đơn hàng</th>
        <th class="text-center">Ngày đặt</th>


        </tr>
    </thead>
    <?php
    if (!empty($order)) {
        foreach ($order as $item) : ?>
    <tr>
        <td class="text-center"><a
                href="index.php?admin=orderdetails&id=<?= $item['cart_id'] ?>"><?= $item['code_cart'] ?></a>
        </td>
        <td class="text-center"><?= $item['fullname'] ?></td>
        <td class="text-center"><?= $item['address'] ?></td>
        <td class="text-center"><?= $item['telephone'] ?></td>
        <td class="text-center"><?= number_format($item['total'], 0, ',', '.') . ' vnđ' ?></td>
        <td class="text-center"><?= get_paymethod($item['pay_method']) ?></td>
        <td class="text-center">
            <div class="form-group">
                <select class="form-control" name="pay_status" id="sel1" style="width: 90px;"
                    onchange="paystatusupdate(this.options[this.selectedIndex].value,'<?php echo $item['cart_id'] ?>')">
                    <?php if ($item['pay_status'] == 0) : ?>
                    <option value="0" selected>Chưa thanh toán</option>
                    <option value="1">Đã thanh toán</option>
                    <?php else : ?>
                    <option value="0">Chưa thanh toán</option>
                    <option value="1" selected>Đã thanh toán</option>

                    <?php endif; ?>
                </select>
            </div>
        </td>
        <td class="text-center">
            <div class="form-group">
                <select class="form-control" name="cart_status" id="sel1" style="width: 90px;"
                    onchange="cartstatusupdate(this.options[this.selectedIndex].value,'<?php echo $item['cart_id'] ?>')">
                    <?php if ($item['cart_status'] == 0) : ?>
                    <option value="0" selected>Chưa xử lý</option>
                    <option value="1">Đã xác nhận</option>
                    <option value="2">Đang giao hàng</option>
                    <option value="3">Hoàn tất</option>
                    <?php elseif ($item['cart_status'] == 1) : ?>
                    <option value="0">Chưa xử lý</option>
                    <option value="1" selected>Đã xác nhận</option>
                    <option value="2">Đang giao hàng</option>
                    <option value="3">Hoàn tất</option>
                    <?php elseif ($item['cart_status'] == 2) : ?>
                    <option value="0">Chưa xử lý</option>
                    <option value="1">Đã xác nhận</option>
                    <option value="2" selected>Đang giao hàng</option>
                    <option value="3">Hoàn tất</option>
                    <?php elseif ($item['cart_status'] == 3) : ?>
                    <option value="0">Chưa xử lý</option>
                    <option value="1">Đã xác nhận</option>
                    <option value="2">Đang giao hàng</option>
                    <option value="3" selected>Hoàn tất</option>
                    <?php else : ?>
                    <option value="0" selected>Chưa xử lý</option>
                    <option value="1">Đã xác nhận</option>
                    <option value="2">Đang giao hàng</option>
                    <option value="3">Hoàn tất</option>
                    <?php endif; ?>
                </select>
            </div>
        </td>
        <td class="text-center"><?= $item['cart_date'] ?></td>

    </tr>
    <?php endforeach;
    } ?>

</table>
<div class="d-flex justify-content-between">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <?php
                                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

            for ($j = 1; $j <= $totalpages; $j++) {
                $activeClass = ($j == $currentPage) ? 'active' : '';

            ?>
            <li class="page-item <?php echo $activeClass; ?>">
                <a class="page-link"
                    href="index.php?admin=order&page=<?php echo $j ?>&tttt=<?php echo isset($_GET['tttt']) ? $_GET['tttt'] : (isset($_POST['tttt']) ? $_POST['tttt'] : '') ?>&ttdh=<?php echo isset($_GET['ttdh']) ? $_GET['ttdh'] : (isset($_POST['ttdh']) ? $_POST['ttdh'] : '') ?>"><?php echo $j ?></a>
            </li>
            <?php
            }
            ?>
        </ul>
    </nav>


</div>
</div>
<script>
function confirmDelete(id) {
    var result = confirm("Bạn có chắc chắn muốn xoá danh mục này không?");
    if (result) {
        window.location = "index.php?admin=delcatedet&iddet=" + id;
    } else {
        return false;
        s
    }
}
</script>
<script type="text/javascript">
function paystatusupdate(value, id) {
    let url = "index.php?admin=order";

    // Hiển thị SweetAlert
    swal({
        title: "Thông báo",
        text: "Bạn có chắc chắn muốn cập nhật trạng thái?",
        icon: "info",
        buttons: true,
        dangerMode: true,
    }).then((willUpdate) => {
        // Nếu người dùng nhấn vào nút xác nhận
        if (willUpdate) {
            swal("Cập nhật thành công !!!", {
                icon: "success",
            });
            // Chờ 1 giây trước khi chuyển trang
            setTimeout(function() {
                window.location.href = url + "&id=" + id + "&status=" + value;
            }, 1000); // 1000 milliseconds = 1 giây
        } else {
            swal("Cập nhật không thành công !!!");
        }
    });
}

function cartstatusupdate(value, id) {
    let url = "index.php?admin=order";

    // Hiển thị SweetAlert
    swal({
        title: "Thông báo",
        text: "Bạn có chắc chắn muốn cập nhật trạng thái giỏ hàng?",
        icon: "info",
        buttons: true,
        dangerMode: true,
    }).then((willUpdate) => {
        // Nếu người dùng nhấn vào nút xác nhận
        if (willUpdate) {
            swal("Cập nhật thành công !!!", {
                icon: "success",
            });
            // Chờ 1 giây trước khi chuyển trang
            setTimeout(function() {
                window.location.href = url + "&idcart=" + id + "&stt=" + value;
            }, 1000); // 1000 milliseconds = 1 giây
        } else {
            swal("Cập nhật không thành công !!!");
        }

    });
}
</script>