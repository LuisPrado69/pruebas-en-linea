<?php
session_start();
require_once 'class.user.php';
$user = new USER();

if($user->is_logged_in()!="")
{
	$user->redirect('home.php');
}

if(isset($_POST['btn-submit']))
{
	$email = $_POST['txtemail'];
	
	$stmt = $user->runQuery("SELECT id FROM usuarios WHERE correo=:email LIMIT 1");
	$stmt->execute(array(":email"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);	
	if($stmt->rowCount() == 1)
	{
		$id = $row['id'];
		$code = md5(uniqid(rand()));
		
		$stmt = $user->runQuery("UPDATE usuarios SET tokenCode=:token WHERE correo=:email");
		$stmt->execute(array(":token"=>$code,"email"=>$email));
		
		$message= "
				   Hola , $email
				   <br /><br />
				   Nos han solicitado para restablecer su clave, si lo hace, haga clic en el siguiente enlace para restablecer su clave, si no ignorar este correo,
				   <br /><br />
				   Haga clic en siguiente vinculo para restablecer su clave
				   <br /><br />
				   <a href='http://mach.com.ec/PruebasMach/resetpass.php?id=$id&code=$code'>Haga clic para restablecer la clave</a>
				   <br /><br />
				   Gracias :)
				   ";
		$subject = "Recupera tu contrasena";
		
		$user->send_mail($email,$message,$subject);
		
		$msg = "<div class='alert alert-success'>
					<button class='close' data-dismiss='alert'>&times;</button>
					Hemos enviado un correo electrónico a: $email.
                    Haga clic en el enlace de restablecimiento de contraseña en el correo electrónico para generar una nueva contraseña. 
			  	</div>";
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<i class='fa fa-eye sm'></i>
					<strong>Alerta!</strong>Correo no Registrado en el SISTEMA..!!</div>";
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Recuperacion de Contraseña</title>
    <link rel="shortcut icon" href="images/icno.png">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
    <meta name="keywords" content="" />
  	<meta name="description" content="" />
  	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <!-- titulo de la pestaña -->
    <!-- scripots y csss -->
  	<link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css" />
  	<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
  	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  	<script type="text/javascript" src="jquery.slidertron-1.0.js"></script>
  </head>
  <body >
	<!-- cabecera de la pagina -->
	<?php include_once("menu2.html") ?>

	<!-- slider de fotos -->
	<div id="page">
		<div id="content-other">
			<h3 id="otro"align="center">Recuperación de contraseña</h3>
      <hr>
			<div class="row">
				<div class="datagrid">
      <form class="col-md-6 col-md-offset-3" method="post">        
        	<?php
			if(isset($msg))
			{
				echo $msg;
			}
			else
			{
				?>
              	<div class='alert alert-info'>
				Por favor, Introduzca su dirección de correo Electrónico. Recibirá un enlace para crear una nueva contraseña por Correo Electrónico.
				</div>  
                <?php
			}
			?>

		<div class="form-group">
		<label class="form-label col-md-7 col-xs-12 text-center" for="nombre_empleado">Ingrese su correo Electronico <span class="required" style="color: red">*</span>
        </label>
        </div>
        <div class="form-group">
        	<input type="email" autocomplete="off" class="form-control text-center" placeholder="Correo Electrónico" name="txtemail" required />
     	</div>
     	<div class="form-group text-center">
	    	<center>
	        	<button class="btn btn-success" type="submit" name="btn-submit">Enviar</button>
	        	<a href="sesion.php" class="btn btn-danger">Cancelar</a>
	        </center>
        </div>
      </form>

    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>