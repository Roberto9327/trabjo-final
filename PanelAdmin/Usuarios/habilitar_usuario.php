<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
include "../php/classUser.php";
$p = new user();
$idProducto = $_GET['id'];
$estado = 1;
$verificar = $p->habilitarUsuario($estado,$idProducto);
header('Location: http://localhost/medicion/PanelAdmin/Usuarios/ver_usuarios.php?pagina=1');
}
else
{
	header('Location: http://localhost/medicion');
} 
?>