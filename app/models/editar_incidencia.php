<?php

class editar_incidencia
{
    public function verificar_id_incidencia()
    {

        $mysql = new mysqli("localhost", "apratc_aprat", "AleixSteveLeandro123", "apratc_Incidencies");
        if ($mysql->connect_error) {
            die('Problemas con la conexión a la base de datos');
        }

        $id_incidencia = $_GET['id'];
        $query = "SELECT * FROM incidencies WHERE id = '$id_incidencia'";
        $result = $mysql->query($query);

        if ($result->num_rows > 0) {
            $incidencia = $result->fetch_assoc();
            return $incidencia;
        } else {
            return false;
        }
    }

    
}