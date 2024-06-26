<?php
class Rating
{
    private $db;
    function __construct($db)
    {
        $this->db = new Database();
    }
    function insert_rating($product_id, $user_id, $rating)
    {
        $sql = "INSERT INTO rating (product_id, user_id, rating) VALUES ($product_id, $user_id, $rating)";
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
