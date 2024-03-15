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
        
    </style>
    <div style="border: 0px solid black;padding:0px;">
        <table style="width:100%;margin-top:5px;" cellpadding=0 cellspacing=0 border="0">
            <tr>
                <td style="width:5%;text-align:right;">
                    <span style="border-bottom:2px;font-size:15px;"><b>สัญญาซื้อขาย</b> </span>
                </td>
            </tr>
        </table>
        <table style="width:100%;margin-top:5px;" cellpadding=0 cellspacing=0 border="0">
            <tr>
                <td style="width:10%;text-align:left;" rowspan="3">
                    <img width=90 height=60 src="../../public/logo_tgs.png">
                </td>
                <td style="width:60%;text-align:left;">&ensp;<b>บริษัท ธีรยุทธโกลด์เซอวิส จำกัด</b></td>
                <td></td>
            </tr>
            <tr>
                <td style="width:60%;text-align:left;padding-top:6px;">&ensp;389/47 ถนนจิระ ตำบลในเมือง อำเภอเมืองบุรีรัมย์</td>
                <td>เลขที่สัญญา : ' . $client['contract_number'] . '</td>
            </tr>
            <tr>
                <td style="width:60%;text-align:left;padding-top:6px;">&ensp;จังหวัดบุรีรัมย์ 31000</td>
                <td>รหัสลูกค้า : ' . $client['cus_card_id'] . '</td>
            </tr>
        </table>
    </div>
    ';
