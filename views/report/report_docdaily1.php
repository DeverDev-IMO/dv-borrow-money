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

$date = $_POST['date_start'];
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
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
          <td style="width:15%;text-align:center;">
              <span style="border-bottom:2px;font-size:16px;"><b>ใบรายวัน</b> </span>
          </td>
         
      </tr>
  </table>
  <table style="width:100%;margin-top:15px;" cellpadding=0 cellspacing=0 border="0">
      <tr>
          <td style="width:20%;text-align:left;">
              <span style="border-bottom:2px;font-size:14px;">ประจำวันที่ &ensp;' . changeDate($date) . ' </span>
          </td>

          <td style="width:23%;" align="left">
          สายบริการ : ' . ($clientlinework['lw_code'] != "" ? $clientlinework['lw_code'] . '-' . $clientlinework['lw_name'] : 'ทั้งหมด')  . '
          </td>
          <td style="width:12%;" align="right">
          
          </td>
      </tr>
  </table>
  <table style="margin-top:12px;width:100%;border-collapse: collapse;" cellpadding=3 cellspacing=1 border="1">
        <tr style="border: 1px solid black;">
            <td style="background-color: #D3D3D3;padding:7px;text-align:center;font-size:13px;">ลำดับ</td>
            <td style="background-color: #D3D3D3;font-size:13px;width:100px;">เลขที่สัญญา</td>
            <td style="background-color: #D3D3D3;font-size:13px;width:160px;">ชื่อ - สกุล</td>
            <td style="background-color: #D3D3D3;font-size:13px;width:65px;">ชื่อเล่น</td>
            <td style="background-color: #D3D3D3;font-size:13px;">เบอร์มือถือ</td>
            <td style="background-color: #D3D3D3;font-size:13px;width:50px;" align="right">วันละ</td>
            <td style="background-color: #D3D3D3;font-size:13px;width:80px;" align="right">ยอดค้างชำระ</td>
            <td style="background-color: #D3D3D3;font-size:13px;" align="right">ยอดค้าง</td>
            <td style="background-color: #D3D3D3;font-size:13px;width:80px;" align="right">ชำระจริง</td>
        </tr>';
$i = 1;
$ii = 0;
$sumdaily = 0;
$sumtotaloverdue = 0; //ยอดค้าง
$sumoverdue = 0; //ยอดค้างชำระ

$dateToday = date("Y-m-d");
$dateSelect = $date;
foreach ($report->listreportdailyClient("contract", $date) as $client) :
    ///////////////////////////ยอดค้างชำระ////////////////////////////////
    $deleteDate = DateDiff($client['cash_date_start'], $dateSelect); //ฟังค์ชั้นลบวันที่เริ่มสัญญากับวันปัจจุบัน
    // $deleteDate = $deleteDate + 1; //ลบวันที่เริ่มสัญญากับวันปัจจุบัน + 1
    $deleteDate = $deleteDate; //ลบวันที่เริ่มสัญญากับวันปัจจุบัน

    $numdateinstallmentsdaily = $deleteDate * $client['cash_installments_daily']; //หาค่างวดคูณจำนวนวันที่เริ่มสัญญาจนถึงวันที่ที่เลือก
    $numdateinstallmentsdaily = $numdateinstallmentsdaily - $client['paysum_pay_amount']; // ยอดที่ต้องชำระ - ยอดชำระเเล้ว
    $overduetodateSelect = $numdateinstallmentsdaily; //ยอดค้างชําระ

    // $overdue = ;
    $totaloverdue = ($client['cash_principle'] + $client['cash_interest']) - $client['paysum_pay_amount'];
    if ($overduetodateSelect < $totaloverdue) {
        $chkoverduetodateSelect = $overduetodateSelect;
    } else {
        $chkoverduetodateSelect = $totaloverdue;
    }
    ////////////////////////////////////////////////////////////////////
    if ($client['contract_status_closebalance'] == 1) {
        if ($date <= $client['contract_date_closebalance']) {
            $content .= '
          <tr style="border: 1px solid black;">
            <td style="padding:5px;font-size:12px;text-align:center;">' . $i . '</td>
            <td style="padding:5px;font-size:12px;">' . $client['contract_number'] . '</td>
            <td style="padding:5px;font-size:12px;">' . $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname'] . '</td>
            <td style="padding:5px;font-size:12px;">' . $client['cus_nickname'] . '</td>
            <td style="padding:5px;font-size:12px;">' . $client['cus_mobile_phone'] . '</td>
            <td style="padding:5px;font-size:12px;" align="right">' . number_format($client['cash_installments_daily']) . '</td>
            <td style="padding:5px;font-size:12px;" align="right">' . number_format($chkoverduetodateSelect) . '</td>
            <td style="padding:5px;font-size:12px;" align="right">' . number_format(($client['cash_principle'] + $client['cash_interest']) - $client['paysum_pay_amount']) . '</td>
            <td style="padding:5px;font-size:12px;"></td>
          </tr>
          ';
            $i++;
            $ii++;
            $sumdaily = $sumdaily + $client['cash_installments_daily'];
            $sumtotaloverdue = $sumtotaloverdue + (($client['cash_principle'] + $client['cash_interest']) - $client['paysum_pay_amount']);
            $sumoverdue = $sumoverdue + $overduetodateSelect;
        }
    } else {
        $content .= '
          <tr style="border: 1px solid black;">
            <td style="padding:5px;font-size:12px;text-align:center;">' . $i . '</td>
            <td style="padding:5px;font-size:12px;">' . $client['contract_number'] . '</td>
            <td style="padding:5px;font-size:12px;">' . $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname'] . '</td>
            <td style="padding:5px;font-size:12px;">' . $client['cus_nickname'] . '</td>
            <td style="padding:5px;font-size:12px;">' . $client['cus_mobile_phone'] . '</td>
            <td style="padding:5px;font-size:12px;" align="right">' . number_format($client['cash_installments_daily']) . '</td>
            <td style="padding:5px;font-size:12px;" align="right">' . number_format($chkoverduetodateSelect) . '</td>
            <td style="padding:5px;font-size:12px;" align="right">' . number_format(($client['cash_principle'] + $client['cash_interest']) - $client['paysum_pay_amount']) . '</td>
            <td style="padding:5px;font-size:12px;"></td>
          </tr>
          ';
        $i++;
        $ii++;
        $sumdaily = $sumdaily + $client['cash_installments_daily'];
        $sumtotaloverdue = $sumtotaloverdue + (($client['cash_principle'] + $client['cash_interest']) - $client['paysum_pay_amount']);
        $sumoverdue = $sumoverdue + $overduetodateSelect;
    }


