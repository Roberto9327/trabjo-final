<?php
class directorio
{
  private $id;
  private $nombre;
  private $telefono;
  private $nit;

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
public function getTelefono()
{
  return $this->telefono;
}
public function setTelefono($t)
{
  $this->telefono=$t;
}
public function getNit()
{
  return $this->nit;
}
public function setNit($ni)
{
  $this->nit=$ni;
}
public function buscarclientes($iniciar,$articulo_x_pagina)
  {
    $mysqli = connect();
    $conex=$mysqli;
	$sql="select * from cliente limit $iniciar,$articulo_x_pagina";
    $inser=$conex->query($sql);
	return $inser;
  }
  public function contardir()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from cliente";
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