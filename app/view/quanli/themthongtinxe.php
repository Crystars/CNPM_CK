<?php
require_once ("app/controller/quanli_controller.php");

if (!isset($_SESSION['username'])){
    redirect('index.php?controller=login&action=logout');
}
$id= $_SESSION['username'];
$this_user = quanli_controller::get_user_by_id($id);
if ($this_user['chucvu']!='quanli') {
    redirect('index.php?controller=login&action=logout');
}

$action = 'Thêm';
$READ = "";
$error = '';
$success = "";

$maxe ='';
$tenxe ='';
$mota = '';
$baohanh = '';
$maNCC = '';
$soluongkho = '';
$dongia = '';


if (isset($_GET['data'])){

    if ($_GET['data']!= -1){
        $xe = quanli_controller::get_xe_by_id($_GET['data']);
        if ($xe!=null) {
            $maxe = $xe['maxe'];
            $tenxe = $xe['tenxe'];
            $mota = $xe['mota'];
            $baohanh = $xe['baohanh'];
            $maNCC = $xe['maNCC'];
            $soluongkho = $xe['soluongkho'];
            $dongia = $xe['dongia'];
            $READ = "READONLY";
            $action = "Sửa";
        }
    }
}else {
    redirect('index.php?controller=login&action=logout');
}

if (isset($_POST['maxe']) && isset($_POST['tenxe']) && isset($_POST['mota'])
    && isset($_POST['baohanh']) && isset($_POST['maNCC']) &&isset($_POST['soluongkho']) &&
    isset($_POST['dongia']) && isset($_POST['action']) ) {
    $action = $_POST['action'];
    $maxe = $_POST['maxe'];
    $tenxe = $_POST['tenxe'];
    $mota = $_POST['mota'];
    $baohanh = $_POST['baohanh'];
    $maNCC = $_POST['maNCC'];
    $soluongkho = $_POST['soluongkho'];
    $dongia = $_POST['dongia'];

    if (empty($maxe)) {
        $error = 'Bạn chưa nhập mã xe';
    } else if (empty($tenxe)) {
        $error = 'Bạn chưa nhập tên xe';
    } else if (empty($mota)) {
        $error = 'Bạn chưa nhập mô tả';
    } else if (empty($baohanh)) {
        $error = 'Bạn chưa nhập bảo hành';
    } else if (empty($maNCC)) {
    $error = 'Bạn chưa nhập mã nhà cung cấp';
    } else if (empty($soluongkho)) {
        $error = 'Bạn chưa nhập số lượng kho';
    }else if (empty($dongia)) {
        $error = 'Bạn chưa nhập đơn giá';
    } else {
        if ($action === "Thêm") {
            $result = quanli_controller::add_xe($maxe, $tenxe, $mota, $baohanh, $maNCC, $soluongkho, $dongia);
            if ($result === 0) {
                $success = 'Thêm thành công';
            } else {
                $error = 'Thêm không thành công';
            }
        } else {
            $result = quanli_controller::update_xe($maxe, $tenxe, $mota, $baohanh, $maNCC, $soluongkho, $dongia);
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
    <title><?= $action ?> thông tin xe</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="/style.css">
</head>

<body class="main_background">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 border my-5 p-4 rounded mx-3 sua_lop_hoc">
            <h3 class="text-center text-secondary mt-2 mb-3 mb-3"><?= $action ?> thông tin xe</h3>
            <form method="post">
                <div class="form-group ">
                    <label for="name">Mã xe</label>
                    <input value="<?= $maxe ?>" name="maxe" required class="form-control" type="text"
                           placeholder="Nhập mã xe" id="name" <?= $READ ?>
                           oninvalid="this.setCustomValidity('Vui lòng nhập mã xe')"
                           oninput="setCustomValidity('')">
                </div>

                <div class="form-group">
                    <label for="tenxe">Tên xe </label>
                    <input value="<?= $tenxe ?>" name="tenxe" required class="form-control" type="text"
                           placeholder="Nhập tên xe" id="tenxe"
                           oninvalid="this.setCustomValidity('Vui lòng nhập tên xe')"
                           oninput="setCustomValidity('')">
                </div>

                <div class="form-group">
                    <label for="mota">Mô tả</label>
                    <input value="<?= $mota?>" name="mota" required class="form-control" type="text"
                           placeholder="Mô tả" id="mota"
                           oninvalid="this.setCustomValidity('Vui lòng nhập mô tả')"
                           oninput="setCustomValidity('')"
                    >
                </div>

                <div class="form-group">
                    <label for="baohanh">Bảo hành</label>
                    <input value="<?= $baohanh ?>" name="baohanh" required class="form-control" type="text"
                           placeholder="Bảo hành" id="baohanh"
                           oninvalid="this.setCustomValidity('Vui lòng nhập bảo hành')"
                           oninput="setCustomValidity('')"
                    >
                </div>

                <div class="form-group">
                    <label for="maNCC">Mã nhà cung cấp</label>
                    <select class="select_option" name="maNCC">
                    <?php
                        $NCC = quanli_controller::get_all_nhacungcap();
                        $maNCC = '';
                        $tenNCC = '';
                        foreach ($NCC as $ncc){
                            $maNCC = $ncc['maNCC'];
                            $tenNCC = $ncc['tenNCC'];
                            ?>
                            <option value="<?= $maNCC ?>">Mã nhà cung cấp: <?= $maNCC ?> &nbsp; Tên nhà cung cấp: <?= $tenNCC ?></option>
                        <?php
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="soluongkho">Số lượng  kho</label>
                    <input  value="<?= $soluongkho ?>" name="soluongkho" required class="form-control" type="number"
                            placeholder="số lượng trong kho" id="soluongkho"
                            oninvalid="this.setCustomValidity('Vui lòng nhập số lượng kho')"
                            oninput="setCustomValidity('')">
                </div>

                <div class="form-group">
                    <label for="dongia">Nhập đơn giá</label>
                    <input value="<?=$dongia ?>" name="dongia" required class="form-control"
                           type="text" placeholder="đơn giá" id="dongia"
                           oninvalid="this.setCustomValidity('Vui lòng nhập đơn giá')"
                           oninput="setCustomValidity('')">
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
                    <a class="btn btn-info mt-3" style="margin-left: 8px" href="/index.php?controller=quanli&action=thongtinxe">Quản lí thông tin xe</a>
                </div>
            </form>

        </div>
    </div>

</div>
</body>
</html>

