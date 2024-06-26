<?php ?>
<div class="container light-style flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-4 ms-3">
        Xin chào,
        <?php
        //Xử lý chuỗi tên
        if (isset($_SESSION['username']) && $_SESSION['username'] != "" && $_SESSION['role'] != 1) {
            $words = explode(" ", $_SESSION['username']);
            $numWords = count($words);
            if ($numWords >= 2) {
                $lastTwoWords = $words[$numWords - 2] . " " . $words[$numWords - 1];
                echo $lastTwoWords;
            } else {
                echo $_SESSION['username'];
            }
        } else {
            header("Location: ./auth/login.php");
        }
        ?>


    </h4>

    <form action="" method="post">
        <div class="overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <?php
                        //Làm active cho list-group
                        if ($_GET['act'] == "userinfo") {
                            echo ' <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="index.php?act=userinfo">Thông tin</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="index.php?act=changepassword">Đổi mật khẩu</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="index.php?act=history">Lịch sử
                            đơn hàng</a>';
                        } else if ($_GET['act'] == "changepassword") {
                            echo ' <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="index.php?act=userinfo">Thông tin</a>
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="index.php?act=changepassword">Đổi mật khẩu</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="index.php?act=history">Lịch sử
                            đơn hàng</a>';
                        } else {
                            echo ' <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="index.php?act=userinfo">Thông tin</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="index.php?act=changepassword">Đổi mật khẩu</a>
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="index.php?act=history">Lịch sử
                            đơn hàng</a>';
                        }
                        ?>

                    </div>
                </div>
                <table class="table w-50">
                    <tr>
                        <td class="align-middle text-end">Mật khẩu cũ: </td>
                        <td class="border-bottom">
                            <input type="password" class="form-control border-0" value="" placeholder="Nhập mật khẩu cũ"
                                name="oldpw" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle text-end">Mật khẩu mới:</td>
                        <td class="border-bottom"><input type="password" class="form-control border-0"
                                placeholder="Nhập mật khẩu mới" name="newpw" value="" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle text-end">Xác nhận mật khẩu mới:</td>
                        <td class="border-bottom"><input type="password" class="form-control border-0"
                                placeholder="Nhập lại mật khẩu mới" name="c_newpw" value="" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">


                            <?php
                                if (isset($msg)) {
                                    echo '<div class="alert alert-success" role="alert">'.$msg.'</div>';
                                }
                                ?>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <input type="submit" class="btn btn-primary" name="update" value="Đổi mật khẩu">
                        </td>
                    </tr>
                </table>
            </div>


        </div>
    </form>
</div>