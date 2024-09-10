<div class="w-50" style="margin: 0 auto;">
    <h3>Cập nhật danh mục chi tiết</h3>
    <form action="index.php?admin=updatecatedet" method="post" enctype="multipart/form-data">
        <div class="row">

            <div class="col-4">
                <label for="text" class="form-label">Tên DM chi tiết mới:</label>

                <input type="text" class="form-control" name="newname" value="<?php echo isset($result['name']) ? $result['name'] : ''; ?>">
                <input type="hidden" class="form-control" name="iddet" value="<?php echo $result['category_details_id'] ?>">
            </div>
            <div class="col-4">
                <label for="text" class="form-label">Tên danh mục</label>
                <br>
                <div class="form-group">

                    <select class="form-control" name="select" aria-label="Chọn danh mục">

                        <option selected>Chọn danh mục</option>
                        <?php
                        foreach ($danhmuc_data as $value) {
                            extract($value);
                            echo ' <option value="' . $category_id . '">' . $name . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-4">
                <label for="text" class="form-label">&nbsp;</label>
                <br>
                <button type="submit" name="update" class="btn btn-primary py-1">Cập nhật</button>
            </div>
        </div>
        <input type="hidden" class="form-control" name="id" value="<?php echo $result['category_id'] ?>">
    </form>
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



            </tr>
        </thead>
        <?php

        foreach ($danhmucpage as $danhmuc) {
            extract($danhmuc);
            echo '  <tr>
            <td class="text-center">' . $i++ . '</td>
        <td class="text-center">' . $dmname . '</td>
        <td class="text-center">' . $name . '</td>

    <td class="text-center"><a class="nav-icon position-relative text-decoration-none ms-1" href="index.php?admin=updatecatedet&iddet=' . $category_details_id . '">
        <i class="fa fa-edit text-dark mr-2"></i>
        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
    </a></td>
       
        </tr>   
       ';
        }
        ?>

    </table>
    <?php
    $count = count($danhmucct_data);
    $trang = ceil($count / 9);
    ?>

    <div class="d-flex justify-content-between">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <?php
                                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                for ($j  = 1; $j <= $trang; $j++) {
                    $activeClass = ($j == $currentPage) ? 'active' : '';

                    if (isset($_GET['id'])) {
                ?>
                        <li class="page-item <?php echo $activeClass; ?>"><a class="page-link" href="index.php?admin=updatecatedet&id=<?php echo $id ?>&page=<?php echo $j ?>"><?php echo $j; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item <?php echo $activeClass; ?>"><a class="page-link" href="index.php?admin=updatecatedet&page=<?php echo $j ?>"><?php echo $j ?></a>
                        </li>
                <?php
                    }
                }
                ?>


                <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
             <li class="page-item"><a class="page-link" href="#">3</a></li> -->

            </ul>
        </nav>


    </div>
    <!-- Modal -->
    <!-- ADD CATEGORY -->

    <!-- UPDATE CATEGORY -->

</div>
</div>