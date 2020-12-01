<?php
session_start();

if(isset($_SESSION["nombre"]))
{
	$nombreusuario=$_SESSION["nombre"];

require('classProforma.php');
$p = new proforma();
$idcarr = $_GET['id'];
$cantidad = $p->cantidadposcarrito($idcarr);
	 $fila=mysqli_fetch_array($cantidad);
	 $ancho=$fila[1];
	 $alto=$fila[2];
	 $cantcarrito=$fila[3];
	 $detalle=$fila[6];
	 if ($ancho == 0 && $alto == 0) {
	 	$actualizarinv = $p->actualizarinv($detalle,$cantcarrito);
	 }
	 $eliminar = $p->eliminardelcarrito($idcarr);
	 
header('Location: http://justo-juez.com/medicion/Proforma/index.php');

}
else
{
	echo "noda";
  header('Location: http://justo-juez.com/medicion');
}
?>
 