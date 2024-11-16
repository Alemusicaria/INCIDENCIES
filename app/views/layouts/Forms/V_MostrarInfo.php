<?php
if (isset($incidencia)) {
    // Mostrar los datos de la incidencia para depuración
    var_dump($incidencia);  // Esto debería mostrar todos los datos de la incidencia, incluyendo planta y sala
?>
    <form method="post" action="#">
        <i class="fa-solid fa-pencil-alt"></i>
        <label>Título de la Incidencia</label>
        <div class="input-container">
            <input type="text" name="TituloFallo" id="TituloFallo"
                value="<?php echo isset($incidencia['titol_fallo']) ? htmlspecialchars($incidencia['titol_fallo'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly required>
        </div>

        <i class="fas fa-th-list"></i>
        <label>Tipo de Incidencia</label>
        <div class="input-container">
            <input type="text" value="<?php echo isset($incidencia['tipus_incidencia']) ? htmlspecialchars($incidencia['tipus_incidencia'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly>
        </div>

        <label>Planta</label>
        <div class="input-container">
            <input type="text" 
                value="<?php echo isset($incidencia['planta']) ? htmlspecialchars($incidencia['planta'], ENT_QUOTES, 'UTF-8') : 'Sin información de planta'; ?>" 
                readonly>
        </div>

        <label>Número de Sala</label>
        <div class="input-container">
            <input type="text" 
                value="<?php echo isset($incidencia['sala']) ? htmlspecialchars($incidencia['sala'], ENT_QUOTES, 'UTF-8') : 'Sin información de sala'; ?>" 
                readonly>
        </div>

        <i class="fas fa-pencil-alt"></i>
        <label>Descripción</label>
        <div class="input-container">
            <textarea name="Descripcio" id="Descripcio" rows="6" readonly><?php echo isset($incidencia['descripcio']) ? htmlspecialchars($incidencia['descripcio'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
        </div>

        <label>Estado</label>
        <div class="input-container">
            <input type="text" value="<?php echo isset($incidencia['estat']) ? htmlspecialchars($incidencia['estat'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly>
        </div>

        <label>Prioridad</label>
        <div class="input-container">
            <input type="text" value="<?php echo isset($incidencia['prioritat']) ? htmlspecialchars($incidencia['prioritat'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly>
        </div>

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

<?php
} else {
    echo "<div class='alert alert-danger'>No se encontraron datos de la incidencia.</div>";
}
?>