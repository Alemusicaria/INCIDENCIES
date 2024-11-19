<?php
require "app/models/login.php";

class LoginController
{
    // Constructor per validar si l'usuari està logejat
    public function __construct()
    {
        // Comprovar si l'usuari està logejat
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?controller=Login&method=login");
            exit;
        }
    }

    // Mètode per verificar el login
    public function verificar_login()
    {
        $login = new Login();
        if ($login->Verificar_Login()) {
            // Si el login és correcte, redirigeix a la pàgina de benvinguda
            header("Location: index.php?controller=Login&method=bienvenido");
            exit;
        } else {
            // Si hi ha un error, redirigeix al formulari de login
            header("Location: index.php?controller=Login&method=login");
            exit;
        }
    }

    // Mètode per mostrar el formulari de login
    public function login()
    {
        require "app/views/layouts/Forms/V_Login.php";
    }

    // Mètode per mostrar la pàgina de benvinguda després de login correcte
    public function bienvenido()
    {
        require "app/views/layouts/Forms/V_Inicio.php";
    }

    // Mètode per mostrar les incidències de l'usuari
    public function incidencies()
    {
        require "app/views/layouts/Forms/V_Misincidencias.php";
    }

    /*************************  XAT  *************************/

    // Mètode per mostrar la llista de xats
    public function xat()
    {
        require "app/views/xat/xat.php";
    }

    // Mètode per mostrar els detalls d'un xat específic
    public function xat_detall()
    {
        // Comprovar si s'ha passat un id de xat per l'URL i si és numèric
        if (isset($_GET['xat_id']) && is_numeric($_GET['xat_id'])) {
            $xat_id = $_GET['xat_id'];

            // Passar l'ID del xat a la vista
            require "app/views/xat/xat_detall.php";
        } else {
            // Si no es passa un id de xat vàlid, redirigir a la pàgina principal de xats
            header("Location: index.php?controller=Login&method=xat");
            exit;
        }
    }

    // Mètode per mostrar els detalls d'un grup
    public function grup_detall()
    {
        $grup_id = isset($_GET['grup_id']) ? $_GET['grup_id'] : null;

        if ($grup_id) {
            // Carregar la vista del grup detall
            require "app/views/xat/grup_detall.php";
        } else {
            // Si no hi ha grup_id, redirigeix a la pàgina principal de xats
            header("Location: index.php?controller=Login&method=xat");
            exit;
        }
    }

    // Mètode per tancar la sessió
    public function cerrar_sesion()
    {
        session_destroy();
        header("Location: index.php?controller=Login&method=login");
        exit;
    }
}
