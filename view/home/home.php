<div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="w-100 pt-1 mb-5 text-right">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="get" class="modal-content modal-body border-0 p-0">
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ..." />
                <button type="submit" class="input-group-text bg-success text-light">
                    <i class="fa fa-fw fa-search text-white"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="public/asset/img/w9luto.png" alt="" />
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">

                            <h3 class="h2">"Đa dạng, chất lượng, tin cậy"</h3>
                            <p>
                                <em>
                                    <a>Bee-TECH</a> là cửa hàng bán máy tính chuyên nghiệp,
                                    cung cấp đa dạng sản phẩm PC, laptop và dịch vụ tư vấn
                                    chất lượng. Với đội ngũ nhân viên am hiểu và hỗ trợ khách
                                    hàng tận tâm, <a>Bee-TECH</a> cam kết mang đến sự hài lòng
                                    cho khách hàng với sản phẩm và dịch vụ tốt nhất...
                                </em>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid"
                            src="public/asset/img/purepng.com-laptop-notebooklaptopsnotebooknotebook-computerclamshell-1701528354844ktgom.png"
                            alt="" />
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">

                            <h3 class="h2">Dịch vụ tốt nhất</h3>
                            <p>
                                <em>
                                    Ngoài ra, Bee-TECH cũng cung cấp dịch vụ
                                    <strong>bảo hành</strong> và
                                    <strong>sửa chữa</strong> laptop chuyên nghiệp. Chúng tôi
                                    <strong>cam kết</strong> đảm bảo máy tính của bạn luôn
                                    hoạt động tốt và ổn định. Sự hài lòng của khách hàng luôn
                                    là ưu tiên hàng đầu của chúng tôi.</em>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="public/asset/img/32967-4-gaming-computer-transparent-image.png"
                            alt="" />
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">

                            <h3 class="h2">Lời cảm ơn</h3>
                            <p>
                                <em>Hãy đến với Bee-TECH để trải nghiệm sự
                                    <strong>chuyên nghiệp</strong>, <strong>uy tín</strong> và
                                    <strong>độc đáo</strong> trong lĩnh vực công nghệ. Chúng
                                    tôi tin rằng chúng tôi sẽ là địa chỉ tin cậy cho mọi nhu
                                    cầu laptop của bạn.
                                </em>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
        role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left icon"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
        role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right icon"></i>
    </a>
</div>
<!-- InstanceEndEditable -->
<!-- bestseller -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1" id="h1-font"><strong>Sản phẩm bán chạy</strong></h1>
            </div>
        </div>
        <div class="row">
            <?php
            foreach ($bestseller as $item) {
                $show_star = "SELECT AVG (rating) as avg_star FROM rating where product_id = " . $item['product_id'] . "";
                $query = $conn->executeQueryOne($show_star);
                $star = round($query['avg_star']);
                $greystar = 5 - $star;
                $imglink = USER_PATH . $item['img'];
                $countreviews = count($reviews->loadall_comment($item['product_id']));
                echo '  <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="index.php?act=productdetails&pdt=' . $item['product_id'] . '">
                        <img height="310 px" src="' . $imglink . '" class="card-img-top" alt="..." />
                    </a>
                    <div class="card-body">
                        <ul class="list-unstyled d-flex justify-content-between">
                        <li>' ?><?php
                                if ($star != 0) {
                                    for ($i = 1; $i <= $star; $i++) {
                                        echo '  <i class="text-warning fa fa-star"></i>';
                                    }
                                    for ($j = 1; $j <= $greystar; $j++) {
                                        echo '  <i class="text-muted fa fa-star"></i>';
                                    }
                                } else {
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo '  <i class="text-warning fa fa-star"></i>';
                                    }
                                }
                                ?>
            <?php echo '
            </li>
            <li class="text-muted text-right">' . number_format($item['price'], 0, ',', '.') . '</li>
            </ul>
            <a href="" class="h3 text-decoration-none text-dark">' . $item['name'] . '<Br>
                ' . $item['firm'] . '
            </a>
            <div style="text-overflow: ellipsis;" class="">
                <p class="text-muted text-center">' . $item['description'] . '</p>
            </div>


            <p class="text-muted text-center">Reviews (' . $countreviews . ')</p>
        </div>
    </div>
    </div>';
            }
        ?>



        </div>
    </div>
    </div>

</section>

<!-- Sản phẩm mới -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1" id="h1-font"><strong>Sản phẩm mới</strong></h1>
            </div>
        </div>
        <div class="row">
            <?php
            foreach ($newproduct as $item) {
                $show_star = "SELECT AVG (rating) as avg_star FROM rating where product_id = " . $item['product_id'] . "";
                $query = $conn->executeQueryOne($show_star);
                $star = round($query['avg_star']);
                $greystar = 5 - $star;
                $imglink = USER_PATH . $item['img'];
                $countreviews = count($reviews->loadall_comment($item['product_id']));
                echo '  <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="index.php?act=productdetails&pdt=' . $item['product_id'] . '">
                        <img height="310 px" src="' . $imglink . '" class="card-img-top" alt="..." />
                    </a>
                    <div class="card-body">
                        <ul class="list-unstyled d-flex justify-content-between">
                        <li>' ?><?php
                                if ($star != 0) {
                                    for ($i = 1; $i <= $star; $i++) {
                                        echo '  <i class="text-warning fa fa-star"></i>';
                                    }
                                    for ($j = 1; $j <= $greystar; $j++) {
                                        echo '  <i class="text-muted fa fa-star"></i>';
                                    }
                                } else {
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo '  <i class="text-warning fa fa-star"></i>';
                                    }
                                }
                                ?>
            <?php echo '
            </li>
            <li class="text-muted text-right">' . number_format($item['price'], 0, ',', '.') . '</li>
            </ul>
            <a href="LAPTOP.html" class="h3 text-decoration-none text-dark">' . $item['name'] . '<Br>
                ' . $item['firm'] . '
            </a>
            <div style="text-overflow: ellipsis;" class="">
                <p class="text-muted text-center">' . $item['description'] . '</p>
            </div>


            <p class="text-muted text-center">Reviews (' . $countreviews . ')</p>
        </div>
    </div>
    </div>';
            }
        ?>



        </div>
    </div>
    </div>

</section>