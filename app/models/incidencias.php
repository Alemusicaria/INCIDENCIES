<?php

class incidencias
{
    // Mètode per ingressar una nova incidència
    public function ingresar_incidencias()
    {
        

        // Recollim les dades de la incidència del formulari
        $Nombre = $_SESSION['usuari'][1];
        $TituloFallo = $_POST['TituloFallo'];
        $Descripcion = $_POST['Descripcion'];
        $Categoria = $_POST['Categoria'];
        $Planta = $_POST['Planta'];
        $Salon = $_POST['Salon'];
        $Prioridad = $_POST['Prioridad'];

        // Comprovem si s'han pujat imatges
        if (isset($_FILES['Foto']) && !empty($_FILES['Foto']['name'][0])) {
            $Fotos = $_FILES['Foto'];
            $rutas_imagenes = [];

            // Recórrer totes les imatges pujades
            foreach ($Fotos['tmp_name'] as $index => $tmp_name) {
                $nombre_imagen = $Fotos['name'][$index];
                $ruta_imagen = "Images/Evidencia/" . $nombre_imagen;

                // Movem la imatge a la carpeta de destinació
                if (move_uploaded_file($tmp_name, $ruta_imagen)) {
                    $rutas_imagenes[] = $ruta_imagen;
                } else {
                    $_SESSION['error'] = "Error al mover la imagen: " . $nombre_imagen;
                    return false;
                }
            }

            // Convertim les rutes de les imatges a una cadena separada per comes
            $imagenes = implode(",", $rutas_imagenes);
        } else {
            $imagenes = ''; // Si no es pugen imatges, deixem el camp buit
        }

        // Incloem la connexió a la base de dades
        require_once('app/models/connexio.php');

        // Consultes per obtenir l'ID de la ubicació i l'usuari
        $query_ubicacion = "SELECT id FROM sales WHERE planta = '$Planta' AND sala = '$Salon'";
        $result_ubicacion = $conn->query($query_ubicacion);

        $query_usuario = "SELECT id FROM usuaris WHERE nom_cognoms = '$Nombre'";
        $result_usuario = $conn->query($query_usuario);

        // Si es troba la ubicació i l'usuari, procedim amb la inserció de la incidència
        if ($result_ubicacion->num_rows > 0 && $result_usuario->num_rows > 0) {
            $row_ubicacion = $result_ubicacion->fetch_assoc();
            $id_ubicacion = $row_ubicacion['id'];

            $row_usuario = $result_usuario->fetch_assoc();
            $id_usuario = $row_usuario['id'];

            // Inserim la incidència a la base de dades
            $query_incidencias = "INSERT INTO incidencies (creador_nom_cognoms, titol_fallo, descripcio, tipus_incidencia, id_ubicacio, data_incidencia, prioritat, imatges, id_usuari)
        VALUES ('$Nombre', '$TituloFallo', '$Descripcion', '$Categoria', '$id_ubicacion', NOW(), '$Prioridad', '$imagenes', '$id_usuario')";

            // Comprovem si l'inserció ha estat exitosa
            if ($conn->query($query_incidencias) === TRUE) {
                $_SESSION['exito'] = "Incidencia ingresada con éxito.";
                return true;
            } else {
                $_SESSION['error'] = "Error al insertar la incidencia";
                return false;
            }
        } else {
            $_SESSION['error'] = "Error al insertar la incidencia: Ubicación o usuario no encontrados.";
            return false;
        }
    }

    // Mètode per obtenir les sales d'una planta específica
    public function obtenerSalasPorPlanta($planta)
    {
        require_once('app/models/connexio.php');

        // Consulta per obtenir les sales de la planta
        $query = "SELECT sala FROM sales WHERE planta = '$planta'";
        $result = $conn->query($query);

        // Guardem totes les sales trobades en un array
        $salas = [];
        while ($row = $result->fetch_assoc()) {
            $salas[] = $row['sala'];
        }

        // Retornem l'array de sales
        return $salas;
    }
}
