<?php

// $dataPoints = array(
//     array("x" => 10, "y" => 41),
//     array("x" => 20, "y" => 35, "indexLabel" => "Lowest"),
//     array("x" => 30, "y" => 50),
//     array("x" => 40, "y" => 45),
//     array("x" => 50, "y" => 52),
//     array("x" => 60, "y" => 68),
//     array("x" => 70, "y" => 38),
//     array("x" => 80, "y" => 71, "indexLabel" => "Highest"),
//     array("x" => 90, "y" => 52),
//     array("x" => 100, "y" => 60),
//     array("x" => 110, "y" => 36),
//     array("x" => 120, "y" => 49),
//     array("x" => 130, "y" => 41)
// );


?>
<!DOCTYPE HTML>
<html>

<head>
    <div class="container">

        <h2 class=" text-danger text-center">BIỂU ĐỒ THỐNG KÊ</h2>
        <div class="container text-center d-flex align-items-center mt-3 justify-content-center">
            <label for="sel1">Thống kê theo: </label>
            <form action="" method="post">
                <div class="form-group ml-2 d-flex align-items-center">
                    <select class="form-control" name="select-date" id="sel1">
                        <option value="0" <?php if (isset($_POST['select-date']) && $_POST['select-date'] == 0) { ?>
                            selected <?php } ?>>7 Ngày qua</option>
                        <option value="1" <?php if (isset($_POST['select-date']) && $_POST['select-date'] == 1) { ?>
                            selected <?php } ?>>28 Ngày qua</option>
                        <option value="2" <?php if (isset($_POST['select-date']) && $_POST['select-date'] == 2) { ?>
                            selected <?php } ?>>6 tháng qua</option>
                        <option value="3" <?php if (isset($_POST['select-date']) && $_POST['select-date'] == 3) { ?>
                            selected <?php } ?>>1 năm qua</option>
                    </select>
                    <button type="submit" name="select" class="btn btn-secondary ml-3">Lọc</button>
            </form>
        </div>
        <span id="text-date"></span>
    </div>

    <?php
    if (isset($msg) && ($msg != "")) {
        echo ' <div class="alert alert-warning text-center" role="alert">
        Chưa có dữ liệu để hiển thị biểu đồ.
    </div>';
    } else {
    ?>
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
    <?php } ?>


</head>

<body>

    <div class="container" id="chartContainer" style="height: 370px; width: 65%;"></div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>

</html>