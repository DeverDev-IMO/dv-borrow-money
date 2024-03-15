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
$client = $report->DocumentcardReport("contract", $id);
$clientSub = $report->DocumentcardReportSub("contract", $id);

// $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5-L']);
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [228, 162]]); //format กว้าง * สูง
// $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [297, 210]]); //format กว้าง * สูง
$head = '
    <style>
        body{
            font-family: "Garuda";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
        } 
        .textsizeA{
            font-size:22px;
        }
        .textsizeB{
            font-size:17px;
        }
        .lineup{
            margin-top:12px;
        }
        td {
            height:50px;    //ความสูงแต่ละแถว
        }
        
    </style>
    <div style="border: 0px solid black;padding-top:20px;padding-left:0px;">
        <table style="width:100%;margin-top:5px;" cellpadding=0 cellspacing=0 border="0">
            <tr>
                <td style="width:15%;text-align:left;" rowspan="3">
                    <img width=115 height=75 src="../../public/logo_tgs.png">
                </td>
                <td style="width:60%;text-align:left;font-size:19px;"><b>เลขที่การ์ด&emsp;&emsp;' . $client['contract_number'] . '</b></td>
                <td></td>
            </tr>
            <tr>
                <td style="width:60%;text-align:left;font-size:19px;"><b>ชื่อลูกค้า&emsp;&emsp;&emsp;' . $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname'] . '</b></td>
                <td></td>
            </tr>
        </table>
    </div>
    ';

$content = '
  <div style="padding:5px;margin-top:180px;padding-left:0px;">
    <table style="width:100%;margin-top:5px;" cellpadding=0 cellspacing=0 border="0">
        <tr>
            <td style="width:40%;text-align:left;" class="textsizeB">
                <span style="border-bottom:2px">&emsp;&emsp;</span> 
            </td>
            <td style="width:20%;text-align:left;" class="textsizeB">
                <span style="border-bottom:2px"><b>พนักงาน&emsp;</b></span> 
            </td>
            <td style="width:20%;text-align:left;" class="textsizeB">
            </td>
        </tr>
        <tr>
            <td style="width:40%;text-align:left;" class="textsizeB">
                <span style="border-bottom:2px">&emsp;&emsp;<b>&emsp;</b></span> 
            </td>
            <td style="width:20%;text-align:left;" class="textsizeB">
                <span style="border-bottom:2px">&emsp;&emsp;<b>' . $client['contract_personnelhead_name'] . '&emsp;</b></span> 
            </td>
            <td style="width:20%;text-align:left;" class="textsizeB">
                <span style="border-bottom:2px">&emsp;&emsp;<b>' . $client['contract_personnelhead_tel'] . '&emsp;</b></span>
            </td>
        </tr>
        <tr>
            <td style="width:40%;text-align:left;" class="textsizeB">
                <span style="border-bottom:2px">&emsp;&emsp;<b>&emsp;</b></span> 
            </td>
            <td style="width:20%;text-align:left;" class="textsizeB">
                <span style="border-bottom:2px">&emsp;&emsp;<b>' . $clientSub['contract_personnelhenchman_name'] . '&emsp;</b></span> 
            </td>
            <td style="width:20%;text-align:left;" class="textsizeB">
                <span style="border-bottom:2px">&emsp;&emsp;<b>' . $clientSub['contract_personnelhenchman_tel'] . '&emsp;</b></span>
            </td>
        </tr>
    </table>
   
  </div>
';



// $mpdf->AddPage('L');
$mpdf->AddPageByArray([
    'margin-left' => 2,
    'margin-right' => 2,
    'margin-top' => 2,
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
