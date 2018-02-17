<!--validacion numeros-->
<script type="text/javascript"> function controltag(e) 
{
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
function validar(e) 
{ // 1
  tecla = (document.all) ? e.keyCode : e.which; // 2
  if (tecla==8) return true; // 3
  patron =/[A-Za-z\s]/; // 4
  te = String.fromCharCode(tecla); // 5
  return patron.test(te); // 6
}
</script>
<?php
session_start();
if ((!isset($_SESSION["nombre"]) && !isset($_SESSION["privilegio"])) or ($_SESSION["privilegio"] == 2)) {
    header("Location: sesion.php");
}
include_once 'conn.php';
require 'encriptar.php';
$email = $_SESSION['correo'];
?>

<?php include_once "menu.php" ?>
<!-- slider de fotos -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content">
        <div>
          <p class="text-right text-capitalize">bienvenido: <strong><?php echo $_SESSION['nombre']; ?></strong></p>
        </div>
        <h2 id="otro" align="center"><font color="#36A4C4">Pruebas</font></h2>
<?php if (@$_GET['q'] == 1) {

    $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
    echo '
<div class="table-responsive">
<table class="table table-striped title1" style="text-align: center">
<tr style="color:#000000">
  <td><b>Codigo</b></td>
  <td><b>Tema</b></td>
  <td><b>Total Preguntas</b></td>
  <td><b>Puntaje</b></td>
  <td><b>Tiempo Limite</b></td>
  <td colspan="2"><b>Opcciones</b></td>
</tr>';
    $c = 1;
    while ($row = mysqli_fetch_array($result)) {
        $title    = $row['title'];
        $total    = $row['total'];
        $sahi     = $row['sahi'];
        $time     = $row['time'];
        $eid      = $row['eid'];
        $q12      = mysqli_query($con, "SELECT score FROM history WHERE eid='$eid' AND email='$email'") or die('Error98');
        $rowcount = mysqli_num_rows($q12);
        while ($row = mysqli_fetch_array($q12)) {
            $sco = $row['score'];
        }
        if ($rowcount == 0) {
            echo '
<tr>
  <td>' . $c++ . '</td>
  <td>' . $title . '</td>
  <td>' . $total . '</td>
  <td>' . $sahi * $total . '</td>
  <td>' . $time . '&nbsp;min</td>
  <td>
  <a href="account.php?q=quiz&step=2&eid=' . $eid . '&n=1&t=' . $total . '" class="pull-center btn sub1" style="margin:0px;background:#99cc32">
  <font color="white"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;
  <b>Inicio</b></font></a>
  </td>
</tr>';
        } else {
            echo '
<tr style="color:#99cc32">
  <td>' . $c++ . '</td><td>' . $title . '&nbsp;<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
  <td>' . $total . '</td>
  <td><b>' . $sco . '/' . $sahi * $total . '</td>
  <td>' . $time . '&nbsp;min</td>
  <td><center>
  <b><a href="update.php?q=quizre&step=25&eid=' . $eid . '&n=1&t=' . $total . '" class="pull-right btn sub1" style="margin:0px;background:red">
  <font color="white"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>
  &nbsp;<b>Reinicio</b></font></a></b>
  </td>';
            $tot = $sahi * $total;
            $tu  = ($sco / $tot * 100);
            if ($tu > 59) {
                $id_usu = $_SESSION['correo'];
                echo '
    <td><center>
      <a href="Pdf/diploma.php?id=' . $id_usu . '&pr=' . $eid . '" target="_blank" class="btn btn-primary"><b>Diploma</a>
    </td>';
            }
        }
    }
    $c = 0;
    echo '
</tr>
  </table>
</div>';
}?>


<!--historial start-->
<?php
if (@$_GET['q'] == 2) {
    $q = mysqli_query($con, "SELECT * FROM history WHERE email='$email' ORDER BY date DESC ") or die('Error197');
    echo '
<div class="table-responsive">
  <table class="table table-striped title1" style="text-align: center">
    <tr style="color:#000000">
      <td><b>Codigo</b></td>
      <td><span class="glyphicon glyphicon-paperclip"></span><b>&nbsp;Tema Prueba</b></td>
      <td><span class="glyphicon glyphicon-pencil"></span><b>&nbsp;Preguntas Resueltas</b></td>
      <td><span class="glyphicon glyphicon-ok"></span><b>&nbsp;Correctas</b></td>
      <td><span class="glyphicon glyphicon-remove"></span><b>&nbsp;Erroneas<b></td>
      <td><span class="glyphicon glyphicon-align-left"></span><b>&nbsp;Puntaje</b></td>';
        $c = 0;
        while ($row = mysqli_fetch_array($q)) {
            $eid = $row['eid'];
            $s   = $row['score'];
            $w   = $row['wrong'];
            $r   = $row['sahi'];
            $qa  = $row['level'];
            $q23 = mysqli_query($con, "SELECT title FROM quiz WHERE  eid='$eid' ") or die('Error208');
            while ($row = mysqli_fetch_array($q23)) {
                $title = $row['title'];
            }
            $c++;
            echo '
      <tr style="color:#0B911B">
        <td>' . $c . '</td>
        <td><b>' . $title . '</td>
        <td>' . $qa . '</td>
        <td>' . $r . '</td>
        <td>' . $w . '</td>
        <td><b>' . $s . '</td>
      </tr>';
    }
    echo '</table></div>';
}
?>

<!--historial todos start-->
<?php
if (@$_GET['q'] == 3) {
    $q = mysqli_query($con, "
SELECT 
h.eid, h.score , h.level , h.sahi, h.wrong, 
u.nombre,u.correo, 
q.title,
i.numero
FROM 
history h , usuarios u , quiz q , intentos i
WHERE 
q.eid=h.eid and h.email=u.correo and u.correo=i.correo and i.eid=q.eid") or die('Error197');
    echo '<BR>
<div class="text-right">
  <a href="Pdf/reporte_histopruebas.php" class="btn btn-warning" target="_blank">Reporte Historial Usuarios</a>
</div>
<br>
<div class="table-responsive">
<table class="table table-striped title1" style="text-align: center">
<tr style="color:#000000">
  <td><span class="glyphicon glyphicon-paperclip"></span><b>&nbsp;Tema Prueba</b></td>
  <td><span class="glyphicon glyphicon-pencil"></span><b>&nbsp;Usuario</b></td>
  <td><span class="glyphicon glyphicon-pencil"></span><b>&nbsp;Preguntas</b></td>
  <td><span class="glyphicon glyphicon-ok"></span><b>&nbsp;Correctas</b></td>
  <td><span class="glyphicon glyphicon-remove"></span><b>&nbsp;Erroneas<b></td>
  <td><span class="glyphicon glyphicon-align-left"></span><b>&nbsp;Puntaje</b></td>
  <td><span class="glyphicon glyphicon-align-left"></span><b>&nbsp;Intento</b></td>';
    $c = 0;
    while ($row = mysqli_fetch_array($q)) 
    {
        $e = $row['eid'];
        $eid = $row['sahi'];
        $s   = $row['score'];
        $w   = $row['wrong'];
        $r   = $row['nombre'];
        $c   = $row['correo'];
        $qa  = $row['title'];
        $qb  = $row['numero'];
        $c++;
echo '
  <tr style="color:#0B911B">
    <td>' . $qa . '</td>
    <td>' . $r . '</td>
    <td>' . $qb . '</td>
    <td>' . $eid . '</td>
    <td>' . $w . '</td>
    <td><b>' . $s . '</td>
    <td><b>' . $qb . '</td>
  </tr>';
  }  
 }   
    echo '</table>';
?>


<!--add quiz start-->
<?php
if (@$_GET['q'] == 4 && !(@$_GET['step'])) {
    echo '
<center>
<span class="title1" style="font-size:30px;"><b>Ingrese detalles de la Prueba</b></span><br /><br />


 <form class="form-horizontal form-label-left" name="form" action="update.php?q=addquiz"  method="POST">

<!-- Text input-->
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Titulo de Prueba</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
  <input id="name" name="name" placeholder="Titulo de Prueba" required class="form-control col-md-7 col-xs-12" type="text">
  </div>
</div>
<!-- Text input-->
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total">Numero de preguntas</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
  <input id="total" name="total" placeholder="Numero de preguntas" required onkeypress="return controltag(event)" class="form-control col-md-7 col-xs-12">
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="right">Valor por pregunta correcta</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
  <input id="right" name="right" placeholder="Valor por pregunta correcta" required onkeypress="return controltag(event)" class="form-control col-md-7 col-xs-12" min="0" >
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="wrong">Valor por pregunta incorrecta</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
  <input id="wrong" name="wrong" placeholder="Valor por pregunta incorrecta" required onkeypress="return controltag(event)" class="form-control col-md-7 col-xs-12" min="0" >
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="time">Tiempo para la prueba</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
  <input id="time" name="time" placeholder="Tiempo para la prueba" required onkeypress="return controltag(event)" class="form-control col-md-7 col-xs-12" min="1" >
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tag">Nombre para busqueda</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
  <input id="tag" name="tag" placeholder="Nombre para busqueda" required class="form-control col-md-7 col-xs-12" type="text">
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Nombre del Titulo</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
  <textarea rows="8" cols="8" name="desc" class="form-control" required placeholder="Nombre del Titulo..."></textarea>
  </div>
</div>
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""></label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Siguiente" class="btn btn-primary"/>
  </div>
</div>
</fieldset>
</form>';
}
?>
<!--add quiz end-->

<!--add quiz step2 start-->
<?php
if (@$_GET['q'] == 4 && (@$_GET['step']) == 2) {
    echo '
<div class="datagrid">
<center><b>Ingrese el detalle de las preguntas</b></center></span><br /><br />

 <form class="form-horizontal title1" name="form" action="update.php?q=addqns&n=' . @$_GET['n'] . '&eid=' . @$_GET['eid'] . '&ch=4 "  method="POST">

';

    for ($i = 1; $i <= @$_GET['n']; $i++) {
        echo '
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qns' . $i . ' ">Pregunta numero&nbsp;' . $i . '</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
  <textarea rows="3" cols="5" name="qns' . $i . '" class="form-control" placeholder="Ingrese la pregunta ' . $i . ' aqui..."></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $i . '1">Opccion a</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
  <input id="' . $i . '1" name="' . $i . '1" placeholder="Opción a" class="form-control input-md" type="text">

  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $i . '2">Opccion b</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
  <input id="' . $i . '2" name="' . $i . '2" placeholder="Opción b" class="form-control input-md" type="text">

  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $i . '3">Opccion c</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
  <input id="' . $i . '3" name="' . $i . '3" placeholder="Opción c" class="form-control input-md" type="text">

  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $i . '4">Opccion d</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
  <input id="' . $i . '4" name="' . $i . '4" placeholder="Opción d" class="form-control input-md" type="text">

  </div>
</div>
<!-- Ayuda input-->
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="' . $i . '5">Ayuda</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
  <input id="' . $i . '4" name="' . $i . '5" placeholder="Ayuda" class="form-control input-md" type="text">

  </div>
</div>
<div class="item form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="amaterno_empleado">Respuesta <span class="required">*</span>
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  <select id="ans' . $i . '" name="ans' . $i . '" placeholder="Escoja la respuesta correcta " class="form-control" >
     <option value="a">Escoja la respuesta para la pregunta ' . $i . '</option>
    <option value="a">Opción a</option>
    <option value="b">Opción b</option>
    <option value="c">Opción c</option>
    <option value="d">Opción d</option>
  </select><br />
</div>
</div>
<br />';
    }

    echo '<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""></label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Terminar" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';

}
?>
<!--add quiz step 2 end-->

<!--remove quiz-->
<?php if (@$_GET['q'] == 5) {

    $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
    echo '
<div class="text-right">
  <a href="Pdf/reporte_pruebas.php" class="btn btn-warning" target="_blank">Reporte Pruebas</a>
</div>
<br>
    <div class="table-responsive">
<table class="table table-striped title1">
<tr>
  <td><b>Codigo</b></td>
  <td><b>Tema</b></td>
  <td><b>Número de preguntas</b></td>
  <td><b>Puntaje</b></td>
  <td><b>Tiempo Límite</b></td>
  <td></td>
</tr>';
    $c = 1;
    while ($row = mysqli_fetch_array($result)) {
        $title = $row['title'];
        $total = $row['total'];
        $sahi  = $row['sahi'];
        $time  = $row['time'];
        $eid   = $row['eid'];
        echo '<tr><td>' . $c++ . '</td><td>' . $title . '</td><td>' . $total . '</td><td>' . $sahi * $total . '</td><td>' . $time . '&nbsp;min</td>
  <td><b><a href="update.php?q=rmquiz&eid=' . $eid . '" class="pull-right btn sub1" style="margin:0px;background:red">
  <font color="white"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<b>Eliminar</b></font></a></b>
  </td>
</tr>';
    }
    $c = 0;
    echo '</table></div>';

}
?>
      <?php include_once "footer.php" ?>
