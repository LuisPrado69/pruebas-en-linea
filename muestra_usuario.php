<?php
session_start();
if ((!isset($_SESSION["nombre"]) && !isset($_SESSION["privilegio"])) or ($_SESSION["privilegio"] == 2)) {
    header("Location: sesion.php");
}
include_once 'conn.php';
if (!isset($_GET["id"])) {
    header("Location: rusuarios.php");
} else {
    $id = $_GET['id'];
}

$eamq = mysql_query("select * from usuarios where id=$id");

if (mysql_num_rows($eamq) > 0) {
    $eamf = mysql_fetch_assoc($eamq);
} else {
    header("Location: rusuarios.php");
}
include_once "menu.php" 
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
            <h2 id="otro" align="center"><font color="#36A4C4">Muestra Usuario</font></h2>
                <hr>
                  <div class="col-md-6 col-md-offset-3">
                    <div class="thumbnail">
                      <h2 class="text-center text-capitalize">

                      Nombre:&nbsp;&nbsp;<?php echo $eamf["nombre"] ?></h2>
                      <br>
                      <div class="caption">

                        <p class="text-center text-capitalize">
                           Empresa:&nbsp;&nbsp;<?php echo $eamf["empresa"] ?>
                        </p>
                        <p class="text-center text-capitalize">
                            Cargo:&nbsp;&nbsp;<?php echo get_campo('descripccion', 'cargos', 'id', $eamf['cargo']); ?>
                        </p>
                        <p class="text-center text-capitalize">
                           Celular:&nbsp;&nbsp;<?php echo $eamf["celular"] ?>
                        </p>
                        <p class="text-center text-capitalize">
                           Telefono:&nbsp;&nbsp;<?php echo $eamf["telefono"] ?>
                        </p>
                        <p class="text-center text-capitalize">
                           Correo:&nbsp;&nbsp;<?php echo $eamf["correo"] ?>
                        </p>
                        <p class="text-center text-capitalize">
                           Empresa:&nbsp;&nbsp;<?php echo $eamf["empresa"] ?>
                        </p>

                        <p class="text-center text-capitalize">
                            Privilegio:&nbsp;&nbsp;<?php echo get_campo('descripccion', 'roles', 'id', $eamf['privilegio']); ?>
                        </p>
                      </div>
                    </div>
                    <center>
                        <a href="rusuarios.php" class="btn btn-danger">Volver</a>
                    </center>
                  </div>
                
                
        <?php include_once "footer.php" ?>

