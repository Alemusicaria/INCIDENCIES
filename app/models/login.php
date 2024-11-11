<?php

class Login
{
    public function verificar_login()
    {
        
        $email = $_POST['email'];
        $contraseña = $_POST['password'];

        $mysql = new mysqli("localhost", "root", "", "incidencies");

        if ($mysql->connect_error) {
            die('Problemas con la conexión a la base de datos');
        }

        if (empty($email) || empty($contraseña)) {
            $_SESSION['error'] = "Por favor, completa todos los campos.";
            return false;
        }

        $result = $mysql->query("SELECT * FROM usuaris WHERE correu = '$email'");

        if ($result->num_rows === 0) {
            $_SESSION['error'] = "Usuario no encontrado.";
            return false;
        } else {
            $usuario = $result->fetch_assoc();
            if ($contraseña=$usuario['contrasenya']) {
                // Login exitoso
                $_SESSION['usuario'] = $usuario['nom_cognoms']; 
                return true;
            } else {
                $_SESSION['error'] = "Contraseña incorrecta.";
                return false;
            }
                
           
        }
    }

}