<div class="w-75 mb-5 overflow-scroll" style="margin: auto 20 auto 300;">
    <h2>Danh sách sự kiện</h2>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Tên sự kiện</th>
                <th class="text-center">Hình ảnh</th>
                <th class="text-center">Mã giảm giá</th>
                <th class="text-center">Giá trị</th>
                <th class="text-center">Content</th>
                <th class="text-center">Ngày bắt đầu</th>
                <!-- <th class="text-center">Số lượng</th> -->
                <th class="text-center">Ngày kết thúc</th>
                <th class="text-center">&nbsp;</th>

            </tr>
        </thead>
        <?php
        $i = 1;
        foreach ($events as $event) {
            $img = ADMINEVENT_PATH . $event['img'];
            echo '  <tr>
            <td class="text-center align-middle">' . $i++ . '</td>
            <td class="text-center align-middle"">' . $event['name'] . '</td>
            <td class="text-center align-middle""><img height="50px" width="120px" src="' . $img . '" alt=""></td>

        <td class="text-center align-middle"">' . $event['code'] . '</td>
        <td class="text-center align-middle"">' . number_format($event['discount_rate'], 0, ',', '.') . ' vnđ' . '</td>
        <td class=""><div class="overflow-y" onclick="expandText()><p id="td-scroll" style="border: none;">' . $event['content'] . '</p></div></td>
        <td class="text-center align-middle"">' . $event['start'] . '</td>
        <td class="text-center align-middle"">' . $event['end'] . '</td>
        <td class="text-center align-middle"">
        <a href="index.php?admin=delevent&idevent=' . $event['discount_id'] . '" style="cursor: pointer;"  class="nav-icon position-relative text-decoration-none ms-1" onclick="confirm(event)">
    <i class="fa fa-trash text-dark mr-2"></i>
    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
    </a>
    </td>
    
        </tr>
       ';
        }
        ?>
        <?php
        $sqlpage = mysqli_query($conn->getConnection(), "SELECT * FROM discount");
        $count = mysqli_num_rows($sqlpage);
        $trang = ceil($count / 9);
        ?>
    </table>
    <div class="d-flex justify-content-between">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <?php
                for ($j  = 1; $j <= $trang; $j++) {
                    if (isset($_GET['id'])) {
                ?>
                        <li class="page-item"><a class="page-link" href="index.php?admin=event&id=<?php echo $id ?>&page=<?php echo $j ?>"><?php echo $j; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item"><a class="page-link" href="index.php?admin=event&page=<?php echo $j ?>"><?php echo $j ?></a>
                        </li>
                <?php
                    }
                }

                ?>


                <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
             <li class="page-item"><a class="page-link" href="#">3</a></li> -->

            </ul>
        </nav>

        <button type="button" class="btn btn-secondary" style="height:40px" data-toggle="modal" data-target="#myModal">
            Thêm sự kiện
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm sự kiện</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <form action="index.php?admin=addevent" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="c_name">Tên sự kiện</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="c_firm">Code</label>
                                    <input type="text" class="form-control" name="code" required>
                                </div>
                                <div class="form-group">
                                    <label for="c_firm">Giá trị</label>
                                    <input type="text" class="form-control" name="value" required>
                                </div>
                                <div class="form-group">
                                    <label for="c_firm">Ngày bắt đầu</label>
                                    <input type="date" class="form-control" name="start" required>
                                </div>
                                <div class="form-group">
                                    <label for="c_firm">Ngày kết thúc</label>
                                    <input type="date" class="form-control" name="end" required>
                                </div>


                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="c_name">Hình ảnh:</label>
                                <input type="file" name="img" class="form-control">`
                            </div>
                            <div class="form-group align-top">
                                <label for="c_name">Mô tả:</label>
                                <textarea class="form-control " style="resize: none; vertical-align: top;" rows="5" name="description" id="description"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary" name="addevent" value="Thêm">Thêm</button>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" name="addevent" data-dismiss="modal" style="height:40px;">Close</button>
                </div>
            </div>
        </div>
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
        var result = confirm("Bạn có chắc chắn muốn xoá sự kiện này không?");
        if (result) {
            window.location = "index.php?admin=delevent&idevent=" + id;
        } else {
            return false;

        }
    }
</script> -->