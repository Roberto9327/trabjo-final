<?php 
session_start();

if(isset($_SESSION["nombre"]))
{

	$nombreusuario=$_SESSION["nombre"];
	include "cabeceracotizacion.php"; 
	//$idproforma=$_SESSION["idproforma"];
	//$nombreproforma=$_SESSION["nombreproforma"];
	$divisa = "Bs.";
	require("classProforma.php");
	$p = new proforma();
	$cats = $p->categoriaproducto();
	//$carrit = $p->buscardetalle($idproforma);
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

	if (isset($_SESSION["nombrecliente"])) {
		$nombredelcliente=$_SESSION["nombrecliente"];
		$telefonodelcliente=$_SESSION["telefonocliente"];
		$nitckiente = $_SESSION["nitcliente"];
	}else{
		$nombredelcliente="S/N";
		$telefonodelcliente="S/N";
	}
	
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
                    	<table class="table table-striped">
										<tr>
											<th class="titulotabla">Código</th>
											<th class="titulotabla">Descripción</th>
											<th class="titulotabla">Precio Venta</th>
											<th class="titulotabla">Existencia</th>
											<th class="titulotabla">Añadir a compras</th>
										</tr>
										<?php
											while($rinv = mysqli_fetch_array($accesorio)){
										?>
											<tr>
												<td class="mayuscula">PRO  <?=$rinv['id']?></td>
												<td class="mayuscula"><?=utf8_encode($rinv['nombre'])?></td>
												<td class="mayuscula"><?=$rinv['precio']?> <?=$divisa?></td>
												<td class="mayuscula"><?=$rinv['cantidad']?></td>
												<td style="width:12%;" class="mayuscula"><input type="hidden" value="<?=$rinv['id']?>" class="valiv"><a class="vent"><img src="../img/vender.png"></a></td>
											</tr>
										<?php
										}
										?>

						</table>
						
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
header('Location: http://localhost/medicion');
}
?>