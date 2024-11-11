
<form action="index.php/?controller=Incidencias&method=Ingresar_Incidencias" method="post">
   
    <div class="form-group">
        <label for="TituloFallo">Titulo de la Incidencia </label>
        <input type="text" class="form-control" id="TituloFallo" name="TituloFallo">
    </div>

    <div class="form-group">
        <label for="Descripcion">Descripcion</label>
        <input type="text" class="form-control" id="Descripcion" name="Descripcion">
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
            <option value="Equips de seguretat"> Equips de seguretat<br>
            <option value="Neteja de clavegueram"> Neteja de clavegueram<br>
            <option value="Otros"> Otros<br>
        </select>
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
        <label for="Salon">Numero Sala</label>
        <input type="text" class="form-control" id="Salon" name="Salon">
    </div>

    <div class="form-group">
        <label for="Estado">Estado</label>
        <div class="form-group">

            <input type="radio" class="btn-check" name="Estado" id="Pendent" value="Pendent" required>
            <label class="btn btn-outline-success" for="Pendent">Pendent</label>

            <input type="radio" class="btn-check" name="Estado" id="En Progrés" value="En Progrés" required>
            <label class="btn btn-outline-danger" for="En Progrés">En Progrés</label>

            <input type="radio" class="btn-check" name="Estado" id="Resolta" value="Resolta" required>
            <label class="btn btn-outline-warning" for="Resolta">Resolta</label>

        </div>
    </div>

    <div class="form-group">
        <label for="Prioridad">Prioridad</label>
        <div class="form-group">

            <input type="radio" class="btn-check" name="Prioridad" id="Baixa" value="Baixa" required>
            <label class="btn btn-outline-success" for="Baixa">Baixa</label>

            <input type="radio" class="btn-check" name="Prioridad" id="Mitjana" value="Mitjana" required>
            <label class="btn btn-outline-danger" for="Mitjana">Mitjana</label>

            <input type="radio" class="btn-check" name="Prioridad" id="Alta" value="Alta" required>
            <label class="btn btn-outline-warning" for="Alta">Alta</label>

        </div>
    </div>

    <div class="form-group">
        <label for="Foto">Foto</label>
        <input type="file" class="form-control form-control-lg" name="Foto" id="Foto">
    </div>
    

    


    <button type="submit" class="btn btn-primary">Insertar</button>
</form>

