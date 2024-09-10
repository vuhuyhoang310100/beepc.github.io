<div class="w-50" style="margin: 20 auto;">
    <h3>Danh sách danh mục chi tiết</h3>
    <table class="table">
        <?php
        $i = 1;
        ?>
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Tên danh mục</th>
                <th class="text-center">Tên danh mục chi tiết</th>
                <th class="text-center">&nbsp;</th>
                <th class="text-center">&nbsp;</th>
            </tr>
        </thead>
        <?php
        foreach ($danhmucpage as $danhmucct) {
            extract($danhmucct);
            echo '  <tr>
            <td class="text-center">' . $i++ . '</td>
            <td class="text-center">' . $dmname . '</td>
        <td class="text-center">' . $name . '</td>
        <td class="text-center">
        <a href="index.php?admin=delcatedet&iddet=' . $category_details_id . '" style="cursor: pointer;" class="nav-icon position-relative text-decoration-none ms-1"">
    <i class="fa fa-trash text-dark mr-2"></i>
    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
    </a>
    </td>
    <td class="text-center"><a class="nav-icon position-relative text-decoration-none ms-1"
            href="index.php?admin=updatecatedet&iddet=' . $category_details_id . '">
            <i class="fa fa-edit text-dark mr-2"></i>
            <span
                class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
        </a></td>
        </tr>
       ';
        }
        ?>
        <?php
        $count = count($categories_details);
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
                        if (isset($_GET['id'])) {
                    ?>
                            <li class="page-item <?php echo $activeClass; ?>"><a class="page-link" href="index.php?admin=categorydetails&id=<?php echo $id ?>&page=<?php echo $j ?>"><?php echo $j; ?></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item <?php echo $activeClass; ?>"><a class="page-link" href="index.php?admin=categorydetails&page=<?php echo $j ?>"><?php echo $j ?></a>
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
            Thêm danh mục chi tiết
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Danh mục chi tiết</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="index.php?admin=addcatedetails" method="POST">
                        <div class="form-group">
                            <label for="c_name">Tên danh mục chi tiết</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">

                            <select class="form-control" name="select" aria-label="Chọn danh mục">

                                <option selected>Chọn danh mục</option>
                                <?php
                                foreach ($danhmuc_data as $value) {

                                    echo ' <option value="' . $value['category_id'] . '">' . $value['name'] . '</option>';
                                }
                                ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary" name="addcatedetails" style="height:40px">Thêm</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px;">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
