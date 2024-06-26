<?php
session_start();
ob_start();
include "../config/db.php";
include "../models/user.php";
include "../global.php";
$user = new User($conn);
if (isset($_POST['login']) && $_POST['login']) {
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $result = $user->getuser($email, $pass);
    if ($result) {
        $_SESSION['id_user'] = $result['user_id'];
        $role = $result['role'];
        $username = $result['username'];

        if ($role == 1) {
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $username;
            header("Location: ../admin/index.php");
            exit();
        } else {
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $username;
            header("Location: ../index.php");
            exit();
        }
    } else {
        $alert = "Email hoặc mật khẩu không đúng!!!";
    }
}

// if (basename($_SERVER['PHP_SELF']) != 'login.php') {
//     if (!isset($_POST['login'])) {
//     // Kiểm tra xem session showAlert đã được thiết lập và có giá trị true hay không
//     if (isset($_SESSION['showAlert']) && $_SESSION['showAlert'] == true) {
//         // Hiển thị thông báo
//         echo "<div class='message' id='alertMessage'>Bạn không có quyền truy cập trang này !!!</div>";
//         // Xóa session để tránh hiển thị thông báo lần tiếp theo
//         unset($_SESSION['showAlert']);
//     }
// }

?>
<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<style>
    .message {
        padding: 10px;
        background-color: #f44336;
        color: white;
        margin-bottom: 15px;
    }
</style>

<body>


    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="../public/asset/img/privacy-banner-full.png_103014959.png" class="img-fluid" alt="Phone image" height="300px" width="600px">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-3 mt-3">Đăng nhập </p>
                        <!-- Email input -->
                        <div class="form-outline mb-1">
                            <label class="form-label" for="form1Example13"> <i class="bi bi-person-circle"></i>
                                Tài khoản</label>
                            <input type="email" id="form1Example13" class="form-control form-control-lg py-3" name="email" autocomplete="off" placeholder="Nhập email..." style="border-radius:25px ;" />
                            <span class="alert mt-0" style="color: red;"><?php if (isset($alert)) echo $alert; ?>
                            </span>
                        </div>
                        <!-- Password input -->
                        <div class="form-outline mb-4 mt-0">
                            <label class="form-label" for="form1Example23"><i class="bi bi-chat-left-dots-fill"></i>
                                Mật khẩu</label>
                            <input type="password" id="form1Example23" class="form-control form-control-lg py-3" name="password" autocomplete="off" placeholder="Nhập mật khẩu..." style="border-radius:25px ;" />
                        </div>
                        <!-- Submit button -->
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <input type="submit" value="Sign in" name="login" class="btn btn-warning btn-lg text-light my-2 py-3" style="width:100% ; border-radius: 30px; font-weight:600;" />
                        </div>

                    </form><br>
                    <p align="center">Tôi chưa có tài khoản <a href="register.php" class="text-danger" style="font-weight:600;text-decoration:none;">Đăng ký</a></p>
                </div>
            </div>
        </div>
    </section>


    <?php
    if (isset($_SESSION['stt']) && $_SESSION['stt'] != '') {
    ?>
        <script>
            swal({
                title: '<?php echo $_SESSION['stt'] ?>',
                icon: "success",
            });
        </script>
    <?php
        unset($_SESSION['stt']);
    }
    ?>


    <script>
        // Hàm để ẩn thông báo
        function hideAlert() {
            document.getElementById('alertMessage').style.display = 'none';
        }
        // Thực hiện ẩn thông báo sau 3.5 giây
        setTimeout(hideAlert, 3500); // 
    </script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

</body>

</html>