<?php
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]))
{
$nombreusuario=$_SESSION["nombre"];
require("classobra.php");
$p = new obra();
$alto = $_POST['altoe'];
$ancho = $_POST['anchoe'];
$detalle = $_POST['detallee'];
$cantidad = $_POST['cantidade'];
$preciou = $_POST['precuiunie'];
$preciot = $_POST['preciotote'];
$idProforma = $_POST['idproe'];
$idobra = $_POST["idobre"];

$introducir_datos_extra = $p->ingresardatosextra($alto,$ancho,$cantidad,$preciou,$preciot,$detalle,$idProforma);
echo $idobra;
}
else
{
 header('Location: http://justo-juez.com/medicion');
}
?>
 
