<?php

class Login
{
    public function Verificar_Login()
    {

        $email = $_POST['username'];
        $contraseña = $_POST['password'];

        require_once 'app\models\connexio.php';

        $result = $conn->query("SELECT * FROM usuaris WHERE correu = '$email'");

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
