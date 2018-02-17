<?php
session_start();
if ((!isset($_SESSION["nombre"]) && !isset($_SESSION["privilegio"])) or ($_SESSION["privilegio"] == 2)) {
    header("Location: sesion.php");
}
include_once 'conn.php';
?>
<?php include_once "menu.php" ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
            <div id="content-other">
                <h2 id="otro" align="center"><font color="#36A4C4">Registro Cargos</font></h2>
                <hr>
                    <form method='post' class="form-horizontal form-label-left" action="bddatos/AltaCargosBD.php" enctype="multipart/form-data">
                        <span class="section">
                            <?php
if (isset($_SESSION["alerta"])) {
    ?>
                                    <label class="alerta"><?php echo $_SESSION["alerta"]; ?></label>
                                    <?php unset($_SESSION["alerta"]);
}?>
                        </span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_empleado">Descripccion <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="descripccion" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="descripccion" placeholder="Ingrese descripcción de Cargo" required="required" type="text">

                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado">Estado <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="estado" id="estado" class="form-control col-md-7 col-xs-12">
                                    <option value="0">Seleciona  un Estado</option>
                                    <?php
$rSQLCampo = mysql_query("SELECT id, descripccion FROM estados");
if (mysql_num_rows($rSQLCampo) > 0) {
    while ($filacampo = mysql_fetch_array($rSQLCampo)) {?>
                                                <option value="<?php echo $filacampo["id"] ?>"><?php echo $filacampo["descripccion"] ?></option>
                                            <?php }
} else {?>
                                            <option value="0">No hay campos para seleccionar</option>
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
                                <a href="rcargos.php" class="btn btn-danger">Cancelar</a>
                            </center>
                            </div>
                        </div>
                    </form>
        <?php include_once "footer.php" ?>