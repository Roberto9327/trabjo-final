<?php
session_start();

if(isset($_SESSION["nombre"]))
{
	$nombreusuario=$_SESSION["nombre"];

unset($_SESSION["idproforma"]);
	 
header('Location: http://justo-juez.com/medicion/Proforma/index.php');

}
else
{
  header('Location: http://justo-juez.com/medicion');
}
?>