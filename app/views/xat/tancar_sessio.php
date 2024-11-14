<?php
session_start();

// Comprovar si la sessió ja està iniciada
if (isset($_SESSION['id'])) {
    session_unset();
    session_destroy();
}

header('Location: login.html');
exit();
