<?php

class Incidencia
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtenir totes les incidències
    public function getAll()
    {
        $query = "SELECT * FROM incidencies";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Afegir una nova incidència
    public function create($title, $start_date, $end_date)
    {
        $query = "INSERT INTO incidencies (title, start_date, end_date) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$title, $start_date, $end_date]);
    }

    // Eliminar una incidència
    public function delete($id)
    {
        $query = "DELETE FROM incidencies WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
