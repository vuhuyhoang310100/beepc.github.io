<div class="container">
    <?php
    if (empty($showcart)) {
        echo '
                <div class="container mt-5">
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Hiện tại bạn chưa có đơn hàng nào</h4>
                <p>Xin lỗi, hiện tại không có đơn hàng nào được tạo. Bạn có thể thoải mái duyệt qua cửa hàng của chúng tôi để tìm những sản phẩm phù hợp với nhu cầu của mình. Nếu có bất kỳ câu hỏi nào, hãy liên hệ với chúng tôi, chúng tôi luôn sẵn lòng hỗ trợ. Cảm ơn bạn đã ghé thăm cửa hàng của chúng tôi!</p>
                <hr>
                <p class="mb-0">Cảm ơn bạn đã ghé thăm cửa hàng của chúng tôi!</p>
                <div class="text-sm-end mt-2 mt-sm-0">

                        <a href="index.php?act=product" class="btn btn-danger">
                            <i class="mdi mdi-cart-outline me-1"></i>Trang sản phẩm</a>
                       
                    </div>
            </div>
            
        </div>';
    } else {
        foreach ($showcart as $cart) {
            echo '<div class="border shadow-none my-3">
    <div class="card-body">

        <div class="d-flex align-items-start border-bottom pb-3 justify-content-around">
   
            <div class="me-4 ms-2">
                <h4>Mã đơn hàng: </h4>
            </div>
            <div class="flex-grow-1 align-self-center overflow-hidden">
                <div class="d-flex">
                    <h5 class="font-size-18">
                    <a href="index.php?act=cartdetails&id=' . $cart['cart_id'] . '" class="text-danger">' . $cart['code_cart'] . '</a></h5>
                    <a class="text-dark" href="../../view/user/print.php?cardid=' . $cart['cart_id'] . '" target="_blank"><i class="fa fa-print ms-3" aria-hidden="true"></i></a>

                </div>
              
            </div>
         
       

        </div>

        <div>
            <div class="row">
                <div class="col-md-3">
                    <div class="mt-3">
                        <p class="text-muted mb-2 ms-4">Tổng tiền</p>
                        <h5 id="price" class="mb-0 mt-2 ms-1"><span class="text-muted me-0">
                            
                            </span>' . number_format($cart['total'], 0, ',', '.') . ' vnđ</h5>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mt-3">
                        <p class="text-muted mb-2">Phương thức thanh toán</p>
                        <div class="d-inline-flex">

                            <h5 id="price" class="mb-0"><span class="text-muted ms-5">
                               
                                </span>' . get_paymethod($cart['pay_method']) . '</h5>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mt-3">
                        <p class="text-muted mb-2 ms-2">Trạng thái</p>

                        <h5><span id="totalPrice">' . get_cartstatus2($cart['cart_status']) . '</span></h5>

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="mt-3">
                        <p class="text-muted mb-1 ms-4">Ngày đặt hàng</p>

                        <h5><span id="totalPrice">' . $cart['cart_date'] . '</span></h5>

                    </div>

                </div>

            </div>
        </div>

    </div>
</div>';
        }
    }
    ?><?php
        if (isset($_SESSION['id_user'])) {
            $id = $_SESSION['id_user'];
            $sqlpage = mysqli_query($conn->getConnection(), "SELECT * FROM carts where `user_id` = $id");
        } else {
            $sqlpage = mysqli_query($conn->getConnection(), "SELECT * FROM carts");
        }
        $count = mysqli_num_rows($sqlpage);
        $trang = ceil($count / 9);
        ?>
    </table>
    <div class="d-flex justify-content-between">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <?php
                for ($j  = 1; $j <= $trang; $j++) {
                    if ($_SESSION['id_user']) {
                ?>
                <li class="page-item"><a class="page-link"
                        href="index.php?act=history&id=<?php echo $id ?>&page=<?php echo $j ?>"><?php echo $j; ?></a>
                </li>
                <?php
                    } else {
                    ?>
                <li class="page-item"><a class="page-link"
                        href="index.php?act=history&page=<?php echo $j ?>"><?php echo $j ?></a>
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