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

if (isset($_POST['id_delete'])){
    quanli_controller::set_nhacungcap_state_by_id($_POST['id_delete']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Danh sách Nhà cung cấp</title>
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
            <ul class="nav navbar-nav">
                <li style="font-weight: bold">Quản lí kho</li>
            </ul>
            <li><a href="/index.php?controller=kho&action=nhacungcap" style="color: black; font-size: xx-large">Quản lí nhà cung cấp</a></li>
            <li><a href="/index.php?controller=kho&action=kho" style="color: rosybrown; font-size: xx-large">Quản lí kho</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome, <b><?= $this_user['ten'] ?></b></a></li>
            <li><a href="/index.php?controller=login&action=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>

<h2 class="text-center">Danh sách Nhà cung cấp</h2>

<div id="responsive_table">
    <table id="table_list">

        <table id="table_list"">
        <tr class="control">
            <td colspan="7">
                <a href="/index.php?controller=kho&action=them_nhacungcap&data=-1" class="btn btn-success">Thêm Nhà cung cấp</a></button>
                <button class="btn btn-warning" data-toggle="modal" data-target="#delete_user">Xóa Nhà cung cấp</a></button>
            </td>
        </tr>

        <tr class="header">
            <td>Mã nhà cung cấp</td>
            <td>Tên nhà cung cấp</td>
            <td>Số điện thoại</td>
            <td>Địa chỉ</td>
        </tr>
        <?php
        $data = quanli_controller::get_all_nhacungcap();

        $maNCC = '';
        $tenNCC = '';
        $sdt = '';
        $diachi = '';

        $total = 0;
        foreach ($data as $row) {
            if ($row['state']===0) {
                continue;
            }
            else {
                $maNCC = $row['maNCC'];
                $tenNCC = $row['tenNCC'];
                $sdt = $row['sdt'];
                $diachi = $row['diachi'];
            }
            $total += 1;
            ?>
            <tr class="item">
                <td><?= $maNCC ?> </td>
                <td><?= $tenNCC ?> </td>
                <td><?= $sdt ?> </td>
                <td><?= $diachi ?> </td>
                <td><a href="/index.php?controller=kho&action=them_nhacungcap&data=<?=$maNCC?>" class="btn btn-info" >Sửa</a></td>
            </tr>
            <?php
        }
        ?>
        <tr class="control">
            <td colspan="8">
                <p>Tổng số nhân viên: <?= $total; ?></p>
            </td>
        </tr>
    </table>
</div>


<div id="delete_user" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form method="post" action="#">
                <div class="modal-header">
                    <hp class="modal-title">Xóa Người dùng</hp>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body h50">
                    <select class="select col-xs-12 col-sm-12 col-md-12 col-lg-12" name="id_delete">
                        <?php
                        $maNCC = '';
                        $tenNCC = '';
                        $sdt = '';
                        $diachi = '';
                        foreach($data as $row){
                            if ($row['id'] === $_SESSION['username']) {
                                continue;
                            }
                            $maNCC = $row['maNCC'];
                            $tenNCC = $row['tenNCC'];
                            $sdt = $row['sdt'];
                            $diachi = $row['diachi'];
                            ?>
                            <option value="<?= $maNCC ?>">Mã: <?= $maNCC ?> &nbsp; Tên: <?= $tenNCC ?>
                                &nbsp;Số điện thoại : <?= $sdt ?> &nbsp;Địa chỉ : <?= $diachi ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>

    </div>
</div>

</body>
</html>
