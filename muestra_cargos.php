
<?php
session_start();
if ((!isset($_SESSION["nombre"]) && !isset($_SESSION["privilegio"])) or ($_SESSION["privilegio"] == 2)) {
    header("Location: sesion.php");
}
include_once 'conn.php';
if (!isset($_GET["id"])) {
    header("Location: rcargos.php");
} else {
    $id = $_GET['id'];
}

$eamq = mysql_query("select * from cargos where id=$id");

if (mysql_num_rows($eamq) > 0) {
    $eamf = mysql_fetch_assoc($eamq);
} else {
    header("Location: rcargos.php");
}
include_once "menu.php" 
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <h2 id="otro" align="center"><font color="#36A4C4">Muestra Cargo</font></h2>
                <hr>
          <div class="row">
                      <div class="col-md-6 col-md-offset-3">
                      <div class="thumbnail">
                            <h2 class="text-center text-capitalize">
                            Descripcción:&nbsp;&nbsp;<strong><?php echo $eamf["descripccion"] ?></strong></h2>
                            <br>
                            <p class="text-center text-capitalize">
                            Estado:&nbsp;&nbsp;<?php echo get_campo("descripccion", "estados", "id", $eamf["estado"]) ?> </p>
                          </div>
                        </div>
                      </div>
            <center>
                <a href="rcargos.php" class="btn btn-danger">Volver</a>
            </center>
        <?php include_once "footer.php" ?>