<?php
require_once ('app/controller/login_controller.php');


$id = "";
$pass = "";
$error = "";
if (isset($_POST['user']) && isset($_POST['pass'])) {
    $id = $_POST['user'];
    $pass = $_POST['pass'];

    if (empty($id)) {
        $error = 'Vui lòng nhập ID';
    }
    else if (empty($pass)) {
        $error = 'Vui lòng nhập mật khẩu';
    }
    else if (strlen($pass) < 6) {
        $error = 'Mật khẩu phải dài hơn 6 kí tự';
    }
    else {
        $result = login_controller::login($id,$pass);
        if($result['code'] === 0 ){
            $controller = $result['data'];
            $_SESSION['username'] = $id;
            $_SESSION['permission'] = $controller;
            $action = 'index';
            header('Location:index.php?controller='. $controller . '&action='.$action);
        }else {
            $error = "Invalid username or password";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng Nhập</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/style.css">
</head>
<body class="main_background">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <h3 class="text-center text-secondary mt-5 mb-3">Đăng Nhập</h3>
            <form method="post" action="" class="border-collapse w-100 mb-5 mx-auto px-3 pt-3 ">
                <div class="form-group">
                    <input value="<?= $id ?>" name="user" id="user" type="text" class="form-control"
                           placeholder="ID"
                           oninvalid="this.setCustomValidity('Vui lòng ID')"
                           oninput="setCustomValidity('')"
                    >
                </div>
                <div class="form-group">
                    <input name="pass" value="<?= $pass ?>" id="password" type="password" class="form-control"
                           placeholder="Mật khẩu"
                           oninvalid="this.setCustomValidity('Vui lòng nhập mật khẩu')"
                           oninput="setCustomValidity('')"
                    >
                </div>
                <div class="form-group text-center">
                    <?php
                        if (!empty($error)) {
                            echo "<div class='alert alert-danger c'>$error</div>";
                        }
                    ?>
                    <button class="btn btn-success px-5 center">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
