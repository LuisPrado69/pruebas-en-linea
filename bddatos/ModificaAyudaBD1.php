<?php
//validación de sesión
session_start();
include_once '../conn.php';

$id    = $_POST["id"];
$ayuda = $_POST["ayuda"];

$rSQLequipov = mysql_query("SELECT * FROM ayuda WHERE ayuda = '$ayuda' AND qid = '$id' ");
if (mysql_num_rows($rSQLequipov) > 0) {
    $_SESSION["alerta"] = "No se realizo ningun cambio";
    header('Location:' . getenv('HTTP_REFERER'));
    exit();
} else if (mysql_query("UPDATE ayuda SET ayuda=UPPER('$ayuda') WHERE qid= '$id'")) {

    $_SESSION["alerta"] = "Ayuda modificada exitosamente.";
    header('Location:' . getenv('HTTP_REFERER'));
    exit();
} else {
    $_SESSION["alerta"] = "Ocurrió un error modificando al usuario.";
}

header('Location:' . getenv('HTTP_REFERER'));
?>