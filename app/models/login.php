<?php

class login
{
    public function verificar_login()
    {
        $email = $_POST['email'];
        $contraseña = $_POST['password'];

        $mysql = new mysqli("localhost", "root", "", "mvc");

        if ($mysql->connect_error) {
            die('Problemas con la conexión a la base de datos');
        }

        if (empty($email) || empty($contraseña)) {
            $_SESSION['error'] = "Por favor, completa todos los campos.";
            return false;
        }

        $result = $mysql->query("SELECT * FROM usuarios WHERE email = '$email'");

        if ($result->num_rows === 0) {
            $_SESSION['error'] = "Usuario no encontrado.";
            return false;
        } else {
            $usuario = $result->fetch_assoc();
            if (password_verify($contraseña, $usuario['contraseña'])) {
                // Login exitoso
                $_SESSION['usuario'] = $usuario['nombre']; 
                return true;
            } else {
                $_SESSION['error'] = "Contraseña incorrecta.";
                return false;
            }
        }
    }

}