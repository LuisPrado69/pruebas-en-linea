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
    header("Location: SubAyudas.php");
} else {
    $id = $_GET["id"];
}

$eamq = mysql_query("select * from ayuda where qid=$id");
if (mysql_num_rows($eamq) > 0) {
    $eamf = mysql_fetch_assoc($eamq);
} else {
    header("Location: SubAyudas.php");
}
include_once "menu.php" 
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
                <h2 id="otro" align="center"><font color="#36A4C4">Modificar Ayuda</font></h2>
                <hr>
                    <form method='post' class="form-horizontal form-label-left" action="bddatos/ModificaAyudaBD.php" enctype="multipart/form-data">
                        <span class="section">
                            <?php
if (isset($_SESSION["alerta"])) {
    ?>
                                    <label class="alerta"><?php echo $_SESSION["alerta"]; ?></label>
                                    <?php unset($_SESSION["alerta"]);
}?>
                        </span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_empleado">Ayuda<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="ayuda" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="ayuda"  placeholder="" required="required" type="text" value="<?php echo $eamf["ayuda"] ?>">
                            </div>
                        </div>

                        <input type="hidden" name="id" id="id" value="<?php echo $id ?>">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <!--<button type="submit" class="btn btn-primary">Cancelar</button>-->

                                <center>
                                <button id="send" type="submit" class="btn btn-success">Modificar</button>
                                <a href="SubAyudas.php" class="btn btn-danger">Cancelar</a>
                                </center>
                            </div>
                        </div>
                    </form>
        <?php include_once "footer.php"?>
