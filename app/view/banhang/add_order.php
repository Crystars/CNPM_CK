<?php
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
    <title>Thêm đơn hàng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="/style.css">
    <script src="/main.js"></script>
</head>
<body class="main_background">
<?php

$error = '';
$ngayxuatDH = '';
$maNCC = '';
$maxe = '';
$soLuongXe = '';
$dongia = '';
$thue = '';
$disabled = "";

if (isset($_GET['maDH'])) {
    $maDH = $_GET['maDH'];
    $data = $banhang_controller->get_order_by_maDH($maDH);
    foreach ($data as $row) {
        $ngayxuatDH = $row['ngayxuatDH'];
        $maNCC = $row['maNCC'];
        $maxe_get = $row['maxe'];
        $soLuongXe = $row['soLuongXe'];
        $soLuongXe_get = $row['soLuongXe'];
        $dongia = $row['dongia'];
        $thue = $row['thue'];
        $disabled = 'disabled';
    }
}

if (isset($_POST['ngayxuatDH']) && isset($_POST['maNCC']) && isset($_POST['maxe']) &&  isset($_POST['soLuongXe']) && isset($_POST['dongia']) && isset($_POST['thue']))
{
    $ngayxuatDH = $_POST['ngayxuatDH'];
    $maNCC = $_POST['maNCC'];
    $maxe = explode('/', $_POST['maxe'])[0];
    $soLuongXe = $_POST['soLuongXe'];
    $dongia = $_POST['dongia'];
    $thue = $_POST['thue'];
    $soLuongXeTon = $banhang_controller->get_car_by_maxe($maxe)[0]['soluongkho'];

    if (empty($ngayxuatDH)) {
        $error = 'Vui lòng nhập ngày xuất';
    }
    else if (empty($maxe)) {
        $error = 'Vui lòng nhập mã xe';
    }
    else if (empty($maNCC)) {
        $error = 'Vui lòng nhập mã nhà cung cấp';
    }
    else if (empty($dongia)) {
        $error = 'Vui lòng nhập đơn giá';
    }
    else if (empty($soLuongXe)) {
        $error = 'Vui lòng nhập số lượng xe';
    }
    else if (empty($thue)) {
        $error = 'Vui lòng nhập thuế';
    }
    else if ($soLuongXe > $soLuongXeTon) {
        $error = 'Số lượng xe tồn không đủ';
    }
    else {
        if (isset($_GET['maDH'])) {
            $soluongXeUpdate = $soLuongXe_get - $soLuongXe;
            $result = $banhang_controller->update_order($_GET['maDH'], $ngayxuatDH, $maNCC, $maxe, $soLuongXe, $dongia, $thue);
            $result1 = $banhang_controller->update_xe_soluongkho($maxe, $soluongXeUpdate);

            if ($result === 0 && $result1 === 0) {
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
            $result = $banhang_controller->add_new_order($ngayxuatDH, $maNCC, $maxe, $soLuongXe, $dongia, $thue, $_SESSION['username']);

            if ($result != null) {
                $error = 'Thêm đơn hàng thành công';
                $ngayxuatDH = '';
                $maNCC = '';
                $maxe = '';
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
        <div class="col-xl-5 col-lg-6 col-md-8 border rounded my-5 p-4 mx-3 sua_lop_hoc">
            <p class="mb-5"><a href="/index.php?controller=banhang&action=index">Quay lại</a></p>
            <h3 class="text-center text-secondary mt-2 mb-3 mb-3"><?php if (isset($_GET['maDH'])) { echo 'Sửa đơn hàng'; } else { echo 'Thêm đơn hàng mới'; } ?></h3>
            <form method="post" id="myAddForm" novalidate enctype="multipart/form-data">

                <div class="form-group">
                    <label for="ngayxuatDH">Ngày xuất hoá đơn</label>
                    <input READONLY value="<?php if (isset($_GET['maDH'])) {echo $ngayxuatDH;} else {echo date('Y-m-d', time());} ?>" name="ngayxuatDH" id="ngayxuatDH" required class="form-control" type="text" placeholder="Ngày xuất">
                </div>

                <div class="form-group">
                    <label for="maxe">Mã xe</label>
                    <select class="form-control" name="maxe" id="maxe" onchange="get_value_by_maxe(this)" <?= $disabled ?> >
                        <option value=""> --Chọn mã xe-- </option>
                        <?php
                        $data = $banhang_controller->get_all_cars();
                        foreach ($data as $row) {
                            $maxe = $row['maxe'];
                            if ($maDH != null) {
                                $maxe = $maxe_get;
                            }
                            ?>

                            <option <?php if (isset($_GET['maDH'])) { ?> selected="selected" <?php } ?> value='<?= $maxe ?>/<?= $row["maNCC"] ?>/<?= $row["dongia"] ?>'><?= $maxe ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="maNCC">Mã nhà cung cấp</label>
                    <input value="<?= $maNCC ?>" name="maNCC" id="maNCC" required class="form-control" type="text" placeholder="Mã nhà cung cấp" READONLY>
                </div>

                <div class="form-group">
                    <label for="dongia">Đơn giá</label>
                    <input value="<?= $dongia ?>" name="dongia" id="dongia" required class="form-control" type="text" placeholder="Đơn giá" READONLY>
                </div>

                <div class="form-group">
                    <label for="soLuongXe">Số lượng xe</label>
                    <input value="<?= $soLuongXe ?>" name="soLuongXe" id="soLuongXe" required class="form-control" type="text" placeholder="Số lượng xe">
                </div>

                <div class="form-group">
                    <label for="thue">Thuế</label>
                    <input value="<?= $thue ?>" name="thue" id="thue" required class="form-control" type="text" placeholder="Thuế">
                </div>

                <div class="form-group">
                    <?php
                    if (!empty($error)) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                    ?>
                    <button type="submit" class="btn btn-primary px-5 mr-2">Lưu</button>
                    <button type="reset" class="btn btn-light px-5 mr-2">Reset</button>
                </div>
            </form>

        </div>
    </div>

</div>

<script>
    $('#myAddForm').on('submit', function() {
        $('select').prop('disabled', false);
    });
</script>

</body>
</html>

