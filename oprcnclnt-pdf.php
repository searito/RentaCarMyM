<?php 
	include_once('func/funciones.php');
	include_once('fpdf/fpdf.php');
	include_once('fpdf/plantilla.php');

	$conectar = new Conexion();
	$conectando = $conectar->Conectar();

	$sesion = new Sesion();
	$activa = $sesion->onSesion();
	$mensaje = null;

	if (isset($_REQUEST['id'])) {
		$id = htmlspecialchars($_REQUEST['id']);
	}

	$consulta = $conectando->prepare("SELECT
										autos.marca AS 'MARCA', autos.modelo AS 'MODELO', autos.`year` AS 'ANIO', autos.placa AS 'MATRICULA',
										rentas.dateo AS 'FECHA_SALE', rentas.datei AS 'FECHA_ENTRA', rentas.total AS 'DINERO'
									  FROM rentas
									  INNER JOIN autos ON rentas.autoid = autos.id
									  INNER JOIN clientes ON rentas.clientid = clientes.id
                                      WHERE clientes.id =".$id."");
	$consulta->execute();

	$consultaCliente = $conectando->prepare("SELECT nombres, apellidos FROM clientes WHERE id = ".$id."");
	$consultaCliente->execute();

	foreach ($consultaCliente as $title) {
		$name = $title['nombres'];
		$latsname = $title['apellidos'];
	}

	$sqlTotal = $conectando->prepare("SELECT SUM(total) AS 'TOTAL' FROM rentas WHERE clientid = ".$id."");
	$sqlTotal->execute();

	foreach ($sqlTotal as $reading) {
		$totGral = $reading['TOTAL'];
	}

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetY(30);
	$pdf->SetX(88);
	$pdf->Cell(60,6,'Transacciones Realizadas Por'." ".utf8_decode($name)." ".utf8_decode($latsname), 0,0,'C');
	$pdf->SetY(37);
	$pdf->SetX(80);
	$pdf->Cell(60,6,'Total Generado: $'.$totGral, 0,0,'C');

	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFillColor(255,250,238);
	$pdf->SetTextColor(0,136,124);
	$pdf->SetFont('Courier', 'B', 12);
	$pdf->SetX(20);
	$pdf->Cell(10,6,utf8_decode('N°'),1,0,'C',1);
	$pdf->SetX(30);
	$pdf->Cell(60,6,'Auto',1,0,'C',1);
	$pdf->SetX(90);
	$pdf->Cell(30,6,utf8_decode('# Matrícula'),1,0,'C',1);
	$pdf->SetX(120);
	$pdf->Cell(20,6,'Alq.',1,0,'C',1);
	$pdf->SetX(140);
	$pdf->Cell(20,6,utf8_decode('Dev.'),1,0,'C',1);
	$pdf->SetX(160);
	$pdf->Cell(20,6,'Total',1,1,'C',1);

	$conta = 1;

	while ($r = $consulta->fetch()) {
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetTextColor(0,0,0);

		$pdf->SetX(20);
		$pdf->Cell(10,6,$conta++,1,0,'C');
		$pdf->SetX(30);
		$pdf->Cell(60,6,utf8_decode($r['MARCA']." ". $r['MODELO']." ".$r['ANIO']),1,0,'L');
		$pdf->SetX(90);
		$pdf->Cell(30,6,$r['MATRICULA'], 1,0,'C');
		$pdf->SetX(120);
		$pdf->Cell(20,6,$r['FECHA_SALE'], 1,0,'C');
		$pdf->SetX(140);
		$pdf->Cell(20,6,$r['FECHA_ENTRA'], 1,0,'C');
		$pdf->SetX(160);
		$pdf->Cell(20,6,"$ ".$r['DINERO'], 1,1,'R');
	}

	$pdf->SetFont('Courier', 'B', 10);
	$pdf->SetX(130);
	$pdf->Cell(20,6,'Total General', 0,0,'C');
	$pdf->SetX(160);
	$pdf->Cell(20,6,"$ ".$totGral, 1,1,'R',1);
	$pdf->Output();
?>