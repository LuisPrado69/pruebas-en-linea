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
        <title>Noticias</title>
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
        <link rel="stylesheet" href="dist/css/lightbox.min.css">
        <script src="dist/js/lightbox-plus-jquery.min.js"></script>
        <script>
			function opciones(val)
			{
				var opcion=document.getElementById("opciones"+val).value;
				val = window.btoa(val);
				if(opcion==1)
				{
					window.location= "muestra_noticia.php?id="+val;
				}
				else if (opcion==2)
				{
					window.location= "modificar_noticia.php?id="+val;
				}
				else if (opcion==4)
				{
					window.location= "edita_fotos_noticia.php?id="+val;
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

		<!-- Lista de Arbitros -->
		<div id="page">
			<div id="content-other">
			<div>
				<p class="text-right text-capitalize">bienvenido: <strong><?php echo $_SESSION['nombre']; ?></strong></p>
			</div>
			<h2 id="otro" align="center"><font color="#36A4C4">Lista Noticia</font></h2>
				<div class="text-right">
				<a href="Pdf/reporte_noticias.php" class="btn btn-warning" target="_blank">Reporte Noticias</a>
					<a href="form_noticia.php" class="btn btn-primary">Agregar Noticia</a>
				</div><br>
				<?php
if (isset($_SESSION["alerta"])) {
    ?>
						<label class="alerta"><?php echo $_SESSION["alerta"]; ?></label>
					<?php unset($_SESSION["alerta"]);
}
?>
				<div class="datagrid">
					<div class="table-responsive">
						<table class="table table-bordered table-striped" id="example1" style="text-align: center">
		                <thead>
		                    <tr class="headings">
		                        
		                        <th class="column-title">Foto </th>
		                        <th class="column-title">Titulo </th>
		                        <th class="column-title">Descripcción </th>
		                        <th class="column-title">Estado </th>
		                        <th class="column-title no-link last"><span class="nobr">Acciones</span></th>
							</tr>
						</thead>
                        <tbody>
							<?php
$productosq = mysql_query("select * from noticia");

if (mysql_num_rows($productosq) > 0) {
    while ($productosf = mysql_fetch_assoc($productosq)) {
        ?>
                            			<tr>
                                			<td class=" ">
												<?php
if (file_exists("noticiaimagenes/" . $productosf['imagen']) == 1) {?>
		                                            	<a class="example-image-link" href="noticiaimagenes/<?php echo $productosf["imagen"] ?>" data-lightbox="example-1">
<img class="example-image" src="noticiaimagenes/<?php echo $productosf["imagen"] ?>" width="120px" heigth="100px" alt="image-1" /></a>
													<?php } else {?>
		                                            	<center><img class="img-responsive" src="images/0.jpg" width="120px" heigth="100px"></center>
													<?php }
        ?>
											</td>
                                			<td><?php echo $productosf['titulo']; ?></td>
                                			<td><?php echo $productosf['descripccion']; ?></td>
                                			<td><?php echo get_campo("descripccion", "estados", "id", $productosf['estado']) ?></td>
                                			<td class=" last">
                                				<select class="form-control" onchange="opciones(<?php echo $productosf['id']; ?>)" id="opciones<?php echo $productosf['id']; ?>">
													<option value="">Selecciona...</option>
													<option value="1">Ver</option>
													<option value="2">Modificar</option>
													<option value="4">Edita foto</option>
												</select>
											</td>
										</tr>
									<?php }
} else {?>
	                                <tr>
										<td colspan="4" class="text-center">No hay  Noticias registradas.</td>
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