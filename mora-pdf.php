<?php
	require('func/funciones.php');
	require('fpdf/fpdf.php');
	require('fpdf/plantilla.php');	

	$conectar = new Conexion();
	$conectando = $conectar->Conectar();

	$sesion = new Sesion();
	$activa = $sesion->onSesion();
	$mensaje = null;

	$query = $conectando->prepare('SELECT clientes.nombres AS "NOM", clientes.apellidos AS "APE",
										        autos.marca AS "MAR", autos.modelo AS "MOD", autos.year AS "ANO", autos.placa AS "MAT",
											    DATE_FORMAT(rentas.dateo,"%d-%m-%Y") AS "FS", DATE_FORMAT(rentas.realinndate,"%d-%m-%Y") AS "FE", 
											    rentas.delay AS "DEL", rentas.mora AS "MOR", rentas.totalcmora AS "TCM", rentas.totaldelay AS "TG"
										 FROM rentas
										 INNER JOIN clientes ON rentas.clientid = clientes.id
										 INNER JOIN autos ON rentas.autoid = autos.id
										 WHERE delay > 0
										 ORDER BY dateo DESC');
	$query->execute();

	$pdf = new PDFH('L', 'mm', 'Letter');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetY(30);
	$pdf->SetX(75);
	$pdf->Cell(130,6,'Registro De Moras', 0,0,'C');

	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFillColor(255,250,238);
	$pdf->SetTextColor(0,136,124);
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetX(20);
	$pdf->Cell(10,12,utf8_decode('N°'), 1,0,'C',1);
	$pdf->SetX(30);
	$pdf->Cell(60,12,utf8_decode('Auto'), 1,0,'C',1);
	$pdf->SetX(90);
	$pdf->Cell(60,12,utf8_decode('Cliente'), 1,0,'C',1);
	$pdf->SetX(150);
	$pdf->Cell(110,6,utf8_decode('Detalles'), 1,0,'C',1);
	
	$pdf->SetY(48);
	$pdf->SetX(150);
	$pdf->Cell(20,6,utf8_decode('Alq.'), 1,0,'C',1);
	$pdf->SetX(170);
	$pdf->Cell(20,6,utf8_decode('Dev.'), 1,0,'C',1);
	$pdf->SetX(190);
	$pdf->Cell(10,6,utf8_decode('Ret.'), 1,0,'C',1);
	$pdf->SetX(200);
	$pdf->Cell(20,6,utf8_decode('Monto'), 1,0,'C',1);
	$pdf->SetX(220);
	$pdf->Cell(20,6,utf8_decode('Mora'), 1,0,'C',1);
	$pdf->SetX(240);
	$pdf->Cell(20,6,'Total', 1,1,'C',1);

	$conta = 1;
	
	while ($q = $query->fetch()) {
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetTextColor(0,0,0);

		$pdf->SetX(20);
		$pdf->Cell(10,6,$conta++, 1,0,'C',1);
		$pdf->SetX(30);
		$pdf->Cell(60,6,utf8_decode($q['MAR'] ." ".$q['MOD'] ." ".$q['ANO']), 1,0,'L');
		$pdf->SetX(90);
		$pdf->Cell(60,6,utf8_decode($q['NOM'] ." ".$q['APE']), 1,0,'L');
		$pdf->SetX(150);
		$pdf->Cell(20,6,utf8_decode($q['FS']), 1,0,'C');
		$pdf->SetX(170);
		$pdf->Cell(20,6,utf8_decode($q['FE']), 1,0,'C');
		$pdf->SetX(190);
		$pdf->Cell(10,6,utf8_decode($q['DEL']." D."), 1,0,'C');
		$pdf->SetX(200);
		$pdf->Cell(20,6,'$ '.$q['TCM'], 1,0,'R');
		$pdf->SetX(220);
		$pdf->Cell(20,6,'$ '.$q['MOR'], 1,0,'R');
		$pdf->SetX(240);
		$pdf->Cell(20,6,'$ '.$q['TG'], 1,1,'R');
	}


	$pdf->Output();
?>