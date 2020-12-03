<?php
    require_once 'config/config.php';
    require_once 'app/controller/banhang_controller.php';
    $banhang_controller = new banhang_controller();

    if (isset($_SESSION['username'])) {
        /*$result = $banhang_controller->check_permission($_SESSION['username']);
        if (!$result) {
            header('Location: /index.php');
        }*/
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Thông tin lớp học</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="/style.css">
    <script src="jquery-1.6.1.js"></script>
    <script src="/main.js"></script>
</head>
<body class="main_background">
<?php

    $error = '';
    $ngayxuatDH = '';
    $tenNCC = '';
    $tenXe = '';
    $soLuongXe = '';
    $dongia = '';
    $thue = '';

    if (isset($_GET['maDH'])) {
        $maDH = $_GET['maDH'];
        $data = $banhang_controller->get_order_by_maDH($maDH);
        foreach ($data as $row) {
            $ngayxuatDH = $row['ngayxuatDH'];
            $tenNCC = $row['tenNCC'];
            $tenXe = $row['tenXe'];
            $soLuongXe = $row['soLuongXe'];
            $dongia = $row['dongia'];
            $thue = $row['thue'];
        }
    }

    if (isset($_POST['ngayxuatDH']) && isset($_POST['tenNCC']) && isset($_POST['tenXe']) && isset($_POST['soLuongXe']) && isset($_POST['dongia']) && isset($_POST['thue']))
    {
        $ngayxuatDH = $_POST['ngayxuatDH'];
        $tenNCC = $_POST['tenNCC'];
        $tenXe = $_POST['tenXe'];
        $soLuongXe = $_POST['soLuongXe'];
        $dongia = $_POST['dongia'];
        $thue = $_POST['thue'];

        if (empty($ngayxuatDH)) {
            $error = 'Vui lòng nhập ngày xuất';
        }
        else if (empty($tenNCC)) {
            $error = 'Vui lòng nhập tên nhà cung cấp';
        }
        else if (empty($tenXe)) {
            $error = 'Vui lòng nhập tên xe';
        }
        else if (empty($soLuongXe)) {
            $error = 'Vui lòng nhập số lượng xe';
        }
        else if (empty($dongia)) {
            $error = 'Vui lòng nhập đơn giá';
        }
        else if (empty($thue)) {
            $error = 'Vui lòng nhập thuế';
        }
        else {
            if (isset($_GET['maDH'])) {
                $result = $banhang_controller->update_order($_GET['maDH'], $ngayxuatDH, $tenNCC, $tenXe, $soLuongXe, $dongia, $thue);
                if ($result === 0) {
                    echo "<script type='text/javascript'>
                    alert('Cập nhật thành công');
                    window.location.replace('/index.php?controller=banhang&action=index');
                    </script>";
                }
                else {
                    $error = 'Cập nhật thất bại! Vui lòng thử lại sau';
                }
            }
            else {
                $result = $banhang_controller->add_new_order($ngayxuatDH, $tenNCC, $tenXe, $soLuongXe, $dongia, $thue, $_SESSION['username']);

                if ($result != null) {
                    $error = 'Thêm đơn hàng thành công';
                    $ngayxuatDH = '';
                    $tenNCC = '';
                    $tenXe = '';
                    $soLuongXe = '';
                    $dongia = '';
                    $thue = '';
                }
                else {
                    $error = 'Thêm thất bại! Vui lòng thử lại sau';
                }
            }

        }
    }
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 border rounded my-5 p-4  mx-3 sua_lop_hoc">
            <p class="mb-5"><a href="/index.php?controller=banhang&action=index">Quay lại</a></p>
            <h3 class="text-center text-secondary mt-2 mb-3 mb-3"><?php if (isset($_GET['maDH'])) { echo 'Sửa đơn hàng'; } else { echo 'Thêm đơn hàng mới'; } ?></h3>
            <form method="post" action="" novalidate enctype="multipart/form-data">

                <div class="form-group">
                    <label for="classname">Ngày xuất hoá đơn (Định dạng: dd/mm/yyyy)</label>
                    <input value="<?= $ngayxuatDH ?>" name="ngayxuatDH" required class="form-control" type="text" placeholder="Ngày xuất">
                </div>

                <div class="form-group">
                    <label for="subject">Tên nhà cung cấp</label>
                    <input value="<?= $tenNCC ?>" name="tenNCC" required class="form-control" type="text" placeholder="Tên nhà cung cấp">
                </div>

                <div class="form-group">
                    <label for="room">Tên xe</label>
                    <input value="<?= $tenXe ?>" name="tenXe" required class="form-control" type="text" placeholder="Tên xe">
                </div>

                <div class="form-group">
                    <label for="room">Số lượng xe</label>
                    <input value="<?= $soLuongXe ?>" name="soLuongXe" required class="form-control" type="text" placeholder="Số lượng xe">
                </div>

                <div class="form-group">
                    <label for="room">Đơn giá</label>
                    <input value="<?= $dongia ?>" name="dongia" required class="form-control" type="text" placeholder="Đơn giá">
                </div>

                <div class="form-group">
                    <label for="room">Thuế</label>
                    <input value="<?= $thue ?>" name="thue" required class="form-control" type="text" placeholder="Thuế">
                </div>

                <div class="form-group">
                    <?php
                        if (!empty($error)) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    ?>
                    <button type="submit" class="btn btn-primary px-5 mr-2"><?php if (isset($_GET['maDH'])) { echo 'Sửa'; } else { echo 'Thêm'; } ?></button>
                </div>
            </form>

        </div>
    </div>

</div>

</body>
</html>

