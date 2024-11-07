
<form action="index.php/?controller=llibre&method=crear" method="post">

    <div class="form-group">
        <label for="Nombre">Nombre Usuario</label>
        <input type="text" class="form-control" id="Nombre" name="Nombre">
    </div>
   
    <div class="form-group">
        <label for="TituloFallo">Titulo de la Incidencia </label>
        <input type="text" class="form-control" id="TituloFallo" name="TituloFallo">
    </div>

    <div class="form-group">
    <label for="Tipo">Tipo de Incidencia</label>
        <select id="Categoria" name="Categoria" class="form-control">        
            <option value="Calefaccio"> Calefacció<br>
            <option value="Electricitat"> Electricitat<br>
            <option value="Fontaner"> Fontaner<br>
            <option value="Informatica"> Informàtica<br> 
            <option value="Fusteria"> Fusteria<br>
            <option value="Ferrer"> Ferrer<br>
            <option value="Obres"> Obres<br>
            <option value="Audiovisual"> Audiovisual<br>
            <option value="Seguretat"> Equips de seguretat<br>
            <option value="Neteja"> Neteja de clavegueram<br>
            <option value="Otros"> Otros<br>
        </select>
    </div>

    <div class="form-group">
        <label for="Descripcion">Descripcion</label>
        <input type="text" class="form-control" id="Descripcion" name="Descripcion">
    </div>

    <div class="form-group">
        <label for="Prioridad">Prioridad</label>
        <div class="form-group">
            <input type="radio" name="Prioridad" value="Pendent"> Pendent<br>
            <input type="radio" name="Prioridad" value="Progrés"> En Progrés<br>
            <input type="radio" name="Prioridad" value="Resolta"> Resolta<br>
        </div>
    </div>

    <div class="form-group">
        <label for="Estado">Estado</label>
        <div class="form-group">
            <input type="radio" name="Estado" value="Baixa"> Baixa<br>
            <input type="radio" name="Estado" value="Mitjana"> En Mitjana<br>
            <input type="radio" name="Estado" value="Alta"> Alta<br>
        </div>
    </div>

    <div class="form-group">
        <label for="Planta">Planta</label>
        <select id="Planta" name="Planta" class="form-control">
            <option value="Planta -1">Planta -1</option>
            <option value="Planta 0">Planta 0</option>
            <option value="Planta 1">Planta 1</option>
            <option value="Planta 2">Planta 2</option>
            <option value="Planta 3">Planta 3</option>
            <option value="Planta 4">Planta 4</option>
        </select>
    </div>

    <div>
        <label for="Ubicacion">Numero Sala</label>
        <input type="text" class="form-control" id="Ubicacion" name="Ubicacion">
    </div>

    <div class="form-group">
        <label for="Foto">Foto</label>
        <input type="file" class="form-control form-control-lg" name="Foto" id="Foto">
    </div>
    

    


    <button type="submit" class="btn btn-primary">Insertar</button>
</form>

