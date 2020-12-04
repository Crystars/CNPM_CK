<?php
require_once ('config/config.php');


class nhacungcap_model
{
    public static function get_all_nhacungcap() {
        $sql = 'select * from nhacungcap';
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

    public static function get_nhacungcap_by_id($id){
        $sql = "SELECT * FROM nhacungcap WHERE maNCC = ? and state =1";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        $stm->bind_param('s', $id);
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

    public static function set_nhacungcap_state_by_id($id, $state = 0){
        $sql = "update nhacungcap set state = ? where maNCC = ?";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        $stm->bind_param('is', $state,$id);
        $status = $stm->execute();

        if($status) {
            return 0;
        }
        $stm->close();
        return null;
    }

    public static function check_nhacungcap_exist($id){
        $sql = "select * from nhacungcap where maNCC = ?";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        $stm->bind_param('s',$id);
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


    public static function add_nhacungcap($maNCC, $tenNCC, $sdt, $diachi, $state = 1){
        if (nhacungcap_model::check_nhacungcap_exist($maNCC)!=0){
            return null;
        }
        $sql = 'INSERT INTO nhacungcap(maNCC, tenNCC, sdt, diachi, state) VALUES(?,?,?,?,?)';
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        if ($stm === False){
            return array('code' => 4, 'error' => 'something wrong');
        }
        $stm->bind_param('ssssi',$maNCC, $tenNCC, $sdt, $diachi, $state);
        $status = $stm->execute();

        if($status) {
            return 0;
        }
        $stm->close();
        return null;
    }

    public static function update_nhacungcap($maNCC, $tenNCC, $sdt, $diachi){
        $sql = 'UPDATE nhacungcap set tenNCC=?, sdt=?, diachi=? where maNCC = ?';
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        if ($stm === False){
            return array('code' => 4, 'error' => 'something wrong');
        }
        $stm->bind_param('ssss',$tenNCC, $sdt, $diachi, $maNCC);
        $status = $stm->execute();

        if($status) {
            return 0;
        }
        $stm->close();
        return null;
    }
}