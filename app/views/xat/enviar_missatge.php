<?php
session_start();
require_once 'app/models/connexio.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $missatge = mysqli_real_escape_string($conn, $_POST['missatge']);
    $xat_id = $_POST['xat_id'];
    $usuari_id = $_SESSION['usuari'][0];

    // Inserir el missatge a la base de dades
    $query_inserir = "
        INSERT INTO missatges (xat_id, usuari_id, missatge, data)
        VALUES ($xat_id, $usuari_id, '$missatge', NOW())
    ";

    if (mysqli_query($conn, $query_inserir)) {
        echo "Missatge enviat!";
    } else {
        echo "Error al enviar el missatge: " . mysqli_error($conn);
    }
}
