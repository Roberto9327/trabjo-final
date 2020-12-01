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
			<?php
			 include "botones.php";
			?>
			<form  action="" id="fcategoria" name="fcategoria">
				<select id="categoria" name="cat" class="form-control">
					<option value="0" >seleccione una categoria</option>
					<?php
			// $cats = $mysqli->query("SELECT * FROM trabajos ORDER BY detalle ASC");
					while($rcat = mysqli_fetch_array($cats)){
						?>
						<option value="<?=$rcat['id']?>"><?=$rcat['detalle']?></option>
						<?php
					}
					?>
				</select>
				<br>
				<a  class="btn btn-warning" id="buscarcat" ><i><img src="../img/lupa.png" width="30px"> </i> Buscar categoria</a>
				<br><br>
			</form>
			<form method="post" action="" id="datostrab" name="datostrab">
				<div class="formu">

					<div class="form-group">
						<input type="number"  id="ancho" class="form-control" name="ancho" title="INTRODUSCA EL ANCHO EN MM"  placeholder="Ancho" required />
					</div>
					<div class="form-group">
						<input type="number"  id="alto" class="form-control" name="alto" title="INTRODUSCA EL ALTO EN MM"  placeholder="Alto" required />
					</div>
					<div class="form-group">
						<input type="number"  id="cantidad" class="form-control" name="cantidad" title="INTRODUSCA LA CANTIDAD DE PUERTAS O VENTANAS"  placeholder="Cantidad" required />
					</div>
					<br>
					<select  class="form-control" id="cotizar" name="cotizar">
						<option value="">Seleccione una opcion</option>
						<?php
						while($rcat2 = mysqli_fetch_array($tipo)){
							var_dump($rcat2);
							?>
							<option value="<?=$rcat2['nombre']?>" >
								<span ><?=$rcat2['nombre']?></span>
							</option>
							<?php
						}
						?>
					</select><br>

				</div>
				<div>
					<div class="input__row">
						<ul class="buttons">
							<li>
								<input id="radiobtn_1" class="radiobtn" name="precio" type="radio" value="uno" tabindex="1" checked="">
								<span></span>
								<label for="radiobtn_1">Uno</label>
							</li>
							<li>
								<input id="radiobtn_2" class="radiobtn" name="precio" type="radio" value="mas de tres" tabindex="2">
								<span></span>
								<label for="radiobtn_2">Más de tres</label>
							</li>
						</ul>
					</div>
					<div class="btnproforma">
						<input type="button" value="Cotizar medidas" id="cotizarbtn" class="btn btn-success" name="">

						<input type="submit" value="Agregar al carrito" id="agregarbtn" class="btn btn-success" name="Agregar">
					</div>
				</div>

				<br><br>

				<div class="detalle">
					<p id="preciounitario"></p>
					<p id="preciototal"></p>
				</div>

			</form>
		</div>
		<!--////////////////////////////////////////////////////////////////////////////////////////////-->
		<div class="cot_otros">
			<form method="post" action="" id="datosotros" name="datosotros">
				<div class="formu">

					<div class="form-group">
						<input type="number"  id="ancho_otros" class="form-control" name="alto_otros" title="INTRODUSCA EL ANCHO EN MM"  placeholder="Ancho"  />
					</div>
					<div class="form-group">
						<input type="number"  id="alto_otros" class="form-control" name="ancho_otros" title="INTRODUSCA EL ALTO EN MM"  placeholder="Alto"  />
					</div>
					<div class="form-group">
						<input type="number"  id="cantidad_otros" class="form-control" name="cantidad_otros" title="INTRODUSCA LA CANTIDAD DE PUERTAS O VENTANAS"  placeholder="Cantidad" required />
					</div>
					<br>
					<div class="form-group">
						<input type="text"  id="detalle" class="form-control" name="detalles_otros" title="INTRODUSCA EL DETALLE"  placeholder="Detalle" required />
					</div><br>

				</div>
				<br><br>
				<div>
					<div class="btnproforma">
						<input type="submit" value="Agregar al carrito" id="agregarbtnotros" class="btn btn-success" name="Agregarotros">
					</div>
				</div>

				<br><br>

				<div class="detalle">
					<table>
						<tr>
							<td><label>Precio unitario</label></td>
							<td><input type="number" name="preciou_otros" ></td>
						</tr>
						<tr>
							<td><label>precio total</label></td>
							<td><input type="number" name="preciot_otros" ></td>
						</tr>
					</table>						
				</div>

			</form>
		</div>
		<!--////////////////////////////////////////////////////////////////////////////////////////////-->
		<div class="articulos">
			<h2 class="titulo-prinsipal-cotizacion">ACCESORIOS</h2>
			<form id="artf" name="artf">
				<div class="formu estilo">
					<select id="articulosel" name="art" class="form-control">
						<option>Seleccione un articulo</option>
						<?php
						while($racc = mysqli_fetch_array($accesorio)){
							?>
							<option value="<?=$racc['id']?>"><?=utf8_decode ($racc['nombre'])?></option>
							<?php
						}
						?>
					</select>
					<div class="form-group">
						<input type="number"  id="cantpro" class="form-control" name="cantpro" title="Introdusca la cantidad"  placeholder="Cantidad" required />
					</div>
				</div>
				
				<div class="btnproforma">
					<input type="button" value="Agregar al carrito" id="articulobtncat" class="btn btn-success" name="Agregarart">
				</div>
			</form>
		</div>
		<!--////////////////////////////////////////////////////////////////////////////////////////////-->
		<div class="carrito">
			<div class="proformadetalle">
				<h1><img src="../img/libreta.png" width="30px"> 
					<?php echo $nombreproforma;?>
				</h1>
				<button  id="datosclientebtn" class="btn btn-success" name="datos_cliente"><img src="../img/libreta.png" width="30px"> Datos del cliente</button>
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
<div id="modal">
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