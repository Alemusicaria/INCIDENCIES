<?php

require("Models/incidencia.php");

class C_Login {
    
    public function __construct() {
    }

    public function mostrarLogin() {
        require_once("Views/Formularios/V_Login.php");
    }
    public function login()
    {
        if ($_POST) {
            $data = [
                'nom_usuari' => $_POST['nom_usuari'],
                'contraseña' => $_POST['contraseña']
            ];

            // Instanciar el model Usuari i cridar a la funció de verificació de login
            $incidencia = new incidencia();
            if ($incidencia->login($data)) {
                // Si les credencials són correctes, iniciar sessió
                session_start();
                $_SESSION['nom_usuari'] = $data['nom_usuari'];
                header("Location: index.php?controller=incidencia&method=mostrar");
            } else {
                // Mostrar un missatge d'error
                echo "Nom d'usuari o contrasenya incorrectes.";
            }
        }
    }
}

?>