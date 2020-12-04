<?php
require_once ('base_controller.php');

class quanli_controller extends base_controller
{
    function __construct() {
        $this->name = 'quanli';
    }

    public function index() {
        $this->process('thuchi',array());
    }

    public function thuchi() {
        $this->process('thuchi', array());
    }

    public function add_statistic() {
        $this->process('add_statistic', array());
    }

    public function get_all_statistics() {
        return thongke_model::get_all_statistics();
    }

    public function get_import_by_month($ngayNhap) {
        return phieunhaphang_model::get_import_by_month($ngayNhap);
    }

    public function get_import_by_year($ngayNhap) {
        return phieunhaphang_model::get_import_by_year($ngayNhap);
    }

    public function get_order_by_month($ngayxuatDH) {
        return donhang_model::get_order_by_month($ngayxuatDH);
    }

    public function get_order_by_year($ngayxuatDH) {
        return donhang_model::get_order_by_year($ngayxuatDH);
    }

    public function get_sum_soluongkho() {
        return xe_model::get_sum_soluongkho();
    }

    public function search_statistics_by_maTK($maTK) {
        return thongke_model::search_statistics_by_maTK($maTK);
    }

    public function search_statistics_by_loaiTK($loaiTK) {
        return thongke_model::search_statistics_by_loaiTK($loaiTK);
    }

    public function add_new_statistic($loaiTK, $thoigianLap, $soLuongXeNhap, $soLuongXeBan,
                                      $soLuongXeTon, $tongTienNhap, $tongTienBan) {
        return thongke_model::add_new_statistic($loaiTK, $thoigianLap, $soLuongXeNhap, $soLuongXeBan,
            $soLuongXeTon, $tongTienNhap, $tongTienBan);
    }


    public function them_user($id) {
        $this->process('themnhanvien',array($id));
    }

    public function thongtinxe() {
        $this->process('thongtinxe',array());
    }

    public function them_thongtinxe($id) {
        $this->process('themthongtinxe',array($id));
    }

    public function nhacungcap() {
        $this->process('nhacungcap',array());
    }

    public function them_nhacungcap($id) {
        $this->process('themnhacungcap',array($id));
    }


    public function banhang() {
        $this->process('banhang',array());
    }

    public function them_banhang($id) {
        $this->process('thembanhang',array($id));
    }

    public function kho() {
        $this->process('phieunhaphang',array());
    }

    public function them_kho($id) {
        $this->process('themphieunhaphang',array($id));
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

    public static function get_all_xe() {
        return xe_model::get_all_xe();
    }

    public static function get_xe_by_id($maxe){
        return xe_model::get_xe_by_id($maxe);
    }

    public static function set_xe_state_by_id($maxe, $state = 0){
        return xe_model::set_xe_state_by_id($maxe, $state);
    }

    public static function add_xe($maxe, $tenxe, $mota, $baohanh, $maNCC, $soluongkho, $dongia, $state = 1){
        return xe_model::add_xe($maxe, $tenxe, $mota, $baohanh, $maNCC, $soluongkho, $dongia, $state );
    }

    public static function update_xe($maxe, $tenxe, $mota, $baohanh, $maNCC, $soluongkho, $dongia){
        return xe_model::update_xe($maxe, $tenxe, $mota, $baohanh, $maNCC, $soluongkho, $dongia);
    }

    public static function search_xe_by_tenxe($tenxe) {
        return xe_model::search_xe_by_tenxe($tenxe);
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
}