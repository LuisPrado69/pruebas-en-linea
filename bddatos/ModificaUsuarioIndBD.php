<?php
//validación de sesión
	session_start();
	include_once('../conn.php');	
		
		$id						=	$_POST["id"];
		$empleado_nombre		=	$_POST["nombre_empleado"];
		$usuario_empleado		=	$_POST["usuario_empleado"];
		$estado					=	$_POST["estado"];
		$correo					=	$_POST["correo"];	

		$cargo 					= $_POST["cargo"];
		$empresa 				= $_POST["empresa"];
		$telefono 				= $_POST["telefono"];
		$celular 				= $_POST["celular"];	
		$estado 				= $_POST["estado"];	

		$rSQLequipov = mysql_query("SELECT nombre,usuario,correo FROM usuarios WHERE nombre = '$empleado_nombre' AND usuario = '$usuario_empleado' AND correo = '$correo' AND cargo ='$cargo' AND empresa ='$empresa', telefono ='$telefono' AND celular ='$celular' AND id= '$id'");
		if(mysql_num_rows($rSQLequipov) > 0){
			$_SESSION["alerta"] = "No se realizo ningun cambio";
			header('Location: ../rusuarion_indv.php');
			exit();
		}	
		else if(mysql_query("UPDATE usuarios SET nombre=UPPER('$empleado_nombre'), usuario ='$usuario_empleado', correo = '$correo', cargo ='$cargo', empresa =UPPER('$empresa'), telefono ='$telefono', celular ='$celular' WHERE id= '$id'"))
		{			

			$_SESSION["alerta"]="Usuario modificado exitosamente.";
			header('Location: ../rusuarion_indv.php');
			exit();
		}
		else
		{			
			$_SESSION["alerta"]="Ocurrió un error modificando al usuario.";			
		}

		header('Location: ../modificar_usuario_ind.php?id='.$id_empleado);
?> 