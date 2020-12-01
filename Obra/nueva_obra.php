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
	
	$listarproforma = $p->listarproforma();

	include "cabeceraobra.php";
	?>
<div id="content-wrapper" class="d-flex flex-column">
		<div id="content">
			<div class="container-fluid"><br>
				<div class="d-sm-flex align-items-center justify-content-between mb-4">
                   <h1 class="h3 mb-0 text-gray-800">Nueva obra de trabajo</h1>
             	</div>
			<form  method="post" id="fnobra" name="fnobra">
				<div class="d-sm-flex align-items-center justify-content-between mb-4">
                   <h1 class="h3 mb-0 text-gray-800">Datos del cliente</h1>
             	</div>
             	<div class="row">
             		<div class="form-group  col-xl-3 col-md-6 mb-4">
						<input type="text"  id="nombrec" name="nombrec" class="form-control"  title="INTRODUSCA EL NOMBRE DEL CLIENTE"  placeholder="Ingrese el nombre del cliente" required />
					</div>
					<div class="form-group col-xl-3 col-md-6 mb-4">
						<input type="text"  id="telefonoc" name="telefonoc" class="form-control"  title="INTRODUSCA EL TELEFONO DEL CLIENTE"  placeholder="Ingrese el telefono del cliente" required />
					</div>
					<div class="form-group col-xl-3 col-md-6 mb-4">
						<input type="text"  id="nitc" name="nitc" class="form-control"  title="INTRODUSCA EL NIT O C.I. DEL CLIENTE"  placeholder="Ingrese el nit o c.i. del cliente" required />
					</div>
             	</div>
             	<div class="d-sm-flex align-items-center justify-content-between mb-4">
                   <h1 class="h3 mb-0 text-gray-800">Datos de la obra</h1>
             	</div>
				<div class="row">
					<div class="form-group col-xl-3 col-md-6 mb-4">
						<input type="text"  id="nombreobra" name="nombreobra" class="form-control"  title="INTRODUSCA EL NOMBRE DE LA OBRA"  placeholder="Ingrese el nombre de la obra" required />
					</div>
					<div class="form-group col-xl-3 col-md-6 mb-4" >
						<select  class="form-control" id="proformaobra" name="proformaobra">
							<option value="">Seleccione una opcion</option>
							<?php
							while($rpro = mysqli_fetch_array($listarproforma)){
								?>
								<option value="<?=$rpro['id']?>" >
									<span ><?=$rpro['nombre']?></span>
								</option>
								<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xl-3 col-md-6 mb-4">
						<a  class="btn btn-success btn-icon-split" id="ingresarDatosNuevaObra" >
							<span class="text">
								Crear nueva obra
							</span>
						</a>
					</div>
				</div>
			</form>
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