<?php

class incidencias
{
    public function ingresar_incidencias()
    {

        if (isset($_SESSION['usuario'])) {
            $Nombre = $_SESSION['usuario'];
        } else {
            die("Error: No se ha encontrado el usuario en la sesión.");
        }

        $TituloFallo = $_POST['TituloFallo'];
        $Descripcion = $_POST['Descripcion'];
        $Categoria = $_POST['Categoria'];
        $Planta = $_POST['Planta'];
        $Salon = $_POST['Salon'];
        $Estado = $_POST['Estado'];
        $Prioridad = $_POST['Prioridad'];
        
        $Foto = $_FILES['Foto']['name'];
        $ruta = $_FILES['Foto']['tmp_name'];
        $destino = "Images/Evidencia/" . $Foto;

        move_uploaded_file($ruta, $destino);

            $mysql = new mysqli("localhost", "root", "", "incidencies");
            if ($mysql->connect_error) {
                die('Problemas con la conexión a la base de datos');
            }

            $query_ubicacion = "SELECT id FROM sales WHERE planta = '$Planta' AND sala = '$Salon'";
            $result_ubicacion = $mysql->query($query_ubicacion);

            $query_usuario = "SELECT id FROM usuaris WHERE nom_cognoms = '$Nombre'";
            $result_usuario = $mysql->query($query_usuario);
            
            if($result_ubicacion->num_rows > 0 && $result_usuario->num_rows > 0)
            {
                $row_ubicacion = $result_ubicacion->fetch_assoc();
                $id_ubicacion = $row_ubicacion['id'];

                $row_usuario = $result_usuario->fetch_assoc();
                $id_usuario = $row_usuario['id'];
                
                $query_incidencias = "INSERT INTO incidencies (creador_nom_cognoms, titol_fallo, descripcio, tipus_incidencia, id_ubicacio, data_incidencia, estat, prioritat, imatges, id_usuario)
                VALUES ('$Nombre', '$TituloFallo', '$Descripcion', '$Categoria', '$id_ubicacion', NOW(), '$Estado', '$Prioridad', '$destino', '$id_usuario')";
                if ($mysql->query($query_incidencias) === TRUE) {
                    $_SESSION['exito'] = "Incidencia ingresada con éxito.";
                    return true;
                } else {
                    $_SESSION['error'] = "Error al insertar la incidencia:";
                    return false;
                }
            }else
            {
                $_SESSION['error'] = "Error al insertar la incidencia:";
                return false;
            }
    }

    public function obtenerSalasPorPlanta($planta)
    {
        $mysql = new mysqli("localhost", "root", "", "incidencies");
        if ($mysql->connect_error) {
            die('Problemas con la conexión a la base de datos');
        }

        $query = "SELECT sala FROM sales WHERE planta = '$planta'";
        $result = $mysql->query($query);

        $salas = [];
        while ($row = $result->fetch_assoc()) {
            $salas[] = $row['sala'];
        }

        return $salas;
    }

 
}