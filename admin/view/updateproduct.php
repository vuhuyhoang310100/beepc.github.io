<?php
if (isset($sanpham) && (is_array($sanpham))) {
    $img = ADMIN_PATH . $sanpham['img'];
} else {
    $img = "assets/images/loi-404-not-found.jpg";
}
?>
<div class="w-75" style="margin: 0 auto 0 320px">
    <h3>Cập nhật danh mục chi tiết</h3>
    <form action="index.php?admin=updateproduct" method="post" enctype="multipart/form-data">
        <div class="row">

            <div class="col-6">
                <div class="form-group">
                    <div class="ml-5 mt-2"> <img class="img mt-2 ml-3" src="<?php echo isset($img) ? $img : "assets/images/loi-404-not-found.jpg"; ?>" alt="" height="200px" width="300px">

                    </div>
                    <label for="c_name">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" value="<?php echo isset($sanpham['name']) ? $sanpham['name'] : ''; ?>" required>
                </div>
                <div class="form-group">

                    <label for="c_select">Chọn danh mục</label>
                    <select class="form-control categoryajax" id="category" name="category" aria-label="Chọn danh mục">
                        <option value="" selected>--Chọn danh mục--</option>
                        <?php
                        foreach ($categories_details as $value) {
                            if ($value['category_id'] == $sanpham['category_id'])
                                echo ' <option value="' . $value['category_id'] . '" selected>' . $value['name'] . '</option>';
                            else {
                                echo ' <option value="' . $value['category_id'] . '">' . $value['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="c_name">Hình ảnh:</label>
                    <input type="file" name="img" class="form-control">

                </div>
                <div class="form-group">
                    <label for="c_name">Giá:</label>
                    <input type="text" class="form-control" name="price" value="<?php echo isset($sanpham['price']) ? $sanpham['price'] : ''; ?>" required>
                </div>

            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="c_firm">Loại</label>
                    <input type="text" class="form-control" name="firm" value="<?php echo isset($sanpham['firm']) ? $sanpham['firm'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="c_select">Chọn danh mục chi tiết</label>
                    <select class="form-control" name="category_details" aria-label="Chọn danh mục" id="load">
                        <option value="" selected>--Chọn danh mục chi tiết--</option>
                    </select>
                </div>
                <div class="form-group align-top">
                    <label for="c_name">Mô tả:</label>
                    <textarea class="form-control " style="resize: none; vertical-align: top;" rows="5" name="description" id="description"><?php echo isset($sanpham['description']) ? $sanpham['description'] : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-secondary" name="updateproduct" value="Sửa" style="height:40px">
                </div>
            </div>
        </div>
        <input type="hidden" name="product_id" value="<?php echo $sanpham['product_id'] ?>">
    </form>
    <div class="w-100 mb-5 overflow-scroll">
        <h2>Danh sách sản phẩm</h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">STT</th>
                    <th class="text-center">Hình</th>
                    <th class="text-center">Tên sản phẩm</th>
                    <th class="text-center">Loại</th>
                    <th class="text-center">DMCT</th>
                    <th class="text-center">Giá</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-center">Mô tả</th>
                    <th class="text-center">&nbsp;</th>

                </tr>
            </thead>
            <?php
            $i = 1;
            foreach ($products as $product) {
                extract($product);
                $link = ADMIN_PATH . $img;
                echo '  <tr>
            <td class="text-center align-middle">' . $i++ . '</td>
            <td class="text-center align-middle""><img src="' . $link . '" alt="" height="50px" width="50px"></td>
        <td class="text-center align-middle"">' . $name . '</td>
        <td class="text-center align-middle"">' . $firm . '</td>
            <td class="text-center align-middle"">' . $category_details_id . '</td>
        <td class="text-center align-middle">' . $price . '</td>
        <td class="text-center align-middle">' . $quantity . '</td>
        <td class=""><div class="overflow-y" onclick="expandText()><p id="td-scroll" style="border: none;">' . $description . '</p></div></td>
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
            <?php
            if (isset($_GET['id'])) {
                $sqlpage = mysqli_query($conn->getConnection(), "SELECT * FROM products where category_details_id= $id");
            } else {
                $sqlpage = mysqli_query($conn->getConnection(), "SELECT * FROM products");
            }
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
                        if (isset($_GET['idproduct'])) {
                    ?>
                            <li class="page-item <?php echo $activeClass; ?>"><a class="page-link" href="index.php?admin=updateproduct&idproduct=<?php echo $id ?>&page=<?php echo $j ?>"><?php echo $j; ?></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item <?php echo $activeClass; ?>"><a class="page-link" href="index.php?admin=updateproduct&page=<?php echo $j ?>"><?php echo $j ?></a>
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
    </div>
</div>
</div>