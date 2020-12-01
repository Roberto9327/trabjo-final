<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]) && $_SESSION["AccesoSuperUser"] == 'Administrador')
{
	$nombreusuario=$_SESSION["nombre"];
	// if (isset($_SESSION['mensajeerror'])) {
	// 	$mensajedeerror = $_SESSION['mensajeerror'];
	// }else{
	// 	$mensajedeerror = "";
	// }
	require("../php/classUser.php");
	$p = new user();
	$cantidad_usuarios = $p->contaruser();
	$cantidad_usuarios = "USU".$cantidad_usuarios;
	include "cabeceraUsuario.php";
	?>
</div>
<div id="contenidos">
	<h1>Registrar usuarios</h1>
	<?php
	// if ($mensajedeerror != "") {
	// 	echo $mensajedeerror;
	// }
	?>
	<div id="mensajeusuario"></div>
	<form  id="datosusuarios" name="datosusuarios">
		<div class="formu">

			<div class="form-group">
				<input type="text" value="<?=$cantidad_usuarios?>"  class="form-control" name="codigo" title="Codigo del usuario"  placeholder="Codigo del usuario" readonly />
			</div>
			<div class="form-group">
				<input type="text"   class="form-control" name="nombre" title="Nombre del ususuario"  placeholder="Nombre del ususuario" required />
			</div>
			<div class="form-group">
				<input type="text"   class="form-control" name="user" title="Usuario"  placeholder="usuario" required />
			</div>
			<div class="form-group">
				<input type="text"   class="form-control" name="pass" title="contraseña"  placeholder="Password" required />
			</div>
			<select  class="form-control" id="newuser" name="newuser">
				<option value="Usuario">Usuario</option>
				<option value="Administrador" >Administrador</option>
			</select>
		</div><br>
		<div>
			<div class="btnproforma form-group">
				<a id="agregarnewuser" class="btn btn-success" name="agregarnewuser" >  Agregar nuevo usuario</a>
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