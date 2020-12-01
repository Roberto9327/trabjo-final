<?php 
session_start();

if(isset($_SESSION["nombre"]))
{
if(isset($_SESSION["idproforma"])) 
{

	$nombreusuario=$_SESSION["nombre"];
	include "cabeceracotizacion.php"; 
	$idproforma=$_SESSION["idproforma"];
	$nombreproforma=$_SESSION["nombreproforma"];
	$divisa = "Bs.";
	require("classProforma.php");
	$p = new proforma();
	$cats = $p->categoriaproducto();
	$carrit = $p->buscardetalle($idproforma);
	$accesorio = $p->buscandoaccesorios();
	if (isset($_SESSION['idcategoria'])) {
		$categoria = $_SESSION['idcategoria'];
	}else{
		$categoria = "";
	}
	if ($categoria == "" && $categoria == 0) {
		$c = new proforma();
		$categoria = 0;
		$tipo = $c->tipodetrabajo($categoria);
	}else{
		$c = new proforma();
		$tipo = $c->tipodetrabajo($categoria);

	}

	$buscaridcliente = $p->buscarnombredelcliente($idproforma);
	$filacliente=mysqli_fetch_array($buscaridcliente);
	$iddelclienteencontrado=$filacliente[2];

	if ($iddelclienteencontrado > 0) {
		$mostrarcliente2 = $p->mostrardatosclienteexistentes($iddelclienteencontrado);
		$filabcliente2=mysqli_fetch_array($mostrarcliente2);
		$nombredelcliente=$filabcliente2[1];
		$telefonodelcliente=$filabcliente2[2];
	}else{
		$nombredelcliente="S/N";
		$telefonodelcliente="S/N";
	}
	$_SESSION['pronombredelcliente'] =$nombredelcliente;
	$_SESSION['protelefonodelcliente'] =$telefonodelcliente;
	?>
	

<div id="content-wrapper" class="d-flex flex-column">
	<div id="content">
		<div class="container-fluid"><br>
			<div class="card">
		        	<div class="card-body">
			<?php
			 include "botones.php";
			?>
			
		<!--////////////////////////////////////////////////////////////////////////////////////////////-->
					<div class="carrito">
						<div class="proformadetalle">
							<h1><img src="../img/libreta.png" width="30px"> 
								<?php echo $nombreproforma;?>
							</h1>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
			 				 Datos del cliente
							</button>
							<!--<button  id="datosclientebtn" class="btn btn-success" name="datos_cliente"><img src="../img/libreta.png" width="30px"> Datos del cliente</button>-->
							<h2>Nombre: <?=$nombredelcliente?></h2>
							<h2>Telefono: <?=$telefonodelcliente?></h2>
							<table class="table table-striped">
								<tr>
									<th>Ancho</th>
									<th>Alto</th>
									<th>Nombre del producto</th>
									<th>Cantidad</th>
									<th>Precio por unidad</th>
									<th>Precio Total</th>
									<th>Action</th>
								</tr>
								<?php
						// $cats = $mysqli->query("SELECT * FROM trabajos ORDER BY detalle ASC");
								$monto_total = 0;
								$cadena = "";
								while($rcom = mysqli_fetch_array($carrit)){
									$monto_total = $monto_total + $rcom['preciot'];
									$cadena .=$rcom['ancho']."-".$rcom['alto']."-".$rcom['detalle']."-".$rcom['cantidad']."-".$rcom['preciou']."-".$rcom['preciot']."/";
									?>
									<tr>
										<td><?=$rcom['ancho']?></td>
										<td><?=$rcom['alto']?></td>
										<td><?=$rcom['detalle']?></td>
										<td><?=$rcom['cantidad']?></td>
										<td><?=$rcom['preciou']?>  <?=$divisa?></td>
										<td><?=$rcom['preciot']?>  <?=$divisa?></td>
										<td><a href='eliminar_producto.php?id=<?=$rcom['id']?>'><img src="../img/borrar.png" width="20px" title="Eliminar producto del carrito"> </a></td>
									</tr>
									<?php
								}
								$cadena .= "monto total ".$monto_total;
								?>
							</table>
							<h2>Monto Total: <b class="text-green"><?=$monto_total?> <?=$divisa?></b></h2>
							<a target="_blank" href="generar_pdf.php" class=" btn btn-success">Generar pdf</a>
							<a  href="finproforma.php" class=" btn btn-success">Finalizar proforma</a>
						</div>

						<?php
							//Agregamos la libreria para genera códigos QR
							require "phpqrcode/qrlib.php";
							//Conesta variable quiero sacar la fecha y adjuntarsela al interior de la carpeta temp para que me cree carpetas con la hora y fecha de cada codigo qr   
							$hoy = getdate();
							//Declaramos una carpeta temporal para guardar la imagenes generadas
							$dir = 'temp/'.$nombreproforma.'/';

							//Si no existe la carpeta la creamos
							if (!file_exists($dir))
								mkdir($dir);

							//Declaramos la ruta y nombre del archivo a generar
							$filename = $dir.$nombreproforma.'.png';

				    		//Parametros de Condiguración

							$tamaño = 10; //Tamaño de Pixel
							$level = 'H'; //Precisión Baja
							$framSize = 3; //Tamaño en blanco
							$contenido = $nombredelcliente."/".$telefonodelcliente."/".$cadena; //Texto

				  			 //Enviamos los parametros a la Función para generar código QR 
							QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

				   			//Mostramos la imagen generada
							echo '<img class="qrimg" src="'.$dir.basename($filename).'" width="150px"/><hr/>'; 
						?>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--<div id="modal">
<center class="centro">
	<form method="post" action="" id="cont_modal" name="cont_modal">
		<div class="row">
			<div class="form-group" style='width: 90%;' >
				<input type="text" class="form-control" name="ncliente" placeholder="Colocar el nombre del Cliente"/>
			</div>
			<div class="form-group" style='width: 90%;' >
				<input type="number" class="form-control" name="tcliente" placeholder="Colocar el telefono del cliente"/>
			</div>
			<div class="form-group" style='width: 90%;' >
				<input type="number" class="form-control" name="nit" placeholder="Colocar el NIT"/>
			</div>
			<button type="submit" class="btn btn-success" id="ingresarDatosCliente" name="finalizar_datos_cliente"> Ingresar datos del cliente</button>
		</div>
	</form>
</center>
</div>-->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    	<form method="post" action="" id="cont_modal" name="cont_modal">
			<div class="modal-body">
				<div class="row">
					<div class="form-group" style='width: 90%;' >
						<input type="text" class="form-control" name="ncliente" placeholder="Colocar el nombre del Cliente"/>
					</div>
					<div class="form-group" style='width: 90%;' >
						<input type="number" class="form-control" name="tcliente" placeholder="Colocar el telefono del cliente"/>
					</div>
					<div class="form-group" style='width: 90%;' >
						<input type="number" class="form-control" name="nit" placeholder="Colocar el NIT"/>
					</div>
					<!--<button type="submit" class="btn btn-success" id="ingresarDatosCliente" name="finalizar_datos_cliente"> Ingresar datos del cliente</button>-->
				</div>
	      	</div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" id="ingresarDatosCliente" name="finalizar_datos_cliente" data-dismiss="modal">Ingresar datos del cliente</button>
	        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
	      </div>
		</form>
      
    </div>
  </div>
</div>
</body>
</html>

<?php
}else{
header('Location: http://justo-juez.com/medicion/home.php');
}
}
else
{
header('Location: http://justo-juez.com/medicion');
}
?>