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
                    <h1 class="mb-5">Prestamos</h1>
                    <div class="mb-4">
                        <label for="equipment" class="form-label">Equipo</label>
                        <input type="text" class="form-control" id="equipment" name="equipment" required>
                        <div id="equipmentHelp" class="form-text">Ingrese el equipo que requiere</div>
                    </div>
                    <div class="mb-4">
                        <label for="delivery" class="form-label">Hora y Fecha de Entrega</label>
                        <input type="datetime-local" class="form-control" id="delivery" name="delivery_time" required>
                        <div id="deliveryHelp" class="form-text">Ingrese la hora en la que se presta el equipo</div>
                    </div>
                    <div class="mb-4">
                        <label for="return" class="form-label">Hora y Fecha de Devolución</label>
                        <input type="datetime-local" class="form-control" id="return" name="return_time" required>
                        <div id="returnHelp" class="form-text">Ingrese la hora en la que se presta el equipo</div>
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