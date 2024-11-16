<?php
if (isset($incidencia)) {
    // Mostrar los datos de la incidencia
?>
    <form method="post" action="#">

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
        <?php if (!empty($incidencia['imatges'])): ?>
            <label>Imágenes</label>
            <div class="input-container">
                <?php
                $images = explode(',', $incidencia['imatges']);
                foreach ($images as $image) {
                    echo '<img src="ruta/a/las/imagenes/' . htmlspecialchars($image, ENT_QUOTES, 'UTF-8') . '" alt="Imagen de la incidencia" class="img-thumbnail" style="max-width: 200px; margin: 5px;">';
                }
                ?>
            </div>
        <?php endif; ?>
    </form>

    <!-- Formulario de Ubicación -->
    <?php if (isset($ubicacion)): ?>
        <form action="" method="post">
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

<?php
} else {
    echo "<div class='alert alert-danger'>No se encontraron datos de la incidencia.</div>";
}
?>