<?php
	include 'plantilla.php';
	require 'conexion.php';
	
	$query = "SELECT * from `estados`";
	$resultado = $mysqli->query($query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	//texto

	$pdf->MultiCell(190,6,'Reporte de Estados',0,'C');
	$pdf->MultiCell(190,6,'',0,'C');
	$pdf->MultiCell(190,6,'',0,'C');
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(90,6,'ID',		1,0,'C',1);
	$pdf->Cell(100,6,'Nombre',	1,1,'C',1);

	

	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(90,6,utf8_decode($row['id']),			1,0,'C');
		$pdf->Cell(100,6,$row['descripccion'],				1,1,'C');

	}
	$pdf->Output();
?>