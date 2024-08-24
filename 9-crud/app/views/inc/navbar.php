<nav class="navbar is-primary">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="<?php echo APP_URL; ?>dashboard/">
                Home
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a href="#" class="navbar-item">
                    Ventas
                </a>
                <a href="#" class="navbar-item">
                    Compras
                </a>
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="#">
                        Usuarios
                    </a>
                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="<?php echo APP_URL; ?>userNew/">
                            Nuevo
                        </a>
                        <a class="navbar-item" href="<?php echo APP_URL; ?>userList/">
                            Lista
                        </a>
                        <a class="navbar-item" href="<?php echo APP_URL; ?>userSearch/">
                            Buscar
                        </a>
                    </div>
                </div>
            </div>
            <div class="navbar-end">
            <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="#">
                        User Name
                    </a>
                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="<?php echo APP_URL; ?>userUpdate/">
                            Mi Cuenta
                        </a>
                        <a class="navbar-item" href="<?php echo APP_URL; ?>userPhoto/">
                            Mi Foto
                        </a>
                        <a class="navbar-item" href="<?php echo APP_URL; ?>logOut/">
                            Salir
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>