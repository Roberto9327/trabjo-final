<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) )
{
	$nombreusuario=$_SESSION["nombre"];
	
	include "cabeceraProveedores.php";
	?>
<div id="contenidos">
	<h2 class="titulo-prinsipal-cotizacion">Nuevo proveedor</h2>
	<div><p id="mensajeusuariob"></p></div>
	<div id="contenidos2">
		<form   id="ffnuevoproveedor" name="ffnuevoproveedor">
			<div class="form-group">
				<input type="text"  id="nombrepro" name="nombrepro" class="form-control"  title="Ingrese el nombre del proveedor"  placeholder="Ingrese el nombre del proveedor" required />
			</div>
			<div class="form-group">
				<input type="text"  id="telefonopro" name="telefonopro" class="form-control"  title="Ingrese el telefono del proveedor"  placeholder="Ingrese el telefono del proveedor" required />
			</div>
			<div class="form-group">
				<input type="text"  id="direccionpro" name="direccionpro" class="form-control"  title="Ingrese la direccion del proveedor"  placeholder="Ingrese la direccion del proveedor" required />
			</div>
			<div class="form-group">
				<input type="text"  id="nitpro" name="nitpro" class="form-control"  title="Ingrese el nit o c.i. del proveedor"  placeholder="Ingrese el nit o c.i. del proveedor" required />
			</div>
			<div class="form-group">
				<input type="text"  id="tipopro" name="tipopro" class="form-control"  title="Ingrese la categoria del proveedor"  placeholder="Ingrese la categoria del proveedor" required />
			</div>
			<a  class="btn btn-warning" id="ingresarproveedor" ><i><img src="../img/newdato.png" width="30px"> </i> Nuevo proveedor</a>
			<br><br>
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