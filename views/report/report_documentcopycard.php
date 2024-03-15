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

        .split {
            height: 95%;
            width: 49.5%;
            position: fixed;
            z-index: 1;
            top: 0;
            overflow-x: hidden;
          }
          
          .left {
            left: 0;
          }
          
          .right {
            right: 0;
          }
          
          .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
          }
          .centeredleft {
            
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: left;
          }
          th, td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align:center;
          }
          .noborders td {
            border:0;
          }
          .noborderstable table {
            border:0;
          }
          .img {
            position: absolute;
            left: 0px;
            top: 0px;
            z-index: -1;
          }

    </style>
    
    ';

$content = '

    <div class="split left" style="border: 0px solid black;margin-top:-5px;">
        <div style="border: 0px solid black;padding:5px;margin-top:-15px;"> 
            <table class="noborderstable" style="width:100%;padding-top:0px;" cellpadding=0 cellspacing=0 border="0">
            <tr class="noborders">
                <td style="width:12%;text-align:left;">
                    <img width=60 height=60 src="../../public/logo_tgs1.png">
                </td>
                <td style="width:60%;text-align:left;padding-top:-15px;">&ensp;<h4>การ์ดสำเนา</h4></td>
                <td></td>
            </tr>
            </table>
        </div> 
        <div style="border: 0.8px solid black;padding:5px;margin-top:0px;"> 
            <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
                <tr class="noborders">
                    <td style="width:40%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">เลขที่สัญญา&emsp; ' . $client['contract_number'] . '</span>
                    </td>
                    <td style="width:20%;text-align:left;" class="textsizeA">
                        
                    </td>
                    <td style="width:40%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">รหัสลูกค้า&emsp;' . $client['cus_card_id'] . '</span>
                    </td>
                </tr>
            </table>
            <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
                <tr class="noborders">
                    <td style="width:50%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">ชื่อผู้ซื้อ&emsp; ' . $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname'] . '</span>
                    </td>
                    <td style="width:10%;text-align:left;" class="textsizeA">
                        
                    </td>
                    <td style="width:40%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">พนักงาน&emsp;' . $client['contract_personnelhead_name'] . '</span>
                    </td>
                </tr>
            </table>
            <table style="width:100%;margin-top:10px;" cellpadding=0 cellspacing=0 border="0">
                <tr class="noborders">
                    <td style="width:10%;text-align:left;" class="textsizeA"><b><u>ประเภทสินค้า</u></b>&ensp;
                    </td>
                </tr>
                <tr class="noborders">
                    <td style="width:10%;text-align:left;height:30px;" class="textsizeA">&ensp;สินเชื่อส่วนบุคคล 
                    </td>
                </tr>
            </table>
            <br><br><br>
        </div> 

        <div style="border: 0.8px solid black;padding:5px;margin-top:5px;"> 
            <table style="width:100%;margin-top:10px;" cellpadding=0 cellspacing=0 border="0">
                <tr class="noborders">
                    <td style="width:10%;text-align:center;" class="textsizeA"><b><u>ประเภทสินค้า</u></b>&ensp;
                    </td>
                </tr>
            </table>
            <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
                <tr class="noborders">
                    <td style="width:50%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">ยอดสินเชื่อ&emsp;&ensp; ' . number_format(($client['cash_principle'] + $client['cash_interest'])) . '&emsp; บาท</span>
                    </td>
                    <td style="width:20%;text-align:left;" class="textsizeA">
                        
                    </td>
                    <td style="width:30%;text-align:left;" class="textsizeA">
                        
                    </td>
                </tr>
            </table>
            <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
                <tr class="noborders">
                    <td style="width:40%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">ผ่อนชำระวันละ&emsp;' . number_format($client['cash_installments_daily']) . '&emsp; บาท</span>
                    </td>
                    <td style="width:30%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">จำนวน&emsp;' . number_format($client['cash_number_installment']) . '&emsp; วัน</span>
                    </td>
                    <td style="width:30%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">วันสุดท้าย&emsp;' . number_format($diff) . '&emsp; บาท</span>
                    </td>
                </tr>
            </table>
            <table style="width:100%;padding-top:10px;" cellpadding=0 cellspacing=0 border="0" class="lineup">
                <tr class="noborders">
                    <td style="width:50%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">&emsp;&emsp;วันที่เริ่มผ่อน&emsp;' . changeDate($client['cash_date_start']) . '</span>
                    </td>
                    <td style="width:50%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">&emsp;&emsp;วันที่หมดสัญญา&emsp;' . changeDate($client['cash_date_end']) . '</span>
                    </td>
                </tr>
            </table>
            <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
                <tr class="noborders">
                    <td style="width:65%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">&emsp;&emsp;ชื่อผู้ซื้อ&emsp;' . $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname'] . '</span>
                    </td>
                    <td style="width:35%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">&emsp;&emsp;ชื่อเล่น&emsp;' . $client['cus_nickname'] . '</span>
                    </td>
                </tr>
            </table>
            <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
                <tr class="noborders">
                    <td style="width:65%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">&emsp;&emsp;อาชีพ&emsp;' . $client['cus_nature_work'] . '</span>
                    </td>
                    <td style="width:35%;text-align:left;" class="textsizeA">
                    </td>
                </tr>
            </table>
            <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
                <tr class="noborders">
                    <td style="width:65%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">&emsp;&emsp;ชื่อสามี/ภรรยาผู้ซื้อ&emsp;' . $clientMarry['setpre_name'] . $clientMarry['marryd_firstname'] . ' ' . $clientMarry['marryd_lastname'] . '</span>
                    </td>
                    <td style="width:35%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">&emsp;&emsp;ชื่อเล่น&emsp;' . $clientMarry['marryd_nickname'] . '</span>
                    </td>
                </tr>
            </table>
            <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
                <tr class="noborders">
                    <td style="width:65%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">&emsp;&emsp;ชื่อผู้ค้ำประกัน&emsp;' . $clientGuarantor['setpre_name'] . $clientGuarantor['guarantor_firstname'] . ' ' . $clientGuarantor['guarantor_lastname'] . '</span>
                    </td>
                    <td style="width:35%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">&emsp;&emsp;ชื่อเล่น&emsp;' . $clientGuarantor['guarantor_nickname'] . '</span>
                    </td>
                </tr>
            </table><br>
        </div>

        <div style="border: 0.8px solid black;padding:5px;margin-top:5px;line-height: 1.8;">
            <div style="font-size:13px;text-align:center;"><b><u>ระเบียบปฏิบัติเบื้องต้น</u></b></div>
            <div style="font-size:13px;margin-top:10px;">1. โปรดนำเอกสารฉบับนี้มาประทับตราด้วยทุกครั้งที่มีการชำระเงินเพื่อเป็นหลักฐานแห่งการชำระหนี้มิฉะนั้นทางผู้ขายจะไม่รับผิดชอบใดๆ ทั้งสิ้น</div>
            <div style="font-size:13px;margin-top:10px;">2. โปรดชำระเงินค่างวดให้ตรงตามกำหนดเวลา ในสัญญาซื้อที่ท่านได้ทำไว้กับผู้ขายเพื่อเป็นการรักษาสภาพการเป็นลูกค้าที่ดีในการซื้อสินค้าครั้งต่อไป</div>
            <div style="font-size:13px;margin-top:10px;">3. ในการซื้อสินค้าใดๆ จากผู้ขาย ลูกค้าไม่ต้องเสียค่านายหน้า หรือค่าบริการใดๆ ทั้งสิ้น</div>

        </div>
    </div>

    <div class="split right" style="border: 0px solid black;background-image: url("../../public/report_documentcopycard.jpg");">
        <div class="centered">
            <h4>ตารางชำระงวดรายวัน</h4>
            <table style="width:100%;border-collapse: collapse;text-align:center;" cellpadding=2 cellspacing=1>
            <tr style="border: 1px solid black;">
                <td style="width:9%;background-color: #D3D3D3;">เดือน</td>
                <td style="background-color: #D3D3D3;">ม.ค.</td>
                <td style="background-color: #D3D3D3;">ก.พ.</td>
                <td style="background-color: #D3D3D3;">มี.ค.</td>
                <td style="background-color: #D3D3D3;">เม.ย.</td>
                <td style="background-color: #D3D3D3;">พ.ค.</td>
                <td style="background-color: #D3D3D3;">มิ.ย.</td>
                <td style="background-color: #D3D3D3;">ก.ค.</td>
                <td style="background-color: #D3D3D3;">ส.ค.</td>
                <td style="background-color: #D3D3D3;">ก.ย.</td>
                <td style="background-color: #D3D3D3;">ต.ค.</td>
                <td style="background-color: #D3D3D3;">พ.ย.</td>
                <td style="background-color: #D3D3D3;">ธ.ค.</td>
            </tr>';
