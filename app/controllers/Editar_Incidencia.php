<?php
require 'app/models/editar_incidencia.php'; // Inclou el model per gestionar l'edició de la incidència.

class Editar_IncidenciaController
{
    /**
     * Verifica l'ID de la incidència i mostra el formulari per editar-la si existeix.
     */
    public function verificar_id_incidencia()
    {
        $editar_incidencia = new editar_incidencia(); // Crea una instància del model 'editar_incidencia'.

        // Obté les dades de la incidència associada a l'ID passat al model.
        $datos_incidencia = $editar_incidencia->verificar_id_incidencia();

        if ($datos_incidencia) {
            // Si les dades de la incidència són vàlides, carrega la vista per editar-la.
            require 'app/views/layouts/Forms/V_EditarIncidencia.php';
        } else {
            // Si no es troben les dades, mostra un missatge d'error.
            echo "No s'ha pogut obtenir l'ID de la incidència o no existeix.";
        }
    }
}