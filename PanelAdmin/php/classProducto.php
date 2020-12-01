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
  $sql="select * from nombre_pro_inv where nombre='$nombre'";
    $inser=$conex->query($sql);
  $n=$inser->num_rows;
  return $n;
  }
  public function idProducto($nombre)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from nombre_pro_inv where nombre='$nombre'";
    $inser=$conex->query($sql);
  return $inser;
  }
  public function insertarnombre($nombre)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="insert into nombre_pro_inv values(0,'$nombre')";
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
   public function insertarnuevosdatos($categoria,$ubicacion,$idnompro)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="insert into inventario_producto values(0,0,0,'$categoria','$ubicacion','$idnompro',1,3,1),(0,0,0,'$categoria','$ubicacion','$idnompro',2,1,0),(0,0,0,'$categoria','$ubicacion','$idnompro',2,2,0)";
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
	  $sql="select pr.id ,pr.nombre, pr.precio, pr.cantidad, n.detalle,up.ubicacion , pr.estado FROM productos AS pr INNER JOIN nombre_producto AS n ON pr.id_detalle = n.id INNER JOIN ubicacion_producto AS up ON up.id = pr.id_ubicacion WHERE pr.estado <> 0 order by n.detalle asc  limit $iniciar,$articulo_x_pagina";
	  $consul=$conex->query($sql);
	  return $consul;
  }
   public function cantidadTotalProductopdf()
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select pr.id ,pr.nombre, pr.precio, pr.cantidad, n.detalle, pr.estado FROM productos AS pr INNER JOIN nombre_producto AS n ON pr.id_detalle = n.id WHERE pr.estado <> 0 order by pr.id asc";
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
public function actualizarproductos($nombre,$precio,$idProducto)
  {
    $mysqli = connect();
    $conex=$mysqli;
    $stmt = $mysqli->prepare("update productos SET nombre = ?, precio = ? 
   WHERE id = ?");
    $stmt->bind_param('sii',$nombre,$precio,$idProducto);
    $stmt->execute(); 
    $stmt->close();
  return "realizado";
  }
public function habilitarProducto($estado,$idProducto)
  {
    $mysqli = connect();
    $conex=$mysqli;
    $stmt = $mysqli->prepare("update productos SET estado = ? WHERE id = ?");
    $stmt->bind_param('ii',$estado,$idProducto);
    $stmt->execute(); 
    $stmt->close();
  return "realizado";
  }
  public function ocultarProducto($estado,$idProducto)
  {
    $mysqli = connect();
    $conex=$mysqli;
    $stmt = $mysqli->prepare("update productos SET estado = ? WHERE id = ?");
    $stmt->bind_param('ii',$estado,$idProducto);
    $stmt->execute(); 
    $stmt->close();
  return "realizado";
  }
  public function buscarproductoscat($iniciar,$articulo_x_pagina)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from nombre_producto limit $iniciar,$articulo_x_pagina";
    $inser=$conex->query($sql);
  return $inser;
  }
  public function contarinv()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from nombre_producto";
    $inser=$conex->query($sql);
  $contador = 0;
  while($rq = mysqli_fetch_array($inser)){
    $contador++;
  }
  $contador_proforma = $contador;
  return $contador_proforma;
  }
  public function insertarcat($detalle)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="insert into nombre_producto (detalle,estado) values('$detalle',1)";
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
   public function listarproveedores()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from proveedores where estado <> 0  ORDER BY id desc";
  $consul=$conex->query($sql);
  return $consul;
  }
  public function listarproductos()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from productos where estado <> 0  ORDER BY id desc";
  $consul=$conex->query($sql);
  return $consul;
  }
  public function insertarstock($fecha,$preciou,$preciot,$cantidad,$productos,$proveedores)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="insert into proveedor_recarga_productos (fecha,preciou,preciot,cantidad,id_producto,id_proveedor,estado) values('$fecha','$preciou','$preciot','$cantidad','$productos','$proveedores',1)";
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
   public function insertarenelinventario($productos,$cantidad)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="update productos set cantidad = cantidad + '$cantidad' where id = $productos";
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
  public function contarrecarga()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from proveedor_recarga_productos";
    $inser=$conex->query($sql);
  $contador = 0;
  while($rq = mysqli_fetch_array($inser)){
    $contador++;
  }
  $contador_proforma = $contador ;
  return $contador_proforma;
  }
  public function cantidadTotalrecargas($iniciar,$articulo_x_pagina)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select prp.id ,pr.nombre as 'nombreproducto', p.nombre as 'nombreproveedor', prp.cantidad, prp.preciou, prp.preciot, prp.fecha, prp.estado FROM proveedor_recarga_productos AS prp INNER JOIN productos AS pr ON prp.id_producto = pr.id INNER JOIN proveedores AS p ON prp.id_proveedor = p.id WHERE prp.estado <> 0 order by id desc limit $iniciar,$articulo_x_pagina";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function contarub()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from ubicacion_producto";
    $inser=$conex->query($sql);
  $contador = 0;
  while($rq = mysqli_fetch_array($inser)){
    $contador++;
  }
  $contador_proforma = $contador;
  return $contador_proforma;
  }
  public function buscarproductosub($iniciar,$articulo_x_pagina)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from ubicacion_producto limit $iniciar,$articulo_x_pagina";
    $inser=$conex->query($sql);
  return $inser;
  }
  public function insertarub($detalle)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="insert into ubicacion_producto (ubicacion,estado) values('$detalle',1)";
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
  public function ubicacionproducto()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from ubicacion_producto where estado <> 0  ORDER BY id desc";
  $consul=$conex->query($sql);
  return $consul;
  }
