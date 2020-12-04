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

$maNCC = '';
$tenNCC = '';
$sdt = '';
$diachi = '';

if (isset($_GET['data'])){

    if ($_GET['data']!= -1){
        $id = $_GET['data'];
        $nhacungcap = kho_controller::get_nhacungcap_by_id($_GET['data']);
        $maNCC = $nhacungcap['maNCC'];
        $tenNCC = $nhacungcap['tenNCC'];
        $sdt = $nhacungcap['sdt'];
        $diachi = $nhacungcap['diachi'];
        $READ = "READONLY";
        $action = "Sửa";
    }
}else {
    redirect('index.php?controller=login&action=logout');
}

if (isset($_POST['maNCC']) && isset($_POST['tenNCC']) && isset($_POST['phone'])
    && isset($_POST['address']) && isset($_POST['action']) ) {
    $action = $_POST['action'];
    $maNCC = $_POST['maNCC'];
    $tenNCC = $_POST['tenNCC'];
    $sdt = $_POST['phone'];
    $diachi = $_POST['address'];

    if (empty($maNCC)) {
        $error = 'Bạn chưa nhập mã nhà cung cấp';
    } else if (empty($tenNCC)) {
        $error = 'Bạn chưa nhập tên nhà cung cấp';
    } else if (empty($sdt)) {
        $error = 'Bạn chưa nhập số điện thoại';
    } else if (empty($diachi)) {
        $error = 'Bạn chưa nhập địa chỉ';
    } else {
        if ($action === "Thêm") {
            $result = kho_controller::add_nhacungcap($maNCC,$tenNCC,$sdt,$diachi);
            if ($result === 0) {
                $success = 'Thêm thành công';
            } else {
                $error = 'Thêm không thành công';
            }
        } else {
            $result = kho_controller::update_nhacungcap($maNCC, $tenNCC, $sdt, $diachi);
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
    <title><?= $action ?> nhà cung cấp</title>
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
            <h3 class="text-center text-secondary mt-2 mb-3 mb-3"><?= $action ?> nhà cung cấp</h3>
            <form method="post" action="" >
                <div class="form-group ">
                    <label for="maNCC">Mã nhà cung cấp</label>
                    <input value="<?= $maNCC?>" name="maNCC" required class="form-control" type="text"
                           placeholder="Nhập mã nhà cung cấp" id="maNCC" <?=$READ ?>
                           oninvalid="this.setCustomValidity('Vui lòng nhập mã nhà cung cấp')"
                           oninput="setCustomValidity('')">
                </div>

                <div class="form-group">
                    <label for="tenNCC">Tên nhà cung cấp</label>
                    <input value="<?= $tenNCC ?>" name="tenNCC" required class="form-control" type="text"
                           placeholder="Nhập id" id="tenNCC"
                           oninvalid="this.setCustomValidity('Vui lòng nhập tên nhà cung cấp')"
                           oninput="setCustomValidity('')"
                    >
                </div>

                <div class="form-group">
                    <label for="user">Số điện thoại </label>
                    <input value="<?= $sdt ?>" name="phone" required class="form-control" type="tel"
                           placeholder="Phone" id="phone" pattern="[0-9]{10}"
                           oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại')"
                           oninput="setCustomValidity('')">
                </div>

                <div class="form-group">
                    <label for="diachi">Địa chỉ</label>
                    <input value="<?= $diachi ?>" name="address" required class="form-control" type="text"
                           placeholder="Nhập dịa chỉ" id="address"
                           oninvalid="this.setCustomValidity('Vui lòng nhập địa chỉ')"
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
                    <a class="btn btn-info" class="xx-large"  href="/index.php?controller=kho&action=nhacungcap">Quản lí nhà cung cấp</a>
                </div>
            </form>

        </div>
    </div>

</div>
</body>
</html>

