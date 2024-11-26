<?php
require "app/models/perfil.php"; // Inclou el model 'perfil' per gestionar dades relacionades amb el perfil de l'usuari.

/**
 * Controlador per gestionar les accions relacionades amb el perfil de l'usuari.
 */
class PerfilController
{
    /**
     * Mostra la informació del perfil de l'usuari.
     * Aquest mètode carrega la vista corresponent amb les dades del perfil.
     */
    public function info()
    {
        require "app/views/perfil.php"; // Carrega la vista 'perfil.php'.
    }


    public function editar()
    {
        require "app/views/perfil.php"; // Carrega la vista 'perfil.php
    }

    public function habilitar()
    {
        if (isset($_POST['id'])) {
            $userId = $_POST['id'];

            // Incloure la connexió a la base de dades
            // Connexió a la base de dades
            $servername = "localhost";
            $username = "root";
            $password = "";

            // Credencials d'accés a la base de dades desde la web
            //$servername = "apratc-Incidencies.db.tb-hosting.com";
            //$username = "apratc_aprat"; 
            //$password = "AleixSteveLeandro123";
            $dbname = "apratc_Incidencies"; // Nom de la base de dades a la qual es vol connectar

            // Crear connexió
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Comprovar connexió
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Passar la connexió a la classe perfil
            $perfil = new perfil($conn); // Passa la connexió al constructor de la classe perfil

            $perfil->updateHabilitado($userId);
            header("Location: index.php?controller=Login&method=gestionar_usuaris");
            exit();
        }
    }

    public function deshabilitar()
    {
        if (isset($_POST['id'])) {
            $userId = $_POST['id'];

            // Incloure la connexió a la base de dades
            // Connexió a la base de dades
            $servername = "localhost";
            $username = "root";
            $password = "";

            // Credencials d'accés a la base de dades desde la web
            //$servername = "apratc-Incidencies.db.tb-hosting.com";
            //$username = "apratc_aprat"; 
            //$password = "AleixSteveLeandro123";
            $dbname = "apratc_Incidencies"; // Nom de la base de dades a la qual es vol connectar

            // Crear connexió
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Comprovar connexió
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Passar la connexió a la classe perfil
            $perfil = new perfil($conn); // Passa la connexió al constructor de la classe perfil

            $perfil->updateDeshabilitado($userId);
            header("Location: index.php?controller=Login&method=gestionar_usuaris");
            exit();
        }
    }
}
