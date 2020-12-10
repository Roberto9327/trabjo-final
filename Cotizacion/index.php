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
							<form  id="fcategoria" name="fcategoria" >
								<div class="row">
									<div class="form-group col-xl-5 col-md-6 mb-4">
										<select id="categoria" name="cat" class="form-control">
											<option value="0" >seleccione una categoria</option>
											<?php
											// $cats = $mysqli->query("SELECT * FROM trabajos ORDER BY detalle ASC");
											while($rcat = mysqli_fetch_array($cats)){
												?>
												<option value="<?=$rcat['id']?>"><?=$rcat['detalle']?></option>
												<?php
											}
											?>
										</select>
									</div>
									<div class="form-group col-xl-3 col-md-6 mb-4">
										<a class="btn btn-info btn-icon-split" id="buscarcat" >
											<span class="text">
													Buscar categoria
											</span>
										</a>
									</div>
								</div>
								
							</form>
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
			                   <h1 class="h3 mb-0 text-gray-800">Detalle</h1>
			              </div>
						<form method="post" action="" id="datostrab" name="datostrab">
							<div class="row">
								<div class="form-group col-xl-2 col-md-6 mb-4">
									<input type="number"  id="ancho" class="form-control" class="ancho" name="ancho" title="INTRODUSCA EL ANCHO EN MM"  placeholder="Ancho" required />
								</div>
								<div class="form-group col-xl-2 col-md-6 mb-4">
									<input type="number"  id="alto" class="form-control" class="alto" name="alto" title="INTRODUSCA EL ALTO EN MM"  placeholder="Alto" required />
								</div>
								<div class="form-group col-xl-2 col-md-6 mb-4">
									<input type="number"  id="cantidad" class="form-control" class="cantidad" name="cantidad" title="INTRODUSCA LA CANTIDAD DE PUERTAS O VENTANAS"  placeholder="Cantidad" required />
								</div>
								<div  class="form-group col-xl-4 col-md-6 mb-4">
									<select  class="form-control" id="cotizar" class="cotizar" name="cotizar" onchange="cotizar();">
										<option value="">Seleccione una opcion</option>
										<?php
										while($rcat2 = mysqli_fetch_array($tipo)){
											var_dump($rcat2);
											?>
											<option value="<?=$rcat2['nombre']?>" >
												<span ><?=$rcat2['nombre']?></span>
											</option>
											<?php
											}
											?>
									</select>
								</div>
								<br>
							</div>
							<div>
								<div class="input__row">
									<ul class="buttons">
										<li>
											<input id="radiobtn_1" class="radiobtn" name="precio" type="radio" value="uno" tabindex="1" checked="">
											<span></span>
											<label for="radiobtn_1">Uno</label>
										</li>
										<li>
											<input id="radiobtn_2" class="radiobtn" name="precio" type="radio" value="mas de tres" tabindex="2">
											<span></span>
											<label for="radiobtn_2">Más de tres</label>
										</li>
									</ul>
								</div>
								<div class="btnproforma">
									<input type="button" value="Cotizar medidas" id="cotizarbtn" class="btn btn-success" name="">

									<input type="submit" value="Agregar al carrito" id="agregarbtn" class="btn btn-success agregarbtn" name="Agregar">
								</div>
							</div>

							<br><br>

							<div class="detalle">
								<p id="preciounitario"></p>
								<p id="preciototal"></p>
							</div>

						</form>
					</div>	
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