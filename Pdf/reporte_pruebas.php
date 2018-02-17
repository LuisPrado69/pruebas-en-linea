<?php
	include 'plantilla.php';
	require 'conexion.php';
	
	$query = "
SELECT 
z.eid , z.title , z.total ,
q.qid , q.qns,
o.option,
ay.ayuda
FROM quiz z, questions q, answer a, options o, ayuda ay
WHERE z.eid=q.eid and a.ansid=o.optionid and q.qid =o.qid and q.qid=ay.qid";
	$resultado = $mysqli->query($query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	//texto

	$pdf->MultiCell(190,6,'Reporte Pruebas',0,'C');
	$pdf->MultiCell(190,6,'',0,'C');
	$pdf->MultiCell(190,6,'',0,'C');
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(30,6,'Prueba',			1,0,'C',1);
	$pdf->Cell(5,6,'#',				1,0,'C',1);
	$pdf->Cell(50,6,'Pregunta',			1,0,'C',1);
	$pdf->Cell(50,6,'Respuesta',		1,0,'C',1);
	$pdf->Cell(60,6,'Ayuda',			1,1,'C',1);

	

	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(30,6,$row['title'],					1,0,'C');
		$pdf->Cell(5,6,$row['eid'],						1,0,'C');
		$pdf->Cell(50,6,$row['qns'],					1,0,'C');
		$pdf->Cell(50,6,$row['option'],					1,0,'C');
		$pdf->Cell(60,6,$row['ayuda'],					1,1,'C');

	}
	$pdf->Output();
?>