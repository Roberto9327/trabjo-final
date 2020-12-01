<?php
session_start();

if(isset($_SESSION["nombre"]))
{
	$nombreusuario=$_SESSION["nombre"];
	$idart = $_POST['art'];
	$cantpro = $_POST['cantpro'];
	$idprof = $_SESSION["idproforma"];
	require("classProforma.php");
	$p = new proforma();
	$busart = $p->buscarartporid($idart);
	$fila=mysqli_fetch_array($busart);
 	$nombrepro=$fila[1];
 	$preciopro=$fila[2];
 	$stockpro=$fila[4];
if ($cantpro < $stockpro) {
	$preciototal = $preciopro * $cantpro;
 	$consultar = $p->consultardatoscarrito($idprof,$nombrepro);
 	$cons = mysqli_num_rows($consultar);
 	if (mysqli_num_rows($consultar) > 0) {
 		 $insertarnewpro = $p->actualizarcantidad($idprof,$nombrepro,$cantpro);
 		 $inventario = $p->actualizarinventario($idart,$cantpro);
	}else{
		$insertarnewpro = $p->insertararticulonuevo($nombrepro,$cantpro,$preciopro,$preciototal,$idprof,$idart);
		$inventario = $p->actualizarinventario($idart,$cantpro);
	}
 	echo 1;
}else{
	echo 2;
}


 	
}
else
{
	echo "noda";
 // header('Location: http://justo-juez.com/medicion');
}
?>
 