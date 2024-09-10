    <div class="w-75 mb-5 overflow-scroll" style="margin: auto 20 auto 300;">
        <h2>Danh sách sản phẩm</h2>
        <form method="GET" action="index.php">
            <input type="hidden" name="admin" value="product">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="c_select">Chọn danh mục</label>
                        <select class="form-control categoryajax" id="category" name="category" aria-label="Chọn danh mục">
                            <option value="" selected>--Chọn danh mục--</option>
                            <?php
                            foreach ($categories_details as $value) {

                                echo ' <option value="' . $value['category_id'] . '">' . $value['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="c_select">Chọn danh mục chi tiết</label>
                        <select class="form-control" name="category_details" aria-label="Chọn danh mục" id="load">
                            <option value="" selected>--Chọn danh mục chi tiết--</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mt-1">
                    <br>
                    <button type="submit" class="btn btn-primary mt-2 text-align-center">Filter</button>
                    <a href="index.php?admin=product" class="btn btn-secondary mt-2 text-align-center">Reset</a>

                </div>
            </div>



        </form>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">STT</th>
                    <th class="text-center">Hình</th>
                    <th class="text-center">Tên sản phẩm</th>
                    <th class="text-center">Loại</th>
                    <th class="text-center">DMCT</th>
                    <th class="text-center">Giá</th>
                    <!-- <th class="text-center">Số lượng</th> -->
                    <th class="text-center">Mô tả</th>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
            </thead>
            <?php
            $i = 1;
            foreach ($products as $product) {
                extract($product);
                $namedm = $danhmuc->getonedetdm($category_details_id);
                $namedmct = $namedm['name'];
                $link = ADMIN_PATH . $img;
                echo '  <tr>
                <td class="text-center align-middle">' . $i++ . '</td>
                <td class="text-center align-middle""><img src="' . $link . '" alt="" height="50px" width="50px"></td>
            <td class="text-center align-middle"">' . $name . '</td>
            <td class="text-center align-middle"">' . $firm . '</td>
                <td class="text-center align-middle"">' . $namedmct  . '</td>
            <td class="text-center align-middle">' . number_format($price, 0, ',', '.') . ' vnđ' . '</td>
        
            <td class=""><div class="overflow-y" onclick="expandText()><p id="td-scroll" style="border: none;">' . $description . '</p></div></td>
            <td class="text-center align-middle"">
            <a href="index.php?admin=delproduct&idproduct=' . $product_id . '" style="cursor: pointer;" class="nav-icon position-relative text-decoration-none ms-1" onclick="confirm(event)">
        <i class="fa fa-trash text-dark mr-2"></i>
        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
        </a>
        </td>
        <td class="text-center align-middle""><a class="nav-icon position-relative text-decoration-none ms-1"
                href="index.php?admin=updateproduct&idproduct=' . $product_id . '">
                <i class="fa fa-edit text-dark mr-2"></i>
                <span
                    class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
            </a></td>
            </tr>
        ';
            }
            ?>

        </table>
        <div class="d-flex justify-content-between">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">

                    <?php
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                    for ($j = 1; $j <= $trang; $j++) {
                        $activeClass = ($j == $currentPage) ? 'active' : '';

                        $url = 'index.php?admin=product&page=' . $j;
                        if (!empty($categoryId)) {
                            $url .= '&category=' . $categoryId;
                        }

                        if (!empty($categoryDetailsId)) {
                            $url .= '&category_details=' . $categoryDetailsId;
                        }
                    ?>
                        <li class="page-item <?php echo $activeClass; ?>">
                            <a class="page-link" href="<?php echo $url; ?>"><?php echo $j; ?></a>
                        </li>
                    <?php
                    } ?>



                    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li> -->

                </ul>
            </nav>

            <button type="button" class="btn btn-secondary" style="height:40px" data-toggle="modal" data-target="#myModal">
                Thêm sản phẩm
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Sản phẩm</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <form action="index.php?admin=addproduct" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="c_name">Tên sản phẩm</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="c_firm">Loại</label>
                                        <input type="text" class="form-control" name="firm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="c_select">Chọn danh mục</label>
                                        <select class="form-control categoryajax" id="modal_category" name="category" aria-label="Chọn danh mục">
                                            <option value="" selected>--Chọn danh mục--</option>
                                            <?php
                                            foreach ($categories_details as $value) {

                                                echo ' <option value="' . $value['category_id'] . '">' . $value['name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="c_select">Chọn danh mục chi tiết</label>
                                        <select class="form-control" name="category_details" aria-label="Chọn danh mục" id="modal_category_details">
                                            <option value="" selected>--Chọn danh mục chi tiết--</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="c_name">Giá:</label>
                                        <input type="text" class="form-control" name="price" required>
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
                                    <input type="submit" class="btn btn-secondary" name="addproduct" value="Thêm" style="height:40px">
                                </div>
                            </div>
                            </form>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px;">Close</button>
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
    // function confirmDelete(id) {
    //     var result = confirm("Bạn có chắc chắn muốn xoá sản phẩm này không?");
    //     if (result) {
    //         window.location = "index.php?admin=delproduct&idproduct=" + id;
    //     } else {
    //         return false;

    //     }
    // }
    // </script> -->