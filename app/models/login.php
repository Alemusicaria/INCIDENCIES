<?php

class Login
{
    public function Verificar_Login()
    {
        
        $email = $_POST['username'];
        $contraseña = $_POST['password'];

        $mysql = new mysqli("localhost", "apratc_aprat", "AleixSteveLeandro123", "apratc_Incidencies");

        if ($mysql->connect_error) {
            die('Problemas con la conexión a la base de datos');
        }

        $result = $mysql->query("SELECT * FROM usuaris WHERE correu = '$email'");

        if ($result->num_rows === 0) {
            $_SESSION['error'] = "Usuario no encontrado.";
            return false;
        } else {
            $usuario = $result->fetch_assoc();
            if (password_verify($contraseña, $usuario['contrasenya'])) {
                // Login exitoso
                $_SESSION['usuario'] = $usuario['nom_cognoms'];
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['rol'] = $usuario['rol'];

                return true;
            } else {
                $_SESSION['error'] = "Contraseña incorrecta.";
                return false;
            }    
        }
    }

   

}