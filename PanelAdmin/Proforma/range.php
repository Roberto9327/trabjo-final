<?php

	$conn=mysqli_connect("localhost", "root", "", "tiendabd");
	
	if(!$conn){
		die("Error: Failed to connect to database!");
	}

	if (ISSET($_GET['pagina'])) {
		if(ISSET($_POST['search'])){
			date_default_timezone_set("America/La_Paz"); // ("America/Santiago") por ejemplo
			$timestamp = time();
			$hoy = getdate($timestamp);
			///mes
			if (strlen($hoy["mon"])==1) {
				$mes = "0".$hoy["mon"];
			}
			else{
				$mes = $hoy["mon"];
			}
			///dia
			if (strlen($hoy["mday"])==1) {
				$dia = "0".$hoy["mday"];
			}
			else{
				$dia = $hoy["mday"];
			}
			///hora
			if (strlen($hoy["hours"])==1) {
				$hora = "0".$hoy["hours"];
			}
			else{
				$hora = $hoy["hours"];
			}
			///minutos
			if (strlen($hoy["minutes"])==1) {
				$min = "0".$hoy["minutes"];
			}
			else{
				$min = $hoy["minutes"];
			}
			///segundos
			if (strlen($hoy["seconds"])==1) {
				$sec = "0".$hoy["seconds"];
			}
			else{
				$sec = $hoy["seconds"];
			}

			$fecha = $hoy["year"]."-".$mes."-".$dia;
		$nombrepro = $_POST['nombreProducto'];
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));
		$comparar =  date("Y-m-d", strtotime('31-12-1969'));
		if ($date2 <= $comparar) {
			$date2 = $fecha;
			
		}
		$_SESSION['buscarnombre']=$nombrepro;
		$_SESSION['fechaini']=$date1;
		$_SESSION['fechafin']=$date2;
		$nombrepro = $_SESSION['buscarnombre'];
		$date1=$_SESSION['fechaini'];
		$date2=$_SESSION['fechafin'];
		$_SESSION['preciototalregistro']=0;
		if ($nombrepro == "") {
			$contar_inv =$p->contarprorecarga($date1,$date2);
		}else{
			$contar_inv =$p->contarprorecargan($nombrepro,$date1,$date2);
		}
		
		$articulo_x_pagina = 10;
		//echo $contar_inv;
		$paginas = $contar_inv / $articulo_x_pagina;
		$paginas = ceil($paginas);
		if (!$_GET || $_GET['pagina'] <=0 ||$_GET['pagina'] > $paginas) {
			echo "<script>location.href='ver_proforma.php?pagina=1'</script>";
		}

		$iniciar = ($_GET['pagina']-1) * $articulo_x_pagina;
		if ($nombrepro == "") {
			$listar_reporte = $p->reporteTotalProducto($date1,$date2,$iniciar,$articulo_x_pagina);
		}else{
			$listar_reporte = $p->reporteTotalProducton($nombrepro,$date1,$date2,$iniciar,$articulo_x_pagina);
		}
		/*$listar_reporte = $p->reporteTotalProducto($date1,$date2,$iniciar,$articulo_x_pagina);
		$listar_precio_reporte = $p->reporteTotalProductoprecio($date1,$date2);*/
		$cadena = "";
		$ancho = "";
		$medida ="";
		$n = mysqli_num_rows($listar_reporte);
		if($n>0){
			while($fetch=mysqli_fetch_array($listar_reporte)){
?>
	<tr>
		<td><?php echo $fetch['nombre']?></td>
		<td><?php echo $fetch['fecha']?></td>
		<td><a href='detalle_proforma.php?id=<?=$fetch['id']?>'><img src="../img/ojo.png" width="22px" title="ver detalle de proforma">&nbsp; </a></td>
	</tr>
<?php
			}
		}else{
			echo'
			<tr>
				<td colspan = "4"><center>Registros no Existen</center></td>
			</tr>';
		}
	}
	}
	if (isset($_GET['paginacion']))
	{
	 if (isset($_SESSION['fechaini']) || isset($_SESSION['fechafin'])) {
		
		$nombrepro = $_SESSION['buscarnombre'];
		$date1=$_SESSION['fechaini'];
		$date2=$_SESSION['fechafin'];
		/*$contar_inv =$p->contarprorecarga($date1,$date2);*/
		if ($nombrepro == "") {
			$contar_inv =$p->contarprorecarga($date1,$date2);
		}else{
			$contar_inv =$p->contarprorecargan($nombrepro,$date1,$date2);
		}
		$articulo_x_pagina = 10;
		//echo $contar_inv;
		$paginas = $contar_inv / $articulo_x_pagina;
		$paginas = ceil($paginas);
		if (!$_GET || $_GET['pagina'] > $paginas) {
			echo "<script>location.href='ver_proforma.php?pagina=1'</script>";
		}
		if ($_GET['pagina'] <=0) {
			echo "<script>location.href='ver_proforma.php?pagina=1&paginacion=1'</script>";
		}
		$iniciar = ($_GET['pagina']-1) * $articulo_x_pagina;
		if ($nombrepro == "") {
			$listar_reporte = $p->reporteTotalProducto($date1,$date2,$iniciar,$articulo_x_pagina);
		}else{
			$listar_reporte = $p->reporteTotalProducton($nombrepro,$date1,$date2,$iniciar,$articulo_x_pagina);
		}
		/*$listar_reporte = $p->reporteTotalProducto($date1,$date2,$iniciar,$articulo_x_pagina);
		$listar_precio_reporte = $p->reporteTotalProductoprecio($date1,$date2);*/
		$cadena = "";
		$ancho = "";
		$medida ="";
		$n = mysqli_num_rows($listar_reporte);
		if($n>0){
			while($fetch=mysqli_fetch_array($listar_reporte)){
						
	?>
	<tr>
		<td><?php echo $fetch['nombre']?></td>
		<td><?php echo $fetch['fecha']?></td>
		<td><a href='detalle_proforma.php?id=<?=$fetch['id']?>'><img src="../img/ojo.png" width="22px" title="ver detalle de proforma">&nbsp; </a></td>
	</tr>
<?php
			}
		}
	
	}  


	}
	
	
?>
