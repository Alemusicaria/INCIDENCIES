<?php
require "app/models/info_incidencias.php";

class Info_IncidenciasController
{
    // Aquesta funció mostra les incidències a una taula
    public function mostrar_tabla_incidencias()
    {
        $mostrar_incidencias = new info_incidencias();
        $TablaIncidencias = $mostrar_incidencias->tabla_incidencias();
        require "app/views/layouts/Forms/V_CuadroIncidencias.php";
    }

    // Aquesta funció obté una incidència per ID
    public function get_incidencia_by_id($id)
    {
        $mysql = new mysqli("localhost", "root", "", "incidencies");

        if ($mysql->connect_error) {
            die("Error de connexió: " . $mysql->connect_error);
        }

        $query = "SELECT * FROM incidencies WHERE id = ?";
        $stmt = $mysql->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $incidencia = $result->fetch_assoc();
        } else {
            $incidencia = null;
        }

        $stmt->close();
        $mysql->close();

        return $incidencia;
    }

    // Aquesta funció mostra la vista de la incidència
    public function mostrar_incidencia()
    {
        $id = $_GET['id']; // Obtenim l'ID de la incidència des de la URL
        $incidencia = $this->get_incidencia_by_id($id); // Obtenim la incidència per ID

        if ($incidencia) {
            // Si la incidència existeix, passarem les dades a la vista
            require 'app/views/mostrar_info.php';
        } else {
            // Si no es troba la incidència, mostrar un missatge d'error
            echo "La incidència no es troba o ha estat eliminada.";
        }
    }
}
