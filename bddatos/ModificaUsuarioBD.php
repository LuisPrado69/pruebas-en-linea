<?php
//validación de sesión
	session_start();
	include_once('../conn.php');	
		
		$id						=	$_POST["id"];
		$empleado_nombre		=	$_POST["nombre_empleado"];
		$usuario_empleado		=	$_POST["usuario_empleado"];	
		$correo					=	$_POST["correo"];	
		$privilegio				=	$_POST["privilegio"];	
		$cargo 					= $_POST["cargo"];
		$empresa 				= $_POST["empresa"];
		$telefono 				= $_POST["telefono"];
		$celular 				= $_POST["celular"];	
		$estado 				= $_POST["estado"];

		$rSQLequipov = mysql_query("SELECT * FROM usuarios WHERE nombre = '$empleado_nombre' AND usuario = '$usuario_empleado' AND estado = '$estado' AND privilegio = '$privilegio' AND correo = '$correo' AND cargo ='$cargo' AND empresa ='$empresa' AND telefono ='$telefono' AND celular ='$celular' WHERE id= '$id'");
		if(mysql_num_rows($rSQLequipov) > 0){
			$_SESSION["alerta"] = "No se realizo ningun cambio";
			header('Location: ../rusuarios.php');
			exit();
		}	
		else if(mysql_query("UPDATE usuarios SET nombre=UPPER('$empleado_nombre'), usuario ='$usuario_empleado', estado = '$estado', privilegio = '$privilegio' , correo = '$correo', cargo ='$cargo', empresa =UPPER('$empresa'), telefono ='$telefono', celular ='$celular' WHERE id= '$id'"))
		{	

			$_SESSION["alerta"]="Usuario modificado exitosamente.";
			header('Location: ../rusuarios.php');
			exit();
		}
		else
		{			
			$_SESSION["alerta"]="Ocurrió un error modificANDo al usuario.";			
		}

		header('Location: ../modificar_usuario.php?id='.$id_empleado);
?> 