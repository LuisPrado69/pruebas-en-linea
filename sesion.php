<?php
session_start();
include_once "conn.php";
?>
<!doctype html>
<html class="no-js" lang="es">

    <title>Inicio Sesion</title>
<link rel="shortcut icon" href="images/icno.png">
      <meta charset="utf-8">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <!-- scripots y csss -->
      <link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css" />
      <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
      <script type="text/javascript" src="jquery.slidertron-1.0.js"></script>
      <link rel="stylesheet" href="css/bootstrap.css">
      <link rel="stylesheet" href="css/font-awesome.min.css"> 
  </head>
<!-- CUERPO DE LA PAGINA -->
<body>
<!-- div principal de toda la pagina -->
<div id="wrapper">
  <!-- cabecera de la pagina -->
  <?php include_once "menu2.html" ?>

  <!-- slider de fotos -->
  <div id="page">
    <div id="content-other">
    <span class="section text-center">
          <?php
              if (isset($_SESSION["alerta"])) {
          ?>
          <?php echo $_SESSION["alerta"]; ?>
            <?php unset($_SESSION["alerta"]);}?>
    </span>
      <h2 id="otro"align="center"><font color="#36A4C4">Iniciar Sesion</font></h2>
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <form class="col-md-6 col-md-offset-3" method="POST" action="bddatos/sesion.php">
  <div class="thumbnail">
    <br>
      <img src="images/log.png" width="50%" height="auto" ; />
    <br>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="glyphicon glyphicon-user"></i>
            </div>
            <input type="text" class="form-control" required="" placeholder="Usuario" id="txt_usuario" name="txt_usuario">
          </div>
        </div>


        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="glyphicon glyphicon-eye-close"></i>
            </div>
            <input type="password" class="form-control" required="" placeholder="Contraseña" id="txt_contrasena" name="txt_contrasena">
          </div>
        </div>

          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Ingresar</button>
            <a href="form_registro.php" class="btn btn-danger">Registrate</a><br>
            <br>
            <a href="fpass.php">Olvido su Contraseña ? </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

    <!-- pie de pagina -->
    <?php include_once "footer1.php" ?>
    <!-- FIN DEL PIE -->
  </body>
</html>
