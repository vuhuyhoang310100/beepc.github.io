<?php
function checkuser($email, $pass)
{
    include "../global.php";

    // Sử dụng prepared statement để tránh tấn công SQL injection
    $sql = "SELECT * FROM user WHERE email = ? AND passwd = ? LIMIT 1";
    $stmt = $database->getConnection()->prepare($sql);
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();

    // Lấy kết quả từ prepared statement
    $result = $stmt->get_result();

    // Kiểm tra nếu có dòng dữ liệu được trả về
    if ($result->num_rows > 0) {
        // Lấy dòng dữ liệu đầu tiên
        $row = $result->fetch_assoc();
        return $row['role'];
    } else {
        return null; // Không tìm thấy người dùng
    }
}
// function getuser($email,$pass){


//     // Sử dụng prepared statement để tránh tấn công SQL injection
//     $sql = "SELECT * FROM user WHERE email = '$email' AND passwd = '$pass' LIMIT 1";
//     $stmt = $database->getConnection()->prepare($sql);
//     $stmt->execute();

//     // Lấy kết quả từ prepared statement
//     $result = $stmt->get_result();

//     // Kiểm tra nếu có dòng dữ liệu được trả về
//     if ($result->num_rows > 0) {
//         // Lấy dòng dữ liệu đầu tiên
//         $row = $result->fetch_assoc();
//         return $row;
//     } else {
//         return null; // Không tìm thấy người dùng
//     }
// }




// function validating($phone){
//     if(preg_match('/^[0-9]{10}+$/', $phone)) {
//     $msg = "Số điện thoại hợp lệ";
//     } else {
//     $msg =  " ố điện thoại không hơp lệ";
//     }
//     return $msg;
//     }


class User
{
    private $db;
    function __construct($db)
    {
        $this->db = new Database();
    }
    function showuser($id, $begin)
    {
        $sql = "select * from user where 1";
        $sql .= " LIMIT $begin,9";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }
    function deluser($id)
    {
        $sql = "DELETE FROM user where user_id = $id";
        if (mysqli_query($this->db->getConnection(), $sql)) {
            return true;
        } else {
            return false;
        }
    }
    function countuser()
    {
        $sql = "select * from user where role = 0 ";
        $datas = $this->db->executeQueryAll($sql);
        return $datas;
    }