////////////////////old/////////////////
// $content .= '
//       <tr style="border: 1px solid black;">
//         <td style="padding:5px;font-size:12px;text-align:center;">' . $i . '</td>
//         <td style="padding:5px;font-size:12px;">' . $client['contract_number'] . '</td>
//         <td style="padding:5px;font-size:12px;">' . $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname'] . '</td>
//         <td style="padding:5px;font-size:12px;">' . $client['cus_nickname'] . '</td>
//         <td style="padding:5px;font-size:12px;">' . $client['cus_mobile_phone'] . '</td>
//         <td style="padding:5px;font-size:12px;" align="right">' . number_format($client['cash_installments_daily']) . '</td>
//         <td style="padding:5px;font-size:12px;" align="right">' . number_format($overduetodateSelect) . '</td>
//         <td style="padding:5px;font-size:12px;" align="right">' . number_format(($client['cash_principle'] + $client['cash_interest']) - $client['paysum_pay_amount']) . '</td>
//         <td style="padding:5px;font-size:12px;"></td>
//       </tr>
//       ';
// $i++;
// $ii++;
// $sumdaily = $sumdaily + $client['cash_installments_daily'];
// $sumtotaloverdue = $sumtotaloverdue + (($client['cash_principle'] + $client['cash_interest']) - $client['paysum_pay_amount']);
// $sumoverdue = $sumoverdue + $overduetodateSelect;

endforeach;

$content .= '<tr style="border: 1px solid black;background-color: #D3D3D3;">
                <td style="padding:6px;font-size:13px;" colspan="5">รวม ' . $ii . ' คน</td>
                <td style="padding:6px;font-size:12px;" align="right">' . number_format($sumdaily) . '</td>
                <td style="padding:6px;font-size:12px;" align="right">' . number_format($sumoverdue) . '</td>
                <td style="padding:6px;font-size:12px;" align="right">' . number_format($sumtotaloverdue) . '</td>
                <td style="padding:6px;font-size:12px;"></td>
            </tr>';
$content .= '</table>
        </div>';



// $mpdf->AddPage('L');
$mpdf->AddPageByArray([
    'margin-left' => 7,
    'margin-right' => 7,
    'margin-top' => 9,
    // 'margin-bottom' => 1,
    'margin-bottom' => 1
]);
$stylesheet = file_get_contents('../../public/plugins/fontawesome-free/css/all.min.css');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->SetHTMLFooter('
<table width="100%" style="vertical-align: bottom; font-family: Garuda; 
    font-size: 8pt; color: #000000; font-weight: bold;margin-bottom:-15px;">
    <tr>
        <td width="33%"></td>
        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right;"></td>
    </tr>
</table>');
$mpdf->WriteHTML($head);
$mpdf->WriteHTML($content);
// $mpdf->setFooter('{PAGENO} of {nbpg}');
// $mpdf->setFooter('{PAGENO} / {nb}');
$mpdf->Output();


    // $mpdf = new \Mpdf\Mpdf();
    // $mpdf->WriteHTML('<h1>Hello world!</h1>');
    // $mpdf->Output();
