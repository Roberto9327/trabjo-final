<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
	$nombreusuario=$_SESSION["nombre"];
	require("../php/classProforma.php");
	$p = new proforma();
	$divisa = "Bs.";
	if (!$_GET ) {
			echo "<script>location.href='ver_proforma.php?pagina=1'</script>";
		}
	
	/*$listar_reporte = $p->reporteTotalProducto($date1,$date2,$iniciar,$articulo_x_pagina);*/
	include "cabeceraProforma.php";
	?>
</div>
<div id="contenidos">
<div id="contenidos2">
	<h1>Reportes</h1>
	<form class="form-inline" method="POST" action="">
			<label>Buscar por nombre:</label>
			<input type="text" class="form-control" placeholder="Buscar por nombre"  name="nombreProducto"/>
			<label>Fecha Desde:</label>
			<input type="date" class="form-control" placeholder="Start"  name="date1"/>
			<label>Hasta</label>
			<input type="date" class="form-control" placeholder="End"  name="date2"/>
			<button class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search"></span></button> <a href="ver_proforma.php?pagina=1" type="button" class="btn btn-success"><span class = "glyphicon glyphicon-refresh"><span></a>
	</form>
				<table class="table table-striped">
					<tr>
						<th>Nombre</th>
						<th>fecha</th>
						<th>Accion</th>
					</tr>
					<?php include'range.php';?>	
				</table>
	
				<?php 
				if (!isset($n)) {
					?>
						<p>Realizar la busqueda de registro</p>
					<?php
				}
				if (isset($n)) {
					?>

						<nav aria-label="Page navigation example">
							<ul class="pagination">
								<li  class="page-item <?php echo $_GET['pagina']<= 1? 'disabled' : '' ?>"><a class="page-link" href="ver_proforma.php?pagina=<?php echo $_GET['pagina'] - 1?>&paginacion=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>">Anterior</a></li>


								<?php for ($i=0; $i < $paginas; $i++) {  ?>
									<li  class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : ''?>">
										<a class="page-link" href="ver_proforma.php?pagina=<?php echo $i+1; ?>&paginacion=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>">
											<?php echo $i+1; ?>
										</a>
									</li>


								<?php }
							      $paginas = $paginas - 1; ?>
							     <li  class="page-item <?php echo $_GET['pagina']>= $paginas+1? 'disabled' : '' ?>"><a class="page-link" href="ver_proforma.php?pagina=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>&paginacion=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>">Siguiente</a></li>
							 </ul>
						</nav>
					<?php 
				}
				?>
		<a target="_blank" href="generar_pdf.php" class=" btn btn-success">Generar reporte en pdf</a>
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