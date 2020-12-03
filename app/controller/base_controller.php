<?php
require_once ('app/model/donhang_model.php');
require_once ('app/model/nhacungcap_model.php');
require_once ('app/model/phieunhaphang_model.php');
require_once ('app/model/thongke_model.php');
require_once ('app/model/user_model.php');
require_once ('app/model/xe_model.php');

class base_controller
{
    protected $name;

    public function process($view,$data){
        require_once('app/view/' . $this->name . '/' . $view . '.php');
    }
}