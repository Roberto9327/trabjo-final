<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["nombre"]))
{
$nombreusuario=$_SESSION["nombre"];
}
else
{
 header('Location: http://localhost/medicion');
}
$resultado="
<!Doctype html> 
<html> 
<head> 
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
</head>
<body><center><table >
<tr>
<td style='width:250px;text-align:left;'>
    <img src='../img/logo1.png' style='width:70px;'>
    <p>
        <b>Vidrieria Justo Juez</b><br>
        Cuarto anillo diagonal 2 de agosto<br>
        Telf 72693473 - 33604354
    </p>
</td>
<td style='width:250px;text-align:center;'><h3>Cotización</h3></td>
<td style='width:250px;text-align:rigth;'></td>
</tr>
</table></center>";
/*require('classProforma.php');
$descr=$_POST["tb"];
$p=new proforma();
$filas=$p->reportesProductosPorDescripcion($descr);
$n=$filas->num_rows;*/

if (!isset($_SESSION["idproducto"])) {
    $n=0;
}else{
    $contador = $_SESSION["idproducto"];
     $n=count($contador);
}
    $resultado.="<p style='text-align:center;font-weight:bold;font-size:10px;'>La cantidad de Productos: ".$n."</p>";
    $resultado.="<table border='1' cellspacing='0' cellpadding='2' class='tabla'><tr><th style='width:60px;'>Ancho</th><th style='width:60px;'>Alto</th><th style='width:350px;'>Descripción</th><th style='width:60px;'>Precio Venta</th><th style='width:80px;'>Precio compra</th><th style='width:60px;'>cantidad</th></tr>";
    for($i=0;$i<$n;$i++)
   {
        $resultado.="<tr>
        <td style='text-align:center;font-size:13px;'>".$_SESSION["ancho"][$i]."</td>
        <td style='text-align:center;font-size:13px;'>".$_SESSION["alto"][$i]."</td>
        <td style='text-align:left;font-size:13px;'>".$_SESSION["nombreproducto"][$i]."</td>
        <td style='text-align:center;font-size:13px;'>".$_SESSION["precioventa"][$i]."</td>
        <td style='text-align:center;font-size:13px;'>".$_SESSION["cantidad"][$i]."</td>
        <td style='text-align:center;font-size:13px;'>".$_SESSION["total"][$i]."</td>
        </tr>";
    }
    $resultado.="</table>";

$resultado.="</body></html>";
include("../mpdf/mpdf.php");
$mpdf=new mPDF();
//$mpdf->mPDF('utf-8','A4','','','15','15','18','13','7','7');
$mpdf->WriteHTML($resultado);
$mpdf->Output('Productos.pdf','I');
?>