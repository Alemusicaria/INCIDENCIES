<?php
if (isset($datos_incidencia)) {
    // Mostrar los datos de la incidencia
?>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<?php
include("app/views/layouts/header/header.php"); // Aquí se incluye la barra lateral
?>

<body>
    <div class="wrapper">
        <?php
        include("app/views/layouts/menu/menu.php"); // Aquí se incluye la barra lateral
        ?>
    </div>

    <div class="main p-3">        
        <div class="tittle-page">
            <h2>Editar Incidència</h2>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="lni lni-pencil-alt"></i>
                Formulari
            </div>

            <div class="card-body">
                <form action="index.php?controller=Editar_Incidencia&method=actualizar_datos_incidencia" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($datos_incidencia['id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

                    <div class="form-group">
                    <label class="perfil-label" for="TituloFallo">Título de la Incidencia</label>
                    <input 
                        type="text" class="form-control" id="TituloFallo" name="TituloFallo" 
                        value="<?= htmlspecialchars($datos_incidencia['titol_fallo'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" >
                    </div>

                    <div class="form-group">
                    <label class="perfil-label" for="Descripcion">Descripción</label>
                        <input type="text" class="form-control" id="Descripcion" name="Descripcion" 
                            value="<?= htmlspecialchars($datos_incidencia['descripcio'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </div>

                    <div class="form-group">
                        <label class="perfil-label" for="Tipo">Tipo de Incidencia</label>
                        <select id="Categoria" name="Categoria" class="form-control" required>  
                            <option value="">Selecciona una categoría</option>
                            <option value="Calefaccio" <?= (isset($datos_incidencia['categoria']) && $datos_incidencia['categoria'] === 'Calefaccio') ? 'selected' : ''; ?>>Calefacció</option>
                            <option value="Electricitat" <?= (isset($datos_incidencia['categoria']) && $datos_incidencia['categoria'] === 'Electricitat') ? 'selected' : ''; ?>>Electricitat</option>
                            <option value="Fontaner" <?= (isset($datos_incidencia['categoria']) && $datos_incidencia['categoria'] === 'Fontaner') ? 'selected' : ''; ?>>Fontaner</option>
                            <option value="Informatica" <?= (isset($datos_incidencia['categoria']) && $datos_incidencia['categoria'] === 'Informatica') ? 'selected' : ''; ?>>Informàtica</option>
                            <option value="Fusteria" <?= (isset($datos_incidencia['categoria']) && $datos_incidencia['categoria'] === 'Fusteria') ? 'selected' : ''; ?>>Fusteria</option>
                            <option value="Ferrer" <?= (isset($datos_incidencia['categoria']) && $datos_incidencia['categoria'] === 'Ferrer') ? 'selected' : ''; ?>>Ferrer</option>
                            <option value="Obres" <?= (isset($datos_incidencia['categoria']) && $datos_incidencia['categoria'] === 'Obres') ? 'selected' : ''; ?>>Obres</option>
                            <option value="Audiovisual" <?= (isset($datos_incidencia['categoria']) && $datos_incidencia['categoria'] === 'Audiovisual') ? 'selected' : ''; ?>>Audiovisual</option>
                            <option value="Equips de seguretat" <?= (isset($datos_incidencia['categoria']) && $datos_incidencia['categoria'] === 'Equips de seguretat') ? 'selected' : ''; ?>>Equips de seguretat</option>
                            <option value="Neteja de clavegueram" <?= (isset($datos_incidencia['categoria']) && $datos_incidencia['categoria'] === 'Neteja de clavegueram') ? 'selected' : ''; ?>>Neteja de clavegueram</option>
                            <option value="Otros" <?= (isset($datos_incidencia['categoria']) && $datos_incidencia['categoria'] === 'Otros') ? 'selected' : ''; ?>>Otros</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="perfil-label" for="Planta">Planta</label>
                        <select 
                            id="Planta" name="Planta" class="form-control" required onchange="cargarSalas()">
                            <option value="">Selecciona una planta</option>
                            <option value="Planta -1" <?= (isset($datos_incidencia['planta']) && $datos_incidencia['planta'] === 'Planta -1') ? 'selected' : ''; ?>>Planta -1</option>
                            <option value="Planta 0" <?= (isset($datos_incidencia['planta']) && $datos_incidencia['planta'] === 'Planta 0') ? 'selected' : ''; ?>>Planta 0</option>
                            <option value="Planta 1" <?= (isset($datos_incidencia['planta']) && $datos_incidencia['planta'] === 'Planta 1') ? 'selected' : ''; ?>>Planta 1</option>
                            <option value="Planta 2" <?= (isset($datos_incidencia['planta']) && $datos_incidencia['planta'] === 'Planta 2') ? 'selected' : ''; ?>>Planta 2</option>
                            <option value="Planta 3" <?= (isset($datos_incidencia['planta']) && $datos_incidencia['planta'] === 'Planta 3') ? 'selected' : ''; ?>>Planta 3</option>
                            <option value="Planta 4" <?= (isset($datos_incidencia['planta']) && $datos_incidencia['planta'] === 'Planta 4') ? 'selected' : ''; ?>>Planta 4</option>
                        </select>
                    </div>

                    <div class="form-group">
                    <label class="perfil-label" for="Salon">Número de Sala</label>
                        <select 
                            id="Salon" name="Salon" class="form-control" required>
                            <option value="">Selecciona una planta primero</option>
                            <!-- Aquí deberías cargar las opciones dinámicamente con JavaScript según la planta seleccionada -->
                        </select>
                    </div>

                    <div>
                        <label class="perfil-label" for="Estat">Estat</label>
                        <div class="radio-group">
                            <input type="radio" class="btn-check" name="Estat" id="Pendent" value="Pendent" 
                                <?= (isset($datos_incidencia['estat']) && $datos_incidencia['estat'] === 'Pendent') ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-azul" for="Pendent">Pendent</label>

                            <input type="radio" class="btn-check" name="Estat" id="En Progrés" value="En Progrés" 
                                <?= (isset($datos_incidencia['estat']) && $datos_incidencia['estat'] === 'En Progrés') ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-amber" for="En Progrés">En Progrés</label>

                            <input type="radio" class="btn-check" name="Estat" id="Resolta" value="Resolta" 
                                <?= (isset($datos_incidencia['estat']) && $datos_incidencia['estat'] === 'Resolta') ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-olive" for="Resolta">Resolta</label>
                            <!--
                            <input type="radio" class="btn-check" name="Estat" id="Pendent" value="Pendent" 
                                <?= (isset($datos_incidencia['estat']) && $datos_incidencia['estat'] === 'Pendent') ? 'checked' : ''; ?> >
                            <label class="btn btn-outline-success" for="Pendent">Pendent</label>

                            <input type="radio" class="btn-check" name="Estat" id="En Progrés" value="En Progrés" 
                                <?= (isset($datos_incidencia['estat']) && $datos_incidencia['estat'] === 'En Progrés') ? 'checked' : ''; ?> >
                            <label class="btn btn-outline-warning" for="En Progrés">En Progrés</label>

                            <input type="radio" class="btn-check" name="Estat" id="Resolta" value="Resolta" 
                                <?= (isset($datos_incidencia['estat']) && $datos_incidencia['estat'] === 'Resolta') ? 'checked' : ''; ?> >
                            <label class="btn btn-outline-danger" for="Resolta">Resolta</label> -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="perfil-label" for="Prioridad">Prioridad</label>
                        <div class="radio-group">
                            <input type="radio" class="btn-check" name="Prioridad" id="Baixa" value="Baixa" 
                                <?= (isset($datos_incidencia['prioritat']) && $datos_incidencia['prioritat'] === 'Baixa') ? 'checked' : ''; ?>>
                            <label class="btn btn-outline-success" for="Baixa">Baixa</label>

                            <input type="radio" class="btn-check" name="Prioridad" id="Mitjana" value="Mitjana" 
                                <?= (isset($datos_incidencia['prioritat']) && $datos_incidencia['prioritat'] === 'Mitjana') ? 'checked' : ''; ?> >
                            <label class="btn btn-outline-warning" for="Mitjana">Mitjana</label>

                            <input type="radio" class="btn-check" name="Prioridad" id="Alta" value="Alta" 
                                <?= (isset($datos_incidencia['prioritat']) && $datos_incidencia['prioritat'] === 'Alta') ? 'checked' : ''; ?> >
                            <label class="btn btn-outline-danger" for="Alta">Alta</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="perfil-label" for="Descripcio_resolta">Descripcio Resolta</label>
                        <input type="text" class="form-control" id="Descripcio_resolta" name="Descripcio_resolta" 
                            value="<?= htmlspecialchars($datos_incidencia['descripcio_resolta'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </div>

        <!-- Mostrar las imágenes actuales con checkbox para eliminarlas -->
        <div class="form-group">
            <label for="Imagenes">Imágenes actuales</label>
            <div class="imagenes">
                <?php
                // Verifica si hay imágenes asociadas a la incidencia
                if (!empty($datos_incidencia['imatges'])) {
                    $imagenes = explode(",", $datos_incidencia['imatges']);
                    foreach ($imagenes as $index => $imagen) {
                        // Sanitizar la URL de la imagen para evitar problemas de seguridad
                        $imagen_sanitizada = htmlspecialchars($imagen, ENT_QUOTES, 'UTF-8');
                        ?>
                        <div class="imagen-item mb-3">
                            <!-- Mostrar la imagen pequeña -->
                            <img src="<?= $imagen_sanitizada; ?>" alt="Imagen de la incidencia" class="img-thumbnail" style="max-width: 150px; height: auto;">
                            
                            <!-- Checkbox para eliminar esta imagen -->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="eliminar_imagenes[]" value="<?= $imagen_sanitizada; ?>" id="eliminar_<?= $index; ?>">
                                <label class="form-check-label" for="eliminar_<?= $index; ?>">Eliminar esta imagen</label>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No hay imágenes actuales disponibles.</p>";
                }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="Foto">Afegir Imatges</label>
            <input type="file" class="form-control" name="Foto[]" id="Foto" multiple>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
        
                </form>
            </div>
        </div>   
    </div>

             
</body>

<?php
} else {
    echo "<div class='alert alert-danger'>No se encontraron datos de la incidencia.</div>";
}


?>

<script src="assets/js/cargarSalas.js"></script>


