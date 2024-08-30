<?php

    namespace app\controllers;
    use app\models\MainModel;

    class LoginController extends MainModel {
        # Controlador Iniciar Session
        public function initialSession() {
            $username= $this->creanString($_POST['username']);
            $password = $this->creanString($_POST['password']);


            // Verifcando campo obligatorio
            if ($username=='' || $password=='') {
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Ocurrio un error inesperado',
                            text: 'No has llenado todos los campos que son obligatorios',
                            confirmButtonText: 'Aceptar',
                        });
                    </script>
                ";
            }
            else {
                # Verificando la integridad de los datos
                if ($this->compareData("[a-zA-Z0-9]{4,20}", $username)) {
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Ocurrio un error inesperado',
                                text: 'El usuario no coincide con el formato solicitado',
                                confirmButtonText: 'Aceptar',
                            });
                        </script>
                    ";
                } else {
                    $verify_user = $this->get_query("SELECT * FROM users WHERE username = '$username'");

                    if ($verify_user->rowCount() == 1) {
                        $verify_user = $verify_user->fetch();

                        if ($verify_user['username'] == $username && password_verify($password, $verify_user['password'])) {
                            $_SESSION['id'] = $verify_user['id'];
                            $_SESSION['name'] = $verify_user['name'];
                            $_SESSION['surname'] = $verify_user['surname'];
                            $_SESSION['email'] = $verify_user['email'];
                            $_SESSION['username'] = $verify_user['username'];
                            $_SESSION['photo'] = $verify_user['photo'];

                            // Verificando los encabezados
                            if (headers_sent()) {
                                echo "<script>window.location.href='" . APP_URL . "dashboard/';</script>";
                            } else {
                                header("Location: " . APP_URL . "dashboard/");
                            }

                        } else {
                            echo "
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Ocurrio un error inesperado',
                                        text: 'Usuario o clave inorrectos',
                                        confirmButtonText: 'Aceptar',
                                    });
                                </script>
                            ";
                        }
                    } else {
                        echo "
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ocurrio un error inesperado',
                                    text: 'Usuario o clave inorrectos',
                                    confirmButtonText: 'Aceptar',
                                });
                            </script>
                        ";
                    }
                }
            }
        }

        # Controlador para cerrar session
        public function closeSession() {
            session_destroy();

            if (headers_sent()) {
                echo "<script>window.location.href='" . APP_URL . "login/';</script>";
            } else {
                header("Location: " . APP_URL . "login/");
            }
        }
    }

?>