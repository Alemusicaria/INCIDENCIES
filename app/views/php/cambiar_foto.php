<?php
session_start();
require_once('../../models/connexio.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['nueva_foto'])) {
    $id_usuari = $_SESSION['usuari'][0]; // Suponiendo que el ID del usuario está en la posición 0 de la sesión
    $foto = $_FILES['nueva_foto'];

    // Verificar si el archivo es una imagen
    $check = getimagesize($foto['tmp_name']);
    if ($check !== false) {
        $extensio = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

        // Comprobar que el archivo sea una imagen válida
        if (!in_array($extensio, ['jpg', 'jpeg', 'png', 'gif'])) {
            $_SESSION['error'] = "Formato de imagen no permitido. Solo JPG, PNG y GIF son válidos.";
            header("Location: ../../perfil_usuari.php");
            exit();
        }

        // Generar un nombre único para evitar conflictos
        $nom_imagen_unico = uniqid() . '.' . $extensio;
        $target_dir = "../../Images/Foto_Perfiles/";
        $target_file = $target_dir . $nom_imagen_unico;

        // Verificar si la carpeta existe y tiene permisos de escritura
        if (!is_dir($target_dir) || !is_writable($target_dir)) {
            die("La carpeta de destino no existe o no tiene permisos de escritura.");
        }

        if (move_uploaded_file($foto['tmp_name'], $target_file)) {
            // Actualizar la base de datos con la nueva ruta de la foto
            $sql = "UPDATE usuaris SET foto = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $target_file, $id_usuari);
            if ($stmt->execute()) {
                // Actualizar la sesión con la nueva foto
                $_SESSION['usuari'][5] = $target_file;

                // Redirigir de vuelta al perfil
                header("Location: ../../perfil_usuari.php");
                exit();
            } else {
                echo "Error al actualizar la base de datos.";
            }
        } else {
            echo "Error al mover el archivo subido.";
        }
    } else {
        $_SESSION['error'] = "El archivo no es una imagen.";
        header("Location: ../../perfil_usuari.php");
        exit();
    }
} else {
    $_SESSION['error'] = "No se ha subido ninguna imagen.";
    header("Location: ../../perfil_usuari.php");
    exit();
}
?>