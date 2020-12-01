<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
$nombreusuario=$_SESSION["nombre"];
include "cabecera.php";
?>
<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
			  <div class="container-fluid"><br>
			  	<div class="card">
		        	<div class="card-body">
		        	<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Panel Administrativo</h1>
                    </div>
					<div class="row">
				 		<a href="Proveedores/index.php?pagina=1" class="col-xl-3 col-md-6 mb-4">
				 			<div  class="card border-left-primary shadow h-100 py-2">
				 				<div class="card-body">
				 					<div class="row no-gutters align-items-center">
				 						<div class="col mr-2">
				 							<!--<img src="img/proveedor.png">-->
				 							<p class="text-xs font-weight-bold text-primary text-uppercase mb-1">Usuarios</p>
				 						</div>
				 						<div class="col-auto">
                                            <img src="img/usuarios.png" width="100px">
                                        </div>
				 					</div>
				 				</div>
				 			</div>
				 		</a>
				 		<a href="Proveedores/index.php?pagina=1" class="col-xl-3 col-md-6 mb-4">
				 			<div  class="card border-left-primary shadow h-100 py-2">
				 				<div class="card-body">
				 					<div class="row no-gutters align-items-center">
				 						<div class="col mr-2">
				 							<!--<img src="img/proveedor.png">-->
				 							<p class="text-xs font-weight-bold text-primary text-uppercase mb-1">Procucto</p>
				 						</div>
				 						<div class="col-auto">
                                            <img src="img/productos.png" width="100px">
                                        </div>
				 					</div>
				 				</div>
				 			</div>
				 		</a>
				 		<a href="Proveedores/index.php?pagina=1" class="col-xl-3 col-md-6 mb-4">
				 			<div  class="card border-left-primary shadow h-100 py-2">
				 				<div class="card-body">
				 					<div class="row no-gutters align-items-center">
				 						<div class="col mr-2">
				 							<!--<img src="img/proveedor.png">-->
				 							<p class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cotizaciones</p>
				 						</div>
				 						<div class="col-auto">
                                            <img src="img/proforma.png" width="100px">
                                        </div>
				 					</div>
				 				</div>
				 			</div>
				 		</a>
				  	</div>
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