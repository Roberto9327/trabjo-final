<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{

	if (!$_GET || $_GET['pagina'] <=0) {
		header('Location:agregar_categoria.php?pagina=1');
	}
	require("../php/classProducto.php");
	$idexistesesion= $_SESSION["nombre"];
	$p = new producto();
	$contar_inv =$p->contarinv();
	$divisa ="Bs.";
	$articulo_x_pagina = 5;
//echo $contar_inv;
	$paginas = $contar_inv / $articulo_x_pagina;
	$paginas = ceil($paginas);
	$iniciar = ($_GET['pagina']-1) * $articulo_x_pagina;
//echo $iniciar;
	$inventariopro = $p->buscarproductoscat($iniciar,$articulo_x_pagina);
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
		                        <h1 class="h3 mb-0 text-gray-800">Agregar categorias</h1>
		                    </div>
							<div><p id="mensajeactualizacion"></p></div>
							<form  id="datosproductoscat" name="datosproductoscat">
								<div class="row">
									<div class="form-group  col-xl-3 col-md-6 mb-4">
										<input type="text" class="form-control" name="detalle" title="Nombre categoria"  placeholder="Nombre categoria" required />
									</div>
									<div class="form-group  col-xl-3 col-md-6 mb-4">
										<a id="agregarnewproductocategoria" class="btn btn-success" name="agregarnewproductocategoria" >
										  Agregar categoria
										</a>
									</div>
								</div>
								<div>
								</div>
							</form>
							<div id="row">
								<div class="d-sm-flex align-items-center justify-content-between mb-4">
		                        	<h1 class="h3 mb-0 text-gray-800">Categorias</h1>
		                    	</div>
										<table class="table table-striped">
											<tr>
												<th class="titulotabla">Categoria</th>
												<th class="titulotabla">Acción</th>
											</tr>
											<?php
														while($rinv = mysqli_fetch_array($inventariopro)){
															?>
															<tr>
																<td class="mayuscula"><?=utf8_encode($rinv['detalle'])?></td>
																<td>---</td>
															</tr>
															<?php
														}
														?>
										</table>
										<nav aria-label="Page navigation example">
										  <ul class="pagination">
										    <li class="page-item <?php echo $_GET['pagina']<= 1? 'disabled' : '' ?>"><a class="page-link" href="agregar_categoria.php?pagina=<?php echo $_GET['pagina'] - 1?>">Anterior</a></li>
										    <?php for ($i=0; $i < $paginas; $i++) {  ?>
										    <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : ''?>">
										    	<a class="page-link" href="agregar_categoria.php?pagina=<?php echo $i+1; ?>">
										    		<?php echo $i+1; ?>
										    	</a>
										    </li>
										    <?php }
										     $paginas = $paginas - 1; ?>
										    <li class="page-item <?php echo $_GET['pagina']>= $paginas? 'disabled' : '' ?>"><a class="page-link" href="agregar_categoria.php?pagina=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>">Siguiente</a></li>
										  </ul>
										</nav>	
							</div>
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