<?php
	class PDF extends FPDF{

		function Header(){
			#LOGO
			$this->Image('img/profile.jpg', 20,10,33);
			#ESTABLECER FUENTE
			$this->SetFont('Arial', 'b', '16');
			#MOVERSE A LA DERECHA
			$this->Cell(75);
			#TITULO
			$this->Cell(30, 10, 'Rentacar M&M',0,0,'c');
			#SALTO DE LINEA
			$this->Ln(20);
		}

		function Footer(){
			#UBICACION A 1.5CM DEL FINAL DE LA PAG
			$this->SetY(-15);
			#ARIAL ITALIC 8
			$this->SetFont('Arial', 'I', '8');
			#NUMERO DE LA PAG
			$this->Cell(0, 10, 'Pag. '.$this->PageNo().' / {nb}',0,0,'R');
		}
	}


	class PDFH extends FPDF{

		function Header(){
			#LOGO
			$this->Image('img/profile.jpg', 20,10,33);
			#ESTABLECER FUENTE
			$this->SetFont('Arial', 'b', '16');
			#MOVERSE A LA DERECHA
			$this->Cell(110);
			#TITULO
			$this->Cell(30, 10, 'Rentacar M&M',0,0,'c');
			#SALTO DE LINEA
			$this->Ln(20);
		}

		function Footer(){
			#UBICACION A 1.5CM DEL FINAL DE LA PAG
			$this->SetY(-15);
			#ARIAL ITALIC 8
			$this->SetFont('Arial', 'I', '8');
			#NUMERO DE LA PAG
			$this->Cell(0, 10, 'Pag. '.$this->PageNo().' / {nb}',0,0,'R');
		}
	}

	# CREANDO UN OBJETO DE LA CLASE HEREDADA
	/*$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times', '', 11);

	for ($i=1; $i<=40; $i++)
		$pdf->Cell(0,10, utf8_decode('Imprimiendo Línea Número '). $i, 0,1);
		$pdf->Output();*/
?>