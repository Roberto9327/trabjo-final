<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
	$nombreusuario=$_SESSION["nombre"];
	if (isset($_SESSION['mensajeerrorproducto'])) {
		$mensajedeerror = $_SESSION['mensajeerrorproducto'];
	}else{
		$mensajedeerror = "";
	}
	require("../php/classProducto.php");
	$p = new producto();
	$listarprov = $p->listarproveedores();
	$listarprod = $p->listarproductos();
	include "cabeceraProducto.php";
	?>
</div>
<div id="contenidos">
	<div id='contenidos2'>
		<h1>Recargar stock de productos</h1>

		<form  id="ffrecargadeproductos" name="ffrecargadeproductos">

			<div class="formu">
				<div class="mitad-col">
					<div>
						<label>Tipo documento</label>
						<select id="tipoboleta" name="tipoboleta" class="form-control" onchange="seleccionado()">
							<option selected  value="Factura">Factura</option>
							<option  value="Proforma">Proforma</option>
							<option  value="Receibo">Receibo</option>
							<option  value="Nota de venta">Nota de venta</option>
						</select><br>
					</div>
					<div>
						<label>Numero documento</label>
						<div class="form-group">
							<input type="number" class="form-control" id="numdoc" name="numdoc" title="Numero de documento"  placeholder="Numero de documento"  onkeyUp="calcular()" value="0" />
						</div>
					</div>
				</div>
				<br>

				<div class="mitad-col">
					<div>
						<label>Nro. De autorizacion</label>
						<div class="form-group">
							<input type="number" class="form-control" id="nautorizacion" name="nautorizacion" title="Nro. De autorizacion"  placeholder="Nro. De autorizacion"  value="0" />
						</div>
					</div>
				</div>
				<br>

				<div class="mitad-col">
					<div>
						<label>Codigo de control</label>
						<div class="form-group">
							<input type="number" class="form-control" id="ccontrol" name="ccontrol" title="Codigo de control"  placeholder="Codigo de control"  value="0" />
						</div>
					</div>
				</div>
				<br>

				<div class="mitad-col">
					<div>
						<label>Fecha</label>
						<div class="form-group">
							<input type="date" class="form-control" id="cfecha" name="cfecha" title="fecha"  placeholder="fecha"  />
						</div>
					</div>
				</div>
				<br>

				<div class="mitad-col" >
					<div>
						<label>Proveedores</label>
						<select id="proveedores" name="proveedores" class="form-control">
							<?php
							while($rprov = mysqli_fetch_array($listarprov)){
								?>
								<option value="<?=$rprov['id']?>"><?=utf8_decode ($rprov['nombre'])?></option>
								<?php
							}
							?>
						</select>
						<br>
					</div>
					<div>
						<label>Producto</label>
						<select id="productos" name="productos" class="form-control">
							<?php
							while($rprod = mysqli_fetch_array($listarprod)){
								?>
								<option value="<?=$rprod['id']?>"><?=utf8_decode ($rprod['nombre'])?></option>
								<?php
							}
							?>
						</select>
					</div>

					<br>
				</div>
				<br>

				<div class="mitad-col">
					<div>
						<label>Cantidad</label>
						<div class="form-group">
							<input type="text" class="form-control" name="cantidad" title="Cantidad"  placeholder="Cantidad" required />
						</div>
					</div>
					<div>
						<label>Precio compra uni.</label>
						<div class="form-group">
							<input type="text" class="form-control" id="preciou" name="preciou" title="Precio unitario en Bs."  placeholder="Precio unitario en Bs." required onkeyUp="calcular()" value="0"  />
						</div>
					</div>
					<div>
						<label>precio para la venta</label>
						<div class="form-group">
							<input type="text" class="form-control" id="total-input" name="total-input" title="Precio total en Bs."  placeholder="Precio total en Bs." required />
						</div>
					</div>
					<div>
						<label>Porcentaje para la venta</label>
						<div class="form-group">
							<input type="number" class="form-control" id="porcentaje" name="porcentaje" title="Porsentaje %"  placeholder="Porsentaje %"  onkeyUp="calcular()" value="0" />
						</div>
					</div>
				</div>
				<br>

				<div class="mitad-col">
					<div>
						<textarea id="obcerbaciones" name="obcerbaciones" width='500px' heigth='200px'></textarea>
					</div>
				</div>
				<br>

				<div class="mitad-col" id="opciones-sf">
					<div>
						<label>En caso de compra sin factura</label>
						<select id="sinfactura" name="sinfactura" class="form-control">
							<option selected value="Seleccione una opcion">Seleccione una opcion</option>
							<option value="Sin retencion">Sin retencion</option>
							<option value="Con retencion">Con retencion</option>
						</select>
					</div>
				</div>
				
				
				
				
			</div><br>
			<div>
				<div class="btnproforma form-group">
					<a id="recargarproductostok" class="btn btn-success" name="recargarproductostok" >  Recargar producto</a>
				</div>
			</div>

		</form>
	</div>
	
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