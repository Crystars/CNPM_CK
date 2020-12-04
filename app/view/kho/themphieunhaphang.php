<?php
require_once ("app/controller/kho_controller.php");

if (!isset($_SESSION['username'])){
    redirect('index.php?controller=login&action=logout');
}
$id= $_SESSION['username'];
$this_user = quanli_controller::get_user_by_id($id);
if ($this_user['chucvu']!='kho') {
    redirect('index.php?controller=login&action=logout');
}

$action = 'Thêm';
$READ = "";
$error = '';
$success = "";

$maPhieuNH = '';
$ngayNhap = '';
$nvLap = '';
$maNCC = '';
$maxe = '';
$soluong = '';
$dongia = '';
$thue = '';
$state = "";
$hidden = "hidden";
if (isset($_GET['data'])){

    if ($_GET['data']!= -1){
        $row = quanli_controller::get_phieunhaphang_by_id($_GET['data']);
        if ($row!=null) {
            $maPhieuNH = $row['maPhieuNH'];
            $ngayNhap = $row['ngayNhap'];
            $nvLap = $row['nvLap'];
            $maNCC = $row['maNCC'];
            $maxe = $row['maxe'];
            $soluong = $row['soluong'];
            $dongia = $row['dongia'];
            $thue = $row['thue'];
            $state = $row['state'];
            $READ = "READONLY";
            $action = "Sửa";
            $hidden ='';
        }
    }else {
        $ngayNhap = date('Y-m-d');
        $nvLap = $this_user['id'];
    }
}else {
    redirect('index.php?controller=login&action=logout');
}
if (isset($_POST['maPhieuNH']) && isset($_POST['ngayNhap']) && isset($_POST['nvLap'])
    && isset($_POST['soluong']) && isset($_POST['dongia']) &&isset($_POST['thue']) &&
    isset($_POST['maNCC']) && isset($_POST['maxe']) && isset($_POST['action']) ) {
    $action = $_POST['action'];
    $maPhieuNH = $_POST['maPhieuNH'];
    $ngayNhap = $_POST['ngayNhap'];
    $nvLap = $_POST['nvLap'];
    $maNCC = $_POST['maNCC'];
    $maxe = $_POST['maxe'];
    $soluong = $_POST['thue'];
    $dongia = $_POST['dongia'];
    $thue = $_POST['thue'];

    if (empty($ngayNhap)) {
        $error = 'Bạn chưa nhập ngày nhập';
    } else if (empty($nvLap)) {
        $error = 'Bạn chưa nhập nhân viên lập';
    } else if (empty($maNCC)) {
        $error = 'Bạn chưa nhập mã nhà cung cấp';
    } else if (empty($maxe)) {
    $error = 'Bạn chưa nhập mã xe';
    } else if (empty($soluong)) {
        $error = 'Bạn chưa nhập số lượng';
    }else if (empty($dongia)) {
        $error = 'Bạn chưa nhập đơn giá';
    }else if (empty($thue)) {
        $error = 'Bạn chưa nhập thuế';
    } else {
        if ($action === "Thêm") {
            $result = quanli_controller::add_phieunhaphang($ngayNhap, $nvLap, $maNCC, $maxe, $soluong, $dongia, $thue);
            if ($result === 0) {
                $success = 'Thêm thành công';
            } else {
                $error = 'Thêm không thành công';
            }
        } else {
            $result = quanli_controller::update_phieunhaphang($maPhieuNH, $ngayNhap, $nvLap, $maNCC, $maxe, $soluong, $dongia, $thue);
            if ($result == 0) {
                $success = 'Sửa thành công';
            } else {
                $error = 'Sửa không thành công';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $action ?> phiếu nhập hàng</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="/style.css">
</head>

<body class="main_background">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 border my-5 p-4 rounded mx-3">
            <h3 class="text-center text-secondary mt-2 mb-3 mb-3"><?= $action ?> phiếu nhập hàng</h3>
            <form method="post" action="#" >
                <div class="form-group " <?=$hidden?>>
                    <label for="maPhieuNH">Mã phiếu nhập hàng </label>
                    <input value="<?= $maPhieuNH ?>" name="maPhieuNH" required class="form-control" type="text"
                           id="maPhieuNH" READONLY
                    >
                </div>

                <div class="form-group">
                    <label for="ngayNhap">Ngày nhập phiếu</label>
                    <input value="<?= $ngayNhap?>" name="ngayNhap" required class="form-control" type="text"
                           placeholder="Ngày nhập phiếu" id="ngayNhap" READONLY
                           oninvalid="this.setCustomValidity('Vui lòng nhập ngày nhập hàng')"
                           oninput="setCustomValidity('')"
                    >
                </div>

                <div class="form-group ">
                    <label for="nvLap">Mã nhân viên lập</label>
                    <input value="<?= $nvLap ?>" name="nvLap" required class="form-control" type="text"
                           id="nvLap" READONLY
                </div>

                <div class="form-group" >
                    <label for="maNCC">Mã nhà cung cấp</label>
                    <select class="select_option" name="maNCC"  >
                        <?php
                        $NCC = quanli_controller::get_all_nhacungcap();
                        $maNCC2 = '';
                        $tenNCC2 = '';

                        foreach ($NCC as $ncc){
                            $maNCC2 = $ncc['maNCC'];
                            $tenNCC2 = $ncc['tenNCC'];
                            $select = '';
                            if ($maNCC2 === $maNCC){
                                $select = "selected";
                            }
                            ?>
                            <option value="<?= $maNCC2 ?>" selected="<?= $select ?>">Mã nhà cung cấp: <?= $maNCC2 ?> &nbsp; Tên nhà cung cấp: <?= $tenNCC2 ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group" <>
                    <label for="maNCC">Mã xe</label>
                    <select class="select_option" name="maxe"  >
                        <?php
                        $xe = quanli_controller::get_all_xe();
                        $maxe2 = '';
                        $tenxe2 = '';
                        foreach ($xe as $row){
                            $maxe2 = $row['maxe'];
                            $tenxe2 = $row['tenxe'];
                            $select = '';
                            if ($maxe2 === $maxe){
                                $select = "selected";
                            }
                            ?>
                            <option value="<?= $maxe2 ?>" selected="<?= $select ?>" >Mã xe: <?= $maxe2 ?> &nbsp; Tên xe: <?= $tenxe2 ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="soluong">Số lượng </label>
                    <input  value="<?= $soluong ?>" name="soluong" required class="form-control" type="number"
                            placeholder="số lượng nhập" id="soluong"
                            oninvalid="this.setCustomValidity('Vui lòng nhập số lượng')"
                            oninput="setCustomValidity('')">
                </div>

                <div class="form-group">
                    <label for="dongia">Nhập đơn giá</label>
                    <input value="<?=$dongia ?>" name="dongia" required class="form-control"
                           type="number" placeholder="đơn giá" id="dongia"
                           oninvalid="this.setCustomValidity('Vui lòng nhập đơn giá')"
                           oninput="setCustomValidity('')"
                    >
                </div>


                <div class="form-group">
                    <label for="thue">Nhập thuế</label>
                    <input value="<?=$thue ?>" name="thue" required class="form-control"
                           type="text" placeholder="Thuế" id="thue"
                           oninvalid="this.setCustomValidity('Vui lòng nhập thuế')"
                           oninput="setCustomValidity('')"
                    >
                </div>

                <input type="hidden" name="action" value="<?= $action ?>">

                <div class="form-group">
                    <?php
                    if (!empty($error)) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                    else if (!empty($success)) {
                        echo "<div class='alert alert-success'>$success</div>";
                    }
                    ?>
                    <button type="submit" class="btn btn-success  mt-3 mr-2"><?= $action ?></button>
                    <button type="reset" class="btn btn-outline-success  mt-3">Reset</button>
                    <a class="btn btn-info" class="xx-large"  href="/index.php?controller=kho&action=kho">Quản lí kho</a>
                </div>
            </form>

        </div>
    </div>

</div>
</body>
</html>

