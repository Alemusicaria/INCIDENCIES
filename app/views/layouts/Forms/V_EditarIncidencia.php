<?php
if (isset($datos_incidencia)) {
    // Mostrar los datos de la incidencia
?>
    <div class="form-group">
    <label for="TituloFallo">Título de la Incidencia</label>
    <input 
        type="text" class="form-control" id="TituloFallo" name="TituloFallo" 
        value="<?= htmlspecialchars($datos_incidencia['titol_fallo'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" >
</div>

<div class="form-group">
    <label for="Descripcion">Descripción</label>
    <input type="text" class="form-control" id="Descripcion" name="Descripcion" 
        value="<?= htmlspecialchars($datos_incidencia['descripcio'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
</div>

<div class="form-group">
    <label for="Tipo">Tipo de Incidencia</label>
    <select id="Categoria" name="Categoria" class="form-control" >        
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
    <label for="Planta">Planta</label>
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
    <label for="Salon">Número de Sala</label>
    <select 
        id="Salon" name="Salon" class="form-control">
        <option value="">Selecciona una planta primero</option>
        <!-- Aquí deberías cargar las opciones dinámicamente con JavaScript según la planta seleccionada -->
    </select>
</div>

<div>
    <label for="Estat">Estat</label>
    <div class="radio-group">
        <input type="radio" class="btn-check" name="Estat" id="Pendent" value="Pendent" 
            <?= (isset($datos_incidencia['estat']) && $datos_incidencia['estat'] === 'Pendent') ? 'checked' : ''; ?> >
        <label class="btn btn-outline-success" for="Pendent">Pendent</label>

        <input type="radio" class="btn-check" name="Estat" id="En Progrés" value="En Progrés" 
            <?= (isset($datos_incidencia['estat']) && $datos_incidencia['estat'] === 'En Progrés') ? 'checked' : ''; ?> >
        <label class="btn btn-outline-danger" for="En Progrés">En Progrés</label>

        <input type="radio" class="btn-check" name="Estat" id="Resolta" value="Resolta" 
            <?= (isset($datos_incidencia['estat']) && $datos_incidencia['estat'] === 'Resolta') ? 'checked' : ''; ?> >
        <label class="btn btn-outline-warning" for="Resolta">Resolta</label>
    </div>
</div>

<div class="form-group">
    <label for="Prioridad">Prioridad</label>
    <div class="radio-group">
        <input type="radio" class="btn-check" name="Prioridad" id="Baixa" value="Baixa" 
            <?= (isset($datos_incidencia['prioritat']) && $datos_incidencia['prioritat'] === 'Baixa') ? 'checked' : ''; ?>>
        <label class="btn btn-outline-success" for="Baixa">Baixa</label>

        <input type="radio" class="btn-check" name="Prioridad" id="Mitjana" value="Mitjana" 
            <?= (isset($datos_incidencia['prioritat']) && $datos_incidencia['prioritat'] === 'Mitjana') ? 'checked' : ''; ?> >
        <label class="btn btn-outline-danger" for="Mitjana">Mitjana</label>

        <input type="radio" class="btn-check" name="Prioridad" id="Alta" value="Alta" 
            <?= (isset($datos_incidencia['prioritat']) && $datos_incidencia['prioritat'] === 'Alta') ? 'checked' : ''; ?> >
        <label class="btn btn-outline-warning" for="Alta">Alta</label>
    </div>
</div>




<div class="form-group">
    <label for="Imatges">Imatges</label>
    <input  type="file" class="form-control" name="Imatges[]" id="Imatges" multiple>
</div>


<div class="form-group">
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>





<?php
} else {
    echo "<div class='alert alert-danger'>No se encontraron datos de la incidencia.</div>";
}


?>

<script src="assets/js/cargarSalas.js"></script>


