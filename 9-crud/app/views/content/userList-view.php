<div class="container is-fluid mb-6">
    <h1 class="title">Usuarios</h1>
    <h2 class="subtitle">Lista de usuarios</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		// Las VISTAS se ejecutan index.php y el autoload
		use app\controllers\UserController;


		$userController = new UserController();

		echo $userController->listsUsers($url[1], 15, $url[0], "");
	?>
    
</div>