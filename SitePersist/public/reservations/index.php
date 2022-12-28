<?php
include '../../server/connection/conexion.php';
include '../../server/security/seguridad.php';
?>
<?php if (!empty($user)) : ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include "../resources/assets/meta.html" ?>

    </head>

    <body>
        <?php include "../resources/partials/header--main.html" ?>
        <div class="container-fluid text-light" style="background-color: #0D0D0D;">
            <div class="container-sm">
                <form method="post">
                    <h1 class="mb-5">Reservas</h1>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre de la reserva</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div id="nameHelp" class="form-text">Ingrese el nombre personalizado para su reserva</div>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Cantidad de Personas</label>
                        <input type="number" class="form-control" id="amount" name="amount_people" required>
                        <div id="amountHelp" class="form-text">Ingrese la cantidad de personas que van a asistir</div>
                    </div>
                    <div class="mb-3">
                        <label for="space" class="form-label">Espacio</label>
                        <input type="text" class="form-control" id="space" name="space" required>
                        <div id="spaceHelp" class="form-text">Auditorio,Sala de Computo, etc</div>
                    </div>
                    <div class="mb-3">
                        <label for="start" class="form-label">Hora y Fecha de Inicio</label>
                        <input type="datetime-local" class="form-control" id="start" name="start_time" required>
                        <div id="startHelp" class="form-text">Ingrese la fecha y hora a la cuál inicia el evento</div>
                    </div>
                    <div class="mb-3">
                        <label for="end" class="form-label">Hora y Fecha de Finalización</label>
                        <input type="datetime-local" class="form-control" id="end" name="end_time" required>
                        <div id="startHelp" class="form-text">Ingrese la fecha y hora a la cuál termina el evento</div>
                    </div>
                    <div class="mb-3">
                        <label for="event" class="form-label">Añadir un evento (Opcional)</label>
                        <input type="text" class="form-control" id="end" name="event" required>
                        <div id="endHelp" class="form-text">Si desea vincular su reserva a un evento para darle gestión </div>
                    </div>
                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
        <?php include "../resources/partials/footer--default.html" ?>
    </body>

    </html>
<?php else : ?>

    <!DOCTYPE html>
    <!--html sino ha iniciado sesion-->
    <html>

    <body>
        <script>
            setTimeout(alertFunc, 1000);

            function alertFunc() {
                location.replace("../login");
            }
        </script>
    </body>

    </html>

<?php endif; ?>