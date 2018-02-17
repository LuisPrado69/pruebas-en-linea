<?php
session_start();
if (!isset($_SESSION["nombre"])) {
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
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Alta arbitros</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/main.css">
        <link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <?php include_once "menu.php" ?>

        <!-- slider de fotos -->
        <div id="page">
            <div id="content-other">
                <h2 id="otro" align="center">Alta Noticia</h2>
                <hr>
                <div class="datagrid">
                    <form method='post' class="form-horizontal form-label-left" action="bddatos/AltaNoticia.php" enctype="multipart/form-data">
                        <span class="section">
                            <?php
                                if (isset($_SESSION["alerta"])) {
                            ?>
                                    <label class="alerta"><?php echo $_SESSION["alerta"]; ?></label>
                                    <?php unset($_SESSION["alerta"]);
                            }?>
                        </span>
                        
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_empleado">Titulo <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="titulo" class="form-control col-md-7 col-xs-12" name="titulo" class="form-control" rows="5" id="comment" placeholder="Ingrese Titulo de Noticia" title="Ingrese descripcción de Noticia" type="text"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_empleado">Descripccion <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="descripccion" class="form-control col-md-7 col-xs-12" name="descripccion" class="form-control" rows="5" id="comment" placeholder="Ingrese descripcción de Noticia" title="Ingrese descripcción de Noticia"></textarea>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto_empleado">Foto <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="foto" style="height: 20%" class="form-control col-md-7 col-xs-12"  name="foto" type="file">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <!--<button type="submit" class="btn btn-primary">Cancelar</button>-->
                                <center>
                                    <button id="send" type="submit" class="btn btn-success">Guardar</button>
                                    <a href="rnoticia.php" class="btn btn-danger">Cancelar</a>
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
