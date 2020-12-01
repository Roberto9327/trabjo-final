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
$alto = $_POST['alto'];
$ancho = $_POST['ancho'];
$cantidad = $_POST['cantidad'];
$preciou = $_POST['preciou'];
$preciot = $_POST['preciot'];
$cotizar = $_POST['cotizar'];
$idProforma = $_SESSION["idproforma"];
$introducir_datos = $p->ingresardatos($alto,$ancho,$cantidad,$preciou,$preciot,$cotizar,$idProforma);
echo $introducir_datos;

?>
 
