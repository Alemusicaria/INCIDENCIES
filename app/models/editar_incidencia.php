<?php

class editar_incidencia
{
    public function verificar_id_incidencia()
    {

        require_once('app/models/connexio.php');

        $id_incidencia = $_GET['id'];
        $query = "SELECT * FROM incidencies WHERE id = '$id_incidencia'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $incidencia = $result->fetch_assoc();
            return $incidencia;
        } else {
            return false;
        }
    }

    public function actualizar_datos_incidencia()
{
    require_once 'app\models\connexio.php';

    // Obtener los datos del formulario
    $id_incidencia = $_POST['id'];
    $titulo = $_POST['TituloFallo'];
    $descripcion = $_POST['Descripcion'];
    $categoria = $_POST['Categoria'];
    $planta = $_POST['Planta'];
    $sala = $_POST['Salon'];
    $estat = $_POST['Estat'];
    $prioridad = $_POST['Prioridad'];
    $descripcion_cierre = $_POST['Descripcio_resolta'];

    // Procesar nuevas imágenes subidas
    $imagenes_actuales = [];
    if (!empty($_FILES['Foto']['tmp_name'][0])) {
        $ruta_imagenes = 'Images/Evidencia/'; // Ruta donde guardarás las imágenes
        foreach ($_FILES['Foto']['tmp_name'] as $index => $tmp_name) {
            if ($_FILES['Foto']['error'][$index] === UPLOAD_ERR_OK) {
                $nombre_imagen = uniqid() . "_" . basename($_FILES['Foto']['name'][$index]);
                $ruta_completa = $ruta_imagenes . $nombre_imagen;
                move_uploaded_file($tmp_name, $ruta_completa);
                $imagenes_actuales[] = $ruta_completa; // Añadir la nueva imagen al array
            }
        }
    }

    // Traer las imágenes existentes de la base de datos
    $consulta_imagenes_existentes = "SELECT imatges FROM incidencies WHERE id = '$id_incidencia'";
    $resultado_imagenes_existentes = $conn->query($consulta_imagenes_existentes);
    $imagenes_existentes = $resultado_imagenes_existentes->fetch_assoc()['imatges'];

    $query_ubicacion = "SELECT id FROM sales WHERE planta = '$planta' AND sala = '$sala'";
    $result_ubicacion = $conn->query($query_ubicacion);

    if ($result_ubicacion->num_rows > 0) {
        $row_ubicacion = $result_ubicacion->fetch_assoc();
        $id_ubicacion = $row_ubicacion['id'];
    } else {
        return false;
    }

    // Si ya existen imágenes, agregar las nuevas imágenes
    if (!empty($imagenes_existentes)) {
        $imagenes_completas = $imagenes_existentes . "," . implode(",", $imagenes_actuales);
    } else {
        $imagenes_completas = implode(",", $imagenes_actuales);
    }

    // Actualizar la incidencia en la base de datos
    $consulta_actualizacion = "UPDATE incidencies SET 
        titol_fallo = '$titulo', 
        descripcio = '$descripcion', 
        tipus_incidencia = '$categoria', 
        id_ubicacio = '$id_ubicacion',
        estat = '$estat', 
        prioritat = '$prioridad', 
        descripcio_resolta = '$descripcion_cierre',
        imatges = '$imagenes_completas' 
        WHERE id = '$id_incidencia'";

    $resultado_actualizacion = $conn->query($consulta_actualizacion);

    if ($resultado_actualizacion) {
        return true;
    } else {
        return false;
    }
}
}

