<?php 
session_start();
       
		//unset($_SESSION["alto"]);
		//unset($_SESSION["ancho"]);
		//unset($_SESSION["idproducto"]);
		//unset($_SESSION["nombreproducto"]);
		//unset($_SESSION["precioventa"]);
		//unset($_SESSION["cantidad"]);
		//unset($_SESSION["total"]);
if(isset($_SESSION["nombre"]))
{

	$nombreusuario=$_SESSION["nombre"];
	include "cabeceracotizacion.php"; 
	//$idproforma=$_SESSION["idproforma"];
	//$nombreproforma=$_SESSION["nombreproforma"];
	$divisa = "Bs.";
	require("classProforma.php");
	$p = new proforma();
	$cats = $p->categoriaproducto();
	//$carrit = $p->buscardetalle($idproforma);
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


	if (isset($_SESSION["nombrecliente"])) {
		$nombredelcliente=$_SESSION["nombrecliente"];
		$telefonodelcliente=$_SESSION["telefonocliente"];
		$nitckiente = $_SESSION["nitcliente"];
	}else{
		$nombredelcliente="S/N";
		$telefonodelcliente="S/N";
	}
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
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
			 				 Datos del cliente
							</button>
							<!--<button  id="datosclientebtn" class="btn btn-success" name="datos_cliente"><img src="../img/libreta.png" width="30px"> Datos del cliente</button>-->
							<h2>Nombre: <?=$nombredelcliente?></h2>
							<h2>Telefono: <?=$telefonodelcliente?></h2>
							<table class="table table-striped">
								<tr>
									<th style="width: 10%;">Ancho</th>
									<th style="width: 10%;">Alto</th>
									<th style="width: 40%;">Nombre del producto</th>
									<th style="width: 10%;">Precio</th>
									<th style="width: 8%;">Cantidad</th>
									<th style="width: 12%;">Precio Total</th>
									<th style="width: 10%;">Action</th>
								</tr>
								<?php
								if (isset($_SESSION["idproducto"])) {
									

								}
								if (!isset($_SESSION["idproducto"])) {
									$n=0;
								}else{
									$contador = $_SESSION["idproducto"];
									$n=count($contador);
								}
								//$n=count($contador);
								echo "<b>Cantidad de Productos: </b>".$n;
								for($i=0;$i<$n;$i++)
					            {
									?>
									<tr>
									<?php if(isset($_SESSION["idproducto"][$i]))
									{
									?>
									<td ><?php echo $_SESSION["ancho"][$i]; ?></td>
									<td ><?php echo $_SESSION["alto"][$i]; ?></td>
									<td ><?php echo $_SESSION["nombreproducto"][$i]; ?></td>
									<td class="pven" ><?php echo $_SESSION["precioventa"][$i]; ?></td>
									<td ><input type="number" name="canti" class="canti" value="<?php echo $_SESSION["cantidad"][$i]; ?>"></td>
									<td class="tot" ><?php echo $_SESSION["total"][$i];?></td>
									<td ><input type="hidden" value="<?php echo $i; ?>" class="valive"><a class="elimvent"><img src="../img/borrar.png" style="width:50%;"></a></td>
									</tr>
									<?php
									}
								}
								?>
							</table>
							<?php
							$n=$_SESSION["caN"];
							$sum=0;
							for($i=0;$i<$n;$i++)
							{
								if(isset($_SESSION["idproducto"][$i]))
								{
								 $sum=$sum+$_SESSION["total"][$i];
								}
							}
						    ?>
							<p id="valtotal" style="font-size:22px;"><b>TOTAL DE VENTA: Bs.</b><?php echo $sum; ?></p><br><br>
							<a target="_blank" href="generar_pdf.php" class=" btn btn-success">Generar pdf</a>
							<a  href="finproforma.php" class=" btn btn-success">Finalizar Nota</a>
						</div>

						<?php
							//Agregamos la libreria para genera códigos QR
							require "phpqrcode/qrlib.php";
							//Conesta variable quiero sacar la fecha y adjuntarsela al interior de la carpeta temp para que me cree carpetas con la hora y fecha de cada codigo qr   
							$hoy = getdate();
							//Declaramos una carpeta temporal para guardar la imagenes generadas
							//$dir = 'temp/'.$nombreproforma.'/';

							//Si no existe la carpeta la creamos
							//if (!file_exists($dir))
							//	mkdir($dir);

							//Declaramos la ruta y nombre del archivo a generar
							//$filename = $dir.$nombreproforma.'.png';

				    		//Parametros de Condiguración

							//$tamaño = 10; //Tamaño de Pixel
							//$level = 'H'; //Precisión Baja
							//$framSize = 3; //Tamaño en blanco
							//$contenido = $nombredelcliente."/".$telefonodelcliente."/".$cadena; //Texto

				  			 //Enviamos los parametros a la Función para generar código QR 
							//QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

				   			//Mostramos la imagen generada
							//echo '<img class="qrimg" src="'.$dir.basename($filename).'" width="150px"/><hr/>'; 
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
        <h5 class="modal-title" id="exampleModalLabel">Datos del Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    	<form method="post" action="" id="datoscliente" name="datoscliente">
			<div class="modal-body">
				<div class="row">
					<div class="form-group" style='width: 100%;' >
						<input type="text" class="form-control" name="ncliente" placeholder="Colocar el nombre del Cliente"/>
					</div>
					<div class="form-group" style='width: 100%;' >
						<input type="number" class="form-control" name="tcliente" placeholder="Colocar el telefono del cliente"/>
					</div>
					<div class="form-group" style='width: 100%;' >
						<input type="number" class="form-control" name="nitcliente" placeholder="Colocar el NIT"/>
					</div>
					<!--<button type="submit" class="btn btn-success" id="ingresarDatosCliente" name="finalizar_datos_cliente"> Ingresar datos del cliente</button>-->
				</div>
	      	</div>
	      <div class="modal-footer">
	        <button type="button" id="ingresarDatosCliente" name="datos_cliente" class="btn btn-primary">Guardar</button>
	        <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cancelar</button>
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
header('Location: http://localhost/medicion');
}
?>