<div class="w-75" style="margin: 20 20 20 300   ;">
    <h3>Danh sách đơn hàng</h3>
    <table class="table">
        <thead>
            <th class="text-center">ID Sản phẩm</th>
            <th class="text-center">Sản phẩm</th>
            <th class="text-center">Số lượng</th>
            <th class="text-center">Thành tiền</th>


            </tr>
        </thead>
        <?php foreach ($order_details as $item) : ?>
        <tr>
            <td class="text-center"><?= $item['product_id']  ?></td>
            <td class="text-center"><?= $item['name']  ?></td>
            <td class="text-center"><?= $item['quantity'] ?></td>
            <td class="text-center"><?= number_format($item['price'], 0, ',', '.') . ' vnđ' ?></td>
        </tr>
        <?php endforeach; ?>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sqlpage = mysqli_query($conn->getConnection(), "SELECT * FROM cart_details where `cart_id` = $id");
        } else {
            $sqlpage = mysqli_query($conn->getConnection(), "SELECT * FROM cart_details");
        }
        $count = mysqli_num_rows($sqlpage);
        $trang = ceil($count / 9);
        ?>
    </table>
    <div class="d-flex justify-content-between">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <?php
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                for ($j  = 1; $j <= $trang; $j++) {
                    $activeClass = ($j == $currentPage) ? 'active' : '';

                    if (isset($_GET['id'])) {
                ?>
                <li class="page-item <?php echo $activeClass; ?>"><a class="page-link"
                        href="index.php?admin=orderdetails&id=<?php echo $id ?>&page=<?php echo $j ?>"><?php echo $j; ?></a>
                </li>
                <?php
                    } else {
                    ?>
                <li class="page-item <?php echo $activeClass; ?>"><a class="page-link"
                        href="index.php?admin=orderdetails&page=<?php echo $j ?>"><?php echo $j ?></a>
                </li>
                <?php
                    }
                }

                ?>


                <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
             <li class="page-item"><a class="page-link" href="#">3</a></li> -->

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
    window.location.href = url + "&id=" + id + "&status=" + value;

}

function cartstatusupdate(value, id) {
    let url = "index.php?admin=order";
    window.location.href = url + "&idcart=" + id + "&stt=" + value;

}
</script>