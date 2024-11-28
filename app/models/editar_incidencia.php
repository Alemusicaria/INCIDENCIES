<?php

class editar_incidencia
{
    // Mètode per verificar si una incidència amb un ID específic existeix a la base de dades
    public function verificar_id_incidencia()
    {
        require_once('app/models/connexio.php');

        $id_incidencia = $_GET['id'];
        $query = "SELECT incidencies.*, sales.planta, sales.sala 
                    FROM incidencies 
                    INNER JOIN sales ON incidencies.id_ubicacio = sales.id 
                    WHERE incidencies.id = '$id_incidencia'";

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
        require_once 'app/models/connexio.php';

        // Recogida de datos del formulario
        $id_incidencia = $_POST['id'];
        $titulo = $_POST['TituloFallo'];
        $descripcion = $_POST['Descripcion'];
        $categoria = $_POST['tipus_incidencia'];
        $planta = $_POST['Planta'];
        $sala = $_POST['Salon'];
        $estat = $_POST['Estat'];
        $prioridad = $_POST['Prioridad'];
        $descripcion_cierre = $_POST['Descripcio_resolta'];

        // Processar les noves imatges pujades
        $imagenes_actuales = [];
        if (!empty($_FILES['Foto']['tmp_name'][0])) {
            $ruta_imagenes = 'Images/Evidencia/'; // Ruta para guardar las imágenes
            foreach ($_FILES['Foto']['tmp_name'] as $index => $tmp_name) {
                if ($_FILES['Foto']['error'][$index] === UPLOAD_ERR_OK) {
                    $nombre_imagen = uniqid() . "_" . basename($_FILES['Foto']['name'][$index]);
                    $ruta_completa = $ruta_imagenes . $nombre_imagen;
                    move_uploaded_file($tmp_name, $ruta_completa);
                    $imagenes_actuales[] = $ruta_completa; // Agregar la nueva imagen al array
                }
            }
        }

        // Traer las imágenes existentes de la base de datos
        $consulta_imagenes_existentes = "SELECT imatges FROM incidencies WHERE id = '$id_incidencia'";
        $resultado_imagenes_existentes = $conn->query($consulta_imagenes_existentes);
        $imagenes_existentes = $resultado_imagenes_existentes->fetch_assoc()['imatges'];

        // Traer la ubicación de la sala
        $query_ubicacion = "SELECT id FROM sales WHERE planta = '$planta' AND sala = '$sala'";
        $result_ubicacion = $conn->query($query_ubicacion);

        if ($result_ubicacion->num_rows > 0) {
            $row_ubicacion = $result_ubicacion->fetch_assoc();
            $id_ubicacion = $row_ubicacion['id'];
        } else {
            return false;
        }

        // Eliminar las imágenes seleccionadas
        if (isset($_POST['eliminar_imagenes']) && !empty($_POST['eliminar_imagenes'])) {
            // Recoger las imágenes a eliminar
            $imagenes_a_eliminar = $_POST['eliminar_imagenes'];
            // Convertir las imágenes a eliminar en un array para procesarlas
            $imagenes_a_eliminar = array_map('htmlspecialchars', $imagenes_a_eliminar);

            // Obtener las imágenes actuales y eliminar las seleccionadas
            $imagenes_existentes_array = explode(",", $imagenes_existentes);
            $imagenes_restantes = array_diff($imagenes_existentes_array, $imagenes_a_eliminar);

            // Eliminar las imágenes del servidor
            foreach ($imagenes_a_eliminar as $imagen) {
                $imagen_path = htmlspecialchars($imagen, ENT_QUOTES, 'UTF-8');
                if (file_exists($imagen_path)) {
                    unlink($imagen_path); // Eliminar la imagen del servidor
                }
            }

            // Actualizar la cadena de imágenes restantes
            $imagenes_completas = implode(",", $imagenes_restantes);
        } else {
            // Si no hay imágenes para eliminar, mantener las imágenes existentes
            $imagenes_completas = $imagenes_existentes;
        }

        // Si ya existen imágenes, agregar las nuevas imágenes
        if (!empty($imagenes_actuales)) {
            $imagenes_completas .= !empty($imagenes_completas) ? "," : "";
            $imagenes_completas .= implode(",", $imagenes_actuales);
        }

        // Consulta para actualizar los datos de la incidencia
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

        // Retorna true si la actualización fue exitosa, false en caso contrario
        return $resultado_actualizacion ? true : false;
    }

    public function obtenerSalas()
    {
        require_once('app/models/connexio.php');

        // Recibir la planta desde el POST
        $planta = $_POST['planta'];

        // Consulta para obtener las salas según la planta seleccionada
        $query = "SELECT sala FROM sales WHERE planta = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $planta);
        $stmt->execute();
        $result = $stmt->get_result();

        $salas = [];
        while ($row = $result->fetch_assoc()) {
            $salas[] = $row['sala'];
        }

        // Devolver las salas como JSON
        echo json_encode($salas);
    }
}
