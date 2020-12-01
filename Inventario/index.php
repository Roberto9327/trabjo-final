<?php
header('Content-type: text/html; charset=utf-8');
session_start();

if(isset($_SESSION["nombre"]))
{
	if (!$_GET || $_GET['pagina'] <=0) {
		header('Location:index.php?pagina=1');
	}
	$idexistesesion= $_SESSION["nombre"];
	//include "cabecerainventario.php"; 
	include "cabecerainventario.php"; 
	require("classInventario.php");
	$p = new inventario();
	$contar_inv =$p->contarinv();
	$divisa ="Bs.";
	$articulo_x_pagina = 10;
	//echo $contar_inv;
	$paginas = $contar_inv / $articulo_x_pagina;
	$paginas = ceil($paginas);
	$iniciar = ($_GET['pagina']-1) * $articulo_x_pagina;
	//echo $iniciar;
	$inventariopro = $p->buscarproductos($iniciar,$articulo_x_pagina);
	//echo $paginas;
	?>
	<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<div class="container-fluid">
					<br>
			  		<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Inventario</h1>
                    </div>
						<div id="tablainv" class="table-responsive-xl">
							<table class="table table-striped">
								<tr>
									<th class="titulotabla">Nombre</th>
									<th class="titulotabla">Precio</th>
									<th class="titulotabla">Cantidad</th>
								</tr>
								<?php
											while($rinv = mysqli_fetch_array($inventariopro)){
												?>
												<tr>
													<td><?=utf8_encode($rinv['nombre'])?></td>
													<td><?=$rinv['precio']?> <?=$divisa?></td>
													<td><?=$rinv['cantidad']?></td>
												</tr>
												<?php
											}
											?>
							</table>
							<nav aria-label="Page navigation example">
							  <ul class="pagination">
							    <li class="page-item <?php echo $_GET['pagina']<= 1? 'disabled' : '' ?>"><a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina'] - 1?>">Anterior</a></li>
							    <?php for ($i=0; $i < $paginas; $i++) {  ?>
							    <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : ''?>">
							    	<a class="page-link" href="index.php?pagina=<?php echo $i+1; ?>">
							    		<?php echo $i+1; ?>
							    	</a>
							    </li>
							    <?php }
							     $paginas = $paginas - 1; ?>
							    <li class="page-item <?php echo $_GET['pagina']>= $paginas? 'disabled' : '' ?>"><a class="page-link" href="index.php?pagina=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>">Siguiente</a></li>
							  </ul>
							</nav>	
						</div>
				</div>
			</div>
	</div>
</div>
	<?php




}
else
{
header('Location: http://localhost/medicion/');
}
?>