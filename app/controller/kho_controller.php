<?php
require_once ('base_controller.php');

class kho_controller extends base_controller
{
    function __construct() {
        $this->name = 'kho';
    }

    public function index() {
        $this->process('kho',array());
    }
}