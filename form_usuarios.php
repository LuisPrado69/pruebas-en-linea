<?php
session_start();
if ((!isset($_SESSION["nombre"]) && !isset($_SESSION["privilegio"])) or ($_SESSION["privilegio"] == 2)) {
    header("Location: sesion.php");
}
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
        <?php include_once "menu.php" ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
                <h2 id="otro" align="center"><font color="#36A4C4">Registro Usuario</font></h2>
                <hr>
                    <form method='post' class="form-horizontal form-label-left" action="bddatos/AltaUsuariosBD.php" enctype="multipart/form-data">
                        <span class="section">
                            <?php
if (isset($_SESSION["alerta"])) {
    ?>
                                    <label class="alerta"><?php echo $_SESSION["alerta"]; ?></label>
                                    <?php unset($_SESSION["alerta"]);
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
                                <input pattern=".{6,}" title="minimo 6 caracteres" id="contrasena_empleado" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" name="contrasena_empleado" placeholder="Ingrese su contraseña" required="required" type="password">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amaterno_empleado">Repite Contraseña <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input pattern=".{6,}" title="minimo 6 caracteres" id="contrasena_empleado2" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" name="contrasena_empleado2" placeholder="Repita contraseña" required="required" type="password">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Correo <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input pattern="^[a-zA-Z0-9.!#$%'*+/=?^_`-]+@[
                                a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" id="correo" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" title="Ingrese su correo electrónico" name="correo" placeholder="Ingrese su correo electrónico" required="required" type="text">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amaterno_empleado">Privilegio <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="privilegio" id="privilegio" class="form-control">
                                    <option value="0">Selecciona un Privilegio</option>
                                    <?php
$rSQL = mysql_query("SELECT id, descripccion FROM roles where estado=1");
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
                                            <option value="0">No hay Estado</option>
                                        <?php }
?>

                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Empresa <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  id="empresa" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="empresa" placeholder="Ingrese nombre de su Empresa" title="Ingrese nombre de su Empresa" required="required" type="text">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Telefono <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  id="telefono" class="form-control col-md-7 col-xs-12" onkeypress="return controltag(event)" data-validate-length-range="5" data-validate-words="1" name="telefono" placeholder="Ingrese su número telefónico" required="required" title="Ingrese su número telefónico" type="text">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="apaterno_empleado">Celular <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  id="celular" class="form-control col-md-7 col-xs-12" onkeypress="return controltag(event)" data-validate-length-range="5" data-validate-words="1" name="celular" placeholder="Ingrese su número celular" title="Ingrese su número celular" required="required" type="text">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amaterno_empleado">Estado <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="estado" id="estado" class="form-control">
                                    <option value="0">Selecciona un Estado</option>
                                    <?php
$rSQL = mysql_query("SELECT id, descripccion FROM estados");
if (mysql_num_rows($rSQL) > 0) {
    while ($filaEquipo = mysql_fetch_array($rSQL)) {?>
                                                <option value="<?php echo $filaEquipo["id"] ?>"><?php echo $filaEquipo["descripccion"] ?></option>
                                            <?php }
} else {?>
                                            <option value="0">No hay Estado</option>
                                        <?php }
?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <!--<button type="submit" class="btn btn-primary">Cancelar</button>-->
                                <center>
                                <button id="send" type="submit" class="btn btn-success">Guardar</button>
                                <a href="rusuarios.php" class="btn btn-danger">Cancelar</a>
                                </center>
                            </div>
                        </div>
                    </form>
        <?php include_once "footer.php" ?>

