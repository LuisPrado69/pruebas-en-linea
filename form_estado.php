<?php
session_start();
if ((!isset($_SESSION["nombre"]) && !isset($_SESSION["privilegio"])) or ($_SESSION["privilegio"] == 2)) {
    header("Location: sesion.php");
}
include_once 'conn.php';
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->
    <head>

        <title>Agregar Estado</title>
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
                <h2 id="otro" align="center"><font color="#36A4C4">Registro Estado</font></h2>
                <hr>
                <div class="datagrid">
                    <form method='post' class="form-horizontal form-label-left" action="bddatos/AltaEstadoBD.php" enctype="multipart/form-data">
                        <span class="section">
                            <?php
if (isset($_SESSION["alerta"])) {
    ?>
                                    <label class="alerta"><?php echo $_SESSION["alerta"]; ?></label>
                                    <?php unset($_SESSION["alerta"]);
}?>
                        </span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descripccion">Descripccion <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="descripccion" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="descripccion" placeholder="Ingrese descripcción de Estado" required="required" type="text">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <center>
                                <button id="send" type="submit" class="btn btn-success">Guardar</button>
                                <a href="restado.php" class="btn btn-danger">Cancelar</a>
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include_once "footer.php"?>

        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
