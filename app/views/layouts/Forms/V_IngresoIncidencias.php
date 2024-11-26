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

        <div class="main p-3">
            <div class="tittle-page">
                <h2>Afegeix Incidencia</h2>
            </div>
        
            <div class="card">
                <div class="card-header">
                    <i class="lni lni-pencil-alt"></i>
                    Formulari
                </div>

                <div class="card-body">
                    <form action="index.php?controller=Incidencias&method=Ingresar_Incidencias" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="TituloFallo" class="perfil-label">Titulo de la Incidencia </label>
                            <input type="text" class="form-control" id="TituloFallo" name="TituloFallo"required>
                        </div>

                        <div class="form-group">
                            <label class="perfil-label" for="Descripcion">Descripcion</label>
                            <input type="text" class="form-control" id="Descripcion" name="Descripcion" required>
                        </div>

                        <div class="form-group">
                        <label class="perfil-label" for="Tipo">Tipo de Incidencia</label>
                            <select id="Categoria" name="Categoria" class="form-control"required>   
                                <option value="">Selecciona una categoría</option>     
                                <option value="Calefaccio"> Calefacció<br>
                                <option value="Electricitat"> Electricitat<br>
                                <option value="Fontaner"> Fontaner<br>
                                <option value="Informatica"> Informàtica<br> 
                                <option value="Fusteria"> Fusteria<br>
                                <option value="Ferrer"> Ferrer<br>
                                <option value="Obres"> Obres<br>
                                <option value="Audiovisual"> Audiovisual<br>
                                <option value="Equips de seguretat"> Equips de seguretat<br>
                                <option value="Neteja de clavegueram"> Neteja de clavegueram<br>
                                <option value="Otros"> Otros<br>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="perfil-label" for="Planta">Planta</label>
                            <select id="Planta" name="Planta" class="form-control" required onchange="cargarSalas()">
                                <option value="">Selecciona una planta</option>
                                <option value="Planta -1">Planta -1</option>
                                <option value="Planta 0">Planta 0</option>
                                <option value="Planta 1">Planta 1</option>
                                <option value="Planta 2">Planta 2</option>
                                <option value="Planta 3">Planta 3</option>
                                <option value="Planta 4">Planta 4</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="perfil-label" for="Salon">Número de Sala</label>
                            <select id="Salon" name="Salon" class="form-control" required>
                                <option value="">Selecciona una planta primero</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="perfil-label" for="Prioridad">Prioridad</label>
                            <div class="radio-group">
                                <input type="radio" class="btn-check" name="Prioridad" id="Baixa" value="Baixa" required>
                                <label class="btn btn-outline-success" for="Baixa">Baixa</label>

                                <input type="radio" class="btn-check" name="Prioridad" id="Mitjana" value="Mitjana" required>
                                <label class="btn btn-outline-warning" for="Mitjana">Mitjana</label>

                                <input type="radio" class="btn-check" name="Prioridad" id="Alta" value="Alta" required>
                                <label class="btn btn-outline-danger" for="Alta">Alta</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="perfil-label" for="Foto">Foto</label>
                            <input type="file" class="form-control" name="Foto[]" id="Foto" multiple>
                        </div>

                        <div class ="form-group">
                        <label class="perfil-label" for="Tecnico">Necesitas Tecnico</label>
                            <select id="Tecnico" name="Tecnico" class="form-control" required>
                                <option value="">Selecciona una opción</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>

                                
                            </select>
                        </div>

                        <div id="formulario-tecnico">
                            <h3>Formulario para técnico</h3>
                            <div class="form-group">
                                <label for="descripcion-problema">Descripción del problema:</label>
                                <textarea id="descripcion-problema" name="descripcion-problema" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="prioridad">Prioridad:</label>
                                <select id="prioridad" name="prioridad" class="form-control" required>
                                    <option value="">Selecciona una prioridad</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Media">Media</option>
                                    <option value="Baja">Baja</option>
                                </select>
                            </div>
                        </div>

                        
                        
                        <button type="submit" class="btn btn-primary">Insertar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="assets/js/cargarSalas.js"></script>
<script>
        // Escuchar cambios en el selector
        document.getElementById('Tecnico').addEventListener('change', function () {
            const formularioTecnico = document.getElementById('formulario-tecnico');
            if (this.value === 'Si') {
                // Mostrar el formulario adicional
                formularioTecnico.style.display = 'block';
            } else {
                // Ocultar el formulario adicional
                formularioTecnico.style.display = 'none';
            }
        });
    </script>