<?php

require("Models/M_Login.php");

class C_Login
{
    public function verificar_login()
    {
        $login = new login();
        if ($login->verificar_login()) {
            // Si el login es exitoso, redirige a la página de inicio
            header( "Location: /index.php?controller=Login&method=bienvenido" );
            exit;
        } else {
            // Si hubo un error, redirige al formulario de login
            header("Location: /index.php?controller=Login&method=login");
            exit;
        }
    }

    public function login()
    {
        require 'app/views/formularios/V_Login.php';
    }

    public function bienvenido()
    {
        require 'app/views/formularios/V_Principal.php';
    }

    public function cerrar_sesion()
    {
        session_destroy();
        header("Location: /index.php?controller=Login&method=login");
        exit;
    }
}