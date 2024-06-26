<div class="container py-5">
    <div class="row">

        <div class="col-lg-3">
            <h1 class="h2 pb-4"><strong>Danh mục</strong></h1>
            <ul class="list-unstyled templatemo-accordion">
                <?php
                $danhmuc = new DanhMuc($conn);
                $categories = $danhmuc->showdanhmucchitiet();
                foreach ($categories as $categoryID => $category) {
                    echo '<li class="pb-3">
                           <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                               <strong>' . $category['name'] . '</strong>
                               <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                           </a>
                           <ul class="collapse show list-unstyled pl-3">';

                    foreach ($category['details'] as $detailsID => $detailsName) {
                        echo '<li><a class="text-decoration-none" href="index.php?act=product&id=' . $detailsID . '">' . $detailsName . '</a></li>';
                    }

                    echo '</ul>
                       </li>';
                }
                ?>
            </ul>
        </div>