<?php

class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "123456";
    private $db = "app";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function getConnection()
    {
        return $this->conn;
    }

    public function executeQueryAll($query): array
    {
        $result = $this->conn->query($query);
        $rows = array();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    public function executeQueryOne($query)
    {
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }
    function execute($sql)
    {
        $result = mysqli_query($this->conn, $sql);

        if ($result === false) {
            echo "Error: " . mysqli_error($this->conn);
            return false;
        }

        return true;
    }


    public function closeConnection()
    {
        $this->conn->close();
    }
}
