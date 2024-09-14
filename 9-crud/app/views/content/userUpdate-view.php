<div class="container is-fluid mb-6">
	<?php
		$id = $isLogin->creanString($url['1']);

		if($id == $_SESSION['id']) {
	?>
	<h1 class="title">Mi cuenta</h1>
	<h2 class="subtitle">Actualizar cuenta</h2>
	<?php } else  { ?>
	<h1 class="title">Usuarios</h1>
	<h2 class="subtitle">Actualizar usuario</h2>
	<?php } ?>
</div>

<div class="container pb-6 pt-6">
    <!-- Esta vista se esta ejecutando en index.php -->
	 <?php
	 	include "./app/views/inc/btn_back.php";

		$data = $isLogin->getData("unique", "users", "id", $id);

		if($data->rowCount() == 1) {
			// convertimos en un array de datos
			$data = $data->fetch();	
	 ?>

    <h2 class="title has-text-centered">
		<?php
			echo $data['name'] . " " . $data['surname']
		?>
	</h2>
    <p class="has-text-centered pb-6">
		<?php
			echo "<strong>
				Usuario creado:
			</strong> " . date("d-m-Y h:i:s A", strtotime($data['createdAt'])) . " &nbsp; 
			<strong>Usuario actualizado:
			</strong>" . date("d-m-Y h:i:s A", strtotime($data['updatedAt']));
		?>
	</p>
    
    <form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/UserAjax.php" method="POST" autocomplete="off" >
        <input type="hidden" name="modulo_user" value="updated">
        <input type="hidden" name="user_id" value="<?php echo $data['id']; ?>">

        <div class="columns">
            <div class="column">
		    	<div class="control">
					<label>Nombres</label>
				  	<input class="input" type="text" name="name" value="<?php echo $data['name']; ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
				</div>
		  	</div>  
            <div class="column">
		    	<div class="control">
					<label>Apellidos</label>
				  	<input class="input" type="text" name="surname" value="<?php echo $data['surname']; ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
        </div>
        <div class="columns">
            <div class="column">
		    	<div class="control">
					<label>Usuario</label>
				  	<input class="input" type="text" name="username" value="<?php echo $data['username']; ?>" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required >
				</div>
		  	</div>
            <div class="column">
		    	<div class="control">
					<label>Email</label>
				  	<input class="input" type="email" name="email" value="<?php echo $data['email']; ?>" maxlength="70" >
				</div>
		  	</div>
        </div>
        <br><br>
		<p class="has-text-centered">
			SI desea actualizar la clave de este usuario por favor llene los 2 campos. Si NO desea actualizar la clave deje los campos vacíos.
		</p>
		<br>
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Nueva clave</label>
                    <input class="input" type="password" name="password" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
                </div>
		  	</div>
              <div class="column">
		    	<div class="control">
					<label>Repetir nueva clave</label>
				  	<input class="input" type="password" name="confirmPassword" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
				</div>
		  	</div>
        </div>
        <br><br><br>
        <p class="has-text-centered">
			Para poder actualizar los datos de este usuario por favor ingrese su USUARIO y CLAVE con la que ha iniciado sesión
		</p>
        <div class="columns">
            <div class="column">
		    	<div class="control">
					<label>Usuario</label>
				  	<input class="input" type="text" name="admin_user" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required >
				</div>
		  	</div>
            <div class="column">
                <div class="control">
                        <label>Clave</label>
                        <input class="input" type="password" name="admin_password" maxlength="100" required >
                </div>
		    </div>
        </div>
        <p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Actualizar</button>
		</p>
    </form>

	<?php } else {
		include "./app/views/inc/error_alert.php";
	} ?>

    
</div>