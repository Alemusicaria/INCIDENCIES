<?php
session_start();
include('connexio.php');

// Comprovar si l'usuari està logejat
if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit();
}

$usuari_id = $_SESSION['id'];
$altre_usuari_id = $_GET['usuari_id'] ?? null;

if ($altre_usuari_id) {
    // Comprovar si ja existeix una conversa entre els usuaris
    $query = "SELECT id FROM missatges WHERE (usuari1_id = $usuari_id AND usuari2_id = $altre_usuari_id) OR (usuari1_id = $altre_usuari_id AND usuari2_id = $usuari_id)";
    $resultat = mysqli_query($conn, $query);
    $conversa = mysqli_fetch_assoc($resultat);

    if ($conversa) {
        // Redirigir al xat existent
        $conversa_id = $conversa['id'];
    } else {
        // Crear una nova conversa
        $query_inserir = "INSERT INTO missatges (usuari1_id, usuari2_id) VALUES ($usuari_id, $altre_usuari_id)";
        mysqli_query($conn, $query_inserir);
        $conversa_id = mysqli_insert_id($conn);
    }

    // Redirigir a la pàgina de detall del xat
    header("Location: xat_detall.php?conversa_id=$conversa_id");
    exit();
} else {
    echo "Usuari no especificat.";
    exit();
}
