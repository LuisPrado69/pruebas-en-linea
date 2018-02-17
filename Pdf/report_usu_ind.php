<?php
	include 'plantilla.php';
	require 'conexion.php';
	$codigo  = $_GET['id'];
	$query = "
SELECT 
h.eid, h.score , h.level , h.sahi, h.wrong, 
u.nombre,u.correo,u.id, 
q.title,
i.numero
FROM 
history h , usuarios u , quiz q , intentos i
WHERE 
q.eid=h.eid and h.email=u.correo and u.correo=i.correo and i.eid=q.eid and u.id=$codigo
	";
	$resultado = $mysqli->query($query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	//texto

	$pdf->MultiCell(190,6,'Reporte Historial Pruebas',0,'C');
	$pdf->MultiCell(190,6,'',0,'C');
	$pdf->MultiCell(190,6,'',0,'C');
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(40,6,'Prueba',		1,0,'C',1);
	$pdf->Cell(40,6,'Usuario',		1,0,'C',1);
	$pdf->Cell(20,6,'Contesto',	1,0,'C',1);
	$pdf->Cell(25,6,'Correctas',	1,0,'C',1);
	$pdf->Cell(25,6,'Erroneas',		1,0,'C',1);
	$pdf->Cell(20,6,'Intento',		1,0,'C',1);
	$pdf->Cell(20,6,'Puntaje',		1,1,'C',1);

	

	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(40,6,$row['title'],					1,0,'C');
		$pdf->Cell(40,6,$row['nombre'],					1,0,'C');
		$pdf->Cell(20,6,$row['level'],					1,0,'C');
		$pdf->Cell(25,6,$row['sahi'],					1,0,'C');
		$pdf->Cell(25,6,$row['wrong'],					1,0,'C');
		$pdf->Cell(20,6,$row['numero'],					1,0,'C');
		$pdf->Cell(20,6,$row['score'],					1,1,'C');

	}
	$pdf->Output();
?>