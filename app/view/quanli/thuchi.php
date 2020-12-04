<?php
    require_once ('app/controller/quanli_controller.php');
    $quanli_controller = new quanli_controller();

    if (isset($_SESSION['username'])) {
        /*$result = banhang_controller->check_permission($_SESSION['username']);
        if (!$result) {
            header('Location:/index.php');
        }*/
    }

    $result = $quanli_controller->get_all_statistics();


    if (isset($_POST['loaiTK'])) {
        $loaiTK = $_POST['loaiTK'];
        $thoigianLap = date('Y-m-d', time());
        $soLuongXeNhap = 0;
        $tongTienNhap = 0;
        $soLuongXeBan = 0;
        $tongTienBan = 0;
        $soLuongXeTon = 0;

        switch ($loaiTK) {
            case "Theo tháng":
                $currentMonth = date('m', time());
                $data = $quanli_controller->get_import_by_month($currentMonth);

                foreach ($data as $row) {
                    $soluong = $row['soluong'];
                    $dongia = str_replace('.', '', $row['dongia']);
                    $thue = str_replace('%', '', $row['thue']);

                    $soLuongXeNhap = $soLuongXeNhap + $soluong;
                    $tongTienNhap = $tongTienNhap + ((float)$dongia + (float)$dongia*(float)$thue)*$soluong;
                }

                $data = $quanli_controller->get_order_by_month($currentMonth);
                foreach ($data as $row) {
                    $soLuongXe = $row['soLuongXe'];
                    $dongia = str_replace('.', '', $row['dongia']);
                    $thue = str_replace('%', '', $row['thue']);

                    $soLuongXeBan = $soLuongXeBan + $soLuongXe;
                    $tongTienBan = $tongTienBan + ((float)$dongia + (float)$dongia*(float)$thue)*$soLuongXe;
                }

                $data = $quanli_controller->get_sum_soluongkho();
                foreach ($data as $row) {
                    $soLuongXeTon = $row['soLuongXeTon'];
                }



                break;
            case "Theo năm":
                $currentYear = date('Y', time());
                $data = $quanli_controller->get_import_by_year($currentYear);
                foreach ($data as $row) {
                    $soluong = $row['soluong'];
                    $dongia = str_replace('.', '', $row['dongia']);
                    $thue = str_replace('%', '', $row['thue']);

                    $soLuongXeNhap = $soLuongXeNhap + $soluong;
                    $tongTienNhap = $tongTienNhap + ((float)$dongia + (float)$dongia*(float)$thue)*$soluong;
                }

                $data = $quanli_controller->get_order_by_year($currentYear);
                foreach ($data as $row) {
                    $soLuongXe = $row['soLuongXe'];
                    $dongia = str_replace(',', '', $row['dongia']);
                    $thue = str_replace('%', '', $row['thue']);

                    $soLuongXeBan = $soLuongXeBan + $soLuongXe;
                    $tongTienBan = $tongTienBan + ((float)$dongia + (float)$dongia*(float)$thue)*$soLuongXe;
                }

                $data = $quanli_controller->get_sum_soluongkho();
                foreach ($data as $row) {
                    $soLuongXeTon = $row['soLuongXeTon'];
                }
                break;
        }
        $tongTienNhap = number_format($tongTienNhap);
        $tongTienBan = number_format($tongTienBan);
        $result1 = $quanli_controller->add_new_statistic($loaiTK, $thoigianLap, $soLuongXeNhap, $soLuongXeBan,
            $soLuongXeTon, strval($tongTienNhap), strval($tongTienBan));
        if ($result1 === 0) {
            echo "<script type='text/javascript'>
                        alert('Thêm thành công');
                        window.location.replace('/index.php?controller=quanli&action=thuchi');
                        </script>";
        }
        else {
            echo "<script type='text/javascript'>
                        alert('Có lỗi xảy ra! Vui lòng thử lại');
                        window.location.replace('/index.php?controller=quanli&action=thuchi');
                        </script>";
        }
    }

    if (isset($_POST['search_value']) && isset($_POST['select_value'])) {
        $search_value = $_POST['search_value'];
        $select_value = $_POST['select_value'];
        if (empty($search_value)) {
            $result = $quanli_controller->get_all_statistics();
        }
        else {
            switch ($select_value) {
                case "Mã thống kê":
                    $result = $quanli_controller->search_statistics_by_maTK($search_value);
                    break;
                case "Loại thống kê":
                    $result = $quanli_controller->search_statistics_by_loaiTK($search_value);
                    break;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Danh sách đơn hàng</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <link rel="stylesheet" href="/style.css">
    <script src="jquery-1.6.1.js"></script>
    <script src="/main.js"></script>
</head>

<body>

<nav id="navbar" class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a class="x-large"  href="/index.php?controller=quanli&action=index">Quản lí nhân viên</a></li>
            <li><a class="x-large"  href="/index.php?controller=quanli&action=banhang">Quản lí bán hàng</a></li>
            <li><a class="x-large"  href="/index.php?controller=quanli&action=nhacungcap">Quản lí nhà cung cấp</a></li>
            <li><a class="x-large"  href="/index.php?controller=quanli&action=thongtinxe">Quản lí thông tin xe</a></li>
            <li><a class="x-large"  href="/index.php?controller=quanli&action=thuchi">Quản lí thu chi</a></li>
            <li><a class="x-large"  href="/index.php?controller=quanli&action=kho">Quản lí kho</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome, <b><?= $_SESSION['username'] ?></b></a></li>
            <li><a href="/index.php?controller=login&action=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
        <h4 class="text-center">Tìm kiếm thống kê</h4>
        <form method="post">
            <table style="margin: auto auto">

                <tr>
                    <td style="width: 50px">
                        <select class="form-control" name="select_value">
                            <option value="Mã thống kê">Theo Mã thống kê</option>
                            <option value="Loại thống kê">Theo Loại thống kê</option>
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
</div>

<div id="responsive_table">
    <table id="table_list">

        <tr class="control1">
            <td colspan="4">
                <a class="btn btn-success px-5 mr-2 btn-lg" href="" data-toggle="modal" data-target="#add_statistic">Thêm thống kê</a>
            </td>
        </tr>
        <tr class="header">
            <td>Mã thống kê</td>
            <td>Loại thống kê</td>
            <td>Thời gian lập</td>
            <td>Số lượng xe nhập</td>
            <td>Số lượng xe bán</td>
            <td>Số lượng xe tồn</td>
            <td>Tổng tiền nhập hàng (VND)</td>
            <td>Tổng tiền đơn hàng (VND)</td>
        </tr>
        <?php
        $data = $result;
        $maTK = '';
        $loaiTK = '';
        $thoigianLap = '';
        $soLuongXeNhap = '';
        $soLuongXeBan = '';
        $soLuongXeTon = '';
        $tongTienNhap = '';
        $tongTienBan = '';

        $total = count($data);

        foreach ($data as $row) {
            $maTK = $row['maTK'];
            $loaiTK = $row['loaiTK'];
            $thoigianLap = date('d/m/Y', strtotime($row['thoigianLap']));
            $soLuongXeNhap = $row['soLuongXeNhap'];
            $soLuongXeBan = $row['soLuongXeBan'];
            $soLuongXeTon = $row['soLuongXeTon'];
            $tongTienNhap = $row['tongTienNhap'];
            $tongTienBan = $row['tongTienBan'];
            ?>
            <tr class="item">
                <td><?= $maTK; ?></td>
                <td><?= $loaiTK; ?></td>
                <td><?= $thoigianLap; ?></td>
                <td><?= $soLuongXeNhap; ?></td>
                <td><?= $soLuongXeBan; ?></td>
                <td><?= $soLuongXeTon; ?></td>
                <td><?= $tongTienNhap; ?></td>
                <td><?= $tongTienBan; ?></td>
            </tr>
            <?php
        }
        ?>
        <tr class="control">
            <td colspan="8">
                <p>Tổng số thống kê: <?= $total; ?></p>
            </td>
        </tr>
    </table>
</div>

<div class="modal fade" id="add_statistic">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm thống kê mới</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <select class="form-control" name="loaiTK">
                        <option value="Theo tháng">Theo tháng</option>
                        <option value="Theo năm">Theo năm</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>