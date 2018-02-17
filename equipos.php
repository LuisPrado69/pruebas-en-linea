<?php
include_once "conn.php";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>

        <title>Tiempo</title>
        <link rel="shortcut icon" href="images/icno.png">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="styles.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </head>
<!-- CUERPO DE LA PAGINA -->
<body>
<!-- div principal de toda la pagina -->

  <!-- cabecera de la pagina -->
  <?php include_once "menu2.html"?>

  <!-- slider de fotos -->
  <div id="page">
      <div id="content-other">
      <div class="table-responsive">
        <h2 id="otro" align="center"><font color="#36A4C4"> Clima </font></h2>
        <hr><center>
        <!-- www.tutiempo.net - Ancho:488px - Alto:165px -->
        <div id="TT_FeC1EE1Ekdf92pwATfzjDDjjj3aATf22rYkdksi5KEzImIGIG">El tiempo - Tutiempo.net</div>
        <script type="text/javascript" src="https://www.tutiempo.net/s-widget/l_FeC1EE1Ekdf92pwATfzjDDjjj3aATf22rYkdksi5KEzImIGIG"></script></center>
    </div>
  </div>
</div>

    <!-- pie de pagina -->
    <!--Pie de pagina-->
    <?php include_once "footer.php"?>
    <!-- FIN DEL PIE -->
  </body>
</html>
