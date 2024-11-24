<?php

require "app/models/perfil.php"; // Inclou el model 'perfil' per gestionar dades relacionades amb el perfil de l'usuari.

/**
 * Controlador per gestionar les accions relacionades amb el perfil de l'usuari.
 */
class PerfilController
{
    /**
     * Mostra la informació del perfil de l'usuari.
     * Aquest mètode carrega la vista corresponent amb les dades del perfil.
     */
    public function info()
    {
        require "app/views/perfil.php"; // Carrega la vista 'perfil.php'.
    }
}
