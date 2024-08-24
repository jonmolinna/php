<div class="container">
    <div class="card mt-6">
        <div class="card-content">
            <form class="FormularioAjax" method="POST" action="<?php echo APP_URL; ?>app/ajax/UserAjax.php" enctype="multipart/form-data">
                <input type="hidden" name="modulo_user" value="register">
                <div class="columns">
                    <div class="column">
                        <label class="label">Nombres</label>
                        <input type="text" name="name" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" class="input is-primary">
                    </div>
                    <div class="column">
                        <label class="label">Apellidos</label>
                        <input type="text" name="surname" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" class="input is-primary">
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <label class="label">Usuario</label>
                        <input type="text" name="username" required pattern="[a-zA-Z0-9]{4,20}" class="input is-primary">
                    </div> 
                    <div class="column">
                        <label class="label">Email</label>
                        <input type="text" name="email" class="input is-primary">
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <label class="label">Contraseña</label>
                        <input type="password" name="password" required  class="input is-primary">
                    </div>
                    <div class="column">
                        <label class="label">Repetir Contraseña</label>
                        <input type="password" name="confirmPassword" required  class="input is-primary">
                    </div> 
                </div>
                <div class="file has-name is-boxed">
                    <label class="file-label">
                        <input type="file"  name="photo" accept=".jpg, .png, .jpeg" class="file-input">
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">Seleccione una Foto</span>
                        </span>
                        <span class="file-name">jpg, jpeg, png, (max 5MB)</span>
                    </label>
                </div>
                <div class="columns">
                    <div class="column">
                        <button class="button is-rounded is-fullwidth">Limpiar</button>
                    </div>
                    <div class="column">
                        <button class="button is-primary is-rounded is-fullwidth">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>