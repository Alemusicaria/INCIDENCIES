<?php

class perfil
{
    // Funció per obtenir i mostrar la informació del perfil de l'usuari
    public function info()
    {
        // Comprovem si l'usuari està autenticat
        if (isset($_SESSION['usuari'])) {
            // Recollim la informació de la sessió (nom, ID, rol, etc.)
            $nombre = $_SESSION['usuari'][1];
            $id = $_SESSION['usuari'][0];
            $rol = $_SESSION['usuari'][4];

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
