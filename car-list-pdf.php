<?php
	include_once('func/funciones.php');
	include_once('fpdf/fpdf.php');
	include_once('fpdf/plantilla.php');

	$conectar = new Conexion();
	$conectando = $conectar->Conectar();

	$sesion = new Sesion();
	$activa = $sesion->onSesion();
	$mensaje = null;

	$sql = $conectando->prepare("SELECT * FROM autos ORDER BY marca ASC");
	$sql->execute();

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetY(30);
	$pdf->SetX(75);
	$pdf->Cell(60,6,'Lista De Autos', 0,0,'C');

	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFillColor(255,250,238);
	$pdf->SetTextColor(0,136,124);
	$pdf->SetFont('Courier', 'B', 12);
	$pdf->SetX(20);
	$pdf->Cell(10,6,utf8_decode('N°'),1,0,'C',1);
	$pdf->SetX(30);
	$pdf->Cell(30,6,'Marca',1,0,'C',1);
	$pdf->SetX(60);
	$pdf->Cell(20, 6, 'Modelo', 1, 0, 'C', 1);
	$pdf->SetX(80);
	$pdf->Cell(15, 6, utf8_decode('Año'), 1, 0, 'C', 1);
	$pdf->SetX(95);
	$pdf->Cell(20, 6, utf8_decode('Color'), 1, 0, 'C', 1);
	$pdf->SetX(115);
	$pdf->Cell(30, 6, utf8_decode('# Matrícula'),1,0,'C',1);
	$pdf->SetX(145);
	$pdf->Cell(30, 6, 'Estado', 1,0,'C',1);
	$pdf->SetX(175);
	$pdf->Cell(20, 6, 'Precio', 1,1,'C',1);

	$num = 1;


	while ($result = $sql->fetch()) {
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetTextColor(0,0,0);

		$disp = $result['disponible'];

		switch ($disp) {
			case 0:
				$disp = 'Alquilado';
				break;

			case 1:
				$disp = 'Disponible';
				break;

			case 2:
				$disp = 'Mantenimiento';
				break;
		}

		$pdf->SetX(20);
		$pdf->Cell(10,6,$num++, 1,0,'C');
		$pdf->SetX(30);
		$pdf->Cell(30,6,utf8_decode($result['marca']), 1,0,'L');
		$pdf->SetX(60);
		$pdf->Cell(20, 6, utf8_decode($result['modelo']), 1, 0, 'L');
		$pdf->SetX(80);
		$pdf->Cell(15, 6, utf8_decode($result['year']), 1, 0, 'C');
		$pdf->SetX(95);
		$pdf->Cell(20, 6, utf8_decode($result['color']), 1, 0, 'C');
		$pdf->SetX(115);
		$pdf->Cell(30, 6, utf8_decode($result['placa']), 1, 0, 'C');
		$pdf->SetX(145);
		$pdf->Cell(30,6, $disp , 1,0,'C');
		$pdf->SetX(175);
		$pdf->Cell(20,6,"$ ". $result['usd'] , 1,1,'R');
	}

	$pdf->Output();
?>