<?php
require_once '../../public/mpdf/vendor/autoload.php';
$pdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);

$pdf->useSubstitutions = false;
$pdf->setAutoTopMargin = 'stretch';
$pdf->SetDisplayMode('fullpage');




$pdf->Image('../../public/report_documentcopycard.jpg', 0, 0, 210, 28.5, 'png', '', true, false);

$pdf->Output();
