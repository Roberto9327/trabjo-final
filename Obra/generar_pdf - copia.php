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
require('classobra.php');
// var_dump($nombredeproforma);
////////////////////////
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
   

    // Logo
    $this->Image('../img/logo1.png',10,8,20);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(70);
    // Título
    $this->Cell(60,10,utf8_decode('Reporte de obra'),0,0,'C');
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
 $p = new obra();
    $idObra = $_GET['id'];
    $buscarobras = $p->buscarObra($idObra);
    $fila=mysqli_fetch_array($buscarobras);
    $nombre = $fila[1];
    $productopro = $fila[2];
    $cliente = $fila[3];
    $fecha = $fila[4];
    $divisa ="Bs.";
    if ($cliente == 0) {
        $nombreC="S/N";
        $telefonoC="S/N";
    }else{
        $clientes= $p->buscarCliente($cliente);
        $filas=mysqli_fetch_array($clientes);
        $idcliente =$filas[0];
        $nombreC = $filas[1];
        $telefonoC = $filas[2];
        $nit = $filas[3];
    }
    $cont_obra = $p->contenidoobra($idObra);
    $cont_pago = $p->contenidopago($idObra,$idcliente);
    $productoproforma = $p->listarproductosproforma($productopro);
    $productoproformae = $p->listarproductosproformae($productopro);



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
$pdf->Cell(25,7,utf8_decode("OBRA:"),1,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,7,utf8_decode($nombre),0,0,'L',0);
$pdf->Ln(7);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,7,utf8_decode("NOMBRE:"),1,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,7,utf8_decode($nombreC),0,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,7,utf8_decode("TELEFONO:"),1,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,7,utf8_decode($telefonoC),0,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(19,7,utf8_decode("NIT:"),1,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,7,utf8_decode($nit),0,0,'L',0);
$pdf->SetFont('Arial','B',10);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(40,10,utf8_decode('Inversión'));
$pdf->SetFont('Arial','B',8);
$pdf->Ln(10);
$pdf->Cell(130,9,utf8_decode("Detalle"),1,0,'C',0); 
$pdf->Cell(20,9,utf8_decode("Cantidad"),1,0,'C',0);
$pdf->Cell(20,9,utf8_decode("Precio"),1,0,'C',0);
$pdf->Cell(20,9,utf8_decode("Fecha"),1,1,'C',0);
$montototalinvertido =0;
while ( $row = $cont_obra->fetch_assoc()) {
    $montototalinvertido = $montototalinvertido + $row['precio'];
    $pdf->Cell(130,9,utf8_decode($row['detalle']),1,0,'L',0);
    $pdf->Cell(20,9,utf8_decode($row['cantidad']),1,0,'C',0);
    $pdf->Cell(20,9,utf8_decode($row['precio']),1,0,'C',0);
    $pdf->Cell(20,9,utf8_decode($row['fecha']),1,1,'C',0);
}
$pdf->Cell(130);
$pdf->Cell(30,9,utf8_decode("Monto Total"),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode($montototalinvertido."Bs."),1,0,'C',0);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',13);
$pdf->Cell(40,10,utf8_decode('Registro de pagos'));
$pdf->SetFont('Arial','B',8);
$pdf->Ln(10);
$pdf->Cell(130,9,utf8_decode("Detalle"),1,0,'C',0); 
$pdf->Cell(30,9,utf8_decode("Monto"),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode("Fecha"),1,1,'C',0);
$montototalpagocliente =0;
while ( $row1 = $cont_pago->fetch_assoc()) {
    $montototalpagocliente = $montototalpagocliente + $row1['monto'];
    $pdf->Cell(130,9,utf8_decode($row1['detalle']),1,0,'L',0);
    $pdf->Cell(30,9,utf8_decode($row1['monto']),1,0,'C',0);
    $pdf->Cell(30,9,utf8_decode($row1['fecha']),1,1,'C',0);
}
$pdf->Cell(130);
$pdf->Cell(30,9,utf8_decode("Monto Total"),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode($montototalpagocliente."Bs."),1,0,'C',0);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',13);
$pdf->Cell(40,10,utf8_decode('Productos'));
$pdf->SetFont('Arial','B',8);
$pdf->Ln(10);
$pdf->Cell(130,9,utf8_decode("Detalle"),1,0,'C',0); 
$pdf->Cell(20,9,utf8_decode("Cantidad"),1,0,'C',0);
$pdf->Cell(20,9,utf8_decode("Precio U"),1,0,'C',0);
$pdf->Cell(20,9,utf8_decode("Precio T"),1,1,'C',0);
$pdf->SetFont('Arial','B',8);
$montototalproductos =0;
while ( $row5 = $productoproforma->fetch_assoc()) {
    $montototalproductos = $montototalproductos + $row5['preciot'];
    if ($row5['ancho'] == 0 || $row5['alto'] == 0 ) {
        $pdf->Cell(130,9,utf8_decode($row5['detalle']),1,0,'L',0); 
    }else{
       $pdf->Cell(130,9,utf8_decode($row5['detalle']." \n ".$row5['ancho']. " x ".$row5['alto']),1,'L'); 
    }
    $pdf->Cell(20,9,utf8_decode($row5['cantidad']),1,0,'C',0);
    $pdf->Cell(20,9,utf8_decode($row5['preciou']),1,0,'C',0);
    $pdf->Cell(20,9,utf8_decode($row5['preciot']),1,1,'C',0);
}
$pdf->Cell(130);
$pdf->Cell(30,9,utf8_decode("Monto Total"),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode($montototalproductos."Bs."),1,0,'C',0);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',13);
$pdf->Cell(40,10,utf8_decode('Adicionales'));
$pdf->SetFont('Arial','B',8);
$pdf->Ln(10);
$pdf->Cell(130,9,utf8_decode("Detalle"),1,0,'C',0); 
$pdf->Cell(20,9,utf8_decode("Cantidad"),1,0,'C',0);
$pdf->Cell(20,9,utf8_decode("Precio U"),1,0,'C',0);
$pdf->Cell(20,9,utf8_decode("Precio T"),1,1,'C',0);
$pdf->SetFont('Arial','B',8);
$montototalproductose =0;
while ( $row6 = $productoproformae->fetch_assoc()) {
    $montototalproductose = $montototalproductose + $row6['preciot'];
    if ($row6['ancho'] == 0 || $row6['alto'] == 0 ) {
        $pdf->Cell(130,9,utf8_decode($row6['detalle']),1,0,'L',0); 
    }else{
       $pdf->Cell(130,9,utf8_decode($row6['detalle']." \n ".$row6['ancho']. " x ".$row6['alto']),1,'L'); 
    }
    $pdf->Cell(20,9,utf8_decode($row6['cantidad']),1,0,'C',0);
    $pdf->Cell(20,9,utf8_decode($row6['preciou']),1,0,'C',0);
    $pdf->Cell(20,9,utf8_decode($row6['preciot']),1,1,'C',0);
}
$pdf->Cell(130);
$pdf->Cell(30,9,utf8_decode("Monto Total"),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode($montototalproductose."Bs."),1,0,'C',0);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',13);
$pdf->Cell(40,10,utf8_decode('Detalle de movimiento'));
$pdf->Ln(10);
$montototalproductos = $montototalproductos + $montototalproductose;
$pdf->SetFont('Arial','B',8);
$pdf->Cell(20,9,utf8_decode('Compras'),1,0,'C',0); 
$pdf->Cell(20,9,utf8_decode($montototalinvertido." Bs."),1,1,'C',0);
$pdf->Cell(20,9,utf8_decode('Monto Pagado'),1,0,'C',0);
$pdf->Cell(20,9,utf8_decode($montototalpagocliente." Bs."),1,1,'C',0);
$pdf->Output();

?>