<?php
//validación de sesión
session_start();
include_once '../conn.php';

$id     = $_POST["id"];
$option = $_POST["option"];

$rSQLequipov = mysql_query("SELECT * FROM options WHERE option = '$option' AND optionid = '$id' ");
if (mysql_num_rows($rSQLequipov) > 0) {
    $_SESSION["alerta"] = "No se realizo ningun cambio";
    header('Location:' . getenv('HTTP_REFERER'));
    exit();
} else if (mysql_query("UPDATE options SET option='$option' WHERE optionid= '$id'")) {

    $_SESSION["alerta"] = "Pregunta modificada exitosamente.";
    header('Location:' . getenv('HTTP_REFERER'));
    exit();
} else {
    $_SESSION["alerta"] = "Ocurrió un error modificando al usuario.";
}

header('Location:' . getenv('HTTP_REFERER'));
?>