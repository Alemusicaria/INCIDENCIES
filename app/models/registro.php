<?php

class registro
{
    public function Nuevo_Usuario()
    {
        $Nombre = $_POST['Nombre'];
        $Correo = $_POST['Correo'];
        $Contraseña = $_POST['Contraseña'];
        $Telefono = $_POST['Ntelefono'];
        $Rol = $_POST['Rol'];

        $Foto = $_FILES['Foto']['name'];
        $ruta = $_FILES['Foto']['tmp_name'];
        $destino = "Images/Foto_Perfiles/" . $Foto;

        move_uploaded_file($ruta, $destino);
        $Contraseñahash = password_hash($Contraseña, PASSWORD_DEFAULT);

        $mysql = new mysqli("localhost", "apratc_aprat", "", "apratc_Incidencies");
        if ($mysql->connect_error) {
            die('Problemas con la conexión a la base de datos');
        }

        $query_usuario = "INSERT INTO usuaris(nom_cognoms, correu, contrasenya, telefon, rol, data_registre, foto) 
        VALUES ('$Nombre','$Correo','$Contraseñahash','$Telefono','$Rol', NOW(),' $destino')";
        
        if ($mysql->query($query_usuario) === TRUE) {
            $_SESSION['exito'] = "Usuario registrado con éxito.";
            return true;
        } else {
            $_SESSION['error'] = "Error al insertar el usuario:";
            return false;
        }
    }
}