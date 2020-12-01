<?php 
session_start();

if(isset($_SESSION["nombre"]))
{
	$idexistesesion= $_SESSION["nombre"];
	include "cabecera.php";
	$_SESSION["nombre"]=$_SESSION["nombre"];
	$_SESSION["codigo"]=array();
	$_SESSION["descripcion"]=array();
	$_SESSION["precioventa"]=array();
	$_SESSION["cantidad"]=array();
	$_SESSION["total"]=array();
	$_SESSION["caN"]=0;
	?>
	 <div id="contenidos">
	  <div id="content-menu">
	  	<form name="fproforma" id="fproforma" ><!--  method="post" action="Proforma/generar_numero_proforma.php" -->
	  		<div class="box-opcion" id="proforma"><img src="img/proforma.png"><p>PROFORMA</p><input type="hidden" value="<?php echo $idexistesesion?>" name="sesionnombre"></div>
	  		<!-- <input type="submit" value="Nueva proforma" name="proforma"> -->
	  	</form>
	     
	 	<a href="Inventario"><div class="box-opcion"><img src="img/inventario.png"><p>INVENTARIO</p></div></a>
	 	<a href="Directorio"><div class="box-opcion"><img src="img/directorio.png"><p>DIRECTORIO</p></div></a>
	 	<a href="Obra/ver_obra.php?pagina=1"><div class="box-opcion"><img src="img/obras.png"><p>Obras</p></div></a>
	 	<a href="Proveedores/index.php?pagina=1"><div class="box-opcion"><img src="img/proveedor.png"><p>Proveedores</p></div></a>
	  </div>
	 </div>
	 <?php 
	// include "pie.php"; 
}
else
{
header('Location: http://justo-juez.com/medicion/');
}
?>

