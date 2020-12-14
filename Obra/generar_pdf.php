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
<body><center>
<br>
<table >
<tr>
<td style='width:250px;text-align:left;'>
    <img src='../img/logo1.png' style='width:70px;'>
    <p>
        <b>Vidrieria Justo Juez</b><br>
        Cuarto anillo diagonal 2 de agosto<br>
        Telf 72693473 - 33604354
    </p>
</td>
<td style='width:250px;text-align:center;'><h3>Detalle de Obra</h3></td>
<td style='width:250px;text-align:rigth;'></td>
</tr>
</table></center>";
/*require('classProforma.php');
$descr=$_POST["tb"];
$p=new proforma();
$filas=$p->reportesProductosPorDescripcion($descr);
$n=$filas->num_rows;*/

    include "classobra.php";
    $p = new obra();
    $idObra = $_GET['id'];
    $buscarobras = $p->buscarObra($idObra);
    $fila=mysqli_fetch_array($buscarobras);
    $nombreobra = $fila[1];
    $idcotizacion = $fila[2];

    $idbuscarcotizacion = $p->buscarcotizacion($idcotizacion);
    $filacot = mysqli_fetch_array($idbuscarcotizacion);
    $cliente = $filacot[2];

    $buscarnombredecliente = $p->buscarCliente($cliente);
    $filacli=mysqli_fetch_array($buscarnombredecliente);
    $idcliente = $filacli[0];
    $nombreC =  $filacli[1];
    $telefonoC =  $filacli[2];
    $nit =  $filacli[3];

    $divisa ="Bs.";

    $cont_obra = $p->contenidoobra($idObra);
    $cont_pago = $p->contenidopago($idObra,$idcliente);
    $productoproforma = $p->listarproductosproforma($idcotizacion);
    $productoproformae = $p->listarproductosproformae($idcotizacion);

    $resultado.="
    <table>
                    <tr>
                        <td ><b>Obra:</b></td>
                        <td >".$nombreobra."</td>
                    </tr>
                    <tr>
                        <td><b>Cliente:</b></td>
                        <td>".$nombreC."</td>
                    </tr>
                    <tr>
                        <td ><b>Telefono:</b></td>
                        <td >".$telefonoC."</td>
                    </tr>
                    <tr>
                        <td><b>Nit:</b></td>
                        <td>".$nit."</td>
                    </tr>
        </table>
    <br>
        <b>Materiales Utilizados</b>
    <table  border='1' cellspacing='0' cellpadding='2' >
                    <tr>
                        <th style='width:500px;'>Detalle</th>
                        <th style='width:100px;'>Cantidad</th>
                        <th style='width:100px;'>Precio</th>
                        <th style='width:100px;'>Fecha</th>
                     </tr>";
                     $monto_total = 0;
    while($rcom = mysqli_fetch_array($cont_obra)){
    $monto_total = $monto_total + $rcom['precio'];
        $resultado.="<tr>
                        <td style='text-align:left;'>".$rcom['nombre']."</td>
                        <td style='text-align:center;'>".$rcom['cantidad']."</td>
                        <td style='text-align:center;'>".$rcom['precio']."</td>
                        <td style='text-align:center;'>".$rcom['fecha']."</td>
        </tr>";
    }
    $resultado.="</table>
    <br>
    <b>pagos del cliente</b>
    <table  border='1' cellspacing='0' cellpadding='2' >
                    <tr>
                        <th style='width:500px;'>Detalle</th>
                        <th style='width:100px;'>Monto</th>
                        <th style='width:100px;'>Fecha</th>
                     </tr>";
                     $monto_total_pago = 0;
    while($rpag = mysqli_fetch_array($cont_pago)){
    $monto_total_pago = $monto_total_pago + $rpag['monto'];
        $resultado.="<tr>
                        <td style='text-align:left;'>".$rpag['detalle']."</td>
                        <td style='text-align:center;'>".$rpag['monto']."</td>
                        <td style='text-align:center;'>".$rpag['fecha']."</td>
        </tr>";
    }
    $resultado.="</table>

    <br>
    <b>Cotización</b>
    <table  border='1' cellspacing='0' cellpadding='2' >
                    <tr>
                        <th style='width:500px;'>Nombre del producto</th>
                        <th style='width:100px;'>Cantidad</th>
                        <th style='width:100px;'>Precio por unidad</th>
                        <th style='width:100px;'>Precio Total</th>
                     </tr>";
    $monto_total_proforma = 0;
                    while($rprof = mysqli_fetch_array($productoproforma)){
                        $monto_total_proforma = $monto_total_proforma + $rprof['preciot'];
                        if ($rprof['ancho'] == 0 ) {
                           $ancho = "";
                        }else{
                            $ancho = $rprof['ancho'];
                        }
                        if ($rprof['alto'] == 0) {
                           $alto = "";
                        }else{
                            $alto = $rprof['alto'];
                        }
                         
                        $resultado.="<tr>";
                        if ($rprof['alto'] == 0 || $rprof['ancho'] == 0) {
                           $resultado.=" <td style='text-align:left;' >".$rprof['detalle']."</td>";
                        }else{
                            $resultado.=" <td style='text-align:left;' >".$rprof['detalle']." ".$ancho." X ".$alto."</td>";
                        }
                       $resultado.="
                           <td style='text-align:center;'>".$rprof['cantidad']."</td>
                            <td style='text-align:center;'>".$rprof['preciou']."</td>
                            <td style='text-align:center;'>".$rprof['preciot']."</td>
                        </tr>";
                    }
    $resultado.="</table><br>
    <b>adicionales</b>
    <table  border='1' cellspacing='0' cellpadding='2' >
                    <tr>
                        <th style='width:500px;'>Nombre del producto</th>
                        <th style='width:100px;'>Cantidad</th>
                        <th style='width:100px;'>Precio por unidad</th>
                        <th style='width:100px;'>Precio Total</th>
                     </tr>";
                     $monto_total_proformae = 0;
                    while($rprofe = mysqli_fetch_array($productoproformae)){
                        $monto_total_proformae = $monto_total_proformae + $rprofe['preciot'];
                        if ($rprofe['ancho'] == 0 ) {
                           $anchoe = "";
                        }else{
                            $anchoe = $rprofe['ancho'];
                        }
                        if ($rprofe['alto'] == 0) {
                           $altoe = "";
                        }else{
                            $altoe = $rprofe['alto'];
                        }
                         
                        $resultado.="<tr>";
                        if ($rprofe['alto'] == 0 || $rprofe['ancho'] == 0) {
                           $resultado.=" <td style='text-align:left;' >".$rprofe['detalle']."</td>";
                        }else{
                            $resultado.=" <td style='text-align:left;' >".$rprofe['detalle']." ".$anchoe." X ".$altoe."</td>";
                        }
                       $resultado.="
                           <td style='text-align:center;'>".$rprofe['cantidad']."</td>
                            <td style='text-align:center;'>".$rprofe['preciou']."</td>
                            <td style='text-align:center;'>".$rprofe['preciot']."</td>
                        </tr>";
                    }
    $resultado.="</table> <br><br>";

                $monto_total_proforma = $monto_total_proforma + $monto_total_proformae;
                $resultado.="<b>Detalle de movimiento</b><table  border='1' cellspacing='0' cellpadding='2' >
                        <tr>
                            <td>Monto Total compras:</td>
                            <td><b>".$monto_total." ".$divisa."</b></td>
                        </tr>
                        <tr>
                            <td>Monto pagado:</td>
                            <td><b>".$monto_total_pago." ".$divisa."</b></td>
                        </tr>
                        <tr>
                            <td>Deuda del Cliente:</td>
                            <td>";
                                $saldo = $monto_total_proforma - $monto_total_pago;

                $resultado.="<b>".$saldo." ".$divisa."</b>
                            </td>
                        </tr>
                        <tr>
                            <td>Monto Total obra:</td>
                            <td><b>".$monto_total_proforma." ".$divisa."</b></td>
                        </tr>";
                            if ($monto_total < $monto_total_proforma) {
                                $diferencia = $monto_total_proforma - $monto_total;
                $resultado.=" <tr>
                                    <td >Se tiene una ganancia de:</td>
                                    <td><b >".$diferencia." ".$divisa."</b></td>
                                </tr>";
                            }
                            if ($monto_total > $monto_total_proforma) {
                                $diferencia = $monto_total_proforma - $monto_total;
                $resultado.="<tr>
                                    <td >Se tiene una perdida de:</td>
                                    <td><b >".$diferencia." ".$divisa."</b></td>
                                </tr>";
                            }
                           $resultado.=" </table>";
$resultado.="</body></html>";
include("../mpdf/mpdf.php");
$mpdf=new mPDF();
//$mpdf->mPDF('utf-8','A4','','','15','15','18','13','7','7');
$mpdf->WriteHTML($resultado);
$mpdf->Output('Productos.pdf','I');
?>