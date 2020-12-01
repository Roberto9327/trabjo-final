<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
$host_mysql = "localhost";
$user_mysql = "jjusto";
$pass_mysql = "123456.Jjuez";
$db_mysql = "jjusto_productosjj";
$mysqli = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql);

$conex=$mysqli;

$sql="select * from trabajos ORDER BY detalle ASC";
$cats=$conex->query($sql);
while($rcat = mysqli_fetch_array($cats)){
	
	echo $rcat['detalle'];
}
?>