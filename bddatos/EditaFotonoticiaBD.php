<?php
//validación de sesión
session_start();
include_once '../conn.php';

$id = $_POST["id"];

if ($_FILES['foto']['type'] == 'image/jpeg' || $_FILES['foto']['type'] == 'image/png' || $_FILES['foto']['type'] == 'image/jpg') {
    $imagen = $_FILES['foto']['name'];
    $ruta   = "../noticiaimagenes/" . $imagen;

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta)) {
        if (mysql_query("UPDATE noticia SET imagen = '$imagen' WHERE id = $id")) {
            $_SESSION["alerta"] = "Imagen actualizada";
        } else {
            $_SESSION["alerta"] = "Error al actualizar la imagen";
        }
    } else {
        $_SESSION["alerta"] = "Error al subir la imagen";
    }

} else {
    $_SESSION["alerta"] = "Solo puedes subir archivos en formato JPG, JPEG o PNG";
}

header('Location:../rnoticia.php?id=' . $id);
?>