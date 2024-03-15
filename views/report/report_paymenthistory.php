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
$client = $report->ContractReport("contract", $id);
$client1 = $report->ContractReport1("contract", $id);
$clientMarry = $report->ContractMarryReport("contract", $id);
$clientEmergency = $report->ContractEmergencyReport("contract", $id);
$clientGuarantor = $report->ContractGuarantorReport("contract", $id);
$clientCashloanReport = $report->ContractCashloanReport("contract", $id);

// $diff = $clientCashloanReport['cash_installments_daily'] + $clientCashloanReport['cash_difference'];
// $diff = $clientCashloanReport['cash_difference'];
$diff = ($clientCashloanReport['cash_difference'] == "0" ? $clientCashloanReport['cash_installments_daily'] : $clientCashloanReport['cash_difference']);

$calvat = ($client['cash_principle'] + $client['cash_interest']) * 0.07;
$mpdf = new \Mpdf\Mpdf();
$head = '
    <style>
        body{
            font-family: "Garuda";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
        } 
        .textsizeA{
            font-size:13px;
        }
        .textsizeB{
            font-size:14px;
        }
        .lineup{
            margin-top:12px;
        }
        .tableborder {
            border: 0.7px solid black;
            border-collapse: collapse;
          }
        
    </style>
    <div style="border: 0px solid black;padding-top:20px;">
        <table style="width:100%;" cellpadding=0 cellspacing=0 border="0">
            <tr>
                <td style="width:10%;text-align:left;" rowspan="3">
                    <img width=90 height=60 src="../../public/logo_tgs.png">
                </td>
                <td style="width:60%;text-align:left;">&ensp;<b>บริษัท ธีรยุทธโกลด์เซอวิส จำกัด</b></td>
                <td></td>
            </tr>
            <tr>
                <td class="textsizeA" style="width:60%;text-align:left;padding-top:6px;">&ensp;389/47 ถนนจิระ ตำบลในเมือง อำเภอเมืองบุรีรัมย์</td>
                <td></td>
            </tr>
            <tr>
                <td class="textsizeA" style="width:60%;text-align:left;padding-top:6px;">&ensp;จังหวัดบุรีรัมย์ 31000</td>
                <td class="textsizeA">เลขที่สัญญา : ' . $client['contract_number'] . '</td>
            </tr>
        </table>
        <table style="width:100%;margin-top:20px;" cellpadding=0 cellspacing=0 border="0">
            <tr>
                <td style="width:10%;text-align:center;">
                  <b>ประวัติการชำระเงิน</b>
                </td>
            </tr>
        </table>
        <table style="width:100%;margin-top:10px;margin-left:20px;" cellpadding=0 cellspacing=0 border="0">
            <tr>
                <td style="width:40%;text-align:left;font-size:13px;">
                  <b>ชื่อผู้ซื้อ</b> <span>&emsp;&emsp;' . $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname'] . '</span>
                </td>
                <td style="width:30%;text-align:left;font-size:13px;">
                  <b>รหัสลูกค้า</b> <span>&emsp;' . $client['cus_card_id'] . '</span>
                </td>
                <td style="width:30%;text-align:left;font-size:13px;">
                  <b>วันที่</b> <span>&emsp;' . changeDate($clientCashloanReport['cash_date_start']) . '</span>
                </td>
            </tr>
        </table>
        <table style="width:100%;margin-top:10px;margin-left:20px;" cellpadding=0 cellspacing=0 border="0">
            <tr>
                <td style="width:40%;text-align:left;font-size:13px;">
                  <b>อาชีพ</b> <span>&emsp;&emsp;' . $client['cus_nature_work'] . '</span>
                </td>
            </tr>
        </table>
        <table style="width:100%;margin-top:10px;margin-left:20px;" cellpadding=0 cellspacing=0 border="0">
            <tr>
                <td style="width:40%;text-align:left;font-size:13px;">
                  <b>ที่อยู่</b> 
                  <span>
                  &emsp;&emsp;บ้านเลขที่ ' . $client['cus_address'] . '
                   หมู่ ' . $client['cus_village'] . '
                  ตำบล ' . $client['districts_name_th'] . '
                  อำเภอ ' . $client['amphures_name_th'] . '
                  จังหวัด ' . $client['province_name_th'] . '
                  &nbsp;' . $client['cus_postal_code'] . '
                  </span>
                </td>
            </tr>
        </table>
        <table style="width:100%;margin-top:10px;margin-left:20px;" cellpadding=0 cellspacing=0 border="0">
            <tr>
                <td style="width:40%;text-align:left;font-size:13px;">
                  <b>ชื่อผู้ค้ำประกัน</b> <span>&emsp;&emsp;' . $client['setpre_name'] . $client['guarantor_firstname'] . ' ' . $client['guarantor_lastname'] . '</span>
                </td>
                <td style="width:40%;text-align:left;font-size:13px;">
                  <b>เบอร์โทรศัพท์</b> <span>&emsp;&emsp;' . $client['guarantor_mobile_phone'] . '</span>
                </td>
            </tr>
        </table>
        <table style="width:100%;margin-top:10px;margin-left:20px;" cellpadding=0 cellspacing=0 border="0">
            <tr>
                <td style="width:40%;text-align:left;font-size:13px;">
                  <b>วันที่เริ่มผ่อนชำระ</b> <span>&emsp;&emsp;' . changeDate($client['cash_date_start']) . '</span>
                </td>
            </tr>
        </table>
        <table style="width:100%;margin-top:10px;margin-left:20px;" cellpadding=0 cellspacing=0 border="0">
            <tr>
                <td style="width:25%;text-align:left;font-size:13px;">
                  <b>ยอดสินเชื่อ</b> <span>&emsp;&emsp;' . number_format(($clientCashloanReport['cash_principle'] + $clientCashloanReport['cash_interest']), 2) . '</span>
                </td>
                <td style="width:25%;text-align:left;font-size:13px;">
                  <b>จำนวนงวด</b> <span>&emsp;&emsp;' . number_format($clientCashloanReport['cash_number_installment']) . '</span>
                </td>
                <td style="width:25%;text-align:left;font-size:13px;">
                  <b>ชำระต่องวด</b> <span>&emsp;&emsp;' . number_format($clientCashloanReport['cash_installments_daily'], 2) . '</span>
                </td>
                <td style="width:25%;text-align:left;font-size:13px;">
                  <b>งวดสุดท้าย</b> <span>&emsp;&emsp;' . number_format($diff, 2) . '</span>
                </td>
            </tr>
        </table>
        <table style="width:100%;margin-top:10px;margin-left:20px;" cellpadding=0 cellspacing=0 border="0">
            <tr>
                <td style="width:100%;text-align:center;">
                  <b><u>ตารางชำระค่างวดรายวัน</u></b>
                </td>
            </tr>
        </table>
        <table style="width:100%;margin-top:10px;margin-left:20px;" cellpadding=0 cellspacing=0 border="1">
            <tr style="border: 1px solid black;">
                <td style="background-color: #D3D3D3;padding:3px;text-align:center;font-size:13px;width:9%;">วัน/เดือน</td>
                <td style="background-color: #D3D3D3;padding:3px;font-size:13px;text-align:right;width:7.58%;">ม.ค.</td>
                <td style="background-color: #D3D3D3;padding:3px;font-size:13px;text-align:right;width:7.58%;">ก.พ.</td>
                <td style="background-color: #D3D3D3;padding:3px;font-size:13px;text-align:right;width:7.58%;">มี.ค.</td>
                <td style="background-color: #D3D3D3;padding:3px;font-size:13px;text-align:right;width:7.58%;">เม.ย.</td>
                <td style="background-color: #D3D3D3;padding:3px;font-size:13px;text-align:right;width:7.58%;">พ.ค.</td>
                <td style="background-color: #D3D3D3;padding:3px;font-size:13px;text-align:right;width:7.58%;">มิ.ย.</td>
                <td style="background-color: #D3D3D3;padding:3px;font-size:13px;text-align:right;width:7.58%;">ก.ค.</td>
                <td style="background-color: #D3D3D3;padding:3px;font-size:13px;text-align:right;width:7.58%;">ส.ค.</td>
                <td style="background-color: #D3D3D3;padding:3px;font-size:13px;text-align:right;width:7.58%;">ก.ย.</td>
                <td style="background-color: #D3D3D3;padding:3px;font-size:13px;text-align:right;width:7.58%;">ต.ค.</td>
                <td style="background-color: #D3D3D3;padding:3px;font-size:13px;text-align:right;width:7.58%;">พ.ย.</td>
                <td style="background-color: #D3D3D3;padding:3px;font-size:13px;text-align:right;width:7.58%;">ธ.ค.</td>
            </tr>';
