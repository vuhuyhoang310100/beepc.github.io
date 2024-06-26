<!-- Start Best Seller -->

<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1" id="h1-font"><strong>MY TEAM</strong></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="https://www.facebook.com/hoangtomato.2/">
                        <img src="public/asset/img/phuoc.jpg" height="415px" class="card-img-top" alt="..." />
                    </a>
                    <div class="card-body text-center">

                        <a href="LAPTOP.html" class="h2 text-decoration-none text-dark">Bùi Hoàng Phước
                        </a>

                        <p class="card-text">
                            FE developers
                        </p>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="https://www.facebook.com/hoangtomato.2/">
                        <img src="public/asset/img/vuhuyhoang.jpg" class="card-img-top" height="415px" alt="..." />
                    </a>
                    <div class="card-body text-center">

                        <a href="" class="h2 text-decoration-none text-dark text-center">Vũ Huy Hoàng</a>
                        <p class="card-text">
                            BE developers
                        </p>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="https://www.facebook.com/hoangtomato.2/">
                        <img src="public/asset/img/tuan.jpg" height="415px" class="card-img-top" alt="..." />
                    </a>
                    <div class="card-body  text-center">
                        <a href="" class="h2 text-decoration-none text-dark text-center">Huỳnh Thanh Tuấn</a>
                        <p class="card-text">
                            FE developers
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Best Seller -->
<!-- Start Footer -->
<footer class="bg-dark" id="tempaltemo_footer">
    <div class="container">

        <div class="row text-light mb-0">
            <div class="col-12 mb-3">
                <div class="w-100 my-3 border-top border-secondary"></div>

            </div>
            <div class="col-6 ">
                <p class="fw-normal fs-1 text-uppercase h2 "><b>BEE - TECH</b></p>
            </div>
            <div class="col-6 me-auto text-center">
                <ul class="list-inline text-left footer-icons ms-5">
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                    </li>
                </ul>
            </div>

            <div class="col-6">
                <div class="footer-text mb-3">
                    <a class="me-3" href="auth/login.php"><span class="small fst-italic fw-light">Đăng nhập</span></a>

                    <a href="auth/register.php"><span class="small fst-italic fw-light">Đăng ký<span></a>
                </div>
            </div>
            <div class="col-6 me-auto float-end">
                <table class="d-flex justify-content-end me-5">
                    <tr>
                        <td>
                            <p><i class='fas fa-home'> :</i> 756 Trần Phú</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><i class='fas fa-phone'> :</i> 0794651157</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><i class='fas fa-envelope-open'> :</i> <a href="#">vuhuyhoang999123@gmail.com</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row text-light mb-0">
            <div class="col-12 mb-1">
                <div class="w-100 my-3 border-top border-secondary"></div>

            </div>
        </div>
</footer>
<!-- End Footer -->
<?php
if (isset($_SESSION['sttupdate']) && $_SESSION['sttupdate'] != '') {
?>
    <script>
        swal({
            title: '<?php echo $_SESSION['sttupdate'] ?>',
            icon: "success",
        });
    </script>
<?php
    unset($_SESSION['sttupdate']);
}
?>
<script src="public/asset/js/jquery-1.11.0.min.js"></script>
<script src="public/assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="public/asset/js/bootstrap.bundle.min.js"></script>
<script src="public/asset/js/templatemo.min.js"></script>

<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js
"></script>
<script src="public/asset/js/custom.js"></script>
</body>

<!-- InstanceEnd -->

</html>