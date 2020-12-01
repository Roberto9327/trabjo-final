<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
include "../php/classProducto.php";
$p = new producto();
$nombreusuario=$_SESSION["nombre"];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$idProducto = $_SESSION["iddelproducto"];
$verificar = $p->actualizarproductos($nombre,$precio,$idProducto);
echo "1";
}
else
{
	header('Location: http://justo-juez.com/medicion');
} 

?>