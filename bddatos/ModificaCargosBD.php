<?php
//validación de sesión
	session_start();
	include_once('../conn.php');
	
		$fechaMovimiento = date("Y-m-d");
		$horaMovimiento = date("H:i:s");

		$id					=	$_POST["id"];
		$descripccion		=	$_POST["descripccion"];
		$estado				=	$_POST["estado"];
		
		$rSQLequipov = mysql_query("SELECT descripccion,estado FROM cargos WHERE descripccion = '$descripccion' AND estado = '$estado'");
		if(mysql_num_rows($rSQLequipov) > 0){
			$_SESSION["alerta"] = "El Cargo ".$descripccion." ya esta registrado";
		}	
		
		else if(mysql_query("UPDATE cargos SET descripccion=UPPER('$descripccion') , estado = '$estado' WHERE id='$id'"))
		{			

			$_SESSION["alerta"]="Cargo modificado exitosamente.";
			header("Location: ../rcargos.php");
			exit();
		}
		else
		{			
			$_SESSION["alerta"]="Ocurrió un error modificando el equipo.";			
		}
		
		header('Location:../rcargos.php');		
?> 