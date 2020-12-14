	<?php 
	session_start();

	if(isset($_SESSION["nombre"]))
	{
		$_SESSION["caN"]=0;
		$idexistesesion= $_SESSION["nombre"];
		include "cabecera.php";
		?>
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
			  <div class="container-fluid"><br>
			  	<div class="card">
		        	<div class="card-body">
			  		<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
				  	<div class="row">
				  		
				     <a href="Cotizacion"  class="col-xl-3 col-md-6 mb-4"> 
				 			<div class="card border-left-primary shadow h-100 py-2">
				 				<div class="card-body">
				 					<div class="row no-gutters align-items-center">
				 						<div class="col mr-2">
				 							<!--<img src="img/inventario.png">-->
				 							<p class="text-xs font-weight-bold text-primary text-uppercase mb-1">COTIZACIÓN - VENTA</p>
				 						</div>
				 						<div class="col-auto">
                                            <img src="img/proforma.png" width="100px">
                                        </div>
				 					</div>
				 				</div>
				 			</div>
				 		</a>
				 		<a href="Inventario"  class="col-xl-3 col-md-6 mb-4"> 
				 			<div class="card border-left-primary shadow h-100 py-2">
				 				<div class="card-body">
				 					<div class="row no-gutters align-items-center">
				 						<div class="col mr-2">
				 							<!--<img src="img/inventario.png">-->
				 							<p class="text-xs font-weight-bold text-primary text-uppercase mb-1">INVENTARIO</p>
				 						</div>
				 						<div class="col-auto">
                                            <img src="img/inventario.png" width="100px">
                                        </div>
				 					</div>
				 				</div>
				 			</div>
				 		</a>
				 		<a href="Directorio" class="col-xl-3 col-md-6 mb-4">
				 			<div  class="card border-left-primary shadow h-100 py-2">
				 				<div class="card-body">
				 					<div class="row no-gutters align-items-center">
				 						<div class="col mr-2">
				 							<!--<img src="img/directorio.png">-->
				 							<p class="text-xs font-weight-bold text-primary text-uppercase mb-1">DIRECTORIO</p>
				 						</div>
				 						<div class="col-auto">
                                            <img src="img/directorio.png" width="100px">
                                        </div>
				 					</div>
				 				</div>
				 			</div>
				 		</a>
				 		<a href="Obra/ver_obra.php?pagina=1" class="col-xl-3 col-md-6 mb-4">
				 			<div  class="card border-left-primary shadow h-100 py-2">
				 				<div class="card-body">
				 					<div class="row no-gutters align-items-center">
				 						<div class="col mr-2">
				 							<!--<img src="img/obras.png">-->
				 							<p class="text-xs font-weight-bold text-primary text-uppercase mb-1">OBRAS</p>
				 						</div>
				 						<div class="col-auto">
                                            <img src="img/obras.png" width="100px">
                                        </div>
				 					</div>
				 				</div>
				 			</div>
				 		</a>
				  	</div>
				  	<div class="row">
				 		<a href="Proveedores/index.php?pagina=1" class="col-xl-3 col-md-6 mb-4">
				 			<div  class="card border-left-primary shadow h-100 py-2">
				 				<div class="card-body">
				 					<div class="row no-gutters align-items-center">
				 						<div class="col mr-2">
				 							<!--<img src="img/proveedor.png">-->
				 							<p class="text-xs font-weight-bold text-primary text-uppercase mb-1">PROVEEDORES</p>
				 						</div>
				 						<div class="col-auto">
                                            <img src="img/proveedor.png" width="100px">
                                        </div>
				 					</div>
				 				</div>
				 			</div>
				 		</a>
				  	</div>
				  	<div class="row">
				  		<div id="donut_single" style="width: 500px; height: 500px;margin: 1px solid #333;border-radius: 8px;"></div>
				  	</div>
			  	</div>
			 </div>
		 </div>	
	</div>
	</div>	
	</div>	 
		 <?php 
		// include "pie.php"; 
	}
	else
	{
	header('Location: http://justo-juez.com/medicion/');
	}
	?>

