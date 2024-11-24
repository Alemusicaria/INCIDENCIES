<?php

class perfil
{
    // Funció per obtenir i mostrar la informació del perfil de l'usuari
    public function info()
    {
        // Comprovem si l'usuari està autenticat
        if (isset($_SESSION['usuario'])) {
            // Recollim la informació de la sessió (nom, ID, rol, etc.)
            $nombre = $_SESSION['usuario'];
            $id = $_SESSION['id'];
            $rol = $_SESSION['rol'];

            // Mostrar la informació del perfil
            echo "Nom: " . $nombre . "<br>";
            echo "ID: " . $id . "<br>";
            echo "Rol: " . $rol . "<br>";
        } else {
            // Si no s'ha iniciat sessió, mostrar un missatge d'error
            echo "No has iniciat sessió. Si us plau, inicia sessió per veure el teu perfil.";
        }
    }
}
