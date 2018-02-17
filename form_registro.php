
<?php

$con = mysql_connect("localhost", "mach_mach", "Sistemas12.");
mysql_select_db("mach_pruebasmach", $con);

if (isset($_POST["btnguardar"])) {
    $empleado_nombre = $_POST["nombre_empleado"];
    $usuarios        = $_POST["usuario_empleado"];
    $correo          = $_POST["correo"];
    $contrasena      = $_POST["contrasena_empleado"];
    $rcontrasena     = $_POST["contrasena_empleado2"];
    $cargo           = $_POST["cargo"];
    $empresa         = $_POST["empresa"];
    $telefono        = $_POST["telefono"];
    $celular         = $_POST["celular"];

    date_default_timezone_set('America/Bogota');
    $Fecha = date('Y-m-d H:i');

    $rSQLCampov = mysql_query("SELECT usuario,correo FROM usuarios WHERE usuario = '$usuarios' or correo = '$correo'");
    if (mysql_num_rows($rSQLCampov) > 0) {

        echo '<div class="alert alert-warning alert-dismissable">
                    <i class="fa fa-check"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Alerta no se registro este Usuario </b> Ya Existe...';
        echo '   </div>';
    } else if (mysql_query("INSERT INTO usuarios VALUES ('', UPPER('$empleado_nombre'), '$usuarios', md5('$contrasena'), '2' , '$correo', '$cargo', UPPER('$empresa'), '$telefono', '$celular' ,'$Fecha','', '1')")) {
        echo '<div class="alert alert-success alert-dismissable">
                    <i class="fa fa-check"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Usuario Registrado </b> Exitosamente';
        echo '   </div>';
    } else {
        echo '<div class="alert alert-warning alert-dismissable">
                    <i class="fa fa-check"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Alerta no se registro este usuario </b> Ya Existe... ';
        echo '   </div>';die(print_r(mysql_error(), true));
    }
}

?>

<?php
include_once 'conn.php';
?>
<!--validacion numeros-->
<script type="text/javascript"> function controltag(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==8) return true;
        else if (tecla==0||tecla==9)  return true;
       // patron =/[0-9\s]/;// -> solo letras
        patron =/[0-9\s]/;// -> solo numeros
        te = String.fromCharCode(tecla);
        return patron.test(te);
    }
</script>
<!--validacion letras-->
<script type="text/javascript">
function validar(e) { // 1
tecla = (document.all) ? e.keyCode : e.which; // 2
if (tecla==8) return true; // 3
patron =/[A-Za-z\s]/; // 4
te = String.fromCharCode(tecla); // 5
return patron.test(te); // 6
}
</script>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->
    <head>
    <title>Registro</title>
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

        <?php include_once "menu2.html" ?>

        <!-- slider de fotos -->
        <div id="page">
            <div id="content-other">
                <h2 id="otro" align="center"><font color="#36A4C4">Registro Usuario</font></h2>
                <hr>
                <div class="datagrid">
                    <form method='post' class="form-horizontal form-label-left" action="" enctype="multipart/form-data">
                        <span class="section">
                            <?php
                                if (isset($msg["alerta"])) {
                            ?>
                                    <label class="alerta"><?php echo $msg["alerta"]; ?></label>
                                    <?php unset($msg["alerta"]);
                                }?>
                        </span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_empleado">Nombre Completo <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="nombre_empleado" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="nombre_empleado" placeholder="Escriba su Nombre y Apellido" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,} [a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,}" title="Escriba su Nombre y Apellido" onkeypress="return validar(event)" required="required" type="text">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Usuario <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="usuario_empleado" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="usuario_empleado" placeholder="Escriba su Usuario" title="Escriba su Usuario" required="required" type="text">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amaterno_empleado">Contraseña <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="contrasena_empleado"  title="minimo 6 caracteres" pattern=".{6,}" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" name="contrasena_empleado" placeholder="Ingrese su contraseña" required="required" type="password">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amaterno_empleado">Repite Contraseña <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="contrasena_empleado2" pattern=".{6,}" title="minimo 6 caracteres" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" name="contrasena_empleado2" placeholder="Repita su contraseña" required="required" type="password">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Correo <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="correo" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" pattern="^[a-zA-Z0-9.!#$%'*+/=?^_`-]+@[
                                a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" name="correo" placeholder="Ingrese correo electrónico" title="Ingrese correo electrónico" required="required" type="text">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Empresa <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="empresa" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="empresa" placeholder="Ingrese el nombre de su Empresa" title="Ingrese el nombre de su Empresa" required="required" type="text">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amaterno_empleado">Cargo <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="cargo" id="cargo" class="form-control">
                                    <option value="0">Selecciona un Cargo</option>
                                    <?php
$rSQL = mysql_query("SELECT id, descripccion FROM cargos where estado=1");
if (mysql_num_rows($rSQL) > 0) {
    while ($filaEquipo = mysql_fetch_array($rSQL)) {?>
                                                <option value="<?php echo $filaEquipo["id"] ?>"><?php echo $filaEquipo["descripccion"] ?></option>
                                            <?php }
} else {?>
                                            <option value="0">No hay Privilegio</option>
                                        <?php }
?>

                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Teléfono <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="telefono" onkeypress="return controltag(event)" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="telefono" placeholder="Ingrese su número telefónico" required="required" type="text" title="Ingrese su número telefónico">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="apaterno_empleado">Celular <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="celular" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="celular" placeholder="Ingrese su número celular" title="Ingrese su número celular" required="required" onkeypress="return controltag(event)" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <!--<button type="submit" class="btn btn-primary">Cancelar</button>-->
                                <center>
                                <button id="send" type="submit" name="btnguardar" class="btn btn-success">Guardar</button>
                                <a href="rusuarios.php" class="btn btn-danger">Cancelar</a>
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
