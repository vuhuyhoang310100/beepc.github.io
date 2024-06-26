<div id="main-content" class="container allContent-section py-4">
    <div class="row">
        <div class="col-sm-3">
            <div class="card text-center">
                <i class="fa fa-users mb-2" style="font-size: 70px; color: white"></i>
                <h4 style=" color: white">Người dùng</h4>
                <h5 style="color: white">
                    <?php echo ($countuser > 0) ?  $countuser : 0 ?>
                </h5>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card text-center">
                <i class="fa fa-th-large mb-2" style="font-size: 70px; color: white"></i>
                <h4 style="color: white">Danh mục</h4>
                <h5 style="color: white">
                    <?php echo ($countcate > 0) ?  $countcate : 0 ?>
                </h5>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card text-center">
                <i class="fa fa-th mb-2" style="font-size: 70px; color: white"></i>
                <h4 style="color: white">Sản phẩm</h4>
                <h5 style="color: white">
                    <?php echo ($countproduct > 0) ?  $countproduct : 0 ?>
                </h5>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card text-center">
                <i class="fa fa-list mb-2" style="font-size: 70px; color: white"></i>
                <h4 style="color: white">Đơn hàng</h4>
                <h5 style="color: white">
                    <?php echo ($countcart > 0) ?  $countcart : 0 ?>
                </h5>
            </div>
        </div>
    </div>
    <div class="container mt-1">
        <h2 class=" text-danger text-center">Doanh thu hôm nay</h2>
    </div>

    <script>
    window.onload = function() {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: false,
            theme: "light1",
            data: [{
                type: "column",
                name: "Tổng",
                showInLegend: true,
                dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Số lượng",
                axisYType: "secondary",
                showInLegend: true,
                dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    }
    </script>
    <?php
    if (isset($msg)) {
        echo '<h5 class="text-danger">' . $msg . '</h5>';
    } else
        echo ' <div class="container" id="chartContainer" style="height: 370px; width: 75%;"></div>';
    ?>

</div>