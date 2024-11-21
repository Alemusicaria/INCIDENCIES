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

        // Actualizar la incidencia en la base de datos
        $consulta_actualizacion = "UPDATE incidencies SET 
            titol_fallo = '$titulo', 
            descripcio = '$descripcion', 
            tipus_incidencia = '$categoria', 
            estat = '$estat', 
            prioritat = '$prioridad', 
            descripcio_resolta = '$descripcion_cierre' 
            WHERE id = '$id_incidencia'";

        $resultado_actualizacion = $conn->query($consulta_actualizacion);

        if ($resultado_actualizacion) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminar_imagenes_incidencia()
    {
        require_once 'app\models\connexio.php';

        $id_incidencia = $_POST['id'];
        $imagenes_eliminadas = isset($_POST['imagenes_eliminadas']) ? explode(',', $_POST['imagenes_eliminadas']) : [];

        // Recuperar imágenes actuales de la base de datos
        $consulta_actual = "SELECT imatges FROM incidencies WHERE id = '$id_incidencia'";
        $resultado_actual = $conn->query($consulta_actual);

        if ($resultado_actual && $resultado_actual->num_rows > 0) {
            $incidencia_actual = $resultado_actual->fetch_assoc();
            $imagenes_actuales = !empty($incidencia_actual['imatges']) ? explode(',', $incidencia_actual['imatges']) : [];
        } else {
            return false;
        }

        // Eliminar imágenes seleccionadas
        foreach ($imagenes_eliminadas as $imagen) {
            if (($key = array_search($imagen, $imagenes_actuales)) !== false) {
                unset($imagenes_actuales[$key]);
                if (file_exists($imagen)) {
                    unlink($imagen); // Eliminar el archivo físico
                }
            }
        }

        // Convertir el array de imágenes actualizado a cadena
        $imagenes_actualizadas = implode(',', $imagenes_actuales);

        // Actualizar la base de datos con las imágenes restantes
        $consulta_actualizacion = "UPDATE incidencies SET imatges = '$imagenes_actualizadas' WHERE id = '$id_incidencia'";

        $resultado_actualizacion = $conn->query($consulta_actualizacion);

        return $resultado_actualizacion ? true : false;
    }
}

