<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
	if (!$_GET ) {
		header('Location:ver_proforma.php?pagina=1');
	}
include "../php/classProforma.php";
$p = new proforma();
$idProforma = $_GET['id'];
$buscarProforma = $p->buscarProforma($idProforma);
$fila=mysqli_fetch_array($buscarProforma);
$nombre = $fila[1];
$cliente = $fila[2];
$fecha = $fila[3];
$divisa ="Bs.";
if ($cliente == 0) {
	$nombreC="S/N";
	$telefonoC="S/N";
}else{
	$clientes= $p->buscarCliente($cliente);
	$filas=mysqli_fetch_array($clientes);
	$nombreC = $filas[1];
	$telefonoC = $filas[2];
}
$cont_proforma = $p->contenidoProforma($idProforma);
include "cabeceraProforma.php";
?>
<div id="content-wrapper" class="d-flex flex-column">
		<div id="content">
			<div class="container-fluid"><br>
				<div class="card">
					<div class="card-body">
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
		                   <h1 class="h3 mb-0 text-gray-800">Cotización</h1>
		             	</div>
						<table class="tabla">
							<tr>
								<td><b>Nombre:</b></td>
								<td><?=$nombreC?></td>
							</tr>
							<tr>
								<td><b>Telefono:</b></td>
								<td><?=$telefonoC?></td>
							</tr>
						</table>
						<table id="tabla" class="table table-striped">
											<tr>
												<th class="titulotabla">Ancho</th>
												<th class="titulotabla">Alto</th>
												<th class="titulotabla">Nombre del producto</th>
												<th class="titulotabla">Cantidad</th>
												<th class="titulotabla">Precio por unidad</th>
												<th class="titulotabla">Precio Total</th>
											</tr>
											<?php
											$monto_total = 0;
											while($rcom = mysqli_fetch_array($cont_proforma)){
												$monto_total = $monto_total + $rcom['preciot'];
												?>
												<tr>
													<td>
														<?php
															if ($rcom['ancho'] == 0) {
																?>
																------
																<?php
															}else{
																?>
																<?=$rcom['ancho']?>
																<?php
															}
														?>
													</td>
													<td>
														<?php
															if ($rcom['alto'] == 0) {
																?>
																------
																<?php
															}else{
																?>
																<?=$rcom['alto']?>
																<?php
															}
														?>
													</td>
													<td><?=$rcom['detalle']?></td>
													<td><?=$rcom['cantidad']?></td>
													<td><?=$rcom['preciou']?>  <?=$divisa?></td>
													<td><?=$rcom['preciot']?>  <?=$divisa?></td>
												</tr>
												<?php
											}
											?>
										</table>
										<h2>Monto Total: <b class="text-green"><?=$monto_total?> <?=$divisa?></b></h2>
</div>
</div>
</div>
</div>
</div>
<?php
// header('Location: http://justo-juez.com/medicion/PanelAdmin/Proforma/ver_proforma.php?pagina=1');
}
else
{
	header('Location: http://justo-juez.com/medicion');
} 
?>