    function getuser($email, $pass)
    {
        $email = $this->db->getConnection()->real_escape_string($email);
        $pass = $this->db->getConnection()->real_escape_string($pass);

        $sql = "SELECT * FROM user
        WHERE email = '$email'
        AND passwd = '$pass' LIMIT 1";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();

        // Lấy kết quả từ prepared statement
        $result = $stmt->get_result();

        // Kiểm tra nếu có dòng dữ liệu được trả về
        if ($result->num_rows > 0) {
            // Lấy dòng dữ liệu đầu tiên
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null; // Không tìm thấy người dùng
        }

        //test sql injection
        // $sql = "SELECT * FROM user WHERE email = '$email' AND passwd = '$pass' LIMIT 1";


        // $result = $this->db->getConnection()->query($sql);

        // if ($result && $result->num_rows > 0) {

        //     $row = $result->fetch_assoc();
        //     return $row;
        // } else {
        //     return null; // Không tìm thấy người dùng
        // }
    }
    function adduser($username, $pass, $email)
    {


        // Sử dụng prepared statement để tránh tấn công SQL injection
        $sql = "INSERT INTO user(`username`,`passwd`,`email`) VALUES ('" . $username . "','" . $pass . "','" . $email . "')";
        $stmt = $this->db->getConnection()->prepare($sql);
        if ($stmt->execute()) {
            // Thêm người dùng thành công
            $stmt->close();
            $this->db->closeConnection();
            return true;
        } else {
            // Thêm người dùng không thành công

            return false;
        }
    }
    function addandgetlastid($username, $pass, $email,$temp_email)
    {


        // Sử dụng prepared statement để tránh tấn công SQL injection
        $sql = "INSERT INTO user(`username`,`passwd`,`email`,`temp_email`) VALUES ('" . $username . "','" . $pass . "','" . $email . "','".$temp_email."')";
        if (mysqli_query($this->db->getConnection(), $sql)) {
            $last_id = mysqli_insert_id($this->db->getConnection());
            mysqli_close($this->db->getConnection());
            // Trả về ID của bản ghi vừa chèn
            return $last_id;
        } else {
            mysqli_close($this->db->getConnection());
            return null;
        }
    }
    function getuserbyid($id)
    {
        // Sử dụng prepared statement để tránh tấn công SQL injection
        $sql = "SELECT * FROM user WHERE user_id = '$id' LIMIT 1";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();

        // Lấy kết quả từ prepared statement
        $result = $stmt->get_result();

        // Kiểm tra nếu có dòng dữ liệu được trả về
        if ($result->num_rows > 0) {
            // Lấy dòng dữ liệu đầu tiên
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null; // Không tìm thấy người dùng
        }
    }
    function getnameuserbyid($id)
    {
        // Sử dụng prepared statement để tránh tấn công SQL injection
        $sql = "SELECT * FROM user WHERE user_id = '$id' LIMIT 1";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();

        // Lấy kết quả từ prepared statement
        $result = $stmt->get_result();

        // Kiểm tra nếu có dòng dữ liệu được trả về
        if ($result->num_rows > 0) {
            // Lấy dòng dữ liệu đầu tiên
            $row = $result->fetch_assoc();
            return $row['username'];
        } else {
            return null; // Không tìm thấy người dùng
        }
    }
    function getdetailsbyid($id)
    {
        // Sử dụng prepared statement để tránh tấn công SQL injection
        $sql = "SELECT * FROM user_details WHERE user_id = '$id' LIMIT 1";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();

        // Lấy kết quả từ prepared statement
        $result = $stmt->get_result();

        // Kiểm tra nếu có dòng dữ liệu được trả về
        if ($result->num_rows > 0) {
            // Lấy dòng dữ liệu đầu tiên
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null; // Không tìm thấy người dùng
        }
    }
    function getuserdetailsbyid($id)
    {

        // Sử dụng prepared statement để tránh tấn công SQL injection
        $sql = "SELECT * FROM user_details WHERE user_id = '$id' LIMIT 1";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();

        // Lấy kết quả từ prepared statement
        $result = $stmt->get_result();

        // Kiểm tra nếu có dòng dữ liệu được trả về
        return $result;
    }
    function getusernamesbyid($id)
    {

        // Sử dụng prepared statement để tránh tấn công SQL injection
        $sql = "SELECT * FROM user_details WHERE user_id = '$id' LIMIT 1";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();

        // Lấy kết quả từ prepared statement
        $result = $stmt->get_result();

        // Kiểm tra nếu có dòng dữ liệu được trả về
        if ($result->num_rows > 0) {
            // Lấy dòng dữ liệu đầu tiên
            $row = $result->fetch_assoc();
            // Trả về tên người dùng
            return $row['fullname'];
        } else {
            // Trả về null nếu không tìm thấy tên người dùng
            return null;
        }
    }
    function adduserdetails($user_id, $fullname, $sex, $tel, $address)
    {


        // Sử dụng prepared statement để tránh tấn công SQL injection
        $sql = "INSERT INTO user_details(`user_id`,`fullname`,`sex`,`tel`,`address`) VALUES ('" . $user_id . "','" . $fullname . "','" . $sex . "','" . $tel . "','" . $address . "')";
        $stmt = $this->db->getConnection()->prepare($sql);
        if ($stmt->execute()) {
            // Thêm người dùng thành công
            return true;
        } else {
            // Thêm người dùng không thành công
            $stmt->close();
            $this->db->closeConnection();
            return false;
        }
    }
    function update_userdetails($user_id, $fullname, $sex, $tel, $address)
    {
        $sql = "UPDATE user_details SET fullname = '$fullname',sex=' $sex',tel='$tel',address='$address' WHERE user_id=" . $user_id . "";
        $stmt = $this->db->getConnection()->prepare($sql);
        if ($stmt->execute()) {
            // Thêm người dùng thành công

            return true;
        } else {
            // Thêm người dùng không thành công
            $stmt->close();
            $this->db->closeConnection();
            return false;
        }
    }
    function update_username($user_id, $fullname)
    {
        $sql = "UPDATE user SET username = '$fullname' WHERE user_id=" . $user_id . "";
        $stmt = $this->db->getConnection()->prepare($sql);
        if ($stmt->execute()) {
            // Thêm người dùng thành công

            return true;
        } else {
            // Thêm người dùng không thành công
            $stmt->close();
            $this->db->closeConnection();
            return false;
        }
    }
    function update_passwd($passwd, $user_id)
    {
        $sql = "UPDATE user SET passwd = '$passwd' WHERE user_id=" . $user_id . "";
        $stmt = $this->db->getConnection()->prepare($sql);
        if ($stmt->execute()) {
            // Thêm người dùng thành công
            $stmt->close();
            $this->db->closeConnection();
            return true;
        } else {
            // Thêm người dùng không thành công
            $stmt->close();
            $this->db->closeConnection();
            return false;
        }
    }
}
