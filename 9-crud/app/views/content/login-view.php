<div class="container mt-6">
    <div class="columns">
        <div class="column is-half is-offset-one-quarter">
            <div class="card ">
                <form class="card-content" action="" method="POST" autocomplete="off">
                    <div class="field">
                        <label class="label">Username</label>
                        <div class="control">
                            <input class="input" type="text" name="username" placeholder="Username" required pattern="[a-zA-Z0-9]{4,20}">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Password</label>
                        <div class="control">
                            <input class="input" type="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="field">
                        <button class="button is-primary is-fullwidth">Primary</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Vease index.php
        $isLogin->initialSession();
    }

?>