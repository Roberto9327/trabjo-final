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
	
	$contar_inv =$p->contarpronew();
	$articulo_x_pagina = 10;
	//echo $contar_inv;
	$paginas = $contar_inv / $articulo_x_pagina;
	$paginas = ceil($paginas);
	if ($paginas <> 0) {
		if ($_GET['pagina'] > $paginas) {
			header('Location:ver_productos.php?pagina=1');
		}
	}
	if (!$_GET || $_GET['pagina'] <= 0  ) {
		header('Location:ver_productos.php?pagina=1');
	}
	$iniciar = ($_GET['pagina']-1) * $articulo_x_pagina;
	$listar_productos_new = $p->cantidadTotalProductonew($iniciar,$articulo_x_pagina);
	include "cabeceraProducto.php";
	?>
</div>
<div id="contenidos">
	<h1>Lista de productos</h1>
	
	<table id="tabla" class="table table-striped">
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Item</th>
			<th>tipo compra</th>
			<th>tipo compra sf</th>
			<th>ubicacion</th>
			<th>Estado</th>
			<th>Accion</th>
		</tr>
		<?php
		while($rcom = mysqli_fetch_array($listar_productos_new)){
			?>
			<tr>
				<td><?=$rcom['id']?></td>
				<td><?=utf8_encode($rcom['nombre'])?></td>
				<td><?=$rcom['precio']?></td>
				<td><?=$rcom['cantidad']?></td>
				<td><?=utf8_encode($rcom['detalle'])?></td>
				<td><?=utf8_encode($rcom['tipo_nombre'])?></td>
				<?php 
				if ($rcom['tipo_compra_sf'] == 'Con factura' ) {
					?>
					<td style="background:green;"><?=utf8_encode($rcom['tipo_compra_sf'])?></td>
					<?php 
				}
				if ($rcom['tipo_compra_sf'] == 'Con retencion' ) {
					?>
					<td style="background:yellow;"><?=utf8_encode($rcom['tipo_compra_sf'])?></td>
					<?php 
				}
				if ($rcom['tipo_compra_sf'] == 'Sin retencion' ) {
					?>
					<td style="background:red;"><?=utf8_encode($rcom['tipo_compra_sf'])?></td>
					<?php 
				}
				?>
				<td><?=utf8_encode($rcom['ubicacion'])?></td>
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
				<td>
					<a href='modificar_producto.php?id=<?=$rcom['id']?>'><img src="../img/libreta.png" width="20px" title="Modificar producto">&nbsp; </a>

					<?php
						if ($rcom['estado'] == 0 ) {
							?>
							<a href='habilitar_producto.php?id=<?=$rcom['id']?>'><img src="../img/ojo.png" width="22px" title="Habilitar producto ">&nbsp; </a>
							<?php
						}else{
							?>
							<a href='dar_de_baja.php?id=<?=$rcom['id']?>'><img src="../img/borrar.png" width="20px" title="Deshabilitar producto ">&nbsp; </a>
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
			<li class="page-item <?php echo $_GET['pagina']<= 1? 'disabled' : '' ?>"><a class="page-link" href="ver_productos.php?pagina=<?php echo $_GET['pagina'] - 1?>">Anterior</a></li>


			<?php for ($i=0; $i < $paginas; $i++) {  ?>
				<li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : ''?>">
					<a class="page-link" href="ver_productos.php?pagina=<?php echo $i+1; ?>">
						<?php echo $i+1; ?>
					</a>
				</li>


			<?php }
		      $paginas = $paginas - 1; ?>
		     <li class="page-item <?php echo $_GET['pagina']>= $paginas+1? 'disabled' : '' ?>"><a class="page-link" href="ver_productos.php?pagina=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>">Siguiente</a></li>
		 </ul>
		</nav>

		<a target="_blank" href="generar_pdf.php" class=" btn btn-success">Generar reporte en pdf</a>
	</div>
</div>
</body>
</html>
<?php
}
else
{
	header('Location: https://justo-juez.com/medicion');
} 
?>