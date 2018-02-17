<?php
	require 'fpdf/fpdf.php';
	class DiplomaPdf extends FPDF
	{
		public $verBordes=0;
		public function __construct($pos, $unit,$type)
		{
			parent::__construct($pos, $unit,$type);
			$this->AddPage();
			$this->SetFont('Arial','B',16);
			$this->Image('images/fond1.png',0,-2,300,210);
		}
		public function renderLogo ($logo,$x,$y,$res='')
		{
			$this->Image($logo,$x,$y,$res);
		}
		public function renderInstitucion ($insti)
		{
			$this->MultiCell(0,40,'',$this->verBordes);
			$this->SetFont('Arial','B',24);
			$this->MultiCell(0,10,utf8_decode($insti[0]),$this->verBordes,'C');
			$this->SetFont('Arial','I',10);
			$this->MultiCell(0,10,utf8_decode($insti[1]),$this->verBordes,'C');
		}
		public function renderCampo ($objetos,$etiquetas)
		{
			$this->MultiCell(0,10,'',$this->verBordes);
			$this->SetFont('Arial','BI',12);
			$this->MultiCell(0,10,utf8_decode($etiquetas[0]),$this->verBordes,'C');
			$this->SetFont('Arial','BI',22);
			$this->MultiCell(0,10,utf8_decode($objetos[0]),$this->verBordes,'C');
		}
		public function renderAutoridad ($objeto,$etiquetas)
		{
			$this->MultiCell(190,6,'',0,'C');
			$this->SetFont('Arial','I',10);
			$this->Cell(30,10);
			$this->Cell(80,10,utf8_decode($etiquetas[0]),$this->verBordes,1);
			$this->MultiCell(190,6,'',0,'C');
			$this->MultiCell(190,6,'',0,'C');
			$this->SetFont('Arial','B',16);
			$this->Cell(30,10);
			$this->Cell(70,10,utf8_decode($objeto[0]),$this->verBordes,0);
			$this->Cell(85,10,utf8_decode($objeto[2]),$this->verBordes,0);
			$this->Cell(80,10,utf8_decode($objeto[4]),$this->verBordes,1);
			$this->SetFont('Arial','I',12);
			$this->Cell(30,10);
			$this->Cell(80,5,utf8_decode($objeto[1]),$this->verBordes,0);
			$this->Cell(85,5,utf8_decode($objeto[3]),$this->verBordes,0);
			$this->Cell(80,5,utf8_decode($objeto[5]),$this->verBordes,1);
			$this->MultiCell(190,9,'',0,'C');
			$this->sangriaAutoridad();
		}

		public function sangriaAutoridad ()
		{
			$this->Cell(50,7,'',$this->verBordes);
		}
	}
?>