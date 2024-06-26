<div class="bdevent bg-light">
    <p class="text-justify"><?php echo $detailsevent['content']; ?>
    <h3 class="text-dark d-inline">Nhận mã giảm giá tại đây: </h3>
    <h3 class="text-danger d-inline"><?php echo $detailsevent['code']; ?></h3>

    </p>
    <h4 class="d-inline">Ngày bắt đầu: </h4><span class="text-danger h3"><?php echo date("d/m/Y", strtotime($detailsevent['start'])); ?></span><Br>
    <h4 class="d-inline">Ngày kết thúc: </h4><span class="text-danger h3"><?php echo date("d/m/Y", strtotime($detailsevent['end'])); ?></span><Br>

    <h4 class="d-inline"><b>Phương thức thanh toán:</b></h4>
    <p class="d-inline"> Mọi hình thức thanh toán</p>
    <br>
    <div class="container d-flex justify-content-center mt-3">
        <a href="index.php?act=product" class="btn btn-success">Tiếp tục mua sắm</a>
    </div>


</div>