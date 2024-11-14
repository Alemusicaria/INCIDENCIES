<?php

class editar_incidencias
{

    public function consultar_id_actualizacion()
    {
        if(isset($_SESSION['usuario']))
        {
            $usuario = $_SESSION['usuario'];
        }else {
            die("Error: No se ha encontrado el usuario en la sesión.");
        }

        $mysql = new mysqli("localhost", "root", "", "incidencies");
            if ($mysql->connect_error) {
                die('Problemas con la conexión a la base de datos');
            }

            if (isset($_POST['id']) && is_numeric($_POST['id'])) {
                
            }
    }
            
}