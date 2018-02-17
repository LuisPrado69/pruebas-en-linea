<?php
require 'DiplomPdf.php';
require 'conexion.php';
$codigo  = $_GET['id'];
$codigod = $codigo;
$prueba  = $_GET['pr'];
$pruebad = $prueba;
$query = "
	SELECT q.intro,h.email,u.nombre FROM quiz q, history h,usuarios u WHERE q.eid=h.eid and h.email='$codigod' and q.eid='$pruebad' and h.email=u.correo";
$resultado = $mysqli->query($query);
$institucion      = ['Martinez Chávez y Asociados Cía. Ltda.', 'Auditores y Asesores Contables'];
$etiquetasPersona = ['Confiere el presente certificado a:'];
$certificacion          = ['Taller de Contabilida Básica'];
$etiquetasCertificacion = ['Por su participacion en el curso', 'finalizado el 28 de julio de'];
$autoridad              = ['Edgar Pérez', 'Socio Fundador','Rocío Martinéz Chávez', 'Socio de Outsourcing','Diego Boada Gallardo', 'Socio de Auditoría'];
$etiquetaAutoridad      = ['En constancia firman:', ''];
$diplomPdf = new DiplomaPdf('L', 'mm', 'A4');

while ($row = $resultado->fetch_assoc()) {
    $taller = [$row['intro']];
    $nombre = [$row['nombre']];
    $diplomPdf->renderLogo('images/logo.png', 130, 25, 40);
    $diplomPdf->renderInstitucion($institucion);
    $diplomPdf->renderCampo($nombre, $etiquetasPersona);
    $diplomPdf->renderCampo($taller, $etiquetasCertificacion);
    $diplomPdf->renderAutoridad($autoridad, $etiquetaAutoridad);
    $diplomPdf->Cell(200, 0, date('d/m/Y'), 0, 1, 'R');
    $diplomPdf->Output();
}
?>
<!-- ?cod=1&cod1=gay -->