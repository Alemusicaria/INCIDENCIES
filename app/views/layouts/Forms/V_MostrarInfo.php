<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// Agafem l'ID de la URL
$id_incidencia = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id_incidencia <= 0) {
    echo "ID d'incidència no vàlid.";
    exit;
}

// Conexión a la base de datos (modifica los datos de conexión según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "incidencies";

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprovem si la connexió és correcta
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Preparem la consulta per obtenir la incidència
$sql = "SELECT * FROM incidencies WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_incidencia);
$stmt->execute();
$result = $stmt->get_result();

// Comprovem si la incidència existeix
if ($result->num_rows > 0) {
    // Obtenim la primera fila (només hi haurà una coincidència)
    $incidencia = $result->fetch_assoc();
} else {
    echo "Incidència no trobada.";
    exit;
}

// Tanquem la connexió
$stmt->close();
$conn->close();
?>

<?php
include("../../layouts/header/header.php");
?>

<body>
    <div class="wrapper">
        <?php
        include("../../layouts/menu/menu.php");
        ?>

        <div class="content m-3">
            <h1> Detalls de la incidència </h1>
            <form method="post" action="#"> <!-- Si vols actualitzar la incidència, afegeix l'acció adequada -->
                <i class="fa-solid fa-pencil-alt"></i>
                <label>Titulo de la Incidencia</label>
                <div class="input-container">
                    <input type="text" name="TituloFallo" id="TituloFallo" value="<?php echo htmlspecialchars($incidencia['titol_fallo']); ?>" required>
                </div>

                <i class="fas fa-th-list"></i>
                <label>Tipo de Incidencia</label>
                <div class="input-container">
                    <select id="Categoria" name="Categoria" class="form-control" required>
                        <option value="Calefacció" <?php echo ($incidencia['tipus_incidencia'] == 'Calefacció') ? 'selected' : ''; ?>>Calefacció</option>
                        <option value="Electricitat" <?php echo ($incidencia['tipus_incidencia'] == 'Electricitat') ? 'selected' : ''; ?>>Electricitat</option>
                        <option value="Fontaner" <?php echo ($incidencia['tipus_incidencia'] == 'Fontaner') ? 'selected' : ''; ?>>Fontaner</option>
                        <option value="Informatica" <?php echo ($incidencia['tipus_incidencia'] == 'Informatica') ? 'selected' : ''; ?>>Informàtica</option>
                        <option value="Fusteria" <?php echo ($incidencia['tipus_incidencia'] == 'Fusteria') ? 'selected' : ''; ?>>Fusteria</option>
                        <option value="Ferrer" <?php echo ($incidencia['tipus_incidencia'] == 'Ferrer') ? 'selected' : ''; ?>>Ferrer</option>
                        <option value="Obres" <?php echo ($incidencia['tipus_incidencia'] == 'Obres') ? 'selected' : ''; ?>>Obres</option>
                        <option value="Audiovisual" <?php echo ($incidencia['tipus_incidencia'] == 'Audiovisual') ? 'selected' : ''; ?>>Audiovisual</option>
                        <option value="Equips de seguretat" <?php echo ($incidencia['tipus_incidencia'] == 'Equips de seguretat') ? 'selected' : ''; ?>>Equips de seguretat</option>
                        <option value="Neteja de clavegueram" <?php echo ($incidencia['tipus_incidencia'] == 'Neteja de clavegueram') ? 'selected' : ''; ?>>Neteja de clavegueram</option>
                        <option value="Altres" <?php echo ($incidencia['tipus_incidencia'] == 'Altres') ? 'selected' : ''; ?>>Altres</option>
                    </select>
                </div>

                <i class="fas fa-building"></i>
                <label>Planta</label>
                <div class="input-container">
                    <select id="Planta" name="Planta" class="form-control">
                        <option value="Planta -1" <?php echo ($incidencia['id_ubicacio'] == '-1') ? 'selected' : ''; ?>>Planta -1</option>
                        <option value="Planta 0" <?php echo ($incidencia['id_ubicacio'] == '0') ? 'selected' : ''; ?>>Planta 0</option>
                        <option value="Planta 1" <?php echo ($incidencia['id_ubicacio'] == '1') ? 'selected' : ''; ?>>Planta 1</option>
                        <option value="Planta 2" <?php echo ($incidencia['id_ubicacio'] == '2') ? 'selected' : ''; ?>>Planta 2</option>
                        <option value="Planta 3" <?php echo ($incidencia['id_ubicacio'] == '3') ? 'selected' : ''; ?>>Planta 3</option>
                        <option value="Planta 4" <?php echo ($incidencia['id_ubicacio'] == '4') ? 'selected' : ''; ?>>Planta 4</option>
                    </select>
                </div>

                <i class="fas fa-door-closed"></i>
                <label>Numero Sala</label>
                <div class="input-container">
                    <input type="text" name="Salon" id="Salon" value="<?php echo htmlspecialchars($incidencia['id_ubicacio']); ?>" required>
                </div>

                <label>Estado</label>
                <div class="input-container">
                    <input type="radio" class="btn-check" name="Estado" id="Pendent" value="Pendent" <?php echo ($incidencia['estat'] == 'Pendent') ? 'checked' : ''; ?> required>
                    <label class="btn btn-outline-success" for="Pendent">Pendent</label>

                    <input type="radio" class="btn-check" name="Estado" id="En Progrés" value="En Progrés" <?php echo ($incidencia['estat'] == 'En Progrés') ? 'checked' : ''; ?> required>
                    <label class="btn btn-outline-danger" for="En Progrés">En Progrés</label>

                    <input type="radio" class="btn-check" name="Estado" id="Resolta" value="Resolta" <?php echo ($incidencia['estat'] == 'Resolta') ? 'checked' : ''; ?> required>
                    <label class="btn btn-outline-warning" for="Resolta">Resolta</label>
                </div>

                <label>Prioritat</label>
                <div class="input-container">
                    <input type="radio" class="btn-check" name="Prioridad" id="Baixa" value="Baixa" <?php echo ($incidencia['prioritat'] == 'Baixa') ? 'checked' : ''; ?> required>
                    <label class="btn btn-outline-success" for="Baixa">Baixa</label>

                    <input type="radio" class="btn-check" name="Prioridad" id="Mitjana" value="Mitjana" <?php echo ($incidencia['prioritat'] == 'Mitjana') ? 'checked' : ''; ?> required>
                    <label class="btn btn-outline-danger" for="Mitjana">Mitjana</label>

                    <input type="radio" class="btn-check" name="Prioridad" id="Alta" value="Alta" <?php echo ($incidencia['prioritat'] == 'Alta') ? 'checked' : ''; ?> required>
                    <label class="btn btn-outline-warning" for="Alta">Alta</label>
                </div>

                <i class="fas fa-camera"></i>
                <label>Foto</label>
                <input type="file" class="form-control" name="Foto" id="Foto">

                <i class="fas fa-pencil-alt"></i>
                <label>Descripció</label>
                <textarea name="Descripcio" id="Descripcio" rows="6"><?php echo htmlspecialchars($incidencia['descripcio']); ?></textarea>
            </form>
        </div>
    </div>
</body>