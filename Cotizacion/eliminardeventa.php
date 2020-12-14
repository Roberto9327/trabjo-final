<?php 
$id=$_POST["id"];
session_start();
		unset($_SESSION["alto"][$id]);
		unset($_SESSION["ancho"][$id]);
		unset($_SESSION["idproducto"][$id]);
		unset($_SESSION["nombreproducto"][$id]);
		unset($_SESSION["precioventa"][$id]);
		unset($_SESSION["cantidad"][$id]);
		unset($_SESSION["total"][$id]);
$n=$_SESSION["caN"];
		$sum=0;
		for($i=0;$i<$n;$i++)
		{
			if(isset($_SESSION["idproducto"][$i]))
			{
			 $sum=$sum+$_SESSION["total"][$i];
			}
		}
echo $sum;
?>

