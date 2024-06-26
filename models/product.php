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
    function countsp()
    {
        $sql = "select * from products";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    function showsp($id = '', $begin)
    {

        $sql = "select * from products";
        if ($id > 0) {
            $sql .= " WHERE category_details_id =" . $id;
        }
        $sql .= " ORDER BY product_id DESC LIMIT $begin,9";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    public function countpro($id = '')
    {
        // Bắt đầu xây dựng truy vấn SQL để đếm số lượng đơn hàng
        $sql = "SELECT COUNT(*) AS total FROM products";

        // Thêm điều kiện nếu có
        if ($id !== '' && $id > 0) {
            $sql .= " WHERE category_details_id = $id";
        }

        // Thực hiện truy vấn và lấy kết quả
        $result = $this->db->executeQueryOne($sql);

        // Kiểm tra kết quả
        if ($result) {
            // Lấy số lượng đơn hàng từ kết quả truy vấn
            $totalOrders = $result['total'];
        } else {
            // Xử lý lỗi nếu có
            // Ví dụ: return false; hoặc throw new Exception("Database error");
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
    function updateproduct($id, $name, $firm, $img, $price, $category_id, $category_details_id, $description)
    {
        if ($img == "") {
            $sql = "UPDATE products 
            set `name` = '$name',`firm`='$firm',`price`=$price,`category_id`=$category_id,
            `category_details_id`=$category_details_id,`description`='$description' 
            where `product_id`  = $id";
        } else {
            $sql = "UPDATE products 
            set `name` = '$name',`firm`='$firm',`price`=$price,`category_id`=$category_id,
            `category_details_id`=$category_details_id,`description`='$description',`img`='$img' 
            where `product_id`  = $id";
        }

        if (mysqli_query($this->db->getConnection(), $sql)) {
            return true;
        } else {
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
