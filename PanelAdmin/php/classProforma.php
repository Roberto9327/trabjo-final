<?php
class proforma
{
  private $id;
  private $nombre;
  private $id_cliente;
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
public function contarprof()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from proforma";
    $inser=$conex->query($sql);
  $contador = 0;
  while($rq = mysqli_fetch_array($inser)){
    $contador++;
  }
  $contador_proforma = $contador + 1;
  return $contador_proforma;
  }
  public function cantidadTotalProforma($iniciar,$articulo_x_pagina)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * from proforma order by id desc limit $iniciar,$articulo_x_pagina";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function cantidadTotalProformabus($categoria,$iniciar,$articulo_x_pagina)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * from proforma where id = $categoria order by id desc limit $iniciar,$articulo_x_pagina";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function buscarProforma($idProforma)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * from proforma where id = $idProforma";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function buscarCliente($cliente)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * from cliente where id = $cliente";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function contenidoProforma($idProforma)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * from detalle_proforma where id_proforma = $idProforma";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function buscarcategoria($categoria)
  {
    $mysqli = connect();
    $conex=$mysqli;

    $sql = "select * FROM proforma WHERE  nombre like '%$categoria'";
    
  $consul=$conex->query($sql);
  return $consul;
  }
    public function reporteTotalProducto($date1,$date2,$iniciar,$articulo_x_pagina)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * FROM proforma WHERE fecha BETWEEN '$date1' AND '$date2' order by fecha asc  limit $iniciar,$articulo_x_pagina";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function reporteTotalProducton($nombrepro,$date1,$date2,$iniciar,$articulo_x_pagina)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * FROM proforma WHERE nombre like '%$nombrepro%' and fecha BETWEEN '$date1' AND '$date2' order by fecha asc  limit $iniciar,$articulo_x_pagina";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function contarprorecarga($date1,$date2)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * FROM proforma WHERE fecha BETWEEN '$date1' AND '$date2' order by fecha asc ";
    $inser=$conex->query($sql);
  $contador = 0;
  while($rq = mysqli_fetch_array($inser)){
    $contador++;
  }
  $contador_rango = $contador ;
  return $contador_rango;
  }
  public function contarprorecargan($nombrepro,$date1,$date2)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * FROM proforma WHERE nombre like '%$nombrepro%' and fecha BETWEEN '$date1' AND '$date2' order by fecha asc";
    $inser=$conex->query($sql);
  $contador = 0;
  while($rq = mysqli_fetch_array($inser)){
    $contador++;
  }
  $contador_rango = $contador ;
  return $contador_rango;
  }
  public function reporteTotalProductoprecion($nombrepro,$date1,$date2)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * FROM proforma WHERE nombre like '%$nombrepro%' and fecha BETWEEN '$date1' AND '$date2' order by fecha asc";
    $consul=$conex->query($sql);
    return $consul;
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