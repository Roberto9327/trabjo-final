<?php
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]))
{
$nombreusuario=$_SESSION["nombre"];
require("classobra.php");
$p = new obra();
$detalle = $_POST['detalle'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$idobra = $_POST['idobra'];
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

$fecha = $hoy["year"]."-".$mes."-".$dia;
$insertacompra = $p->insertardatosdecompra($detalle,$cantidad,$precio,$idobra,$fecha);
echo $idobra;
}
else
{
 header('Location: http://justo-juez.com/medicion');
}
?>
 
