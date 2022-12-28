<?php
	/* Conexion en xampp
	$server = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'sitepersist';
	*/
	/* Conexion en remotemysql.com
	$server = 'remotemysql.com';
	$username = 'W80NGrZVyT';
	$password = 'VU7ZJIPVe8';
	$database = 'W80NGrZVyT';
	*/
	
	/* Conexion en azure.com
	$server = 'darkpersist.mariadb.database.azure.com:3306';
	$username = 'AdminDarkPersist@darkpersist';
	$password = '"DarkPersist"2473546';
	$database = 'sitepersist';*/

	/* Conexion en Clever Cloud*/
	$server = 'brsebv2xscv11gd8urzz-mysql.services.clever-cloud.com:3306';
	$username = 'uanrhhwd5slmn6ra';
	$password = '1fOQx5r7VQcVxNowktFc';
	$database = 'brsebv2xscv11gd8urzz';
	

	try {
	    $conx= mysqli_connect($server,$username,$password);
	    mysqli_select_db($conx, $database);
	} catch (mysqli_sql_exception $fail) {
	    die('La Conexión ha sido Fallida: ' . $fail->getMessage());
	}
?>
