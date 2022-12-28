<?php
include '../../server/connection/conexion.php';
include '../../server/security/seguridad.php';

if (!empty($user)) {
    $table = $_GET['table'];
    $id = $_GET['id'];
    mysqli_query($conx, "DELETE FROM " . $table . " WHERE id=" . $id);
    header('Location: ../crud/index.php?table=' . $table);
}
header('Location: ../main');
