<?php
class user
{
  private $id;
  private $codigo;
  private $nombre;
  private $usuario;
  private $password;
  private $tipo;
  private $estado;
  private $conexion;
  
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
  public function verificarUsuario($user)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from usuarios where usuario='$user'";
    $inser=$conex->query($sql);
  $n=$inser->num_rows;
  return $n;
  }
   public function insertarnuevosdatos($codigo,$nombre,$user,$pass,$tipo)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="insert into usuarios values(0,'$codigo','$nombre','$user','$pass','$tipo',1)";
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
   public function cantidadTotalUsuarios($iniciar,$articulo_x_pagina)
  {
      $mysqli = connect();
    $conex=$mysqli;
	  $sql="select * from usuarios order by id desc limit $iniciar,$articulo_x_pagina";
	  $consul=$conex->query($sql);
	  return $consul;
  }
  public function contaruser()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from usuarios";
    $inser=$conex->query($sql);
  $contador = 0;
  while($rq = mysqli_fetch_array($inser)){
    $contador++;
  }
  $contador_proforma = $contador + 1;
  return $contador_proforma;
  }
  public function habilitarUsuario($estado,$idProducto)
  {
    $mysqli = connect();
    $conex=$mysqli;
    $stmt = $mysqli->prepare("update usuarios SET estado = ? WHERE id = ?");
    $stmt->bind_param('ii',$estado,$idProducto);
    $stmt->execute(); 
    $stmt->close();
  return "realizado";
  }
  public function ocultarUsuario($estado,$idProducto)
  {
    $mysqli = connect();
    $conex=$mysqli;
    $stmt = $mysqli->prepare("update usuarios SET estado = ? WHERE id = ?");
    $stmt->bind_param('ii',$estado,$idProducto);
    $stmt->execute(); 
    $stmt->close();
  return "realizado";
  }
  public function buscaruser($iduser)
  {
    $mysqli = connect();
    $conex=$mysqli;

    $sql = "select * from usuarios where id='$iduser'";
    
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