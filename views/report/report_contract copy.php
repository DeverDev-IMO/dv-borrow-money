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
$clientMarry = $report->ContractMarryReport("contract", $id);
$clientEmergency = $report->ContractEmergencyReport("contract", $id);
$clientGuarantor = $report->ContractGuarantorReport("contract", $id);
$clientCashloanReport = $report->ContractCashloanReport("contract", $id);

$mpdf = new \Mpdf\Mpdf();
$head = '
    <style>
        body{
            font-family: "Garuda";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
        } 
        .textsizeA{
            font-size:13px;
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
        <table style="width:100%;margin-top:5px;" cellpadding=0 cellspacing=0 border="1">
            <tr>
                <td style="width:5%;text-align:left;" class="textsizeA">
                <img width=80 height=55 src="../../public/logo_tgs.png">
                </td>
                <td style="width:50%;text-align:left;" class="textsizeA">
                    <div style="line-height: 5;">
                        บริษัท ธีรยุทธโกลด์เซอวิส จำกัด<br>
                        389/47 ถนนจิระ ตำบลในเมือง อำเภอเมืองบุรีรัมย์<br>
                        จังหวัดบุรีรัมย์ 31000
                    </div>
                </td>
                <td style="width:45%;text-align:left;" class="textsizeA">
                    <span style="border-bottom:2px">
                    <b>เลขที่สัญญา</b> <br>
                    <b>รหัสลูกค้า : ' . $client['cus_card_id'] . '</b><br>
                    </span>
                </td>
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
  <div style="border: 0.8px solid black;padding:5px;">
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
                <span style="border-bottom:2px">ตำบล/แขวง&emsp;&ensp;' . $client['cus_sub_district'] . '</span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">อำเภอ/เขต&emsp;&ensp;' . $client['cus_district'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">จังหวัด&emsp; ' . $client['cus_province'] . '</span>
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
                <span style="border-bottom:2px">ตำบล/แขวง&emsp; ' . $client['cus_sub_district_work'] . '</span>
            </td>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">อำเภอ/เขต&emsp; ' . $client['cus_district_work'] . '</span>
            </td>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">จังหวัด&emsp;' . $client['cus_province_work'] . '</span>
            </td>
            <td style="width:20%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">รหัสไปรษณีย์&emsp;' . $client['cus_postal_code_work'] . '</span>
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
                <span style="border-bottom:2px">รายได้ ต่อวัน วันละ&emsp; ' . $client['cus_department_work'] . '&emsp; บาท</span>
            </td>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">ต่อเดือน เดือนละ&emsp; ' . $client['cus_position_work'] . '&emsp;</span>
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
                <span style="border-bottom:2px">ตำบล/แขวง&emsp; ' . $clientMarry['marryd_sub_district'] . '</span>
            </td>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">อำเภอ/เขต&emsp; ' . $clientMarry['marryd_district'] . '</span>
            </td>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">จังหวัด&emsp;' . $clientMarry['marryd_province'] . '</span>
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
            <td style="width:50%;text-align:left;" class="textsizeA"><b><u>บุคคลติดต่อแทนได้กรณีฉุกเฉิน</u></b>&ensp;
                <span style="border-bottom:2px">&emsp;&emsp;ชื่อ-สกุล&emsp;</span>
                <span style="border-bottom:2px">' . $clientEmergency['setpre_name'] . $clientEmergency['coem_firstname'] . ' ' . $clientEmergency['coem_lastname'] . '</span>
            </td>
            <td style="width:50%;text-align:left;" class="textsizeA">
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
                <span style="border-bottom:2px">อายุ&emsp;</span>
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
                <span style="border-bottom:2px">ตำบล/แขวง&emsp;&ensp;' . $clientGuarantor['guarantor_sub_district'] . '</span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">อำเภอ/เขต&emsp;&ensp;' . $clientGuarantor['guarantor_district'] . '</span>
            </td>
        </tr>
    </table>
    <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
        <tr>
            <td style="width:25%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">จังหวัด&emsp; ' . $clientGuarantor['guarantor_province'] . '</span>
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
            <td style="width:70%;text-align:left;" class="textsizeA"><b><u>รายการสินเชื่อเงินสดส่วนบุคคล</u></b>&ensp;
                
            </td>
        </tr>
    </table>
    <table style="width:90%;margin-top:5px;" cellpadding=0 cellspacing=0 border="0">
        <tr>
            <td style="width:27%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px"><b><u>รายละเอียดรายการ</u></b></span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">&ensp;เงินต้น ' . number_format($clientCashloanReport['cash_principle'], 2) . '&emsp;บาท</span>
            </td>
            <td style="width:30%;text-align:left;" class="textsizeA">
                <span style="border-bottom:2px">&emsp;&emsp;&emsp;&ensp; ดอกเบี้ย ' . number_format($clientCashloanReport['cash_interest'], 2) . '&emsp;บาท/วัน</span>
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
                <span style="border-bottom:2px">&ensp;&ensp;งวดสุดท้าย &emsp;บาท</span>
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
  
';

$end = "</tbody></table>";

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
$mpdf->Output();


    // $mpdf = new \Mpdf\Mpdf();
    // $mpdf->WriteHTML('<h1>Hello world!</h1>');
    // $mpdf->Output();