public function contarrep()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from detalle_proforma";
    $inser=$conex->query($sql);
  $contador = 0;
  while($rq = mysqli_fetch_array($inser)){
    $contador++;
  }
  $contador_proforma = $contador ;
  return $contador_proforma;
  }
   public function reporteTotalProducto($date1,$date2,$iniciar,$articulo_x_pagina)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select dp.ancho, dp.alto, dp.cantidad, dp.preciou, dp.preciot, dp.detalle, p.fecha
          FROM detalle_proforma AS dp 
          INNER JOIN proforma AS p ON dp.id_proforma = p.id 
          WHERE p.fecha BETWEEN '$date1' AND '$date2' order by p.fecha asc  limit $iniciar,$articulo_x_pagina";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function reporteTotalProducton($nombrepro,$date1,$date2,$iniciar,$articulo_x_pagina)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select dp.ancho, dp.alto, dp.cantidad, dp.preciou, dp.preciot, dp.detalle, p.fecha
          FROM detalle_proforma AS dp 
          INNER JOIN proforma AS p ON dp.id_proforma = p.id 
          WHERE dp.detalle like '%$nombrepro%' and p.fecha BETWEEN '$date1' AND '$date2' order by p.fecha asc  limit $iniciar,$articulo_x_pagina";
    $consul=$conex->query($sql);
    return $consul;
  }
   public function reporteTotalProductotest($iniciar,$articulo_x_pagina)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select dp.ancho, dp.alto, dp.cantidad, dp.preciou, dp.preciot, dp.detalle, p.fecha
          FROM detalle_proforma AS dp 
          INNER JOIN proforma AS p ON dp.id_proforma = p.id 
          order by p.fecha asc  limit $iniciar,$articulo_x_pagina";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function contarprorecarga($date1,$date2)
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select dp.ancho, dp.alto, dp.cantidad, dp.preciou, dp.preciot, dp.detalle, p.fecha
          FROM detalle_proforma AS dp 
          INNER JOIN proforma AS p ON dp.id_proforma = p.id 
          WHERE p.fecha BETWEEN '$date1' AND '$date2'";
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
  $sql="select dp.ancho, dp.alto, dp.cantidad, dp.preciou, dp.preciot, dp.detalle, p.fecha
          FROM detalle_proforma AS dp 
          INNER JOIN proforma AS p ON dp.id_proforma = p.id 
          WHERE dp.detalle like '%$nombrepro%' and p.fecha BETWEEN '$date1' AND '$date2'";
    $inser=$conex->query($sql);
  $contador = 0;
  while($rq = mysqli_fetch_array($inser)){
    $contador++;
  }
  $contador_rango = $contador ;
  return $contador_rango;
  }
  public function reporteTotalProductoprecio($date1,$date2)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select dp.ancho, dp.alto, dp.cantidad, dp.preciou, dp.preciot, dp.detalle, p.fecha
          FROM detalle_proforma AS dp 
          INNER JOIN proforma AS p ON dp.id_proforma = p.id 
          order by p.fecha asc";
    $consul=$conex->query($sql);
    return $consul;
  }
  public function reporteTotalProductoprecion($nombrepro,$date1,$date2)
  {
      $mysqli = connect();
    $conex=$mysqli;
    $sql="select dp.ancho, dp.alto, dp.cantidad, dp.preciou, dp.preciot, dp.detalle, p.fecha
          FROM detalle_proforma AS dp 
          INNER JOIN proforma AS p ON dp.id_proforma = p.id 
          where dp.detalle like '%$nombrepro%' and p.fecha BETWEEN '$date1' AND '$date2' order by p.fecha asc";
    $consul=$conex->query($sql);
    return $consul;
  }
   public function contarpronew()
  {
    $mysqli = connect();
    $conex=$mysqli;
  $sql="select * from inventario_producto";
    $inser=$conex->query($sql);
  $contador = 0;
  while($rq = mysqli_fetch_array($inser)){
    $contador++;
  }
  $contador_proforma = $contador ;
  return $contador_proforma;
  }
   public function cantidadTotalProductonew($iniciar,$articulo_x_pagina)
  {
      $mysqli = connect();
    $conex=$mysqli;
	  $sql="select inpro.id ,npi.nombre, inpro.precio, inpro.cantidad, np.detalle, tc.tipo_nombre, tcsf.tipo_compra_sf,up.ubicacion, inpro.estado 
			FROM inventario_producto AS inpro 
			INNER JOIN nombre_producto AS np ON inpro.id_detalle = np.id
			INNER JOIN nombre_pro_inv AS npi ON inpro.id_nombre = npi.id
			INNER JOIN tipo_compra AS tc ON inpro.id_tipo_compra = tc.id
			INNER JOIN tipo_compra_sf AS tcsf ON inpro.id_tipo_compra_sf = tcsf.id
			INNER JOIN ubicacion_producto AS up ON inpro.id_ubicacion = up.id
			WHERE inpro.estado <> 0 order by inpro.id asc limit $iniciar,$articulo_x_pagina";
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