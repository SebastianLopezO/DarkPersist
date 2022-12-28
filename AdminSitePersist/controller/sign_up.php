<?php
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordcheck'])) {
            if (verifyemail($_POST['email'])==1) {
                if ($_POST['password'] == $_POST['passwordcheck']) {
                    if (verifypassword($_POST['password'])==1) {
                        if ($_POST['terms']=="yes") {
                            if ($_POST['type']<2 && $_POST['type']>-1) {
                                $sql = 'SELECT email FROM usuarios WHERE email = :email';
                                $datos = $conexion->prepare($sql);
                                $datos->bindParam(':email', $_POST['email']);
                                if ($datos->execute()) {
                                    try {
                                        $usuarios = $datos->fetch(PDO::FETCH_ASSOC);
                                        if (is_array($usuarios)) {
                                            if ($usuarios['email'] == $_POST['email']) {
                                                $repeated = true;
                                            } else {
                                                $repeated = false;
                                            }
                                        } else {
                                            $repeated=false;
                                        }
                                    } catch (Exception $fail) {
                                        $GLOBALS['icon'] = 'error';
                                        $GLOBALS['title'] = 'Error'.$fail->getMessage();
                                        $GLOBALS['text'] = 'No se pudo verificar la existencia de la cuenta';
                                    }
                                } else {
                                    $GLOBALS['icon'] = 'error';
                                    $GLOBALS['title'] = 'Error';
                                    $GLOBALS['text'] = 'No se pudo verificar la existencia de la cuenta';
                                }
                                if (!$repeated) {
                                    $sql = 'INSERT INTO usuarios (id,name,lastname,direction,telephone,email,password,type,img,role,company) values (:id,:name,:lastname,:direction,:telephone,:email,:password,:type,:img,:role,:company)';
                                    $datos = $conexion->prepare($sql);
                                    /*Variables */
                                    $id=date("mdHis");
                                    $temp=name($_POST['name']);
                                    $name=$temp[0];
                                    $lastname=$temp[1];
                                    $direction='';
                                    $telephone='';
                                    $email=$_POST['email'];
                                    $password=password_hash($_POST['password'], PASSWORD_BCRYPT);/*Cifrar contraseña en hash BCRYPT */
                                    $type=$_POST['type'];
                                    $img='user.png';
                                    $role='';
                                    $company='';
                                    /*Pasar Parametros al sql */
                                    $datos->bindParam(':id', $id);
                                    $datos->bindParam(':name', $name);
                                    $datos->bindParam(':lastname', $lastname);
                                    $datos->bindParam(':direction', $direction);
                                    $datos->bindParam(':telephone', $telephone);
                                    $datos->bindParam(':email', $email);
                                    $datos->bindParam(':password', $password);
                                    $datos->bindParam(':type', $type);
                                    $datos->bindParam(':img', $img);
                                    $datos->bindParam(':role', $role);
                                    $datos->bindParam(':company', $company);
                                
                                    if ($datos->execute()) {
                                        $GLOBALS['icon'] = 'success';
                                        $GLOBALS['title'] = 'Éxito';
                                        $GLOBALS['text'] = 'La cuenta ha sido creada con exito';
                                        createtoken($conexion,$id);
                                        signin($conexion);
                                    } else {
                                        $GLOBALS['icon'] = 'error';
                                        $GLOBALS['title'] = 'Error';
                                        $GLOBALS['text'] = 'La cuenta no se pudo crear';
                                    }
                                } elseif ($repeated == true) {
                                    $GLOBALS['icon'] = 'error';
                                    $GLOBALS['title'] = 'Error';
                                    $GLOBALS['text'] = 'El correo ' . $_POST['email'] . ' ya existe';
                                }
                            }else{
                                $GLOBALS['icon'] = 'error';
                                $GLOBALS['title'] = 'Error';
                                $GLOBALS['text'] = 'El tipo de Usuario no es correcto';
                            }
                        }else{
                            $GLOBALS['icon'] = 'error';
                            $GLOBALS['title'] = 'Error';
                            $GLOBALS['html'] = "<p class='terms'>Debes Aceptar los <a target='blank' href='../assets/docs/Terms_and_Conditions.pdf'>terminos y condiciones</a> de la politica de proteccion de datos. Recibiras confirmacion del registro por correo electronico</p>";
                        }
                    }
                }else{
                    $GLOBALS['icon'] = 'error';
                    $GLOBALS['title'] = 'Error';
                    $GLOBALS['text'] = 'Las contraseñas no coinciden';
                }
            }else{
                $GLOBALS['title'] = 'Error';
                $GLOBALS['text'] = 'El correo no cumple con los parametros necesarios';
                $GLOBALS['img'] = '../assets/components/login/src/images/estructuraemail.jpg';
            }
        }else{
            $GLOBALS['icon'] = 'error';
            $GLOBALS['title'] = 'Error';
            $GLOBALS['text'] = 'Faltan datos para Registrarse';
        }
