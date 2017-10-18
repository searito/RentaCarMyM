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
											clientes.nombres AS 'NOMBRE', clientes.apellidos AS 'APELLIDO', clientes.dui AS 'DUI',
											rentas.dateo AS 'FECHA_SALE', rentas.datei AS 'FECHA_ENTRA', rentas.total AS 'TOTAL'
										FROM rentas
										INNER JOIN autos ON rentas.autoid = autos.id
										INNER JOIN clientes ON rentas.clientid = clientes.id
										WHERE autos.id =".$id." ORDER BY FECHA_SALE DESC");
	$consulta->execute();

	$sqlCar = $conectando->prepare("SELECT marca, modelo, year FROM autos WHERE id = ".$id."");
	$sqlCar->execute();

	foreach ($sqlCar as $titulo) {
		$marca = $titulo['marca'];
		$modelo = $titulo['modelo'];
		$anio = $titulo['year'];
	}

	$sqlTotal = $conectando->prepare("SELECT SUM(total) AS 'TOTAL' FROM rentas WHERE autoid = ".$id."");
	$sqlTotal->execute();

	foreach ($sqlTotal as $read) {
		$totGral = $read['TOTAL'];
	}

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetY(30);
	$pdf->SetX(75);
	$pdf->Cell(60,6,'Historial De Alquiler'." ".utf8_decode($marca)." ".utf8_decode($modelo)." ". $anio, 0,0,'C');
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
	$pdf->Cell(60,6,'Cliente',1,0,'C',1);
	$pdf->SetX(90);
	$pdf->Cell(30,6,'# DUI',1,0,'C',1);
	$pdf->SetX(120);
	$pdf->Cell(20,6,'Alq.',1,0,'C',1);
	$pdf->SetX(140);
	$pdf->Cell(20,6,utf8_decode('Dev'),1,0,'C',1);
	$pdf->SetX(160);
	$pdf->Cell(20,6,'Total',1,1,'C',1);

	$conta = 1;

	while ($r = $consulta->fetch()) {
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetTextColor(0,0,0);

		$pdf->SetX(20);
		$pdf->Cell(10,6,$conta++,1,0,'C');
		$pdf->SetX(30);
		$pdf->Cell(60,6,utf8_decode($r['APELLIDO']." ".$r['NOMBRE']),1,0,'L');
		$pdf->SetX(90);
		$pdf->Cell(30,6,$r['DUI'],1,0,'C');
		$pdf->SetX(120);
		$pdf->Cell(20,6,$r['FECHA_SALE'],1,0,'C');
		$pdf->SetX(140);
		$pdf->Cell(20,6,$r['FECHA_ENTRA'],1,0,'C');
		$pdf->SetX(160);
		$pdf->Cell(20,6,'$ '.$r['TOTAL'],1,1,'R');
	}

	$pdf->SetFont('Courier', 'B', 10);
	$pdf->SetX(130);
	$pdf->Cell(30,6,'Total General',0,0,'C');
	$pdf->SetX(160);
	$pdf->Cell(20,6,'$ '.$totGral,1,1,'R',1);

	$pdf->Output();
?>
