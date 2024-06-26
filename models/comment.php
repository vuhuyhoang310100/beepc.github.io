<?php
class Comment
{
    private $db;
    function __construct($db)
    {
        $this->db = new Database();
    }
    function loadall_comment($id): array
    {
        $safeid = mysqli_real_escape_string($this->db->getConnection(), $id);
        $sql = "SELECT * FROM reviews WHERE product_id = $safeid order by review_id desc";
        $result = $this->db->executeQueryAll($sql);
        return $result;
    }
    function insert_comment($userid, $productid, $comment)
    {
          $conn = $this->db->getConnection();
        $escaped_comment = mysqli_real_escape_string($conn, $comment);
        $sql = "INSERT INTO reviews (`user_id`,`product_id`,`comment`) VALUES ($userid,$productid,'$escaped_comment')";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {

            return false;
        }
    }
     function showcomment_admin($begin)
    {
        $sql = "SELECT * FROM reviews where 1";
        $sql .= " order by review_id desc";
        $sql .= " LIMIT $begin,9";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    function delcmt($id)
    {
        $sql = "DELETE FROM reviews where review_id = $id";
        if (mysqli_query($this->db->getConnection(), $sql)) {
            return true;
        } else {
            return false;
        }
    }
}