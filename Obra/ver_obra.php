<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) )
{
	$nombreusuario=$_SESSION["nombre"];
	require("classobra.php");
	$p = new obra();
	if (isset($_SESSION['mensajeerror'])) {
		$mensajedeerror = $_SESSION['mensajeerror'];
	}else{
		$mensajedeerror = "";
	}
	$contar_inv =$p->contarobra();
	$articulo_x_pagina = 10;
	//echo $contar_inv;
	$divisa = 'Bs.';
	$paginas = $contar_inv / $articulo_x_pagina;
	$paginas = ceil($paginas);
	if (!$_GET || $_GET['pagina'] <=0 ||$_GET['pagina'] > $paginas ) {
		header('Location:ver_obra.php?pagina=1');
	}
	$iniciar = ($_GET['pagina']-1) * $articulo_x_pagina;
	$listar_proforma = $p->cantidadTotalobra($iniciar,$articulo_x_pagina);
	if (isset($_GET['categoria'])) {
		$categoria = $_GET['categoria'];
	}else{
		$categoria = "";
	}
	if ($categoria == "") {
		$listar_proforma = $p->cantidadTotalobra($iniciar,$articulo_x_pagina);
	}else{
		$listar_proforma = $p->cantidadTotalobrabus($categoria,$iniciar,$articulo_x_pagina);

	}
	include "cabeceraobra.php";
	?>
<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
			  <div class="container-fluid"><br>
				<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Listar obras</h1>
                    </div>
	
				<div >
					<form  method="post" id="fcategoria" name="fcategoria">
						<div class="row">
							<div class="form-group col-xl-5 col-md-6 mb-4">
								<input type="text"  id="categoria" name="cat" class="form-control"  title="INTRODUSCA EL NOMBRE DE LA OBRA"  placeholder="Ingrese el nombre de la obra a buscar" required />
							</div>
							<div class="form-group col-xl-4 col-md-6 mb-4 ">
								<a  class="btn btn-info btn-icon-split" id="buscarcatobra" >
									<span class="text">
										Buscar proforma
									</span>
								</a>
								<a  class="btn btn-primary btn-icon-split" id="vertodoobra" >
									<span class="text">
										Mostrar todo
									</span>
								</a>
							</div>
						</div>
						
						
						<br><br>
					</form>

					<table id="tabla" class="table table-striped">
						<tr>
							<th class="titulotabla">Nombre</th>
							<th class="titulotabla">Proforma</th>
							<th class="titulotabla">fecha</th>
							<th class="titulotabla">Accion</th>
						</tr>
						<?php
						while($rcom = mysqli_fetch_array($listar_proforma)){
							?>
							<tr>
								<td><?=$rcom['nombre']?></td>
								<td><?=$rcom['id_proforma']?></td>
								<td><?=$rcom['fecha']?></td>
								<td>
									<a href='detalle_obra.php?id=<?=$rcom['id']?>'><img src="../img/ojo.png" width="22px" title="ver detalle de proforma">&nbsp; </a>
								</td>
							</tr>
							<?php
						}
						?>
					</table>

				</div>
				<nav aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item <?php echo $_GET['pagina']<= 1? 'disabled' : '' ?>"><a class="page-link" href="ver_obra.php?pagina=<?php echo $_GET['pagina'] - 1?>">Anterior</a></li>


							<?php for ($i=0; $i < $paginas; $i++) {  ?>
						<li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : ''?>">
								<a class="page-link" href="ver_obra.php?pagina=<?php echo $i+1; ?>">
									<?php echo $i+1; ?>
								</a>
						</li>


							<?php }
							$paginas = $paginas - 1; ?>
						<li class="page-item <?php echo $_GET['pagina']>= $paginas+1? 'disabled' : '' ?>"><a class="page-link" href="ver_obra.php?pagina=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>">Siguiente</a></li>
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