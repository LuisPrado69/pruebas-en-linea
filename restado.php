<?php
session_start();
if ((!isset($_SESSION["nombre"]) && !isset($_SESSION["privilegio"])) or ($_SESSION["privilegio"] == 2)) {
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
        <title>Estado</title>
    <link rel="shortcut icon" href="images/icno.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <link type="text/css" href="css/jquery.dataTables_themeroller.css" rel="stylesheet"/>

        <script>
			function opciones(val)
			{
				var opcion=document.getElementById("opciones"+val).value;
				val = window.btoa(val);
				if(opcion==1)
				{
					window.location= "muestra_estado.php?id="+val;
				}
				else if (opcion==2)
				{
					window.location= "modificar_estado.php?id="+val;
				}
				//window.location= "d_productos.php?b="+document.getElementById(val).value;
			}
		</script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <?php include_once "menu.php"?>

		<!-- slider de fotos -->
		<div id="page">
			<div id="content-other">
				<div>
					<p class="text-right text-capitalize">bienvenido: <strong><?php echo $_SESSION['nombre']; ?></strong></p>
				</div>
			<h2 id="otro" align="center"><font color="#36A4C4">Lista Estados</font></h2>
				<div class="text-right">
					<a href="Pdf/reporte_estado.php" class="btn btn-warning" target="_blank">Reporte Estado</a>
					<a href="form_estado.php" class="btn btn-primary">Agregar Estado</a>
				</div>
				<?php
if (isset($_SESSION["alerta"])) {
    ?>
						<label class="alerta"><?php echo $_SESSION["alerta"]; ?></label>
						<?php unset($_SESSION["alerta"]);
}
?>
				<div class="datagrid"><br>
				<div class="table-responsive">
						<table class="table table-bordered table-striped" id="example1" style="text-align: center">
			                <thead>
			                    <tr class="headings">
			                        <th class="column-title">Descripccion </th>
			                        <th class="column-title no-link last"><span class="nobr">Acciones</span></th>
								</tr>
							</thead>

			                <tbody>
								<?php
$productosq = mysql_query("select * from estados");
if (mysql_num_rows($productosq) > 0) {
    while ($productosf = mysql_fetch_assoc($productosq)) {?>
			                    			<tr>
			                        			<td class=" "><?php echo $productosf['descripccion']; ?></td>
												<td>
													<select class="form-control" onchange="opciones(<?php echo $productosf['id']; ?>)" id="opciones<?php echo $productosf['id']; ?>">
														<option value="">Selecciona...</option>
														<option value="1">Ver</option>
														<option value="2">Modificar</option>
													</select>
												</td>
			                    			</tr>
									<?php }
} else {?>
			                            <tr>
											<td colspan="4" class="text-center">No hay equipos registrados.</td>
										</tr>
									<?php }
?>
							</tbody>
						</table>
				</div>
			</div>
		</div>

	  	<!--Pie de página-->
	  	<?php include_once "footer.php"?>

		<script type="text/javascript">
            $("#example1").dataTable(
            {
                "oLanguage":
                {
                    "sSearch": "Filtrar Datos:",
                    "sLengthMenu": "_MENU_ ",
                    "sInfo": "Mostrando _START_ a _END_ de entradas _TOTAL_",
                    "oPaginate":
                    {
                        "sNext": "",
                        "sPrevious": ""
                    }
                }
             } );
        </script>

        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
