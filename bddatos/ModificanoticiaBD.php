<?php
//validación de sesión
session_start();
include_once '../conn.php';

$id           	= $_POST["id"];
$descripccion 	= $_POST["descripccion"];
$titulo 		= $_POST["titulo"];
$estado       	= $_POST["estado"];
$rSQLequipov  	= mysql_query("SELECT * FROM noticia WHERE descripccion = '$descripccion' AND estado = '$estado' AND titulo = '$titulo'");

if (mysql_num_rows($rSQLequipov) > 0) 
{
    $_SESSION["alerta"] = "La Noticia " . $descripccion . " ya esta registrada";
}
else if (mysql_query("UPDATE noticia SET descripccion=UPPER('$descripccion'), estado='$estado', titulo=UPPER('$titulo') WHERE id=$id")) 
{
    $_SESSION["alerta"] = "Noticia modificado exitosamente.";
    header('Location:../rnoticia.php');
    exit();
} 
else 
{
    $_SESSION["alerta"] = "Ocurrió un error modificando el arbitro.";
}
header('Location:../rnoticia.php?id=' . $id);
?>