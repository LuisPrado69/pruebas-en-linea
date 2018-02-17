<?php
session_start();
if (!isset($_SESSION["nombre"])) {
    header("Location: sesion.php");
}
include_once 'conn.php';
if (!isset($_GET["id"])) {
    header("Location: rnoticia.php");
} else {
    $id = base64_decode($_GET["id"]);
}

$eamq = mysql_query("select * from noticia where id=$id");
if (mysql_num_rows($eamq) > 0) {
    $eamf = mysql_fetch_assoc($eamq);
} else {
    header("Location: rnoticia.php");
}

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/main.css">
        <link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="dist/css/lightbox.min.css">
        <script src="dist/js/lightbox-plus-jquery.min.js"></script>

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <?php include_once "menu.php"?>

        <!-- slider de fotos -->
        <div id="page">
            <div id="content-other">
            <h2 id="otro" align="center"><font color="#36A4C4">Muestra Noticia</font></h2>
                <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <div class="thumbnail">
<a class="example-image-link" href="noticiaimagenes/<?php echo $eamf["imagen"] ?>" data-lightbox="example-1">
<img class="example-image" src="noticiaimagenes/<?php echo $eamf["imagen"] ?>" alt="image-1" /></a>

                      <div class="caption">
                        <h2 class="text-center text-capitalize">Descripccion: <?php echo $eamf["descripccion"] ?></h2>
                        <p class="text-center text-capitalize">
                           Estado: <?php echo get_campo("descripccion", "estados", "id", $eamf['estado']) ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <center>
                    <a href="javascript:history.go(-1);" class="btn btn-danger">Volver</a>
                </center>
            </div>
        </div>

        <?php include_once "footer.php"?>

        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
