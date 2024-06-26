<!DOCTYPE html>
<html lang="en">
<!-- InstanceBegin template="/Templates/Home-Mau.dwt" codeOutsideHTMLIsLocked="false" -->

<head>
    <title>Bee-TECH Computers</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="apple-touch-icon" href="./asset/img/apple-icon.png" />
    <link rel="shortcut icon" type="image/x-icon"
        href="public/asset/img/Gartoon-Team-Gartoon-Devices-Input-gaming.512.png" />

    <link rel="stylesheet" href="public/asset/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/asset/css/templatemo.css" />
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css
" rel="stylesheet">
    <link rel="stylesheet" href="public/asset/css/custom.css" />
    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="public/asset/css/fontawesome.min.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</head>

<body>
    <!-- Start Top Nav -->

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="public/asset/img/123.png" style="max-height: 90px;" alt="">
            <!-- FIX LOGO 03-03-2024 -->
            <div class="align-self-center collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between ml"
                id="templatemo_main_nav">
                <div class="flex-fill">
                    <!-- InstanceBeginEditable name="Edit-region2" -->
                    <ul class="nav navbar-nav d-flex justify-content-around mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link color hover h4" href="index.php">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link color hover h4" href="index.php?act=ad">Tin khuyến mãi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link color hover h4" href="index.php?act=product">Sản phẩm</a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link color hover h4" href="index.php?act=cart">Giỏ hàng</a>
                        </li>
                    </ul>
                    <!-- InstanceEndEditable -->
                </div>
                <div class="navbar align-self-center justify-content-center d-flex mb-2">
                    <form action="index.php?act=checkcart" method="post">
                        <div class="input-group rounded me-2">
                            <input style="border-top: 1px;border-left: 1px;" type="text" name="search"
                                class="form-control rounded" placeholder="Tìm kiếm đơn hàng..." />
                            <span class="input-group-text border-0" id="search-addon">
                                <button class="border-0 bg-transparent" type="submit" name="submit"><i
                                        class="fas fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <a class="nav-icon position-relative text-decoration-none ms-2" href="index.php?act=cart">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span id="cartItemCount"
                            class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>


                    <!-- JavaScript code -->
                    <script>
                    function updateCartItemCount() {
                        // Lấy số lượng sản phẩm từ session 'cart' và cập nhật vào thẻ span
                        var cartItemCount = <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>;
                        document.getElementById('cartItemCount').innerText = cartItemCount;
                    }

                    // Gọi hàm cập nhật khi trang được load
                    window.addEventListener('load', updateCartItemCount);
                    </script>
                    <?php

                    if (isset($_SESSION['id_user']) && $_SESSION['id_user'] != "" && $_SESSION['role'] != 1) {
                        // Lấy tên người dùng từ id
                        $db = new User($conn);
                        $username = $db->getusernamesbyid($_SESSION['id_user']);

                        // Kiểm tra xem có tên người dùng không
                        if ($username) {
                            // Tách tên người dùng thành các từ
                            $words = explode(" ", $username);
                            $numWords = count($words);

                            // Kiểm tra xem có đủ từ không
                            if ($numWords >= 2) {
                                $lastTwoWords = $words[$numWords - 2] . " " . $words[$numWords - 1];
                                echo '<a class="nav-icon position-relative text-decoration-none" href="index.php?act=userinfo">
                                <div class="d-inline text-nowrap">
                <i class="fa fa-fw fa-user text-dark mr-3"></i>
             
                <span class="text-dark">' . $lastTwoWords . '</span>
                </div>
            </a>
            <a class="nav-icon position-relative text-decoration-none" href="index.php?act=logout">
                <i class="fa fa-fw fa-sign-out-alt text-dark mr-3"></i>
                <span class="text-dark"></span>
            </a>';
                            } else {
                                // Nếu không đủ từ, giữ nguyên chuỗi họ tên
                                echo '<a class="nav-icon position-relative text-decoration-none" href="index.php?act=userinfo">
                <i class="fa fa-fw fa-user text-dark mr-3"></i>
                <span class="text-dark">' . $username . '</span>
            </a>
            <a class="nav-icon position-relative text-decoration-none" href="index.php?act=logout">
                <i class="fa fa-fw fa-sign-out-alt text-dark mr-3"></i>
                <span class="text-dark"></span>
            </a>';
                            }
                        } else {
                            // Nếu không có tên người dùng, hiển thị một thông báo hoặc một giá trị mặc định
                            echo '<a class="nav-icon position-relative text-decoration-none" href="index.php?act=userinfo">
            <i class="fa fa-fw fa-user text-dark mr-3"></i>
            <span class="text-dark">' . $_SESSION['username'] . '</span>
        </a>
        <a class="nav-icon position-relative text-decoration-none" href="index.php?act=logout">
            <i class="fa fa-fw fa-sign-out-alt text-dark mr-3"></i>
            <span class="text-dark"></span>
        </a>';
                        }
                    } else {
                        // Nếu không đăng nhập, hiển thị nút đăng nhập
                        echo '<a class="nav-icon position-relative text-decoration-none" href="index.php?act=login">
        <i class="fa fa-fw fa-user text-dark mr-3"></i>
        <span class="text-dark"></span>
    </a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Header -->
    <!-- InstanceBeginEditable name="Editable-1" -->
    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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