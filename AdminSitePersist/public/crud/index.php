<?php
include '../../server/connection/conexion.php';
include '../../server/security/seguridad.php';
$table=$_GET['table'];
?>
<?php if (!empty($user)) : ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include "../resources/assets/meta.html" ?>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>

    <body>
        <?php include "../resources/partials/header--main.html" ?>
        <section id="hero" class="d-flex align-items-center justify-content-center">
            <div class="container" data-aos="fade-up">

                <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-xl-6 col-lg-8">
                        <h1>Registro de Solicitudes</h1>
                        <center>
                            <h2><?php echo $user['name']; ?>, estas son las solicitudes de <?php echo $table; ?> que han hecho.</h2>
                            <center>
                    </div>
                    <table class="table table" style="background:rgba(0,0,0,0); border:none">
                        <td>
                            <a href="/functions/xls.php?table=<?php echo $table; ?>"><button type='button' class="btn btn-success">xls</button></a>
                            <a href="/functions/csv.php?table=<?php echo $table; ?>"><button type='button' class="btn btn-success">csv</button></a>
                            <a href="/functions/txt.php?table=<?php echo $table; ?>"><button type='button' class="btn btn-success">txt</button></a>
                        </td>
                    </table>
                </div>

        </section><!-- End Hero -->
        <section id="contenido">
            <table class="content-table">
                <thead>
                    <tr>
                        <?php
                        /*Consulta Estructura de Tabla para Obtener Encabeazados*/
                        foreach (mysqli_query($conx, "DESCRIBE " . $table) as $statement) {
                            echo "<th>" . $statement["Field"] . "</th>";
                        }
                        ?>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    /*Consulta Datos de la Tabla*/
                    foreach (mysqli_query($conx, "SELECT * FROM " . $table) as $data) {
                        echo "<tr>";
                        foreach (mysqli_query($conx, "DESCRIBE " . $table) as $statement) {
                            if($statement["Field"] =='img'){
                                echo "<td><img src='" . $data[$statement["Field"]] . "' style='width: 20%;'></td>";
                                continue;
                            }
                            echo "<td>" . $data[$statement["Field"]] . "</td>";
                        }
                        echo '<td><a href="/functions/modify.php?id='.$data['id'].'&table='.$table.'"><button type="button" class="button4">Modificar</a><a href="/functions/delete.php?id='.$data['id'].'&table='.$table.'"><button type="button" class="button2">Eliminar</a></td>';
                        echo "</tr>";
                    }
                    mysqli_close($conx); ?>
                </tbody>
            </table>
        </section>
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