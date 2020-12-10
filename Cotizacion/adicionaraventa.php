<?php 
session_start();
require("classProforma.php");
$p=new proforma();
$id=$_POST["id"];
$filas=$p->consultasProductosPorId($id);
$fila=mysqli_fetch_array($filas);
if(noseencuentraprodcto($fila[0]))
{
	
	$_SESSION["idproducto"][]=$fila[0];
	$_SESSION["ancho"][]=0;
	$_SESSION["alto"][]=0;
	$_SESSION["nombreproducto"][]=$fila[1];
	$_SESSION["precioventa"][]=$fila[2];
	$_SESSION["cantidad"][]=1;
	$_SESSION["total"][]=$fila[2];
	$_SESSION["caN"]=$_SESSION["caN"]+1;
	//echo $_SESSION["idproducto"][0].$_SESSION["codigo"][0].$_SESSION["descripcion"][0].$_SESSION["precioventa"][0].$_SESSION["cantidad"][0].$_SESSION["total"][0];
	$n=$_SESSION["caN"];
	$sum=0;
	for($i=0;$i<$n;$i++)
	{
		if(isset($_SESSION["idproducto"][$i]))
		{
		 $sum=$sum+$_SESSION["total"][$i];
		}
	}
	$_SESSION["totalgeneral"]=$sum;
	echo $_SESSION["totalgeneral"];
}
function noseencuentraprodcto($idp)
{
	$sw=true;
	$n=$_SESSION["caN"];
	for($i=0;$i<$n;$i++)
	{
      if($_SESSION["idproducto"][$i]==$idp)
	  {   
		$sw=false;
	  }
	}
	return $sw;
}
?>

