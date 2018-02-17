
<?php
session_start();
if ((!isset($_SESSION["nombre"]) && !isset($_SESSION["privilegio"])) or ($_SESSION["privilegio"] == 2)) {
    header("Location: sesion.php");
}
include_once 'conn.php';
if (!isset($_GET["id"])) {
    header("Location: rroles.php");
} else {
    $id = base64_decode($_GET['id']);
}

$eamq = mysql_query("select * from roles where id=$id");

if (mysql_num_rows($eamq) > 0) {
    $eamf = mysql_fetch_assoc($eamq);
} else {
    header("Location: rroles.php");
}

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <title>Muestra Roles</title>
        <link rel="shortcut icon" href="images/icno.png">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="styles.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <?php include_once "menu.php"?>

    <!-- slider de fotos -->
    <div id="page">
      <div id="content-other">
      <h2 id="otro" align="center"><font color="#36A4C4">Muestra Rol</font></h2>
                <hr>
        <div class="datagrid">
          <div class="row">
                      <div class="col-md-6 col-md-offset-3">
                      <div class="thumbnail">
                            <h2 class="text-center text-capitalize">
                            Descripcción:&nbsp;&nbsp;<strong><?php echo $eamf["descripccion"] ?></strong></h2>
                            <br>
                            <p class="text-center text-capitalize">
                            Estado:&nbsp;&nbsp;<?php echo get_campo("descripccion", "estados", "id", $eamf["estado"]) ?> </p>
                          </div>
                        </div>
                      </div>
                    </div>
            <center>
                <a href="rroles.php" class="btn btn-danger">Volver</a>
            </center>
                    </div>
          </div>
        </div>
      </div>

        <?php include_once "footer.php"?>

        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
