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
    header("Location: SubRespuestas.php");
} else {
    $id = $_GET["id"];
}

$eamq = mysql_query("select * from answer where qid=$id");
if (mysql_num_rows($eamq) > 0) {
    $eamf = mysql_fetch_assoc($eamq);
} else {
    header("Location: SubRespuestas.php");
}
include_once "menu.php" 
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
                <h2 id="otro" align="center"><font color="#36A4C4">Modificar Respuesta</font></h2>
                <hr>
                <div class="datagrid">
                    <form method='post' class="form-horizontal form-label-left" action="bddatos/ModificaRespuestaBD1.php" enctype="multipart/form-data">
                        <span class="section">
                            <?php
if (isset($_SESSION["alerta"])) {
    ?>
                                    <label class="alerta"><?php echo $_SESSION["alerta"]; ?></label>
                                    <?php unset($_SESSION["alerta"]);
}?>
                        </span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Respuesta <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="answer" id="answer" class="form-control">
                                    <option value="0">seleciona un Respuesta</option>
                                    <?php
$rSQLcampo = mysql_query("SELECT * FROM options where qid=$id");
if (mysql_num_rows($rSQLcampo) > 0) {
    while ($filacampo = mysql_fetch_array($rSQLcampo)) {?>
                                                <option value="<?php echo $filacampo["optionid"] ?>" <?php if ($eamf["ansid"] == $filacampo["optionid"]) {echo "selected";}?>>
                                                    <?php echo $filacampo["option"] ?>
                                                </option>
                                            <?php }
}
mysql_free_result($filacampo);
?>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="id" id="id" value="<?php echo $id ?>">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <!--<button type="submit" class="btn btn-primary">Cancelar</button>-->

                                <center>
                                <button id="send" type="submit" class="btn btn-success">Modificar</button>
                                <a href="javascript:history.go(-1);" class="btn btn-danger">Volver</a>
                                </center>
                            </div>
                        </div>
                    </form>
        <?php include_once "footer.php" ?>