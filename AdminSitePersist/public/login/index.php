<?php
include '../../server/connection/conexion.php';

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
    $active = false;
}

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    if ($datos = mysqli_query($conx, 'SELECT * FROM administradores where mail="' . $_POST['email'] . '"')) {
        $usuarios = mysqli_fetch_array($datos); /*Datos almacenado en Array*/
        if (is_array($usuarios)) {
            if ($_POST['email'] == $usuarios['mail']) {
                if (password_verify($_POST['password'], $usuarios['password'])) {
                    $_SESSION['id'] = $usuarios['id']; /*Pasar datos a el sistema de seguridad*/
                    $GLOBALS['icon'] = 'success';
                    $GLOBALS['title'] = 'Éxito';
                    $GLOBALS['text'] = 'Se ha iniciado sesión correctamente';
                } else {
                    $GLOBALS['icon'] = 'error';
                    $GLOBALS['title'] = 'Error';
                    $GLOBALS['text'] = 'La contraseña es incorrecta';
                }
            } else {
                $GLOBALS['icon'] = 'error';
                $GLOBALS['title'] = 'Error';
                $GLOBALS['text'] = 'El correo no coíncide con una cuenta';
            }
        } else {
            $GLOBALS['icon'] = 'error';
            $GLOBALS['title'] = 'Error';
            $GLOBALS['text'] = 'El correo no existe';
        }
    } else {
        $GLOBALS['icon'] = 'error';
        $GLOBALS['title'] = 'Error';
        $GLOBALS['text'] = 'No se pudo verificar si el correo existe';
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

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <script src="https://kit.fontawesome.com/5780471e07.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if (!empty($icon) || !empty($title) || !empty($text)) : ?>
        <script type="text/javascript">
            Sweetalert2.fire({
                icon: "<?php echo ($icon) ?>",
                title: "<?php echo ($title) ?>",
                text: "<?php echo ($text) ?>",
                html: "<?php echo ($html) ?>",
                imageUrl: "<?php echo ($img) ?>",
                timer: "5000",
                timerProgressBar: "True",
                allowOutsideClick: "True",
                allowEscapeKey: "True",
                confirmButtonText: "Aceptar",
                confirmButtonColor: "#1A5276",
            });
        </script>
        <?php if ($icon == "success") : ?>
            <script type="text/javascript">
                setTimeout(alertFunc, 6000);

                function alertFunc() {
                    location.replace("../main");
                }
            </script>
        <?php endif; ?>
    <?php endif; ?>
    <!---Login-->
    <div class="bg_img">
        <div class="content">
            <header>Inicio de sesión</header>
            <form method="post">
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" name="email" required placeholder="Ingrese su correo" />
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" class="pass-key" id="pass-key" name="password" onblur="verifyPassword()" required placeholder="Contraseña" />
                    <i id="success" class="fas fa-check-circle"></i><i id="error" class="fas fa-exclamation-circle"></i><i id="warning" class="fas fa-exclamation-triangle"></i>
                    <span class="show"></span>
                </div>
                <div class="pass">
                    <a href="#">¿Olvidaste la contraseña?</a>
                </div>
                <div class="field">
                    <input type="submit" value="Acceder">
                </div>
            </form>
        </div>
    </div>
    
</body>

</html>