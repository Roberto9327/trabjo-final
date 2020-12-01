<?php
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]))
{
$nombreusuario=$_SESSION["nombre"];
require("classProveedores.php");
$p = new proveedores();
$nombrep = $_POST['nombrepro'];
$telefonop = $_POST['telefonopro'];
$direccionp = $_POST['direccionpro'];
$nitp = $_POST['nitpro'];
$tipop = $_POST['tipopro'];
$existeCliente = $p->existeproveedor($nombrep,$telefonop);
if ($existeCliente == 0) {
	$insertarnuevoproveedor = $p->insertarnuevoproveedor($nombrep,$telefonop,$direccionp,$nitp,$tipop);
}
echo "1";
}
else
{
 header('Location: https://justo-juez.com/medicion');
}


?>
 
