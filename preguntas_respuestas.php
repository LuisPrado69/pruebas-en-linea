<?php
session_start();
if ((!isset($_SESSION["nombre"]) && !isset($_SESSION["privilegio"])) or ($_SESSION["privilegio"] == 2)) {
    header("Location: sesion.php");
}
include_once 'conn.php';
$id =$_GET["id"];
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
          window.location= "modificar_respuestas1.php?id="+val;
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
        <h2 id="otro"align="center"><font color="#36A4C4">Listado de Respuestas</font></h2>
    <?php if (!empty($statusMsg)) {
    echo '<div class="alert ' . $statusMsgClass . '">' . $statusMsg . '</div>';
}?>
        <span class="section">
              <?php
if (isset($_SESSION["alerta"])) {
    ?>
                  <label class="alerta"><?php echo $_SESSION["alerta"]; ?></label>
                  <?php unset($_SESSION["alerta"]);
}
?>
        </span>
            <form action="SubRes.php" method="post" enctype="multipart/form-data" id="importFrm">
                <input type="file" name="file" />
                <input type="submit" class="btn btn-primary" name="importSubmit" value="SUBIR ARCHIVO">
            </form>
            <div class="table-responsive">
            <table class="table table-bordered table-striped" id="example1" style="text-align: center">
                <thead >
                    <tr>
                      <th>Código Pregunta</th>
                      <th>Respuesta</th>
                      <th class="column-title no-link last"><span class="nobr">Acciones</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //get rows query
                    $query = $db->query("SELECT * FROM answer where qid=$id");
                    if ($query->num_rows > 0) {
                        while ($row = $query->fetch_assoc()) {
                            ?>
                    <tr>
                      <td>Pregunta: <?php echo $row['qid']; ?></td>
                      <td><?php echo $row['ansid']; ?></td>

                      <td>
                        <select class="form-control" onchange="opciones(<?php echo $row['qid']; ?>)" id="opciones<?php echo $row['qid']; ?>">
                          <option value="">Selecciona...</option>
                          <option value="1">Modificar</option>
                        </select>
                      </td>
                    </tr>
                    <?php }} else {?>
                    <tr><td colspan="5">No hay Respuestas registradas.....</td></tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <a href="javascript:history.go(-1);" class="btn btn-danger">Volver</a> 
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