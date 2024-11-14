<?php
require "app/models/info_incidencias.php";

class Info_IncidenciasController
{
    public function mostrar_tabla_incidencias()
    {
        $mostrar_incidencias = new info_incidencias();
        $TablaIncidencias = $mostrar_incidencias->tabla_incidencias();
        require "app/views/layouts/Forms/V_CuadroIncidencias.php";
    }

}