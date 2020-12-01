<?php
class proveedores
{
  private $id;
  private $nombre;
  private $telefono;
  private $direccion;
  private $nit;
  private $tipo;
  private $estado;

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
public function getDireccion()
{
  return $this->direccion;
}
public function setDireccion($d)
{
  $this->direccion=$d;
}
public function getNit()
{
  return $this->nit;
}
public function setNit($ni)
{
  $this->nit=$ni;
}
public function getTipo()
{
  return $this->tipo;
}
public function setTipo($ti)
{
  $this->tipo=$ti;
}
public function getEstado()
{
  return $this->estado;
}
public function setEstado($es)
{
  $this->estado=$es;
}
public function buscarproveedores($iniciar,$articulo_x_pagina)
  {
    $mysqli = connect();
    $conex=$mysqli;
	$sql="select * from proveedores limit $iniciar,$articulo_x_pagina";
    $inser=$conex->query($sql);
	return $inser;
  }
  public function contarinv()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from proveedores";
    $inser=$conex->query($sql);
  $contador = 0;
  while($rq = mysqli_fetch_array($inser)){
    $contador++;
  }
  $contador_proforma = $contador;
  return $contador_proforma;
  }
  public function existeproveedor($nombrep,$telefonop)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from proveedores where nombre='$nombrep' and telefono='$telefonop'";
    $inser=$conex->query($sql);
  $n=$inser->num_rows;
  return $n;
  }
  public function insertarnuevoproveedor($nombrep,$telefonop,$direccionp,$nitp,$tipop)
  {
    $mysqli = connect();
    $conex=$mysqli;
    $sql="insert INTO proveedores (nombre,telefono,direccion,nit,tipo,estado) VALUES ('$nombrep','$telefonop','$direccionp','$nitp','$tipop',1)";
    $inser=$conex->query($sql);
  $datosinsertados = "datos insertados exitosamente";
  return $datosinsertados;
  }
  }
   function connect(){
      $host_mysql = "localhost";
      $user_mysql = "jjusto";
      $pass_mysql = "123456.Jjuez";
      $db_mysql = "jjusto_productosjj";

      $mysqli = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql);

      return $mysqli;
    }
?>