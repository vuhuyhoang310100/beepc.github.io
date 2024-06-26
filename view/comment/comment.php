<?php
ob_start();
session_start();
include "../../config/db.php";
include "../../global.php";
include "../../models/comment.php";
include "../../models/user.php";

$comments = new Comment($conn);
$user = new User($conn);
$id = $_REQUEST['product_id'];
$load_comments = $comments->loadall_comment($id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/asset/css/fontawesome.min.css" />
    <link rel="stylesheet" href="../../public/asset/css/bootstrap.min.css" />
</head>

<body>
    <style>
        .form-color {

            background-color: #fafafa;
        }

        .form-control {

            height: 48px;

        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #35b69f;
            outline: 0;
            box-shadow: none;
            text-indent: 10px;
        }

        .comment-text {
            font-size: 16px;
        }

        .user-feed {
            font-size: 14px;
            margin-top: 12px;
        }

        .smalltext {
            font-size: 13px;
        }
    </style>
    <div class="container mt-2 mb-5">

        <div class="row height d-flex align-items-center">

            <div class="col-sm-12">

                <div class="p-3">
                    <h3>Bình luận</h3>
                    <div class="mb-3 mt-3 comment-form">
                        <?php if (isset($_SESSION['id_user']) && $_SESSION['id_user'] > 0) { ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <label for="comment">Comments:</label>
                                <textarea class="form-control" rows="15" id="comment" name="comment"></textarea>
                                <input type="hidden" name="product_id" value="<?= $id ?>">
                                <button type="submit" class="btn btn-primary mt-3" name="addcmt" value="1">Đăng bình
                                    luận</button>
                            </form>
                        <?php } else {
                        ?>
                            <label for="comment">Comments:</label>
                            <textarea class="form-control" disabled rows="5" id="comment" name="comment"></textarea>
                            <a href="../../auth/login.php" target="_parent" class="btn btn-primary mt-3" name="login" value="1">Đăng
                                nhập</button>
                            </a>
                        <?php
                        } ?>

                    </div>
                    <!-- Form load bình luận -->
                    <?php
                    foreach ($load_comments as $comment) {
                        $username = $user->getnameuserbyid($comment['user_id']);
                        if ($username != "") {
                            $name = $username;
                        } else {
                            $name = "Bee - customer";
                        }

                        echo ' <div class="mb-3 p-3 card">
                        <div class="d-flex flex-column">
                        <div class="d-flex"> <div class="ms-3 b-highlight"> <img src="../../public/asset/img/user-png.png" height="40px"
                                    width="40px" alt=""></div>
                                    <span class="ms-2 mt-2 mr-2">' . $name . '</span></div>
                           
                            <div class="w-100 ms-3">
                          
                                <span class="mr-2 smalltext"><small><em>' . date("d/m/Y H:i:s", strtotime($comment['create_at'])) . '</em></small></span>
                                <p class="text-justify comment-text mb-0">Nội dung: ' . $comment['comment'] . '</p>
                            </div>
                        </div>
                    </div>';
                    }

                    ?>
                    <!-- end form -->

                    <?php

                    if (isset($_POST['addcmt']) && $_POST['addcmt'] == 1) {
                        $content = $_POST['comment'];
                        $product_id = $_POST['product_id'];
                        $user_id = $_SESSION['id_user'];
                        $comments->insert_comment($user_id, $product_id, $content);
                        header("Location: " . $_SERVER['HTTP_REFERER']);
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>