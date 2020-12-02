<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{

	if (!$_GET || $_GET['pagina'] <=0) {
		header('Location:agregar_ubicacion.php?pagina=1');
	}
	require("../php/classProducto.php");
	$idexistesesion= $_SESSION["nombre"];
	$p = new producto();
	$contar_ub =$p->contarub();
	$divisa ="Bs.";
	$articulo_x_pagina = 10;
//echo $contar_ub;
	$paginas = $contar_ub / $articulo_x_pagina;
	$paginas = ceil($paginas);
	$iniciar = ($_GET['pagina']-1) * $articulo_x_pagina;
//echo $iniciar;
	$produc_ubi = $p->buscarproductosub($iniciar,$articulo_x_pagina);
//echo $paginas;
	$nombreusuario=$_SESSION["nombre"];
	if (isset($_SESSION['mensajeerrorproducto'])) {
		$mensajedeerror = $_SESSION['mensajeerrorproducto'];
	}else{
		$mensajedeerror = "";
	}

	$listarproductos = $p->categoriaproducto();
	include "cabeceraProducto.php";
	?>
<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<div class="container-fluid">
					<br>
					<div class="card">
						<div class="card-body">
							<div class="d-sm-flex align-items-center justify-content-between mb-4">
		                        <h1 class="h3 mb-0 text-gray-800">Agregar ubicación</h1>
		                    </div>
							<div><p id="mensajeactualizacion"></p></div>
							<form  id="datosproductosubi" name="datosproductosubi">
								<div class="row">
									<div class="form-group form-group  col-xl-3 col-md-6 mb-4">
										<input type="text" class="form-control" name="ubicacion" title="Ubicacion del producto"  placeholder="ubicacion del producto" required />
									</div>
									<div class="btnproforma form-group">
										<a id="agregarnewproductoubicacion" class="btn btn-success" name="agregarnewproductoubicacion" >  Agregar ubicación</a>
									</div>
								</div>
							</form>
							<div id="row">
								<div class="d-sm-flex align-items-center justify-content-between mb-4">
		                       		 <h1 class="h3 mb-0 text-gray-800">Ubicaciones</h1>
		                    	</div>
									<div id="row">
										<table class="table table-striped">
											<tr>
												<th>Ubicación</th>
											</tr>
											<?php
														while($rinv = mysqli_fetch_array($produc_ubi)){
															?>
															<tr>
																<td><?=utf8_encode($rinv['ubicacion'])?></td>
															</tr>
															<?php
														}
														?>
										</table>
										<nav aria-label="Page navigation example">
										  <ul class="pagination">
										    <li class="page-item <?php echo $_GET['pagina']<= 1? 'disabled' : '' ?>"><a class="page-link" href="agregar_ubicacion.php?pagina=<?php echo $_GET['pagina'] - 1?>">Anterior</a></li>
										    <?php for ($i=0; $i < $paginas; $i++) {  ?>
										    <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : ''?>">
										    	<a class="page-link" href="agregar_ubicacion.php?pagina=<?php echo $i+1; ?>">
										    		<?php echo $i+1; ?>
										    	</a>
										    </li>
										    <?php }
										     $paginas = $paginas - 1; ?>
										    <li class="page-item <?php echo $_GET['pagina']>= $paginas? 'disabled' : '' ?>"><a class="page-link" href="agregar_ubicacion.php?pagina=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>">Siguiente</a></li>
										  </ul>
										</nav>	
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