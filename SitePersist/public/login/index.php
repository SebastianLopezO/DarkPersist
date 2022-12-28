<?php
    include '../../server/connection/conexion.php';
    date_default_timezone_set("America/Bogota");
    /*Sweet Alert -> Parametros */
    $title='';
    $text = '';
    $html='';
    $icon = '';
    $img='';

    session_start();
    if (isset($_SESSION['id'])) {
        $GLOBALS['icon'] = 'success';
        $GLOBALS['title'] = 'Éxito';
        $GLOBALS['text'] = 'Ya has inciado sesión';
        $active=false;
    }
    
    /* Accion Solicitada que llama funcion */
    if (!empty($_POST['action'])) {
        if ($_POST['action'] == 'signin') {
            signin($conx);
        } elseif ($_POST['action'] == 'signup') {
            signup($conx);
        }
        
    }
    
    function signup($conexion){
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordcheck'])) {
            if (verifyemail($_POST['email'])==1) {
                if ($_POST['password'] == $_POST['passwordcheck']) {
                    if (verifypassword($_POST['password'])==1) {
                        if ($_POST['terms']=="yes") {
                            if ($_POST['type']>=1 && $_POST['type']<=3) {
                                if ($datos = mysqli_query($conexion,'SELECT mail as email FROM usuarios WHERE mail = "'.$_POST['email'].'"')) {
                                    try {
                                        $usuarios = mysqli_fetch_array($datos);
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
                                    $repeated=false;
                                }
                                
                                if (!$repeated) {
                                    /*Variables */
                                    $temp=name($_POST['name']);
                                    $name=$temp[0];
                                    $lastname=$temp[1];
                                    $email=$_POST['email'];
                                    $password=password_hash($_POST['password'], PASSWORD_BCRYPT);/*Cifrar contraseña en hash BCRYPT */
                                    $type=$_POST['type'];
                                    
                                    if ($datos = mysqli_query($conexion,'INSERT INTO usuarios (name,lastname,mail,charge) values ("'.$name.'","'.$lastname.'","'.$email.'","'.$type.'")')) {
                                        $GLOBALS['icon'] = 'success';
                                        $GLOBALS['title'] = 'Éxito';
                                        $GLOBALS['text'] = 'La cuenta ha sido creada con exito';
                                        $data = mysqli_query($conexion,"SELECT id FROM usuarios where mail='".$_POST['email']."'");
                                        $users=mysqli_fetch_array($data);
                                        $id=$users['id'];
                                        createtoken($conexion,$id,$password);
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
                                $GLOBALS['text'] = 'El tipo de cargo no es correcto';
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
    }
    
    
    function signin($conexion){
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            if ($datos=mysqli_query($conexion, 'SELECT u.id as id,u.mail as email, s.password as password FROM usuarios u inner join seguridad s on u.id=s.user where u.mail="'.$_POST['email'].'"')) {
                $usuarios = mysqli_fetch_array($datos); /*Datos almacenado en Array*/
                if (is_array($usuarios)) {
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
    }
    
    
    /* Funciones para Login */
    
    // Verificacion de correo con funcion '/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i' //
    function verifyemail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)!=false){
            return true;
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
    
    function createtoken($conexion,$id,$password){
        /*Variables */
        $token=date("ymwzntdhis");
        $dataentry=date("o-m-d");
        $datacreate=date("o-m-d");
        
        $datos = mysqli_query($conexion,'INSERT INTO seguridad (token,last_access,last_change,user,password) values ("'.$token.'","'.$dataentry.'","'.$datacreate.'","'.$id.'","'.$password.'")');
    }
    
    function dataentry($conexion,$id){
        /*Variables */
        $user=$id;
        $dataentry=date("o-m-d");
        $datos = mysqli_query($conexion,'UPDATE seguridad SET last_access="'.$dataentry.'" WHERE user='.$user);
        
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!--Meta Data-->
    <meta charset="utf-8">
    <title>SitePersist</title>
    <meta charset="UTF-8">
    <meta name="author" content="Darkpersist(Mateo & Sebastian)">
    <meta name="description" content="Bookings System for Reservation spaces and electronics devices">
    <meta name="keywords" content="Bookings, SitePersist, Site">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/resources/assets/favicon.ico">
    <!--Import-->
    <script src="https://kit.fontawesome.com/5780471e07.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php if (!empty($icon) || !empty($title) || !empty($text)): ?>
            <script type="text/javascript">
                Sweetalert2.fire({
                    icon:"<?php echo($icon) ?>", 
                    title:"<?php echo($title)?>", 
                    text:"<?php echo($text)?>",
                    html:"<?php echo($html)?>",
                    imageUrl:"<?php echo($img)?>",
                    timer:"5000",
                    timerProgressBar:"True",
                    allowOutsideClick:"True",
                    allowEscapeKey:"True",
                    confirmButtonText:"Aceptar",
                    confirmButtonColor:"#1A5276",
                });
            </script>
                <?php if ($icon=="success"): ?>
                    <script type="text/javascript">
                        setTimeout(alertFunc, 6000);
                        function alertFunc() {
                            location.replace("../main");
                        }
                    </script>
                <?php endif; ?>
    <?php endif; ?>
    <!---Login-->
    <div class="initiation">
        <div class="container">
            <div class="boxMain">
                <div class="box signin">
                    <h2>¿Ya tienes una cuenta?</h2>
                    <a onclick="left()" id="btn" class="signinBtn"><span>Iniciar sesión</span></a>
                </div>
                <div class="box signup">
                    <h2>¿Aún no tienes una cuenta?</h2>
                    <a onclick="right()" id="btn" class="signupBtn"><span>Inscribirse</span></a>
                </div>
            </div>
            <div class="formBx left">
                <div class="form signinForm">
                    <form action="index.php" method="post">
                        <h3>Iniciar sesión</h3>
                        <input id="actionIn" type="hidden" name="action" value="signin" required>
                        <div class="icon emailIn">
                            <input id="emailIn" onblur="verifyEmailIn()" type="email" name="email" placeholder=' Correo' maxlength="120" value="" required>
                            <i id="success" class="fas fa-check-circle"></i><i id="error" class="fas fa-exclamation-circle"></i><i id="warning" class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="icon passwordIn">
                            <input id="passwordIn" onblur="verifyPasswordIn()" type="password" name="password" placeholder=" Contraseña" maxlength="20" required>
                            <i id="success" class="fas fa-check-circle"></i><i id="error" class="fas fa-exclamation-circle"></i><i id="warning" class="fas fa-exclamation-triangle"></i>
                        </div>
                        <a onmouseenter="habilitarIn()">
                            <input id="submitIn" class="disabled" type="submit" value="Ingresar">
                        </a>
                        <a href="#" class="forgot">¿Olvidaste tu contraseña?</a>
                    </form>
                </div>
                <div class="form signupForm">
                    <form action="index.php" method="post">
                        <h3>Inscribirse</h3>
                        <input id="actionUp" type="hidden" name="action" value="signup" required>
                        <div class="icon nameUp">
                            <input id="nameUp" type="text" onblur="verifyNameUp()" name="name" placeholder=" Nombre Y Apellido(s)" maxlength="50" value="" required>
                            <i id="success" class="fas fa-check-circle"></i><i id="error" class="fas fa-exclamation-circle"></i><i id="warning" class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="icon emailUp">
                            <input id="emailUp" onblur="verifyEmailUp()" type="email" name="email" placeholder=" Correo" maxlength="120" value="" required>
                            <i id="success" class="fas fa-check-circle"></i><i id="error" class="fas fa-exclamation-circle"></i><i id="warning" class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="icon passwordUp">
                            <input id="passwordUp" type="password" name="password" placeholder=" Contraseña" maxlength="20" required>
                            <i id="success" class="fas fa-check-circle"></i><i id="error" class="fas fa-exclamation-circle"></i><i id="warning" class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="icon passwordcheckUp">
                            <input id="passwordcheckUp" onblur="verifyPasswordUp()" type="password" name="passwordcheck" placeholder=" Verificar Contraseña" maxlength="20" required>
                            <i id="success" class="fas fa-check-circle"></i><i id="error" class="fas fa-exclamation-circle"></i><i id="warning" class="fas fa-exclamation-triangle"></i>
                        </div>
                        <select id="typeUp" name="type" required>
                            <option value=""> Seleccione su cargo</option>
                            <option value="0"> Docente</option>
                            <option value="1"> Estudiante</option>
                            <option value="3"> Empleado</option>
                        </select>
                        <p class="terms"><input type="checkbox" name="terms" value="yes" required>Acepto los <a target="blank" href=" ../assets/docs/Terms_and_Conditions.pdf ">terminos y condiciones</a></p>
                        <a onmouseenter="habilitarUp()">
                            <input id="submitUp" class="disabled" type="submit" value="Registrar">
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        <?php include "main.js"; ?>
    </script>
</body>

</html>
