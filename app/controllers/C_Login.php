<?php

require("models/incidencia.php");

class C_Login {
    
    public function __construct() {
    }

    public function mostrarLogin() {
        require_once("views/Forms/V_Login.php");
    }
    public function login()
    {
        if ($_POST) {
            $data = [
                'correu' => $_POST['correu'],
                'contrasenya' => $_POST['contrasenya']
            ];

            // Instanciar el model Usuari i cridar a la funció de verificació de login
            $incidencia = new incidencia();
            if ($incidencia->login($data)) {
                // Si les credencials són correctes, iniciar sessió
                session_start();
                $_SESSION['correu'] = $data['correu'];
                header("Location: index.php?controller=incidencia&method=mostrar");
            } else {
                // Mostrar un missatge d'error
                echo "Nom d'usuari o contrasenya incorrectes.";
            }
        }
    }
}

?>