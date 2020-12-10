<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]))
{
$nombreusuario=$_SESSION["nombre"];
}
else
{
 header('Location: http://justo-juez.com/medicion');
}
require('../fpdf.php');
require('classProforma.php');
$nombredeproforma = $_SESSION["nombreproforma"];
// var_dump($nombredeproforma);
////////////////////////
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $numeroprofor = $_SESSION['nundeproforma'];
    $nombredeproforma = $_SESSION["nombreproforma"];
   date_default_timezone_set("America/La_Paz"); // ("America/Santiago") por ejemplo
$timestamp = time();
$hoy = getdate($timestamp);
///mes
if (strlen($hoy["mon"])==1) {
    $mes = "0".$hoy["mon"];
}
else{
    $mes = $hoy["mon"];
}
///dia
if (strlen($hoy["mday"])==1) {
    $dia = "0".$hoy["mday"];
}
else{
    $dia = $hoy["mday"];
}
///hora
if (strlen($hoy["hours"])==1) {
    $hora = "0".$hoy["hours"];
}
else{
    $hora = $hoy["hours"];
}
///minutos
if (strlen($hoy["minutes"])==1) {
    $min = "0".$hoy["minutes"];
}
else{
    $min = $hoy["minutes"];
}
///segundos
if (strlen($hoy["seconds"])==1) {
    $sec = "0".$hoy["seconds"];
}
else{
    $sec = $hoy["seconds"];
}

$fecha = $hoy["year"]."/".$mes."/".$dia;

    if (strlen($numeroprofor) == 1) {
        $numeroprofor ="000000".$numeroprofor;
    }
    if (strlen($numeroprofor) == 2) {
        $numeroprofor ="00000".$numeroprofor;
    }
    if (strlen($numeroprofor) == 3) {
        $numeroprofor ="0000".$numeroprofor;
    }
    if (strlen($numeroprofor) == 4) {
        $numeroprofor ="000".$numeroprofor;
    }
    if (strlen($numeroprofor) == 5) {
        $numeroprofor ="00".$numeroprofor;
    }
    if (strlen($numeroprofor) == 6) {
        $numeroprofor ="0".$numeroprofor;
    }
    if (strlen($numeroprofor) == 7) {
        $numeroprofor = $numeroprofor;
    }
    // Logo
    $this->Image('../img/logo1.png',10,8,20);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(70);
    // Título
    $this->Cell(60,10,utf8_decode('Proforma'),0,0,'C');
    $this->SetFont('Arial','B',8);
    $this->Cell(30,10,utf8_decode($numeroprofor),1,0,'C');
    $this->Cell(30,10,utf8_decode($fecha),1,0,'C');
    $this->SetFont('Arial','B',18);
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}

}

//////////////////////////////////////////////

//////////////////////////////////

/////////////////////////
$nombredelcliente = $_SESSION['pronombredelcliente'];
$telefonodelcliente = $_SESSION['protelefonodelcliente'];
$idproforma=$_SESSION["idproforma"];
$p = new proforma();
$carrit = $p->buscardetalle($idproforma);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',15);
$pdf->Cell(40,10,utf8_decode('Vidrieria Justo Juez'));
$pdf->Ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(40,10,utf8_decode('Cuarto anillo diagonal 2 de agosto'));
$pdf->Ln(5);
$pdf->Cell(40,10,utf8_decode('Telf 72693473 - 33604354'));
$pdf->SetFont('Arial','B',11);
$pdf->Ln(10);
$pdf->Cell(25,7,utf8_decode("NOMBRE:"),1,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,7,utf8_decode($nombredelcliente),0,0,'L',0);
$pdf->Ln(7);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(25,7,utf8_decode("TELEFONO:"),1,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,7,utf8_decode($telefonodelcliente),0,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Ln(10);
$montototal = 0;
$pdf->Cell(130,9,utf8_decode("Detalle"),1,0,'C',0); 
$pdf->Cell(20,9,utf8_decode("Cantidad"),1,0,'C',0);
$pdf->Cell(20,9,utf8_decode("Precio U"),1,0,'C',0);
$pdf->Cell(20,9,utf8_decode("Precio T"),1,1,'C',0);
$pdf->SetFont('Arial','B',8);
while ( $row = $carrit->fetch_assoc()) {
    $montototal = $montototal + $row['preciot'];
    if ($row['ancho'] == 0 || $row['alto'] == 0 ) {
        $pdf->Cell(130,9,utf8_decode($row['detalle']),1,0,'L',0); 
    }else{
       $pdf->Cell(130,9,utf8_decode($row['detalle']." \n ".$row['ancho']. " x ".$row['alto']),1,'L'); 
    }
    $pdf->Cell(20,9,utf8_decode($row['cantidad']),1,0,'C',0);
    $pdf->Cell(20,9,utf8_decode($row['preciou']),1,0,'C',0);
    $pdf->Cell(20,9,utf8_decode($row['preciot']),1,1,'C',0);
}
$pdf->Cell(130);
$pdf->Cell(30,9,utf8_decode("Monto Total"),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode($montototal."Bs."),1,0,'C',0);
$pdf->Ln(10);
$pdf->Cell(11,11, $pdf->Image('temp/'.$nombredeproforma.'/'.$nombredeproforma.'.png', $pdf->GetX(), $pdf->GetY(),20),0);
$pdf->Output();

?>