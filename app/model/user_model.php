<?php
require_once ('config/config.php');

class user_model
{
    public static function login($id,$pass){
        $sql = "SELECT * FROM user WHERE id = ?";
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        if ($stm === False){
            return array('code' => 3, 'message' => 'sql code wrong');
        }
        $stm->bind_param('s',$id);
        $status = $stm->execute();

        if ($status) {
            $result = $stm->get_result();
            if ($result->num_rows == 0) {
                return array('code' => 2, 'error' => 'User does not exist'); //không có user nào tồn tại
            }else {
                $data = mysqli_fetch_assoc($result);
                $hashed_pass = $data['pass'];
                echo password_hash($pass, PASSWORD_DEFAULT);
                if (!password_verify($pass, $hashed_pass)) {
                    return array('code' => 3, 'error' => 'Invalid password');
                }
                else {
                    $permission = $data['chucvu'];
                    return array('code' => 0, 'message' => '', 'data' => $permission);
                }
            }
        }
        $stm->close();
        return null;
    }

    public static function get_all_users() {
        $sql = 'select * from user';
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

    public static function get_user_by_id($id){
        $sql = "SELECT * FROM user WHERE id = ? and state =1";
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

    public static function set_state_by_id($id, $state = 0){
        $sql = "update user set state = ? where id = ?";
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

    public static function check_user_exist($id){
        $sql = "select * from user where id = ?";
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


    public static function add_user($id, $pass, $ten, $gioitinh, $namsinh, $diachi, $sdt, $chucvu, $luongcb, $state = 1){
        if (user_model::check_user_exist($id)!=0){
            return null;
        }
        $sql = 'INSERT INTO user(id, pass, ten, gioitinh, namsinh, diachi, sdt, chucvu, luongcb, state) VALUES(?,?,?,?,?,?,?,?,?,?)';
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        if ($stm === False){
            return array('code' => 4, 'error' => 'something wrong');
        }
        $stm->bind_param('ssssssssii',$id, $pass, $ten, $gioitinh, $namsinh, $diachi, $sdt, $chucvu, $luongcb, $state);
        $status = $stm->execute();

        if($status) {
            return 0;
        }
        $stm->close();
        return null;
    }


    public static function update_user($id, $name, $gender, $address, $phone, $chucvu, $luongcb){
        $sql = 'UPDATE user set ten=?, gioitinh=?, diachi=?, sdt=?, chucvu=?, luongcb=? where id = ?';
        $db = DB::getDB();
        $stm = $db->prepare($sql);
        if ($stm === False){
            return array('code' => 4, 'error' => 'something wrong');
        }
        $stm->bind_param('sssssis',$name, $gender, $address, $phone, $chucvu, $luongcb, $id);
        $status = $stm->execute();
        if($status) {
            return 0;
        }
        $stm->close();
        return null;
    }
}