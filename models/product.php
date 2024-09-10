<?php

// function showsp($id,$begin){

//     $sql = "select * from products where 1";
//     if ($id > 0){
//         $sql.= " AND category_details_id=".$id;
//     }
//     $sql.= " LIMIT $begin,9";
//     $datas=$conn->executeQueryAll($sql);
//    return $datas;
// }
class SanPham
{
    private $db;
    function __construct($db)
    {
        $this->db = new Database();
    }
    public function countsp($categoryId = '', $categoryDetailsId = '')
    {
        $sql = "SELECT COUNT(*) as total FROM products";
    
        $conditions = [];
    
        if ($categoryId !== '') {
            $categoryId = intval($categoryId); 
            $conditions[] = "category_id = $categoryId";
        }
    
        if ($categoryDetailsId !== '') {
            $categoryDetailsId = intval($categoryDetailsId); 
            $conditions[] = "category_details_id = $categoryDetailsId";
        }
    
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }
    
        $result = $this->db->executeQueryOne($sql);
        return $result['total'];
    }
    
    public function showsp($begin, $itemsPerPage = 9, $categoryId = '', $categoryDetailsId = '')
    {
        $sql = "SELECT * FROM products";
    
        $conditions = [];
    
        if ($categoryId !== '') {
            $categoryId = intval($categoryId);
            $conditions[] = "category_id = $categoryId";
        }
    
        if ($categoryDetailsId !== '') {
            $categoryDetailsId = intval($categoryDetailsId);
            $conditions[] = "category_details_id = $categoryDetailsId";
        }
    
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }
    
        $sql .= " ORDER BY product_id DESC LIMIT $begin, $itemsPerPage";
    
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    
    public function countpro($id = '')
    {
        $sql = "SELECT COUNT(*) AS total FROM products";

        if ($id !== '' && $id > 0) {
            $sql .= " WHERE category_details_id = $id";
        }

        $result = $this->db->executeQueryOne($sql);

        // Kiểm tra kết quả
        if ($result) {
            $totalOrders = $result['total'];
        } else {
            $totalOrders = 0; // Trả về số lượng là 0 nếu có lỗi
        }

        return $totalOrders;
    }
    function showspct($id)
    {
        $sql = "select * from products where 1";
        if ($id > 0) {
            $sql .= " AND product_id =" . $id;
        }
        $data = $this->db->executeQueryOne($sql);
        return $data;
    }
    function addsp($name, $img,  $firm, $category_id, $category_details_id, $price, $description)
    {
        $sql = "INSERT INTO products (`name`,`img`,`firm`,`category_id`,`category_details_id`,`price`,`description`) values ('$name','$img','$firm','$category_id','$category_details_id','$price','$description')";
        $stmt = $this->db->getConnection()->prepare($sql);
        if ($stmt->execute()) {
            return true;
        } else {
            $stmt->close();
            $this->db->closeConnection();
            return false;
        }
    }
    function updateproduct($id, $name, $firm, $img, $price, $description, $category_id = null, $category_details_id = null)
    {
        $conn = $this->db->getConnection();
    
        $id = mysqli_real_escape_string($conn, $id);
        $name = mysqli_real_escape_string($conn, $name);
        $firm = mysqli_real_escape_string($conn, $firm);
        $img = mysqli_real_escape_string($conn, $img);
        $price = mysqli_real_escape_string($conn, $price);
        $description = mysqli_real_escape_string($conn, $description);
        
        $query = "SELECT category_id, category_details_id FROM products WHERE product_id = '$id'";
        $result = mysqli_query($conn, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
    
            $current_category_id = (isset($category_id) && $category_id !== '') ? intval($category_id) : $row['category_id'];
            $current_category_details_id = (isset($category_details_id) && $category_details_id !== '') ? intval($category_details_id) : $row['category_details_id'];
    
            $sql = "UPDATE products SET 
                        `name` = '$name', 
                        `firm` = '$firm', 
                        `price` = '$price', 
                        `category_id` = '$current_category_id',
                        `category_details_id` = '$current_category_details_id', 
                        `description` = '$description'";
    
            if ($img !== "") {
                $sql .= ", `img` = '$img'";
            }
    
            $sql .= " WHERE `product_id` = '$id'";
    
            if (mysqli_query($conn, $sql)) {
                return true;
            } else {
                error_log("SQL Error: " . mysqli_error($conn));
                return false;
            }
        } else {
            error_log("SQL Error: " . mysqli_error($conn));
            return false;
        }
    }
    function delproduct($id)
    {
        $sql = "DELETE FROM products where product_id = $id";
        if (mysqli_query($this->db->getConnection(), $sql)) {
            return true;
        } else {
            return false;
        }
    }
    function get_img_byid($id)
    {
        $sql = "SELECT * FROM products WHERE product_id = $id";
        $data = $this->db->executeQueryOne($sql);
        if (!empty($data))
            return $data['img'];
    }
    function countreview($id)
    {
        $sql = "select count(*) as count from reviews where 1";
        if ($id > 0) {
            $sql .= " AND product_id =" . $id;
        }
        $data = $this->db->executeQueryAll($sql);
        return $data;
    }
    function new_product()
    {
        $sql = "SELECT * FROM products";
        $sql .= " ORDER BY product_id DESC";
        $sql .= " LIMIT 6";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    function get_name_byid($id)
    {
        $sql = "SELECT * FROM products WHERE product_id = $id";
        $data = $this->db->executeQueryOne($sql);
        return $data['name'];
    }
    function get_price_byid($id)
    {
        $sql = "SELECT * FROM products WHERE product_id = $id";
        $data = $this->db->executeQueryOne($sql);
        return $data['price'];
    }
    function bestseller_product()
    {
        $sql = "SELECT `cart_details`.product_id,`products`.`name`,`products`.`img`,`products`.`firm`,`products`.`price`,`products`.`description`,SUM(`cart_details`.`quantity`) AS total_quantity_sold
        FROM cart_details, products
        WHERE `cart_details`.`product_id`=`products`.`product_id`
        GROUP BY product_id
        ORDER BY total_quantity_sold DESC
        LIMIT 3";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
}
