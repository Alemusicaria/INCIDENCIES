<?php

class info_incidencias
{
    public function tabla_incidencias()
    {
        $mysql = new mysqli("localhost", "root", "", "incidencies");
        if ($mysql->connect_error) {
            die('Problemas con la conexión a la base de datos');
        }

        $query_incidencias = "SELECT * FROM incidencies";
        $result_incidencias = $mysql->query($query_incidencias);

        if ($result_incidencias->num_rows > 0) {
            return $result_incidencias;
        } else {
            return false;
        }
    }
}