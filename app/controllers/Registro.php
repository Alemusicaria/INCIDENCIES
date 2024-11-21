<?php
require 'app/models/registro.php'; // Inclou el model 'registro' per gestionar l'alta de nous usuaris.

/**
 * Controlador per gestionar el registre de nous usuaris.
 */
class RegistroController
{
    /**
     * Mostra la vista del formulari de registre.
     * Aquest mètode carrega la vista per permetre que l'usuari introdueixi les seves dades.
     */
    public function registro()
    {
        require "app/views/layouts/Forms/V_Registro.php"; // Carrega la vista amb el formulari de registre.
    }

    /**
     * Processa l'ingrés d'un nou usuari.
     * Si el registre és correcte, redirigeix a la pàgina de benvinguda.
     * Si hi ha un error, redirigeix de nou al formulari de registre.
     */
    public function ingresar_usuario()
    {
        $nuevo_usuario = new registro(); // Crea una instància del model per gestionar el registre.

        // Comprova si el nou usuari s'ha registrat correctament.
        if ($nuevo_usuario->Nuevo_Usuario()) {
            // Redirigeix a la pàgina de benvinguda si el registre té èxit.
            header("Location: index.php?controller=Login&method=bienvenido");
        } else {
            // Redirigeix al formulari de registre si hi ha algun error.
            header("Location: index.php?controller=Registro&method=registro");
        }
    }
}
