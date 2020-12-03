<?php
require_once ('config/config.php');

class xe_model
{
    public static function get_all_cars() {
        $sql = 'select * from xe';
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

    public static function get_car_by_maxe($maxe) {
        $sql = "select * from xe where maxe like concat('%', ?, '%')";
        $db = DB::getDB();

        $stm = $db->prepare($sql);
        $stm->bind_param('s', $maxe);
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

    public static function search_maNCC($maNCC) {
        $sql = "select * from xe where maNCC like concat('%', ?, '%')";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        $stm->bind_param('s', $maNCC);

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

    public static function search_tenxe($tenxe) {
        $sql = "select * from xe where tenxe like concat('%', ?, '%')";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        $stm->bind_param('s', $tenxe);

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