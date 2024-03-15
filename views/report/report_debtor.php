<?php
$debtortype = $_REQUEST['debtortype'];
switch ($debtortype) {
    case 'debtortype1': //ยอดค้างชำระ ระหว่าง 1 ถึง 10 งวด
        // echo 'debtortype1';
        require '../../views/report/debtortype1.php';
        break;
    case 'debtortype2': //ค้างมากกว่า 10 งวด และยังไม่ครบสัญญา
        require '../../views/report/debtortype2.php';
        break;
    case 'debtortype3': //หมดสัญญา
        require '../../views/report/debtortype3.php';
        break;
    case 'debtortype4': //หนี้ NPL [ หลังจากหมดสัญญา 30 วัน ]
        require '../../views/report/debtortype4.php';
        break;
    case 'debtortype5': //ลูกหนี้การค้ารวม ตั้งแต่เปิดมายังไม่ปิดบัญชี
        require '../../views/report/debtortype5.php';
        break;
    case 'debtortype6': //ลูกหนี้การค้าไม่รวม NPL
        require '../../views/report/debtortype6.php';
        break;
}
