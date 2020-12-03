<?php
require_once ('config/config.php');

class donhang_model
{
    public static function get_all_orders() {
        $sql = 'select * from donhang';
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

    public static function get_order_by_maDH($maDH) {
        $sql = 'select * from donhang where maDH = ?';
        $db = DB::getDB();

        $stm = $db->prepare($sql);
        $stm->bind_param('i', $maDH);
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

    public static function add_new_order($ngayxuatDH, $tenNCC, $tenXe, $soluongXe, $dongia, $thue, $id) {
        $sql = 'insert into donhang(ngayxuatDH, tenNCC, tenXe, soluongXe, dongia, thue, id) values(?, ?, ?, ?, ?, ?, ?)';
        $db = DB::getDB();

        $stm = $db->prepare($sql);
        $stm->bind_param('sssssss', $ngayxuatDH, $tenNCC, $tenXe, $soluongXe, $dongia, $thue, $id);
        $status = $stm->execute();

        if ($status) {
            return $db->insert_id;
        }
        $stm->close();
        return null;
    }

    public static function update_order($maDH, $ngayxuatDH, $tenNCC, $tenXe, $soluongXe, $dongia, $thue) {
        $sql = 'update donhang set ngayxuatDH = ?, tenNCC = ?, tenXe = ?, soluongXe = ?, dongia = ?, thue = ? where maDH = ?';
        $db = DB::getDB();

        $stm = $db->prepare($sql);
        $stm->bind_param('ssssssi', $ngayxuatDH, $tenNCC, $tenXe, $soluongXe, $dongia, $thue, $maDH);
        $status = $stm->execute();

        if ($status) {
            return 0;
        }
        $stm->close();
        return null;
    }

    public static function search_ngayxuatDH($ngayxuatDH) {
        $sql = "select DISTINCT * from donhang where ngayxuatDH = ?";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        $stm->bind_param('s', $ngayxuatDH);
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

    public static function search_tenNCC($tenNCC) {
        $sql = "select * from donhang where tenNCC like concat('%', ?, '%')";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        $stm->bind_param('s', $tenNCC);

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

    public static function search_tenXe($tenXe) {
        $sql = "select * from donhang where tenXe like concat('%', ?, '%')";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        $stm->bind_param('s', $tenXe);

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

    public static function search_soLuongXe($soLuongXe) {
        $sql = "select * from donhang where soLuongXe = ?";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        $stm->bind_param('i', $soLuongXe);

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