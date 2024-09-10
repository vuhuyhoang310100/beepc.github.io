<div class="container mt-3">
    <!-- <?php
            // Mảng chứa các mục trong cây đường dẫn
            $breadcrumbs = array(
                array('url' => 'index.php?act=cart', 'label' => 'Giỏ hàng'),
                array('url' => 'index.php?act=checkout', 'label' => 'Thông tin giao hàng'),
                array('url' => 'index.php?act=finish', 'label' => 'Hoàn tất'),
                array('url' => 'index.php?act=history', 'label' => 'Lịch sử đơn hàng'),

            );

            // Hiển thị cây đường dẫn
            $current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

            echo '<nav aria-label="breadcrumb">
        <ol class="breadcrumb">';
            foreach ($breadcrumbs as $breadcrumb) {
                if ($breadcrumb['url'] === $current_url) {
                    // Nếu URL của breadcrumb trùng với URL hiện tại, đánh dấu là active
                    echo '<li class="breadcrumb-item active" aria-current="page">' . $breadcrumb['label'] . '</li>';
                } else {
                    // Hiển thị mục không phải cuối cùng với liên kết đến url
                    echo '<li class="breadcrumb-item"><a href="' . $breadcrumb['url'] . '">' . $breadcrumb['label'] . '</a></li>';
                }
            }
            echo '  </ol>
      </nav>';
            ?> -->
    <form action="index.php?act=checkout" method="post">
        <div class="row">
            <div class="col-xl-8">

                <!--Xóa sản phầm trong giỏ hảng-->
                <?php
                ob_start();
                if (isset($_GET['del']) && $_GET['del'] >= 0) {
                    array_splice($_SESSION['cart'], $_GET['del'], 1);
                    //Kiểm tra giỏ hàng rỗng và thông báo 
                }
                if (empty($_SESSION['cart'])) {
                    echo '
                <div class="container mt-5">
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Giỏ Hàng Trống</h4>
                <p>Xin lỗi, giỏ hàng của bạn đang trống. Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm.</p>
                <hr>
                <p class="mb-0">Cảm ơn bạn đã ghé thăm cửa hàng của chúng tôi!</p>
                <div class="text-sm-end mt-2 mt-sm-0">
                        <a href="index.php?act=product" class="btn btn-danger">
                            <i class="mdi mdi-cart-outline me-1"></i>Trang sản phẩm</a>
                    </div>
            </div>
            
        </div>';
                }
                // Nếu giỏ hàng không rỗng thì show giỏ hàng
                else {
                    $i = 0;
                    foreach ($_SESSION['cart'] as $cart) {
                        $_SESSION['subtotal'] += $cart[5];
                        $_SESSION['total'] = $_SESSION['subtotal'] + ($_SESSION['subtotal'] * 0.05);
                        echo ' <div class="card border shadow-none">
                <div class="card-body">

                    <div class="d-flex align-items-start border-bottom pb-3">
                        <div class="me-4">
                            <img src="' . $cart[2] . '" alt=""
                                class="avatar-lg rounded">
                        </div>
                        <div class="flex-grow-1 align-self-center overflow-hidden">
                            <div>
                                <h5 class="text-truncate font-size-18"><a href="#" class="text-dark">' . $cart[1] . ' </a></h5>
                                
                            </div>
                        </div>
                        <div class="flex-shrink-0 ms-2">
                            <ul class="list-inline mb-0 font-size-16">
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted px-1">
                                        <i class="mdi mdi-trash-can-outline"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted px-1">
                                        <i class="mdi mdi-heart-outline"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mt-3">
                                    <p class="text-muted mb-2 ms-4">Đơn giá</p>
                                    <h5 id="price" class="mb-0 mt-2"><span class="text-muted me-0">
                                            <!-- <del class="font-size-16 fw-normal">$500</del> -->
                                        </span>' . number_format($cart[3], 0, ',', '.') . 'đ</h5>
                                        
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="mt-3">
                                    <p class="text-muted mb-2">Số lượng</p>
                                    <div class="d-inline-flex">
                                    
                                    <h5 id="price" class="mb-0"><span class="text-muted ms-4">
                                    <!-- <del class="font-size-16 fw-normal">$500</del> -->
                                </span>' . $cart[4] . '</h5>
                               
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mt-3">
                                    <p class="text-muted mb-2 ms-3">Tổng tiền</p>
                                    
                                    <h5><span id="totalPrice">' . number_format($cart[5], 0, ',', '.') . 'vnđ</span></h5>
                                    
                                </div>
                                
                            </div>
                            <div class="col-md-3">
                            <div class="mt-3">
                                <p class="text-muted mb-1">Xóa</p>
                                
                                <a class="nav-icon position-relative text-decoration-none ms-1" href="index.php?act=cart&del=' . $i . '">
                                <i class="fa fa-fw fa fa-trash text-dark mr-2"></i>
                                <span
                                    class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                            </a>
                                
                            </div>
                            
                        </div>
                            
                        </div>
                    </div>

                </div>
            </div>
           ';
                        $i++;
                    }
                }

                ?>


                <!-- end card -->


                <div class="row my-4">
                    <div class="col-sm-6">
                        <a href="ecommerce-products.html" class="btn btn-link text-muted">
                            <i class="mdi mdi-arrow-left me-1"></i></a>
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="text-sm-start mt-2 mt-sm-0">
                            <div class="container d-flex justify-content-between">
                                <!-- Kiểm tra đăng nhập, nếu đăng nhập rồi thì hiện nút Đặt hàng -->
                                <a href="index.php?act=product" class="btn btn-danger w-100 text-nowrap" style="font-size:14px;">
                                    <i class="mdi mdi-cart-outline "></i>Tiếp tục đặt hàng</a>
                                <a href="index.php?act=delcart" class="btn btn-warning w-100 text-nowrap ms-2" style="font-size:14px;">
                                    <i class="mdi mdi-cart-outline "></i> Xóa giỏ hàng </a>
                            </div>

                            <!-- Ngược lại thì hiện nút đăng ký -->
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row-->
            </div>

            <!-- Thông tin thanh toán  -->
            <?php
 
            if (!empty($_SESSION['cart'])) {

                echo '
            
        <div class="col-xl-4">
            <div class="mt-5 mt-lg-0">
                <div class="card border shadow-none">
                    <div class="card-header bg-transparent border-bottom py-3 px-4">
                        <h5 class="font-size-16 mb-0">Đơn hàng của bạn</h5>
                    </div>
                    <div class="card-body p-4 pt-2">
                          <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td>Tổng: </td>
                                        <td class="text-end">' . number_format($_SESSION['subtotal'], 0, ',', '.') . ' vnđ</td>
                                    </tr>
                                    
                              
                                    <tr>
                                        <td>VAT: </td>
                                        <td class="text-end">5%</td>
                                    </tr>
                                    <tr>
                                    <td>Voucher: </td>
                                    <td class="text-end"> <input type="text" name="voucher" class="form-control w-100" ></td>
                                </tr>
                                  
                            <tr class="bg-light">
                                <th>Tạm tính :</th>
                                <td class="text-end">
                                    <span class="fw-bold">' . number_format($_SESSION['total'], 0, ',', '.') . ' vnđ</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="center d-flex justify-content-center align-self-center mt-3">
                <button type="submit" name="success" class="btn btn-success w-100">
                <i class="mdi mdi-cart-outline"></i>Thanh toán
            </button>
                </div>
            </div>
            </div>
        </div>

       
       ';
            }

            ?>

            <!-- end table-responsive -->
        </div>
</div>
</div>
</form>
</div>
</div>
<!-- end row -->

</div>

</form>

<!-- end form -->
<!-- Sử dụng JS để thiết lập số lượng của icon giỏ hàng -->
<script>
    function updateCartItemCount() {
        // Lấy số lượng sản phẩm từ session 'cart' và cập nhật vào thẻ span
        var cartItemCount = <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>;
        document.getElementById('cartItemCount').innerText = cartItemCount;
    }

    // Gọi hàm cập nhật khi trang được load
    window.addEventListener('load', updateCartItemCount);
</script>
<!-- 
     <tr>
                                        <td class="align-middle">Giảm giá: </td>
                                        <td class="text-end"><select name="discount_code">
                                        <option value="1">KT100</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        </select>
                                        <button type="submit" class="btn btn-success pt-1 pb-1" name="apply_discount">Áp dụng</button></td>
                                        
                                    </tr>
 -->
<!-- 
     
                                    <tr>
                                        <td>Phí vận chuyển:</td>
                                        <td class="text-end">$ 25</td>
                                    </tr>
  -->