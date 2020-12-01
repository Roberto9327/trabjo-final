<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
require("Usuarios/classUsuario.php");
$usuario=$_POST["usuario"];
$password=$_POST["password"];
// $usuario=mysql_real_escape_string(strip_tags($_POST['usuario']));
// $password=mysql_real_escape_string(strip_tags($_POST['password']));
$password = md5($password);
$u = new usuario();
$vu=$u->verificarUsuario($usuario,$password);
if($vu!=0)
{
 $filas=$u->devolverDatosDeUsuarios($usuario,$password);
 $fila=mysqli_fetch_array($filas);
 $_SESSION["id"]=$fila[0];
 $_SESSION["codigo"]=$fila[1];
 $_SESSION["nombre"]=$fila[2]; 
  $_SESSION["AccesoSuperUser"]=$fila[3]; 
}
echo $vu;
?>