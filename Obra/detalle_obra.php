<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]))
{
	if (!$_GET ) {
		header('Location:ver_obra.php?pagina=1');
	}
include "classobra.php";
$p = new obra();
$idObra = $_GET['id'];
$buscarobras = $p->buscarObra($idObra);
$fila=mysqli_fetch_array($buscarobras);
$nombreobra = $fila[1];
$idcotizacion = $fila[2];

$idbuscarcotizacion = $p->buscarcotizacion($idcotizacion);
$filacot = mysqli_fetch_array($idbuscarcotizacion);
$cliente = $filacot[2];

$buscarnombredecliente = $p->buscarCliente($cliente);
$filacli=mysqli_fetch_array($buscarnombredecliente);
	$idcliente = $filacli[0];
	$nombreC =  $filacli[1];
	$telefonoC =  $filacli[2];
	$nit =  $filacli[3];
	$divisa ="Bs.";
/*if ($cliente == 0) {
	$nombreC="S/N";
	$telefonoC="S/N";
}else{
	$clientes= $p->buscarCliente($cliente);
	$filas=mysqli_fetch_array($clientes);
	$idcliente =$filas[0];
	$nombreC = $filas[1];
	$telefonoC = $filas[2];
	$nit = $filas[3];
}*/
$cont_obra = $p->contenidoobra($idObra);
$cont_pago = $p->contenidopago($idObra,$idcliente);
$productoproforma = $p->listarproductosproforma($idcotizacion);
$productoproformae = $p->listarproductosproformae($idcotizacion);
include "cabeceraobra.php";
?>
<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
			  <div class="container-fluid"><br>
				<br>
				<div class="d-sm-flex align-items-center justify-content-between mb-4">
                   <h1 class="h3 mb-0 text-gray-800">Detalle de obra de trabajo</h1>
                </div>
				<table class="table table-striped">
					<tr>
						<td class="titulotabla"><b>Obra:</b></td>
						<td class="titulotabla"><b>Cliente:</b></td>
						<td class="titulotabla"><b>Telefono:</b></td>
						<td class="titulotabla"><b>Nit:</b></td>
					</tr>
					<tr>
						<td ><?=$nombreobra?></td>
						<td><?=$nombreC?></td>
						<td><?=$telefonoC?></td>
						<td><?=$nit?></td>
					</tr>
				</table>
				<div class="d-sm-flex align-items-center justify-content-between mb-4">
                   <h1 id="desplegar" class="h3 mb-0 text-gray-800">registrar Productos<img src="../img/desplegar.gif" style="width:20px"></h1>
                </div>
				<form id="fformuagregar" name="fformuagregar">
					<div class="row">
						<div class="form-group col-xl-3 col-md-6 mb-4">
							<input type="text"  id="detalle" name="detalle" class="form-control"  title="INTRODUSCA EL DETALLE DE LA COMPRA"  placeholder="Introdusca el detalle de la compra" required />
						</div>
						<div class="form-group col-xl-3 col-md-6 mb-4">
							<input type="text"  id="cantidad" name="cantidad" class="form-control"  title="INTRODUSCA LA CANTIDAD"  placeholder="Introdusca la cantidad de la compra" required />
						</div>
						<div class="form-group col-xl-3 col-md-6 mb-4">
							<input type="text"  id="precio" name="precio" class="form-control"  title="INTRODUSCA EL PRECIO"  placeholder="Introdusca el precio de la compra" required />
						</div>
						<div class="form-group">
							<input type="hidden"  id="idobra" name="idobra" value="<?=$idObra?>" />
						</div>
						<div class="form-group col-xl-3 col-md-6 mb-4">
							<a class="btn btn-success btn-icon-split" id="ingresarDatosdecompra" >
								<span class="text">
									insertar Producto
								</span>
							</a>
						</div>
					</div>
				</form>
					<table id="tabla" class="table table-striped">
						<tr>
							<th class="titulotabla">Detalle</th>
							<th class="titulotabla">Cantidad</th>
							<th class="titulotabla">Precio</th>
							<th class="titulotabla">Fecha</th>
						</tr>
						<?php
						$monto_total = 0;
						while($rcom = mysqli_fetch_array($cont_obra)){
							$monto_total = $monto_total + $rcom['precio'];
							?>
							<tr>
								<td><?=$rcom['nombre']?></td>
								<td><?=$rcom['cantidad']?></td>
								<td><?=$rcom['precio']?> <?=$divisa?></td>
								<td><?=$rcom['fecha']?></td>
							</tr>
							<?php
						}
						?>
					</table>
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
                   		<h1 id="desplegar1" class="h3 mb-0 text-gray-800">registrar pagos del cliente<img src="../img/desplegar.gif" style="width:20px"></h1>
                	</div>
					<form id="fformuagregarpago" name="fformuagregarpago">
						<div class="row">
							<div class="form-group col-xl-3 col-md-6 mb-4">
								<input type="text"  id="detallep" name="detallep" class="form-control"  title="INTRODUSCA EL DETALLE DEL PAGO"  placeholder="Introdusca el detalle del pago" required />
							</div>
							<div class="form-group col-xl-3 col-md-6 mb-4">
								<input type="text"  id="montop" name="montop" class="form-control"  title="INTRODUSCA EL MONTO"  placeholder="Introdusca el monto" required />
							</div>
							<div class="form-group">
								<input type="hidden"  id="idcliente" name="idcliente" value="<?=$idcliente?>" />
							</div>
							<div class="form-group">
								<input type="hidden"  id="idobra" name="idobra" value="<?=$idObra?>" />
							</div>
							<div class="form-group col-xl-3 col-md-6 mb-4">
								<a  class="btn btn-success btn-icon-split" id="ingresarDatosdepago" >
									<span class="text">
										Registrar pago
									</span>
								</a>
							</div>
						</div>
						
						
					</form>
					<table  class="table table-striped">
						<tr>
							<th class="titulotabla">Detalle</th>
							<th class="titulotabla">monto</th>
							<th class="titulotabla">fecha</th>
						</tr>
						<?php
						$monto_total_pago = 0;
						while($rpag = mysqli_fetch_array($cont_pago)){
							$monto_total_pago = $monto_total_pago + $rpag['monto'];
							?>
							<tr>
								<td><?=$rpag['detalle']?></td>
								<td><?=$rpag['monto']?> <?=$divisa?></td>
								<td><?=$rpag['fecha']?></td>
							</tr>
							<?php
						}
						?>
					</table>
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
                   		<h1  class="h3 mb-0 text-gray-800">Productos de la Cotización <img src="../img/desplegar.gif" style="width:20px"></h1>
                	</div>
					<table class="table table-striped">
					<tr>
						<th class="titulotabla">Ancho</th>
						<th class="titulotabla">Alto</th>
						<th class="titulotabla">Nombre del producto</th>
						<th class="titulotabla">Cantidad</th>
						<th class="titulotabla">Precio por unidad</th>
						<th class="titulotabla">Precio Total</th>
					</tr>
					<?php
			// $cats = $mysqli->query("SELECT * FROM trabajos ORDER BY detalle ASC");
					$monto_total_proforma = 0;
					while($rprof = mysqli_fetch_array($productoproforma)){
						$monto_total_proforma = $monto_total_proforma + $rprof['preciot'];
						?>
						<tr>
							<td><?=$rprof['ancho']?></td>
							<td><?=$rprof['alto']?></td>
							<td><?=$rprof['detalle']?></td>
							<td><?=$rprof['cantidad']?></td>
							<td><?=$rprof['preciou']?>  <?=$divisa?></td>
							<td><?=$rprof['preciot']?>  <?=$divisa?></td>
						</tr>
						<?php
					}
					?>
				</table>
				<div class="d-sm-flex align-items-center justify-content-between mb-4">
                   	<h1 id="desplegar2" class="h3 mb-0 text-gray-800">Registrar Adicionales <img src="../img/desplegar.gif" style="width:20px"></h1>
                </div>
				<form id="fformuextra" name="fformuextra">
					<div class="row">
						<div class="form-group col-xl-3 col-md-6 mb-4">
							<input type="text"  id="anchoe" name="anchoe" class="form-control"  title="INTRODUSCA EL ANCHO"  placeholder="Introdusca el ancho" required />
						</div>
						<div class="form-group col-xl-3 col-md-6 mb-4">
							<input type="text"  id="altoe" name="altoe" class="form-control"  title="INTRODUSCA EL ALTO"  placeholder="Introdusca el alto" required />
						</div>
						<div class="form-group col-xl-3 col-md-6 mb-4">
							<input type="text"  id="detallee" name="detallee"  class="form-control"  title="INTRODUSCA EL DETALLE"  placeholder="Introdusca el detalle" required />
						</div>
						<div class="form-group col-xl-3 col-md-6 mb-4">
							<input type="text"  id="cantidade" name="cantidade" class="form-control"  title="INTRODUSCA LA CANTIDAD"  placeholder="Introdusca la cantidad" required />
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xl-3 col-md-6 mb-4">
							<input type="text"  id="precuiunie" name="precuiunie" class="form-control"  title="INTRODUSCA EL PRECIO UNITARIO"  placeholder="Introdusca el precio unitario" required />
						</div>
						<div class="form-group col-xl-3 col-md-6 mb-4">
							<input type="text"  id="preciotote" name="preciotote" class="form-control"  title="INTRODUSCA EL PRECIO TOTAL"  placeholder="Introdusca el precio total" required />
						</div>
						<div class="form-group">
							<input type="hidden"  id="idproe" name="idproe" value="<?=$productopro?>" />
						</div><div class="form-group">
							<input type="hidden"  id="idobre" name="idobre" value="<?=$idObra?>" />
						</div>
						<div class="form-group col-xl-3 col-md-6 mb-4">
							<a class="btn btn-success btn-icon-split" id="ingresardatosextras" >
								<span class="text">
									Registrar Adicionales
								</span>
							</a>
						</div>
					</div>
					</form>
					
					<table class="table table-striped">
					<tr>
						<th class="titulotabla">Ancho</th>
						<th class="titulotabla">Alto</th>
						<th class="titulotabla">Nombre del producto</th>
						<th class="titulotabla">Cantidad</th>
						<th class="titulotabla">Precio por unidad</th>
						<th class="titulotabla">Precio Total</th>
					</tr>
					<?php
			// $cats = $mysqli->query("SELECT * FROM trabajos ORDER BY detalle ASC");
					$monto_total_proformae = 0;
					while($rprofe = mysqli_fetch_array($productoproformae)){
						$monto_total_proformae = $monto_total_proformae + $rprofe['preciot'];
						?>
						<tr>
							<td><?=$rprofe['ancho']?></td>
							<td><?=$rprofe['alto']?></td>
							<td><?=$rprofe['detalle']?></td>
							<td><?=$rprofe['cantidad']?></td>
							<td><?=$rprofe['preciou']?>  <?=$divisa?></td>
							<td><?=$rprofe['preciot']?>  <?=$divisa?></td>
						</tr>
						<?php
					}
					?>
				</table>
				<div class="d-sm-flex align-items-center justify-content-between mb-4">
                   	<h1 id="desplegar2" class="h3 mb-0 text-gray-800">Detalle de movimiento<img src="../img/desplegar.gif" style="width:20px"></h1>
                </div>
					<?php
					$monto_total_proforma = $monto_total_proforma + $monto_total_proformae;			
					?>
					<table class="table table-striped   col-xl-4 col-md-6 mb-4">
						<tr>
							<td class="titulotabla">Monto Total compras:</td>
							<td><b class="text-green"><?=$monto_total?> <?=$divisa?></b></td>
						</tr>
						<tr>
							<td class="titulotabla">Monto pagado:</td>
							<td><b class="text-green"><?=$monto_total_pago?> <?=$divisa?></b></td>
						</tr>
						<tr>
							<td class="titulotabla">Deuda del Cliente:</td>
							<td>
								<?php
								$saldo = $monto_total_proforma - $monto_total_pago;
								?>

								<b class="mensage-green"><?=$saldo?> <?=$divisa?></b>
							</td>
						</tr>
						<tr>
							<td class="titulotabla">Monto Total obra:</td>
							<td><b class="text-green"><?=$monto_total_proforma?> <?=$divisa?></b></td>
						</tr>
						<?php
							if ($monto_total < $monto_total_proforma) {
								$diferencia = $monto_total_proforma - $monto_total;
								?>
								<tr>
									<td class="titulotabla">Se tiene una ganancia de:</td>
									<td><b class="mensage-green"><?=$diferencia?> <?=$divisa?></b></td>
								</tr>
								<?php
							}
							if ($monto_total > $monto_total_proforma) {
								$diferencia = $monto_total_proforma - $monto_total;
								?>
								<tr>
									<td class="titulotabla">Se tiene una perdida de:</td>
									<td><b class="mensage-red"><?=$diferencia?> <?=$divisa?></b></td>
								</tr>
								<?php
							}
						?>
					</table>
					<a target="_blank" href="generar_pdf.php?id=<?=$idObra?>" class=" btn btn-success">Generar pdf</a>

</div><br>
	
</div>
<?php
// header('Location: http://justo-juez.com/medicion/PanelAdmin/Proforma/ver_proforma.php?pagina=1');
}
else
{
	header('Location: http://justo-juez.com/medicion');
} 
?>