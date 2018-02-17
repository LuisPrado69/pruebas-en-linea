
<?php
session_start();
if ((!isset($_SESSION["nombre"]) && !isset($_SESSION["privilegio"])) or ($_SESSION["privilegio"] == 2)) {
    header("Location: sesion.php");
}
include_once 'conn.php';
if (!isset($_GET["id"])) {
    header("Location: restado.php");
} else {
    $id = base64_decode($_GET['id']);
}

$eamq = mysql_query("select * from estados where id=$id");

date_default_timezone_set('America/Bogota');
$fecha = date('Y-m-d H:i');
$sql1  = "INSERT into sentencias values ('','$_SESSION[id]','SELECT * FROM ','ESTADO WHERE ID=','$fecha','$id')";
$st1   = mysql_query($sql1);

if (mysql_num_rows($eamq) > 0) {
    $eamf = mysql_fetch_assoc($eamq);
} else {
    header("Location: restado.php");
}
include_once "menu.php" 
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <h2 id="otro" align="center"><font color="#36A4C4">Muestra Estado</font></h2>
                <hr>
          <div class="row">
                      <div class="col-md-6 col-md-offset-3">
                        <div class="thumbnail">
                          <div class="caption">
                            <h2 class="text-center text-capitalize">
                            Descripcción:&nbsp;&nbsp;<strong><?php echo $eamf["descripccion"] ?></strong></h2>
                          </div>
                        </div>
            <center>
                <a href="restado.php" class="btn btn-danger">Volver</a>
            </center>
                      </div>
                    </div>
          </div>
        </div>
      </div>

        <?php include_once "footer.php"?>

        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
