<script>
window.onload = function(){killerSession();}
function killerSession()
{
  setTimeout("window.open('librerias/csesion.php','_top');",300000);
}
</script>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MACH | Pruebas</title>
  <!-- Logo Imagen -->

  <link rel="shortcut icon" href="images/icno.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
  <link type="text/css" href="css/jquery.dataTables_themeroller.css" rel="stylesheet"/>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini" onload="mueveReloj()">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>MACH </b>Pruebas</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-gears"></i><img src="images/user.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="images/user.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['nombre']; ?>
                  <small><img src="images/LOGO1.png" alt="User Image"></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="rusuarion_indv.php" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="librerias/csesion.php" class="btn btn-default btn-flat">Cerrar Sesion</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
<script language="JavaScript"> 
                function mueveReloj(){ 
                    momentoActual = new Date() 
                    hora = momentoActual.getHours() 
                    minuto = momentoActual.getMinutes() 
                    segundo = momentoActual.getSeconds() 

                    horaImprimible = hora + " : " + minuto + " : " + segundo 

                    document.form_reloj.reloj.value = horaImprimible 

                    setTimeout("mueveReloj()",1000) 
                } 
                </script>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel -->
      <div class="user-panel">
        <center>
          <img src="images/logo.png" class="img-circle" width="120px" height="auto">
        </center>
                <form name="form_reloj"> 
                <!-- <div class="form-group text-center"> -->
                <!-- <div class="col-xs-2"> -->
<!--                     <div class="input-group text-center" style="margin:auto;"> -->
                        <input style="background: #222d32; text-align: center; color: #FFFFFF " disabled class="form-control" type="text" name="reloj">
<!--                     </div> -->
<!--                 </div> -->
                </form>
        <div class="pull-left image">
          <img src="images/user.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nombre']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">Menu Navegacion</li>
<?php
  if ($_SESSION["privilegio"] == 1) 
    {?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-powerpoint-o"></i> <span>Pruebas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="dash.php?q=1"><i class="fa fa-address-book"></i> Inicio</a></li>
            <li><a href="dash.php?q=2"><i class="fa fa-user-o"></i>Mi Historial</a></li>
            <li><a href="dash.php?q=3"><i class="fa fa-users"></i> Historial Usuarios</a></li>
            <li><a href="dash.php?q=4"><i class="fa fa-sticky-note"></i>Agregar Prueba</a></li>
            <li><a href="dash.php?q=5"><i class="fa fa-sticky-note-o"></i> Mostrar Prueba</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Subir Pruebas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="SubPruebas.php"><i class="fa fa-book"></i> Pruebas</a></li>
            <li><a href="SubPreguntas.php"><i class="fa fa-circle-o-notch"></i>Preguntas</a></li>
            <li><a href="SubOpciones.php"><i class="fa fa-check-square"></i> Opciones</a></li>
            <li><a href="SubRespuestas.php"><i class="fa fa-check-square-o"></i>Respuestas</a></li>
            <li><a href="SubAyudas.php"><i class="fa fa-bullseye"></i> Ayudas</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-sticky-note-o"></i> <span>Mantenimientos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="rcargos.php"><i class="fa fa-child"></i> Cargos</a></li>
          </ul>
        </li>
        <li>
          <a href="rusuarios.php">
            <i class="fa fa-street-view"></i> <span>Usuarios</span>            
          </a>
        </li>
        <?php }
  ?>
  <?php
  if ($_SESSION["privilegio"] == 2) 
    {?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-powerpoint-o"></i> <span>Pruebas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="account.php?q=1"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
            <li><a href="account.php?q=2"><i class="fa fa-drivers-license-o"></i>Mi Historial</a></li>
          </ul>
        </li>
        <li>
          <a href="rusuarion_indv.php">
            <i class="fa fa-user-circle"></i> <span>Perfil</span>            
          </a>
        </li>
        <?php }
  ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


