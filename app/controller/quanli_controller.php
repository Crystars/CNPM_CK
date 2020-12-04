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

}