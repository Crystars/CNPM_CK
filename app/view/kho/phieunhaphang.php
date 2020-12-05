<?php
require_once ('app/controller/kho_controller.php');
if (!isset($_SESSION['username'])){
    redirect('index.php?controller=login&action=logout');
}
$id= $_SESSION['username'];
$this_user = quanli_controller::get_user_by_id($id);
if ($this_user['chucvu']!='kho') {
    redirect('index.php?controller=login&action=logout');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Danh sách phiếu nhập hàng</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="/style.css">
</head>

<body>

<nav id="navbar" class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li style="font-weight: bold">Quản lí kho</li>
        </ul>

        <ul class="nav navbar-nav">
            <li><a href="/index.php?controller=kho&action=nhacungcap" style="color: rosybrown; font-size: xx-large">Quản lí nhà cung cấp</a></li>
            <li><a href="/index.php?controller=kho&action=kho" style="color: black; font-size: xx-large">Quản lí kho</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome, <b><?= $this_user['ten'] ?></b></a></li>
            <li><a href="/index.php?controller=login&action=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>

<h2 class="text-center">Danh sách phiếu nhập hàng</h2>

<!--thanh tìm kiếm-->

<div id="responsive_table">
    <table id="table_list">

        <table id="table_list"">
        <tr class="control">
            <td colspan="7">
                <a href="/index.php?controller=kho&action=them_kho&data=-1" class="btn btn-success">Thêm phiếu nhập hàng</a></button>
            </td>
        </tr>
        <tr class="header">
            <td>Mã phiếu nhập hàng</td>
            <td>Ngày nhập</td>
            <td>Nhân viên lập</td>
            <td>Mã nhà cung cấp</td>
            <td>Mã xe</td>
            <td>Số lượng</td>
            <td>Đơn giá</td>
            <td>Thuế</td>
        </tr>
        <?php
        $data = quanli_controller::get_all_phieunhaphang();

        $maPhieuNH = '';
        $ngayNhap = '';
        $nvLap = '';
        $maNCC = '';
        $maxe = '';
        $soluong = '';
        $dongia = '';
        $thue = '';
        $state = "";

        $total = 0;
        foreach ($data as $row) {

            $maPhieuNH = $row['maPhieuNH'];
            $ngayNhap = $row['ngayNhap'];
            $nvLap = $row['nvLap'];
            $maNCC = $row['maNCC'];
            $maxe = $row['maxe'];
            $soluong = $row['soluong'];
            $dongia = $row['dongia'];
            $thue = $row['thue'];
            $state = $row['state'];
            $READ = "";
            if ($state===1){
                $READ = "disabled";
            }

            $total += 1;
            ?>
            <tr class="item">
                <td><?= $maPhieuNH ?> </td>
                <td><?= $ngayNhap ?> </td>
                <td><?= $nvLap ?> </td>
                <td><?= $maNCC ?> </td>
                <td><?= $maxe ?> </td>
                <td><?= $soluong ?> </td>
                <td><?= $dongia ?> </td>
                <td><?= $thue ?> </td>
            </tr>
            <?php
        }
        ?>
        <tr class="control">
            <td colspan="8">
                <p>Tổng số xe: <?= $total; ?></p>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
