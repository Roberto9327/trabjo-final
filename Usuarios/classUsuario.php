<?php
class usuario
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
  public function verificarUsuario($u,$ps)
  {
    $mysqli = connect();
 //    $conex=$mysqli;
	// $sql="select * from usuarios where usuario=? and password=?";
 //    $inser=$conex->prepare($sql);
 //    $inser->bind_param('ss', $u, $ps);
 //    $inser->execute();
 //    var_dump($inser);
	// $n=$inser;
 //  var_dump($n);

$stmt = $mysqli->prepare("select * from usuarios where usuario=? and password=?");
$stmt->bind_param('ss', $u, $ps);
$result = $stmt->execute();
$stmt->store_result();
$n = $stmt->num_rows;

	return $n;
  }
  public function devolverDatosDeUsuarios($u,$ps)
  {
     $mysqli = connect();
    $conex=$mysqli;
	 $sql="select id,codigo,nombre,tipo from usuarios where usuario='$u' and password='$ps'";
     return $conex->query($sql);
  }
  public function consultasUsuarios($compag,$CantidadMostrar)
  {
    $conex=$this->conexion;
	$sql="select * from usuarios where estado<>0 order by nombre asc LIMIT ".(($compag-1)*$CantidadMostrar).",".$CantidadMostrar;
    return $conex->query($sql);
  }
  public function consultasUsuariosPorNombre($n,$compag,$CantidadMostrar)
  {
    $conex=$this->conexion;
	if($n!='')
	{
	$sql="select * from usuarios where nombre LIKE '%$n%' and estado<>0 order by nombre asc LIMIT ".(($compag-1)*$CantidadMostrar).",".$CantidadMostrar;
	}
	else
	{
	$sql="select * from usuarios where estado<>0 order by nombre asc LIMIT ".(($compag-1)*$CantidadMostrar).",".$CantidadMostrar;
	}
	return $conex->query($sql);
  }
  public function reportesUsuariosPorNombre($n)
  {
    $conex=$this->conexion;
	if($n!='')
	{
	$sql="select * from usuarios where nombre LIKE '%$n%' and estado<>0 order by nombre asc";
	}
	else
	{
	$sql="select * from usuarios where estado<>0 order by nombre asc";
	}
	return $conex->query($sql);
  }
  public function consultasUsuariosPorId($id)
  {
    $conex=$this->conexion;
	$sql="select * from usuarios where id=$id and estado<>0";
	return $conex->query($sql);
  }
  public function insertarUsuario($cod,$n,$usu,$pass,$tip)
  {
    $conex=$this->conexion;
	$sql="insert into usuarios values(0,'$cod','$n','$usu','$pass','$tip',1)";
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
  public function actualizarusuario($id,$cod,$n,$usu,$pass,$tip)
  {
    $conex=$this->conexion;
	$sql="update usuarios set codigo='$cod',nombre='$n',usuario='$usu',password='$pass',tipo='$tip' where id=$id";
	$inser=$conex->query($sql);
	if($inser)
	{
	 return "Se actualizo el usuario de forma correcta";
	}
	else
	{
	 return "No se pudo actualizar el usuario de forma correcta";
    }
  }
  public function eliminarUsuarioPorId($id)
  {
    $conex=$this->conexion;
	$sql="update usuarios set estado=0 where id=$id";
	$inser=$conex->query($sql);
	if($inser)
	{
	 return "Se elimino el usuario de forma correcta";
	}
	else
	{
	 return "No se pudo eliminar el usuario de forma correcta";
    }
  }
  public function eliminarUsuarioPorSeleccionados($seleccionados)
  {
    $conex=$this->conexion;
	$sql="update usuarios set estado=0 where id in(".$seleccionados.")";

	$inser=$conex->query($sql);
	if($inser)
	{
	 return "Se eliminaron los usuarios seleccionados de forma correcta";
	}
	else
	{
	 return "No se  eliminaron los usuarios seleccionados de forma correcta";
    }
  }
  public function cantidadUsuarios()
  {
	  $conex=$this->conexion;
	  $sql="select * from usuarios where estado<>0";
	  $inser=$conex->query($sql);
	  return $inser->num_rows; 
  }
  public function cantidadUsuariosPorNombre($n)
  {
      $conex=$this->conexion;
	  $sql="select * from usuarios where nombre LIKE '%$n%' and estado<>0 order by nombre asc";
      $inser=$conex->query($sql);
	  return $inser->num_rows;
  }
  public function cantidadTotalUsuarios()
  {
      $conex=$this->conexion;
	  $sql="select * from usuarios";
	  $inser=$conex->query($sql);
	  return $inser->num_rows;
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