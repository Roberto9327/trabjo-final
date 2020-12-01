<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
include "../php/classProducto.php";
	$p = new producto();
	$divisa ="Bs.";
	$contar_rep =$p->contarrep();
	$articulo_x_pagina = 10;
	$paginas = $contar_rep / $articulo_x_pagina;
	$paginas = ceil($paginas);
	$articulo_x_pagina= 10;
	$fechaini=$_POST["fi"];
	$fechafin=$_POST["ff"];
	$resultado = "";
	$mayor ="";
	$menor ="";
	if ($fechaini == "" && $fechafin == "" ) {
		$resultado .= "<p>inserte la fecha a buscar</p>";
	}
	if ($fechaini <> "" && $fechafin <> "" ) {
		if ($fechaini < $fechafin) {
			$mayor =$fechafin;
			$menor =$fechaini;
		}else{
			$mayor =$fechaini;
			$menor =$fechafin;
		}
	$listar_reporte = $p->reporteTotalProducto($mayor,$menor,$iniciar,$articulo_x_pagina);
	echo $fechaini;
	$resultado .="<table class='table table-striped'>
					<tr>
						<th>Nombre del producto</th>
						<th>Cantidad</th>
						<th>Precio por unidad</th>
						<th>Precio Total</th>
						<th>Fecha</th>
					</tr>";
					$monto_total = 0;
					$cadena = "";
					$ancho = "";
					$medida ="";
					while($rcom = mysqli_fetch_array($listar_reporte)){
						$monto_total = $monto_total + $rcom['preciot'];
						if ($rcom['ancho'] == 0) {
							$ancho = "";
						}else{
							$ancho = $rcom['ancho'];
						}
						if ($rcom['alto'] == 0) {
							$alto = "";
						}else{
							$alto = $rcom['alto'];
						}
						if ($rcom['ancho'] == 0 && $rcom['alto'] == 0) {
							$medida ="";
						}
						if ($rcom['ancho'] <> 0 && $rcom['alto'] <> 0) {
							$medida = $rcom['ancho']." X ".$rcom['alto'];
						}
						if ($rcom['ancho'] == 0 && $rcom['alto'] <> 0) {
							$medida =$rcom['alto'];
						}
						if ($rcom['ancho'] <> 0 && $rcom['alto'] == 0) {
							$medida =$rcom['ancho'];
						}

						$resultado.= "<tr>
							<td><?=utf8_encode($rcom['detalle'])?> <?=$medida?></td>
							<td><?=$rcom['cantidad']?></td>
							<td><?=$rcom['preciou']?> <?=$divisa?></td>
							<td><?=$rcom['preciot']?> <?=$divisa?></td>
							<td><?=$rcom['fecha']?></td>
						</tr>";
					}
					$cadena .= "monto total ".$monto_total;
					
				$resultado.="</table>";
	$resultado.="<nav aria-label='Page navigation example'>
		<ul class='pagination'>
			<li class='page-item <?php echo $_GET['pagina']<= 1? 'disabled' : '' ?>'><a class='page-link' href='reportes_ventas.php?pagina=<?php echo $_GET['pagina'] - 1?>''>Anterior</a></li>";


			 for ($i=0; $i < $paginas; $i++) { 
				$resultado.="<li class='page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : ''?>'>
					<a class='page-link' href='reportes_ventas.php?pagina=<?php echo $i+1; ?>'>
						<?php echo $i+1; ?>
					</a>
				</li>";
			 }

		      $paginas = $paginas - 1; 
		     $resultado.="<li class='page-item <?php echo $_GET['pagina']>= $paginas+1? 'disabled' : '' ?>'><a class='page-link' href='reportes_ventas.php?pagina=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>'>Siguiente</a></li>
		 </ul>
	</nav>";
	echo $resultado;
	}
}
else
{
	header('Location: http://justo-juez.com/medicion');
} 

?>