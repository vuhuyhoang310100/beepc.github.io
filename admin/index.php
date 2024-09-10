<?php
session_start();
ob_start();
include "../config/db.php";
include "../global.php";
include "../models/user.php";
include "../models/category.php";
include "../models/product.php";
include "../models/comment.php";
include "../models/cart.php";
include "func/switch.php";
include "sidebar.php";

?>



<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <link rel="stylesheet" href="../admin/assets/css/admin.css" />


</head>

<body>
    <?php
    if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
        $_SESSION['showAlert'] = true;
        header("Location: ../auth/login.php");
        exit; 
    } else {
        $danhmuc = new DanhMuc($conn);
        $product = new SanPham($conn);
        $cart = new Cart($conn);
        $user = new User($conn);
        $comment = new Comment($conn);
    }
    ?>
    <?php
    if ((isset($_GET['admin'])) && ($_GET['admin'] != "")) {
        $act = $_GET['admin'];

        switch ($act) {

            case 'category':
                $danhmuc_data = $danhmuc->showdanhmucadmin();
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                if ($page == '' || $page == 1) {
                    $begin = 0;
                } else {
                    $begin = ($page * 9) - 9;
                }
                $danhmuc_datapage = $danhmuc->showdmpage($begin);
                include "view/category.php";
                break;
            case 'categorydetails':

                $categories_details = $danhmuc->showdmctadminpage();
                $danhmuc_data = $danhmuc->showdanhmucadmin();

                if (isset($_GET['idproduct'])) {
                    $id = $_GET['idproduct'];
                } else {
                    $id = 0;
                }
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                if ($page == '' || $page == 1) {
                    $begin = 0;
                } else {
                    $begin = ($page * 9) - 9;
                }

                $danhmucpage = $danhmuc->showdmctpage($id, $begin);


                include "view/categorydetails.php";
                break;
            case 'addcate':
                if (isset($_POST['addcate'])) {
                    $name = $_POST['name'];
                    $add = $danhmuc->addCategory($name);
                    if ($add) {
                        $_SESSION['stt'] = "Thêm thành công !!!";
                    } else {
                        $_SESSION['stt'] = "Thêm không thành công !!!";
                    }
                    header("Location: index.php?admin=category&message=" . urlencode($_SESSION['stt']));
                }
                break;
            case 'addproduct':
                if (isset($_POST['addproduct'])) {
                    $name = $_POST['name'];
                    $firm = $_POST['firm'];
                    $category_id = $_POST['category'];
                    $category_details_id = $_POST['category_details'];
                    $price = $_POST['price'];
                    $description = str_replace(array("\n", "\r", "\r\n", "\s"), '', $_POST['description']);
                    
                    $img = null; 
                    if (isset($_FILES["img"]) && $_FILES["img"]["error"] == UPLOAD_ERR_OK) {
                        $target_file = basename($_FILES["img"]["name"]);
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $uploadOk = 1;
            
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                            $uploadOk = 0;
                            $_SESSION['stt'] = "Chỉ được upload các file jpg, png, jpeg, gif";
                        }
            
                        if ($uploadOk == 1) {
                            if (move_uploaded_file($_FILES["img"]["tmp_name"], ADMIN_PATH . $target_file)) {
                                $img = $target_file; 
                            } else {
                                $_SESSION['stt'] = "Tải hình ảnh lên không thành công";
                            }
                        } else {
                            $_SESSION['stt'] = "Loại tệp không hợp lệ";
                        }
                    }
            
                    if ($product->addsp($name, $img, $firm, $category_id, $category_details_id, $price, $description)) {
                        $_SESSION['stt'] = "Thêm thành công !!!";
                        $_SESSION['icon'] = "success";

                    } else {
                        $_SESSION['stt'] = "Thêm không thành công !!!";
                        $_SESSION['icon'] = "error";

                    }
                }
                $categories_details = $danhmuc->showdanhmucadmin();

               
                $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                $itemsPerPage = 9;
                $count = $product->countsp();
                $begin = ($page == 1) ? 0 : ($page - 1) * $itemsPerPage;

                $trang = ceil($count / $itemsPerPage);
                $products = $product->showsp($begin, $itemsPerPage);
                include "view/product.php";
                break;
            case 'addcatedetails':
                if (isset($_POST['addcatedetails'])) {
                    $name = $_POST['name'];
                    $id = $_POST['select'];
                    $add = $danhmuc->addCategorydetails($id, $name);
                    if ($add) {
                        $_SESSION['stt'] = "Thêm thành công !!!";
                    } else {
                        $_SESSION['stt'] = "Thêm không thành công !!!";
                    }
                    header("Location: index.php?admin=categorydetails&message=" . urlencode($_SESSION['stt']));
                }
                break;
            case 'delcate': {
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $result = $danhmuc->getonedm($id);

                        if ($danhmuc->count_catedet($id)['Count(*)'] == 0) {
                            if ($result === null || empty($result)) {
                                $_SESSION['stt'] = "Danh mục không tồn tại !!!";
                                $_SESSION['icon'] = "info";
                            } else {
                                $del = $danhmuc->delcate($id);
                                $_SESSION['stt'] = "Xóa thành công !!!";
                                $_SESSION['icon'] = "success";
                            }


                        } else {
                            $_SESSION['stt'] = "Xóa không thành công !!!";
                            $_SESSION['icon'] = "error";
                        }
                    }
                    $danhmuc_data = $danhmuc->showdanhmucadmin();
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    if ($page == '' || $page == 1) {
                        $begin = 0;
                    } else {
                        $begin = ($page * 9) - 9;
                    }
                    $danhmuc_datapage = $danhmuc->showdmpage($begin);
                    include "view/category.php";
                    break;
                }
            case 'delcatedet': {
                    if (isset($_GET['iddet'])) {
                        $id = $_GET['iddet'];
                       $result = $danhmuc->getonedetdm($id);
                        if($result === null || empty($result)){
                                $_SESSION['stt'] = "Danh mục không tồn tại !!!";
                                $_SESSION['icon'] = "info";
                        }
                        else{
                            if ($danhmuc->delcatedet($id)) {
                        
                    
                                $_SESSION['stt'] = "Xóa thành công !!!";
                                $_SESSION['icon'] = "success";
                                }
                        else
                            {
                                    $_SESSION['stt'] = "Không thể xóa danh mục chi tiết này !!!";
                                    $_SESSION['icon'] = "error";
                                }
                            }
                        }
                   
                $categories_details = $danhmuc->showdmctadminpage();
                $danhmuc_data = $danhmuc->showdanhmucadmin();
                if (isset($_GET['idproduct'])) {
                    $id = $_GET['idproduct'];
                } else {
                    $id = 0;
                }
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                if ($page == '' || $page == 1) {
                    $begin = 0;
                } else {
                    $begin = ($page * 9) - 9;
                }

                $danhmucpage = $danhmuc->showdmctpage($id, $begin);


                include "view/categorydetails.php"; 
                    break;
                }
            case 'updatecate': {
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $result = $danhmuc->getonedm($id);
                    }
                    if (isset($_POST['id'])) {
                        $id = $_POST['id'];
                        $name = $_POST['newname'];
                        if ($result = $danhmuc->updatecate($name, $id)) {
                            $_SESSION['sttupdate'] = "Cập nhật thành công !!!";
                        } else {
                            $_SESSION['sttupdate'] = "Cập nhật không thành công !!!";
                        };
                    }

                    $danhmuc_data = $danhmuc->showdanhmucadmin();
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    if ($page == '' || $page == 1) {
                        $begin = 0;
                    } else {
                        $begin = ($page * 9) - 9;
                    }
                    $danhmuc_datapage = $danhmuc->showdmpage($begin);
                    include "view/updatecate.php";
                    break;
                }
            case 'updatecatedet': {
                    if (isset($_GET['iddet'])) {
                        $id = $_GET['iddet'];
                        $result = $danhmuc->getonedetdm($id);
                    }
                    if (isset($_POST['id'])) {
                        $iddet = $_POST['iddet'];
                        $name = $_POST['newname'];
                        $id = $_POST['select'];
                        if ($result = $danhmuc->updatecatedet($name, $id, $iddet)) {
                            $_SESSION['sttupdate'] = "Cập nhật thành công !!!";
                        } else {
                            $_SESSION['sttupdate'] = "Cập nhật không thành công !!!";
                        };
                    }
                    $danhmuc_data = $danhmuc->showdanhmucadmin();
                    $danhmucct_data = $danhmuc->showdmctadminpage();

                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                    } else {
                        $id = 0;
                    }
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    if ($page == '' || $page == 1) {
                        $begin = 0;
                    } else {
                        $begin = ($page * 9) - 9;
                    }

                    $danhmucpage = $danhmuc->showdmctpage($id, $begin);
                    include "view/updatecatedet.php";
                    break;
                }
            case 'updateproduct': {
                    if (isset($_GET['idproduct']) && $_GET['idproduct'] >= 0) {
                        $idsanpham = $_GET['idproduct'];
                        $sanpham = $product->showspct($idsanpham);
                    }
                    if (isset($_POST['updateproduct']) && ($_POST['updateproduct'])) {
                        $idsanpham = $_POST['product_id'];
                        $name = $_POST['name'];
                        $firm = $_POST['firm'];
                        $price = $_POST['price'];
                        $category = $_POST['category'];
                        $category_details = $_POST['category_details'];
                        $description = str_replace(array("\n", "\r", "\r\n", "\s",), '', $_POST['description']);
                        if ($_FILES['img']['name'] != "") {
                            $target_file = basename($_FILES["img"]["name"]);
                            $img = $target_file;
                            $uploadOk = 1;
                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                            if (
                                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                                && $imageFileType != "gif"
                            ) {
                                // echo "Chỉ được upload các file jpg,png,jpeg,gif";
                                $uploadOk = 0;
                            }

                            if ($uploadOk == 1) {
                                $oldimg = ADMIN_PATH . $product->get_img_byid($idsanpham);
                                if (file_exists($oldimg)) {
                                    unlink($oldimg);
                                }
                                move_uploaded_file($_FILES["img"]["tmp_name"],  ADMIN_PATH . $target_file);
                                // $product->addsp($name, $_FILES["img"]["name"], $firm, $category_id, $category_details_id, $price, $description);
                            }
                        } else {
                            $img = "";
                        }
                        if ($update = $product->updateproduct($idsanpham, $name, $firm, $img, $price,$description,$category, $category_details)) {
                            $_SESSION['sttupdate'] = "Cập nhật thành công !!!";
                        } else {
                            $_SESSION['sttupdate'] = "Cập nhật không thành công !!!";
                        };
                    }
                    $categories_details = $danhmuc->showdanhmucadmin();
                    if (isset($_GET['cart_det_id'])) {
                        $id = $_GET['cart_det_id'];
                    } else {
                        $id = 0;
                    }       
                    $itemsPerPage = 9;
                    $count = $product->countsp();
                    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                            
                            $begin = ($page == 1) ? 0 : ($page - 1) * $itemsPerPage;
    
                            $trang = ceil($count / $itemsPerPage);
                            $products = $product->showsp($begin, $itemsPerPage);
    
                    include "view/updateproduct.php";
                    break;
                }
            case 'delproduct': {
                    if (isset($_GET['idproduct'])) {
                        $id = $_GET['idproduct'];
                        $imgname = ADMIN_PATH . $product->get_img_byid($id);
                        if (file_exists($imgname)) {
                            unlink($imgname);
                        }
                        if ($product->delproduct($id)) {
                            header("Location: index.php?admin=product");
                        } else {
                            header("Location: index.php?admin=product");
                        }
                    }

                    break;
                }

            case 'product':
                $dmct = $danhmuc->showdanhmucchitietadmin();
                $categories_details = $danhmuc->showdanhmucadmin();

                if (isset($_POST['idcate'])) {
                    $idcate = $_POST['idcate'];
                    $categoryDetails = $danhmuc->get_idcate_by_catedetid($idcate);
                    // Nếu danh sách danh mục chi tiết không rỗng
                    if (!empty($categoryDetails)) {
                        $options = '';
                        foreach ($categoryDetails as $detail) {
                            $options .= '<option value="' . $detail['category_details_id'] . '">' . $detail['name'] . '</option>';
                        }
                        // Trả về dữ liệu dưới dạng HTML
                        echo $options;
                    } else {
                        echo '<option value="">Không có danh mục chi tiết</option>';
                    }
                }
                $categoryId = isset($_GET['category']) ? intval($_GET['category']) : '';
                $categoryDetailsId = isset($_GET['category_details']) ? intval($_GET['category_details']) : '';                
                $itemsPerPage = 9;
                $count = $product->countsp($categoryId,$categoryDetailsId);
                $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                        
                        $begin = ($page == 1) ? 0 : ($page - 1) * $itemsPerPage;

                        $trang = ceil($count / $itemsPerPage);
                        $products = $product->showsp($begin, $itemsPerPage, $categoryId, $categoryDetailsId);


                include "view/product.php";
                break;
            case 'exit': {
                    unset($_SESSION['id_user']);
                    unset($_SESSION['role']);
                    unset($_SESSION['username']);
                    unset($_SESSION['pass']);
                    $_SESSION['logout'] = 1;
                    header("Location: ../index.php");
                    break;
                }
            case 'order':
                $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

                $begin = ($page > 1) ? ($page - 1) * 9 : 0;

                $tttt = isset($_GET['tttt']) ? $_GET['tttt'] : (isset($_POST['tttt']) ? $_POST['tttt'] : '');
                $ttdh = isset($_GET['ttdh']) ? $_GET['ttdh'] : (isset($_POST['ttdh']) ? $_POST['ttdh'] : '');

                if (isset($_POST['post'])) {
                    // Xử lý dữ liệu biểu mẫu POST một cách an toàn
                    if ($tttt == '-- Chọn trạng thái thanh toán --' || $ttdh == '-- Chọn trạng thái đơn hàng --') {
                        // Hiển thị thông báo lỗi và ngăn tiếp tục thực hiện truy vấn
                        echo "<script>alert('Vui lòng chọn bộ lọc trước khi submit !!');</script>";
                        $order = $cart->showcart($id, $begin, '', '');
                        $count = $cart->countOrders();
                    } else {
                        $order = $cart->showcart($id, $begin, $tttt, $ttdh);
                        $count = $cart->countOrders($tttt, $ttdh);
                    }
                } else {
                    $order = $cart->showcart($id, $begin, $tttt, $ttdh);
                    $count = $cart->countOrders($tttt, $ttdh);
                }

                $totalpages = ceil($count / 9);

                // Nếu trang hiện tại lớn hơn tổng số trang, chuyển về trang cuối cùng
                if ($page > $totalpages && $totalpages > 0) {
                    header("Location: index.php?admin=order&page=$totalpages&tttt=$tttt&ttdh=$ttdh");
                    exit;
                }
                //Cập nhật trạng thái đơn hàng
                if (isset($_GET['id']) && isset($_GET['status'])) {
                    $id = $_GET['id'];
                    $status = $_GET['status'];

                    if ($cart->updatepay_status($id, $status)) {
                        header("Location: index.php?admin=order");
                    };
                }


                if (isset($_GET['idcart']) && isset($_GET['stt'])) {
                    $id = $_GET['idcart'];
                    $status = $_GET['stt'];
                    if ($cart->updatecart_status($id, $status)) {
                        header("Location: index.php?admin=order");
                    };
                }
                include "view/order.php";
                break;
            case 'orderdetails':
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                } else {
                    $id = 0;
                }
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                if ($page == '' || $page == 1) {
                    $begin = 0;
                } else {
                    $begin = ($page * 9) - 9;
                }
                $order_details = $cart->showcart_details($id, $begin);
                include "view/orderdetails.php";
                break;
            case 'user':
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                } else {
                    $id = 0;
                }
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                if ($page == '' || $page == 1) {
                    $begin = 0;
                } else {
                    $begin = ($page * 9) - 9;
                }
                $listuser = $user->showuser($id, $begin);
                include "view/user.php";
                break;
            case 'deluser':
                if (isset($_GET['iduser']) && $_GET['iduser'] != 1) {
                    $id = $_GET['iduser'];
                    if ($user->deluser($id)) {
                        header("Location: index.php?admin=user");
                    } else {
                        header("Location: index.php?admin=user");
                        echo '<script>alert("Xoá không thành công do người dùng đã có đơn hàng !");</script>';
                    }
                } else {
                    echo '<script>alert("Xoá không thành công !");</script>';
                }

                break;
            case 'userdetails':
                if (isset($_GET['id']) && $_GET['id'] != 1) {
                    $id = $_GET['id'];
                    $userdetails = $user->getdetailsbyid($id);
                } else {
                    echo '<script>alert("User không tồn tại !!");</script>';
                }

                include "view/userdetails.php";
                break;
            case 'event':
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                if ($page == '' || $page == 1) {
                    $begin = 0;
                } else {
                    $begin = ($page * 9) - 9;
                }
                $events = $cart->showevent_admin($begin);
                include "view/event.php";
                break;
            case 'addevent':
                if (isset($_POST['addevent'])) {
                    $name = $_POST['name'];
                    $code = $_POST['code'];
                    $value = $_POST['value'];
                    //upload hình vào thư mục uploads
                    $target_file = basename($_FILES["img"]["name"]);
                    $img = $target_file;
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    if (
                        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif"
                    ) {
                        // echo "Chỉ được upload các file jpg,png,jpeg,gif";
                        $uploadOk = 0;
                    }
                    $start =  $_POST['start'];
                    $end = $_POST['end'];
                    $timestamp = strtotime($end);

                    // Thiết lập thời gian cuối ngày (23:59:59)
                    $endOfDay = strtotime('today midnight', $timestamp) + 86399; // 86399 giây là độ dài của một ngày trừ đi 1 giây

                    // Định dạng lại thời gian cuối ngày
                    $formattedEndOfDay = date('Y-m-d H:i:s', $endOfDay);
                    $content = str_replace(array("\n", "\r", "\r\n", "\s",), '', $_POST['description']);
                    if ($uploadOk == 1) {
                        move_uploaded_file($_FILES["img"]["tmp_name"],  ADMINEVENT_PATH . $target_file);
                        if ($cart->addevent($code, $name, $_FILES["img"]["name"], $content, $value, $start, $formattedEndOfDay)) {
                            $_SESSION['stt'] = "Thêm thành công !!!";
                        } else {
                            $_SESSION['stt'] = "Thêm không thành công !!!";
                        };
                    }
                }
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                if ($page == '' || $page == 1) {
                    $begin = 0;
                } else {
                    $begin = ($page * 9) - 9;
                }
                $events = $cart->showevent_admin($begin);
                include "view/event.php";
                break;
            case 'delevent':
                if (isset($_GET['idevent'])) {
                    $id = $_GET['idevent'];
                    $imgname = ADMINEVENT_PATH . $cart->get_imgevent_byid($id);
                    if (file_exists($imgname)) {
                        unlink($imgname);
                    }
                    if ($cart->delevent($id)) {
                        header("Location: index.php?admin=event");
                    }
                }
                break;

            case 'comment':
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                if ($page == '' || $page == 1) {
                    $begin = 0;
                } else {
                    $begin = ($page * 9) - 9;
                }
                $cmt = $comment->showcomment_admin($begin);
                include "view/comment.php";
                break;
            case 'delcmt':
                if (isset($_GET['idreview'])) {
                    $id = $_GET['idreview'];
                    if ($comment->delcmt($id)) {
                        header("Location: index.php?admin=comment");
                    }
                }
                break;
            case 'thongke':
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $dataPoints1 = array();
                $dataPoints2 = array();
                // Lấy ngày hiện tại
                $currentDate = date("Y-m-d H:i:s");
                if (isset($_POST['select'])) {

                    switch ($_POST['select-date']) {
                        case '0': // 7 ngày qua
                            $startDate = date("Y-m-d", strtotime("-7 days", strtotime($currentDate)));
                            break;
                        case '1': // 1 tháng qua
                            $startDate = date("Y-m-d", strtotime("-1 month", strtotime($currentDate)));
                            break;
                        case '2': // 6 tháng qua
                            $startDate = date("Y-m-d", strtotime("-6 months", strtotime($currentDate)));
                            break;
                        case '3': // 1 năm qua
                            $startDate = date("Y-m-d", strtotime("-1 year", strtotime($currentDate)));
                            break;
                        default:
                            // Mặc định 7 ngày qua
                            $startDate = date("Y-m-d", strtotime("-7 days", strtotime($currentDate)));
                            break;
                    }
                }
                if (isset($startDate)) {
                    $value = $startDate;
                } else {
                    $value = date("Y-m-d", strtotime("-7 days", strtotime($currentDate)));
                }
                $result = $cart->thongke($value, $currentDate);
                if (is_array($result) && !empty($result)) {
                    foreach ($result as $row) {
                        $dataPoints1[] = array(
                            "label" => $row['mname'],
                            "y" => $row['soluong']
                        );
                        $dataPoints2[] = array(
                            "label" => $row['mname'],
                            "y" => $row['tong']
                        );
                    }
                } else {
                    $msg = "Chưa có đơn hàng gần đây !!!";
                }
                include 'view/thongke.php';
                break;
            case 'home':

                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $dataPoints1 = array();
                $dataPoints2 = array();
                // Lấy ngày hiện tại
                $currentDate = date("Y-m-d");
                $startDate = date("Y-m-d 00:00:00", strtotime($currentDate));
                $endDate = date("Y-m-d 23:59:59", strtotime($currentDate));
                $result = $cart->thongke($startDate, $endDate);
                if (!empty($result)) {
                    foreach ($result as $row) {
                        $dataPoints1[] = array(
                            "label" => $row['mname'],
                            "y" => $row['soluong']
                        );
                        $dataPoints2[] = array(
                            "label" => $row['mname'],
                            "y" => $row['tong']
                        );
                    }
                } else {
                    $msg = "Hôm này chưa có đơn hàng !!!";
                }
                $countuser = count($user->countuser());
                $countcate = count($danhmuc->showdanhmucadmin());
                $countproduct = $product->countsp();
                $countcart = count($cart->countcart());
                include "view/home.php";
                break;
        }
    } else {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dataPoints1 = array();
        $dataPoints2 = array();
        $currentDate = date("Y-m-d");
        $startDate = date("Y-m-d 00:00:00", strtotime($currentDate));
        $endDate = date("Y-m-d 23:59:59", strtotime($currentDate));
        $result = $cart->thongke($startDate, $endDate);
        if (!empty($result)) {
            foreach ($result as $row) {
                $dataPoints1[] = array(
                    "label" => $row['mname'],
                    "y" => $row['soluong']
                );
                $dataPoints2[] = array(
                    "label" => $row['mname'],
                    "y" => $row['tong']
                );
            }
        } else {
            $msg = "Hôm này chưa có đơn hàng !!!";
        }
        $countuser = count($user->countuser());
        $countcate = count($danhmuc->showdanhmucadmin());
        $countproduct = $product->countsp();
        $countcart = count($cart->countcart());
        include "view/home.php";
    }

    ?>
    <?php
    if ((isset($_SESSION['stt']) && $_SESSION['stt'] != '') && (isset($_SESSION['icon']) && $_SESSION['icon'] != '')) {
    ?>
        <script>
            swal({
                title: '<?php echo $_SESSION['stt'] ?>',
                icon: '<?php echo $_SESSION['icon'] ?>',
            });
        </script>
    <?php
        unset($_SESSION['stt']);
        unset($_SESSION['icon']);
    }
    ?>
    <?php
    if (isset($_SESSION['sttupdate']) && $_SESSION['sttupdate'] != '') {
    ?>
        <script>
            swal({
                title: '<?php echo $_SESSION['sttupdate'] ?>',
                icon: "success",
            });
        </script>
    <?php
        unset($_SESSION['sttupdate']);
    }
    ?>
    <?php if (isset($_GET['message']) && $_GET['message'] != '') { ?>
        <script>
            swal({
                title: '<?php echo $_GET['message']; ?>',
                icon: "success",
            });
        </script>
    <?php } ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script type="text/javascript" src="./assets/js/script.js"></script>
    <script type="text/javascript" src="./assets/js/ajax.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                table: {
                    cellProperties: {
                        verticalAlign: 'top' // Thiết lập căn đỉnh là mặc định
                    }
                }
            })
            .then(editor => {
                console.log('Editor was initialized', editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

</body>

</html>