<?php

class Login
{
    // Funció per verificar les credencials d'un usuari
    public function Verificar_Login()
    {

        // Obtenim les dades enviades pel formulari de login
        $email = $_POST['username'];  // Correu electrònic de l'usuari
        $contraseña = $_POST['password'];  // Contrasenya de l'usuari

        // Incloem el fitxer de connexió a la base de dades
        require_once('app/models/connexio.php');

        // Consulta per obtenir les dades de l'usuari a partir del correu electrònic
        $result = $conn->query("SELECT * FROM usuaris WHERE correu = '$email'");

        // Comprovem si s'ha trobat l'usuari
        if ($result->num_rows === 0) {
            // Si l'usuari no existeix, s'assigna un missatge d'error a la sessió
            $_SESSION['error'] = "Usuario no encontrado.";
            return false;  // Retorna false perquè el login ha fallat
        } else {
            // Si l'usuari existeix, comprovem la contrasenya
            $usuario = $result->fetch_assoc();

            // Comprovem si la contrasenya introduïda coincideix amb la de la base de dades
            if (password_verify($contraseña, $usuario['contrasenya'])) {
                // Si la contrasenya és correcta, s'inicia sessió
                $_SESSION['usuario'] = $usuario['nom_cognoms'];  // Guardem el nom de l'usuari a la sessió
                $_SESSION['id'] = $usuario['id'];  // Guardem l'ID de l'usuari a la sessió
                $_SESSION['rol'] = $usuario['rol'];  // Guardem el rol de l'usuari a la sessió

                return true;  // Retorna true perquè el login ha estat exitós
            } else {
                // Si la contrasenya és incorrecta, s'assigna un missatge d'error a la sessió
                $_SESSION['error'] = "Contraseña incorrecta.";
                return false;  // Retorna false perquè el login ha fallat
            }
        }
    }

    

    
}
