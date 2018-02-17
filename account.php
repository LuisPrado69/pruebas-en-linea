
<?php
session_start();
if ((!isset($_SESSION["nombre"]))) {
    header("Location: sesion.php");
}
include_once 'conn.php';
$email = $_SESSION['correo'];

if (@$_GET['w']) {echo '<script>alert("' . @$_GET['w'] . '");</script>';}
?>
<?php include_once "menu.php" ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content">
        <div>
          <p class="text-right text-capitalize">bienvenido: <strong><?php echo $_SESSION['nombre']; ?></strong></p>
        </div>
      <h2 id="otro" align="center"><font color="#36A4C4">Pruebas</font></h2>

 <?php
include_once 'conn.php';
require 'encriptar.php';

if (!(isset($_SESSION['correo']))) {
    header("location:index.php");

} else {
    $name  = $_SESSION['nombre'];
    $email = $_SESSION['correo'];

    include_once 'conn.php';

}?>
<!--home start-->
<?php if (@$_GET['q'] == 1) {

    $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
    echo '
<div class="table-responsive">
<table class="table table-striped title1" style="text-align: center">
  <tr style="color:#000000">
    <td><b>Codigo</b></td>
    <td><b>Tema</b></td>
    <td><b>Numero Preguntas</b></td>
    <td><b>Puntaje</b></td>
    <td><b>Tiempo Limite</b></td>
    <td colspan="2"><b>Opciones</td>
  </tr>';
    $c = 1;
    while ($row = mysqli_fetch_array($result)) {
        $title = $row['title'];
        $total = $row['total'];
        $sahi  = $row['sahi'];
        $time  = $row['time'];
        $eid   = $row['eid'];

        $sql      = ("SELECT score FROM history WHERE eid='$eid' AND email='$email'");
        $q12      = mysqli_query($con, $sql) or die('Error98');
        $rowcount = mysqli_num_rows($q12);
        while ($row = mysqli_fetch_array($q12)) {
            $sco = $row['score'];
        }
        if ($rowcount == "") {
            echo '
  <tr>
    <td>' . $c++ . '</td>
    <td>' . $title . '</td>
    <td>' . $total . '</td>
    <td>' . $sahi * $total . '</td>
    <td>' . $time . '&nbsp;min</td>
    <td>
    <b><a href="account.php?q=quiz&step=2&eid=' . $eid . '&n=1&t=' . $total . '" class="pull-center btn sub1" style="margin:0px;background:#99cc32">
    <font color="white"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;
    <b>Iniciar</b></font></a></b>
    </td>
  </tr>';
        } else {
            echo '
  <tr style="color:#99cc32">
    <td>' . $c++ . '</td>
    <td>' . $title . '&nbsp;<span title="Esta Prueba ya ha sido resulta por ti" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
    <td>' . $total . '</td>
    <td>' . $sco . '/' . $sahi * $total . '</td>
    <td>' . $time . '&nbsp;min</td>
    <td>
     <b><a href="update.php?q=quizre&step=25&eid=' . $eid . '&n=1&t=' . $total . '" class="pull-center btn sub1" style="margin:0px;background:red">
     <font color="white">
     <b>Reintentar&nbsp;</b>
     <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>
     </font></a></b>
    </td>

  ';

            $tot = $sahi * $total;
            $tu  = ($sco / $tot * 100);
            if ($tu > 59) {
                $id_usu = $_SESSION['correo'];
                echo '
    <td>
      <a href="Pdf/diploma.php?id=' .$id_usu . '&pr=' .$eid. '" target="_blank" class="btn btn-primary"><b>Diploma</a>
    </td>';
            }
        }
    }
    $c = 0;
    echo '</tr>
  </table>
</div>';

}
?>
<!-- <span id="countdown" class="timer"></span>
<script>
var seconds = 40;
    function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds;
    }
    document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = "Buzz Buzz";
    } else {
        seconds--;
    }
    }
var countdownTimer = setInterval('secondPassed()', 1000);
</script> -->

<!--home closed-->

<!--quiz start-->
<?php
if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
    $eid   = @$_GET['eid'];
    $sn    = @$_GET['n'];
    $total = @$_GET['t'];
    $q     = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid' AND sn='$sn'");

    echo '<div style="margin:5%">';
    while ($row = mysqli_fetch_array($q)) {
        $qns = $row['qns'];

        $qid = $row['qid'];
        echo '<b>Pregunta &nbsp;' . $sn . '&nbsp;::&nbsp;&nbsp;' . $qns . '</b><br />';
    }
    $q = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid' order by rand()");
    echo '<form action="update.php?q=quiz&step=2&eid=' . $eid . '&n=' . $sn . '&t=' . $total . '&qid=' . $qid . '" method="POST"  class="form-horizontal">

<br />';


    while ($row = mysqli_fetch_array($q)) {
        $option   = $row['option'];
        $optionid = $row['optionid'];
        echo '
<table >
  <tr>
    <td style="width:60%">
      <input type="radio" name="ans" required value="' . $optionid . '">' . $option . '
    </td>
    ';

    }

    //AYUDA
    $q2 = mysqli_query($con, "SELECT * FROM ayuda WHERE qid='$qid'");
    while ($row = mysqli_fetch_array($q2)) {
        $ayuda = $row['ayuda'];
    }
    echo '
    <td style="width:40%">
      <label>Ayuda&nbsp;::&nbsp;&nbsp;' . $ayuda . '<br />
    </td>
  </tr>
