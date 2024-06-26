<!-- <?php

function showsp($id,$begin){
    include "./global.php";
    $sql = "select * from products where 1";
    if ($id > 0){
        $sql.= " AND category_details_id=".$id;
    }
    $sql.= " LIMIT $begin,9";
    $datas=$database->executeQueryAll($sql);
   return $datas;
}

?> -->