<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
	$nombreusuario=$_SESSION["nombre"];
	require("../php/classUser.php");
	$p = new user();
	// if (isset($_SESSION['mensajeerror'])) {
	//  	$mensajedeerror = $_SESSION['mensajeerror'];
	//  }else{
	//  	$mensajedeerror = "";
	//  }
	$contar_inv =$p->contaruser();
	$articulo_x_pagina = 10;
	//echo $contar_inv;
	$paginas = $contar_inv / $articulo_x_pagina;
	$paginas = ceil($paginas);
	if (!$_GET || $_GET['pagina'] <=0 ||$_GET['pagina'] > $paginas) {
		header('Location:ver_usuarios.php?pagina=1');
	}
	$iniciar = ($_GET['pagina']-1) * $articulo_x_pagina;
	$listar_usuarios = $p->cantidadTotalUsuarios($iniciar,$articulo_x_pagina);
	include "cabeceraUsuario.php";
	?>
<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
			  <div class="container-fluid"><br>
			  	<div class="card">
		        	<div class="card-body">
		        		<div class="d-sm-flex align-items-center justify-content-between mb-4">
		                       <h1 class="h3 mb-0 text-gray-800">Lista de usuarios</h1>
		                 </div>
					<div id="mensajeusuariob"></div>
					<table id="tabla" class="table table-striped">
						<tr>
							<th class="titulotabla">Codigo</th>
							<th class="titulotabla">Nombre</th>
							<th class="titulotabla">Usuario</th>
							<th class="titulotabla">Contraseña</th>
							<th class="titulotabla">Categoria</th>
							<th class="titulotabla">Estado</th>
							<th class="titulotabla">Accion</th>
						</tr>
						<?php
						while($rcom = mysqli_fetch_array($listar_usuarios)){
							?>
							<tr>
								<td class="mayuscula"><?=$rcom['codigo']?></td>
								<td class="mayuscula"><?=$rcom['nombre']?></td>
								<td><?=$rcom['usuario']?></td>
								<td><?=$rcom['password']?></td>
								<td class="mayuscula"><?=$rcom['tipo']?></td>
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
									<a href='modificar_usuario.php?id=<?=$rcom['id']?>'><img src="../img/libreta.png" width="20px" title="Modificar producto">&nbsp; </a>

									<?php
										if ($rcom['estado'] == 0 ) {
											?>
											<a href='habilitar_usuario.php?id=<?=$rcom['id']?>'><img src="../img/ojo.png" width="22px" title="Habilitar producto ">&nbsp; </a>
											<?php
										}else{
											?>
											<a href='dar_de_baja_usuario.php?id=<?=$rcom['id']?>'><img src="../img/borrar.png" width="20px" title="Deshabilitar producto ">&nbsp; </a>
											<?php
										}
									?>
									
								</td>
							</tr>
							<?php
						}
						?>
					</table>
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<li class="page-item <?php echo $_GET['pagina']<= 1? 'disabled' : '' ?>"><a class="page-link" href="ver_usuarios.php?pagina=<?php echo $_GET['pagina'] - 1?>">Anterior</a></li>


							<?php for ($i=0; $i < $paginas; $i++) {  ?>
							<li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : ''?>">
								<a class="page-link" href="ver_usuarios.php?pagina=<?php echo $i+1; ?>">
									<?php echo $i+1; ?>
								</a>
							</li>


							<?php }
					     	 $paginas = $paginas - 1; ?>
					     	<li class="page-item <?php echo $_GET['pagina']>= $paginas+1? 'disabled' : '' ?>"><a class="page-link" href="ver_usuarios.php?pagina=<?php if($_GET['pagina'] > $paginas){echo 1;}else{echo $_GET['pagina'] + 1;}  ?>">Siguiente</a></li>
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
	header('Location: http://localhost/medicion');
} 
?>