// for ($x = 1; $x <= 31; $x++) {
//     $content .= '<tr>
//                     <td>' . $x . '</td>
//                     <td></td>
//                     <td></td>
//                     <td></td>
//                     <td></td>
//                     <td></td>
//                     <td></td>
//                     <td></td>
//                     <td></td>
//                     <td></td>
//                     <td></td>
//                     <td></td>
//                     <td></td>
//                     </tr>';
// }
$content .= '<tr><td>1</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>2</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>3</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>4</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>5</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>6</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>7</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>8</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>9</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>10</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>11</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>12</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>13</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>14</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>15</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>16</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>17</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>18</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>19</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>20</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>21</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>22</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>23</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>24</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>25</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>26</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>27</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>28</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>29</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>30</td><td></td><td style="background-color:#808080;"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
$content .= '<tr><td>31</td><td></td><td style="background-color:#808080;"></td><td></td><td style="background-color:#808080;"></td><td></td><td style="background-color:#808080;"></td><td></td><td></td><td style="background-color:#808080;"></td><td></td><td style="background-color:#808080;"></td><td></td></tr>';

$content .= '</table>
        </div>
    </div>';

$content1 = '
<div class="split left" style="border: 0px solid black;">
    <div class="centered">
    <h4>บันทึก</h4>
        <table style="width:100%;border-collapse: collapse;text-align:center;" cellpadding=7 cellspacing=1>
        <tr style="border: 1px solid black;">
            <td style="width:20%;background-color: #D3D3D3;">วัน / เดือน / ปี</td>
            <td style="width:60%;background-color: #D3D3D3;">บันทึกฝ่ายขาย / ฝ่ายตรวจสอบ</td>
            <td style="width:20%;background-color: #D3D3D3;">ลงชื่อ</td>
        </tr>';
