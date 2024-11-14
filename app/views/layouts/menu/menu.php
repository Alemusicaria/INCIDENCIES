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
                    <i class="lni lni-agenda"></i>
                    <span>NOU profesor</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="gestionar_professors.php" class="sidebar-link">
                    <i class="lni lni-cog"></i>
                    <span>Gestionar professors</span>
                </a>
            </li>
        <?php endif; ?>

        <!-- MENU DEL PROFESOR-->

        <!-- MENU DEL TECNICO-->

        <li class="sidebar-item">
            <a href="perfil.php" class="sidebar-link">
                <i class="lni lni-user"></i>
                <span>Perfil</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="perfil.php" class="sidebar-link">
                <i class="lni lni-user"></i>
                <span>Perfil</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Sortir</span>
        </a>
    </div>
</aside>
<script src="assets/js/script_default.js"></script>
