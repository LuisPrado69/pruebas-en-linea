<?php
//validación de sesión
session_start();
include_once '../conn.php';

$fechaMovimiento = date("Y-m-d");
$horaMovimiento  = date("H:i:s");

$descripccion = $_POST["descripccion"];
$titulo = $_POST["titulo"];

$rSQLarbitrov = mysql_query("SELECT descripccion FROM noticia WHERE descripccion = '$descripccion' AND titulo = '$titulo' ");
if (mysql_num_rows($rSQLarbitrov) > 0) {
    $_SESSION["alerta"] = "Ya esta registrado la noticia " . $descripccion;
    header("Location: ../form_noticia.php");
    exit();
} else {
    if ($_FILES['foto']['type'] == 'image/jpeg' || $_FILES['foto']['type'] == 'image/png' || $_FILES['foto']['type'] == 'image/jpg') {
        $imagen = $_FILES['foto']['name'];
        $ruta   = "../noticiaimagenes/" . $imagen;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta)) {
            if (mysql_query("INSERT INTO noticia VALUES('',UPPER('$descripccion'), '$imagen', 1,UPPER('$titulo'),)")) {
                $_SESSION["alerta"] = "Noticia Registrado";
                header('Location:../rnoticia.php');
                exit();
            } else {
                $_SESSION["alerta"] = "Error al registar los datos";
            }
        } else {
            $_SESSION["alerta"] = "Error al subir la imagen" . $ruta;
        }
    } else {
        $_SESSION["alerta"] = "Solo puedes subir archivos en formato JPG, JPEG o PNG";
    }
}
header('Location:../form_noticia.php');
?>