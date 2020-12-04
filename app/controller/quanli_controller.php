<?php
require_once ('base_controller.php');

class quanli_controller extends base_controller
{
    function __construct() {
        $this->name = 'quanli';
    }

    public function index() {
        $this->process('nhanvien',array());
    }

    public function them_user($id) {
        $this->process('themnhanvien',array($id));
    }

    public static function get_all_users() {
        return user_model::get_all_users();
    }

    public static function get_user_by_id($id){
        return user_model::get_user_by_id($id);
    }

    public static function set_state_by_id($id){
        return user_model::set_state_by_id($id);
    }

    public static function add_user($id, $pass, $ten, $gioitinh, $namsinh, $diachi, $sdt, $chucvu, $luongcb, $state = 1){
        return user_model::add_user($id, $pass, $ten, $gioitinh, $namsinh, $diachi, $sdt, $chucvu, $luongcb, $state = 1);
    }

    public static function update_user($id, $name, $gender, $address, $phone, $chucvu, $luongcb){
        return user_model::update_user($id, $name, $gender, $address, $phone, $chucvu, $luongcb);
    }
}