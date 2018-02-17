<?php
	
	require 'fpdf/fpdf.php';
	
	class PDF extends FPDF
	{
		function Header()
		{
			$this->Image('images/logo.png', 5, 5, 30 );
			$this->Image('images/LOGO1.png', 150, 10, 55 );
			$this->Image('images/FOOTER.png', 180, 283, 15 );

			$this->SetFont('Arial','B',15);
			$this->Cell(40);
			$this->Cell(110,10, 'Sistema Calificaciones MACH',0,0,'C');
		
			$this->Ln(20);
		}

		public function construct()
		{

			$this->Image('images/fond1.png',0,-2,300,210);
		}
		function Footer(){

        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Sistema de Pruebas MACH LP','T',0,'C');
    }	
	}
?>