<?php
class producto
{
  private $id;
  private $codigo;
  private $nombre;
  private $usuario;
  private $password;
  private $tipo;
  private $estado;
  private $conexion;
  public function __construct()
  {
// $db = new mysqli('localhost', 'jjusto', '123456.Jjuez', 'jjusto_productosjj');
$host_mysql = "localhost";
$user_mysql = "jjusto";
$pass_mysql = "123456.Jjuez";
$db_mysql = "jjusto_productosjj";
$mysqli = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql);
  }
  public function getId()
  {
  return $this->id;
  }
  public function setId($i)
  {
  $this->id=$i;
  }
  public function getCodigo()
  {
   return $this->codigo;
  }
  public function setCodigo($co)
  {
  $this->codigo=$co;
  }
  public function getNombre()
  {
  return $this->nombre;
  }
  public function setNombre($n)
  {
  $this->nombre=$n;
  }
  public function getusuario()
  {
  return $this->usuario;
  }
  public function setusuario($u)
  {
  $this->usuario=$u;
  }
  public function getpassword()
  {
  return $this->password;
  }
  public function setpassword($ps)
  {
  $this->password=$ps;
  }
  public function gettipo()
  {
  return $this->tipo;
  }
  public function settipo($t)
  {
   $this->tipo=$t;
  }
  public function getEstado()
  {
  return $this->estado;
  }
  public function setEstado($es)
  {
  $this->estado=$es;
  }
  public function verificarProducto($nombre)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from productos where nombre='$nombre'";
    $inser=$conex->query($sql);
  $n=$inser->num_rows;
  return $n;
  }
   public function insertarnuevosdatos($nombre,$precio,$cantidad,$producto)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="insert into productos values(0,'$nombre','$precio','$producto','$cantidad',1)";
  echo $sql;
  $inser=$conex->query($sql);
  if($inser)
  {
   return "Se inserto el usuario de forma correcta";
  }
  else
  {
   return "No se pudo insertar el usuario de forma correcta";
    }
  }
   public function cantidadTotalProducto($iniciar,$articulo_x_pagina)
  {
      $mysqli = connect();
    $conex=$mysqli;
	  $sql="select * from productos order by id desc limit $iniciar,$articulo_x_pagina";
	  $consul=$conex->query($sql);
	  return $consul;
  }
  public function contarpro()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from productos";
    $inser=$conex->query($sql);
  $contador = 0;
  while($rq = mysqli_fetch_array($inser)){
    $contador++;
  }
  $contador_proforma = $contador ;
  return $contador_proforma;
  }
  public function categoriaproducto()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from nombre_producto where estado <> 0  ORDER BY detalle desc";
  $consul=$conex->query($sql);
  return $consul;
  }
   public function buscarproducto($idProducto)
  {
    $mysqli = connect();
    $conex=$mysqli;

    $sql = "select * from productos where id='$idProducto'";
    
  $consul=$conex->query($sql);
  return $consul;
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