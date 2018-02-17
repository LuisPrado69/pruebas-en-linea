<?php
	
	$mysqli = new mysqli('localhost', 'mach_mach', 'Sistemas12.', 'mach_pruebasmach');
	
	if($mysqli->connect_error){
		
		die('Error en la conexion' . $mysqli->connect_error);
		
	}
?>