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
                  <b>ใบกำกับภาษี/ใบส่งของ</b>
                </td>
            </tr>
        </table>
        <table style="width:100%;margin-top:20px;margin-left:20px;" cellpadding=0 cellspacing=0 border="0">
            <tr>
                <td style="width:10%;text-align:left;font-size:13px;">
                  <b>สาขาที่ออกใบกำกับภาษี</b> <b>สำนักงานใหญ่</b>
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
                  <b>ที่อยู่ลูกค้า</b> 
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
                  <b>ประเภท</b> <span>&emsp;&emsp;สินเชื่อส่วนบุคคล</span>
                </td>
            </tr>
        </table>
        <table style="width:100%;margin-top:10px;margin-left:20px;" cellpadding=0 cellspacing=0 border="1">
            <tr style="border: 1px solid black;">
                <td style="background-color: #D3D3D3;padding:7px;text-align:center;font-size:13px;width:10%;">ลำดับ</td>
                <td style="background-color: #D3D3D3;font-size:13px;text-align:center;width:60%;">รายการ</td>
                <td style="background-color: #D3D3D3;padding:7px;font-size:13px;text-align:right;width:30%;">จำนวนเงินรวม VAT (บาท)</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="padding:7px;padding-top:-400px;text-align:center;font-size:13px;width:10%;height:450px;">1</td>
                <td style="padding:7px;padding-top:-400px;font-size:13px;text-align:left;width:60%;">สินเชื่อส่วนบุคคล</td>
                <td style="padding:7px;padding-top:-400px;font-size:13px;text-align:right;width:30%;">' . number_format($client['cash_principle'] + $client['cash_interest'], 2) . '</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td colspan="2" style="background-color: #fff;padding:7px;text-align:right;font-size:13px;width:10%;">รวม</td>
                <td style="background-color: #D3D3D3;padding:7px;text-align:right;font-size:13px;width:10%;">' . number_format($client['cash_principle'] + $client['cash_interest'], 2) . '</td>
            </tr>
            <tr style="border: 0px solid black;">
                <td colspan="2" style="background-color: #fff;padding:7px;text-align:right;font-size:13px;width:10%;">มูลค่ารวมสินค้า</td>
                <td style="background-color: #D3D3D3;padding:7px;text-align:right;font-size:13px;width:10%;">' . number_format($client['cash_principle'] + $client['cash_interest'], 2) . '</td>
            </tr>
            <tr style="border: 0px solid black;">
                <td colspan="2" style="background-color: #fff;padding:7px;text-align:right;font-size:13px;width:10%;">มูลค่าก่อนภาษีมูลค่าเพิ่ม</td>
                <td style="background-color: #D3D3D3;padding:7px;text-align:right;font-size:13px;width:10%;">' . number_format(($client['cash_principle'] + $client['cash_interest']) - $calvat, 2) . '</td>
            </tr>
            <tr style="border: 0px solid black;">
                <td colspan="2" style="background-color: #fff;padding:7px;text-align:right;font-size:13px;width:10%;">ภาษีมูลค่าเพิ่ม 7 %</td>
                <td style="background-color: #D3D3D3;padding:7px;text-align:right;font-size:13px;width:10%;">' . number_format($calvat, 2) . '</td>
            </tr>
            
        </table>
        <table style="width:100%;margin-top:80px;margin-left:20px;" cellpadding=0 cellspacing=0 border="0">
            <tr>
                <td style="width:40%;text-align:left;font-size:14px;">
                  ลงนาม..................................................ผู้รับสินค้า
                </td>
                <td style="width:40%;text-align:left;font-size:14px;">
                  ลงนาม..................................................พนักงานขาย
                </td>
            </tr>
        </table>
    </div>
    ';



// $mpdf->AddPage('L');
$mpdf->AddPageByArray([
    'margin-left' => 7,
    'margin-right' => 7,
    'margin-top' => 7,
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
