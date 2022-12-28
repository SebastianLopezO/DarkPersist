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
                <div class="container-fluid mb-5">
                    <div class="p-4 p-md-5 mb-4 rounded text-bg-dark">
                        <div class="col-md-6 px-0">
                            <h1 class="display-4 fst-italic">SitePersist</h1>
                            <p class="lead my-3">SitePersist es un sistema de gestión de solicitudes para la reserva de espacios y equipos tecnológicos enfocada a la Institución Universitaria Salazar y Herrera,
                                a través de un aplicativo web para cualquier tipo de dispositivos, permitiendo de esta manera la optimización de procesos de reservas de la Universidad.</p>
                            <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continuar leyendo</a></p>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h1>Servicios</h1>
                </div>
                <div>
                    <div class="row">

                        <div class="col-md-6 d-flex justify-content-center align-items-center mb-5">
                            <div class="card" style="width: 18rem; background-color: #202020;">
                                <img src="https://www.upb.edu.co/es/imagenes/img-raee-blog-sostenibilidad-1464231652905.jpeg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Equipos electrónicos</h5>
                                    <p class="card-text">En la universidad se cuenta con diversos equipos electrónicos con los cuales estudiantes y docentes pueden realizar sus actividades académicas mediante la tecnología.</p>
                                    <a href="#" class="btn btn-primary">Reservar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center mb-5">
                            <div class="card" style="width: 18rem; background-color: #202020;">
                                <img src="https://th.bing.com/th/id/R.869488e3b02172604372560ad83a5618?rik=FyWq6nQXMMdLMA&pid=ImgRaw&r=0" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Espacios</h5>
                                    <p class="card-text">En la universidad se cuenta con diferentes espacios, como el auditorio donde se realizan varios eventos en el transcurso del día.</p>
                                    <a href="#" class="btn btn-primary">Reservar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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