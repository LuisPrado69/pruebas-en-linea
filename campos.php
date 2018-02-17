<?php
include_once "conn.php";
?>
<!doctype html>
<html class="no-js" lang="es">
  <head>
	<head>
        <title>Hora</title>
        <link rel="shortcut icon" href="images/icno.png">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="styles.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<!-- CUERPO DE LA PAGINA -->
	<body onload="mostrarGoogleMaps()" >
		<!-- div principal de toda la pagina -->

		<?php include_once "menu2.html" ?>

		<!-- slider de fotos -->
		<div id="page">
      		<div id="content-other">
      		<div class="table-responsive">
      		<center>
				<h2 class="text-center text-capitalize"><font color="#36A4C4"> Hora </font> </h2>
				<hr>

				<div style="text-align:center;width:400px;padding:1em 0;"> <h2><a style="text-decoration:none;" href="http://www.zeitverschiebung.net/es/city/3652462"><span style="color:gray;">Hora actual en</span><br />Quito, Ecuador</a></h2> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&timezone=America%2FGuayaquil" width="100%" height="150" frameborder="0" seamless></iframe> <small style="color:gray;">&copy; <a href="http://www.zeitverschiebung.net/es/" style="color: gray;">Diferencia horaria</a></small> </div></center>

			</div>
		</div>
		</div>
		<!-- pie de pagina -->
		<?php include_once "footer.php" ?>
		<!-- FIN DEL PIE -->
	</body>
</html>