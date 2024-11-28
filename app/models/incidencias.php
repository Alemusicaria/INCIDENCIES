<?php

class incidencias
{
    // Mètode per ingressar una nova incidència
    public function ingresar_incidencias()
    {
        // Recogemos las variables del formulario
    $Nombre = $_SESSION['usuari'][1];
    $TituloFallo = $_POST['TituloFallo'];
    $Descripcion = $_POST['Descripcion'];
    $Categoria = $_POST['Categoria'];
    $Planta = $_POST['Planta'];
    $Salon = $_POST['Salon'];
    $Prioridad = $_POST['Prioridad'];
    $Requiere_Tecnic = $_POST['Tecnico'];  // "Si" o "No"
    $id_tecnico = isset($_POST['id_tecnico']) ? $_POST['id_tecnico'] : null;

    // Comprobamos si se han subido imágenes
    if (isset($_FILES['Foto']) && !empty($_FILES['Foto']['name'][0])) {
        $Fotos = $_FILES['Foto'];
        $rutas_imagenes = [];

        foreach ($Fotos['tmp_name'] as $index => $tmp_name) {
            $nombre_imagen = $Fotos['name'][$index];
            $ruta_imagen = "Images/Evidencia/" . $nombre_imagen;

            if (move_uploaded_file($tmp_name, $ruta_imagen)) {
                $rutas_imagenes[] = $ruta_imagen;
            } else {
                $_SESSION['error'] = "Error al mover la imagen: " . $nombre_imagen;
                return false;
            }
        }

        $imagenes = implode(",", $rutas_imagenes);
    } else {
        $imagenes = ''; // Si no se suben imágenes, dejamos el campo vacío
    }

    // Incluimos la conexión a la base de datos
    require_once('app/models/connexio.php');

    // Consultas para obtener el ID de la ubicación y el usuario
    $query_ubicacion = "SELECT id FROM sales WHERE planta = '$Planta' AND sala = '$Salon'";
    $result_ubicacion = $conn->query($query_ubicacion);

    $query_usuario = "SELECT id FROM usuaris WHERE nom_cognoms = '$Nombre'";
    $result_usuario = $conn->query($query_usuario);

    if ($result_ubicacion->num_rows > 0 && $result_usuario->num_rows > 0) {
        $row_ubicacion = $result_ubicacion->fetch_assoc();
        $id_ubicacion = $row_ubicacion['id'];

        $row_usuario = $result_usuario->fetch_assoc();
        $id_usuario = $row_usuario['id'];

        // Determinar si se requiere técnico
        if ($Requiere_Tecnic === "Si" && $id_tecnico !== null) {
            $query_incidencias = "INSERT INTO incidencies 
                (creador_nom_cognoms, titol_fallo, descripcio, tipus_incidencia, id_ubicacio, data_incidencia, prioritat, imatges, id_usuari, id_tecnico)
                VALUES ('$Nombre', '$TituloFallo', '$Descripcion', '$Categoria', '$id_ubicacion', NOW(), '$Prioridad', '$imagenes', '$id_usuario', $id_tecnico)";
        } else {
            $query_incidencias = "INSERT INTO incidencies 
                (creador_nom_cognoms, titol_fallo, descripcio, tipus_incidencia, id_ubicacio, data_incidencia, prioritat, imatges, id_usuari, id_tecnico)
                VALUES ('$Nombre', '$TituloFallo', '$Descripcion', '$Categoria', '$id_ubicacion', NOW(), '$Prioridad', '$imagenes', '$id_usuario', NULL)";
        }

        // Verificamos si la inserción fue exitosa
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

    public function obtenerTecnicosPorCategoria($categoria)
    {
        require_once('app/models/connexio.php');
        $query = "SELECT id, nom_cognoms FROM tecnics WHERE categoria = '$categoria'";
        $result = $conn->query($query);

        $tecnicos = [];
        while ($row = $result->fetch_assoc()) {
            $tecnicos[] = $row;
        }

        return $tecnicos;
    }

    public function obtenerNumeroTecnico($tecnico_id)
    {
        require_once('app/models/connexio.php');
        $query = "SELECT telefon FROM tecnics WHERE id = '$tecnico_id'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc()['telefon'];
        } else {
            return null;
        }
    }

    
}
