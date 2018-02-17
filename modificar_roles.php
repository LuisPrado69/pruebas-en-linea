
<?php
session_start();
if ((!isset($_SESSION["nombre"]) && !isset($_SESSION["privilegio"])) or ($_SESSION["privilegio"] == 2)) {
    header("Location: sesion.php");
}
include_once 'conn.php';

if (!isset($_GET["id"])) {
    header("Location: rroles.php");
} else {
    $id = base64_decode($_GET['id']);
}

$eamq = mysql_query("select * from roles where id=$id");
if (mysql_num_rows($eamq) > 0) {
    $eamf = mysql_fetch_assoc($eamq);
} else {
    header("Location: rroles.php");
}
include_once "menu.php" 
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
			<h2 id="otro" align="center"><font color="#36A4C4">Modificar Roles</font></h2>
                <hr>
				<div class="datagrid">
					<form method='post' class="form-horizontal form-label-left" action="bddatos/ModificaRolesBD.php" enctype="multipart/form-data">

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
	                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descripccion">Descripccion <span class="required">*</span>
	                        </label>
	                        <div class="col-md-6 col-sm-6 col-xs-12">
	                            <input id="descripccion" class="form-control col-md-7 col-xs-12"  value="<?php echo $eamf["descripccion"]; ?>" name="descripccion" required="required" type="text">
	                        </div>
	                    </div>

	                    <div class="item form-group">
	                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apaterno_empleado">Estado <span class="required">*</span>
	                        </label>
	                        <div class="col-md-6 col-sm-6 col-xs-12">
	                        	<select name="estado" id="estado" class="form-control">
		                        	<option value="0">seleciona un Estado</option>
		                        	<?php
$rSQLcampo = mysql_query("SELECT * FROM estados");
if (mysql_num_rows($rSQLcampo) > 0) {
    while ($filacampo = mysql_fetch_array($rSQLcampo)) {?>
		                        				<option value="<?php echo $filacampo["id"] ?>" <?php if ($eamf["estado"] == $filacampo["id"]) {echo "selected";}?>>
		                        					<?php echo $filacampo["descripccion"] ?>
		                        				</option>
		                        			<?php }
}
?>
		                        </select>
	                        </div>
	                    </div>

						<input type="hidden" value="<?php echo $id ?>" id="id" name="id">


	                    <div class="form-group">
	                        <div class="col-md-6 col-md-offset-3">
	                        <center>
	                            <!--<button type="submit" class="btn btn-primary">Cancelar</button>-->
	                            <button id="send" type="submit" class="btn btn-success">Modificar</button>
				                <a href="rroles.php" class="btn btn-danger">Cancelar</a>
				            </center>
	                        </div>
	                    </div>
                    </form>
        <?php include_once "footer.php" ?>