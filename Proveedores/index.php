<?php
header('Content-type: text/html; charset=utf-8');
session_start();

if(isset($_SESSION["nombre"]))
{
	if (!$_GET || $_GET['pagina'] <=0) {
		header('Location:index.php?pagina=1');
	}
	$idexistesesion= $_SESSION["nombre"];
	include "cabeceraProveedores.php"; 
	require("classProveedores.php");
	$p = new proveedores();
	$contar_inv =$p->contarinv();
	$divisa ="Bs.";
	$articulo_x_pagina = 10;
	//echo $contar_inv;
	$paginas = $contar_inv / $articulo_x_pagina;
	$paginas = ceil($paginas);
	$iniciar = ($_GET['pagina']-1) * $articulo_x_pagina;
	//echo $iniciar;
	$inventariopro = $p->buscarproveedores($iniciar,$articulo_x_pagina);
	//echo $paginas;
	?>
	<div id="contenidos">
		<h2 class="titulo-prinsipal-cotizacion">PROVEEDORES</h2>
		<div id="tablainv">
			<table class="table table-striped">
				<tr>
					<th>Nombre</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<th>Nit</th>
					<th>Tipo</th>
				</tr>
				<?php
							while($rinv = mysqli_fetch_array($inventariopro)){
								?>
								<tr>
									<td><?=utf8_encode($rinv['nombre'])?></td>
									<td><?=$rinv['telefono']?></td>
									<td><?=$rinv['direccion']?></td>
									<td><?=$rinv['nit']?></td>
									<td><?=$rinv['tipo']?></td>
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
	<?php




}
else
{
header('Location: http://justo-juez.com/medicion/');
}
?>