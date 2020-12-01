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
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        	<h1 class="h3 mb-0 text-gray-800">Accesorios</h1>
                    	</div>
						<form id="artf" name="artf">
							<div class="formu estilo">
								<select id="articulosel" name="art" class="form-control">
									<option>Seleccione un articulo</option>
									<?php
									while($racc = mysqli_fetch_array($accesorio)){
										?>
										<option value="<?=$racc['id']?>"><?=utf8_decode ($racc['nombre'])?></option>
										<?php
									}
									?>
								</select>
								<div class="form-group">
									<input type="number"  id="cantpro" class="form-control" name="cantpro" title="Introdusca la cantidad"  placeholder="Cantidad" required />
								</div>
							</div>
							
							<div class="btnproforma">
								<input type="button" value="Agregar al carrito" id="articulobtncat" class="btn btn-success" name="Agregarart">
							</div>
						</form>
					<!--////////////////////////////////////////////////////////////////////////////////////////////-->
				</div>
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