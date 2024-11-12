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

    public function obtenerSalas()
    {
        if (isset($_POST['planta'])) {
            $planta = $_POST['planta'];
            $incidenciasModel = new incidencias();
            $salas = $incidenciasModel->obtenerSalasPorPlanta($planta);
            echo json_encode($salas);
        }
    }
    
}