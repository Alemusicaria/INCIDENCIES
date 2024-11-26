<?php
// Configuració per mostrar errors en entorn de desenvolupament
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "app/models/login.php"; // Inclou el model de login

class LoginController
{

    /**
     * Mètode per verificar el login.
     * Si l'usuari introdueix credencials correctes, redirigeix a la pàgina de benvinguda.
     * En cas contrari, redirigeix al formulari de login.
     */
    public function verificar_login()
    {
        $login = new Login();
        if ($login->Verificar_Login()) {
            header("Location: index.php?controller=Login&method=bienvenido"); // Redirigeix a la pàgina de benvinguda
            exit;
        } else {
            header("Location: index.php?controller=Login&method=login"); // Redirigeix al formulari de login
            exit;
        }
    }


    /**
     * Mètode per mostrar el formulari de login.
     */
    public function login()
    {
        require "app/views/layouts/Forms/V_Login.php";
    }

    /**
     * Mètode per mostrar la pàgina de benvinguda.
     */
    public function bienvenido()
    {
        require "app/views/layouts/Forms/V_Inicio.php";
    }

    /**
     * Mètode per mostrar les incidències associades a l'usuari.
     */
    public function incidencies()
    {
        require "app/views/layouts/Forms/V_Misincidencias.php";
    }

    public function totes_incidencies()
    {
        require "app/views/layouts/Forms/V_Todasincidencias.php";
    }
    /*************************  XAT  *************************/

    /**
     * Mètode per mostrar la llista de xats disponibles.
     */
    public function xat()
    {
        require "app/views/xat/xat.php";
    }

    /**
     * Mètode per mostrar els detalls d'un xat específic.
     * Si no es passa un `xat_id`, redirigeix a la pàgina principal de xats.
     */
    public function xat_detall()
    {
        $xat_id = isset($_GET['xat_id']) ? $_GET['xat_id'] : null;

        if ($xat_id) {
            require "app/views/xat/xat_detall.php"; // Carrega la vista amb els detalls del xat
        } else {
            header("Location: index.php?controller=Login&method=xat");
            exit;
        }
    }

    /**
     * Mètode per mostrar els detalls d'un grup específic.
     * Si no es passa un `grup_id`, redirigeix a la pàgina principal de xats.
     */
    public function grup_detall()
    {
        $grup_id = isset($_GET['grup_id']) ? $_GET['grup_id'] : null;

        if ($grup_id) {
            require "app/views/xat/grup_detall.php"; // Carrega la vista amb els detalls del grup
        } else {
            header("Location: index.php?controller=Login&method=xat");
            exit;
        }
    }

    /**
     * Mètode per tancar la sessió de l'usuari.
     * Destrueix la sessió i redirigeix al formulari de login.
     */
    public function cerrar_sesion()
    {
        session_destroy(); // Elimina totes les dades de la sessió actual
        header("Location: index.php?controller=Login&method=login");
        exit;
    }
}
