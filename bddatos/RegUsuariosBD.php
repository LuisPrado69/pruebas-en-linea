<?php
	include_once('../conn.php');

		$empleado_nombre		= $_POST["nombre_empleado"];
		$usuarios 				= $_POST["usuario_empleado"];
		$correo 				= $_POST["correo"];
		$contrasena 			= $_POST["contrasena_empleado"];
		$rcontrasena 			= $_POST["contrasena_empleado2"];
		date_default_timezone_set('America/Bogota');
		$Fecha = date('Y-m-d H:i');

		if($contrasena == $rcontrasena)
		{
				$rSQLequipov = mysql_query("SELECT usuario,correo FROM usuarios WHERE usuario = '$usuarios' or correo = '$correo'");
				if(mysql_num_rows($rSQLequipov) > 0)
				{
					echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alerta no se registro este usuario </b> Ya Existe... ';

            		echo '   </div>';
					echo "El Usuario :".$usuarios." o correo ".$correo." ya esta registrado";
					header("Location: ../form_registro.php");
					exit();
				}
				
				else if(mysql_query("INSERT INTO usuarios VALUES ('', UPPER('$empleado_nombre'), '$usuarios', md5('$contrasena'), '2', '$correo',0,0, '1','$Fecha','')"))
				{
					echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Registro Correcto</b>';

            		echo '   </div>';
					header("Location: ../form_registro.php");
					exit();
				}
				else
				{
					echo "Error al registrar al usuario";
				}
			}			
		else
		{
			echo "Las contraseñas no son iguales";
		}

		header('Location:../form_registro.php');
?> 