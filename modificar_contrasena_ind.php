
<?php
session_start();
if (!isset($_SESSION["nombre"])) {
    header("Location: sesion.php");
}
include_once 'conn.php';

if (!isset($_GET["id"])) {
    header("Location: rusuarios.php");
} else {
    $id = $_GET["id"];
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
					<h2 class="text-center text-capitalize"><font color="#36A4C4">Modificar Contraseña</font></h2>
					<hr>
					<form method='post' class="form-horizontal form-label-left" action="bddatos/ModificaContrasenaIndBD.php" enctype="multipart/form-data">

	                    <span class="section">
							<?php
if (isset($_SESSION["alerta"])) {
    ?>
									<label class="alerta"><?php echo $_SESSION["alerta"]; ?></label>
									<?php unset($_SESSION["alerta"]);
}
?>
						</span>

						<div class="item form-group">
	                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_empleado">Contraseña <span class="required">*</span>
	                        </label>
	                        <div class="col-md-6 col-sm-6 col-xs-12">
	                            <input pattern=".{6,}" title="minimo 6 caracteres" id="contrasena_empleado" class="form-control col-md-7 col-xs-12" name="contrasena_empleado" required="required" type="password">
	                        </div>
	                    </div>

	                    <div class="item form-group">
	                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_empleado">Repite Contraseña <span class="required">*</span>
	                        </label>
	                        <div class="col-md-6 col-sm-6 col-xs-12">
	                            <input pattern=".{6,}" title="minimo 6 caracteres" id="contrasena_empleado2" class="form-control col-md-7 col-xs-12" name="contrasena_empleado2" required="required" type="password">
	                        </div>
	                    </div>

						<input type="hidden" value="<?php echo $id ?>" id="id_empleado" name="id_empleado">


	                    <div class="form-group">
	                        <div class="col-md-6 col-md-offset-3">
							<center>
	                            <button id="send" type="submit" class="btn btn-success">Modificar</button>
	                            <a href="rusuarion_indv.php" class="btn btn-danger">Cancelar</a>
	                        </center>
	                        </div>
	                    </div>
                    </form>
        <?php include_once "footer.php" ?>