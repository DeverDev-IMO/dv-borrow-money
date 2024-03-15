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

$datenow = date('Y-m-d');
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
          <td style="width:40%;text-align:left;">
              <span style="border-bottom:2px;font-size:16px;"><b>รายงานลูกหนี้การค้ารวม ตั้งแต่เปิดมายังไม่ปิดบัญชี</b> </span>
          </td>
          <td style="width:20%;text-align:left;">
              <span style="border-bottom:2px;font-size:13px;">ณ. วันที่ &ensp;' . changeDate($date_start) . ' </span>
          </td>
          <td style="width:15%;text-align:left;">
              <span style="border-bottom:2px;font-size:13px;">พิมพ์ ณ วันที่ &ensp;' . changeDate($datenow) . ' </span>
          </td>
          <td style="width:20%;" align="left">
          สายบริการ : ' . $clientlinework['lw_code'] . '-' . $clientlinework['lw_name'] . '
          </td>

      </tr>
  </table>
  <table style="margin-top:12px;width:100%;border-collapse: collapse;" cellpadding=3 cellspacing=1 border="1">
        <tr style="border: 1px solid black;">
            <td style="background-color: #D3D3D3;padding:7px;text-align:center;font-size:13px;">ลำดับ</td>
            <td style="background-color: #D3D3D3;font-size:13px;">เลขที่สัญญา</td>
            <td style="background-color: #D3D3D3;font-size:13px;">รหัสลูกค้า</td>
            <td style="background-color: #D3D3D3;font-size:13px;">ชื่อ-นามสกุล</td>
            <td style="background-color: #D3D3D3;font-size:13px;">เบอร์โทรติดต่อ</td>
            <td style="background-color: #D3D3D3;font-size:13px;">วันที่เริ่มสัญญา</td>
            <td style="background-color: #D3D3D3;font-size:13px;">วันที่หมดสัญญา</td>
            <td style="background-color: #D3D3D3;font-size:13px;" align="right">รวมวัน</td>
            <td style="background-color: #D3D3D3;font-size:13px;" align="right">งวดที่ค้าง</td>
            <td style="background-color: #D3D3D3;font-size:13px;" align="right">ยอดที่ค้าง</td>
        </tr>';
$i = 1;
$ii = 0;
$sumall = 0;
foreach ($report->listreportDebtorType5("contract", $date_start, $date_end) as $client) :
    $clientsumpayments = $report->getInfoSumPayments($client['contract_id']); ////รวมยอดชำระเงินของเเต่ละคน
    $deleteDate = DateDiff($client['cash_date_end'], $date_start); //ฟังค์ชั้นลบวันที่หมดสัญญากับวันที่เลือก

    // $caloutstandingbalance = ($client['cash_principle'] + $client['cash_interest']) - $client['paysum_pay_amount'];
    $caloutstandingbalance = ($client['cash_principle'] + $client['cash_interest']) - $clientsumpayments['sumPaymentAmount'];
    if ($caloutstandingbalance > 0) {
        $content .= '
          <tr style="border: 1px solid black;">
            <td style="padding:6px;font-size:13px;text-align:center;">' . $i . '</td>
            <td style="padding:6px;font-size:13px;">' . $client['contract_number'] . '</td>
            <td style="padding:6px;font-size:13px;">' . $client['cus_card_id'] . '</td>
            <td style="padding:6px;font-size:13px;">' . $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname'] . '</td>
            <td style="padding:6px;font-size:13px;">' . $client['cus_mobile_phone'] . '</td>
            <td style="padding:6px;font-size:13px;">' . changeDate($client['cash_date_start']) . '</td>
            <td style="padding:6px;font-size:13px;">' . changeDate($client['cash_date_end']) . '</td>
            <td style="padding:6px;font-size:13px;" align="right">' . $deleteDate . '</td>
            <td style="padding:6px;font-size:13px;" align="right">' . number_format(($client['cash_number_installment'] - $client['paysum_pay_installment'])) . '</td>
            <td style="padding:6px;font-size:13px;" align="right">' . number_format($caloutstandingbalance) . '</td>
          </tr>
          ';
        $i++;
        $ii++;
        $sumall = $sumall + $caloutstandingbalance;
    }

endforeach;
$content .= '<tr style="border: 1px solid black;background-color: #D3D3D3;">
                <td style="padding:6px;font-size:13px;" colspan="8">รวม ' . $ii . ' คน</td>
                <td style="padding:6px;font-size:12px;" align="right">ยอดรวม</td>
                <td style="padding:6px;font-size:12px;" align="right">' . number_format($sumall) . '</td>
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
