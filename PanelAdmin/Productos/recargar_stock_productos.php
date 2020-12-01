<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
include "../php/classProducto.php";
$p = new producto();
$boleta=$_POST["tipoboleta"];
$numDoc=$_POST["numdoc"];
$numAutorizacion=$_POST["nautorizacion"];
$codControl=$_POST["ccontrol"];
$fecha=$_POST["cfecha"];
$proveedores=$_POST["proveedores"];
$productos=$_POST["productos"];
$cantidad=$_POST["cantidad"];
$preciou=$_POST["preciou"];
$preciot=$_POST["total-input"];
$porcentajeVenta=$_POST["porcentaje"];
$obcerbaciones=$_POST["obcerbaciones"];
$retencion=$_POST["sinfactura"];

if ($boleta == "Factura") {
	var_dump("C/F");
}
if ($boleta <> "Factura") {
	var_dump("S/F");
}






/*$insertar = $p->insertarstock($fecha,$preciou,$preciot,$cantidad,$productos,$proveedores);
$insertarinv = $p->insertarenelinventario($productos,$cantidad);*/
var_dump($boleta);
var_dump($numDoc);
var_dump($numAutorizacion);
var_dump($codControl);
var_dump($fecha);
var_dump($proveedores);
var_dump($productos);
var_dump($cantidad);
var_dump($preciou);
var_dump($preciot);
var_dump($porcentajeVenta);
var_dump($retencion);
var_dump($obcerbaciones);
/*echo "1";*/
}
else
{
	header('Location: http://justo-juez.com/medicion');
} 

?>