<?php
    session_start();

    if (isset($_SESSION['id'])) {
        try {
            $query="SELECT * FROM administradores WHERE id = ".$_SESSION['id'];
            $data = mysqli_query($conx, $query);
            $result = mysqli_fetch_array($data);
            $user = null;
    
            if (count($result) > 0) {
                $user = $result;
            }
        } catch (mysqli_sql_exception $fail) {
            die('No se ha podido comprobar la sesion iniciada: ' . $fail->getMessage());
        }
    }
?>
