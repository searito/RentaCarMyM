<?php 
	include_once('func/funciones.php');
	include_once('fpdf/fpdf.php');
	include_once('fpdf/plantilla.php');

	$conectar = new Conexion();
	$conectando = $conectar->Conectar();

	$sesion = new Sesion();
	$activa = $sesion->onSesion();
	$mensaje = null;

	$sql = $conectando->prepare("SELECT * FROM clientes ORDER BY apellidos ASC");
	$sql->execute();

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetY(30);
	$pdf->SetX(75);
	$pdf->Cell(60,6,'Listado De Clientes', 0,0,'C');

	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFillColor(255,250,238);
	$pdf->SetTextColor(0,136,124);
	$pdf->SetFont('Courier', 'B', 12);
	$pdf->SetX(20);
	$pdf->Cell(10,6,utf8_decode('N°'),1,0,'C',1);
	$pdf->SetX(30);
	$pdf->Cell(70,6,'Nombre', 1,0,'C',1);
	$pdf->SetX(100);
	$pdf->Cell(30,6,'# DUI', 1,0,'C',1);
	$pdf->SetX(130);
	$pdf->Cell(35,6,'# Licencia', 1,0,'C',1);
	$pdf->SetX(165);
	$pdf->Cell(20,6,'# Cel.', 1,1,'C',1);

	$conta = 1;

	while ($r = $sql->fetch()) {
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetTextColor(0,0,0);

		$pdf->SetX(20);
		$pdf->Cell(10,6,$conta++,1,0,'C');
		$pdf->SetX(30);
		$pdf->Cell(70,6,utf8_decode($r['apellidos'].", ".$r['nombres']), 1,0,'L');
		$pdf->SetX(100);
		$pdf->Cell(30,6,$r['dui'], 1,0,'C');
		$pdf->SetX(130);
		$pdf->Cell(35,6,$r['licencia'], 1,0,'C');
		$pdf->SetX(165);
		$pdf->Cell(20,6,$r['tcel'], 1,1,'C');
	}

	$pdf->Output();
?>