<?php
include ('mpdf.php');
$html="Hola";
$mpdf=new mPDF();
$mpdf->mPDF('utf-8','A4','','','15','15','18','13','7','7');
$mpdf->WriteHTML($html);
$mpdf->Output('programacion-mensual.pdf','I');
// -------------end test mpdf----------------------

?>