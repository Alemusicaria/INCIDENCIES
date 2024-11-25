<?php
// Connexió a la base de dades
$servername = "localhost";
$username = "root"; 
$password = "";

// Credencials d'accés a la base de dades desde la web
// $servername = "apratc-Incidencies.db.tb-hosting.com";
// $username = "apratc_aprat"; 
// $password = "AleixSteveLeandro123";
$dbname = "apratc_Incidencies"; // Nom de la base de dades a la qual es vol connectar

// Crear la connexió
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprovar si la connexió ha fallat
if ($conn->connect_error) {
    // Finalitza l'execució i mostra un missatge d'error si no es pot connectar
    die("Connection failed: " . $conn->connect_error);
}
