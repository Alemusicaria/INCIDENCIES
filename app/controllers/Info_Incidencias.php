<?php
require "app/models/info_incidencias.php"; // Inclou el model per gestionar la informació de les incidències.

class Info_IncidenciasController
{
    /**
     * Mostra la informació d'una incidència específica.
     */
    public function mostrar_incidencia()
    {
        // Verifica si el paràmetre 'id' està present a la URL.
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']); // Converteix el valor de l'ID a un enter per evitar vulnerabilitats.

            // Crea una instància del model.
            $info_incidencias_model = new info_incidencias();

            // Obté la informació de la incidència pel seu ID.
            $incidencia = $info_incidencias_model->get_incidencia_by_id($id);

            if ($incidencia) {
                // Si es troba la incidència, obté la ubicació relacionada.
                $ubicacion = $info_incidencias_model->ubicacion($id);
                $tecnicos = $info_incidencias_model->tecnicos($id);

                // Carrega la vista amb les dades de la incidència i la ubicació.
                require 'app/views/mostrar_info.php';
            } else {
                // Si no es troba la incidència, mostra un missatge d'error.
                echo "<div class='alert alert-danger'>La incidència no es troba o ha estat eliminada.</div>";
            }
        } else {
            // Si no es passa un 'id', mostra un missatge d'avís.
            echo "<div class='alert alert-warning'>No s'ha especificat un ID d'incidència.</div>";
        }
    }
}
