<?php
        require_once 'app\models\connexio.php';

if (isset($_GET['xat_id'])) {
    $xat_id = $_GET['xat_id'];

    // Obtenir els missatges del xat
    $query_missatges = "
        SELECT m.missatge, m.data, u.nom_cognoms
        FROM missatges m
        JOIN usuaris u ON m.usuari_id = u.id
        WHERE m.xat_id = $xat_id
        ORDER BY m.data ASC
    ";
    $resultat_missatges = mysqli_query($conn, $query_missatges);

    if (mysqli_num_rows($resultat_missatges) > 0) {
        while ($missatge = mysqli_fetch_assoc($resultat_missatges)) {
            echo "<div><strong>" . $missatge['nom_cognoms'] . ":</strong> " . $missatge['missatge'] . "<br><small>" . date("d/m/Y H:i", strtotime($missatge['data'])) . "</small></div>";
        }
    } else {
        echo "<p>No hi ha missatges en aquest xat.</p>";
    }
}
