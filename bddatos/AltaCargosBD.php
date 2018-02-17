<?php
//validación de sesión
session_start();
include_once '../conn.php';

$fechaMovimiento = date("Y-m-d");
$horaMovimiento  = date("H:i:s");

$descripccion = $_POST["descripccion"];
$estado       = $_POST["estado"];
date_default_timezone_set('America/Bogota');
$Fecha = date('Y-m-d H:i');

$rSQLequipov = mysql_query("SELECT descripccion,estado FROM cargos WHERE descripccion = '$descripccion' AND estado = '$estado'");
if (mysql_num_rows($rSQLequipov) > 0) {
    $_SESSION["alerta"] = "El Cargo " . $descripccion . " ya esta registrado";
} else if (mysql_query("INSERT INTO cargos VALUES('',UPPER('$descripccion'),'$estado')")) {

    $_SESSION["alerta"] = "Cargo Registrado";
    header('Location: ../rcargos.php');
    exit();
} else {
    $_SESSION["alerta"] = "Error al registar los datos";
}

header('Location:../form_cargos.php');
?>