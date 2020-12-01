<?php
class proforma
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
public function contarproforma()
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
  public function insetarnewproforma($nomproforma,$fecha)
  {
    $mysqli = connect();
    $conex=$mysqli;
	$sql="insert into proforma (nombre,id_cliente,fecha) VALUES ('$nomproforma',0,'$fecha')";
  $inser=$conex->query($sql);
  $proforma = "creada exitosamente";
	return $proforma;
  }
  public function seleccionarproforma($nomproforma)
  {
    $mysqli = connect();
    $conex=$mysqli;
	$sql="select * from proforma WHERE nombre = '$nomproforma'";
	return $conex->query($sql);
  }
public function categoriaproducto()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from trabajos ORDER BY detalle ASC";
  $consul=$conex->query($sql);
  return $consul;
  }
  public function buscardetalle($idproforma)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from detalle_proforma where  id_proforma = $idproforma ";
  $consul=$conex->query($sql);
  return $consul;
  }
public function buscarcategoria($categoria)
  {
    $mysqli = connect();
    $conex=$mysqli;

    $sql = "select * FROM cotizacion WHERE  id_trabajo = '$categoria'";
    
  $consul=$conex->query($sql);
  return $consul;
  }
  public function tipodetrabajo($categoria)
  {
    $mysqli = connect();
    $conex=$mysqli;
    if($categoria > 0){
        $sql = "select * FROM cotizacion WHERE  id_trabajo = '$categoria'";
    }else{
        $sql = "select * FROM cotizacion ORDER BY detalle ASC";
    }
  $consul=$conex->query($sql);
  return $consul;
  }
  public function ingresardatos($alto,$ancho,$cantidad,$preciou,$preciot,$cotizar,$idProforma)
  {
    $mysqli = connect();
    $conex=$mysqli;
    $sql="insert into detalle_proforma (ancho,alto,cantidad,preciou,preciot,detalle,id_proforma) VALUES ('$ancho','$alto','$cantidad','$preciou','$preciot','$cotizar','$idProforma')";
    $inser=$conex->query($sql);
  $detalleproforma = "datos insertados exitosamente";
  return $detalleproforma;
  }
   public function existecliente($ncliente,$tcliente,$nitcliente)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from cliente where nombre='$ncliente' and telefono='$tcliente' and nit='$nitcliente'";
    $inser=$conex->query($sql);
  $n=$inser->num_rows;
  return $n;
  }
  public function consultaridcliente($ncliente,$tcliente)
  {
    $mysqli = connect();
    $conex=$mysqli;

    $sql = "select * from cliente where nombre='$ncliente' and telefono='$tcliente'";
    
  $consul=$conex->query($sql);
  return $consul;
  }
  public function reemplazarid($iddelcliente,$idProforma)
  {
    $mysqli = connect();
    $conex=$mysqli;
    $sql="update proforma SET id_cliente = $iddelcliente  WHERE id = '$idProforma'";
    $inser=$conex->query($sql);
  $detalleproforma = "datos modificados exitosamente";
  return $detalleproforma;
  }
   public function insertarnuevocliente($ncliente,$tcliente,$nitcliente)
  {
    $mysqli = connect();
    $conex=$mysqli;
    $sql="insert INTO cliente (nombre,telefono,nit) VALUES ('$ncliente','$tcliente','$nitcliente')";
    $inser=$conex->query($sql);
  $detalleproforma = "datos insertados exitosamente";
  return $detalleproforma;
  }
   public function buscarnombredelcliente($idproforma)
  {
    $mysqli = connect();
    $conex=$mysqli;

    $sql = "select * from proforma where id='$idproforma'";
    
  $consul=$conex->query($sql);
  return $consul;
  }
   public function mostrardatosclienteexistentes($iddelclienteencontrado)
  {
    $mysqli = connect();
    $conex=$mysqli;

    $sql = "select * from cliente where id='$iddelclienteencontrado'";
    
  $consul=$conex->query($sql);
  return $consul;
  }
  public function buscandoaccesorios()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from productos ORDER BY nombre ASC";
  $consul=$conex->query($sql);
  return $consul;
  }
  public function buscarartporid($idart)
  {
    $mysqli = connect();
    $conex=$mysqli;

    $sql = "select * from productos where id='$idart'";
    
  $consul=$conex->query($sql);
  return $consul;
  }
  public function consultardatoscarrito($idprof,$nombrepro)
  {
    $mysqli = connect();
    $conex=$mysqli;

    $sql = "select * FROM detalle_proforma WHERE detalle='$nombrepro' AND id_proforma='$idprof'";
  $consul=$conex->query($sql);
  $consulta = mysqli_num_rows($consul);
  return $consul;
  }
  public function insertararticulonuevo($nombrepro,$cantpro,$preciopro,$preciototal,$idprof,$idart)
  {
    $mysqli = connect();
    $conex=$mysqli;

    $sql = "insert INTO detalle_proforma (cantidad,preciou,preciot,detalle,id_proforma,id_productos) VALUES ($cantpro,$preciopro,$preciototal,'$nombrepro',$idprof,$idart)";
  $consul=$conex->query($sql);
  return $consul;
  }
  public function actualizarcantidad($idprof,$nombrepro,$cantpro)
  {
    $mysqli = connect();
    $conex=$mysqli;

    $sql = "update detalle_proforma SET cantidad = cantidad + $cantpro, preciot = preciou * cantidad WHERE id_proforma = '$idprof' AND detalle = '$nombrepro'";
  $consul=$conex->query($sql);
  return $consul;
  }
  public function actualizarinventario($idart,$cantpro)
  {
    $mysqli = connect();
    $conex=$mysqli;

    $sql = "update productos SET cantidad = cantidad - $cantpro WHERE id = '$idart'";
  $consul=$conex->query($sql);
  return $consul;
  }
   public function cantidadposcarrito($idcarr)
  {
    $mysqli = connect();
    $conex=$mysqli;

    $sql = "select * from detalle_proforma where id='$idcarr'";
    
  $consul=$conex->query($sql);
  return $consul;
  }
  public function actualizarinv($detalle,$cantcarrito)
  {
    $mysqli = connect();
    $conex=$mysqli;
    $sql = "update productos SET cantidad = cantidad + $cantcarrito WHERE nombre = '$detalle'";
  $consul=$conex->query($sql);
  return $consul;
  }
  public function eliminardelcarrito($idcarr)
  {
    $mysqli = connect();
    $conex=$mysqli;
    $sql = "delete FROM detalle_proforma WHERE id = '$idcarr';";
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