<?php
require "app/models/login.php";


class LoginController
{
    public function verificar_login()
    {
        $login = new login();
        if ($login->Verificar_Login()) {
            // Si el login es exitoso, redirige a la página de inicio
            header( "Location: index.php?controller=Login&method=bienvenido" );
            exit;
        } else {
            // Si hubo un error, redirige al formulario de login
            header("Location: index.php?controller=Login&method=login");
            exit;
        }
    }

    public function login()
    {
        require "app/views/layouts/Forms/V_Login.php";
    }

    public function bienvenido()
    {
        require "app/views/layouts/Forms/V_Inicio.php";
    }
}