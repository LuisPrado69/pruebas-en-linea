<?php
//validación de sesión
	session_start();
	include_once('../conn.php');
	
		$fechaMovimiento = date("Y-m-d");
		$horaMovimiento = date("H:i:s");

		$id					=	$_POST["id"];
		$descripccion		=	$_POST["descripccion"];
		
		$rSQLequipov = mysql_query("SELECT descripccion FROM estado WHERE descripccion = '$descripccion'");
		if(mysql_num_rows($rSQLequipov) > 0){
			$_SESSION["alerta"] = "El Estado ".$descripccion." ya esta registrado";
		}	
		
		else if(mysql_query("UPDATE estado SET descripccion=UPPER('$descripccion') WHERE id=$id"))
		{			
			
			$_SESSION["alerta"]="Estado modificado exitosamente.";
			header("Location: ../restado.php");
			exit();
		}
		else
		{			
			$_SESSION["alerta"]="Ocurrió un error modificando el equipo.";			
		}
		
		header('Location:../restado.php');		
?> 