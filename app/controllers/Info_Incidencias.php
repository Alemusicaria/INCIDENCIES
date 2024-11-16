<?php
require "app/models/info_incidencias.php";  // Incluir el modelo

class Info_IncidenciasController
{
    public function mostrar_incidencia()
    {
        // Verificar si el parámetro 'id' está presente en la URL
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']); // Sanitizamos el ID recibido de la URL
            
            // Crear una instancia del modelo
            $info_incidencias_model = new info_incidencias();
            
            // Obtener la incidencia utilizando el método get_incidencia_by_id
            $incidencia = $info_incidencias_model->get_incidencia_by_id($id);

            if ($incidencia) {
                // Si la incidencia existe, pasamos los datos a la vista
                require 'app/views/mostrar_info.php';
            } else {
                // Si no se encuentra la incidencia, mostrar un mensaje de error
                echo "<div class='alert alert-danger'>La incidencia no se encuentra o ha sido eliminada.</div>";
            }
        } else {
            // Si no se pasa un 'id', mostramos un mensaje de error
            echo "<div class='alert alert-warning'>No se ha especificado un ID de incidencia.</div>";
        }    
    }
}

