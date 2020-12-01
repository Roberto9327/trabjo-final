<?php
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
require("classProforma.php");
$p = new proforma();
$alto = $_POST['alto_otros'];
$ancho = $_POST['ancho_otros'];
$cantidad = $_POST['cantidad_otros'];
$preciou = $_POST['preciou_otros'];
$preciot = $_POST['preciot_otros'];
$cotizar = $_POST['detalles_otros'];
$idProforma = $_SESSION["idproforma"];
if ($preciot == "") {
	$preciot = $preciou * $cantidad;
}
if ($preciou == "") {
	$preciou = $preciot / $catidad;
}
$introducir_datos = $p->ingresardatos($alto,$ancho,$cantidad,$preciou,$preciot,$cotizar,$idProforma);
echo $introducir_datos;

?>
 
