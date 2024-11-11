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
        $destino = "Images/Repocitori/".$Foto;
        move_uploaded_file($ruta, $destino);

        $mysql = new mysqli("localhost", "root", "", "incidencies");
        if ($mysql->connect_error) {
            die('Problemas con la conexión a la base de datos');
        }

        $query_ubicacion = "SELECT id FROM sales WHERE planta = '$Planta' AND sala = '$Salon'";
        $result = $mysql->query($query_ubicacion);

        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $id_ubicacion = $row['id'];
            
            $query_incidencias = "INSERT INTO incidencies (creador_nom_cognoms, titol_fallo, descripcio, tipus_incidencia, id_ubicacio, data_incidencia, estat, prioritat, imatges)
            VALUES ('$Nombre', '$TituloFallo', '$Descripcion', '$Categoria', '$id_ubicacion', NOW(), '$Estado', '$Prioridad', '$destino')";
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

 
}