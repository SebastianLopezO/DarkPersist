<?php
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $sql = 'SELECT * FROM usuarios WHERE email=:email';
            $datos = $conexion->prepare($sql);
            $datos->bindParam(':email', $_POST['email']);
            if ($datos->execute()) {
                $usuarios = $datos->fetch(PDO::FETCH_ASSOC); /*Datos almacenado en Array*/
                
                if (is_array($usuarios)) {
                    if (consultattempts($conexion, $usuarios['id'])<3) {
                        if ($_POST['email']==$usuarios['email']) {
                            if (password_verify($_POST['password'], $usuarios['password'])) {
                                $_SESSION['id'] = $usuarios['id']; /*Pasar datos a el sistema de seguridad*/
                                $GLOBALS['icon'] = 'success';
                                $GLOBALS['title'] = 'Éxito';
                                $GLOBALS['text'] = 'Se ha iniciado sesión correctamente';
                                dataentry($conexion, $usuarios['id']);
                            } else {
                                $GLOBALS['icon'] = 'error';
                                $GLOBALS['title'] = 'Error';
                                $GLOBALS['text'] = 'La contraseña es incorrecta';
                                attempts($conexion,$usuarios['id']);
                            }
                        } else {
                            $GLOBALS['icon'] = 'error';
                            $GLOBALS['title'] = 'Error';
                            $GLOBALS['text'] = 'El correo no coíncide con una cuenta';
                        }
                    }else {
                        $GLOBALS['icon'] = 'error';
                        $GLOBALS['title'] = 'Error';
                        $GLOBALS['text'] = 'Muchos intentos, se bloqueo la cuenta';
                    }
                }else {
                    $GLOBALS['icon'] = 'error';
                    $GLOBALS['title'] = 'Error';
                    $GLOBALS['text'] = 'El correo no existe';
                }
            }else{
                $GLOBALS['icon'] = 'error';
                $GLOBALS['title'] = 'Error';
                $GLOBALS['text'] = 'No se pudo verificar si el correo existe';
            }
        }else{
            $GLOBALS['icon'] = 'error';
            $GLOBALS['title'] = 'Error';
            $GLOBALS['text'] = 'Faltan datos para Iniciar sesión';
        }
