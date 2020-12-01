<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
$nombreusuario=$_SESSION["nombre"];

}
else
{
 header('Location: https://justo-juez.com/medicion');
}
require('../../fpdf.php');
require("../php/classProducto.php");
// var_dump($nombredeproforma);
////////////////////////
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
   

    // Logo
   $this->Image('../../img/logo1.png',10,8,20);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(70);
    // Título
    $this->Cell(60,10,utf8_decode('Inventario'),0,0,'C');
    $this->SetFont('Arial','B',8);
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
 $p = new producto();
$listar_productos = $p->cantidadTotalProductopdf();



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
$pdf->SetFont('Arial','B',8);
$pdf->Ln(10);
$pdf->Cell(13,9,utf8_decode("Id"),1,0,'C',0); 
$pdf->Cell(100,9,utf8_decode("Nombre"),1,0,'C',0);
$pdf->Cell(20,9,utf8_decode("Precio"),1,0,'C',0);
$pdf->Cell(20,9,utf8_decode("Cantidad"),1,0,'C',0);
$pdf->Cell(40,9,utf8_decode("Item"),1,1,'C',0);
while ( $row = $listar_productos->fetch_assoc()) {
    $pdf->Cell(13,9,utf8_decode($row['id']),1,0,'L',0);
    $pdf->Cell(100,9,utf8_decode($row['nombre']),1,0,'L',0);
    $pdf->Cell(20,9,utf8_decode($row['precio']),1,0,'C',0);
    $pdf->Cell(20,9,utf8_decode($row['cantidad']),1,0,'C',0);
    $pdf->Cell(40,9,utf8_decode($row['detalle']),1,1,'C',0);
}
$pdf->Output();

?>