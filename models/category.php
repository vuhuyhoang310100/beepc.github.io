<?php
// function showdanhmuc(){
//     include "./global.php";
//     $sql = "select * from category";
//     $datas=$database->executeQueryAll($sql);
//    return $datas;
// }
// function showdanhmucadmin(){
//     include "../global.php";
//     $sql = "select * from category";
//     $datas=$database->executeQueryAll($sql);
//    return $datas;
// }



// 
?>
<?php
class DanhMuc
{
    private $db;
    function __construct($db)
    {
        $this->db = new Database();
    }
    function get_idcate_by_catedetid($id)
    {
        $sql = "SELECT * FROM category_details where category_id= $id";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    function count_catedet($id)
    {
        $sql = "SELECT Count(*) FROM category_details as cd, category as c where cd.category_id=c.category_id and c.category_id=$id";
        $datas = $this->db->executeQueryOne($sql);
        return $datas;
    }
    function showdanhmucadmin(): array
    {
        $sql = "SELECT * FROM category";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    function getonedm($id)
    {
        $sql = "SELECT * FROM category where category_id = $id";
        $data = $this->db->executeQueryOne($sql);
        return $data;
    }
    function getonedetdm($id)
    {
        $sql = "SELECT * FROM category_details where category_details_id = $id";
        $data = $this->db->executeQueryOne($sql);
        return $data;
    }
    function addCategory($categoryName)
    {
        $safeCategoryName = mysqli_real_escape_string($this->db->getConnection(), $categoryName);

        $sql = "INSERT INTO category (name) VALUES ('$safeCategoryName')";

        // Thực thi truy vấn
        if (mysqli_query($this->db->getConnection(), $sql)) {
            return true;
        } else {
            return false;
        }
    }
    function addCategorydetails($category_id, $categoryName)
    {
        $safeCategoryName = mysqli_real_escape_string($this->db->getConnection(), $categoryName);


        $sql = "INSERT INTO category_details (`category_id`,`name`) VALUES ('$category_id','$safeCategoryName')";

        // Thực thi truy vấn
        if (mysqli_query($this->db->getConnection(), $sql)) {
            return true;
        } else {
            return false;
        }
    }
    function showdanhmucchitietadmin()
    {

        $sql = "SELECT * FROM category_details";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    function showdmctadminpage()
    {

        $sql = "SELECT * FROM category_details, category where `category`.`category_id` =`category_details`.`category_id` ";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    function showdanhmucchitiet()
    {
        $sql = "SELECT 
        c.category_id, 
        c.name AS category_name, 
        cd.category_details_id, 
        cd.name AS category_details_name
    FROM 
        category c
    JOIN 
        category_details cd ON c.category_id = cd.category_id;";

        $result = mysqli_query($this->db->getConnection(), $sql);
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
    function showdmctpage($id, $begin): array
    {

        $sql = "SELECT `ct`.`category_details_id`, `c`.`name` as `dmname`, `ct`.`name` 
        FROM category AS c, category_details AS ct 
        WHERE `ct`.`category_id` = `c`.`category_id`";
        if ($id > 0) {
            $sql .= " AND `ct`.`category_id` = $id";
        }
        $sql .= " LIMIT $begin, 9";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    function showdmpage($begin)
    {

        $sql = "SELECT c.category_id, c.name AS dmname, COUNT(cd.category_details_id) AS count_subcategories
        FROM category AS c
        LEFT JOIN category_details AS cd ON c.category_id = cd.category_id
        GROUP BY c.category_id, c.name";
        $sql .= " LIMIT $begin, 9";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    function delcate($id)
    {
        $sql = "DELETE FROM category where category_id = $id";
        if (mysqli_query($this->db->getConnection(), $sql)) {
            return true;
        } else {
            return false;
        }
    }

    function delcatedet($id) {
        $countSql = "SELECT COUNT(*) AS total_products FROM products WHERE category_details_id = $id";
        $result = mysqli_query($this->db->getConnection(), $countSql);
        $row = mysqli_fetch_assoc($result);
    
        if ($row['total_products'] == 0) {
            $sql = "DELETE FROM category_details WHERE category_details_id = $id";
            if (mysqli_query($this->db->getConnection(), $sql)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false; 
        }
    }
    function updatecate($name, $id)
    {
        $sql = "UPDATE category set `name` = '$name' where `category_id`  = $id";
        if (mysqli_query($this->db->getConnection(), $sql)) {
            return true;
        } else {
            return false;
        }
    }
    function updatecatedet($name, $id, $iddet)
    {
        $sql = "UPDATE category_details set `name` = '$name',`category_id`=$id where `category_details_id`  = $iddet";
        if (mysqli_query($this->db->getConnection(), $sql)) {
            return true;
        } else {
            return false;
        }
    }
}



?>