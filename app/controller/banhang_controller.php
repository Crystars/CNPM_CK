<?php
require_once ('base_controller.php');

class banhang_controller extends base_controller
{
    function __construct() {
        $this->name = 'banhang';
    }

    public function index() {
        $this->process('list_order',array());
    }

    public function list_car_info() {
        $this->process('list_car_info', array());
    }

    public function add_order() {
        $this->process('add_order', array());
    }

    public function detail_car_info() {
        $this->process('detail_car_info', array());
    }

    public function get_all_orders() {
        return donhang_model::get_all_orders();
    }

    public function get_order_by_maDH($maDH) {
        return donhang_model::get_order_by_maDH($maDH);
    }

    public function get_all_cars() {
        return xe_model::get_all_cars();
    }

    public function add_new_order($ngayxuatDH, $tenNCC, $tenXe, $soluongXe, $dongia, $thue, $id) {
        return donhang_model::add_new_order($ngayxuatDH, $tenNCC, $tenXe, $soluongXe, $dongia, $thue, $id);
    }

    public function update_order($maDH, $ngayxuatDH, $tenNCC, $tenXe, $soluongXe, $dongia, $thue) {
        return donhang_model::update_order($maDH, $ngayxuatDH, $tenNCC, $tenXe, $soluongXe, $dongia, $thue);
    }

    public function search_ngayxuatDH($ngayxuatDH) {
        return donhang_model::search_ngayxuatDH($ngayxuatDH);
    }

    public function search_maNCC_donhang_model($maNCC) {
        return donhang_model::search_maNCC($maNCC);
    }

    public function search_maxe_donhang_model($maxe) {
        return donhang_model::search_maxe($maxe);
    }

    public function search_soLuongXe($soLuongXe) {
        return donhang_model::search_soLuongXe($soLuongXe);
    }

    public function get_car_by_maxe($maxe) {
        return xe_model::get_car_by_maxe($maxe);
    }

    public function search_maNCC($maNCC) {
        return xe_model::search_maNCC($maNCC);
    }

    public function search_tenxe_xe_model($tenxe) {
        return xe_model::search_tenxe($tenxe);
    }
}