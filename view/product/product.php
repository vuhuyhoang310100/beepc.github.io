 <!-- Start Content -->

 <div class="col-lg-9">

     <div class="row">
         <div class="col-md-6">
             <ul class="list-inline shop-top-menu pb-3 pt-1">
                 <li class="list-inline-item">
                     <a class="h3 text-dark text-decoration-none mr-3" href="index.php?act=product">Sản phẩm</a>
                 </li>
             </ul>
         </div>
         <div class="col-md-6 pb-4"></div>
     </div>
     <div class="row">
        <?php
        if(empty($products)){
            echo '<div class="alert alert-success w-75 ms-3" role="alert">
  <h4 class="alert-heading">Rất tiếc !!</h4>
  <p>Sản phẩm mà bạn đang tìm hiện đã hết, chúng tôi sẽ cập nhật thêm trong thời gian sớm nhấ !!!t</p>
  <hr>
  <p>Cảm ơn bạn đã quan tâm đến cửa hàng chúng tôi !!!</p> 
</div>';
        }
        ?>
         <?php
            foreach ($products as $product) {
                extract($product);
                $imglink = USER_PATH . $img;
                $link = "index.php?act=productdetails&pdt=" . $product_id;
                echo '<div class="col-md-4">
            <div class="card mb-4 product-wap rounded-0">
                <div class="card rounded-0">
                    <img class="card-img rounded-0 img-fluid"
                        src="' . $imglink . '" />
                  
                </div>
                <div class="card-body">
                    <a href="index.php?act=product&proid=1" class="h3 text-decoration-none">' . $name . ' <br />
                        ' . $firm . '</a>
                    <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">

                        <li class="pt-2">
                            <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                            <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                            <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                            <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                            <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                        </li>
                    </ul>
                    <ul class="list-unstyled d-flex justify-content-    center mb-1">

                        <li>
                            <p class="text-muted">Reviews (0)</p>
                        </li>
                    </ul>
                    <ul class="list-unstyled d-flex justify-content-center ">
                    <li>
                            <p class="mt-1 me-2">Số lượng: </p>
                    </li>

                    <li>
                    <form action="" method="post">
                    <input min="1" name="quantity" type="number" value="1"
                    style="width: 60px;" class="form-control form-control-sm" />
                    </li>
                </ul>
                    <p class="text-center mb-0">' . number_format($price, 0, ',', '.') . 'đ</p>
                   
                  </div>
                  <div class="card-footer">
                 
                  <input type="hidden" name="productid" value="' . $product_id . '">
                  <input type="hidden" name="name" value="' . $name . '">
                  <input type="hidden" name="img" value="' . $imglink . '">
                  <input type="hidden" name="price" value="' . $price . '">

                     <a href="' . $link . '" <button type="submit" class="btn btn-danger text-white mt-2 w-100" name="showcart">
                     <i class="fas fa-eye"></i></a>
                           </button>
                           <button type="submit" class="btn btn-success text-white mt-2 w-100" id="sweetalert" name="addcart">
                           <i class="fas fa-cart-plus"></i>
                            </button>   
                           
                </form>
                </div>
                
            </div>
            
        </div>';
            }

            ?>

         <script>
             function updateCartItemCount() {
                 // Lấy số lượng sản phẩm từ session 'cart' và cập nhật vào thẻ span
                 var cartItemCount = <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>;
                 document.getElementById('cartItemCount').innerText = cartItemCount;
             }

             // Gọi hàm cập nhật khi trang được load
             window.onload = updateCartItemCount;
         </script>
         <script>
             // Tự động ẩn đi phần tử sau 2 giây
             setTimeout(function() {
                 document.getElementById('myAlert').style.display = 'none';
             }, 3000);
         </script>

         <?php
            if (isset($_GET['id'])) {
                $sqlpage = mysqli_query($conn->getConnection(), "SELECT * FROM products where category_details_id = $id ");
            } else {
                $sqlpage = mysqli_query($conn->getConnection(), "SELECT * FROM products");
            }
            $count = mysqli_num_rows($sqlpage);
            $trang = ceil($count / 9);
            ?>
     </div>
     <nav aria-label="Page navigation example">
         <ul class="pagination justify-content-end">
             <?php
                for ($i  = 1; $i <= $trang; $i++) {
                    if (isset($_GET['id'])) {
                ?>
                     <li class="page-item"><a class="page-link" href="index.php?act=product&id=<?php echo $id ?>&page=<?php echo $i ?>"><?php echo $i; ?></a></li>
                 <?php
                    } else {
                    ?>
                     <li class="page-item"><a class="page-link " href="index.php?act=product&page=<?php echo $i ?>"><?php echo $i; ?></a></li>
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
 </div>