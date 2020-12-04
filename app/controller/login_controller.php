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

    function logout(){
        $this->process('logout', array());
    }

    public static function login($user,$pass){
        return user_model::login($user,$pass);
    }
}