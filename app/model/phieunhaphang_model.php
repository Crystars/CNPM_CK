<?php
require_once ('config/config.php');
require_once ('app/model/xe_model.php');

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
    public static function get_all_phieunhaphang() {
        $sql = 'select * from phieunhaphang';
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

    public static function get_phieunhaphang_by_id($maPhieuNH){
        $sql = "SELECT * FROM phieunhaphang WHERE maPhieuNH = ?";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        $stm->bind_param('s', $maPhieuNH);
        $status = $stm->execute();

        if($status) {
            $result = $stm->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            }
        }else {
            die("Query error: " . $stm->error);
        }
        $stm->close();
        return null;
    }

    public static function check_phieunhaphang_exist($maPhieuNH){

        $sql = "select * from phieunhaphang where maPhieuNH = ?";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        $stm->bind_param('s',$maxe);
        $status = $stm->execute();
        if($status) {
            $result = $stm->get_result();
            if ($result->num_rows > 0) {
                return 0;
            }
        }
        $stm->close();
        return null;

    }

    public static function add_phieunhaphang($ngayNhap, $nvLap, $maNCC, $maxe, $soluong, $dongia, $thue, $state = 0){
        $sql = 'INSERT INTO phieunhaphang(ngayNhap, nvLap, maNCC, maxe, soluong, dongia, thue, state) VALUES(?,?,?,?,?,?,?,?)';
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        if ($stm === False){
            return array('code' => 4, 'error' => 'something wrong');
        }
        $dongia = number_format($dongia);
        $stm->bind_param('ssssissi', $ngayNhap, $nvLap, $maNCC, $maxe, $soluong, $dongia, $thue, $state);
        $status = $stm->execute();

        if($status) {
            return 0;
        }
        $stm->close();
        return null;
    }

    public static function update_phieunhaphang($maPhieuNH, $ngayNhap, $nvLap, $maNCC, $maxe, $soluong, $dongia, $thue, $state = 1){
        $sql = 'UPDATE phieunhaphang set ngayNhap=?, nvLap=?, maNCC=?, maxe=?, soluong=?, dongia=?, thue=?, state=? where maPhieuNH = ?';
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        if ($stm === False){
            return array('code' => 4, 'error' => 'something wrong');
        }

        $stm->bind_param('ssssissii',$ngayNhap,$nvLap,$maNCC, $maxe, $soluong, $dongia, $thue, $state, $maPhieuNH);
        $status = $stm->execute();
        if($status) {
            if (xe_model::update_xe_soluongkho($maxe, $soluong)===0){
                return 0;
            }
        }
        $stm->close();
        return null;
    }

}