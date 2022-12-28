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
            <div class="grid text-center">
                <div class="mb-5">
                    <h1>Acciones</h1>
                </div>
                <div>
                    <div class="row">
                        <?php foreach (mysqli_query($conx, "SELECT * FROM acciones") as $data) : ?>
                            <div class="col-md-4 d-flex justify-content-center align-items-center mb-5">
                                <div class="card text-bg-dark mb-3" style="max-width: 540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4 p-3">
                                            <img src="<?php echo $data['img']?>" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $data['action']?></h5>
                                                <p class="card-text"><?php echo $data['description']?></p>
                                                <p class="card-text"><small class="text-muted"><?php echo $data['date_action']?></small></p>
                                                <p class="card-text"><small class="text-muted"><?php echo $data['ip']?></small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include "../resources/partials/footer--default.html" ?>

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