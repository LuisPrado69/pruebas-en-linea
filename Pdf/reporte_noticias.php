<?php
	include 'plantilla.php';
	require 'conexion.php';
	
	$query = "SELECT r.id as id, r.descripccion as desr,r.titulo as tit, e.descripccion as dese
FROM noticia r , estados e
where r.estado=e.id order by desr asc";
	$resultado = $mysqli->query($query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	//texto

	$pdf->MultiCell(190,6,'Reporte de Noticias',0,'C');
	$pdf->MultiCell(190,6,'',0,'C');
	$pdf->MultiCell(190,6,'',0,'C');
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(10,6,'ID',				1,0,'C',1);
	$pdf->Cell(60,6,'Titulo',			1,0,'C',1);
	$pdf->Cell(60,6,'Descripccion',		1,0,'C',1);
	$pdf->Cell(60,6,'Estado',			1,1,'C',1);
	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(10,6,utf8_decode($row['id']),			1,0,'C');
		$pdf->Cell(60,6,$row['tit'],						1,0,'C');
		$pdf->Cell(60,6,$row['desr'],						1,0,'C');
		$pdf->Cell(60,6,utf8_decode($row['dese']),			1,1,'C');
	}
	$pdf->Output();
?>