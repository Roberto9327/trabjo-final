<?php
header('Content-type: text/html; charset=utf-8');
session_start();
include "../php/classProforma.php";
$p = new proforma();
$categoria = $_POST["cat"];
$filas = $p->buscarcategoria($categoria);
 $fila=mysqli_fetch_array($filas);
 $categoria=$fila[0];
 echo $categoria;
?>