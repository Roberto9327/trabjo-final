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
				$("#titulo4").click(function(){
					$("#subtitulo4").toggle(1000);
				});
				$("#titulo5").click(function(){
					$("#subtitulo5").toggle(1000);
				});
				$("#titulo6").click(function(){
					$("#subtitulo6").toggle(1000);
				});
				$("#titulo7").click(function(){
					$("#subtitulo7").toggle(1000);
				});
				$("#titulo8").click(function(){
					$("#subtitulo8").toggle(1000);
				});
				$("#titulo9").click(function(){
					$("#subtitulo9").toggle(1000);
				});
				$("#titulo10").click(function(){
					$("#subtitulo10").toggle(1000);
				});
				$("#titulo11").click(function(){
					$("#subtitulo11").toggle(1000);
				});
				$(".cf").click(function(){
					$("#opciones-sf").css('display','none');
				});
				$(".sf").click(function(){
					$("#opciones-sf").css('display','inline-block');
				});
			});
			function formatear(dato) {
	            return dato.replace(/./g, function(c, i, a) {
	                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
	            });
	        }
	        function calcular(){
	            var valor = document.getElementById("preciou").value;
	            var valor2 = document.getElementById("porcentaje").value;
	            if (valor == "") {
	            	valor = 0;
	            };
	            if (valor2 == "") {
	            	valor2 = 0;
	            };
	            var porce = (parseInt(valor2)/100)*(valor);
	            var suma = parseInt(porce) + parseInt(valor);
	            if (suma == "NaN") {
	            	Suma = 0;
	            }else{
	            	suma = parseInt(porce) + parseInt(valor);
	            };
	            $("#total-input").val(formatear(suma.toFixed(2)))
	        }
	        function seleccionado(){
			    var opt = $('#tipoboleta').val();
			   // alert(opt);
			    if(opt=='Factura'){
			        $('#opciones-sf').hide();
			    }
			    if(opt=='Proforma'){
			        $('#opciones-sf').show();
			    }
			    if(opt=='Receibo'){
			        $('#opciones-sf').show();
			    }
			    if(opt=='Nota de venta'){
			        $('#opciones-sf').show();
			    }
			}
		</script>
		<style type="text/css">
			body{background: #eaeaea!important;}
			hr{margin-top: 0px;margin-bottom: 0px;}
			.puntero{cursor: pointer;margin: 0px 0px;padding: 9px 20px!important;}
			.puntero:hover{background: rgba(0, 0, 0, 0.8)}
			#subtitulo1,#subtitulo2,#subtitulo3,#subtitulo4,#subtitulo5,#subtitulo6,#subtitulo7,#subtitulo8{display: none;}
			.subtitulo{padding-left: 40px!important;}
			a{text-decoration: none;}
			#datosusuarios,#datosproductos,#datosmodificarproductos{width: 90%;}
			.label{float: left;color: grey;}
			.mitad-col{display: inline-flex}
			.formu{text-align: left;}
			#opciones-sf{display: none;width: 143px;}
			#obcerbaciones{width: 662px;height: 95px;}
			#obcerbaciones{padding: 10px;font-size: 14px;}
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
						<a href="ver_producto.php?pagina=1"><h2 class="subtitulo puntero"><span class="icon-remove_red_eyevisibility"></span> Ver productos</h2></a>
						<a href="registrar_producto.php"><h2 class="subtitulo puntero"><span class="icon-add_box"></span> Agregar productos</h2></a>
						<a href="agregar_categoria.php?pagina=1"><h2 class="subtitulo puntero"><span class="icon-add_box"></span> Agregar categoria</h2></a>
						<a href="recargar_producto.php"><h2 class="subtitulo puntero"><span class="icon-content_paste"></span> Recargar productos</h2></a>
						<a href="ver_recargas.php?pagina=1"><h2 class="subtitulo puntero"><span class="icon-remove_red_eyevisibility"></span> Listar recargas de stock</h2></a>
						<a href="agregar_ubicacion.php?pagina=1"><h2 class="subtitulo puntero"><span class="icon-add_box"></span> Agregar ubicación del producto</h2></a>
						<a href="reportes_ventas.php"><h2 class="subtitulo puntero"><span class="icon-add_box"></span> Agregar ubicación del producto</h2></a>
					</div>
					<hr/>
					<h2 id="titulo3" class="puntero"><span class="icon-view_comfortable"></span> Proforma</h2>
					<div id="subtitulo3">
						<a href="../Proforma/ver_proforma.php?pagina=1"><h2 class="subtitulo puntero"><span class="icon-remove_red_eyevisibility"></span> Ver proformas</h2></a>
					</div>
					<hr/>
				</div>
<?php
}else{
	echo "termino la conexion";
}
?>
