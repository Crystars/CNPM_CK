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
        return array('code' => 1, 'message' => 'something wrong');
    }

}