$iDay = 1;
while ($iDay <= 31) {
  $head .= '<tr>
        <td style="padding:3px;text-align:center;font-size:13px;">' . $iDay . '</td>';
  /////////เดือน มค/////////
  $clientChkpayday = $report->getInfoChkpayday("payments", $id, $iDay, 1);
  $head .= '<td style="padding:3px;text-align:right;font-size:13px;">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
  /////////เดือน กพ/////////
  $clientChkpayday = $report->getInfoChkpayday("payments", $id, $iDay, 2);
  $head .= '<td style="padding:3px;text-align:right;font-size:13px;">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
  /////////เดือน มีค/////////
  $clientChkpayday = $report->getInfoChkpayday("payments", $id, $iDay, 3);
  $head .= '<td style="padding:3px;text-align:right;font-size:13px;">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
  /////////เดือน เมย/////////
  $clientChkpayday = $report->getInfoChkpayday("payments", $id, $iDay, 4);
  $head .= '<td style="padding:3px;text-align:right;font-size:13px;">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
  /////////เดือน พค/////////
  $clientChkpayday = $report->getInfoChkpayday("payments", $id, $iDay, 5);
  $head .= '<td style="padding:3px;text-align:right;font-size:13px;">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
  /////////เดือน มิย/////////
  $clientChkpayday = $report->getInfoChkpayday("payments", $id, $iDay, 6);
  $head .= '<td style="padding:3px;text-align:right;font-size:13px;">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
  /////////เดือน กค/////////
  $clientChkpayday = $report->getInfoChkpayday("payments", $id, $iDay, 7);
  $head .= '<td style="padding:3px;text-align:right;font-size:13px;">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
  /////////เดือน สค/////////
  $clientChkpayday = $report->getInfoChkpayday("payments", $id, $iDay, 8);
  $head .= '<td style="padding:3px;text-align:right;font-size:13px;">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
  /////////เดือน กย/////////
  $clientChkpayday = $report->getInfoChkpayday("payments", $id, $iDay, 9);
  $head .= '<td style="padding:3px;text-align:right;font-size:13px;">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
  /////////เดือน ตค/////////
  $clientChkpayday = $report->getInfoChkpayday("payments", $id, $iDay, 10);
  $head .= '<td style="padding:3px;text-align:right;font-size:13px;">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
  /////////เดือน พย/////////
  $clientChkpayday = $report->getInfoChkpayday("payments", $id, $iDay, 11);
  $head .= '<td style="padding:3px;text-align:right;font-size:13px;">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
  /////////เดือน ธค/////////
  $clientChkpayday = $report->getInfoChkpayday("payments", $id, $iDay, 12);
  $head .= '<td style="padding:3px;text-align:right;font-size:13px;">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';


  $head .= '</tr>';
  $iDay++;
}

$head .= '</table>
    </div>
    ';



// $mpdf->AddPage('L');
$mpdf->AddPageByArray([
  'margin-left' => 4,
  'margin-right' => 6,
  'margin-top' => 4,
  'margin-bottom' => 0,
]);
// $stylesheet = file_get_contents('../../public/plugins/fontawesome-free/css/all.min.css');
// $mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($head);
// $mpdf->WriteHTML($content);
$mpdf->Output();


    // $mpdf = new \Mpdf\Mpdf();
    // $mpdf->WriteHTML('<h1>Hello world!</h1>');
    // $mpdf->Output();
