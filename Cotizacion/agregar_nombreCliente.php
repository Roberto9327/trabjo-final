<?php
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]))
{
$nombreusuario=$_SESSION["nombre"];
}
else
{
 header('Location: http://localhost/medicion');
}
//require("classProforma.php");
//$p = new proforma();
$_SESSION["nombrecliente"] = $_POST['ncliente'];
$_SESSION["telefonocliente"] = $_POST['tcliente'];
$_SESSION["nitcliente"] = $_POST['nitcliente'];
/*$idProforma = $_SESSION["idproforma"];
$existeCliente = $p->existecliente($ncliente,$tcliente,$nitcliente);
if ($existeCliente > 0) {
	$idcliente = $p->consultaridcliente($ncliente,$tcliente);
	$fila=mysqli_fetch_array($idcliente);
 	$iddelcliente=$fila[0];
 	$reempazaridcliente = $p->reemplazarid($iddelcliente,$idProforma);
}else{
	$insertarnuevocliente = $p->insertarnuevocliente($ncliente,$tcliente,$nitcliente);
	$idcliente = $p->consultaridcliente($ncliente,$tcliente);
	$fila=mysqli_fetch_array($idcliente);
 	$iddelcliente=$fila[0];
 	$reempazaridcliente = $p->reemplazarid($iddelcliente,$idProforma);
}*/

?>
 
