<?php
//validación de sesión
	session_start();
	include_once('../conn.php');	
		
		$id						=	$_POST["id"];
		$title					=	$_POST["title"];
		$total					=	$_POST["total"];	
		$sahi					=	$_POST["sahi"];	
		$wrong					=	$_POST["wrong"];	
		$time 					= $_POST["time"];
		$intro 					= $_POST["intro"];

		$rSQLequipov = mysql_query("SELECT * FROM quiz WHERE title = '$title' AND total = '$total' AND wrong = '$wrong' AND sahi = '$sahi' AND time ='$time' AND intro ='$intro' AND eid= '$id'");
		if(mysql_num_rows($rSQLequipov) > 0){
			$_SESSION["alerta"] = "No se realizo ningun cambio";
			header('Location: ../SubPruebas.php');
			exit();
		}	
		else if(mysql_query("UPDATE quiz SET title='$title', total ='$total',  wrong = '$wrong' , sahi = '$sahi', time ='$time', intro ='$intro' WHERE eid= '$id'"))
		{	

			$_SESSION["alerta"]="Prueba modificada exitosamente.";
			header('Location: ../SubPruebas.php');
			exit();
		}
		else
		{			
			$_SESSION["alerta"]="Ocurrió un error modificando al usuario.";			
		}

		header('Location: ../modificar_pruebas.php?id='.$id);
?> 