<?php

include "../../server/connection/conexion.php";
$table = $_GET['table'];
date_default_timezone_set("America/Bogota");
$data = date(' (Y-m-d) (H-i-s)');
$name = $table . $data;
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= " . $name . ".xls");

?>
<table class="content-table">
    <thead>
        <tr>
            <?php
            /*Consulta Estructura de Tabla para Obtener Encabeazados*/
            foreach (mysqli_query($conx, "DESCRIBE " . $table) as $statement) {
                echo "<th>" . $statement["Field"] . "</th>";
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        /*Consulta Datos de la Tabla*/
        foreach(mysqli_query($conx, "SELECT * FROM ".$table) as $data ){
            echo "<tr>";
            foreach (mysqli_query($conx, "DESCRIBE ".$table) as $statement){
                echo "<td>".$data[$statement["Field"]]."</td>";
            }
            echo "</tr>";
        }
        mysqli_close($conx); ?>
    <tbody>
</table>