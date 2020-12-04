<?php
require_once ('app/controller/quanli_controller.php');
require_once ('app/controller/banhang_controller.php');
$banhang_controller = new banhang_controller();
if (!isset($_SESSION['username'])){
    redirect('index.php?controller=login&action=logout');
}
$id= $_SESSION['username'];
$this_user = quanli_controller::get_user_by_id($id);
if ($this_user['chucvu']!='quanli') {
    redirect('index.php?controller=login&action=logout');
}

if (isset($_POST['id_delete'])){
    quanli_controller::set_xe_state_by_id($_POST['id_delete']);
}
$result = quanli_controller::get_all_xe();
if (isset($_POST['search_value']) && isset($_POST['select_value'])) {
    $search_value = $_POST['search_value'];
    $select_value = $_POST['select_value'];
    if (empty($search_value)) {
        $result = $banhang_controller->get_all_cars();
    }
    else {
        switch ($select_value) {
            case "Mã xe":
                $result = $banhang_controller->get_car_by_maxe($search_value);
                break;
            case "Tên xe":
                $result = $banhang_controller->search_tenxe_xe_model($search_value);
                break;
            case "Mã nhà cung cấp":
                $result = $banhang_controller->search_maNCC($search_value);
                break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Danh sách thông tin xe</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="/style.css">
</head>

<style>
    #quanli_page {
        font-size: x-large;
        color: black;
    }
</style>


<body>

<nav id="navbar" class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a id="quanli_page" href="/index.php?controller=quanli&action=index" style="color: rosybrown">Quản lí nhân viên</a></li>
            <li><a id="quanli_page"  href="/index.php?controller=quanli&action=banhang" style="color: rosybrown">Quản lí bán hàng</a></li>
            <li><a id="quanli_page"  href="/index.php?controller=quanli&action=nhacungcap" style="color: rosybrown">Quản lí nhà cung cấp</a></li>
            <li><a id="quanli_page"  href="/index.php?controller=quanli&action=thongtinxe" >Quản lí thông tin xe</a></li>
            <li><a id="quanli_page"  href="/index.php?controller=quanli&action=thuchi" style="color: rosybrown">Quản lí thu chi</a></li>
            <li><a id="quanli_page"  href="/index.php?controller=quanli&action=kho" style="color: rosybrown">Quản lí kho</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome, <b><?= $_SESSION['username'] ?></b></a></li>
            <li><a href="/index.php?controller=login&action=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>

<h2 class="text-center">Danh sách thông tin xe</h2>

<!--thanh tìm kiếm-->

<div class="container">
    <div class="row">
        <h4 class="text-center">Tìm kiếm thông tin xe</h4>
        <form method="post">
            <table style="margin: auto auto">

                <tr>
                    <td style="width: 100px">
                        <select class="form-control" name="select_value">
                            <option value="Mã xe">Theo Mã xe</option>
                            <option value="Tên xe">Theo Tên xe</option>
                            <option value="Mã nhà cung cấp">Theo Mã nhà cung cấp</option>
                        </select>
                    </td>
                    <td style="width: 150px">
                        <input type="text" name="search_value" class="form-control" placeholder="Nhập thông tin tìm kiếm">
                    </td>
                </tr>

                <tr>
                    <td colspan="2"><input type="submit" class="btn btn-danger px-5 mr-2 form-control" value="Tìm kiếm"></td>
                </tr>

            </table>
        </form>

    </div>
</div> <br><br>


<div id="responsive_table">
    <table id="table_list">

        <table id="table_list"">
        <tr class="control">
            <td colspan="7">
                <a href="/index.php?controller=quanli&action=them_thongtinxe&data=-1" class="btn btn-success">Thêm thông tin xe</a></button>
                <button class="btn btn-warning" data-toggle="modal" data-target="#delete_thongtinxe">Xóa thông tin xe</a></button>
            </td>
        </tr>

        <tr class="header">
            <td>Mã xe</td>
            <td>Tên xe</td>
            <td>Mô tả</td>
            <td>Bảo hành</td>
            <td>Mã nhà cung cấp</td>
            <td>Số lượng trong kho</td>
            <td>Đơn giá</td>
        </tr>
        <?php
        $data = $result;
        $temp = "maxe, tenxe,mota, baohanh,maNCC,soluongkho,dongia";
        $maxe = '';
        $tenxe = '';
        $mota = '';
        $baohanh = '';
        $maNCC = '';
        $soluongkho = '';
        $dongia = '';

        $total = 0;
        foreach ($data as $row) {
            if ($row['state']===0) {
                continue;
            }

            $maxe = $row['maxe'];
            $tenxe = $row['tenxe'];
            $mota = $row['mota'];
            $baohanh = $row['baohanh'];
            $maNCC = $row['maNCC'];
            $soluongkho = $row['soluongkho'];
            $dongia = $row['dongia'];

            $total += 1;
            ?>
            <tr class="item">
                <td><?= $maxe ?> </td>
                <td><?= $tenxe ?> </td>
                <td><?= $mota ?> </td>
                <td><?= $baohanh ?> </td>
                <td><?= $maNCC ?> </td>
                <td><?= $soluongkho ?> </td>
                <td><?= $dongia ?> </td>
                <td><a href="/index.php?controller=quanli&action=them_thongtinxe&data=<?=$maxe?>" class="btn btn-info" >Sửa</a></td>
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


<div id="delete_thongtinxe" class="modal fade modal-xl" role="dialog">
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

                        $maxe = '';
                        $tenxe = '';
                        $mota = '';
                        $baohanh = '';
                        $maNCC = '';
                        $soluongkho = '';
                        $dongia = '';

                        $total = 0;
                        foreach ($data as $row) {
                            if ($row['state']===0) {
                                continue;
                            }

                            $maxe = $row['maxe'];
                            $tenxe = $row['tenxe'];
                            $mota = $row['mota'];
                            $baohanh = $row['baohanh'];
                            $maNCC = $row['maNCC'];
                            $soluongkho = $row['soluongkho'];
                            $dongia = $row['dongia'];

                            $total += 1;
                            ?>
                            <option value="<?= $maxe ?>">Tên xe: <?= $tenxe ?> &nbsp; nhà cung cấp: <?= $maNCC ?>
                            &nbsp;Số lượng kho : <?= $soluongkho ?> &nbsp;Đơn giá : <?= $dongia ?>
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
