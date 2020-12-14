<?php
class obra
{
  private $id;
  private $nombre;
  private $costo;
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
  public function getCosto()
  {
  return $this->costo;
  }
  public function setCosto($c)
  {
  $this->costo=$c;
  }
public function contarobra()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from obras";
    $inser=$conex->query($sql);
  $contador = 0;
  while($rq = mysqli_fetch_array($inser)){
    $contador++;
  }
  $contador_proforma = $contador + 1;
  return $contador_proforma;
  }
  public function cantidadTotalobra($iniciar,$articulo_x_pagina)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * from obras order by id desc limit $iniciar,$articulo_x_pagina";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function cantidadTotalobrabus($categoria,$iniciar,$articulo_x_pagina)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * from obras where id = $categoria order by id desc limit $iniciar,$articulo_x_pagina";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function buscarObra($idObra)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * from obras where id = $idObra";
    $consul=$conex->query($sql);
    return $consul;
  }
   public function buscarcotizacion($idcotizacion)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * from cotizacion where id = $idcotizacion";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function buscarCliente($cliente)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select ps.id ,ps.nombre, ps.telefono, c.nit, ps.estado FROM persona AS ps INNER JOIN cliente AS c ON ps.id = c.id_persona  WHERE ps.id = $cliente and ps.estado <> 0 ";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function contenidoobra($idobra)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select pr.id ,pr.nombre, pr.precio, m.cantidad, m.precio, m.fecha FROM materiales AS m INNER JOIN productos AS pr ON pr.id = m.id_producto  WHERE m.id_obras = 1  order by m.fecha ASC";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function buscarcategoria($categoria)
  {
    $mysqli = connect();
    $conex=$mysqli;

    $sql = "select * FROM obras WHERE  nombre like '%$categoria%'";
    
  $consul=$conex->query($sql);
  return $consul;
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
   public function consultaridcliente($ncliente,$tcliente,$nitcliente)
  {
    $mysqli = connect();
    $conex=$mysqli;

    $sql = "select * from cliente where nombre='$ncliente' and telefono='$tcliente' and nit='$nitcliente'";
    
  $consul=$conex->query($sql);
  return $consul;
  }
  public function insertardatosdeobra($nobra,$proformao,$fecha,$iddelcliente)
  {
    $mysqli = connect();
    $conex=$mysqli;
    $sql="insert into obras (nombre,id_proforma,id_cliente,fecha) VALUES ('$nobra','$proformao','$iddelcliente','$fecha')";
    $inser=$conex->query($sql);
  $detalleobra = "datos insertados exitosamente";
  return $detallepobra;
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
   public function insertardatosdecompra($detalle,$cantidad,$precio,$idobra,$fecha)
  {
    $mysqli = connect();
    $conex=$mysqli;
    $sql="insert INTO obras_gastos (detalle,cantidad,precio,fecha,id_obras,estado) VALUES ('$detalle','$cantidad','$precio','$fecha',$idobra,1)";
    $inser=$conex->query($sql);
  $detalleproforma = "datos insertados exitosamente";
  return $detalleproforma;
  }
  public function contenidopago($idobra,$idcliente)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * from pagos_clientes_obras where id_cliente = $idcliente and id_obra = $idobra";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function insertardatosdepago($detalle,$monto,$fecha,$idcliente,$idobra)
  {
    $mysqli = connect();
    $conex=$mysqli;
    $sql="insert INTO pagos_clientes_obras (detalle,monto,fecha,id_cliente,id_obra,estado) VALUES ('$detalle','$monto','$fecha','$idcliente',$idobra,1)";
    $inser=$conex->query($sql);
  $detalleproforma = "datos insertados exitosamente";
return $detalleproforma;
  }
    public function listarproforma()
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * from proforma ORDER BY id desc";
    $consul=$conex->query($sql);
    return $consul;
  }
public function listarproductosproforma($productopro)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * from detalle_cotizacion where id_cotizacion = '$productopro' and extras=0";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function listarproductosproformae($productopro)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select * from detalle_cotizacion where id_cotizacion = '$productopro' and extras<>0";
    $consul=$conex->query($sql);
    return $consul;
  }
   public function ingresardatosextra($alto,$ancho,$cantidad,$preciou,$preciot,$detalle,$idProforma)
  {
    $mysqli = connect();
    $conex=$mysqli;
    $sql="insert into detalle_cotizacion (ancho,alto,cantidad,preciou,preciot,detalle,id_proforma,extras) VALUES ('$ancho','$alto','$cantidad','$preciou','$preciot','$detalle','$idProforma',1)";
    $inser=$conex->query($sql);
  $detalleproforma = "datos insertados exitosamente";
  return $detalleproforma;
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