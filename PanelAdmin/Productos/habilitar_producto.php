<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
include "../php/classProducto.php";
$p = new producto();
$idProducto = $_GET['id'];
$estado = 1;
$verificar = $p->habilitarProducto($estado,$idProducto);
header('Location: http://justo-juez.com/medicion/PanelAdmin/Productos/ver_producto.php?pagina=1');
}
else
{
	header('Location: http://justo-juez.com/medicion');
} 
?>