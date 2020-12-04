<?php
require_once ("app/controller/quanli_controller.php");
$action = 'Thêm';
$READ = "";
$error = '';
$success = "";

$id = '';
$pass = '';
$pass_confirm = '';
$name = '';
$gender = '';
$birth = '';
$address = '';
$phone = '';
$chucvu = '';
$luongcb = '';


if (isset($_GET['data'])){

    if ($_GET['data']!= -1){
        $id = $_GET['data'];
        $user = quanli_controller::get_user_by_id($_GET['data']);
        $name = $user['ten'];
        $gender = $user['gioitinh'];
        $birth = $user['namsinh'];
        $address = $user['diachi'];
        $phone = $user['sdt'];
        $chucvu = $user['chucvu'];
        $luongcb = $user['luongcb'];
        $READ = "READONLY";
        $action = "Sửa";
    }
}

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['gioitinh'])
    && isset($_POST['birth']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['phone'])
    && isset($_POST['chucvu']) &&  isset($_POST['luongcb']) && isset($_POST['action']) ) {
    $action = $_POST['action'];
    $idnew = $_POST['id'];
    $name = $_POST['name'];
    $gender = $_POST['gioitinh'];
    $birth = $_POST['birth'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $chucvu = $_POST['chucvu'];
    $luongcb = $_POST['luongcb'];
    $pass = $_POST['pass'];
    $pass_confirm = $_POST['pass_confirm'];

    if (empty($idnew)) {
        $error = 'Bạn chưa nhập Id';
    } else if (empty($name)) {
        $error = 'Bạn chưa nhập Họ và Tên';
    } else if (empty($gender)) {
        $error = 'Bạn chưa nhập giới tính';
    } else if (empty($address)) {
        $error = 'Bạn chưa nhập địa chỉ';
    } else if (empty($_POST['phone'])) {
        $error = 'Bạn chưa nhập số điện thoại';
    } else if (empty($chucvu)) {
        $error = 'Bạn chưa nhập chức vụ';
    } else if (empty($luongcb)) {
        $error = 'Bạn chưa nhập lương cơ bản';
    } else {
        if ($action === "Thêm") {
            if (!isset($_POST['pass'])) {
                $error = 'Bạn chưa nhập mật khẩu';
            } else if (!isset($_POST['pass_confirm'])) {
                $error = 'Bạn chưa nhập lại mật khẩu';
            } else if ($pass != $pass_confirm) {
                $error = "Mật khẩu chưa khớp";
            } else if (empty($birth)) {
                $error = 'Bạn chưa nhập năm sinh';
            } else {
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $result = quanli_controller::add_user($idnew, $pass, $name, $gender, $birth, $address, $phone, $chucvu, $luongcb);
                if ($result === 0) {
                    $success = 'Thêm thành công';
                } else {
                    $error = 'Thêm không thành công';
                }
            }
        } else {
            $result = quanli_controller::update_user($id, $name, $gender, $address, $phone, $chucvu, $luongcb);
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
    <title><?= $action ?> nhân viên</title>
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
            <h3 class="text-center text-secondary mt-2 mb-3 mb-3"><?= $action ?> nhân viên</h3>
            <form method="post" action="" >
                <div class="form-group ">
                    <label for="name">Họ và Tên</label>
                    <input value="<?= $name?>" name="name" required class="form-control" type="text"
                           placeholder="Nhập họ tên" id="name"
                           oninvalid="this.setCustomValidity('Vui lòng nhập họ tên')"
                           oninput="setCustomValidity('')">
                </div>
                <div class="form-group">
                    <label for="gioitinh">Giới tính</label>
                    <select class="select_option" name="gioitinh">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="user">Số điện thoại </label>
                    <input value="<?= $phone ?>" name="phone" required class="form-control" type="tel"
                           placeholder="Phone" id="phone" pattern="[0-9]{10}"
                           oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại')"
                           oninput="setCustomValidity('')">
                </div>

                <div class="form-group">
                    <label for="user">Ngày sinh</label>
                    <input value="<?= $birth?>" name="birth" required class="form-control" type="datetime-local"
                           placeholder="Birth" id="birth" <?= $READ ?>
                           oninvalid="this.setCustomValidity('Vui lòng nhập ngày sinh')"
                           oninput="setCustomValidity('')"
                    >
                </div>

                <div class="form-group">
                    <label for="diachi">Địa chỉ</label>
                    <input value="<?= $address ?>" name="address" required class="form-control" type="text"
                           placeholder="Nhập dịa chỉ" id="address"
                           oninvalid="this.setCustomValidity('Vui lòng nhập địa chỉ')"
                           oninput="setCustomValidity('')"
                    >
                </div>

                <div class="form-group">
                    <label for="user">ID</label>
                    <input value="<?= $id ?>" name="id" required class="form-control" type="text"
                           placeholder="Nhập id" id="id" <?= $READ ?>
                           oninvalid="this.setCustomValidity('Vui lòng nhập id')"
                           oninput="setCustomValidity('')"
                    >
                </div>
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input  value="" name="pass" required class="form-control" type="password"
                            placeholder="Password" id="pass" <?= $READ ?>
                            oninvalid="this.setCustomValidity('Vui lòng nhập password')"
                            oninput="setCustomValidity('')">
                </div>

                <div class="form-group">
                    <label for="pass2">Nhập lại Password</label>
                    <input value="" name="pass_confirm" required class="form-control"
                           type="password" placeholder="Confirm Password" id="pass2" <?= $READ ?>
                           oninvalid="this.setCustomValidity('Vui lòng nhập lại password')"
                           oninput="setCustomValidity('')"
                    >
                </div>

                <div class="form-group">
                    <label for="Chucvu">Chức vụ</label>
                    <select class="select_option" name="chucvu">
                        <option value="banhang">Nhân viên bán hàng</option>
                        <option value="kho">kho</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="luongcb">Lương cơ bản</label>
                    <input value="<?= $luongcb ?>" name="luongcb" required class="form-control"
                           type="number" placeholder="Lương cơ bản" id="luongcb"
                           oninvalid="this.setCustomValidity('Vui lòng nhập Lương cơ bản')"
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
                    <a class="btn btn-info" class="xx-large"  href="/index.php?controller=quanli&action=index">Quản lí nhân viên</a>
                </div>
            </form>

        </div>
    </div>

</div>
</body>
</html>

