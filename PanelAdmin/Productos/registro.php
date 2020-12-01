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
$categoria= $_POST['categoria'];
$ubicacion = $_POST['ubicacion'];
$verificar = $p->verificarProducto($nombre);

if($verificar == 0)
{	$insertarnombreproducto = $p -> insertarnombre($nombre);
	$extraerid = $p->idProducto($nombre);
	$fila=mysqli_fetch_array($extraerid);
	$idnompro = $fila[0];
	$insertar = $p->insertarnuevosdatos($categoria,$ubicacion,$idnompro);
	$_SESSION['mensajeerrorproducto'] = "<p style='color:green;'>El producto se registro satisfactoriamente</p>";
}else{
	$_SESSION['mensajeerrorproducto'] = "<p style='color:red;'>El producto ya se encuentra ocupado</p>";
	echo "dato registrado";
}
}
else
{
	header('Location: http://justo-juez.com/medicion');
} 
?>