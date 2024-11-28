<?php

class registro
{
    public function Nuevo_Usuario()
    {
        // Obtenim i filtrem les dades del formulari
        $Nombre = htmlspecialchars(trim($_POST['Nombre']));
        $Correo = filter_var(trim($_POST['Correo']), FILTER_VALIDATE_EMAIL);
        $Contraseña = $_POST['Contraseña'];
        $Telefono = htmlspecialchars(trim($_POST['Ntelefono']));
        $Rol = htmlspecialchars(trim($_POST['Rol']));
        $Categoria = isset($_POST['categoria']) ? htmlspecialchars(trim($_POST['categoria'])) : null;

        // Comprovem si el correu electrònic és vàlid
        if (!$Correo) {
            $_SESSION['error'] = "Correo electrónico no válido.";
            return false;
        }

        // Comprovem que la contrasenya tingui almenys 6 caràcters
        if (strlen($Contraseña) < 6) {
            $_SESSION['error'] = "La contraseña debe tener al menos 6 caracteres.";
            return false;
        }

        // Validació i processament de la foto
        if (isset($_FILES['Foto']) && $_FILES['Foto']['error'] === UPLOAD_ERR_OK) {
            $Foto = $_FILES['Foto']['name'];
            $ruta = $_FILES['Foto']['tmp_name'];
            $extensio = strtolower(pathinfo($Foto, PATHINFO_EXTENSION));

            // Comprovem que el fitxer sigui una imatge vàlida
            if (!in_array($extensio, ['jpg', 'jpeg', 'png', 'gif'])) {
                $_SESSION['error'] = "Formato de imagen no permitido. Solo JPG, PNG y GIF son válidos.";
                return false;
            }

            // Generem un nom únic per evitar conflictes
            $nom_imagen_unico = uniqid() . '.' . $extensio;
            $destino = "Images/Foto_Perfiles/" . $nom_imagen_unico;

            // Movem la imatge a la carpeta de destinació
            move_uploaded_file($ruta, $destino);
        } else {
            $_SESSION['error'] = "Error al cargar la imagen.";
            return false;
        }

        // Generem el hash de la contrasenya per seguretat
        $Contraseñahash = password_hash($Contraseña, PASSWORD_DEFAULT);

        // Incloem la connexió a la base de dades
        require_once('app/models/connexio.php');

        // Creem una consulta preparada per evitar injeccions SQL
        $stmt = $conn->prepare("INSERT INTO usuaris (nom_cognoms, correu, contrasenya, telefon, rol, data_registre, foto) 
                                VALUES (?, ?, ?, ?, ?, NOW(), ?)");
        $stmt->bind_param('ssssss', $Nombre, $Correo, $Contraseñahash, $Telefono, $Rol, $destino);

        // Executem la consulta i verifiquem si s'ha inserit correctament
        if ($stmt->execute()) {
            // Si el rol és Tecnic, inserim les dades a la taula tecnicos
            if ($Rol === 'Tecnic') {
                $stmt_tecnicos = $conn->prepare("INSERT INTO tecnicos (nom_cognoms, categoria, telefon) VALUES (?, ?, ?)");
                $stmt_tecnicos->bind_param('sss', $Nombre, $Categoria, $Telefono);
                if (!$stmt_tecnicos->execute()) {
                    $_SESSION['error'] = "Error al insertar el técnico: " . $stmt_tecnicos->error;
                    return false;
                }
            }

            $_SESSION['exito'] = "Usuario registrado con éxito.";
            return true;
        } else {
            $_SESSION['error'] = "Error al insertar el usuario: " . $stmt->error;
            return false;
        }
    }
}