    <div class="sidebar" id="mySidebar">
        <div class="side-header">
            <img class="rounded-circle ml-2 border" src="./assets/images/Remove-bg.ai_1713575763832.png" width="120"
                height="120" alt="BeeComputers">
            <h5 style="margin-top:10px;">Hello, <?php if (isset($_SESSION['username']) && $_SESSION['username'] != "") {
                                                    $words = explode(" ", $_SESSION['username']);
                                                    $numWords = count($words);
                                                    if ($numWords >= 2) {
                                                        $lastTwoWords = $words[$numWords - 2] . " " . $words[$numWords - 1];
                                                        echo $lastTwoWords;
                                                    } else {
                                                        echo $_SESSION['username'];
                                                    }
                                                } ?>
            </h5>
        </div>

        <hr style="border:1px solid; background-color:#fff; border-color:#fff;">
        <a href="#" class="closebtn" onclick="closeNav()">×</a>
        <a href="index.php?admin=home"><i class="fa fa-home"></i> Trang chủ</a>
        <a href="index.php?admin=user"><i class="fa fa-users"></i> Người dùng</a>
        <a href="index.php?admin=category"><i class="fa fa-th-large"></i> Danh mục</a>
        <a href="index.php?admin=categorydetails"><i class="fa fa-th"></i> Danh mục CT</a>
        <a href="index.php?admin=product"><i class="fa fa-th"></i> Sản phẩm</a>
        <a href="index.php?admin=order"><i class="fa fa-archive"></i> Đơn hàng</a>
        <a href="index.php?admin=comment"><i class="fa fa-comments"></i> Bình luận</a>
        <a href="index.php?admin=event"><i class="fa fa-gift"></i> Khuyến mãi</a>
        <a href="index.php?admin=thongke"><i class="fa fa-line-chart"></i> Thống kê</a>
        <a href="index.php?admin=exit"><i class="fa fa-sign-in"></i> Đăng xuất</a>


    </div>

    <div id="main">
        <button class="openbtn" onclick="openNav()"><i class="fa fa-home"></i></button>
    </div>