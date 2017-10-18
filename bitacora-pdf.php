<?php 
	include_once('func/funciones.php');
	include_once('fpdf/fpdf.php');
	include_once('fpdf/plantilla.php');

	/*class PDF extends FPDF{

		function AcceptPageBreak(){
			$this->AddPage();
			$this->Ln();
			$this->SetFillColor(255,250,238);
			$this->SetFont('Arial', 'B', 12);
			$this->SetX(10);
			$this->Cell(70,6,'Cliente', 1,0,'C',1);
			$this->SetX(80);
			$this->Cell(20,6,'Auto', 1,0,'C',1);
			$this->SetX(100);
			$this->Cell(70,6,'Fechas', 1,1,'C',1);
		}
	}*/

	$conectar = new Conexion();
	$conectando = $conectar->Conectar();

	$sesion = new Sesion();
	$activa = $sesion->onSesion();
	$mensaje = null;

	$sql = $conectando->prepare("SELECT C.nombres AS 'NOMBRE', C.apellidos AS 'APELLIDO', C.dui AS 'DUI',
										A.marca AS 'MARCA', A.modelo AS 'MODELO', A.placa AS 'PLACA', A.year AS 'ANIO',
										rentas.dateo AS 'ALQUILER', rentas.datei AS 'DEVOLUCION', rentas.total AS 'MONEY'
								FROM rentas
								INNER JOIN clientes AS C ON C.id = rentas.clientid 
								INNER JOIN autos AS A ON A.id = rentas.autoid ORDER BY rentas.id DESC");
	$sql->execute();

	$sqlTotal = $conectando->prepare("SELECT SUM(total) AS 'P' FROM rentas");
	$sqlTotal->execute();

	foreach ($sqlTotal as $read) {
		$totalG = $read['P'];
	}

	$pdf = new PDFH('L', 'mm', 'Letter');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetY(30);
	$pdf->SetX(75);
	$pdf->Cell(130,6,'Bitacora De Alquiler De Autos', 0,0,'C');

	

	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFillColor(255,250,238);
	$pdf->SetTextColor(0,136,124);
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetX(20);
	$pdf->Cell(10,6,utf8_decode('N°'), 1,0,'C',1);
	$pdf->SetX(30);
	$pdf->Cell(60,6,'Cliente', 1,0,'C',1);
	$pdf->SetX(90);
	$pdf->Cell(30,6,'# DUI', 1,0,'C',1);
	$pdf->SetX(120);
	$pdf->Cell(45,6,'Auto', 1,0,'C',1);
	$pdf->SetX(165);
	$pdf->Cell(20,6,utf8_decode('Matrícula'), 1,0,'C',1);
	$pdf->SetX(185);
	$pdf->Cell(20,6,'Alq.', 1,0,'C',1);
	$pdf->SetX(205);
	$pdf->Cell(20,6,'Dev.', 1,0,'C',1);
	$pdf->SetX(225);
	$pdf->Cell(20,6,'Total', 1,1,'C',1);

	$conta = 1;

	while ($r = $sql->fetch()) {
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetTextColor(0,0,0);

		$pdf->SetX(20);
		$pdf->Cell(10,6,$conta++, 1,0,'C');
		$pdf->SetX(30);
		$pdf->Cell(60,6,utf8_decode($r['NOMBRE'] ." ".$r['APELLIDO']), 1,0,'L');
		$pdf->SetX(90);
		$pdf->Cell(30,6,$r['DUI'], 1,0,'C');
		$pdf->SetX(120);
		$pdf->Cell(45,6,$r['MARCA']." ". $r['MODELO']." ".$r['ANIO'], 1,0,'L');
		$pdf->SetX(165);
		$pdf->Cell(20,6,$r['PLACA'], 1,0,'C');
		$pdf->SetX(185);
		$pdf->Cell(20,6,$r['ALQUILER'], 1,0,'C');
		$pdf->SetX(205);
		$pdf->Cell(20,6,$r['DEVOLUCION'], 1,0,'C');
		$pdf->SetX(225);
		$pdf->Cell(20,6,'$ '.$r['MONEY'], 1,1,'R');
	}

		/*$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetX(205);
		$pdf->Cell(20,6,'Total Gral.', 0,0,'C');
		$pdf->SetX(225);
		$pdf->Cell(20,6,'$ '. $totalG, 1,1,'R');*/

	$pdf->Output();
?>
