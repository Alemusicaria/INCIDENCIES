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
                <a href="index.php?controller=Login&method=bienvenido">
                    <img src="Images/Login/Salleguard.png" alt="Logo">
                </a>
            </div>
        </div>

        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <a href="index.php?controller=Perfil&method=info">
                    <img src="<?php echo $_SESSION['usuari'][5]; ?>" alt="Perfil">
                </a>
            </button>
        </div>
    </div>
</header>

<!-- Barra lateral -->
<aside id="sidebar">
    <ul class="sidebar-nav">
        <div class="sidebar-perfil">
            <div class="sidebar-perfil-img">
                <img src="<?php echo $_SESSION['usuari'][5]; ?>" alt="Perfil">
                <h3><?php echo $_SESSION['usuari'][1]; ?></h3>
                <h4><?php echo $_SESSION['usuari'][4]; ?></h4>
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
            <a href="index.php?controller=Login&method=totes_incidencies" class="sidebar-link">
                <i class="lni lni-menu"></i>
                <span>Totes les Incidències</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="index.php?controller=Login&method=incidencies" class="sidebar-link">
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
            <a href="index.php?controller=Registro&method=registro" class="sidebar-link">
                <i class="lni lni-user"></i>
                <span>Afegeix Usuari</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="index.php?controller=Login&method=gestionar_usuaris" class="sidebar-link">
                <i class="lni lni-cog"></i>
                <span>Gestionar Professores</span>
            </a>
        </li>

    </ul>

    <div class="sidebar-footer">
        <a href="index.php?controller=Login&method=cerrar_sesion" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Sortir</span>
        </a>
    </div>
</aside>
<script src="assets/js/script_default.js"></script>