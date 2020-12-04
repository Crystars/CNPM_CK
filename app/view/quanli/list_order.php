<?php
    require_once 'app/controller/banhang_controller.php';
    $banhang_controller = new banhang_controller();

    if (isset($_SESSION['username'])) {
        /*$result = banhang_controller->check_permission($_SESSION['username']);
        if (!$result) {
            header('Location:/index.php');
        }*/
    }

    $result = $banhang_controller->get_all_orders();

    if (isset($_POST['search_value']) && isset($_POST['select_value'])) {
        $search_value = $_POST['search_value'];
        $select_value = $_POST['select_value'];
        if (empty($search_value)) {
            $result = $banhang_controller->get_all_orders();
        }
        else {
            switch ($select_value) {
                case "Mã đơn hàng":
                    $result = $banhang_controller->get_order_by_maDH($search_value);
                    break;
                case "Ngày xuất":
                    $result = $banhang_controller->search_ngayxuatDH($search_value);
                    break;
                case "Mã nhà cung cấp":
                    $result = $banhang_controller->search_maNCC_donhang_model($search_value);
                    break;
                case "Mã xe":
                    $result = $banhang_controller->search_maxe_donhang_model($search_value);
                    break;
                case "Số lượng xe":
                    $result = $banhang_controller->search_soLuongXe($search_value);
                    break;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Danh sách đơn hàng aabc</title>
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
            <li><a id="quanli_page"  href="/index.php?controller=quanli&action=banhang" >Quản lí bán hàng</a></li>
            <li><a id="quanli_page"  href="/index.php?controller=quanli&action=nhacungcap" style="color: rosybrown">Quản lí nhà cung cấp</a></li>
            <li><a id="quanli_page"  href="/index.php?controller=quanli&action=thongtinxe" style="color: rosybrown">Quản lí thông tin xe</a></li>
            <li><a id="quanli_page"  href="/index.php?controller=quanli&action=thuchi" style="color: rosybrown">Quản lí thu chi</a></li>
            <li><a id="quanli_page"  href="/index.php?controller=quanli&action=kho" style="color: rosybrown">Quản lí kho</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome, <b><?= $_SESSION['username'] ?></b></a></li>
            <li><a href="/index.php?controller=login&action=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
            <h4 class="text-center">Tìm kiếm đơn hàng</h4>
            <form method="post">
                <table style="margin: auto auto">

                    <tr>
                        <td style="width: 50px">
                            <select class="form-control" name="select_value">
                                <option value="Mã đơn hàng">Theo Mã đơn hàng</option>
                                <option value="Ngày xuất">Theo Ngày xuất (Định dạng: dd/mm/yyyy)</option>
                                <option value="Mã nhà cung cấp">Theo Mã nhà cung cấp</option>
                                <option value="Mã xe">Theo Mã xe</option>
                                <option value="Số lượng xe">Theo Số lượng xe</option>
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
                <a class="btn btn-success px-5 mr-2 btn-lg" href="/index.php?controller=quanli&action=add_order" >Thêm đơn hàng</a>
            </td>
        </tr>
        <tr class="header">
            <td>Mã đơn hàng</td>
            <td>Ngày xuất đơn hàng</td>
            <td>Mã nhà cung cấp</td>
            <td>Mã xe</td>
            <td>Số lượng</td>
            <td>Đơn giá (VND)</td>
            <td>Thuế</td>
            <td>Tác vụ</td>
        </tr>
        <?php
        $data = $result;
        $maDH = '';
        $ngayxuatDH = '';
        $maNCC = '';
        $maxe = '';
        $soLuongXe = '';
        $dongia = '';
        $thue = '';

        $total = count($data);

        foreach ($data as $row) {
            $maDH = $row['maDH'];
            $ngayxuatDH = $row['ngayxuatDH'];
            $maNCC = $row['maNCC'];
            $maxe = $row['maxe'];
            $soLuongXe = $row['soLuongXe'];
            $dongia = $row['dongia'];
            $thue = $row['thue'];
            ?>
            <tr class="item">
                <td><?= $maDH; ?></td>
                <td><?= $ngayxuatDH; ?></td>
                <td><?= $maNCC; ?></td>
                <td><?= $maxe; ?></td>
                <td><?= $soLuongXe; ?></td>
                <td><?= $dongia; ?></td>
                <td><?= $thue; ?></td>
                <?php
                    $data1 = $banhang_controller->get_order_by_maDH($maDH);
                    foreach ($data1 as $row1) {
                        $id = $row1['id'];
                        if ($id == $_SESSION['username']) {
                    ?>
                        <td>
                            <a href="/index.php?controller=quanli&action=add_order&maDH=<?= $maDH; ?>" class="edit">Sửa</a>
                        </td>
                <?php
                        }
                    }
                ?>
            </tr>
            <?php
        }
        ?>
        <tr class="control">
            <td colspan="8">
                <p>Tổng số đơn: <?= $total; ?></p>
            </td>
        </tr>
    </table>
</div>


<!-- Delete Confirm Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Xóa lớp học</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="post">
                <div class="modal-body">
                    <p>Bạn có chắc rằng muốn xóa <strong id="classNameView"></strong> ?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" value="delete_class">
                    <input type="hidden" name="classIdPost" id="classIdPost">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>

        </div>

    </div>
</div>
</body>
</html>
