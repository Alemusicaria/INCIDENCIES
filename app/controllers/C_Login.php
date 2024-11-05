<?php
include "app/models/M_Login.php";

class C_LoginController
{
    public function Verificar_Login()
    {
        $login = new M_Login();
        $login->verificar_login();
    }
}