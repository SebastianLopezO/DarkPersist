<?php 
/* Funciones para Login */
    
    // Verificacion de correo con funcion '/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i' //
    function verifyemail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)!=false){
            return true;
        }
    }
    
    /* Separar Nombres y Apellidos */
    function name($name){
        $nameC=explode(" ",$name);
        if(count($nameC)==1){
            $result=array($nameC[0],'');
            return $result;
        } elseif (count($nameC)==2){
            $result=array($nameC[0],$nameC[1]);
            return $result;
        }elseif (count($nameC)==3){
            $result=array($nameC[0],$nameC[1].' '.$nameC[2]);
            return $result;
        }
        elseif (count($nameC)==4){
            $result=array($nameC[0].' '.$nameC[1],$nameC[2].' '.$nameC[3]);
            return $result;

        }else{
            $result=array('','');
            return $result;
        }
    }
    /* Verificar Contraseña */
    function verifypassword($password){
        if((strlen($password))>7){
            if((preg_match_all("/[\d]/", $password))>0){
                if((preg_match_all("/[A-Z]/", $password))>0){
                    if((preg_match_all("/[a-z]/", $password))>0){
                        if((preg_match_all("/[\W]/", $password))>0){
                            return true;
                        }else{
                            $GLOBALS['icon'] = 'error';
                            $GLOBALS['title'] = 'Error';
                            $GLOBALS['text'] = 'La contraseña debe tener al menos un caracter especial';
                            return false;
                        }
                    }else{
                        $GLOBALS['icon'] = 'error';
                        $GLOBALS['title'] = 'Error';
                        $GLOBALS['text'] = 'La contraseña debe tener al menos una minuscula';
                        return false;
                    }
                }else{
                    $GLOBALS['icon'] = 'error';
                    $GLOBALS['title'] = 'Error';
                    $GLOBALS['text'] = 'La contraseña debe tener al menos una mayuscula';
                    return false;
                }
            }else{
                $GLOBALS['icon'] = 'error';
                $GLOBALS['title'] = 'Error';
                $GLOBALS['text'] = 'La contraseña debe tener al menos un numero';
                return false;
            }
        }else{
            $GLOBALS['icon'] = 'error';
            $GLOBALS['title'] = 'Error';
            $GLOBALS['text'] = 'La contraseña debe ser minimo de 8 caracteres';
            return false;
        }
    }
    
    function createtoken($conexion,$id){
        $sql = 'INSERT INTO seguridad (token, optiontoken, datatoken,user,dataentry,datacreate,activaction) values (:token, :optiontoken, :datatoken, :user , :dataentry ,:datacreate , :activaction )';
        $datos = $conexion->prepare($sql);
        /*Variables */
        $token=date("ymwzntdhis");
        $optiontoken='';
        $datatoken=date("o-m-d");
        $user=$id;
        $dataentry=date("o-m-d");
        $datacreate=date("o-m-d");
        $activaction='1';	

        /*Pasar Parametros al sql */
        $datos->bindParam(':token', $token);
        $datos->bindParam(':optiontoken', $optiontoken);
        $datos->bindParam(':datatoken', $datatoken);
        $datos->bindParam(':user', $user);
        $datos->bindParam(':dataentry', $dataentry);
        $datos->bindParam(':datacreate', $datacreate);
        $datos->bindParam(':activaction', $activaction);
        $datos->execute();
    }
    
    function dataentry($conexion,$id){
        $sql = 'UPDATE seguridad SET dataentry=:dataentry WHERE user=:user ';
        $datos = $conexion->prepare($sql);
        /*Variables */
        $user=$id;
        $dataentry=date("o-m-d");
        
        /*Pasar Parametros al sql */
        $datos->bindParam(':user', $user);
        $datos->bindParam(':dataentry', $dataentry);
        $datos->execute();
    }
    
    function consultattempts($conexion,$id){
        $sql = 'SELECT attempts FROM seguridad WHERE user=:user';
        $datos = $conexion->prepare($sql);
        
        /*Pasar Parametros al sql */
        $datos->bindParam(':user', $id);
        if ($datos->execute()) {
            $seguridad=$datos->fetch(PDO::FETCH_ASSOC);
            return $seguridad['attempts'];
        }
    }
    function attempts($conexion,$id){
            $sql = 'UPDATE seguridad SET attempts=:attempts WHERE user=:user ';
            $datos = $conexion->prepare($sql);
            /*Variables */
            $user=$id;
            $attempts=1+consultattempts($conexion,$user);
        
            /*Pasar Parametros al sql */
            $datos->bindParam(':user', $user);
            $datos->bindParam(':attempts', $attempts);
            $datos->execute();
    }


?>