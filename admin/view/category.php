<div class="w-50" style="margin: 0 auto;">
    <h3>Danh sách danh mục</h3>
    <table class="table">
        <?php
        $i = 1;
        ?>
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Tên danh mục</th>
                <th class="text-center">Danh mục con</th>
                <th class="text-center">&nbsp;</th>
                <th class="text-center">&nbsp;</th>

            </tr>
        </thead>
        <?php
        foreach ($danhmuc_datapage as $danhmuc) {
            extract($danhmuc);
            echo '<tr>
            <td class="text-center">' . $i++ . '</td>
            <td class="text-center">' . $dmname . '</td>
            <td class="text-center">' . $count_subcategories . '</td>
            <td class="text-center">
            <a href="index.php?admin=delcate&id=' . $category_id . '" style="cursor: pointer;" class="nav-icon position-relative text-decoration-none ms-1">
        <i class="fa fa-trash text-dark mr-2"></i>
        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
        </a>
        </td>
        <td class="text-center"><a class="nav-icon position-relative text-decoration-none ms-1"
                href="index.php?admin=updatecate&id=' . $category_id . '">
                <i class="fa fa-edit text-dark mr-2"></i>
                <span
                    class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
            </a></td>
        </tr>';
        }
        ?>

    </table>
    <?php
    $count = count($danhmuc_data);
    $trang = ceil($count / 9);
    ?>

    <div class="d-flex justify-content-between">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <?php
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                for ($j  = 1; $j <= $trang; $j++) {
                    $activeClass = ($j == $currentPage) ? 'active' : '';

                ?>
                    <li class="page-item <?php echo $activeClass; ?>"><a class="page-link" href="index.php?admin=category&page=<?php echo $j ?>"><?php echo $j ?></a>
                    </li>
                <?php
                }

                ?>


                <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
             <li class="page-item"><a class="page-link" href="#">3</a></li> -->

            </ul>
        </nav>

        <button type="button" class="btn btn-secondary" style="height:40px" data-toggle="modal" data-target="#myModal">
            Thêm danh mục
        </button>

    </div>
    <!-- Modal -->
    <!-- ADD CATEGORY -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Danh mục</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="index.php?admin=addcate" method="POST">
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary" name="addcate" style="height:40px">Thêm</button>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- UPDATE CATEGORY -->

</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
