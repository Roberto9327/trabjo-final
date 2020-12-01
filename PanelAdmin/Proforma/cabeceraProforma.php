<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
	$nombreusuario=$_SESSION["nombre"];
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Panel Administrativo</title>
		<link rel="stylesheet" href="../css/style.css"/>
		<link rel="stylesheet" href="../iconos/fonts/style.css"/>
		<link rel="stylesheet" href="../../bootstrap/css/bootstrap.css"/>
		<link rel="stylesheet" href="../../fontawesome/css/all.css"/>
		<link rel="shortcut icon" href="ico/icojus.ico" />
		<script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="../../fontawesome/js/all.js"></script>
		<script src="../../js/jquery-3.3.1.min.js"></script>
		<script src="../js/scripts.js"></script>
		<script type="text/javascript">
			$(function(){

				$('a[href*=#]').click(function() {

					if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
						&& location.hostname == this.hostname) {

						var $target = $(this.hash);

					$target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');

					if ($target.length) {

						var targetOffset = $target.offset().top;

						$('html,body').animate({scrollTop: targetOffset}, 1000);

						return false;

					}

				}

			});

			});
			$(document).ready(function(){
				$("#titulo1").click(function(){
					$("#subtitulo1").toggle(1000);
				});
				$("#titulo2").click(function(){
					$("#subtitulo2").toggle(1000);
				});
				$("#titulo3").click(function(){
					$("#subtitulo3").toggle(1000);
				});
			});

		</script>
		<style type="text/css">
			body{background: #eaeaea!important;}
			hr{margin-top: 0px;margin-bottom: 0px;}
			.puntero{cursor: pointer;margin: 0px 0px;padding: 9px 20px!important;}
			.puntero:hover{background: rgba(0, 0, 0, 0.8)}
			#subtitulo1,#subtitulo2,#subtitulo3{display: none;}
			.subtitulo{padding-left: 40px!important;}
			a{text-decoration: none;}
			#datosusuarios{width: 90%;}
			.tabla{display: inline-block;float: left;max-width: 100%;margin-left: 52px;font-size: 25px;}
			#contenidos2{width: 90%;}
		</style>
	</head>
	<body>
		<div id="cuerpo">
			<div id="menupanel">
				<div class="imgperfil">
					<img src="../../img/logo1.png">
				</div>
				<div class="nombredeusuario">
					<?=$nombreusuario?>
				</div>
				<div class="menuprinsipal">
					<a href="../../home.php"><h2><span class="icon-storage"></span> Menu</h2></a>
					<hr/>
					<h2 id="titulo1" class="puntero"><span class="icon-view_comfortable"></span> Usuarios</h2>
					<div id="subtitulo1">
						<a href="../Usuarios/ver_usuarios.php?pagina=1"><h2 class="subtitulo puntero"><span class="icon-remove_red_eyevisibility"></span> Ver usuarios</h2></a>
						<a href="../Usuarios/registrar_usuarios.php"><h2 class="subtitulo puntero"><span class="icon-add_box"></span> Agregar usuarios</h2></a>
					</div>
					<hr/>
					<h2 id="titulo2" class="puntero"><span class="icon-view_comfortable"></span> Productos</h2>
					<div id="subtitulo2">
						<a href="../Productos/ver_producto.php?pagina=1"><h2 class="subtitulo puntero"><span class="icon-remove_red_eyevisibility"></span> Ver productos</h2></a>
						<a href="../Productos/registrar_producto.php"><h2 class="subtitulo puntero"><span class="icon-add_box"></span> Agregar productos</h2></a>
						<a href="../Productos/agregar_categoria.php?pagina=1"><h2 class="subtitulo puntero"><span class="icon-add_box"></span> Agregar categoria</h2></a>
						<a href="../Productos/recargar_producto.php"><h2 class="subtitulo puntero"><span class="icon-content_paste"></span> Recargar productos</h2></a>
						<a href="../Productos/ver_recargas.php?pagina=1"><h2 class="subtitulo puntero"><span class="icon-remove_red_eyevisibility"></span> Listar recargas de stock</h2></a>
						<a href="../Productos/agregar_ubicacion.php?pagina=1"><h2 class="subtitulo puntero"><span class="icon-add_box"></span> Agregar ubicación del producto</h2></a>
						<a href="../Productos/reportes_ventas.php"><h2 class="subtitulo puntero"><span class="icon-add_box"></span> Agregar ubicación del producto</h2></a>
					</div>
					<hr/>
					<h2 id="titulo3" class="puntero"><span class="icon-view_comfortable"></span> Productos</h2>
					<div id="subtitulo3">
						<a href="ver_proforma.php?pagina=1"><h2 class="subtitulo puntero"><span class="icon-remove_red_eyevisibility"></span> Ver productos</h2></a>
					</div>
					<hr/>
				</div>
<?php
}else{
	echo "termino la conexion";
}
?>
