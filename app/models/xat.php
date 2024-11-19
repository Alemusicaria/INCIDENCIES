<?php
class Xat
{
    // Propietat per la connexió a la base de dades
    private $db;

    // Constructor per establir la connexió amb la base de dades
    public function __construct()
    {
        $this->db = Database::getConnection(); // Suposant que tens una classe Database per la connexió
    }

    // Mètode per obtenir els detalls d'un xat per ID
    public function obtenirDetallXat($xat_id)
    {
        $query = "SELECT * FROM xats WHERE id = :xat_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':xat_id', $xat_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mètode per obtenir les converses d'un xat
    public function obtenirConverses($xat_id)
    {
        $query = "SELECT * FROM converses WHERE xat_id = :xat_id ORDER BY data_missatge ASC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':xat_id', $xat_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mètode per enviar un missatge a un xat
    public function enviarMissatge($xat_id, $missatge, $usuari_id)
    {
        $query = "INSERT INTO converses (xat_id, missatge, usuari_id, data_missatge) VALUES (:xat_id, :missatge, :usuari_id, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':xat_id', $xat_id, PDO::PARAM_INT);
        $stmt->bindParam(':missatge', $missatge, PDO::PARAM_STR);
        $stmt->bindParam(':usuari_id', $usuari_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
