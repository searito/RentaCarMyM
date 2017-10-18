<?php 
	include_once('func/funciones.php');
	include_once('fpdf/fpdf.php');
	include_once('fpdf/plantilla.php');

	$conectar = new Conexion();
	$conectando = $conectar->Conectar();

	$sesion = new Sesion();
	$activa = $sesion->onSesion();
	$mensaje = null;

	if (isset($_REQUEST['desde'])) {
		$desde = $_REQUEST['desde'];
		$hasta = $_REQUEST['hasta'];
	}

	$sqlDate = $conectando->prepare("SELECT clientes.nombres AS 'NOMBRE', clientes.apellidos AS 'APELLIDO', clientes.dui AS 'DUI',
			 									  autos.marca AS 'MARCA', autos.modelo AS 'MODELO',autos.`year` AS 'ANIO', autos.placa AS 'MATRICULA',
			 									  rentas.dateo AS 'FECHA_SALE', rentas.total AS 'TOTAL'
										   FROM rentas
										   INNER JOIN clientes ON clientid = clientes.id
										   INNER JOIN autos ON autoid = autos.id
										   WHERE dateo BETWEEN '".$desde."' AND '".$hasta."' ORDER BY FECHA_SALE DESC");
	$sqlDate->execute();

	$sqlTotal = $conectando->prepare("SELECT SUM(total) AS 'SUMA' FROM rentas WHERE dateo BETWEEN '".$desde."' AND '".$hasta."'");
	$sqlTotal->execute();

	foreach ($sqlTotal as $read) {
		$totGral = $read['SUMA'];
	}


	$pdf = new PDFH('L', 'mm', 'Letter');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetY(30);
	$pdf->SetX(88);
	$pdf->Cell(100,6,'Transacciones Realizadas Desde'." ".$desde." Hasta ".$hasta, 0,0,'C');
	$pdf->SetY(37);
	$pdf->SetX(115);
	$pdf->Cell(60,6,'Total Generado: $'.$totGral, 0,0,'C');

	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFillColor(255,250,238);
	$pdf->SetTextColor(0,136,124);
	$pdf->SetFont('Courier', 'B', 12);
	$pdf->SetX(20);
	$pdf->Cell(10,6,utf8_decode('N°'),1,0,'C',1);
	$pdf->SetX(30);
	$pdf->Cell(60,6,'Cliente',1,0,'C',1);
	$pdf->SetX(90);
	$pdf->Cell(30,6,'# DUI',1,0,'C',1);
	$pdf->SetX(120);
	$pdf->Cell(50,6,'Auto',1,0,'C',1);
	$pdf->SetX(170);
	$pdf->Cell(30,6,utf8_decode('# Matrícula'),1,0,'C',1);
	$pdf->SetX(200);
	$pdf->Cell(30,6,'Fecha Alq.',1,0,'C',1);
	$pdf->SetX(230);
	$pdf->Cell(30,6,'Total',1,1,'C',1);

	$conta = 1;

	while ($r = $sqlDate->fetch()) {
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetTextColor(0,0,0);

		$pdf->SetX(20);
		$pdf->Cell(10,6,$conta++,1,0,'C');
		$pdf->SetX(30);
		$pdf->Cell(60,6,utf8_decode($r['NOMBRE']." ".$r['APELLIDO']),1,0,'L');
		$pdf->SetX(90);
		$pdf->Cell(30,6,$r['DUI'],1,0,'C');
		$pdf->SetX(120);
		$pdf->Cell(50,6,utf8_decode($r['MARCA']." ".$r['MODELO']." ".$r['ANIO']),1,0,'L');
		$pdf->SetX(170);
		$pdf->Cell(30,6,$r['MATRICULA'],1,0,'C');
		$pdf->SetX(200);
		$pdf->Cell(30,6,$r['FECHA_SALE'],1,0,'C');
		$pdf->SetX(230);
		$pdf->Cell(30,6,"$ ".$r['TOTAL'],1,1,'R');
	}

	$pdf->SetFont('Courier', 'B', 10);
	$pdf->SetX(200);
	$pdf->Cell(30,6,'Total General',0,0,'C');
	$pdf->SetX(230);
	$pdf->Cell(30,6,"$ ".$totGral,1,1,'R',1);

	$pdf->Output();
?>