<?php

    namespace app\controllers;
    use app\models\MainModel;

    class UserController extends MainModel {
        public function registerUserController() {
            // Almacenado datos
            $name = $this->creanString($_POST['name']);
            $surname = $this->creanString($_POST['surname']);
            $username = $this->creanString($_POST['username']);
            $email = $this->creanString($_POST['email']);
            $password = $this->creanString($_POST['password']);
            $confirmPassword = $this->creanString($_POST['confirmPassword']);

            // Verificando campos obligatorios
            if ($name=="" || $surname=="" || $username=="" || $password=="" || $confirmPassword=="") {
                $alerta = [
                    "type"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"No has llenado todos los campos que son obligatorios",
                    "icon"=>"error"
                ];

                // return formato json
                return json_encode($alerta);
                // detenemos el script
                exit();
            }

            // Verificando campos con las expresion regular
            if ($this->compareData("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $name)) {
                $alerta = [
                    "type"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"El nombre no coincide con el formato solicitado",
                    "icon"=>"error"
                ];
                return json_encode($alerta);
                exit();
            }

            if ($this->compareData("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $surname)) {
                $alerta = [
                    "type"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"El apellido no coincide con el formato solicitado",
                    "icon"=>"error"
                ];
                return json_encode($alerta);
                exit();
            }

            if ($this->compareData("[a-zA-Z0-9]{4,20}", $username)) {
                $alerta = [
                    "type"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"El usuario no coincide con el formato solicitado",
                    "icon"=>"error"
                ];
                return json_encode($alerta);
                exit();
            }

            // if ($this->compareData("[a-zA-Z0-9$@.-]{7,100}", $password || $this->compareData("[a-zA-Z0-9$@.-]{7,100}", $confirmPassword))) {
            //     $alerta = [
            //         "type"=>"simple",
            //         "title"=>"Ocurrio un error inesperado",
            //         "text"=>"Las contraseñas no coincide con el formato solicitado",
            //         "icon"=>"error"
            //     ];
            //     return json_encode($alerta);
            //     exit();
            // }

            if ($email != "") {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $verify_email = $this->get_query("SELECT email FROM users WHERE email = '$email'");

                    if ($verify_email->rowCount() > 0) {
                        $alerta = [
                            "type"=>"simple",
                            "title"=>"Ocurrio un error inesperado",
                            "text"=>"El email ya se encuentra registrado",
                            "icon"=>"error"
                        ];
                        return json_encode($alerta);
                        exit();
                    }
                } else {
                    $alerta = [
                        "type"=>"simple",
                        "title"=>"Ocurrio un error inesperado",
                        "text"=>"Ha ingresado un email no valido",
                        "icon"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();
                }
            }

            // Verificando Claves
            if ($password != $confirmPassword) {
                $alerta = [
                    "type"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"Las contraseñas no coinciden",
                    "icon"=>"error"
                ];
                return json_encode($alerta);
                exit();
            } else {
                $hash_password = password_hash($password, PASSWORD_BCRYPT, ["cost"=>10]);
            }

            // Verificando Usuario
            $verify_user = $this->get_query("SELECT username FROM users WHERE username='$username'");

            if ($verify_user->rowCount() > 0) {
                $alerta = [
                    "type"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"El usuario ya se encuentra registrado",
                    "icon"=>"error"
                ];
                return json_encode($alerta);
                exit();
            }

            // Directorio de Imagenes
            $img_dir="../views/photos/";

            if ($_FILES['photo']['name'] != "" && $_FILES['photo']['size'] > 0) {
                # creando un directorio
                # verificando si el archivo o carpeta existe
                if (!file_exists($img_dir)) {
                    if (!mkdir($img_dir, 0777)) {
                        $alerta = [
                            "type"=>"simple",
                            "title"=>"Ocurrio un error inesperado",
                            "text"=>"Error al crear el directorio",
                            "icon"=>"error"
                        ];
                        return json_encode($alerta);
                        exit();
                    }
                }

                # Verificando formato de imagenes
                if (mime_content_type($_FILES['photo']['tmp_name']) != "image/jpeg" && mime_content_type($_FILES['photo']['tmp_name']) != "image/png") {
                    $alerta = [
                        "type"=>"simple",
                        "title"=>"Ocurrio un error inesperado",
                        "text"=>"La imagen que ha seleccionado es de un formato no permitido",
                        "icon"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();
                }

                # Verificando el peso de las imagenes
                if (($_FILES['photo']['size'] / 1024) > 5120) {
                    $alerta = [
                        "type"=>"simple",
                        "title"=>"Ocurrio un error inesperado",
                        "text"=>"La imagen que ha seleccionado supera el peso permitido",
                        "icon"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();
                }

                # Nombre de la foto
                $photo = str_ireplace(" ","_", $name);
                $photo = $photo."_".rand(0, 100);

                # Extension de las imagenes
                switch(mime_content_type($_FILES['photo']['tmp_name'])) {
                    case 'image/jpeg':
                        $photo = $photo . ".jpg";
                        break;
                    case "image/png":
                        $photo = $photo . ".png";
                        break;
                }

                chmod($img_dir, 0777);

                # Moviendo imagen al directorio
                if (!move_uploaded_file($_FILES['photo']['tmp_name'], $img_dir . $photo)) {
                    $alerta = [
                        "type"=>"simple",
                        "title"=>"Ocurrio un error inesperado",
                        "text"=>"No podemos subir la imagen al sistema en este momento",
                        "icon"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();
                }

            } else {
                $photo="";
            }

            $insert_data = [
                [
                    "campo_nombre"=>"name",
                    "campo_marcador"=>":Name",
                    "campo_valor"=>$name,
                ],
                [
                    "campo_nombre"=>"surname",
                    "campo_marcador"=>":Surname",
                    "campo_valor"=>$surname,
                ],
                [
                    "campo_nombre"=>"email",
                    "campo_marcador"=>":Email",
                    "campo_valor"=>$email,
                ],
                [
                    "campo_nombre"=>"username",
                    "campo_marcador"=>":Username",
                    "campo_valor"=>$username,
                ],
                [
                    "campo_nombre"=>"password",
                    "campo_marcador"=>":Password",
                    "campo_valor"=>$hash_password,
                ],
                [
                    "campo_nombre"=>"photo",
                    "campo_marcador"=>":Photo",
                    "campo_valor"=>$photo,
                ],
                [
                    "campo_nombre"=>"createdAt",
                    "campo_marcador"=>":CreatedAt",
                    "campo_valor"=>date("Y-m-d H:i:s"),
                ],
                [
                    "campo_nombre"=>"updatedAt",
                    "campo_marcador"=>":UpdatedAt",
                    "campo_valor"=>date("Y-m-d H:i:s"),
                ],
            ];

            $saved_user = $this->addData('users', $insert_data);

            if ($saved_user->rowCount() == 1) {
                $alerta = [
                    "type"=>"clear",
                    "title"=>"Usuario registrado",
                    "text"=>"El usuario se registro con exito",
                    "icon"=>"success"
                ];
            } else {
                // Eliminamos la img
                if (is_file($img_dir . $photo)) {
                    // damos permiso de lectura y escritura
                    chmod($img_dir . $photo, 0777);
                    // eliminamos la img
                    unlink($img_dir . $photo);
                }

                $alerta = [
                    "type"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"No se pudo registrar el usuario, por favor intente nuevamente",
                    "icon"=>"error"
                ];
            }

            return json_encode($alerta);
        }

        # Lists Users
        public function listsUsers($page, $register, $url, $search) {
            $page = $this->creanString($page);
            $register = $this->creanString($register);
            $url = $this->creanString($url);
            // Como el controllador se ejecuta director el usersList, y este se ejecuta en index.php, tenemos en variabla APP_URL
            $url = APP_URL . $url . "/";

            $search = $this->creanString($search);
            $tabla = "";

            $page = (isset($page) && $page > 0) ? (int) $page : 1;
            $inicio = ($page > 0) ? (($page * $register) - $register) : 0;

            if (isset($search) && $search != "") {
                $search_data = "SELECT * FROM users WHERE (id != ' " . $_SESSION['id'] . "' AND id != '1') AND (name LIKE '%$search%' OR surname LIKE '%$search%' OR email LIKE '%$search%' OR username LIKE '%$search%')) ORDER BY createdAt ASC LIMIT $inicio, $register";
                $search_total = "SELECT COUNT(id) FROM users WHERE (id != ' " . $_SESSION['id'] . "' AND id != '1') AND (name LIKE '%$search%' OR surname LIKE '%$search%' OR email LIKE '%$search%'";

            } else {
                // No mostrar el usuario con session iniciada
                $search_data = "SELECT * FROM users WHERE id != ' " . $_SESSION['id'] . "' AND id != '1' ORDER BY createdAt ASC LIMIT $inicio, $register";
                $search_total = "SELECT COUNT(id) FROM users WHERE id != '" .$_SESSION['id'] . "' AND id != '1'";
            }

            $datos = $this->get_query($search_data);
            // Obtener todos los datos seleccionados
            $datos = $datos->fetchAll();

            $total = $this->get_query($search_total);
            $total = (int) $total->fetchColumn();

            // ceil -> funcion que permite redondear 1.5 => 2
            $numPages = ceil($total / $register);

            $tabla .= '
                <div class="table-container">
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th class="has-text-centered">#</th>
                            <th class="has-text-centered">Name</th>
                            <th class="has-text-centered">Username</th>
                            <th class="has-text-centered">Email</th>
                            <th class="has-text-centered">CreatedAt</th>
                            <th class="has-text-centered">Updated</th>
                            <th class="has-text-centered" colspan="3">Options</th>
                        </tr>
                    </thead>
                    <tbody>
            ';

            if ($total >= 1 && $page <= $numPages) {
                $contador = $inicio + 1;
                $pag_inicio = $inicio + 1;

                foreach($datos as $rows) {
                    $tabla .= '
                        <tr class="has-text-centered">
                            <td>' . $contador . '</td>
                            <td>'  . $rows['name'] . ' ' .$rows['surname'] . '</td>
                            <td>' . $rows['surname'] . '</td>
                            <td>' . $rows['email'] . '</td>
                            <td>' . date("d-m-Y h:i:s A", strtotime($rows['createdAt'])) . '</td>
                            <td>' . date("d-m-Y h:i:s A", strtotime($rows['updatedAt'])) . '</td>
                            <td>
                                <a href="' . APP_URL . 'userPhoto/' . $rows['id'] . '/" class="button is-info is-rounded is-small">Photo</a>
                            </td>
                            <td>
                                <a href="' . APP_URL . 'userUpdate/' . $rows['id'] . '/" class="button is-success is-rounded is-small">Updated</a>
                            </td>
                            <td>
                                <form class="FormularioAjax" action="' . APP_URL . 'app/ajax/UserAjax.php" method="POST" autocomplete="off">
                                    <input type="hidden" name="modulo_user" value="delete">
                                    <input type="hidden" name="userId" value="' . $rows['id'] . '">
                                    <button type="submit" class="button is-danger is-rounded is-small">Delete</button>
                                </form>
                            </td>
                        </tr>
                    ';
                    $contador++;
                }

                $pag_final = $contador - 1;
            } else {
                if ($total >= 1) {
                    $tabla .= '
                        <tr class="has-text-centered">
                            <td colspan="7">
                                <a href="' .$url . '1/" class="button is-link is-rounded is-small mt-4 mb-4">
                                    Haga clic acá para recargar el listado
                                </a>
                            </td>
                        </tr>
                    ';
                } else {
                    $tabla .= '
                        <tr class="has-text-centered" >
                            <td colspan="7">
                                No hay registros en el sistema
                            </td>
                        </tr>
                    ';
                }
            }

            $tabla .= '
                    </tbody>
                    </table>
                </div>
            
            ';
            
            if ($total >= 1 && $page <= $numPages){
                $tabla .= '<p class="has-text-right">Mostrando usuarios <strong>' . $pag_inicio .'</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';

                $tabla .= $this->paginadorTablas($page, $numPages, $url, 10);
            }

            return $tabla;
        }

        // Controlador eliminar usuarios
        public function deleteUserController() {
            $id = $this->creanString($_POST['userId']);

            if ($id == 1) {
                $alerta = [
                    "type"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"No se puede eliminar el usuario",
                    "icon"=>"error"
                ];

                return json_encode($alerta);
                exit();
            }

            # Verificando el usuario
            $datos = $this->get_query("SELECT * FROM users WHERE id = '$id'");

            if ($datos->rowCount() <= 0) {
                $alerta = [
                    "type"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"El usuario no existe",
                    "icon"=>"error"
                ];

                return json_encode($alerta);
                exit();
            } else {
                // Hacemos un array de datos
                $datos = $datos->fetch();
            }

            $deleteUser = $this->deleteData('users', 'id', $id);

            if ($deleteUser->rowCount() == 1) {
                $alerta = [
                    "type"=>"recargar",
                    "title"=>"Usuario eliminado",
                    "text"=>"El usuario " .$datos['username'] . " Se elimino con exito",
                    "icon"=>"success"
                ];
            }
        }
    }

    // 12-17


?>