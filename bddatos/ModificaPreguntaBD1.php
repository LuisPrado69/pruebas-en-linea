<?php
//validación de sesión
session_start();
include_once '../conn.php';

$id  = $_POST["id"];
$qns = $_POST["qns"];

$rSQLequipov = mysql_query("SELECT * FROM questions WHERE qns = '$qns' AND qid = '$id' ");
if (mysql_num_rows($rSQLequipov) > 0) {
    $_SESSION["alerta"] = "No se realizo ningun cambio";
    header('Location:' . getenv('HTTP_REFERER'));
    exit();
} else if (mysql_query("UPDATE questions SET qns='$qns' WHERE qid= '$id'")) {

    $_SESSION["alerta"] = "Pregunta modificada exitosamente.";
    header('Location:' . getenv('HTTP_REFERER'));
    exit();
} else {
    $_SESSION["alerta"] = "Ocurrió un error modificando al usuario.";
}

header('Location:' . getenv('HTTP_REFERER'));
?>

