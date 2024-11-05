<?php

class Incidencia
{
    private $con;

    public function __construct()
    {
        // Connexió amb la base de dades
        $this->con = new mysqli("localhost", "root", "", "incidencies");

        // Comprovació de connexió
        if ($this->con->connect_error) {
            die("Error de connexió: " . $this->con->connect_error);
        }
    }


    public function login($data)
    {
        // Consulta SQL per verificar l'usuari i la contrasenya
        $sql = "SELECT * FROM usuaris WHERE correu = ? AND contrasenya = ?";

        // Preparar la consulta
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ss", $data['correu'], $data['contrasenya']);

        // Executar la consulta
        $stmt->execute();
        $result = $stmt->get_result();

        // Comprovar si hi ha coincidències
        return $result->num_rows > 0; // Retorna true si l'usuari existeix, sinó false
    }
    /*
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
*/
}
