<?php
session_start();
if ((!isset($_SESSION["nombre"]) && !isset($_SESSION["privilegio"])) or ($_SESSION["privilegio"] == 2)) {
    header("Location: sesion.php");
}
include_once 'conn.php';
?>
        <script>
			function opciones(val)
			{
				var opcion=document.getElementById("opciones"+val).value;
				if(opcion==1)
				{
					window.location= "muestra_cargos.php?id="+val;
				}
				else if (opcion==2)
				{
					window.location= "modificar_cargos.php?id="+val;
				}
				//window.location= "d_productos.php?b="+document.getElementById(val).value;
			}
		</script>
        <?php include_once "menu.php" ?>

		<!-- slider de fotos -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<section class="content">
			<div>
				<p class="text-right text-capitalize">bienvenido: <strong><?php echo $_SESSION['nombre']; ?></strong></p>
			</div>
			<h2  id="otro" align="center"><font color="#36A4C4">Lista Cargos</font></h2>
				<div class="text-right">
					<a href="Pdf/reporte_cargos.php" class="btn btn-warning" target="_blank">Reporte Cargos</a>
					<a href="form_cargos.php" class="btn btn-primary">Agregar Cargos</a>
				</div>
				<br>
				<?php
				if (isset($_SESSION["alerta"])) {
				    ?>
						<label class="alerta"><?php echo $_SESSION["alerta"]; ?></label>
						<?php unset($_SESSION["alerta"]);
					}
					?>
				<div class="table-responsive">
						<table class="table table-bordered table-striped " id="example1">
			                <thead>
			                    <tr class="headings">
			                        <th class="column-title">Descripccion </th>
			                        <th class="column-title">Estado </th>
			                        <th class="column-title no-link last"><span class="nobr">Acciones</span></th>
								</tr>
							</thead>

			                <tbody>
								<?php
								$productosq = mysql_query("select * from cargos");
								if (mysql_num_rows($productosq) > 0) {
								    while ($productosf = mysql_fetch_assoc($productosq)) {?>
			                    			<tr>
			                        			<td class=" "><?php echo $productosf['descripccion']; ?></td>
			                        			<td><?php echo get_campo("descripccion", "estados", "id", $productosf['estado']) ?></td>
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
	  	<!--Pie de página-->
	  	<?php include_once "footer.php" ?>
