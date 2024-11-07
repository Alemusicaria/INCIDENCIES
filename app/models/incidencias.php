<?php
class incidencias
{

    public function ingresar_incidencias()
    {
        $Nombre = $_POST['Nombre'];
        $TituloFallo = $_POST['TituloFallo'];
        $Tipo = $_POST['Tipo'];
        $Descripcion = $_POST['Descripcion'];
        $Prioridad = $_POST['Prioridad'];
        $Estado = $_POST['Estado'];
        $Planta = $_POST['Planta'];

        $mysql = new mysqli("localhost", "root", "", "mvc");

        if ($mysql->connect_error) {
            die('Problemas con la conexión a la base de datos');
        }

        if (empty($Nombre) || empty($TituloFallo) || empty($Tipo) || empty($Descripcion) || empty($Prioridad) || empty($Estado) || empty($Planta)) {
            $_SESSION['error'] = "Por favor, completa todos los campos.";
            return false;
        }

        $result = $mysql->query("INSERT INTO incidencias (Nombre, TituloFallo, Tipo, Descripcion, Prioridad, Estado, Planta) VALUES ('$Nombre', '$TituloFallo', '$Tipo', '$Descripcion', '$Prioridad', '$Estado', '$Planta')");

        if ($result) {
            $_SESSION['exito'] = "Incidencia ingresada correctamente.";
            return true;
        } else {
            $_SESSION['error'] = "Hubo un error al ingresar la incidencia.";
            return false;
        }
    }
}