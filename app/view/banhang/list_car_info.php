<?php
    require_once 'config/config.php';
    require_once 'app/controller/banhang_controller.php';
    $banhang_controller = new banhang_controller();

    $result = $banhang_controller->get_all_cars();

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
    <title>Lớp học</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="jquery-1.6.1.js"></script>

    <link rel="stylesheet" type="text/css" href="/style.css">
    <script src="/main.js"></script>
</head>

<body>

<nav id="navbar" class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li style="font-weight: bold">Quản lí bán hàng</li>
        </ul>

        <ul class="nav navbar-nav">
            <li><a id="classroom" href="/index.php?controller=banhang&action=index" style="color: rosybrown">Danh sách đơn hàng</a></li>
        </ul>

        <ul class="nav navbar-nav">
            <li><a id="classroom" href="/index.php?controller=banhang&action=list_car_info">Danh sách xe</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome, <b><?= $_SESSION['username'] ?></b></a></li>
            <li><a href="/index.php?controller=login&action=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>

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

        <tr class="header">
            <td>Mã xe</td>
            <td>Tên xe</td>
            <td>Mô tả</td>
            <td>Bảo hành</td>
            <td>Mã nhà cung cấp</td>
            <td>Số lượng kho</td>
            <td>Đơn giá (VND)</td>
            <td>Hình ảnh xe</td>
        </tr>
        <?php
        $data = $result;
        $maxe = '';
        $tenxe = '';
        $mota = '';
        $baohanh = '';
        $maNCC = '';
        $soluongkho = '';
        $dongia = '';
        $image = '';

        $total = count($data);

        foreach ($data as $row) {
            $maxe = $row['maxe'];
            $tenxe = $row['tenxe'];
            $mota = $row['mota'];
            $baohanh = $row['baohanh'];
            $maNCC = $row['maNCC'];
            $soluongkho = $row['soluongkho'];
            $dongia = $row['dongia'];
            $image = $row['image'];
            ?>
            <tr class="item">
                <td><?= $maxe; ?></td>
                <td><?= $tenxe; ?></td>
                <td><?= $mota; ?></td>
                <td><?= $baohanh; ?></td>
                <td><?= $maNCC; ?></td>
                <td><?= $soluongkho; ?></td>
                <td><?= $dongia; ?></td>
                <td class="responsive_image" style="background-image: url('/images/xe/<?= $image ?>')"></td>
            </tr>
            <?php
        }
        ?>
        <tr class="control">
            <td colspan="8">
                <p>Tổng số mẫu xe: <?= $total; ?></p>
            </td>
        </tr>
    </table>
</div>

</body>

</html>
