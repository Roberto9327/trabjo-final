<?php 
session_start();

	
	$_SESSION["idproducto"][]=0;
	$_SESSION["ancho"][]=$_POST["ancho"];
	$_SESSION["alto"][]=$_POST["alto"];
	$_SESSION["nombreproducto"][]=$_POST["cotizar"];
	$_SESSION["precioventa"][]=$_POST["preciou"];
	$_SESSION["cantidad"][]=$_POST["cantidad"];
	$_SESSION["total"][]=$_POST["preciot"];
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
	echo 1;

