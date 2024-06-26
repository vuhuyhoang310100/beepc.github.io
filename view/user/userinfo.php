<?php
ob_start();
?>
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

        <?php
        //Xử lý thêm dữ liệu vào bảng user_details 
        if (isset($_POST['update']) && $_POST['update']) {
            $usid =  $_SESSION['id_user'];
            $fullname = $_POST['fullname'];
            $sex = $_POST['sex'];
            $tel = $_POST['tel'];
            $address = $_POST['address'];
            if ($usermod->adduserdetails($usid, $fullname, $sex, $tel, $address)) {
                $_SESSION['sttupdate'] = "Lưu thông tin thành công !!!";
                header("Location: index.php?act=userinfo");
                exit();
            } else {
                $_SESSION['sttupdate'] = "Lưu thông tin không thành công !!!";
            };
        } ?>

        <?php
        //Xử lý sửa dữ liệu trong bảng user_details
        if (isset($_POST['edit']) && $_POST['edit']) {
            $usid =  $_SESSION['id_user'];
            $fullname = $_POST['fullname'];
            $sex = $_POST['sex'];
            $tel = $_POST['tel'];
            $address = $_POST['address'];
            if ($usermod->update_userdetails($usid, $fullname, $sex, $tel, $address)) {
                $usermod->update_username($usid, $fullname);
                $_SESSION['sttupdate'] = "Cập nhật thành công !!!";
                header("Location: index.php?act=userinfo");
                exit();
            } else {
                $_SESSION['sttupdate'] = "Cập nhật không thành công !!!";
            };
        }
        ?>



    </h4>
    <?php
    //Thiết lập session để load lại trang
    if (isset($_SESSION['update_user']) && $_SESSION['update_user']) {
        header("Location: index.php?act=userinfo");
        unset($_SESSION['update_user']);
    } else {
        $alert = "";
    }
    ?>
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
                        <td class="align-middle text-end">Họ và tên:</td>
                        <td class="border-bottom"><input type="text" class="form-control border-0" value="<?php echo $fullname ?>" placeholder="Nhập tên của bạn..." name="fullname" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle text-end">Giới tính:</td>
                        <td class="border-bottom">
                            <div class="d-flex justify-content-start align-content-center ms-2">
                                <?php
                                if ($sex == 0) {
                                    echo ' <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="sex" id="flexRadioDefault1"
                                    value="0" checked>
                                <label class="form-check-label" for="flexRadioDefault1">Nam</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sex" id="flexRadioDefault2"
                                    value="1">
                                <label class="form-check-label" for="flexRadioDefault2">Nữ</label>
                            </div>';
                                } else {
                                    echo ' <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="sex" id="flexRadioDefault1"
                                    value="0">
                                <label class="form-check-label" for="flexRadioDefault1">Nam</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sex" id="flexRadioDefault2"
                                    value="1" checked>
                                <label class="form-check-label" for="flexRadioDefault2">Nữ</label>
                            </div>';
                                }
                                ?>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle text-end">Số ĐT:</td>
                        <td class="border-bottom"><input type="text" class="form-control border-0" placeholder="Nhập số điện thoại..." name="tel" value="<?php echo $tel; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle text-end">Địa chỉ:</td>
                        <td class="border-bottom"><input type="text" class="form-control border-0" placeholder="Nhập địa chỉ..." name="address" value="<?php echo $address; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            <?php
                            if ($user_details->num_rows == 0) {
                                echo '<input type="submit" class="btn btn-primary" name="update" value="Lưu thông tin">';
                            } else {
                                echo '<input type="submit" class="btn btn-primary" name="edit" value="Sửa thông tin">';
                            }
                            ?>


                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td style="color: red;"><?php if (isset($_SESSION['save-sucess']) && $_SESSION['save-sucess'] === true) {
                                                    // Hiển thị thông báo
                                                    echo "<div class='message' id='alertMessage'>Lưu thông tin thành công !!</div>";
                                                    // Xóa session để tránh hiển thị thông báo lần tiếp theo
                                                    unset($_SESSION['save-sucess']);
                                                }
                                                ?>
                        </td>
                    </tr>
                </table>
            </div>


        </div>
    </form>
</div>
<script>
    setTimeout(function() {
        // Lấy phần tử có id 'alertMessage'
        var alertMessage = document.getElementById('alertMessage');

        // Kiểm tra xem phần tử tồn tại
        if (alertMessage) {
            // Ẩn phần tử
            alertMessage.style.display = 'none';
        }
    }, 5000);
</script>