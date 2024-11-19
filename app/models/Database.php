<?php
class Database
{
    private static $dbConnection;

    // Conexió a la base de dades
    public static function getConnection()
    {
        if (self::$dbConnection == null) {
            try {
                self::$dbConnection = new PDO('mysql:host=localhost;dbname=apratc_Incidencies', 'apratc_aprat', '');
                self::$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error en la connexió: " . $e->getMessage());
            }
        }
        return self::$dbConnection;
    }
}
