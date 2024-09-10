<?php
class Cart
{
    private $db;
    function __construct($db)
    {
        $this->db = new Database();
    }
    function countcart()
    {
        $sql = "select * from carts";

        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    // function getvoucher($voucherCode)
    // {
    //     $safeVoucherCode = mysqli_real_escape_string($this->db->getConnection(), $voucherCode);
    //     $sql = "SELECT discount_rate FROM discount WHERE code = '$safeVoucherCode'";
    //     $voucher = $this->db->executeQueryOne($sql);

    //     // Kiểm tra xem voucher có tồn tại không
    //     if (!empty($voucher)) {
    //         // Lấy giá trị giảm từ kết quả truy vấn
    //         return $voucher['discount_rate'];
    //     } else {

    //         return null;
    //     }
    // }
    function thongke($start, $current)
    {
        $sql = "SELECT COUNT(cart_id) as soluong, SUM(total) as tong, date(cart_date) as mname, cart_status 
        FROM carts 
        WHERE cart_status = 3 AND cart_date BETWEEN '$start' AND '$current' 
        GROUP BY mname";
        $result = $this->db->executeQueryAll($sql);
        if (!empty($result)) {
            return $result;
        } else {

            return null;
        }
    }
    function getinfovoucher($voucherCode)
    {
        $safeVoucherCode = mysqli_real_escape_string($this->db->getConnection(), $voucherCode);
        $sql = "SELECT * FROM discount WHERE code = '$safeVoucherCode'";
        $voucher = $this->db->executeQueryOne($sql);

        if (!empty($voucher)) {
            return $voucher;
        } else {

            return null;
        }
    }
    function showevent()
    {
        $sql = "SELECT * FROM discount order by discount_id desc limit 6";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    function get_imgevent_byid($id)
    {
        $sql = "SELECT * FROM discount WHERE discount_id = $id";
        $data = $this->db->executeQueryOne($sql);
        return $data['img'];
    }
    function showevent_admin($begin)
    {
        $sql = "SELECT * FROM discount where 1";
        $sql .= " order by discount_id desc";
        $sql .= " LIMIT $begin,9";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    function delevent($id)
    {
        $sql = "DELETE FROM discount where discount_id = $id";
        if (mysqli_query($this->db->getConnection(), $sql)) {
            return true;
        } else {
            return false;
        }
    }
    function addevent($code, $name, $img, $content, $discount_rate, $start, $end)
    {
        $sql = "INSERT INTO discount(`code`,`name`,`img`,`content`,`discount_rate`,`start`,`end`) VALUES ('" . $code . "','" . $name . "','" . $img . "','" . $content . "','" .  $discount_rate . "','" . $start . "','" . $end . "')";
        $stmt = $this->db->getConnection()->prepare($sql);
        if ($stmt->execute()) {
            return true;
        } else {
            $stmt->close();
            $this->db->closeConnection();
            return false;
        }
    }
    function showeventdetails($id)
    {
        $sql = "SELECT * FROM discount where discount_id = " . $id . "";
        $datas = $this->db->executeQueryOne($sql);
        return $datas;
    }
    function updatepay_status($id, $status)
    {
        $sql = "UPDATE carts set `pay_status` = '$status' where `cart_id`  = $id";
        if (mysqli_query($this->db->getConnection(), $sql)) {
            return true;
        } else {
            return false;
        }
    }
    function updatecart_status($id, $status)
    {
        $sql = "UPDATE carts set `cart_status` = '$status' where `cart_id`  = $id";
        if (mysqli_query($this->db->getConnection(), $sql)) {
            return true;
        } else {
            return false;
        }
    }
    function showcart($id, $begin, $tttt, $ttdh)
    {

        $sql = "SELECT * FROM carts";
        // Add conditions based on input parameters
        if ($tttt != '' && $ttdh != '') {
            // Add conditions for pay_status and cart_status
            $sql .= " WHERE pay_status = $tttt AND cart_status = $ttdh";
        }
        // Add pagination limit
        $sql .= " ORDER BY cart_id DESC LIMIT $begin, 9";
        // Execute query
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    public function countOrders($tttt = '', $ttdh = '')
    {
        // Bắt đầu xây dựng truy vấn SQL để đếm số lượng đơn hàng
        $sql = "SELECT COUNT(*) AS total FROM carts";

        // Thêm điều kiện nếu có
        if ($tttt !== '' && $ttdh !== '') {
            $sql .= " WHERE pay_status = '$tttt' AND cart_status = '$ttdh'";
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
    function show_order($code)
    {
        $sql = "select * from carts where code_cart like '%" . $code . "%' ORDER BY cart_id DESC";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    function showcart_details($idcart, $begin): array
    {
        $sql = "SELECT * FROM cart_details where cart_id = $idcart";
        $sql .= " LIMIT $begin,9";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    function printcart_details($id): array
    {
        $sql = "SELECT * FROM cart_details where cart_id = $id";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }


    function showcart_byiduser($id_user, $begin)
    {
        $sql = "SELECT * FROM carts where 1";
        if ($id_user > 0)
            $sql .= " AND user_id =" . $id_user;
        $sql .= " order by cart_id desc";
        $sql .= " LIMIT $begin,9";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    function showcart_method($codecart)
    {
        $sql = "SELECT * FROM carts where code_cart = $codecart";
        $datas = $this->db->executeQueryOne($sql);
        return $datas['pay_method'];
    }
    function insertcart($codecart, $userid, $fullname, $address, $email, $tel, $total, $paymethod)
    {
        $sql = "INSERT INTO carts(`code_cart`,`user_id`,`fullname`,`address`,`email`,`telephone`,`total`,`pay_method`) VALUES ('" . $codecart . "','" . $userid . "','" . $fullname . "','" . $address . "','" . $email . "','" . $tel . "','" . $total . "','" . $paymethod . "')";
        if (mysqli_query($this->db->getConnection(), $sql)) {
            $last_id = mysqli_insert_id($this->db->getConnection());
            // Trả về ID của bản ghi vừa chèn
            return $last_id;
        } else {
            mysqli_close($this->db->getConnection());
            return null;
        }
    }
    function insertcart_details($cart_id, $product_id, $name, $count, $total)
    {
        $sql = "INSERT INTO cart_details(`cart_id`,`product_id`,`name`,`quantity`,`price`) VALUES ('" . $cart_id . "','" . $product_id . "','" . $name . "','" . $count . "','" .  $total . "')";
        $stmt = $this->db->getConnection()->prepare($sql);
        if ($stmt->execute()) {
            return true;
        } else {
            $stmt->close();
            $this->db->closeConnection();
            return false;
        }
    }
}