for ($x = 1; $x <= 10; $x++) {
    $content1 .= '<tr>
                    <td style="line-height:12px;">&nbsp;</td>
                    <td></td>
                    <td></td>
                  </tr>';
}

$content1 .= '
        </table>
    </div>

    <div style="border: 0px solid black;padding:5px;margin-top:15px;"> 
            <table style="width:100%;margin-top:10px;" cellpadding=0 cellspacing=0 border="0">
                <tr class="noborders">
                    <td style="width:10%;text-align:center;" class="textsizeA"><b><u>บันทึก</u></b>&ensp;
                    </td>
                </tr>
            </table>
            <table style="width:100%;" cellpadding=0 cellspacing=0 border="0" class="lineup">
                <tr class="noborders">
                    <td style="width:5%;text-align:left;" class="textsizeA">
                        <img src="../../public/square.png" height="30" width="25">
                    </td>
                    <td style="width:95%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">ข้าพเจ้ามิได้เซ็นต์สัญญาซื้อให้กับผู้อื่น</span>
                    </td>
                </tr>
                <tr class="noborders">
                    <td style="width:5%;text-align:left;" class="textsizeA">
                        <img src="../../public/square.png" height="30" width="25">
                    </td>
                    <td style="width:95%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">ข้าพเจ้ามีความประสงค์ผ่อนชำระวันละ &emsp;&emsp;' . number_format($clientCashloanReport['cash_installments_daily']) . ' &emsp;&emsp;บาท</span>
                    </td>
                </tr>
                <tr class="noborders">
                    <td style="width:5%;text-align:left;" class="textsizeA">
                        <img src="../../public/square.png" height="30" width="25">
                    </td>
                    <td style="width:95%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">ข้าพเจ้าผู้ค้ำประกันยินยอมให้พนักงานเรียกเก็บค่างวดทันทีที่ผู้ซื้อค้างชำระค่างวด</span>
                    </td>
                </tr>
                <tr class="noborders">
                    <td style="width:5%;text-align:left;" class="textsizeA">
                        
                    </td>
                    <td style="width:100%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">กับทางผู้ขายไม่ว่ากรณีใดๆ ทั้งสิ้น</span>
                    </td>
                </tr>
            </table>
            
        </div>
        <div style="border: 0.8px solid black;padding:5px;margin-top:10px;"> 
            <table style="width:100%;padding-top:-10px;padding-bottom:5px;" cellpadding=0 cellspacing=0 border="0" class="lineup">
                <tr class="noborders">
                    <td style="width:5%;text-align:left;" class="textsizeA">
                        <img src="../../public/square.png" height="30" width="25">
                    </td>
                    <td style="width:95%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">ข้าพเจ้าขอรับรองว่าข้อความที่ปรากฎในเอกสารฉบับนี้เป็นจริงทุกประการ</span>
                    </td>
                </tr>
                <tr class="noborders">
                    <td style="width:5%;text-align:left;" class="textsizeA">
                        
                    </td>
                    <td style="width:95%;text-align:left;" class="textsizeA">
                        <span style="border-bottom:2px">รวมทั้งยินยอมตามข้อตกลงและเงื่อนไขแห่งการชำระหนี้ทุกประ</span>
                    </td>
                </tr>
            </table>
        </div>
        <div style="border: 0px solid black;padding:5px;margin-top:40px;"> 
            <table style="width:100%;padding-top:-10px;padding-bottom:5px;line-height: 2;" cellpadding=0 cellspacing=0 border="0" class="lineup">
                <tr class="noborders">
                    <td style="width:50%;text-align:center;" class="textsizeA">
                        <span style="border-bottom:2px">ลงชื่อ&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ผู้ซื้อ</span>
                    </td>
                    <td style="width:50%;text-align:center;" class="textsizeA">
                        <span style="border-bottom:2px">ลงชื่อ&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ผู้ค้ำประกัน</span>
                    </td>
                </tr>
                <tr class="noborders">
                    <td style="width:50%;text-align:center;" class="textsizeA">
                        <span style="border-bottom:2px">(&ensp;&ensp;' . $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname'] . '&ensp;&ensp;)</span>
                    </td>
                    <td style="width:50%;text-align:center;" class="textsizeA">
                        <span style="border-bottom:2px">(&ensp;&ensp;' . $clientGuarantor['setpre_name'] . $clientGuarantor['guarantor_firstname'] . ' ' . $clientGuarantor['guarantor_lastname'] . '&ensp;&ensp;)</span>
                    </td>
                </tr>
                <tr class="noborders">
                    <td style="width:50%;text-align:center;" class="textsizeA">
                        <span style="border-bottom:2px">วันที่..................................</span>
                    </td>
                    <td style="width:50%;text-align:center;" class="textsizeA">
                        <span style="border-bottom:2px">วันที่..................................</span>
                    </td>
                </tr>

            </table>
        </div>

</div>

<div class="split right" style="border: 0px solid black;">
    <div class="centered">
        <h4>ตารางชำระค่างวดรายเดือน</h4>
            <table style="width:100%;border-collapse: collapse;text-align:center;" cellpadding=7 cellspacing=1>
            <tr style="border: 1px solid black;">
                <td style="width:10%;background-color: #D3D3D3;">งวดที่</td>
                <td style="width:20%;background-color: #D3D3D3;">วันที่ชำระ</td>
                <td style="width:30%;background-color: #D3D3D3;">เลขที่เอกสาร</td>
                <td style="width:20%;background-color: #D3D3D3;">จำนวนเงิน</td>
                <td style="background-color: #D3D3D3;">ประทับตรา</td>
            </tr>';

for ($x = 1; $x <= 25; $x++) {
    $content1 .= '<tr>
            <td style="line-height:12px;">&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            </tr>';
}

$content1 .=  '</table> 
    </div>
</div>

';

// $mpdf->AddPage('L');
$mpdf->AddPageByArray([
    'margin-left' => 5,
    'margin-right' => 8,
    'margin-top' => 8,
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
