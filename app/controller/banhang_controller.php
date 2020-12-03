<?php
require_once ('base_controller.php');

class banhang_controller extends base_controller
{
    function __construct() {
        $this->name = 'banhang';
    }

    public function index() {
        $this->process('banhang_view',array());
    }
}