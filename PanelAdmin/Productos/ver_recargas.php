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
</div>
<div id="contenidos">
	<h1>Lista de recargas de stock</h1>
	<table id="tabla" class="table table-striped">
		<tr>
			<th>Productos</th>
			<th>Proveedores</th>
			<th>Cantidad</th>
			<th>precio unitario</th>
			<th>precio total</th>
			<th>Fecha</th>
			<th>Estado</th>
		</tr>
		<?php
		while($rcom = mysqli_fetch_array($listar_recargas)){
			?>
			<tr>
				<td><?=$rcom['nombreproducto']?></td>
				<td><?=$rcom['nombreproveedor']?></td>
				<td><?=$rcom['cantidad']?></td>
				<td><?=$rcom['preciou']?></td>
				<td><?=$rcom['preciot']?></td>
				<td><?=$rcom['fecha']?></td>
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
</body>
</html>
<?php
}
else
{
	header('Location: http://justo-juez.com/medicion');
} 
?>