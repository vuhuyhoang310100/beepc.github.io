<div class="w-75 mb-5 overflow-scroll" style="margin: auto 20 auto 300;">
    <h2>Danh sách người dùng</h2>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">Họ và tên</th>
                <th class="text-center">Giới tính</th>
                <th class="text-center">Điện thoại</th>
                <th class="text-center">Địa chỉ</th>


            </tr>
        </thead>
        <?php
        if (empty($userdetails)) {
            echo '<td class="text-center text-danger" colspan="4">Khách hàng chưa cập nhật thông tin</td>';
        } else {
        ?>
        <tr>

            <td class="text-center"><?php if (!empty($userdetails['fullname'])) {
                                            echo $userdetails['fullname'];
                                        } else {
                                            echo '';
                                        }
                                        ?></td>
            <td class="text-center"><?php
                                        if ($userdetails['sex'] == 0) {
                                            echo 'Nam';
                                        } else {
                                            echo 'Nữ';
                                        }

                                        ?></td>
            <td class="text-center"><?php if (!empty($userdetails['tel'])) {
                                            echo $userdetails['tel'];
                                        } else {
                                            echo '';
                                        }
                                        ?></td>

            <td class="text-center"><?php if (!empty($userdetails['address'])) {
                                            echo $userdetails['address'];
                                        } else {
                                            echo '';
                                        }
                                        ?></td>

        </tr>
        <?php } ?>



</div>