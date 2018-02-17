<!doctype html>
<html class="no-js" lang="es"> <!--<![endif]-->
    <head>
	<title>Index Pruebas Mach</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="images/icno.png">
	
<!-- scripots y csss -->
      <link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css" />
      <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
      <script type="text/javascript" src="jquery.slidertron-1.0.js"></script>
      <link rel="stylesheet" href="css/bootstrap.css">
      <link rel="stylesheet" href="css/font-awesome.min.css"> 
      <link rel="stylesheet" href="style.css">

      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


</head>


	<div id="logo">
				<h1 class="otro">
				<a href="http://mach.com.ec/" target="_blank"><img src="images/logo.png" ></a>
				Sistema de Pruebas
				<a href="http://mach.com.ec/" target="_blank"><img src="images/LOGO1.png" ></a>
				</h1>
	</div>	

	<ul id="menu">
		<li><a href="index.php">Inicio</a></li>
		<!-- <li><a href="equipos.php">Clima</a></li>
		<li><a href="campos.php">Hora</a></li> -->
		<li><a href="noticia.php">Noticias</a></li>
		<li><a href="sesion.php">Iniciar Session</a></li>

	</ul>

<!-- fin del menu -->
<body>
<!-- div principal de toda la pagina -->
	<!-- slider de fotos -->
	<div id="page">
		<div id="content-other">

			<div id="slider">
				<div class="viewer">
					<div class="reel">
					<!-- fotos del slider -->
						<div class="slide"> <img src="images/r1.jpg" width="590" height="300" alt="" /> </div>
						<div class="slide"> <img src="images/r2.jpg" width="590" height="300" alt="" /> </div>
						<div class="slide"> <img src="images/r3.jpg" width="590" height="300" alt="" /> </div>
						<div class="slide"> <img src="images/r4.jpg" width="590" height="300" alt="" /> </div>
						<div class="slide"> <img src="images/r5.jpg" width="590" height="300" alt="" /> </div>
						<div class="slide"> <img src="images/r6.jpg" width="590" height="300" alt="" /> </div>
					<!-- fin del grupo de fotos para el slider -->
					</div>
				</div>
			</div>
			<!-- script del carrousel de fotos de la portada -->
			<script type="text/javascript">
				$('#slider').slidertron({
					viewerSelector: '.viewer',
					reelSelector: '.viewer .reel',
					slidesSelector: '.viewer .reel .slide',
					advanceDelay: 3000,
					speed: 'slow'
				});
			</script>
		<!-- fin de slider -->
				<div class="center-block" align="center">
					<h2 id="otro">Bienvenido al Sistema de Pruebas en Linea</h2>
					<!-- <p class="meta">
						Publicado por: <a href="https://www.facebook.com/ooluis.oo.16?ref=bookmarks">Luis Prado</a> el 16 de julio de 2017
					</p> -->
			<!-- cuerpo de la nota principal -->
					<br>
					<p>	<i class="glyphicon glyphicon-screenshot"></i>	Conocer los distintos cursos que tenemos para ti.<br>
						<i class="glyphicon glyphicon-screenshot"></i>	Para pasar una Prueba es necesario acertar más del 70% de las preguntas.. <br>
						<i class="glyphicon glyphicon-screenshot"></i>	Podrá ver las respuestas una vez finalizado el examen. <br>
						<i class="glyphicon glyphicon-screenshot"></i>	No hay límite de tiempo. <br>
						<i class="glyphicon glyphicon-screenshot"></i>	Mejora tus conocimientos con nosotros. <br>
					</p>
				
				...
				</div>

			</div> <!-- fin de la nota principal -->
		</div> <!-- fin del container -->
	<?php
include_once 'footer1.php';
?>
</body>
</html>
