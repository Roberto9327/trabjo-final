<?php
if(isset($_SESSION["nombre"]))
{
$nombreusuario=$_SESSION["nombre"];

?>

<html>
<head>
<title>INVENTARIO</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../css/styles.css?v=1.20">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" href="../fontawesome/css/all.css"/>
<link rel="shortcut icon" href="ico/icojus.ico" />
<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="../fontawesome/js/all.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/scripts.js"></script>
<script type="text/javascript" src="../js/l-20.js"></script>
<script type="text/javascript" src="../js/vtemplado.js"></script>
<script type="text/javascript" src="../js/l-203y4.js"></script>
<script>
$(function(){
 $("#menu ul li").eq(0).css("background","#3F7FBF");
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
      });
</script>
<style type="text/css">
  #subtitulo1,#subtitulo2,#subtitulo3,#subtitulo4,#subtitulo5,#subtitulo6,#subtitulo7,#subtitulo8{display: none;}
  .puntero{cursor: pointer;margin: 0px 0px;padding: 9px 20px!important;}
  .puntero:hover{background: rgba(0, 0, 0, 0.8)}
  .subtitulo{padding-left: 40px!important;font-size: 14px!important;}
   a{text-decoration: none;cursor: pointer;}
   a:hover{text-decoration: none;}
  .titulo-prinsipal-cotizacion{color:grey;}
  #csesionu{color: #fff !important;  }
</style>
</head>
<body>
<div id="cuerpo">
<div id="menupanel">
            <div class="imgperfil">
              <img src="../img/logo1.png">
            </div>
            <div class="nombredeusuario">
              <?=$nombreusuario?>
            </div>
          <h2 id="titulo3" class="puntero"><span class="icon-view_comfortable"></span> 
            <div id="cerrasesion">
              <a id="csesion">Cerrar Sesión</a>
           </div> 
          </h2>
          <hr/>
          <div class="menuprinsipal">
          <?php 
              if ($_SESSION["AccesoSuperUser"] == 'Administrador') {
           ?>
                 <a href="../PanelAdmin"><h2><span class="icon-storage"></span> Panel Administrativo</h2></a>
                   <hr/>
           <?php
            }
           ?>
          <a href="../home.php"><h2><span class="icon-storage"></span> Inicio</h2></a>
          <hr/>
          <a href="../Proforma"><h2><span class="icon-storage"></span> Proforma</h2></a>
          <hr/>
          <a href="../Inventario"><h2><span class="icon-storage"></span> Inventario</h2></a>
          <hr/>
          <a><h2 id="titulo1"><span class="icon-storage"></span> Directorio</h2></a>
            <div id="subtitulo1">
              <a href="../Directorio"><h2 class="subtitulo puntero"><span class="icon-remove_red_eyevisibility"></span> Ver directorio</h2></a>
            </div>
          <hr/>
          <a><h2 id="titulo2"><span class="icon-storage"></span> Obras</h2></a>
            <div id="subtitulo2">
              <a href="../Obra/ver_obra.php?pagina=1"><h2 class="subtitulo puntero"><span class="icon-remove_red_eyevisibility"></span> Ver Obras</h2></a>
              <a href="../Obra/nueva_obra.php"><h2 class="subtitulo puntero"><span class="icon-remove_red_eyevisibility"></span> Nueva Obras</h2></a>
            </div>
          <hr/>
          <a><h2 id="titulo4"><span class="icon-storage"></span> Proveedores</h2></a>
            <div id="subtitulo4">
              <a href="../Proveedores/index.php?pagina=1"><h2 class="subtitulo puntero"><span class="icon-remove_red_eyevisibility"></span> Ver proveedores</h2></a>
              <a href="../Proveedores/nuevo_proveedor.php"><h2 class="subtitulo puntero"><span class="icon-remove_red_eyevisibility"></span> Nuevo proveedor</h2></a>
            </div>
          <hr/>
        </div>

        </div>
<?php
}
else
{
	header('Location: https://justo-juez.com/medicion');
} 
?>