<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
	$nombreusuario=$_SESSION["nombre"];
	if (!$_GET) {
		header('Location:ver_producto.php?pagina=1');
	}
	$iduser = $_GET['id'];
	include "../php/classUser.php";
$p = new user();
	$mostrar = $p->buscaruser($iduser);
	$fila=mysqli_fetch_array($mostrar);
	 $nombre = $fila[2];
	 $usuario = $fila[3];
	 $pass = $fila[4];
	 $categoria = $fila[5];
	 

	include "cabeceraUsuario.php";
	?>
</div>
<div id="contenidos">
	<h1>Modificar usuario</h1>
	<form  id="datosmodificarusuarios" name="datosmodificarusuarios">
		<div class="formu">
			<div class="form-group">
				<label class="label">Nombre del usuario</label>
				<input type="text" value="<?=$nombre?>" class="form-control" name="nombre" title="Nombre"  placeholder="Nombre del usuario" required />
			</div>
			<div class="form-group">
				<label class="label">usuario</label>
				<input type="text" value="<?=$usuario?>" class="form-control" name="Usuario" title="Usuario"  placeholder="Usuario" required />
			</div>
			<div class="form-group">
				<label class="label">contraseña</label>
				<input type="text" value="<?=$pass?>" class="form-control" name="Password" title="Password"  placeholder="Password" required />
			</div>
			<select  class="form-control" id="newcat" name="newcat">
				<option value="<?=$categoria?>"><?=$categoria?></option>
				<option value="Usuario">Usuario</option>
				<option value="Administrador" >Administrador</option>
			</select>
			<div>
				<div class="btnproforma form-group">
					<a id="modificarusuario" class="btn btn-success" name="modificarusuario" >Actualizar</a>
				</div>
			</div>

		</form>
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