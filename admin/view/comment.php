<div class="w-75 mb-5 overflow-scroll" style="margin: auto 20 auto 300;">
    <h2>Danh sách bình luận</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="text-center">Tên người dùng</th>
                <th class="text-center">Sản phẩm</th>
                <th class="text-center">Nội dung</th>
                <!-- <th class="text-center">Số lượng</th> -->
                <th class="text-center">Thời gian</th>
                <th class="text-center">&nbsp;</th>

            </tr>
        </thead>
        <?php
        foreach ($cmt as $item) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $create_at = $item['create_at'];
            $formatted_time = date('Y-m-d H:i:s', strtotime($create_at));
            if (!empty($user->getusernamesbyid($item['user_id']))) {
                $name = $user->getusernamesbyid($item['user_id']);
            } else {
                $name = $user->getnameuserbyid($item['user_id']);
            };
            $product_name = $product->get_name_byid($item['product_id']);
            echo '  <tr>
            <td class="text-center align-middle">' . $name . '</td>
        <td class="text-center align-middle"">' . $product_name . '</td>
        <td class="text-center align-middle"><div class="overflow-y" onclick="expandText()><p id="td-scroll" style="border: none;">' . $item['comment'] . '</p></div></td>
        <td class="text-center align-middle"">' . $formatted_time . '</td>
        <td class="text-center align-middle"">
        <a href="index.php?admin=delcmt&idreview=' . $item['review_id'] . '" style="cursor: pointer;" class="nav-icon position-relative text-decoration-none ms-1" onclick="confirm(event)">
    <i class="fa fa-trash text-dark mr-2"></i>
    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
    </a>
    </td>
  
        </tr>
       ';
        }
        ?>
        <?php
        $sqlpage = mysqli_query($conn->getConnection(), "SELECT * FROM reviews");
        $count = mysqli_num_rows($sqlpage);
        $trang = ceil($count / 9);
        ?>
    </table>
    <div class="d-flex justify-content-between">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">

                <?php

                for ($j  = 1; $j <= $trang; $j++) {
                ?>
                    <li class="page-item"><a class="page-link" href="index.php?admin=comment&page=<?php echo $j ?>"><?php echo $j ?></a>
                    </li>
                <?php
                }

                ?>


                <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
             <li class="page-item"><a class="page-link" href="#">3</a></li> -->

            </ul>
        </nav>


    </div>
</div>
<script type="text/javascript">
    function confirm(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        swal({
                title: "Bạn có chắc muốn xoá không ?",
                icon: "warning",
                dangerMode: true,
                buttons: true,

            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Xoá thành công !!!", {
                        icon: "success",
                    });
                    setTimeout(function() {
                        window.location.href = urlToRedirect;
                    }, 1000);
                } else {
                    swal("Xoá không thành công !!!");
                }
            });
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script>
    function confirmDelete(id) {
        var result = confirm("Bạn có chắc chắn muốn xoá bình luận này không?");
        if (result) {
            window.location = "index.php?admin=delcmt&idreview=" + id;
        } else {
            return false;

        }
    }
</script> -->