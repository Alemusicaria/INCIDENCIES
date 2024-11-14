<?php
// Verificar que les dades de la incidència han estat passades correctament
if (isset($incidencia)) {
    ?>

    <!-- Formulari per mostrar la informació de la incidència -->
    <form method="post" action="#">
        <i class="fa-solid fa-pencil-alt"></i>
        <label>Títol de la Incidència</label>
        <div class="input-container">
            <input type="text" name="TituloFallo" id="TituloFallo"
                value="<?php echo htmlspecialchars($incidencia['titol_fallo']); ?>" readonly required>
        </div>

        <i class="fas fa-th-list"></i>
        <label>Tipus d'Incidència</label>
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($incidencia['tipus_incidencia']); ?>" readonly>
        </div>

        <i class="fas fa-building"></i>
        <label>Planta</label>
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($incidencia['id_ubicacio']); ?>" readonly>
        </div>

        <i class="fas fa-door-closed"></i>
        <label>Número Sala</label>
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($incidencia['id_ubicacio']); ?>" readonly>
        </div>

        <i class="fas fa-pencil-alt"></i>
        <label>Descripció</label>
        <div class="input-container">
            <textarea name="Descripcio" id="Descripcio" rows="6"
                readonly><?php echo htmlspecialchars($incidencia['descripcio']); ?></textarea>
        </div>

        <label>Estat</label>
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($incidencia['estat']); ?>" readonly>
        </div>

        <label>Prioritat</label>
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($incidencia['prioritat']); ?>" readonly>
        </div>

        <?php if (!empty($incidencia['imatges'])): ?>
            <label>Imatges</label>
            <div class="input-container">
                <?php
                // Comprova si hi ha imatges i mostra-les
                $images = explode(',', $incidencia['imatges']); // Assumim que les imatges estan separades per comes
                foreach ($images as $image) {
                    echo '<img src="ruta/a/les/imatges/' . htmlspecialchars($image) . '" alt="Imatge de la incidència" class="img-thumbnail" style="max-width: 200px; margin: 5px;">';
                }
                ?>
            </div>
        <?php endif; ?>
    </form>

    <!-- Botons d'acció -->
    <div class="action-buttons">
        <button type="button" class="btn btn-primary"
            onclick="window.location.href='index.php?controller=Info_IncidenciasController&method=mostrar_incidencia&id=<?php echo $incidencia['id']; ?>'">
            <i class="fa fa-pencil-alt"></i> Editar
        </button>
        <button type="button" class="btn btn-danger" onclick="confirmDelete(<?php echo $incidencia['id']; ?>)">
            <i class="fa fa-trash"></i> Eliminar
        </button>
        <button type="button" class="btn btn-info" onclick="shareIncidencia(<?php echo $incidencia['id']; ?>)">
            <i class="fa fa-share"></i> Compartir
        </button>
    </div>

    <script>
        // Funció per eliminar la incidència
        function confirmDelete(id) {
            if (confirm('Estàs segur que vols eliminar aquesta incidència?')) {
                window.location.href = 'index.php?controller=Info_IncidenciasController&method=eliminar_incidencia&id=' + id;
            }
        }

        // Funció per compartir la incidència
        function shareIncidencia(id) {
            alert('Compartint incidència ' + id);
        }
    </script>

    <?php
} else {
    echo "No s'han trobat les dades de la incidència.";
}
?>