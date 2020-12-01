<?php 
session_start();

if(isset($_SESSION["nombre"]))
{
if(isset($_SESSION["idproforma"])) 
{

	$nombreusuario=$_SESSION["nombre"];
	include "cabeceracotizacion.php"; 
	$idproforma=$_SESSION["idproforma"];
	$nombreproforma=$_SESSION["nombreproforma"];
	$divisa = "Bs.";
	require("classProforma.php");
	$p = new proforma();
	$cats = $p->categoriaproducto();
	$carrit = $p->buscardetalle($idproforma);
	$accesorio = $p->buscandoaccesorios();
	if (isset($_SESSION['idcategoria'])) {
		$categoria = $_SESSION['idcategoria'];
	}else{
		$categoria = "";
	}
	if ($categoria == "" && $categoria == 0) {
		$c = new proforma();
		$categoria = 0;
		$tipo = $c->tipodetrabajo($categoria);
	}else{
		$c = new proforma();
		$tipo = $c->tipodetrabajo($categoria);

	}

	$buscaridcliente = $p->buscarnombredelcliente($idproforma);
	$filacliente=mysqli_fetch_array($buscaridcliente);
	$iddelclienteencontrado=$filacliente[2];

	if ($iddelclienteencontrado > 0) {
		$mostrarcliente2 = $p->mostrardatosclienteexistentes($iddelclienteencontrado);
		$filabcliente2=mysqli_fetch_array($mostrarcliente2);
		$nombredelcliente=$filabcliente2[1];
		$telefonodelcliente=$filabcliente2[2];
	}else{
		$nombredelcliente="S/N";
		$telefonodelcliente="S/N";
	}
	$_SESSION['pronombredelcliente'] =$nombredelcliente;
	$_SESSION['protelefonodelcliente'] =$telefonodelcliente;
	?>
	

<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
			  <div class="container-fluid"><br>
			<div class="card">
		        	<div class="card-body">
			<?php
			 include "botones.php";
			?>
				<!--////////////////////////////////////////////////////////////////////////////////////////////-->
					<form method="post" action="" id="datosotros" name="datosotros">
						<div class="row">
							<div class="form-group col-xl-2 col-md-6 mb-4 ">
								<input type="number"  id="ancho_otros" class="form-control" name="alto_otros" title="INTRODUSCA EL ANCHO EN MM"  placeholder="Ancho"  />
							</div>
							<div class="form-group col-xl-2 col-md-6 mb-4 ">
								<input type="number"  id="alto_otros" class="form-control" name="ancho_otros" title="INTRODUSCA EL ALTO EN MM"  placeholder="Alto"  />
							</div>
							<div class="form-group col-xl-2 col-md-6 mb-4 ">
								<input type="number"  id="cantidad_otros" class="form-control" name="cantidad_otros" title="INTRODUSCA LA CANTIDAD DE PUERTAS O VENTANAS"  placeholder="Cantidad" required />
							</div>
							<br>
							<div class="form-group col-xl-4 col-md-6 mb-4 ">
								<input type="text"  id="detalle" class="form-control" name="detalles_otros" title="INTRODUSCA EL DETALLE"  placeholder="Detalle" required />
							</div>
							<div class="form-group col-xl-3 col-md-6 mb-4 ">
								<input type="submit" value="Agregar al carrito" id="agregarbtnotros" class="btn btn-success" name="Agregarotros">
							</div>
						</div>

						<br><br>

						<div class="detalle">
							<table>
								<tr>
									<td><label>Precio unitario</label></td>
									<td><input type="number" name="preciou_otros" ></td>
								</tr>
								<tr>
									<td><label>precio total</label></td>
									<td><input type="number" name="preciot_otros" ></td>
								</tr>
							</table>						
						</div>

					</form>
				</div>
		<!--////////////////////////////////////////////////////////////////////////////////////////////-->
			</div>
		</div>
	</div>		
</div>
</body>
</html>

<?php
}else{
header('Location: http://justo-juez.com/medicion/home.php');
}
}
else
{
header('Location: http://justo-juez.com/medicion');
}
?>