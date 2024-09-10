<div class="w-75 mb-5 overflow-scroll" style="margin: auto 20 auto 300;">
    <h2>Danh sách người dùng</h2>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">Username</th>
                <th class="text-center">Email</th>
                <th class="text-center">Role</th>
                <th class="text-center">Ngày đăng ký</th>
                <th class="text-center">&nbsp;</th>

            </tr>
        </thead>
        <?php foreach ($listuser as $item) : ?>
            <tr>

                <td class="text-center"><a class="text-danger" href="index.php?admin=userdetails&id=<?= $item['user_id'] ?>"><?= $item['username'] ?></a></td>
                <td class="text-center"><?= $item['email'] ?></td>
                <td class="text-center"><?php if (($item['role']) == 0) {
                                            echo 'User';
                                        } else {
                                            echo 'Admin';
                                        } ?></td>
                <td class="text-center"><?= $item['creat_at'] ?></td>
                <td class="text-center align-middle">
                    <a href="index.php?admin=deluser&iduser=<?= $item['user_id']; ?>" style=" cursor: pointer;" class="nav-icon position-relative text-decoration-none ms-1" onclick="confirm(event)">
                        <i class="fa fa-trash text-dark mr-2"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php
        $sqlpage = mysqli_query($conn->getConnection(), "SELECT * FROM user");
        $count = mysqli_num_rows($sqlpage);
        $trang = ceil($count / 9);
        ?>
    </table>
    <div class="d-flex justify-content-between">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <?php
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                for ($j  = 1; $j <= $trang; $j++) {
                    $activeClass = ($j == $currentPage) ? 'active' : '';

                ?>
                    <li class="page-item <?php echo $activeClass; ?>"><a class="page-link" href="index.php?admin=user&page=<?php echo $j ?>"><?php echo $j ?></a>
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
<!-- 
<script>
    function confirmDelete(id) {
        var result = confirm("Bạn có chắc chắn muốn xoá người dùng này không?");
        if (result) {
            window.location = "index.php?admin=deluser&iduser=" + id;
        } else {
            return false;
        }
    }
</script> -->