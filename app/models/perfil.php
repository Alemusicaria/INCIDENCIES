<?php
class perfil
{
    private $conn;

    // Constructor que rep la connexió
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Funció per actualitzar l'estat de l'usuari a "habilitat"
    public function updateHabilitado($id)
    {
        if (!isset($this->conn)) {
            die("Error: La connexió a la base de dades no s'ha establert.");
        }
        $sql = "UPDATE usuaris SET habilitat = 1 WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    // Funció per actualitzar l'estat de l'usuari a "deshabilitat"
    public function updateDeshabilitado($id)
    {
        if (!isset($this->conn)) {
            die("Error: La connexió a la base de dades no s'ha establert.");
        }

        // Actualitzar la informació de l'usuari
        $sql = "UPDATE usuaris SET habilitat = 0 WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}
