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
	$articulo_x_pagina = 10;
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
</div>
<div id="contenidos">
	<h1>Registrar productos</h1>
	<div><p id="mensajeactualizacion"></p></div>
	<form  id="datosproductoscat" name="datosproductoscat">
		<div class="formu">

			<div class="form-group">
				<input type="text" class="form-control" name="detalle" title="Nombre categoria"  placeholder="Nombre categoria" required />
			</div>
		</div><br>
		<div>
			<div class="btnproforma form-group">
				<a id="agregarnewproductocategoria" class="btn btn-success" name="agregarnewproductocategoria" >  Agregar categoria</a>
			</div>
		</div>
	</form>
<div id="contenidos2">
		<h2 class="titulo-prinsipal-cotizacion">Categorias</h2>
		<div id="tablainv">
			<table class="table table-striped">
				<tr>
					<th>Categoria</th>
				</tr>
				<?php
							while($rinv = mysqli_fetch_array($inventariopro)){
								?>
								<tr>
									<td><?=utf8_encode($rinv['detalle'])?></td>
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

</body>
</html>
<?php
}
else
{
	header('Location: http://justo-juez.com/medicion');
} 
?>