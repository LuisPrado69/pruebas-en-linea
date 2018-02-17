<?php
//validación de sesión
	session_start();
	include_once('../conn.php');

		$empleado_nombre		= $_POST["nombre_empleado"];
		$usuarios 				= $_POST["usuario_empleado"];
		$contrasena 			= $_POST["contrasena_empleado"];
		$rcontrasena 			= $_POST["contrasena_empleado2"];
		$correo 				= $_POST["correo"];			
		$privilegio 			= $_POST["privilegio"];	
		$cargo 					= $_POST["cargo"];
		$empresa 				= $_POST["empresa"];
		$telefono 				= $_POST["telefono"];
		$celular 				= $_POST["celular"];	
		$estado 				= $_POST["estado"];

		date_default_timezone_set('America/Bogota');
		$Fecha = date('Y-m-d H:i');

		

		if($contrasena == $rcontrasena){
			if($privilegio != 0)
			{
				$rSQLequipov = mysql_query("SELECT usuario,correo FROM usuarios WHERE usuario = '$usuarios' or correo = '$correo'");
				if(mysql_num_rows($rSQLequipov) > 0)
				{
					$_SESSION["alerta"] = "El Usuario :".$usuarios." o correo ".$correo." ya esta registrado";
					header("Location: ../rusuarios.php");
					exit();
				}
				else if(mysql_query("INSERT INTO usuarios VALUES ('', UPPER('$empleado_nombre'), '$usuarios', md5('$contrasena'), '$privilegio' , '$correo', '$cargo', UPPER('$empresa'), '$telefono', '$celular' ,'$Fecha','', '$estado')")){

					$_SESSION["alerta"] = "Usuario registrado correctamente";
					header("Location: ../rusuarios.php");
					exit();
				}
				else{
					$_SESSION["alerta"] = "Error al registrar al usuario";
				}
			}
			else{
				$_SESSION["alerta"] = "Selecciona un privilegio";
			}			
		}
		else{
			$_SESSION["alerta"] = "Las contraseñas no son iguales";
		}

		header('Location:../form_usuarios.php');
?> 