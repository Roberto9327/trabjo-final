<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
	$nombreusuario=$_SESSION["nombre"];
	if (isset($_SESSION['mensajeerrorproducto'])) {
		$mensajedeerror = $_SESSION['mensajeerrorproducto'];
	}else{
		$mensajedeerror = "";
	}
	require("../php/classProducto.php");
	$p = new producto();
	$listarproductos = $p->categoriaproducto();
	$listarubicaciones = $p->ubicacionproducto();
	include "cabeceraProducto.php";
	?>
<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<div class="container-fluid">
					<br>
					<div class="card">
						<div class="card-body">
							<div class="d-sm-flex align-items-center justify-content-between mb-4">
		                        <h1 class="h3 mb-0 text-gray-800">Lista de productos</h1>
		                    </div>
								<form  id="datosproductos" name="datosproductos">
									<div class="formu">
									<label>Nombre del producto</label>
										<div class="form-group">
											<input type="text" class="form-control" name="nombre" title="Nombre del producto"  placeholder="Nombre del producto" required />
										</div>
										<label>Categoria</label>
													<select id="articulosel" name="categoria" class="form-control">
														<?php
														while($rpro = mysqli_fetch_array($listarproductos)){
															?>
															<option value="<?=$rpro['id']?>"><?=utf8_decode ($rpro['detalle'])?></option>
															<?php
														}
														?>
													</select>
													<br>
										<label>Ubicacion</label>
													<select id="articuloselubi" name="ubicacion" class="form-control">
														<?php
														while($rubi = mysqli_fetch_array($listarubicaciones)){
															?>
															<option value="<?=$rubi['id']?>"><?=utf8_decode ($rubi['ubicacion'])?></option>
															<?php
														}
														?>
													</select>
									</div><br>
									<div>
										<div class="btnproforma form-group">
											<a id="agregarnewproducto" class="btn btn-success" name="agregarnewproducto" >  Agregar nuevo producto</a>
										</div>
									</div>

								</form>
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