<?php

class editar_incidencia
{
    // Mètode per verificar si una incidència amb un ID específic existeix a la base de dades
    public function verificar_id_incidencia()
    {
        require_once('app/models/connexio.php');

        $id_incidencia = $_GET['id'];
        $query = "SELECT * FROM incidencies WHERE id = '$id_incidencia'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // Retorna la informació de la incidència si es troba
            $incidencia = $result->fetch_assoc();
            return $incidencia;
        } else {
            // Retorna false si no existeix la incidència
            return false;
        }
    }

    // Mètode per actualitzar les dades d'una incidència existent
    public function actualizar_datos_incidencia()
    {
        require_once 'app\models\connexio.php';

        // Recollida de dades des del formulari
        $id_incidencia = $_POST['id'];
        $titulo = $_POST['TituloFallo'];
        $descripcion = $_POST['Descripcion'];
        $categoria = $_POST['Categoria'];
        $planta = $_POST['Planta'];
        $sala = $_POST['Salon'];
        $estat = $_POST['Estat'];
        $prioridad = $_POST['Prioridad'];
        $descripcion_cierre = $_POST['Descripcio_resolta'];

        // Processar les noves imatges pujades
        $imagenes_actuales = [];
        if (!empty($_FILES['Foto']['tmp_name'][0])) {
            $ruta_imagenes = 'Images/Evidencia/'; // Ruta per desar les imatges
            foreach ($_FILES['Foto']['tmp_name'] as $index => $tmp_name) {
                if ($_FILES['Foto']['error'][$index] === UPLOAD_ERR_OK) {
                    $nombre_imagen = uniqid() . "_" . basename($_FILES['Foto']['name'][$index]);
                    $ruta_completa = $ruta_imagenes . $nombre_imagen;
                    move_uploaded_file($tmp_name, $ruta_completa);
                    $imagenes_actuales[] = $ruta_completa; // Afegir la nova imatge a l'array
                }
            }
        }

        // Consulta per actualitzar la informació de la incidència
        $consulta_actualizacion = "UPDATE incidencies SET 
            titol_fallo = '$titulo', 
            descripcio = '$descripcion', 
            tipus_incidencia = '$categoria', 
            estat = '$estat', 
            prioritat = '$prioridad', 
            descripcio_resolta = '$descripcion_cierre' 
            WHERE id = '$id_incidencia'";

        $resultado_actualizacion = $conn->query($consulta_actualizacion);

        // Retorna true si l'actualització ha estat exitosa, false en cas contrari
        return $resultado_actualizacion ? true : false;
    }

    // Mètode per eliminar imatges associades a una incidència
    public function eliminar_imagenes_incidencia()
    {
        require_once 'app\models\connexio.php';

        $id_incidencia = $_POST['id'];
        $imagenes_eliminadas = isset($_POST['imagenes_eliminadas']) ? explode(',', $_POST['imagenes_eliminadas']) : [];

        // Recupera les imatges actuals de la base de dades
        $consulta_actual = "SELECT imatges FROM incidencies WHERE id = '$id_incidencia'";
        $resultado_actual = $conn->query($consulta_actual);

        if ($resultado_actual && $resultado_actual->num_rows > 0) {
            $incidencia_actual = $resultado_actual->fetch_assoc();
            $imagenes_actuales = !empty($incidencia_actual['imatges']) ? explode(',', $incidencia_actual['imatges']) : [];
        } else {
            // Retorna false si no es troben les dades
            return false;
        }

        // Elimina les imatges seleccionades tant del servidor com de l'array
        foreach ($imagenes_eliminadas as $imagen) {
            if (($key = array_search($imagen, $imagenes_actuales)) !== false) {
                unset($imagenes_actuales[$key]);
                if (file_exists($imagen)) {
                    unlink($imagen); // Esborra l'arxiu físic
                }
            }
        }

        // Actualitza l'array d'imatges a la base de dades
        $imagenes_actualizadas = implode(',', $imagenes_actuales);

        $consulta_actualizacion = "UPDATE incidencies SET imatges = '$imagenes_actualizadas' WHERE id = '$id_incidencia'";

        // Retorna true si l'actualització és exitosa, false en cas contrari
        return $conn->query($consulta_actualizacion) ? true : false;
    }
}
