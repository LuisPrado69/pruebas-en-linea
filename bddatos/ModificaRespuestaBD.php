<?php
//validación de sesión
	session_start();
	include_once('../conn.php');	
		
		$id						=	$_POST["id"];
		$ansid					=	$_POST["answer"];

		$rSQLequipov = mysql_query("SELECT * FROM answer WHERE ansid = '$ansid' AND qid = '$id' ");
		if(mysql_num_rows($rSQLequipov) > 0){
			$_SESSION["alerta"] = "No se realizo ningun cambio";
			header('Location: ../SubRespuestas.php');
			exit();
		}	
		else if(mysql_query("UPDATE answer SET ansid='$ansid' WHERE qid= '$id'"))
		{	

			$_SESSION["alerta"]="Respuesta modificada exitosamente.";
			header('Location: ../SubRespuestas.php');
			exit();
		}
		else
		{			
			$_SESSION["alerta"]="Ocurrió un error modificando al usuario.";			
		}

		header('Location: ../modificar_respuestas.php?id='.$id);
?> 