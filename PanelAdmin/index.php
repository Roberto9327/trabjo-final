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
				</div>
				<div id="contenidos">
					<div id="content-menu">
				 		<a href="Usuarios/ver_usuarios.php?pagina=1"><div class="box-opcion"><img src="img/usuarios.png"><p>USUARIOS</p></div></a>
						<a href="Productos/ver_producto.php?pagina=1"><div class="box-opcion"><img src="img/productos.png"><p>PRODUCTO</p></div></a>
				 		<a href="Proforma/ver_proforma.php?pagina=1"><div class="box-opcion"><img src="img/proforma.png"><p>PROFORMAS</p></div></a>
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