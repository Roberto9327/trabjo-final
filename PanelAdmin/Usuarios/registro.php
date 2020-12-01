<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
include "../php/classUser.php";
$p = new user();
$nombreusuario=$_SESSION["nombre"];
$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$pass = md5($pass);
$tipo = $_POST['newuser'];
$verificar = $p->verificarUsuario($user);
if($verificar == 0)
{
	$insertar = $p->insertarnuevosdatos($codigo,$nombre,$user,$pass,$tipo);
	echo '1';
}else{
	// $_SESSION['mensajeerror'] = "<p style='color:red;'>El usuario ya se encuentra ocupado</p>";
	echo '2';
}
}
else
{
	header('Location: http://justo-juez.com/medicion');
} 
?>