<?php
require_once ('base_controller.php');

class kho_controller extends base_controller
{
    function __construct() {
        $this->name = 'kho';
    }

    public function index() {
        $this->process('phieunhaphang',array());
    }
    public function kho() {
        $this->process('phieunhaphang',array());
    }

    public function them_kho($id) {
        $this->process('themphieunhaphang',array($id));
    }

    public function nhacungcap() {
        $this->process('nhacungcap',array());
    }

    public function them_nhacungcap($id) {
        $this->process('themnhacungcap',array($id));
    }

    public static function get_user_by_id($id){
        return user_model::get_user_by_id($id);
    }

    public static function get_all_phieunhaphang() {
        return phieunhaphang_model::get_all_phieunhaphang();
    }

    public static function get_phieunhaphang_by_id($maPhieuNH){
        return phieunhaphang_model::get_phieunhaphang_by_id($maPhieuNH);
    }

    public static function add_phieunhaphang($ngayNhap, $nvLap, $maNCC, $maxe, $soluong, $dongia, $thue, $state = 0){
        return phieunhaphang_model::add_phieunhaphang($ngayNhap, $nvLap, $maNCC, $maxe, $soluong, $dongia, $thue, $state);
    }

    public static function update_phieunhaphang($maPhieuNH, $ngayNhap, $nvLap, $maNCC, $maxe, $soluong, $dongia, $thue, $state = 1){
        return phieunhaphang_model::update_phieunhaphang($maPhieuNH, $ngayNhap, $nvLap, $maNCC, $maxe, $soluong, $dongia, $thue, $state);
    }

    public static function get_all_nhacungcap() {
        return nhacungcap_model::get_all_nhacungcap();
    }

    public static function get_nhacungcap_by_id($id){
        return nhacungcap_model::get_nhacungcap_by_id($id);
    }

    public static function set_nhacungcap_state_by_id($id){
        return nhacungcap_model::set_nhacungcap_state_by_id($id);
    }

    public static function add_nhacungcap($maNCC,$tenNCC,$sdt,$diachi, $state = 1){
        return nhacungcap_model::add_nhacungcap($maNCC,$tenNCC,$sdt,$diachi,$state);
    }

    public static function update_nhacungcap($maNCC, $tenNCC, $sdt, $diachi){
        return nhacungcap_model::update_nhacungcap($maNCC, $tenNCC, $sdt, $diachi);
    }
}