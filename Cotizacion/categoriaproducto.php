<?php
header('Content-type: text/html; charset=utf-8');
session_start();
require("classProforma.php");
$p = new proforma();
$categoria = $_POST["cat"];
$filas = $p->buscarcategoria($categoria);
 $fila=mysqli_fetch_array($filas);
 $_SESSION["idcategoria"]=$fila[6];
 echo $_SESSION["idcategoria"];
?>