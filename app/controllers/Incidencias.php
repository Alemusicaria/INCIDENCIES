<?php
require "app/models/incidencias.php";

class IncidenciasController
{
    
    public function Ingresar_Incidencias()
    {
        $ingresar_incidencia = new incidencias();
        if( $ingresar_incidencia -> ingresar_incidencias())
        {
            header("Location: index.php?controller=Login&method=bienvenido");
        }else
        {
            header("Location: index.php?controller=Incidencias&method=vista_ingreso_incidencias");
        }
    }

    public function vista_ingreso_incidencias()
    {
        require "app/views/layouts/Forms/V_IngresoIncidencias.php";
    }

    
}