</table>';

    echo '<br />
<button type="submit" class="btn btn-primary">
Siguiente&nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
</button>
</form>
</div>';
//header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}
//result display
if (@$_GET['q'] == 'result' && @$_GET['eid']) {
    $eid = @$_GET['eid'];
    $q   = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND email='$email' ") or die('Error157');
    echo '<div class="table-responsive">
<div class="panel">
  <center>
    <h1 class="title" style="color:#660033">Resultado de la Prueba</h1>
  <center>
<table class="table table-striped title1" style="font-size:20px;font-weight:1000;" >';

    while ($row = mysqli_fetch_array($q)) {
        $s  = $row['score'];
        $w  = $row['wrong'];
        $r  = $row['sahi'];
        $qa = $row['level'];
        echo '
<tr style="color:#66CCFF">
  <td>Total Pregutas</td>
  <td>' . $qa . '</td>
</tr>
<tr style="color:#99cc32">
  <td>Preguntas Correctas&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td>
  <td>' . $r . '</td>
</tr>
<tr style="color:red">
  <td>Preguntas Erroneas&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td>
  <td>' . $w . '</td>
</tr>
<tr style="color:#66CCFF">
  <td>Puntaje&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td>
  <td>' . $s . '</td>
</tr>
</table>
</div></div>
<br>
  <center>
    <h1 class="title" style="color:#660033">Respuestas Correctas</h1>';
    }
    // registrar intentos
// 
// 
  $result = mysqli_query($con,"SELECT * FROM intentos WHERE correo='$email' and eid ='$eid'" )or die('Error161');
  $rowcount=mysqli_num_rows($result);

  while($row = mysqli_fetch_array($result)) 
  {
    $num = $row['numero'];
  }
  if ($rowcount ==0) 
  {
    $q3=mysqli_query($con,"INSERT INTO `intentos` VALUES ('$eid','$email',1)" )or die('Error184');
  }
  else 
  {
    $q2=mysqli_query($con,"UPDATE `intentos` SET `numero`='$num'+1 WHERE correo= '$email' and eid ='$eid' ")or die('Error174');
    /*$q2=mysqli_query($con,"INSERT INTO rank VALUES('$email','$s',NOW())")or die('Error165');*/
  }
    $q = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid' ") or die('Error157');
    while ($row = mysqli_fetch_array($q)) {
        $s = $row['qid'];

        $q1 = mysqli_query($con, "SELECT q.qns, o.option FROM questions q, options o, answer a WHERE q.qid=o.qid and q.qid=a.qid and o.optionid=a.ansid and q.qid='$s' ") or die('Error157');
        while ($row = mysqli_fetch_array($q1)) {
            $s1 = $row['qns'];
            $p1 = $row['option'];
            echo '


  <div class="table-responsive">
    <table class="table table-condensed" style="width:80%" style="text-align: center">
      <tr class="success">
        <td style="width:10%; color:#FF0000;"><span class="glyphicon glyphicon-bell">Pregunta&nbsp;:</span> </td>
        <td style="width:90%; color:#466EC8;"><span class="glyphicon glyphicon-send">&nbsp;' . $s1 . '</span></td>
      </tr>
      <tr>
        <td style="width:10%; color:#3EAF41;"><span class="glyphicon glyphicon-eye-open">Solucion&nbsp;:</span></td>
        <td style="width:90%; color:#3D9491;"><span class="glyphicon glyphicon-forward">&nbsp;' . $p1 . '</span></td>
      </tr>
    </table>
  </div>';
        }}
}
?>
<!--quiz end-->
<?php
//history start
if (@$_GET['q'] == 2) {
    $q = mysqli_query($con, "SELECT * FROM history WHERE email='$email' ORDER BY date DESC ") or die('Error197');
    echo '<div class="table-responsive">
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

//ranking start
if (@$_GET['q'] == 3) {
    $q = mysqli_query($con, "SELECT * FROM rank  ORDER BY score DESC ") or die('Error223');
    echo '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red">
  <td><b>Puesto</b></td>
  <td><b>Nombre</b></td>
  <td><b>Correo</b></td>
  <td><b>Genero</b></td>
  <td><b>Institución</b></td>
  <td><b>Puntaje</b></td>
</tr>';
    $c = 0;
    while ($row = mysqli_fetch_array($q)) {
        $e   = $row['email'];
        $s   = $row['score'];
        $q12 = mysqli_query($con, "SELECT * FROM usuarios WHERE correo='$e' ") or die('Error231');
        while ($row = mysqli_fetch_array($q12)) {
            $name    = $row['nombre'];
            $email   = $row['correo'];
            $gender  = $row['celular'];
            $college = $row['empresa'];
        }
        $c++;
        echo '<tr><td style="color:#99cc32"><b>' . $c . '</b></td><td>' . $name . '</td><td>' . $email . '</td><td>' . $gender . '</td><td>' . $college . '</td><td>' . $s . '</td><td>';
    }
    echo '</table></div>';}
?>
      <?php include_once "footer.php" ?>

