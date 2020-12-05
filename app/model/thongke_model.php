<?php
require_once ('config/config.php');

class thongke_model
{
    public static function get_all_statistics() {
        $sql = 'select * from thongke';
        $db = DB::getDB();

        $stm = $db->prepare($sql);
        $status = $stm->execute();

        if ($status) {
            $result = $stm->get_result();
            $data = array();
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
            return $data;
        }
        $stm->close();
        return null;
    }

    public static function search_statistics_by_maTK($maTK) {
        $sql = 'select * from thongke where maTK = ?';
        $db = DB::getDB();

        $stm = $db->prepare($sql);
        $stm->bind_param('i', $maTK);
        $status = $stm->execute();

        if ($status) {
            $result = $stm->get_result();
            $data = array();
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
            return $data;
        }
        $stm->close();
        return null;
    }

    public static function search_statistics_by_loaiTK($loaiTK) {
        $sql = "select * from thongke where loaiTK like concat('%', ?, '%')";
        $db = DB::getDB();

        $stm = $db->prepare($sql);
        $stm->bind_param('s', $loaiTK);
        $status = $stm->execute();

        if ($status) {
            $result = $stm->get_result();
            $data = array();
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
            return $data;
        }
        $stm->close();
        return null;
    }

    public static function add_new_statistic($loaiTK, $thoigianLap, $soLuongXeNhap, $soLuongXeBan,
                                             $soLuongXeTon, $tongTienNhap, $tongTienBan) {
        $sql = 'insert into thongke(loaiTK, thoigianLap, soLuongXeNhap, soLuongXeBan, 
                soLuongXeTon, tongTienNhap, tongTienBan) values (?, ?, ?, ?, ?, ?, ?)';
        $db = DB::getDB();

        $stm = $db->prepare($sql);
        $tongTienNhap = strval(number_format($tongTienNhap));
        $tongTienBan = strval(number_format($tongTienBan));
        $stm->bind_param('ssiiiss', $loaiTK, $thoigianLap, $soLuongXeNhap, $soLuongXeBan,
                                            $soLuongXeTon, $tongTienNhap, $tongTienBan);
        $status = $stm->execute();

        if ($status) {
            return 0;
        }
        $stm->close();
        return null;
    }
}