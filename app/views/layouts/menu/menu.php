<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-grid-alt"></i>
        </button>
        <div class="sidebar-logo">
            <a href="#"><?php echo $_SESSION['usuario']; ?></a>
            <a href="#"><?php echo $_SESSION['rol']; ?></a>
        </div>
    </div>

    <div class="fotoperfil">
        <!-- <img src="<?php echo $_SESSION['foto_perfil']; ?>" alt="Foto de perfil"> -->
    </div>

    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="perfil.php" class="sidebar-link">
                <i class="lni lni-user"></i>
                <span>Perfil</span>
            </a>
        </li>
        <!-- MENU DEL ADMIN-->

        <?php if ($_SESSION['rol'] == 'Admin'): ?>
            <li class="sidebar-item">
                <a href="index.php?controller=Registro&method=registro" class="sidebar-link">
                    <i class="lni lni-cog"></i>
                    <span>NOU profesor</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a href="index.php?controller=Info_Incidencias&method=mostrar_tabla_incidencias" class="sidebar-link">
                    <i class="lni lni-agenda"></i>
                    <span>Gestionar Incidència</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="index.php?controller=Incidencias&method=vista_ingreso_incidencias" class="sidebar-link">
                    <i class="lni lni-agenda"></i>
                    <span>Gestionar Incidència</span>
                </a>
            </li>
        <?php endif; ?>

        <!-- MENU DEL PROFESOR-->

        <!-- MENU DEL TECNICO-->

    </ul>
    <div class="sidebar-footer">
        <a href="index.php?controller=Login&method=cerrar_sesion" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Sortir</span>
        </a>
    </div>
</aside>
<script src="assets/js/script_default.js"></script>
