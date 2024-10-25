<?php

require_once '../config/database.php';
require_once '../models/Incidencia.php';

class IncidenciesController
{
    private $incidenciaModel;

    public function __construct()
    {
        // Connexió a la base de dades
        $db = new Database();
        $this->incidenciaModel = new Incidencia($db->connect());
    }

    // Mostra totes les incidències
    public function index()
    {
        $incidencies = $this->incidenciaModel->getAll();
        require '../app/views/incidencies/index.php';
    }

    // Crea una nova incidència
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            $this->incidenciaModel->create($title, $start_date, $end_date);
            header('Location: /public/index.php');
        } else {
            require '../app/views/incidencies/create.php';
        }
    }

    // Esborra una incidència
    public function delete($id)
    {
        $this->incidenciaModel->delete($id);
        header('Location: /public/index.php');
    }
}
