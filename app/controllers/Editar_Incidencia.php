<?php
require 'app/models/editar_incidencia.php';

class Editar_IncidenciaController
{
   
    public function verificar_id_incidencia()
    {
        $editar_incidencia = new editar_incidencia(); 
        $datos_incidencia = $editar_incidencia->verificar_id_incidencia(); 
        if ($datos_incidencia) {
            require 'app/views/layouts/Forms/V_EditarIncidencia.php';
        } else {
            echo "No se ha podido obtener el ID de la incidencia o no existe.";
        }
    }

}
