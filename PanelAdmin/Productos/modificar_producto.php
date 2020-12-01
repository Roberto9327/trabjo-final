<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
	$nombreusuario=$_SESSION["nombre"];
	if (!$_GET) {
		header('Location:ver_producto.php?pagina=1');
	}
	$idProducto = $_GET['id'];
	$_SESSION["iddelproducto"] = $idProducto;
	require("../php/classProducto.php");
	$p = new producto();
	$mostrar = $p->buscarproducto($idProducto);
	$fila=mysqli_fetch_array($mostrar);
	 $nombre_pro = $fila[1];
	 $precio_pro = $fila[2];
	include "cabeceraProducto.php";
	?>
</div>
<div id="contenidos">
	<h1>Modificar producto</h1>
	<form  id="datosmodificarproductos" name="datosmodificarproductos">
		<div class="formu">
			<div class="form-group">
				<label class="label">Nombre del producto</label>
				<input type="text" value="<?=$nombre_pro?>" class="form-control" name="nombre" title="Nombre del producto"  placeholder="Nombre del producto" required />
			</div>
			<div class="form-group">
				<label class="label">Precio del producto</label>
				<input type="text" value="<?=$precio_pro?>" class="form-control" name="precio" title="Precio en Bs."  placeholder="Precio en Bs." required />
			</div>
			<div>
				<div class="btnproforma form-group">
					<a id="modificarproducto" class="btn btn-success" name="modificarproducto" >Actualizar</a>
				</div>
			</div>

		</form>
	</div>

</div>
</body>
</html>
<?php
}
else
{
	header('Location: http://justo-juez.com/medicion');
} 
?>