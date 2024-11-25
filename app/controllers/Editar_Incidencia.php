<?php
require 'app/models/editar_incidencia.php'; // Inclou el model per gestionar l'edició de la incidència.

class Editar_IncidenciaController
{
    
    public function verificar_id_incidencia()
    {
        $editar_incidencia = new editar_incidencia(); 

        $datos_incidencia = $editar_incidencia->verificar_id_incidencia();

        if ($datos_incidencia) {
            // Si les dades de la incidència són vàlides, carrega la vista per editar-la.
            require 'app/views/layouts/Forms/V_EditarIncidencia.php';
        } else {
            // Si no es troben les dades, mostra un missatge d'error.
            echo "No s'ha pogut obtenir l'ID de la incidència o no existeix.";
        }
    }


    public function actualizar_datos_incidencia()
    {
        $editar_incidencia = new editar_incidencia();
        if ($editar_incidencia->actualizar_datos_incidencia()) {
            header("Location: index.php?controller=Login&method=bienvenido");
        } else {
            header("Location: index.php?controller=Editar_Incidencia&method=vista_editar");
        }
    }

    


    public function vista_editar()
    {
        require 'app/views/layouts/Forms/V_EditarIncidencia.php';
    }

}
