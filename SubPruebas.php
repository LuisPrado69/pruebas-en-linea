<?php
session_start();
if ((!isset($_SESSION["nombre"]) && !isset($_SESSION["privilegio"])) or ($_SESSION["privilegio"] == 2)) {
    header("Location: sesion.php");
}
include_once 'conn.php';
?>
<?php
if (!empty($_GET['status'])) {
    switch ($_GET['status']) {
        case 'succ':
            $statusMsgClass = 'alert-success';
            $statusMsg      = 'Archivos Subidos Correctamente.';
            break;
        case 'err':
            $statusMsgClass = 'alert-danger';
            $statusMsg      = 'HUbo un problema subiendo el archivo, Intente de nuevo.';
            break;
        case 'invalid_file':
            $statusMsgClass = 'alert-danger';
            $statusMsg      = 'Archivo no compatible.';
            break;
        default:
            $statusMsgClass = '';
            $statusMsg      = '';
    }
}
?>


  <style type="text/css">
    .panel-heading a{float: right;}
    #importFrm{margin-bottom: 20px;display: none;}
    #importFrm input[type=file] {display: inline;}
  </style>
    <script>
      function opciones(val)
      {
        var opcion=document.getElementById("opciones"+val).value;
        if(opcion==1)
        {
          window.location= "modificar_pruebas.php?id="+val;
        }
        if(opcion==2)
        {
          window.location= "preguntas_pruebas.php?id="+val;
        }
        //window.location= "d_productos.php?b="+document.getElementById(val).value;
      }
    </script>

<?php include_once "menu.php" ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content">
        <div>
          <p class="text-right text-capitalize">bienvenido: <strong><?php echo $_SESSION['nombre']; ?></strong></p>
        </div>
        <h2 id="otro"align="center"><font color="#36A4C4">Listado de Pruebas</font></h2>
    <?php if (!empty($statusMsg)) {
    echo '<div class="alert ' . $statusMsgClass . '">' . $statusMsg . '</div>';
}?>

        <div class="panel-heading">
            Lista de Pruebas
            <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Subir Prueba</a>
        </div>
        <span class="section">
              <?php
if (isset($_SESSION["alerta"])) {
    ?>
                  <label class="alerta"><?php echo $_SESSION["alerta"]; ?></label>
                  <?php unset($_SESSION["alerta"]);
}
?>
        </span>
            <form action="SubPru.php" method="post" enctype="multipart/form-data" id="importFrm">
                <input type="file" name="file" />
                <input type="submit" class="btn btn-primary" name="importSubmit" value="SUBIR ARCHIVO">
            </form>
            <div class="table-responsive">
            <table class="table table-bordered table-striped" id="example1" style="text-align: center">
                <thead>
                    <tr>
                      <th>Código</th>
                      <th>Ttulo</th>
                      <th>Corrrectas</th>
                      <th>Incorrectas</th>
                      <th>Preguntas</th>
                      <th>Tiempo</th>
                      <th>Intro</th>
                      <th>Comentario</th>
                      <th>Fecha</th>
                      <th class="column-title no-link last"><span class="nobr">Acciones</span></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                  $productosq = mysql_query("select * from quiz");
                  if (mysql_num_rows($productosq) > 0) {
                      while ($productosf = mysql_fetch_assoc($productosq)) {?>
                                <tr>
                                    <td>Prueba: <?php echo $productosf['eid']; ?></td>
                                    <td><?php echo $productosf['title']; ?></td>
                                    <td><?php echo $productosf['sahi']; ?></td>
                                    <td><?php echo $productosf['wrong']; ?></td>
                                    <td><?php echo $productosf['total'] ?></td>
                                    <td><?php echo $productosf['time'] ?></td>
                                    <td><?php echo $productosf['intro'] ?></td>
                                    <td><?php echo $productosf['tag'] ?></td>
                                    <td><?php echo $productosf['date'] ?></td>
                                    <td>
                                      <select class="form-control" onchange="opciones(<?php echo $productosf['eid']; ?>)" id="opciones<?php echo $productosf['eid']; ?>">
                                        <option value="">Selecciona...</option>
                                        <option value="1">Modificar</option>
                                        <option value="2">Preguntas</option>
                                      </select>
                                    </td>
                                </tr>
                  <?php }

} else {?>
                                  <tr>
                      <td colspan="10" class="text-center">No hay Pruebas registradas.</td>
                    </tr>
                  <?php }
                  mysql_free_result($productosq);
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
