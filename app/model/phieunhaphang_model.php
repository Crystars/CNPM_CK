<?php
require_once ('config/config.php');


class phieunhaphang_model
{
    public static function get_import_by_month($ngayNhap) {
        $sql = "select * from phieunhaphang where MONTH(ngayNhap) = ?";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        $stm->bind_param('s', $ngayNhap);

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

    public static function get_import_by_year($ngayNhap) {
        $sql = "select * from phieunhaphang where YEAR(ngayNhap) = ?";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        $stm->bind_param('s', $ngayNhap);

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
}