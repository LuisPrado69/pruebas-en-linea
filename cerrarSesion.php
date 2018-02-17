<?php
	session_start();
	if((!isset($_SESSION["nombre"]) && !isset($_SESSION["usuario"])) ){		
		header("Location: sesion.php");
	}
	include_once('conn.php');	
?>
<?php
	if(isset($_SESSION['id']) )
	{
		$sql="update usuarios set online=0 where id='$_SESSION[id]'";
		$error="<div class='error'>Error al modificar el estado del usuario</div>";
		$buscar=consulta($con,$sql,$error);

		$sql1="INSERT into sentencias values ('','$_SESSION[id]','CIERRE SESION','--','$fecha','--')";
		$st1=mysql_query($sql1);

		if($buscar){
			session_destroy();
			header('location:sesion.php');
		}
		else
		{
			echo "<div class='error'>Error al cerrar la sesion</div>";
		}
	}
	else
	{
		echo"<div class='error'>No existe peticion</div>";	
	}
?>