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
        if (isset($_POST['id'])) {

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

            $editar_perfil = new perfil($conn); // Crea una nova instància de la classe perfil.

            $dades_perfil = $editar_perfil->getPerfil($_POST['id']);

            if ($dades_perfil) {
                // Si les dades de la incidència són vàlides, carrega la vista per editar-la.
                require 'app/views/perfil_usuari.php';
            } else {
                // Si no es troben les dades, mostra un missatge d'error.
                echo "No s'ha pogut obtenir l'ID de la incidència o no existeix.";
            }
        }
    }

    public function actualitzar()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $nom = $_POST['nom_cognoms'];
            $correu = $_POST['correu'];
            $telefon = $_POST['telefon'];
            $rol = $_POST['rol'];

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

            $editar_perfil = new perfil($conn); // Crea una nova instància de la classe perfil.

            $editar_perfil->updatePerfil($id, $nom, $correu, $telefon, $rol);
            header("Location: index.php?controller=Login&method=gestionar_usuaris");
            exit();
        }
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
