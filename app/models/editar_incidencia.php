<?php

class editar_incidencia
{
    public function verificar_id_incidencia()
    {

        require_once 'connexio.php';

        $id_incidencia = $_GET['id'];
        $query = "SELECT * FROM incidencies WHERE id = '$id_incidencia'";
        $result = $mysql->query($query);

        if ($result->num_rows > 0) {
            $incidencia = $result->fetch_assoc();
            return $incidencia;
        } else {
            return false;
        }
    }

    public function editar_incidencia()
    {
        require_once 'connexio.php';

        $id_incidencia = $_GET['id'];
        $titulo = $_POST['TituloFallo'];
        $descripcion = $_POST['Descripcion'];
        $categoria = $_POST['Categoria'];
        $planta = $_POST['Planta'];
        $sala = $_POST['Salon'];
        $estat = $_POST['Estat'];
        $prioridad = $_POST['Prioridad'];
    }
}
