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
    header("Location: SubPruebas.php");
} else {
    $id = $_GET["id"];
}

$eamq = mysql_query("select * from quiz where eid=$id");
if (mysql_num_rows($eamq) > 0) {
    $eamf = mysql_fetch_assoc($eamq);
} else {
    header("Location: SubPruebas.php");
}
include_once "menu.php" 
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
                <h2 id="otro" align="center"><font color="#36A4C4">Modificar Prueba</font></h2>
                <hr>
                    <form method='post' class="form-horizontal form-label-left" action="bddatos/ModificaPruebaBD.php" enctype="multipart/form-data">
                        <span class="section">
                            <?php
                            if (isset($_SESSION["alerta"])) {
                                ?>
                                    <label class="alerta"><?php echo $_SESSION["alerta"]; ?></label>
                                    <?php unset($_SESSION["alerta"]);
                                }?>
                        </span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_empleado">Título<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="title" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="title"  placeholder="" required="required" type="text" value="<?php echo $eamf["title"] ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Número de Preguntas<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="total" class="form-control col-md-7 col-xs-12" onkeypress="return controltag(event)"  name="total" placeholder="" required="required" type="text" value="<?php echo $eamf["total"] ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Valor Pregunta Correcta <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  id="sahi" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="sahi" placeholder="" required="required" type="text" onkeypress="return controltag(event)" value="<?php echo $eamf["sahi"] ?>">
                            </div>
                        </div>

                        <input type="hidden" name="id" id="id" value="<?php echo $id ?>">


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Valor Pregunta Incorrecta <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="wrong" class="form-control col-md-7 col-xs-12"  name="wrong" onkeypress="return controltag(event)" required="required" type="numeric" onkeypress="return controltag(event)" value="<?php echo $eamf["wrong"] ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Tiempo <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="time" class="form-control col-md-7 col-xs-12" onkeypress="return controltag(event)"  name="time" required="required" type="numeric" onkeypress="return controltag(event)" value="<?php echo $eamf["time"] ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Nombre Diploma <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="intro" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="1" name="intro" placeholder="" required="required" type="text" value="<?php echo $eamf["intro"] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <!--<button type="submit" class="btn btn-primary">Cancelar</button>-->

                                <center>
                                <button id="send" type="submit" class="btn btn-success">Modificar</button>
                                <a href="SubPruebas.php" class="btn btn-danger">Cancelar</a>
                                </center>
                            </div>
                        </div>
                    </form>
        <?php 
            include_once "footer.php";
        ?>


