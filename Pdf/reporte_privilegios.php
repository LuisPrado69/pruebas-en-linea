
<?php
	include 'plantilla.php';
	require 'conexion.php';
	
	$query = "SELECT `ID`,`DES_MENU`,`EST_MENU` from `menu` where `EST_MENU` = 1 order by DES_MENU asc";
	$resultado = $mysqli->query($query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	//texto

	$pdf->MultiCell(190,6,'Reporte de Privilegios',0,'C');
	$pdf->MultiCell(190,6,'',0,'C');
	$pdf->MultiCell(190,6,'',0,'C');
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(90,6,'ID',		1,0,'C',1);
	$pdf->Cell(100,6,'Nombre',	1,1,'C',1);

	

	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(90,6,utf8_decode($row['ID']),		1,0,'C');
		$pdf->Cell(100,6,$row['DES_MENU'],				1,1,'C');

	}
	$pdf->Output();
?>