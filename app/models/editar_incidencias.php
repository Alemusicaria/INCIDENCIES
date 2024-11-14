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
                $codigo = $_POST['id'];

                $query = "SELECT * FROM incidencies WHERE id = $codigo";
                $result = $mysql->query($query);

                if($reg = $result->fetch_array())
                {
                    require "app/views/layouts/Forms/V_ActualizarIncidencia.php";
                }else {
                    echo "No se ha encontrado la incidencia con el ID " . htmlspecialchars($codigo);
                }
            } else{
                echo "No se ha especificado un ID válido.";
                return false;
            }
    }
            
}