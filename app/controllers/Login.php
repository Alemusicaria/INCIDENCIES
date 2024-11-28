<?php
// Configuració per mostrar errors en entorn de desenvolupament
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "app/models/login.php"; // Inclou el model de login
require "app/models/PasswordReset.php"; // Inclou el model de recuperació de contrasenya

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

    public function gestionar_usuaris()
    {
        require "app/views/layouts/Forms/V_Todosusuarios.php";
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


    /*************************   RECUPERAR CONTRASENYA   *************************/
    // Mètode per mostrar el formulari de recuperació de contrasenya
    public function show_reset_form()
    {
        require "app/views/layouts/Forms/V_ResetPassword.php";
    }

    // Mètode per enviar el correu de recuperació de contrasenya
    public function send_reset_email()
    {
        $email = $_POST['email'];
        $passwordReset = new PasswordReset();
        $user = $passwordReset->getUserByEmail($email);

        if ($user) {
            $token = $passwordReset->createToken($user['id']);
            $resetLink = "http://aprat.cat/index.php?controller=Login&method=reset_password&token=$token";

            // Enviar correu electrònic amb el link de recuperació
            mail($email, "Recuperació de contrasenya", "Fes clic en aquest enllaç per recuperar la teva contrasenya: $resetLink");

            echo "S'ha enviat un correu electrònic amb les instruccions per recuperar la contrasenya.";
            session_destroy(); // Elimina totes les dades de la sessió actual
            echo "<br><a href='index.php?controller=Login&method=login'>Tornar al formulari de login</a>";
        } else {
            echo "No s'ha trobat cap usuari amb aquest correu electrònic.";
        }
    }
    // Mètode per mostrar el formulari de nova contrasenya
    public function reset_password()
    {
        $token = $_GET['token'];
        $passwordReset = new PasswordReset();
        $resetRequest = $passwordReset->getUserByToken($token);

        if ($resetRequest) {
            require "app/views/layouts/Forms/V_NewPassword.php";
        } else {
            echo "Token de recuperació invàlid.";
        }
    }

    // Mètode per actualitzar la contrasenya
    public function update_password()
    {
        $token = $_POST['token'];
        $newPassword = $_POST['new_password'];
        $passwordReset = new PasswordReset();
        $resetRequest = $passwordReset->getUserByToken($token);

        if ($resetRequest) {
            $passwordReset->updatePassword($resetRequest['user_id'], $newPassword);
            $passwordReset->deleteToken($token);
            echo "La contrasenya s'ha actualitzat correctament.";
            session_destroy(); // Elimina totes les dades de la sessió actual
            echo "<br><a href='index.php?controller=Login&method=login'>Tornar al formulari de login</a>";
        } else {
            echo "Token de recuperació invàlid.";
        }
    }
}
