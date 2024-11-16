<!--
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
        <-- <img src="<?php echo $_SESSION['foto_perfil']; ?>" alt="Foto de perfil"> --
    </div>

    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="perfil.php" class="sidebar-link">
                <i class="lni lni-user"></i>
                <span>Perfil</span>
            </a>
        </li>
        <-- MENU DEL ADMIN--

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

        <-- MENU DEL PROFESOR--

        <-- MENU DEL TECNICO--

    </ul>
    <div class="sidebar-footer">
        <a href="index.php?controller=Login&method=cerrar_sesion" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Sortir</span>
        </a>
    </div>
</aside>
<script src="assets/js/script_default.js"></script>
-->

<!-- Barra superior -->
<header id="header">
    <div class="header-content">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-grid-alt"></i>
            </button>
        </div>

        <div class="text-center">
            <div class="logo">
                <img src="Images/Login/Salleguard.png" alt="Logo">
            </div>
        </div>

        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <img src="Images/Login/perfil.png" alt="Perfil">
            </button>
        </div>
    </div>
</header>

<!-- Barra lateral -->
<aside id="sidebar">
    <!--<div class="sidebar-space"></div>-->

    <ul class="sidebar-nav">
        <div class="sidebar-perfil">
            <div class="sidebar-perfil-img">
                <img src="Images/Login/perfil.png" alt="Perfil">
                <h3><?php echo $_SESSION['usuario']; ?></h3>
                <h4><?php echo $_SESSION['rol']; ?></h4>
            </div>
        </div>

        <div class="sidebar-separator">Home</div>

        <li class="sidebar-item">
            <a href="index.php?controller=Login&method=bienvenido" class="sidebar-link">
                <i class="lni lni-home"></i>
                <span>Inici</span>
            </a>
        </li>

        <div class="sidebar-separator">Intefaces</div>
        <li class="sidebar-item">
            <a href="index.php?controller=Registro&method=ingresar_usuario" class="sidebar-link">
                <i class="lni lni-menu"></i>
                <span>Totes les Incidències</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="index.php?controller=Registro&method=ingresar_usuario" class="sidebar-link">
                <i class="lni lni-folder"></i>
                <span>Les meves incidències</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="index.php?controller=Incidencias&method=vista_ingreso_incidencias" class="sidebar-link">
                <i class="lni lni-plus"></i>
                <span>Afegeix Incidència</span>
            </a>
        </li>

        <!-- MENU DEL ADMIN-->
        <div class="sidebar-separator">Admin</div>
        <li class="sidebar-item">
            <a href="index.php?controller=Registro&method=ingresar_usuario" class="sidebar-link">
                <i class="lni lni-user"></i>
                <span>Afegeix Usuari</span>
            </a>
        </li>

        <!-- MENU DEL PROFESOR-->
        <div class="sidebar-separator">Profesor</div>

        <!-- MENU DEL TECNICO-->
        <div class="sidebar-separator">Tecnico</div>
        

            
        <!-- 
                <li class="sidebar-item">
                    <a href="index.php?controller=Incidencias&method=vista_ingreso_incidencias" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>NOU profesor</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Gestionar professors</span>
                    </a>
                </li>
           

            

            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span>Perfil</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span>Perfil</span>
                </a>
            </li>
            -->
    </ul>

    <div class="sidebar-footer">
        <a href="index.php?controller=Login&method=cerrar_sesion" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Sortir</span>
        </a>
    </div>
</aside>
<script src="assets/js/script_default.js"></script>