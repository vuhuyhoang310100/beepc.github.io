<!-- <?php
function showdanhmuc(){
    include "./global.php";
    $sql = "select * from category";
    $datas=$database->executeQueryAll($sql);
   return $datas;
}

function showdanhmucchitiet(){
    include "./global.php";
    $sql = "SELECT 
    c.category_id, 
    c.name AS category_name, 
    cd.category_details_id, 
    cd.name AS category_details_name
FROM 
    category c
JOIN 
    category_details cd ON c.category_id = cd.category_id;";
   
    $result=mysqli_query($database->getConnection(), $sql);
    $categories = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $category_id = $row['category_id'];
        $category_name = $row['category_name'];
        $category_details_id = $row['category_details_id'];
        $category_details_name = $row['category_details_name'];

        // Tạo mảng đa chiều
        $categories[$category_id]['name'] = $category_name;
        $categories[$category_id]['details'][$category_details_id] = $category_details_name;
    }

    return $categories;
}
?> -->