// $content = '
// <style>
//     body{
//         font-family: "Garuda";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
//     }
//   </style>
// <div style="border-style: solid;">
// csc
// </div>
//    ';
// <div style="A_CSS_ATTRIBUTE:all;position: absolute;bottom: 20px; right: 25px;left: 25px; top: 15px;  ">
$content = '
  <div style="border: 0.8px solid black;padding:5px;margin-top:10px;">
    <table style="width:100%;margin-top:5px;" cellpadding=0 cellspacing=0 border="0">
        <tr>
            <td style="width:55%;text-align:left;" class="textsizeA"><b><u>ข้อมูลส่วนตัว</u></b>&ensp;
                <span style="border-bottom:2px">&emsp;&emsp;ชื่อ-สกุล&emsp;</span>
                <span style="border-bottom:2px">' . $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname'] . '</span>
            </td>
            <td style="width:45%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">เลขบัตรประจำตัวประชาชน&emsp; ' . $client['cus_card_id'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">วัน/เดือน/ปีเกิด&emsp; ' . changeDate($client['cus_birthday']) . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">อายุ&emsp;&ensp; ' . $client['cus_age'] . '</span>
            </td>
            <td style="width:10%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">เพศ&emsp;&ensp;' . $client['cus_gender'] . '</span>
            </td>
            <td style="width:10%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">สถานะภาพ&emsp;&ensp;' . $client['setmar_name'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:70%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ที่อยู่ปัจจุบันที่ติดต่อได้ ชื่อหมู่บ้าน/อาคาร/อพาร์ทเม้น&emsp; ' . $client['cus_address'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">บ้านเลขที่&emsp;&ensp; ' . $client['cus_house_no'] . '</span>
            </td>
            <td style="width:10%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">หมู่ที่&emsp;&ensp;' . $client['cus_village'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ซอย&emsp; ' . $client['cus_lane'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ถนน&emsp;&ensp; ' . $client['cus_streee'] . '</span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ตำบล/แขวง&emsp;&ensp;' . $client['districts_name_th'] . '</span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">อำเภอ/เขต&emsp;&ensp;' . $client['amphures_name_th'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">จังหวัด&emsp; ' . $client['province_name_th'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">รหัสไปรษณีย์&emsp;&ensp; ' . $client['cus_postal_code'] . '</span>
            </td>
            <td style="width:26%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">โทรศัพท์บ้าน&emsp;&ensp;' . $client['cus_home_phone'] . '</span>
            </td>
            <td style="width:26%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">โทรศัพท์มือถือ&emsp;&ensp;' . $client['cus_mobile_phone'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:50%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">จำนวนปีที่อาศัยอยู่&emsp; ' . $client['cus_numberyears_lived'] . '&emsp;ปี</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px"> ' . $client['cus_numbermonths_lived'] . '&emsp;&emsp;เดือน</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">สถานภาพที่อยู่&emsp; ' . $client['setadd_name'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">อาศัยอยู่กับ&emsp;&ensp; ' . $client['setcoh_name'] . '</span>
            </td>
            <td style="width:26%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">จำนวนบุุคคลที่อาศัยอยู่ด้วย&emsp;&ensp;' . $client['cus_number_lived'] . '&emsp; คน</span>
            </td>
        </tr>
    </table>
    <table style="width:50%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:40%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">สถานภาพการงาน&emsp; ' . $client['setwork_name'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:35%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">สถานที่ทำงาน ชื่ออาคาร&emsp; ' . $client['cus_workplace'] . '</span>
            </td>
            <td style="width:13%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">เลขที่&emsp; ' . $client['cus_workplace_no'] . '</span>
            </td>
            <td style="width:10%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">หมู่ที่&emsp;' . $client['cus_village_work'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ซอย&emsp;' . $client['cus_lane_work'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ถนน&emsp;' . $client['cus_streee_work'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ตำบล/แขวง&emsp; ' . $client1['districts_name_th'] . '</span>
            </td>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">อำเภอ/เขต&emsp; ' . $client1['amphures_name_th'] . '</span>
            </td>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">จังหวัด&emsp;' . $client1['province_name_th'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">รหัสไปรษณีย์&emsp;' . $client1['cus_postal_code_work'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">โทรศัพท์&emsp; ' . $client['cus_home_phone_work'] . '</span>
            </td>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">โทรศัพท์มือถือ&emsp; ' . $client['cus_mobile_phone_work'] . '</span>
            </td>
            <td style="width:50%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ลักษณะของงาน&emsp;' . $client['cus_nature_work'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">แผนก&emsp; ' . $client['cus_department_work'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ตำแหน่ง&emsp; ' . $client['cus_position_work'] . '</span>
            </td>
            <td style="width:35%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">เวลาที่สะดวกในการติดต่อ&emsp;' . $client['cus_contact_time'] . '</span>
            </td>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">จำนวนปีที่ทำงาน&emsp;' . $client['cus_numberyears_work'] . '&emsp; ปี</span>
            </td>
        </tr>
    </table>
    <table style="width:60%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">รายได้ ต่อวัน วันละ&emsp; ' . $client['cus_income_day'] . '&emsp; บาท</span>
            </td>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ต่อเดือน เดือนละ&emsp; ' . $client['cus_income_month'] . '&emsp;</span>
            </td>
        </tr>
    </table>
  </div>
  <div style="border: 0.8px solid black;padding:5px;margin-top:4px;">
    <table style="width:100%;margin-top:5px;" cellpadding=0 cellspacing=0 border="0">
        <tr>
            <td style="width:10%;text-align:left;" class="textsizeA"><b><u>รายละเอียดเกี่ยวกับคู่สมรส</u></b>&ensp;
                <span style="border-bottom:2px">&emsp;&emsp;ชื่อ-สกุล&emsp;</span>
                <span style="border-bottom:2px">' . $clientMarry['setpre_name'] . $clientMarry['marryd_firstname'] . ' ' . $clientMarry['marryd_lastname'] . '</span>
            </td>

        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:100%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">สถานภาพการทำงาน&emsp; ' . $clientMarry['setwork_name'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:35%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">สถานที่ทำงาน ชื่ออาคาร&emsp; ' . $clientMarry['marryd_workplace'] . '</span>
            </td>
            <td style="width:13%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">เลขที่&emsp; ' . $clientMarry['marryd_workplace_no'] . '</span>
            </td>
            <td style="width:10%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">หมู่ที่&emsp;' . $clientMarry['marryd_village'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ซอย&emsp;' . $clientMarry['marryd_lane'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ถนน&emsp;' . $clientMarry['marryd_streee'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ตำบล/แขวง&emsp; ' . $clientMarry['districts_name_th'] . '</span>
            </td>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">อำเภอ/เขต&emsp; ' . $clientMarry['amphures_name_th'] . '</span>
            </td>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">จังหวัด&emsp;' . $clientMarry['province_name_th'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">รหัสไปรษณีย์&emsp;' . $clientMarry['marryd_postal_code'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">โทรศัพท์&emsp; ' . $clientMarry['marryd_home_phone'] . '</span>
            </td>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">โทรศัพท์มือถือ&emsp; ' . $clientMarry['marryd_mobile_phone'] . '</span>
            </td>
            <td style="width:50%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ลักษณะของงาน&emsp;' . $clientMarry['marryd_nature_work'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">แผนก&emsp; ' . $clientMarry['marryd_department_work'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ตำแหน่ง&emsp; ' . $clientMarry['marryd_position_work'] . '</span>
            </td>
            <td style="width:35%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">เวลาที่สะดวกในการติดต่อ&emsp;' . $clientMarry['marryd_contact_time'] . '</span>
            </td>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">จำนวนปีที่ทำงาน&emsp;' . $clientMarry['marryd_numberyears_work'] . '&emsp; ปี</span>
            </td>
        </tr>
    </table>
  </div>
  <div style="border: 0.8px solid black;padding:5px;margin-top:4px;">
    <table style="width:100%;margin-top:5px;" cellpadding=0 cellspacing=0 border="0">
        <tr>
            <td style="width:60%;text-align:left;" class="textsizeA"><b><u>บุคคลติดต่อแทนได้กรณีฉุกเฉิน</u></b>&ensp;
                <span style="border-bottom:2px">&emsp;&emsp;ชื่อ-สกุล&emsp;</span>
                <span style="border-bottom:2px">' . $clientEmergency['setpre_name'] . $clientEmergency['coem_firstname'] . ' ' . $clientEmergency['coem_lastname'] . '</span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ความสัมพันธ์&emsp; ' . $clientEmergency['coem_relation'] . '</span>
            </td>

        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:65%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">สถานที่ติดต่อได้&emsp; ' . $clientEmergency['coem_place_contact'] . '</span>
            </td>
            <td style="width:35%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">โทรศัพท์&emsp; ' . $clientEmergency['coem_phone_number'] . '</span>
            </td>
        </tr>
    </table>
  </div>
  <div style="border: 0.8px solid black;padding:5px;margin-top:4px;">
    <table style="width:100%;margin-top:5px;" cellpadding=0 cellspacing=0 border="0">
        <tr>
            <td style="width:70%;text-align:left;" class="textsizeA"><b><u>ข้อมูลส่วนตัวผู้ค้ำประกัน</u></b>&ensp;
                <span style="border-bottom:2px">&emsp;&emsp;ชื่อ-สกุล&emsp;</span>
                <span style="border-bottom:2px">' . $clientGuarantor['setpre_name'] . $clientGuarantor['guarantor_firstname'] . ' ' . $clientGuarantor['guarantor_lastname'] . '</span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">อายุ&emsp;' . $clientGuarantor['guarantor_age'] . '&emsp;ปี</span>
            </td>

        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">วัน/เดือน/ปีเกิด&emsp; ' . changeDate($clientGuarantor['guarantor_birthday']) . '</span>
            </td>
            <td style="width:35%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">เพศ&emsp; ' . $clientGuarantor['guarantor_gender'] . '</span>
            </td>
            <td style="width:35%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">สถานภาพ&emsp; ' . $clientGuarantor['setmar_name'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">เลขบัตรประจำตัวประชาชน&emsp; ' . $clientGuarantor['guarantor_card_id'] . '</span>
            </td>
            <td style="width:35%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">เลขทะเบียนการค้า&emsp; ' . $clientGuarantor['guarantor_business_registration'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:70%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ที่อยู่ปัจจุบันที่ติดต่อได้ ชื่อหมู่บ้าน/อาคาร/อพาร์ทเม้น&emsp; ' . $clientGuarantor['guarantor_address'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">บ้านเลขที่&emsp;&ensp; ' . $clientGuarantor['guarantor_house_no'] . '</span>
            </td>
            <td style="width:10%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">หมู่ที่&emsp;&ensp;' . $clientGuarantor['guarantor_village'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ซอย&emsp; ' . $clientGuarantor['guarantor_lane'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ถนน&emsp;&ensp; ' . $clientGuarantor['guarantor_streee'] . '</span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ตำบล/แขวง&emsp;&ensp;' . $clientGuarantor['districts_name_th'] . '</span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">อำเภอ/เขต&emsp;&ensp;' . $clientGuarantor['amphures_name_th'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">จังหวัด&emsp; ' . $clientGuarantor['province_name_th'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">รหัสไปรษณีย์&emsp;&ensp; ' . $clientGuarantor['guarantor_postal_code'] . '</span>
            </td>
            <td style="width:26%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">โทรศัพท์บ้าน&emsp;&ensp;' . $clientGuarantor['guarantor_home_phone'] . '</span>
            </td>
            <td style="width:26%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">โทรศัพท์มือถือ&emsp;&ensp;' . $clientGuarantor['guarantor_mobile_phone'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:80%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">จำนวนปีที่อาศัยอยู่&emsp; ' . $clientGuarantor['guarantor_numberyears_lived'] . '&emsp;ปี</span>
            </td>
            <td style="width:25%;text-align:left;" class="textsizeA">
            <span style="border-bottom:2px">สถานภาพที่อยู่&emsp; ' . $clientGuarantor['setadd_name'] . '</span>
        </td>
        </tr>
    </table>
  </div>
  <div style="border: 0.8px solid black;padding:5px;margin-top:4px;">
    <table style="width:100%;margin-top:5px;" cellpadding=0 cellspacing=0 border="0">
        <tr>
            <td style="width:100%;text-align:center;" class="textsizeA"><b><u>รายการสินเชื่อเงินสดส่วนบุคคล</u></b>&ensp;
                
            </td>
        </tr>
    </table>
    <table style="width:90%;margin-top:5px;" cellpadding=0 cellspacing=0 border="0">
        <tr>
            <td style="width:23%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px"><b><u>รายละเอียดรายการ</u></b></span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">&ensp;&nbsp;ยอดสินเชื่อ ' . number_format(($clientCashloanReport['cash_principle'] + $clientCashloanReport['cash_interest']), 2) . '&emsp;บาท</span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">&nbsp;</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;margin-top:5px;" cellpadding=0 cellspacing=0 border="0">
        <tr style="width:100%;">
            <td style="width:23%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px"><b><u>รายละเอียดการผ่อนชำระ</u></b></span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ผ่อนรายวัน วันละ ' . number_format($clientCashloanReport['cash_installments_daily'], 2) . '&emsp;บาท</span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ผ่อนรายเดือน เดือนละ &emsp;บาท</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;margin-top:5px;" cellpadding=0 cellspacing=0 border="0">
        <tr style="width:100%;">
            <td style="width:23%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px"><b>&nbsp;</b></span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px;">&emsp;&emsp;&ensp;
                จำนวน &ensp;&ensp;' . number_format($clientCashloanReport['cash_number_installment']) . '&emsp;งวด</span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">&ensp;&ensp;&ensp;&ensp;งวดสุดท้าย &ensp;&ensp;' . number_format($diff, 2) . '&emsp;บาท</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;margin-top:5px;" cellpadding=0 cellspacing=0 border="0">
        <tr style="width:100%;">
            <td style="width:23%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px"><b>&nbsp;</b></span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px;">&emsp;&emsp;&ensp;
                วันที่เริ่มผ่อน &ensp;&ensp;' . changeDate($clientCashloanReport['cash_date_start']) . '</span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">&ensp;&ensp;&ensp;&ensp;วันที่ผ่อนชำระงวดสุดท้าย &ensp;' . changeDate($clientCashloanReport['cash_date_end']) . '</span>
            </td>
        </tr>
    </table>
  </div>
  <div style="border: 0px solid black;line-height: 1.8;">
        <span style="font-size:12px;">สัญญาฉบับนี้ได้ทำขึ้นระหว่าง บริษัท ธีรยุทธโกลด์เซอวิส จำกัด ("ผู้ขาย" ซึ่งรวมถึงผู้รับโอนสิทธิ) กับผู้ซื้อ และผู้ค้ำประกันซึ่งถือเป็น
        ลูกหนี้ร่วมจะต้องปฏิบัติตามเงื่อนไขที่ระบุไว้ด้านหลังของสัญญาฉบับนี้
        </span>
  </div>
  
';


$content1  = '
        <div style="border: 0px solid black;padding:5px;margin-top:10px;line-height: 1.5;">
            <div style="font-size:13px;"><b><u>เงื่อนไขแห่งสัญญาซื้อขายนี้ให้ถือเป็นส่วนหนึ่งของสัญญา</u></b></div>
            <div style="font-size:13px;margin-top:10px;">1. ผู้ขายตกลงขาย และผู้ซื้อตกลงซื้อทรัพย์สินดังที่ระบุไว้ในรายการสินค้าด้านหน้า ซึ่งรวมถึงเครื่องอุปกรณ์สิ่งที่นํามารวมของเต็ม สิ่งต่อเติมหรือ เพิ่มเติมทรัพย์สิน ซึ่งต่อไปสัญญานี้จะรวมเรียกว่า "สินค้า" โดยชําระค่าสินค้า ค่าบริการ ค่าภาษี และค่าใช้จ่ายอื่นๆ ทั้งหมดรวมเป็นราคาสินค้า และมีระยะเวลาตามที่ระบุในสัญญา ด้านหน้า</div>
            <div style="font-size:13px;margin-top:9px;">2. ผู้ซื้อตกลงชําระค่าซื้อ งวดแรก ดังที่ระบุในสัญญาด้านหน้า และจะต้องชําระตามจํานวนงวดที่สัญญาระบุด้านหน้าจนกว่าจะชําระครบถ้วนตาม สัญญาบรรดาเงินใดๆ ที่ผู้ซื้อชําระให้ตกเป็นกรรมสิทธิ์แก่ผู้ขายโดยเด็ดขาด</div>
            <div style="font-size:13px;margin-top:9px;">3. การชําระหนี้ค่าสินค้าทุกครั้งและทุกจํานวนที่จะต้องชําระแก่ผู้ขายให้ชําระ ณ ที่ทําการของผู้ขาย หรือสถานที่รับชําระเงิน ที่ผู้ซื้อให้บริษัทไป เรียกเก็บเงิน ณ ภูมิลําเนาของผู้ซื้อตามสัญญา โดยผู้ซื้อตกลงยินยอมให้ผู้ขายหรือตัวแทนเข้าไปเรียกเก็บเงินในเคหะสถานหรือสถานที่อื่นๆทุกแห่ง ที่ผู้ซื้ออยู่ได้สัญญาฉบับนี้ทุกข้อถือเป็นสาระสําคัญแห่งสัญญา หากผู้ซื้อปฏิบัติผิดข้อหนึ่งข้อใดให้ผู้ขายมีสิทธิบังคับชําระหนี้ส่วนที่เหลือทั้งหมดทันทีหรือผู้ขายมีสิทธิบอกเลิกสัญญาก็ได้</div>
            <div style="font-size:13px;margin-top:9px;">4. กรณีผู้ซื้อนําสินค้ามาขายคืน บริษัทจะรับซื้อคืนตามสภาพและราคาตลาด ณ วันที่ผู้ซื้อนําสินค้ามาขายคืน โดยผู้ซื้อยินยอมให้หักจากส่วนที่เหลือ หากไม่พอชําระหนี้ ผู้ซื้อยินยอมทําหนังสือรับสภาพหนี้ไว้กับบริษัท ฯ</div>
            <div style="font-size:13px;margin-top:9px;">5. ผู้ขายมิได้ให้คํารับรองแต่อย่างใดอย่างหนึ่ง ไม่ว่าโดยตรงหรือโดยปริยาย เกี่ยวกับอายุ มูลค่า สภาพ เงื่อนไข หรือคุณภาพของทรัพย์สินผู้ซื้อไม่มี สิทธิเรียกร้องใดๆ สําหรับความชํารุด</div>
            <div style="font-size:13px;margin-top:9px;">บกพร่องของทรัพย์สินหรือการถูกรีบรอนสิทธิจากทรัพย์สินที่เกิดขึ้นปรากฏหลังจากวันที่ผู้ซื้อรับมอบทรัพย์สินและการรับมอบทรัพย์สินดังกล่าวให้ถือว่าผู้ซื้อตรวจสอบจนเป็นที่พอใจแล้วให้เป็นหน้าที่ของผู้ซื้อที่จะเรียกร้องตามเงื่อนไขการรับประกันจากผู้ผลิตโดยตรง</div>
            <div style="font-size:13px;margin-top:9px;">6. ผู้ซื้อจะต้องรับผิดชดใช้ค่าใช้จ่ายในการทวงถาม ค่าทนายความ ค่าดอกเบี้ย เนื่องจากผิดนัดชําระ ร้อยละ 15 ต่อปี และอื่นๆที่เกี่ยวเนื่องด้วย การที่ผู้ซื้อผิดนัดชําระ</div>
            <div style="font-size:13px;margin-top:9px;">7. แม้สัญญานี้ จะยังมีผลบังคับหรือไม่ก็ตาม ผู้ซื้อตกลงให้ความยินยอมตลอดไปว่า ผู้ขายมีสิทธิที่จะเปิดเผย หรือแลกเปลี่ยนข้อมูลของผู้ซื้อที่ให้ไว้กับ ผู้ขายทั้งในใบสมัคร หรือทางการสื่อสารวีดีทัศน์ หรือทางคอมพิวเตอร์ หรือการสื่อสารอื่นๆ ก็ตาม ให้แก่บุคคลอื่น หรือใช้ข้อมูลดังกล่าวที่ผู้ชายเห็นว่า จะเป็นประโยชน์ต่อผู้ซื้อ</div>
            <div style="font-size:13px;margin-top:9px;">8. สัญญาแต่ละข้อเป็นอิสระต่างหากจากกัน ในกรณีส่วนหนึ่งส่วนใดของสัญญานี้เป็นโมฆะ ก็ให้สัญญาส่วนที่เหลือยังคงมีผลบังคับได้เต็มที่</div>
            <div style="font-size:13px;margin-top:9px;">9. ผู้ค้ําประกันยินยอมผูกพันรับผิดอย่างลูกหนี้ตามสัญญาที่ผู้ซื้อได้ทําสัญญาไว้กับบริษัทฯ ไม่ว่ากรณีใดๆ ทั้งสิ้น</div>
            <div style="font-size:13px;margin-top:9px;"><b> สัญญานี้ได้ทําขึ้นโดยเจตนาแห่งคู่สัญญาและให้มีผลบังคับใช้ และได้ลงมือชื่อไว้เป็นสําคัญ ณ. วัน เดือน ปี ที่ระบุ</b></div>
        </div>
        
        <div style="border: 0px solid black;padding:5px;margin-top:80px;line-height: 1.5;">
        <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
            <tr>
                <td style="width:50%;text-align:center;" class="textsizeB">
                    <span style="border-bottom:2px">--------------------------------------</span><br><br>
                    <span style="border-bottom:2px">(&ensp;&ensp;' . $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname'] . '&ensp;&ensp;)</span><br><br>
                    <span style="border-bottom:2px">ลายมือผู้ซื้อ</span><br><br>
                    <span style="border-bottom:2px">วันที่...............................................</span><br><br>
                </td>
                <td style="width:50%;text-align:center;" class="textsizeB">
                <span style="border-bottom:2px">--------------------------------------</span><br><br>
                <span style="border-bottom:2px">(&ensp;&ensp;' . $clientGuarantor['setpre_name'] . $clientGuarantor['guarantor_firstname'] . ' ' . $clientGuarantor['guarantor_lastname'] . '&ensp;&ensp;)</span><br><br>
                <span style="border-bottom:2px">ลายมือผู้ค้ำประกัน</span><br><br>
                <span style="border-bottom:2px">วันที่...............................................</span><br><br>
                </td>
            </tr>
        </table>
        <table style="width:100%;margin-top:60px;" cellpadding=0 cellspacing=0 border="0" class="lineup">
            <tr>
                <td style="width:50%;text-align:center;" class="textsizeB">
                    <span style="border-bottom:2px">--------------------------------------</span><br><br>
                    <span style="border-bottom:2px">(&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;)</span><br><br>
                    <span style="border-bottom:2px">ลายมือเจ้าหน้าที่รับผิดชอบ/พยาน</span><br><br>
                    <span style="border-bottom:2px">วันที่...............................................</span><br><br>
                </td>
                <td style="width:50%;text-align:center;" class="textsizeB">
                <span style="border-bottom:2px">--------------------------------------</span><br><br>
                <span style="border-bottom:2px">(&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;)</span><br><br>
                <span style="border-bottom:2px">ลายมือชื่อผู้ขาย / ลายมือชื่อผู้รับมอบอำนาจ</span><br><br>
                <span style="border-bottom:2px">วันที่...............................................</span><br><br>
                </td>
            </tr>
        </table>
        </div>
';

// $mpdf->AddPage('L');
$mpdf->AddPageByArray([
    'margin-left' => 6,
    'margin-right' => 6,
    'margin-top' => 6,
    'margin-bottom' => 0,
]);
// $stylesheet = file_get_contents('../../public/plugins/fontawesome-free/css/all.min.css');
// $mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($head);
$mpdf->WriteHTML($content);
$mpdf->AddPage();
$mpdf->WriteHTML($content1);
$mpdf->Output();


    // $mpdf = new \Mpdf\Mpdf();
    // $mpdf->WriteHTML('<h1>Hello world!</h1>');
    // $mpdf->Output();
