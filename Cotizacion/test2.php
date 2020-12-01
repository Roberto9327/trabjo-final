<?php 

session_start();

echo "<pre>";

var_dump($_SESSION);

echo "</pre>";



if(isset($_SESSION["nombre"]))

{

	$nombreusuario=$_SESSION["nombre"];



	require("classProforma.php");

	$p = new proforma();

	$fecha = date("Y")."-".date("m")."-".date("d");

	$cpr = $p->contarproforma();

	$nomproforma = "Proforma ".$cpr;



	$ipr = $p->insetarnewproforma($nomproforma,$fecha);



	if($cpr!=0)

	{

	 $filas=$p->seleccionarproforma($nomproforma);

	 $fila=mysqli_fetch_array($filas);

	 $_SESSION["idproforma"]=$fila[0];

	 $_SESSION["nombreproforma"]=$fila[1];



	}

	echo $nombreusuario." hola mundo";

}

else

{

	echo "error sesion";

 // header('Location: http://justo-juez.com/medicion');

}





?>