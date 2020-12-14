<?php
class inventario
{
  private $id;
  private $nombre;
  private $fecha;

public function getId()
{
  return $this->id;
}
public function setId($i)
{
  $this->id=$i;
 }
public function getNombre()
{
  return $this->nombre;
}
public function setNombre($n)
{
  $this->nombre=$n;
}
public function getFecha()
{
  return $this->fecha;
}
public function setFecha($f)
{
  $this->fecha=$f;
}
public function buscarproductos($iniciar,$articulo_x_pagina)
  {
    $mysqli = connect();
    $conex=$mysqli;
	$sql="select * from productos where id <> 0 order by nombre ASC limit $iniciar,$articulo_x_pagina";
    $inser=$conex->query($sql);
	return $inser;
  }
  public function contarinv()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from productos";
    $inser=$conex->query($sql);
  $contador = 0;
  while($rq = mysqli_fetch_array($inser)){
    $contador++;
  }
  $contador_proforma = $contador;
  return $contador_proforma;
  }
  }
   function connect(){
      $host_mysql = "localhost";
      $user_mysql = "root";
      $pass_mysql = "";
      $db_mysql = "tiendabd";

      $mysqli = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql);

      return $mysqli;
    }
?>