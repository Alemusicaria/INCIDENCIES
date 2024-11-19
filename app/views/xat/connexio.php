<?php
// Connexió a la base de dades
$servername = "localhost";
$username = "apratc_aprat";
$password = "AleixSteveLeandro123";
$dbname = "apratc_Incidencies";

// Crear connexió
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprovar connexió
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
