<?php
include_once "../conn.php";
session_start();
$user = $_POST["txt_usuario"];
$pass = md5($_POST["txt_contrasena"]);

$rSQLsesion = mysql_query("SELECT * FROM usuarios WHERE BINARY usuario  = '$user' and password = '$pass' and estado='1'");
if (mysql_num_rows($rSQLsesion) > 0) 
{
    while ($filasesion = mysql_fetch_array($rSQLsesion)) 
    {
        $_SESSION['nombre']     = $filasesion["nombre"];
        $_SESSION['usuario']    = $filasesion["usuario"];
        $_SESSION['id']         = $filasesion["id"];
        $_SESSION['equipo']     = $filasesion["equipo"];
        $_SESSION['privilegio'] = $filasesion["privilegio"];
        $_SESSION['fecha']      = $filasesion["fecha"];
        $_SESSION['correo']     = $filasesion["correo"];

    }
    if ($_SESSION["privilegio"] == 2) 
    {
        header("Location: ../rusuarion_indv.php");
    } 
    else 
    {
        header("Location: ../rusuarios.php");
    }
} 
else 
{
    $_SESSION["alerta"] = "
    <div class='alert alert-warning alert-dismissable'>
        <i class='fa fa-check'></i>
        <b>Alerta </b>Usuario o contraseña erronea... 
    </div>";
    header("Location: ../sesion.php");
    return;
}
?>
