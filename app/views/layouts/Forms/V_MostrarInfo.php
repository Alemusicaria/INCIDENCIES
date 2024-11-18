<?php
if (isset($incidencia)) {
    // Mostrar los datos de la incidencia
?>
    <form method="post" action="#" enctype="multipart/form-data">

        <!-- Nombre del Usuario -->
        <label>Usuario</label>
        <div class="input-container">
            <input type="text" value="<?php echo isset($incidencia['creador_nom_cognoms']) ? htmlspecialchars($incidencia['creador_nom_cognoms'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly>
        </div>

        <!-- Título de la Incidencia -->
        <label>Título de la Incidencia</label>
        <div class="input-container">
            <input type="text" name="TituloFallo" id="TituloFallo"
                value="<?php echo isset($incidencia['titol_fallo']) ? htmlspecialchars($incidencia['titol_fallo'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly required>
        </div>

        <!-- Descripción -->
        <label>Descripción</label>
        <div class="input-container">
            <textarea name="Descripcio" id="Descripcio" rows="6" readonly><?php echo isset($incidencia['descripcio']) ? htmlspecialchars($incidencia['descripcio'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
        </div>

        <!-- Tipo de Incidencia -->
        <label>Tipo de Incidencia</label>
        <div class="input-container">
            <input type="text" value="<?php echo isset($incidencia['tipus_incidencia']) ? htmlspecialchars($incidencia['tipus_incidencia'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly>
        </div>

        <!-- Estado -->
        <label>Estado</label>
        <div class="input-container">
            <input type="text" value="<?php echo isset($incidencia['estat']) ? htmlspecialchars($incidencia['estat'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly>
        </div>

        <!-- Prioridad -->
        <label>Prioridad</label>
        <div class="input-container">
            <input type="text" value="<?php echo isset($incidencia['prioritat']) ? htmlspecialchars($incidencia['prioritat'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly>
        </div>

        <!-- Fecha de la Incidencia -->
        <label>Fecha de la Incidencia</label>
        <div class="input-container">
            <input type="text" value="<?php echo isset($incidencia['data_incidencia']) ? htmlspecialchars($incidencia['data_incidencia'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly>
        </div>

        <!-- Imágenes -->
        <label>Imágenes</label>
        <div class="input-container">
            <?php
            // Verificamos si 'imatges' existe y es una cadena no vacía
            if (isset($incidencia['imatges']) && !empty($incidencia['imatges'])) {
                // Si 'imatges' es una cadena, convertirla en un array
                $imagenes = is_array($incidencia['imatges']) ? $incidencia['imatges'] : explode(',', $incidencia['imatges']);
                
                foreach ($imagenes as $imagen) {
                    // Comprobar que la imagen no esté vacía
                    if (!empty($imagen)) {
                        echo "<img src='$imagen' alt='Imagen de la incidencia' class='img-thumbnail' style='max-width: 200px; margin-right: 10px;'>";
                    }
                }
            } else {
                echo "<p>No hay imágenes disponibles.</p>";
            }
            ?>
        </div>
    </form>

    <!-- Formulario de Ubicación -->
    <?php if (isset($ubicacion)): ?>
        <form action="" method="post" enctype="multipart/form-data">
            <label>Planta</label>
            <div class="input-container">
                <input type="text" id="planta" name="planta" value="<?= htmlspecialchars($ubicacion['planta']) ?>" readonly>
            </div>
            
            <label>Sala</label>
            <div class="input-container">
                <input type="text" id="sala" name="sala" value="<?= htmlspecialchars($ubicacion['sala']) ?>" readonly>
            </div>
        </form>
    <?php else: ?>
        <div class="alert alert-danger">No se encontraron datos de la ubicación.</div>
    <?php endif; ?>


    <!-- Verificación y botones -->
    <?php
    // Verifica si la incidencia tiene un 'creador_id' y si el usuario logueado es el mismo
    if (isset($incidencia['id_usuari']) && $incidencia['id_usuari'] == $_SESSION['id']) {
        // Si el usuario logueado es el creador de la incidencia, mostrar "Editar" y "Eliminar"
        echo "<a href='index.php?controller=Editar_Incidencia&method=verificar_id_incidencia&id=" . htmlspecialchars($incidencia['id'], ENT_QUOTES, 'UTF-8') . "' class='btn btn-primary'>Editar</a>";
        echo "<a href='index.php?controller=...&method=...&id=" . htmlspecialchars($incidencia['id'], ENT_QUOTES, 'UTF-8') . "' class='btn btn-danger'>Eliminar</a>";
    } elseif (isset($incidencia['id'])) {
        // Si no es el creador, solo mostrar "Eliminar"
        echo "<a href='index.php?controller=...&method=...&id=" . htmlspecialchars($incidencia['id'], ENT_QUOTES, 'UTF-8') . "' class='btn btn-danger'>Eliminar</a>";
    } else {
        // Si la incidencia no tiene un ID válido
        echo "<div class='alert alert-danger'>La incidencia no tiene un ID válido.</div>";
    }
?>

<?php
} else {
    echo "<div class='alert alert-danger'>No se encontraron datos de la incidencia.</div>";
}


?>