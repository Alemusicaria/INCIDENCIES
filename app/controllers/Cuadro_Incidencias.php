<?php
require "app/models/cuadro_incidencias.php";

class Cuadro_IncidenciasController
{
    public function mostrar_incidencias()
    {
        $mostrar_incidencias = new cuadro_incidencias();
        $TablaIncidencias = $mostrar_incidencias->mostrarar_incidencias();
        require "app/views/layouts/Forms/V_CuadroIncidencias.php";
    }
}