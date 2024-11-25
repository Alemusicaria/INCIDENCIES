<?php
require 'app\models\eliminar.php';

class EliminarController
{
    public function eliminar_incidencia()
    {
        // Capturar el ID desde los parámetros GET
        $id_incidencia = isset($_GET['id']) ? intval($_GET['id']) : null;

        if ($id_incidencia) {
            // Instanciar el modelo
            $eliminar = new eliminar();

            // Llamar al método para eliminar la incidencia
            if ($eliminar->eliminar_incidencia($id_incidencia)) {
                // Redirigir si la operación fue exitosa
                header("Location: index.php?controller=Login&method=bienvenido");
                exit();
            } else {
                echo "Error al eliminar la incidencia.";
            }
        } else {
            echo "ID de incidencia no válido.";
        }
    
    }
}