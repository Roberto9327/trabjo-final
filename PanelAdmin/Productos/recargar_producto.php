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
<div id="content-wrapper" class="d-flex flex-column">
		<div id="content">
			<div class="container-fluid"><br>
				<div class="card">
					<div class="card-body">
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
		                   <h1 class="h3 mb-0 text-gray-800">Recargar stock de productos</h1>
		             	</div>
							<form  id="ffrecargadeproductos" name="ffrecargadeproductos">

								<div class="row">
										<div  class="form-group col-xl-4 col-md-6 mb-4">
											<label>Tipo documento</label>
											<select id="tipoboleta" name="tipoboleta" class="form-control" onchange="seleccionado()">
												<option selected  value="Factura">Factura</option>
												<option  value="Proforma">Proforma</option>
												<option  value="Receibo">Receibo</option>
												<option  value="Nota de venta">Nota de venta</option>
											</select><br>
										</div>
										<div class="form-group col-xl-4 col-md-6 mb-4">
											<label>Numero documento</label>
											<input type="number" class="form-control" id="numdoc" name="numdoc" title="Numero de documento"  placeholder="Numero de documento"  onkeyUp="calcular()" value="0" />
										</div>
										<div class="form-group col-xl-4 col-md-6 mb-4">
												<label>Fecha</label>
												<input type="date" class="form-control" id="cfecha" name="cfecha" title="fecha"  placeholder="fecha"  />
											</div>
									</div>

									<div class="row">
										<div class="form-group col-xl-4 col-md-6 mb-4">
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
										</div>
										<div class="form-group col-xl-4 col-md-6 mb-4">
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
										<div class="form-group col-xl-4 col-md-6 mb-4">
											<label>Cantidad</label>
											<div class="form-group">
												<input type="text" class="form-control" name="cantidad" title="Cantidad"  placeholder="Cantidad" required />
											</div>
										</div>
									</div>
																		
									<div class="row">
										<div class="form-group col-xl-4 col-md-6 mb-4">
											<label>Precio compra uni.</label>
											<input type="text" class="form-control" id="preciou" name="preciou" title="Precio unitario en Bs."  placeholder="Precio unitario en Bs." required onkeyUp="calcular()" value="0"  />
										</div>
										<div class="form-group col-xl-4 col-md-6 mb-4">
											<label>precio para la venta</label>
											<input type="text" class="form-control" id="total-input" name="total-input" title="Precio total en Bs."  placeholder="Precio total en Bs." required />
										</div>
										<div class="form-group col-xl-4 col-md-6 mb-4">
											<label>Porcentaje para la venta</label>
											<input type="number" class="form-control" id="porcentaje" name="porcentaje" title="Porsentaje %"  placeholder="Porsentaje %"  onkeyUp="calcular()" value="0" />
										</div>
									</div>
									<div class="row">
										<div class="form-group col-xl-8 col-md-6 mb-4">
											<label>Obcervaciones</label>
											<textarea class="form-control" id="obcerbaciones" name="obcerbaciones"></textarea>
										</div>
									</div>
									<div class="row">
										<div class="btnproforma form-group col-xl-4 col-md-6 mb-4">
										<a id="recargarproductostok" class="btn btn-success" name="recargarproductostok" >  Recargar producto</a>
										</div>
									</div>

							</form>
	</div>
	</div>
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