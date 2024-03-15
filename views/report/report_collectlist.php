<?php
if (!session_id()) session_start();
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Bangkok');

require_once '../../public/mpdf/vendor/autoload.php';
require_once '../../core/functions.php';
require_once '../../connect/conDB.php';
require_once '../../model/Report.class.php';

$id = $_REQUEST['contractid'];

$report = new Report();
// $client = $report->listreportsalesClient("contract");
$clientlinework = $report->getInfoLinework("linework", $_POST['linework_id']);


$date_start = $_POST['date_start'];
$date_end = $_POST['date_end'];
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
$head = '
    <style>

        body{
            font-family: "Garuda";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
        } 
        .textsizeA{
            font-size:14px;
        }
        .textsizeB{
            font-size:14px;
        }
        .lineup{
            margin-top:12px;
        } 

    </style>
    
    ';

$content = '
<div style="border: 0px solid black;padding:0px;">
  <table style="width:100%;margin-top:5px;" cellpadding=0 cellspacing=0 border="0">
      <tr>
          <td style="width:15%;text-align:left;">
              <span style="border-bottom:2px;font-size:17px;"><b>รายงานยอดเก็บ</b> </span>
          </td>
          <td style="width:20%;text-align:left;">
              <span style="border-bottom:2px;font-size:13px;">ระหว่างวันที่ &ensp;' . changeDate($date_start) . ' </span>
          </td>
          <td style="width:15%;text-align:left;">
              <span style="border-bottom:2px;font-size:13px;">ถึงวันที่ &ensp;' . changeDate($date_end) . ' </span>
          </td>
          <td style="width:23%;" align="left">
          สายบริการ : ' . $clientlinework['lw_code'] . '-' . $clientlinework['lw_name'] . '
          </td>
          <td style="width:12%;" align="right">
          </td>
      </tr>
  </table>
  <table style="margin-top:12px;width:100%;border-collapse: collapse;" cellpadding=3 cellspacing=1 border="1">
        <tr style="border: 1px solid black;">
            <td style="background-color: #D3D3D3;padding:7px;text-align:center;font-size:13px;">ลำดับ</td>
            <td style="background-color: #D3D3D3;font-size:13px;">เลขที่สัญญา</td>
            <td style="background-color: #D3D3D3;font-size:13px;">รหัสลูกค้า</td>
            <td style="background-color: #D3D3D3;font-size:13px;">ชื่อ-นามสกุลผู้ซื้อ</td>
            <td style="background-color: #D3D3D3;font-size:13px;">วันที่เริ่มสัญญา</td>
            <td style="background-color: #D3D3D3;font-size:13px;">วันที่หมดสัญญา</td>
            <td style="background-color: #D3D3D3;font-size:13px;">ราคาขาย</td>
            <td style="background-color: #D3D3D3;font-size:13px;">เก็บรวม</td>
            <td style="background-color: #D3D3D3;font-size:13px;">เก็บต่อวัน</td>
            <td style="background-color: #D3D3D3;font-size:13px;">ยอดคงเหลือ</td>
            <td style="background-color: #D3D3D3;font-size:13px;">พนักงานขาย</td>
        </tr>';
$i = 1;
$ii = 0;
$sumsales = 0; //ราคาขาย
$sumpayamount = 0; //เก็บรวม
$suminstallmentsdaily = 0; //เก็บต่อวัน
$sumpaybalance = 0; //ยอดคงเหลือ
foreach ($report->listreportcollectClient("contract", $date_start, $date_end) as $client) :
    $clientcollect = $report->listreportcollectClientSub("payments", $date_start, $date_end, $client['contract_id']);
    $paysumpaybalance = ($client['cash_principle'] + $client['cash_interest'])-($clientcollect['sumPaymentCollectionAmount']); //ยอดคงเหลือ
    $content .= '
          <tr style="border: 1px solid black;">
            <td style="padding:6px;font-size:13px;text-align:center;">' . $i . '</td>
            <td style="padding:6px;font-size:13px;">' . $client['contract_number'] . '</td>
            <td style="padding:6px;font-size:13px;">' . $client['cus_card_id'] . '</td>
            <td style="padding:6px;font-size:13px;">' . $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname'] . '</td>
            <td style="padding:6px;font-size:13px;">' . changeDate($client['cash_date_start']) . '</td>
            <td style="padding:6px;font-size:13px;">' . changeDate($client['cash_date_end']) . '</td>
            <td style="padding:6px;font-size:13px;" align="right">' . number_format($client['cash_principle'] + $client['cash_interest']) . '</td>
            <td style="padding:6px;font-size:13px;" align="right">' . number_format($clientcollect['sumPaymentCollectionAmount']) .'</td>
            <td style="padding:6px;font-size:13px;" align="right">' . number_format($client['cash_installments_daily']) . '</td>
            <td style="padding:6px;font-size:13px;" align="right">' . number_format($paysumpaybalance) . '</td>
            <td style="padding:6px;font-size:13px;">' . $client['contract_personnelhead_name'] . '</td>
          </tr>
          ';
    $i++;
    // $ii = 0;
    $ii++;
    // $sumsales = $sumsales + ($client['cash_principle'] + $client['cash_interest']);
    // $sumpayamount = $sumpayamount + ($client['paysum_pay_amount']);
    // $suminstallmentsdaily = $suminstallmentsdaily + ($client['cash_installments_daily']);
    // $sumpaybalance = $sumpaybalance + ($client['paysum_pay_balance']);
    /////////////edit 19-11-66/////////////
    $sumsales = $sumsales + ($client['cash_principle'] + $client['cash_interest']);
    $sumpayamount = $sumpayamount + ($clientcollect['sumPaymentCollectionAmount']);
    $suminstallmentsdaily = $suminstallmentsdaily + ($client['cash_installments_daily']);
    $sumpaybalance = $sumpaybalance + ($paysumpaybalance);
endforeach;
$content .= '<tr style="border: 1px solid black;background-color: #D3D3D3;">
                <td style="padding:6px;font-size:13px;" colspan="6">รวม ' . $ii . ' คน</td>
                <td style="padding:6px;font-size:12px;" align="right">' . number_format($sumsales) . '</td>
                <td style="padding:6px;font-size:12px;" align="right">' . number_format($sumpayamount) . '</td>
                <td style="padding:6px;font-size:12px;" align="right">' . number_format($suminstallmentsdaily) . '</td>
                <td style="padding:6px;font-size:12px;" align="right">' . number_format($sumpaybalance) . '</td>
                <td style="padding:6px;font-size:12px;" align="right"></td>
            </tr>';
$content .= '</table>
        </div>';

$footerreport = '<table width="100%" style="vertical-align: bottom; font-family: Garuda; 
font-size: 8pt; color: #000000; font-weight: bold;padding-bottom:-15px;">
<tr>
    <td width="33%"></td>
    <td width="33%" align="center">{PAGENO}/{nbpg}</td>
    <td width="33%" style="text-align: right;"></td>
</tr>
</table>';

// $mpdf->AddPage('L');
$mpdf->SetHTMLFooter($footerreport);
$mpdf->AddPageByArray([
    'margin-left' => 7,
    'margin-right' => 7,
    'margin-top' => 13,
    'margin-bottom' => 10,
]);
// $stylesheet = file_get_contents('../../public/plugins/fontawesome-free/css/all.min.css');
// $mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($head);
$mpdf->WriteHTML($content);
// $mpdf->setFooter('{PAGENO} of {nbpg}');
$mpdf->Output();


    // $mpdf = new \Mpdf\Mpdf();
    // $mpdf->WriteHTML('<h1>Hello world!</h1>');
    // $mpdf->Output();
