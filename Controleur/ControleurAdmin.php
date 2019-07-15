<?php
require_once 'Vue/Vue.php';
require_once 'Modele/Login.php';

class ControleurAdmin
{
    private $login;

    public function __construct()
    {
        $this->login = new Login();
    }

}