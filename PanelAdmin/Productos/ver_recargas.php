<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
	$nombreusuario=$_SESSION["nombre"];
	require("../php/classProducto.php");
	$p = new producto();
	if (isset($_SESSION['mensajeerrorproducto'])) {
	 	$mensajedeerror = $_SESSION['mensajeerrorproducto'];
	 }else{
	 	$mensajedeerror = "";
	 }
	$contar_rec =$p->contarrecarga();
	$articulo_x_pagina = 10;
	//echo $contar_rec;
	$paginas = $contar_rec / $articulo_x_pagina;
	$paginas = ceil($paginas);
	if (!$_GET || $_GET['pagina'] <=0 ||$_GET['pagina'] > $paginas) {
		header('Location:ver_recargas.php?pagina=1');
	}
	$iniciar = ($_GET['pagina']-1) * $articulo_x_pagina;
	$listar_recargas = $p->cantidadTotalrecargas($iniciar,$articulo_x_pagina);
	include "cabeceraProducto.php";
	?>
<div id="content-wrapper" class="d-flex flex-column">
		<div id="content">
			<div class="container-fluid"><br>
				<div class="card">
					<div class="card-body">
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
		                   <h1 class="h3 mb-0 text-gray-800">Lista de recargas de stock</h1>
		             	</div>
						<table id="tabla" class="table table-striped">
							<tr>
								<th class="titulotabla">Documento</th>
								<th class="titulotabla"># Doc.</th>
								<th class="titulotabla">Productos</th>
								<th class="titulotabla">Proveedores</th>
								<th class="titulotabla">Cantidad</th>
								<th class="titulotabla">Fecha</th>
								<th class="titulotabla">Obcervaciones</th>
								<th class="titulotabla">Estado</th>
							</tr>
							<?php
							while($rcom = mysqli_fetch_array($listar_recargas)){
								?>
								<tr>
									<td class="mayuscula"><?=$rcom['documento']?></td>
									<td class="mayuscula"><?=$rcom['num_documento']?></td>
									<td class="mayuscula"><?=$rcom['nombreproducto']?></td>
									<td class="mayuscula"><?=$rcom['nombreproveedor']?></td>
									<td class="mayuscula"><?=$rcom['cantidad']?></td>
									<td class="mayuscula"><?=$rcom['fecha']?></td>
									<td class="mayuscula"><?=$rcom['obcervaciones']?></td>
									<td>
										<?php
											if ($rcom['estado'] == 0 ) {
												?>
												<img src="../img/deshabilitado.png" width="100px">
												<?php
											}else{
												?>
												<img src="../img/habilitado.png" width="100px">
												<?php
											}
										?>
									</td>
								</tr>
								<?php
							}
							?>
						</table>
						<div><p id="mensajeactualizacion"></p></div>
						<nav aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item <?php echo $_GET['pagina']<= 1? 'disabled' : '' ?>"><a class="page-link" href="ver_recargas.php?pagina=<?php echo $_GET['pagina'] - 1?>">Anterior</a></li>


								<?php for ($i=0; $i < $paginas; $i++) {  ?>
									<li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : ''?>">
										<a class="page-link" href="ver_recargas.php?pagina=<?php echo $i+1; ?>">
											<?php echo $i+1; ?>
										</a>
									</li>


								<?php }
							      $paginas = $paginas - 1; ?>
							     <li class="page-item <?php echo $_GET['pagina']>= $paginas+1? 'disabled' : '' ?>"><a class="page-link" href="ver_recargas.php?pagina=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>">Siguiente</a></li>
							 </ul>
							</nav>
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