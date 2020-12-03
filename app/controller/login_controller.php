<?php
require_once ('base_controller.php');


class login_controller extends base_controller
{
    function __construct() {
        $this->name = 'login';
    }

    function index()
    {
        $this->process('login', array());
    }

    public static function login($user,$pass){
        return user_model::login($user,$pass);
    }
}