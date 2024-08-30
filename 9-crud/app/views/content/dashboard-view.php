<div class="container is-fluid">
    <!-- <h1 class="title">Bienvenido</h1> -->
    <div class="columns is-flex is-justify-content-center">
        <figure class="image is-128x128">
            <?php
                if (is_file("./app/views/photos/" .$_SESSION['photo'])) {
                    echo '<img class="is-rounded" src="'.APP_URL. 'app/views/photos/' . $_SESSION['photo'] . '">';
                }
            ?>
        </figure>
    </div>
    <div class="columns is-flex is-flex-direction-column is-justify-content-center is-align-items-center">
        <h2 class="subtitle is-size-4">¡Bienvenido a mi Sistema!</h2>
        <p class="subtitle is-size-6">
            <?php echo $_SESSION['name'] . " " . $_SESSION['surname']; ?>
        </p>
    </div>
</div>