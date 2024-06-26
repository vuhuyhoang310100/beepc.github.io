<div class="container mt-5">
    <div class="row">
        <?php
        foreach ($event as $value) {
            $imglink = USER_PATH .'events/'. $value['img'];
            echo '<div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><img class="img-w300-h200 img-fluid" src="' . $imglink . '"></h5>
                    <p class="card-text"><b>' . $value['name'] . '</b></p>
                    <hr />
                    <a href="index.php?act=eventdetails&id=' . $value['discount_id'] . '" class="btn btn-primary">Săn voucher ngay</a>
                </div>
            </div>
        </div>';
        }
        ?>
    </div>
</div>