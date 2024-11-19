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
        $Prioridad = $_POST['Prioridad'];

        // Verificamos si se han subido imágenes
        if (isset($_FILES['Foto']) && !empty($_FILES['Foto']['name'][0])) {
            $Fotos = $_FILES['Foto'];
            $rutas_imagenes = [];

            // Recorremos todas las imágenes subidas
            foreach ($Fotos['tmp_name'] as $index => $tmp_name) {
                $nombre_imagen = $Fotos['name'][$index];
                $ruta_imagen = "Images/Evidencia/" . $nombre_imagen;

                // Movemos la imagen a la carpeta destino
                if (move_uploaded_file($tmp_name, $ruta_imagen)) {
                    $rutas_imagenes[] = $ruta_imagen;
                } else {
                    $_SESSION['error'] = "Error al mover la imagen: " . $nombre_imagen;
                    return false;
                }
            }

            // Convertimos las rutas de las imágenes a una cadena separada por comas
            $imagenes = implode(",", $rutas_imagenes);
        } else {
            $imagenes = ''; // Si no se suben imágenes, dejamos vacío el campo
        }

        require_once 'app\models\connexio.php';
        // Consultas para obtener el id de la ubicación y el id del usuario
        $query_ubicacion = "SELECT id FROM sales WHERE planta = '$Planta' AND sala = '$Salon'";
        $result_ubicacion = $conn->query($query_ubicacion);

        $query_usuario = "SELECT id FROM usuaris WHERE nom_cognoms = '$Nombre'";
        $result_usuario = $conn->query($query_usuario);

        if ($result_ubicacion->num_rows > 0 && $result_usuario->num_rows > 0) {
            $row_ubicacion = $result_ubicacion->fetch_assoc();
            $id_ubicacion = $row_ubicacion['id'];

            $row_usuario = $result_usuario->fetch_assoc();
            $id_usuario = $row_usuario['id'];

            // Insertamos la incidencia en la base de datos
            $query_incidencias = "INSERT INTO incidencies (creador_nom_cognoms, titol_fallo, descripcio, tipus_incidencia, id_ubicacio, data_incidencia, prioritat, imatges, id_usuari)
        VALUES ('$Nombre', '$TituloFallo', '$Descripcion', '$Categoria', '$id_ubicacion', NOW(), '$Prioridad', '$imagenes', '$id_usuario')";

            if ($conn->query($query_incidencias) === TRUE) {
                $_SESSION['exito'] = "Incidencia ingresada con éxito.";
                return true;
            } else {
                $_SESSION['error'] = "Error al insertar la incidencia: " . $conn->error;
                return false;
            }
        } else {
            $_SESSION['error'] = "Error al insertar la incidencia: Ubicación o usuario no encontrados.";
            return false;
        }
    }

    public function obtenerSalasPorPlanta($planta)
    {
        require_once 'app\models\connexio.php';

        $query = "SELECT sala FROM sales WHERE planta = '$planta'";
        $result = $conn->query($query);

        $salas = [];
        while ($row = $result->fetch_assoc()) {
            $salas[] = $row['sala'];
        }

        return $salas;
    }
}
