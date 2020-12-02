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
	$divisa = "Bs.";
	if (!$_GET ) {
			echo "<script>location.href='reportes_ventas.php?pagina=1'</script>";
		}
	
	/*$listar_reporte = $p->reporteTotalProducto($date1,$date2,$iniciar,$articulo_x_pagina);*/
	include "cabeceraProducto.php";
	?>
<div id="content-wrapper" class="d-flex flex-column">
		<div id="content">
			<div class="container-fluid"><br>
				<div class="card">
					<div class="card-body">
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
		                   <h1 class="h3 mb-0 text-gray-800">Reportres</h1>
		             	</div>
						<form class="form-inline" method="POST" action="">
							<div class="row">
								<div class="form-group  col-xl-3 col-md-6 mb-4">
									<label>Buscar por nombre:</label>
									<input type="text" class="form-control" placeholder="Buscar por nombre"  name="nombreProducto"/>
								</div>
								<div class="form-group  col-xl-3 col-md-6 mb-4">
									<label>Fecha Desde:</label>
									<input type="date" class="form-control" placeholder="Start"  name="date1"/>
								</div>
								<div class="form-group  col-xl-3  col-md-6 mb-4">
									<label>Hasta:</label>
									<input type="date" class="form-control" placeholder="End"  name="date2"/>
								</div>
							</div>	
							<div class="row">
								<div class="form-group  col-xl-4 col-md-6 mb-4">
									<div class=" form-group">
										<button class="btn btn-info btn-icon-split" name="search" style="margin: 3px;">
											<span class="text">
												<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			  										<path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
			  										<path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
												</svg>
												Buscar
											</span>
										</button>
										<a href="reportes_ventas.php?pagina=1" type="button" class="btn btn-primary btn-icon-split" style="margin: 3px;">
											<span class="text">
												<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-counterclockwise" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			  										<path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
			  										<path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
												</svg>
												Refrescar
											</span>	
										</a>
									</div>
								</div>
							</div>
								
							
								
						</form>
				<table class="table table-striped">
					<tr>
						<th class="titulotabla">Nombre del producto</th>
						<th class="titulotabla">Cantidad</th>
						<th class="titulotabla">Precio por unidad</th>
						<th class="titulotabla">Precio Total</th>
						<th class="titulotabla">Fecha</th>
					</tr>
					<?php include'range.php';?>	
				</table>
	
				<?php 
				if (!isset($preciototal)) {
					?>
						<p>Realizar la busqueda de registro</p>
					<?php
				}
				if (isset($preciototal)) {
					?>
						<h2>Total Ventas <?=$preciototal?> <?=$divisa?></h2>

						<nav aria-label="Page navigation example">
							<ul class="pagination">
								<li  class="page-item <?php echo $_GET['pagina']<= 1? 'disabled' : '' ?>"><a class="page-link" href="reportes_ventas.php?pagina=<?php echo $_GET['pagina'] - 1?>&paginacion=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>">Anterior</a></li>


								<?php for ($i=0; $i < $paginas; $i++) {  ?>
									<li  class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : ''?>">
										<a class="page-link" href="reportes_ventas.php?pagina=<?php echo $i+1; ?>&paginacion=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>">
											<?php echo $i+1; ?>
										</a>
									</li>


								<?php }
							      $paginas = $paginas - 1; ?>
							     <li  class="page-item <?php echo $_GET['pagina']>= $paginas+1? 'disabled' : '' ?>"><a class="page-link" href="reportes_ventas.php?pagina=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>&paginacion=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>">Siguiente</a></li>
							 </ul>
						</nav>
					<?php 
				}
				?>
		<a target="_blank" href="generar_pdf.php" class=" btn btn-success">Generar reporte en pdf</a>
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