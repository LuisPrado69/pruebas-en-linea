<?php
require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = $_GET['id'];
	$code = $_GET['code'];
	
	$stmt = $user->runQuery("SELECT * FROM usuarios WHERE id=:uid AND tokenCode=:token");
	$stmt->execute(array(":uid"=>$id,":token"=>$code));
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() == 1)
	{
		if(isset($_POST['btn-reset-pass']))
		{
			$pass = $_POST['pass'];
			$cpass = $_POST['confirm-pass'];
			
			if($cpass!==$pass)
			{
				$msg = "<div class='alert alert-block'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Lo sentimos!</strong>  Las contraseña no coincide. 
						</div>";
			}
			else
			{
				$password = md5($cpass);
				$stmt = $user->runQuery("UPDATE usuarios SET password=:upass WHERE id=:uid");
				$stmt->execute(array(":upass"=>$password,":uid"=>$rows['id']));
				
				$msg = "<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						Contraseña Cambiada.
						</div>";
				header("refresh:5;sesion.php");
			}
		}	
	}
	else
	{
		$msg = "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				No se encontró ninguna cuenta, intente de nuevo.
				</div>";
				
	}
	
	
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Recuperación de Contraseña</title>
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
			<div class="row">
				<div class="datagrid">
    	<div class='alert alert-success'>
			<strong>Bienvenido !</strong>  <?php echo $rows['usuario'] ?> Está aquí para restablecer su contraseña.
		</div>
        <form class="col-md-6 col-md-offset-3" method="post">
        <h3 id="otro" align="center">Formulario contraseña</h3><hr />
        <?php
        if(isset($msg))
		{
			echo $msg;
		}
		?>
			<div class="form-group">
		        <input type="password" pattern=".{6,}" title="minimo 6 caracteres" class="form-control text-center" placeholder="Nueva Contraseña" name="pass" required />
		    </div>
		    <div class="form-group">
		        <input type="password" pattern=".{6,}" title="minimo 6 caracteres" class="form-control text-center" placeholder="Repita Contraseña" name="confirm-pass" required />
        	</div>
     	<hr /><br>
     	<center>
        <button class="btn btn-large btn-primary" type="submit" name="btn-reset-pass">Guardar</button>
        </center>
      </form>
</div></div></div></div>
    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>