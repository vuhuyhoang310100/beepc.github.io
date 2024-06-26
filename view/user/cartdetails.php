<div class="container">
    <?php
    foreach ($list as $cart) {
        $img = $product->get_img_byid($cart['product_id']);
        echo '<div class="border shadow-none my-3">
    <div class="card-body">

        <div class="d-flex align-items-start border-bottom pb-3 justify-content-around">
   
            <div class="me-4 ms-2">
                <h4>Tên sản phẩm: </h4>
            </div>
            <div class="flex-grow-1 align-self-center overflow-hidden">
                <div>
                    <h5 class="font-size-18">' . $cart['name'] . '</h5>
                </div>
            </div>
         
       

        </div>

        <div>
            <div class="row">
            <div class="col-md-3">
                    <div class="mt-3">
                        <p class="text-muted mb-2 ms-1">Hình ảnh</p>
                        <h5 id="price" class="mb-0 mt-1 ms-1"><img class="img" height="60px" width="60px" src ="' . USER_PATH . '' . $img . '" alt=""></h5>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mt-3">
                        <p class="text-muted mb-2 ms-1">Số lượng</p>
                        <h5 id="price" class="mb-0 mt-4 ms-4"><span class="text-muted me-0">
                            
                            </span>' . $cart['quantity'] . '</h5>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mt-3">
                        <p class="text-muted mb-2 ms-4">Giá tiền</p>
                        <div class="d-inline-flex">

                            <h5 id="price" class="mb-0 mt-3"><span class="text-muted ">
                               
                                </span>' . number_format($cart['price'], 0, ',', '.') . ' vnđ</h5>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>';
    }

    ?> <?php
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
                for ($j  = 1; $j <= $trang; $j++) {
                    if (isset($_GET['id'])) {
                ?>
                        <li class="page-item"><a class="page-link" href="index.php?admin=cartdetails&id=<?php echo $id ?>&page=<?php echo $j ?>"><?php echo $j; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item"><a class="page-link" href="index.php?admin=cartdetails&page=<?php echo $j ?>"><?php echo $j ?></a>
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