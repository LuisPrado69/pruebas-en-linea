<?php
session_start();
if ((!isset($_SESSION["nombre"]))) {
    header("Location: sesion.php");
}
include_once 'conn.php';

?>


        <script>
			function opciones(val)
			{
				var opcion=document.getElementById("opciones"+val).value;
				if (opcion==1)
				{
					window.location= "modificar_contrasena_ind.php?id="+val;
				}
				else if (opcion==2)
				{
					window.location= "modificar_usuario_ind.php?id="+val;
				}

			}
		</script>


        <?php include_once "menu.php" ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<section class="content">
				<div>
					<p class="text-right text-capitalize">bienvenido: <strong><?php echo $_SESSION['nombre']; ?></strong></p>
				</div>
				<h2 id="otro" align="center"><font color="#36A4C4">Perfil Usuario</font></h2>
				<?php
				if (isset($_SESSION["alerta"])) {
				    ?>
						<label class="alerta"><?php echo $_SESSION["alerta"]; ?></label>
					<?php unset($_SESSION["alerta"]);
					}
					?>
					<br>
					<div class="table-responsive">
						<table class="table table-bordered table-striped" id="example1" style="text-align: center">
		                <thead>
		                    <tr class="headings">
		                        <th class="column-title">Nombre </th>
		                        <th class="column-title">Usuario </th>
		                        <th class="column-title">Privilegio </th>
		                        <th class="column-title">Correo </th>
		                        <th class="column-title">Cargo </th>
		                        <th class="column-title">Empresa </th>
		                        <th class="column-title">Telefono </th>
		                        <th class="column-title">Celular </th>
		                        <th class="column-title">Estado </th>
		                        <th class="column-title no-link last"><span class="nobr">Acciones</span></th>
							</tr>
						</thead>
                        <tbody>
							<?php
							$id         = $_SESSION['id'];
							$productosq = mysql_query("select * from usuarios where id='$id'");

							if (mysql_num_rows($productosq) > 0) {
							    while ($productosf = mysql_fetch_assoc($productosq)) {?>
                            			<tr>
                                			<td class=" "><?php echo $productosf['nombre'] ?></td>
                                			<td><?php echo $productosf['usuario']; ?></td>
                                			<td><?php echo get_campo('descripccion', 'roles', 'id', $productosf['privilegio']); ?></td>
                                			<td><?php echo $productosf['correo'] ?></td>

                                			<td><?php echo get_campo('descripccion', 'cargos', 'id', $productosf['cargo']); ?></td>
											<td><?php echo $productosf['empresa'] ?></td>
											<td><?php echo $productosf['telefono'] ?></td>
											<td><?php echo $productosf['celular'] ?></td>
                                			<td><?php echo get_campo('descripccion', 'estados', 'id', $productosf['estado']); ?></td>
                                			<td class=" last">
                                				<select class="form-control" onchange="opciones(<?php echo $productosf['id']; ?>)" id="opciones<?php echo $productosf['id']; ?>">
													<option value="">Selecciona...</option>
													<option value="1">Contraseña</option>
													<option value="2">Modificar</option>
												</select>
											</td>
										</tr>
									<?php }
} else {?>
	                                <tr>
										<td colspan="4" class="text-center">No hay Usuarios registrados.</td>
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
      	<!--Pie de pagina-->
      	<?php include_once "footer.php" ?>