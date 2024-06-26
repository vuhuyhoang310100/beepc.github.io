 <!-- Open Content -->


 <section class="bg-light">
     <div class="container-fluid">
         <a href="index.php?act=product" class="btn btn-secondary mt-2">Trở lại</a>
         <div class="container pb-5">
             <div class="row">
                 <div class="col-lg-5 mt-5">
                     <div class="card mb-3">
                         <form action="" method="post">
                             <img class="card-img" style="height: 380px;" src="<?php echo $img ?>" alt="Card image cap" id="product-detail">
                     </div>
                 </div>
                 <!-- col end -->
                 <div class="col-lg-7 mt-5">
                     <div class="card">
                         <div class="card-body">
                             <h1 class="h2"><?php echo $spct['name']; ?></h1>
                             <p class="h3 py-2">Giá: <?php echo number_format($spct['price'], 0, ',', '.'); ?> VNĐ</p>
                             <p class="py-2">
                                 <span class="list-inline-item text-dark">
                                     <?php echo $countreview[0]['count'];
                                        ?>
                                     Comments</span>
                             </p>
                             <ul class="list-inline">
                                 <li class="list-inline-item">
                                     <?php if ($spct['category_id'] == 1) { ?>
                                         <h6>VGA: </h6><?php } else { ?><h6>Thương hiệu: </h6><?php } ?>
                                 </li>
                                 <li class="list-inline-item">
                                     <p class="text"><strong><?php echo $spct['firm']; ?></strong></p>
                                 </li>
                             </ul>

                             <h6>Mô tả:</h6>
                             <p><?php if (!empty($spct['description'])) {
                                    echo $spct['description'];
                                } else {
                                    echo "Đang cập nhật mô tả";
                                }  ?></p>
                             <ul class="list-inline">
                                 <li class="list-inline-item">
                                     <h6>Tình trạng: </h6>
                                 </li>
                                 <li class="list-inline-item">
                                     <p class="text"><?php if ($spct['quantity'] > 0) {
                                                            echo "Còn hàng";
                                                        } else {
                                                            echo "Hết hàng";
                                                        } ?></p>
                                 </li>
                             </ul>

                             <!-- <h6>Specification:</h6> -->
                             <!-- <ul class="list-unstyled pb-3">
                             <li>Lorem ipsum dolor sit</li>
                             <li>Amet, consectetur</li>
                             <li>Adipiscing elit,set</li>
                             <li>Duis aute irure</li>
                             <li>Ut enim ad minim</li>
                             <li>Dolore magna aliqua</li>
                             <li>Excepteur sint</li>
                         </ul> -->
                             <div class="row">
                                 <ul class="list-inline pb-3">
                                     <li class="list-inline-item text-right">
                                         Số lượng:
                                         <input type="hidden" name="quantity" id="product-quanity" value="1">
                                     </li>
                                     <li class="list-inline-item">
                                         <input min="1" name="quantity" type="number" value="1" style="width: 60px;" class="form-control form-control-sm" />
                                     </li>
                                 </ul>
                             </div>
                         </div>
                         <input type="hidden" name="productid" value="<?php echo $spct['product_id'] ?>">
                         <input type="hidden" name="name" value="<?php echo $spct['name'] ?>">
                         <input type="hidden" name="img" value="<?php echo $img ?>">
                         <input type="hidden" name="price" value="<?php echo $spct['price'] ?>">
                         <div class="row pb-3 ms-5 me-5">

                             <div class="col d-flex flex-column justify-content-center align-items-center">

                                 <button type="submit" class="btn btn-success btn-lg w-50 mb-3" name="addcart" value="addtocard">Thêm vào giỏ hàng</button>

                                 <style>
                                     .rating-stars ul {
                                         list-style-type: none;
                                         padding: 0;
                                         -moz-user-select: none;
                                         -webkit-user-select: none;
                                     }

                                     .rating-stars ul>li.star {
                                         display: inline-block;

                                     }

                                     /* Idle State of the stars */
                                     .rating-stars ul>li.star>i.fa {
                                         font-size: 1.5em;
                                         /* Change the size of the stars */
                                         color: #ccc;

                                     }

                                     /* Hover state of the stars */
                                     .rating-stars ul>li.star.hover>i.fa {
                                         color: #FFCC36;
                                     }

                                     /* Selected state of the stars */
                                     .rating-stars ul>li.star.selected>i.fa {
                                         color: #FF912C;
                                     }
                                 </style>
                                 <?php
                                    $product_id = $spct['product_id'];
                                    $show_star = "SELECT AVG (rating) as avg_star FROM rating where product_id = '$product_id'";
                                    $query = $conn->executeQueryOne($show_star);
                                    $star = round($query['avg_star']);


                                    ?>
                                 <section class='rating-widget'>
                                     <!-- Rating Stars Box -->
                                     <div class='rating-stars text-center'>
                                         <ul id='stars'>
                                             <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                 <?php $selected = ($i <= $star) ? 'selected' : ''; ?>
                                                 <li class='star <?php echo $selected; ?>' title='<?php echo $i; ?>' data-value='<?php echo $i; ?>' data-product_id="<?php echo $spct['product_id']; ?>">
                                                     <i class='fa fa-star fa-fw'></i>
                                                 </li>
                                             <?php endfor; ?>
                                         </ul>
                                     </div>
                                     <div class='success-box'>
                                         <div class='text-message'></div>
                                     </div>
                                 </section>
                             </div>
                         </div>
                     </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>



     <div class="container d-flex justify-content-center">
         <div class="bg-light ms-5 me-5 d-flex rounded-3">

             <iframe class="border border-1 rounded-top border-dark rounded-3" src="view/comment/comment.php?product_id=<?php echo $spct['product_id']; ?>" style="height:450px;width:800px;" title="Iframe Example">
             </iframe>
         </div>
     </div>

     </div>
 </section>



 <!-- Close Content -->
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
     var userId = <?php echo isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 'null'; ?>;
 </script>