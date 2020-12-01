<?php 
session_start();

if(isset($_SESSION["nombre"]))
{
	$nombreusuario=$_SESSION["nombre"];
	include "cabeceraproforma.php"; 
	$idproforma=$_SESSION["idproforma"];
	$nombreproforma=$_SESSION["nombreproforma"];
	echo $introducir_datos;
	$divisa = "Bs.";
	require("classProforma.php");
	$p = new proforma();
	$cats = $p->categoriaproducto();
	$carrit = $p->buscardetalle($idproforma);
	$accesorio = $p->buscandoaccesorios();

	$categoria = $_SESSION['idcategoria'];
	echo $categoria;

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
 	

	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta name="description" content="Trabajos en carpinteria de  aluminio y vidrio templado">
		<meta name="author" content="https://justo-juez.com">
		<meta name="image" content="https://justo-juez.com/img/logo1.png">
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
		<link rel="stylesheet" href="../fontawesome/css/all.css"/>
		<link rel="shortcut icon" href="ico/icojus.ico" />
		<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="../fontawesome/js/all.js"></script>
		<style type="text/css">
			#cuerpo{width: 90%;display: inline-block;}
			.cot_otros{display: none;}
			.carrito{display: none;width: 100%;}
			.articulos{display: none;width: 100%;}
			a{cursor: pointer;}
			header{padding: 20px 0px;}
			#modal{
				width: 100%;
				height: 100%;
				background: RGBA(96,110,255,0.26);
				position: fixed;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
				z-index: 1050;
				overflow: hidden;
				-webkit-overflow-scrolling: touch;
				outline: 0;
				display: none;
			}
			#cont_modal{
				width: 50%;
				position: relative;
				top: 10%;
				background: #fff;
				border-radius: 20px;
				padding: 30px 20px;
			}
			.btn_registro{
				width: 90%;
				border:1px solid #606EFF;
				padding: 10px 5px;
				border-radius: 20px;
				color: grey;
				margin-top: 10px;
			}
			.centro{
				position: relative;
				top: 10%;
			}
		</style>
		<script type="text/javascript">
			$(function(){
				$("#menu_secundario1").click(function(){
					$(".cot_tra").css('display','inline-block');
					$(".cot_otros").css('display','none');
					$(".articulos").css('display','none');
					$(".carrito").css('display','none');
				});
				$("#menu_secundario2").click(function(){
					$(".cot_tra").css('display','none');
					$(".cot_otros").css('display','inline-block');
					$(".articulos").css('display','none');
					$(".carrito").css('display','none');
				});
				$("#menu_secundario3").click(function(){
					$(".cot_tra").css('display','none');
					$(".cot_otros").css('display','none');
					$(".articulos").css('display','inline-block');
					$(".carrito").css('display','none');
				});
				$("#menu_secundario4").click(function(){
					$(".cot_tra").css('display','none');
					$(".cot_otros").css('display','none');
					$(".articulos").css('display','none');
					$(".carrito").css('display','inline-block');
				});
				$("#datosclientebtn").click(function(){
					$("#modal").css('display','block');
				});
			});
		</script>
	</head>
	<body>
		<header>
			<button id="menu_secundario1" class=" btn btn-success"><i ></i> Cotizacion trabajos</button>
			<button id="menu_secundario2" class=" btn btn-success"><i ></i> Cotizacion otros</button>
			<button id="menu_secundario3" class=" btn btn-success"><i ></i> Accesorios</button>
			<button id="menu_secundario4" class=" btn btn-success"><i ></i> carrito</button>
		</header>
		<div id="cuerpo">
			<div class="cot_tra">
				<?php

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
							<input type="number"  id="ancho" class="form-control" name="alto" title="INTRODUSCA EL ANCHO EN MM"  placeholder="Ancho" required />
						</div>
						<div class="form-group">
							<input type="number"  id="alto" class="form-control" name="ancho" title="INTRODUSCA EL ALTO EN MM"  placeholder="Alto" required />
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
					<div>
						<div class="btnproforma">
							<input type="submit" value="Agregar al carrito" id="agregarbtnotros" class="btn btn-success" name="Agregarotros">
						</div>
					</div>

					<br><br>

					<div class="detalle">
						<p><label>Precio unitario</label><input type="number" name="preciou_otros" ></p>
						<p><label>precio total</label><input type="number" name="preciot_otros" ></p>
						
					</div>

				</form>
			</div>
			<!--////////////////////////////////////////////////////////////////////////////////////////////-->
			<div class="articulos">
				<h1>ACCESORIOS</h1>
				<table class="table table-striped">
					<tr>
						<th>Nombre</th>
						<th>Precio</th>
						<th>Cantidad</th>
						<th>Acción</th>
					</tr>
					<?php
						while($racc = mysqli_fetch_array($accesorio)){
							?>
							<tr>
								<td><?=utf8_decode ($racc['nombre'])?></td>
								<td><?=$racc['precio']?></td>
								<td><input type="number" name=""></td>
								<td><form class="articulobtn" name="articulobtn"><a value='<?=$racc['id']?>'><img src="../img/carrito.png" width="60px"></a></form></td>
							</tr>
							<?php
						}
						?>
				</table>
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
						while($rcom = mysqli_fetch_array($carrit)){
							$monto_total = $monto_total + $rcom['preciot'];
							?>
							<tr>
								<td><?=$rcom['ancho']?></td>
								<td><?=$rcom['alto']?></td>
								<td><?=$rcom['detalle']?></td>
								<td><?=$rcom['cantidad']?></td>
								<td><?=$rcom['preciou']?>  <?=$divisa?></td>
								<td><?=$rcom['preciot']?>  <?=$divisa?></td>
								<td><a value='<?=$rcom['id']?>'>modificar</a> <a value='<?=$rcom['id']?>'>eliminar</a></td>
							</tr>
							<?php
						}
						?>
					</table>
					<h2>Monto Total: <b class="text-green"><?=$monto_total?> <?=$divisa?></b></h2>
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
							<input type="text" class="form-control" name="dcliente" placeholder="Colocar el dirección del cliente"/>
						</div>
						<button type="submit" class="btn btn-success" id="ingresarDatosCliente" name="finalizar_datos_cliente"> Ingresar datos del cliente</button>
					</div>
				</form>
			</center>
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