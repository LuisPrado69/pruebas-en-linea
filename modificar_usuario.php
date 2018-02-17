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
<?php
session_start();
include_once 'conn.php';

if (!isset($_GET["id"])) {
    header("Location: rusuarios.php");
} else {
    $id =$_GET["id"];
}

$eamq = mysql_query("select * from usuarios where id=$id");
if (mysql_num_rows($eamq) > 0) {
    $eamf = mysql_fetch_assoc($eamq);
} else {
    header("Location: rusuarios.php");
}
include_once "menu.php" 
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
                <h2 id="otro" align="center"><font color="#36A4C4">Modificar Usuario</font></h2>
                <hr>
                <div class="datagrid">
                    <form method='post' class="form-horizontal form-label-left" action="bddatos/ModificaUsuarioBD.php" enctype="multipart/form-data">
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
                                <input id="nombre_empleado" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="nombre_empleado" onkeypress="return validar(event)" placeholder="" required="required" type="text" value="<?php echo $eamf["nombre"] ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Usuario <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="usuario_empleado" class="form-control col-md-7 col-xs-12"  name="usuario_empleado" placeholder="" required="required" type="text" value="<?php echo $eamf["usuario"] ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Correo <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input pattern="^[a-zA-Z0-9.!#$%'*+/=?^_`-]+@[
                                a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" id="correo" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="correo" placeholder="" required="required" type="text" value="<?php echo $eamf["correo"] ?>">
                            </div>
                        </div>

                        <input type="hidden" name="id" id="id" value="<?php echo $id ?>">

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amaterno_empleado">Privlegio <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="privilegio" id="privilegio" class="form-control">
                                    <option value="0">Selecciona un Privlegio</option>
                                    <?php
$rSQL = mysql_query("SELECT id, descripccion FROM roles where estado='1'");
if (mysql_num_rows($rSQL) > 0) {
    while ($filaEquipo = mysql_fetch_array($rSQL)) {?>
                                                <option value="<?php echo $filaEquipo["id"] ?>" <?php if ($filaEquipo["id"] == $eamf["privilegio"]) {echo "selected";}?>><?php echo $filaEquipo["descripccion"] ?></option>
                                            <?php }
} else {?>
                                            <option value="0">No hay estados</option>
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
$rSQL = mysql_query("SELECT id, descripccion FROM cargos where estado='1'");
if (mysql_num_rows($rSQL) > 0) {
    while ($filaEquipo = mysql_fetch_array($rSQL)) {?>
                                                <option value="<?php echo $filaEquipo["id"] ?>" <?php if ($filaEquipo["id"] == $eamf["cargo"]) {echo "selected";}?>><?php echo $filaEquipo["descripccion"] ?></option>
                                            <?php }
} else {?>
                                            <option value="0">No hay estados</option>
                                        <?php }
?>

                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Empresa <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="empresa" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="empresa" placeholder="" required="required" type="text" value="<?php echo $eamf["empresa"] ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Telefono <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="telefono" class="form-control col-md-7 col-xs-12"  name="telefono" onkeypress="return controltag(event)" required="required" type="numeric" onkeypress="return controltag(event)" value="<?php echo $eamf["telefono"] ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Celular <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="celular" class="form-control col-md-7 col-xs-12" onkeypress="return controltag(event)"  name="celular" required="required" type="numeric" onkeypress="return controltag(event)" value="<?php echo $eamf["celular"] ?>">
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
                                                <option value="<?php echo $filaEquipo["id"] ?>" <?php if ($filaEquipo["id"] == $eamf["estado"]) {echo "selected";}?>><?php echo $filaEquipo["descripccion"] ?></option>
                                            <?php }
} else {?>
                                            <option value="0">No hay estados</option>
                                        <?php }
?>

                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <!--<button type="submit" class="btn btn-primary">Cancelar</button>-->

                                <center>
                                <button id="send" type="submit" class="btn btn-success">Modificar</button>
                                <a href="rusuarios.php" class="btn btn-danger">Cancelar</a>
                                </center>
                            </div>
                        </div>
                    </form>
        <?php include_once "footer.php" ?>