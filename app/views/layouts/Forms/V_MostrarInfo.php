<?php

// Comprova si existeix la variable $incidencia
if (isset($incidencia)) {
?>

    <style>
        /* Estil per a camps només de lectura */
        .readonly-input {
            background-color: #e9ecef;
            /* Fons gris clar */
            color: #495057;
            /* Color del text */
            cursor: not-allowed;
            /* Indica que no es pot modificar */
        }
    </style>

    <!-- Formulari per mostrar els detalls de la incidència -->
    <form method="post" action="#" enctype="multipart/form-data">
        <!-- Nom de l'usuari que ha creat la incidència -->
        <div class="mb-2">
            <label class="perfil-label">Usuari</label>
            <input type="text" class="form-control readonly-input"
                value="<?php echo isset($incidencia['creador_nom_cognoms']) ? htmlspecialchars($incidencia['creador_nom_cognoms'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly>
        </div>

        <!-- Títol de la incidència -->
        <div class="mb-2">
            <label class="perfil-label">Títol de la Incidència</label>
            <input type="text" class="form-control readonly-input"
                value="<?php echo isset($incidencia['titol_fallo']) ? htmlspecialchars($incidencia['titol_fallo'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly>
        </div>

        <!-- Descripció de la incidència -->
        <div class="mb-2">
            <label class="perfil-label">Descripció</label>
            <textarea class="form-control readonly-input" name="Descripcio" id="Descripcio" rows="4" readonly>
                <?php echo isset($incidencia['descripcio']) ? htmlspecialchars($incidencia['descripcio'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
        </div>

        <!-- Tipus de la incidència -->
        <div class="mb-2">
            <label class="perfil-label">Tipus d'Incidència</label>
            <input type="text" class="form-control readonly-input"
                value="<?php echo isset($incidencia['tipus_incidencia']) ? htmlspecialchars($incidencia['tipus_incidencia'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly>
        </div>

        <!-- Estat actual de la incidència -->
        <div class="mb-2">
            <label class="perfil-label">Estat</label>
            <input type="text" class="form-control readonly-input"
                value="<?php echo isset($incidencia['estat']) ? htmlspecialchars($incidencia['estat'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly>
        </div>

        <!-- Prioritat de la incidència -->
        <div class="mb-2">
            <label class="perfil-label">Prioritat</label>
            <input type="text" class="form-control readonly-input"
                value="<?php echo isset($incidencia['prioritat']) ? htmlspecialchars($incidencia['prioritat'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly>
        </div>

        <!-- Descripció de tancament si existeix -->
        <label>Descripció Tancament</label>
        <div class="input-container">
            <?php
            if (isset($incidencia['descripcio_resolta']) && !empty($incidencia['descripcio_resolta'])) {
                echo '<textarea class="form-control readonly-input" name="DescripcioResolta" id="DescripcioResolta" rows="4" readonly>' . htmlspecialchars($incidencia['descripcio_resolta'], ENT_QUOTES, 'UTF-8') . '</textarea>';
            }
            ?>
        </div>

        <!-- Data de creació de la incidència -->
        <div class="mb-2">
            <label class="perfil-label">Data de la Incidència</label>
            <input type="text" class="form-control readonly-input"
                value="<?php echo isset($incidencia['data_incidencia']) ? htmlspecialchars($incidencia['data_incidencia'], ENT_QUOTES, 'UTF-8') : ''; ?>" readonly>
        </div>

        <!-- Mostra les imatges associades a la incidència -->
        <label>Imatges</label>
        <div class="input-container">
            <?php
            if (isset($incidencia['imatges']) && !empty($incidencia['imatges'])) {
                $imagenes = is_array($incidencia['imatges']) ? $incidencia['imatges'] : explode(',', $incidencia['imatges']);

                foreach ($imagenes as $imagen) {
                    if (!empty($imagen)) {
                        echo "<img src='$imagen' alt='Imatge de la incidència' class='img-thumbnail' style='max-width: 200px; margin-right: 10px;'>";
                    }
                }
            } else {
                echo "<p>No hi ha imatges disponibles.</p>";
            }
            ?>
        </div>
    </form>

    <!-- Formulari per mostrar la ubicació si existeix -->
    <?php if (isset($ubicacion)): ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-2">
                <label class="perfil-label">Planta</label>
                <input type="text" id="planta" name="planta" class="form-control readonly-input"
                    value="<?= htmlspecialchars($ubicacion['planta']) ?>" readonly>
            </div>

            <div class="mb-2">
                <label class="perfil-label">Sala</label>
                <input type="text" id="sala" name="sala" class="form-control readonly-input"
                    value="<?= htmlspecialchars($ubicacion['sala']) ?>" readonly>
            </div>
        </form>
    <?php else: ?>
        <div class="alert alert-danger">No s'han trobat dades de la ubicació.</div>
    <?php endif; ?>

    <?php
    // Comprova si l'usuari loguejat és el creador de la incidència
    if (isset($incidencia['id_usuari']) && $incidencia['id_usuari'] == $_SESSION['id']) {
        // Mostra botons d'editar i eliminar si és el creador
        echo "<a href='index.php?controller=Editar_Incidencia&method=verificar_id_incidencia&id=" . htmlspecialchars($incidencia['id'], ENT_QUOTES, 'UTF-8') . "' class='btn btn-primary'>Editar</a>";
        echo "<a href='index.php?controller=...&method=...&id=" . htmlspecialchars($incidencia['id'], ENT_QUOTES, 'UTF-8') . "' class='btn btn-danger'>Eliminar</a>";
    } elseif (isset($incidencia['id'])) {
        // Mostra només el botó d'eliminar si no és el creador
        echo "<a href='index.php?controller=...&method=...&id=" . htmlspecialchars($incidencia['id'], ENT_QUOTES, 'UTF-8') . "' class='btn btn-danger'>Eliminar</a>";
    } else {
        // Missatge d'error si no hi ha un ID vàlid
        echo "<div class='alert alert-danger'>La incidència no té un ID vàlid.</div>";
    }
    ?>

<?php
} else {
    // Missatge d'error si no s'ha trobat la incidència
    echo "<div class='alert alert-danger'>No s'han trobat dades de la incidència.</div>";
}
?>