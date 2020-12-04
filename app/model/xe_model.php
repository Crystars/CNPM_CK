<?php
require_once ('config/config.php');

class xe_model
{

    public static function get_all_xe() {

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

    public static function get_xe_by_id($maxe)
    {
        $sql = "SELECT * FROM xe WHERE maxe = ? and state = 1";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        $stm->bind_param('s', $maxe);
        $status = $stm->execute();

        if ($status) {
            $result = $stm->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            }
        } else {
            die("Query error: " . $stm->error);
            $stm->close();
            return null;
        }
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


    public static function set_xe_state_by_id($maxe, $state = 0){

        $sql = "update xe set state = ? where maxe = ?";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        $stm->bind_param('is', $state,$maxe);
        $status = $stm->execute();

        if($status) {
            return 0;
        }
        $stm->close();
        return null;
    }

    public static function check_xe_exist($maxe){

        $sql = "select * from xe where maxe = ?";
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


    public static function add_xe($maxe, $tenxe, $mota, $baohanh, $maNCC, $soluongkho, $dongia, $state = 1){
        if (xe_model::check_xe_exist($maxe)!=0){
            return null;
        }
        $sql = 'INSERT INTO xe(maxe, tenxe, mota, baohanh, maNCC, soluongkho, dongia, state) VALUES(?,?,?,?,?,?,?,?)';
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        if ($stm === False){
            return array('code' => 4, 'error' => 'something wrong');
        }
        $stm->bind_param('sssssiii',$maxe, $tenxe, $mota, $baohanh, $maNCC, $soluongkho, $dongia, $state);
        $status = $stm->execute();

        if($status) {
            return 0;
        }
        $stm->close();
        return null;
    }

    public static function get_sum_soluongkho() {
        $sql = 'select sum(soluongkho) as soLuongXeTon from xe where state = 1';
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

    public static function update_xe($maxe, $tenxe, $mota, $baohanh, $maNCC, $soluongkho, $dongia){
        $sql = 'UPDATE xe set tenxe=?, mota=?, baohanh=?, maNCC=?, soluongkho=?, dongia=? where maxe = ?';
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        if ($stm === False){
            return array('code' => 4, 'error' => 'something wrong');
        }
        $stm->bind_param('sssssis',$tenxe, $mota, $baohanh, $maNCC, $soluongkho, $dongia, $maxe);
        $status = $stm->execute();
        if($status) {
            return 0;
        }
        $stm->close();
        return null;
    }

    public static function update_xe_soluongkho($maxe, $soluongkho)
    {
        $sql = 'UPDATE xe set soluongkho = soluongkho+? where maxe = ?';
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        if ($stm === False) {
            return array('code' => 4, 'error' => 'something wrong');
        }
        $stm->bind_param('is', $soluongkho, $maxe);
        $status = $stm->execute();
        if ($status) {
            return 0;
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


    public static function search_xe_by_tenxe($tenxe){
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