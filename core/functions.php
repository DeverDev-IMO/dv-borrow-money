<?php
function changeDate($date)
{
    if ($date != '0000-00-00') {
        //ใช้ Function explode ในการแยกไฟล์ ออกเป็น  Array
        $get_date = explode("-", $date);
        //กำหนดชื่อเดือนใส่ตัวแปร $month
        $month = array("01" => "ม.ค.", "02" => "ก.พ", "03" => "มี.ค.", "04" => "เม.ย.", "05" => "พ.ค.", "06" => "มิ.ย.", "07" => "ก.ค.", "08" => "ส.ค.", "09" => "ก.ย.", "10" => "ต.ค.", "11" => "พ.ย.", "12" => "ธ.ค.");
        //month
        $get_month = $get_date["1"];
        //year    
        $year = $get_date["0"] + 543;
        return $get_date["2"] . " " . $month[$get_month] . " " . $year;
    } else {
        return '';
    }
}

function changeDateYearThai($date)
{
    $get_date = $date + 543;
    return $get_date;
}

function TelFormat($mobile)
{
    $minus_sign = "-";   // กำหนดเครื่องหมาย 
    $part1 = substr($mobile, 0, -7);  // เริ่มจากซ้ายตัวที่ 1 ( 0 ) ตัดทิ้งขวาทิ้ง 7 ตัวอักษร ได้ 085 
    $part2 = substr($mobile, 3, -3);  // เริ่มจากซ้าย ตัวที่ 4 (9) ตัดทิ้งขวาทิ้ง 3 ตัวอักษร ได้ 9490 
    $part3 = substr($mobile, 7); // เริ่มจากซ้าย ตัวที่ 8 (8) ไม่ตัดขวาทิ้ง ได้ 862  
    $a = $part1 . $minus_sign . $part2 . $minus_sign . $part3;
    return $a;
}
///////////////////////ฟังก์ชั่นเกี่ยวกับการหาค่าต่างของวันที่และเวลา//////////////////////
function DateDiff($strDate1, $strDate2)
{
    return (strtotime($strDate2) - strtotime($strDate1)) /  (60 * 60 * 24);  // 1 day = 60*60*24
}
function TimeDiff($strTime1, $strTime2)
{
    return (strtotime($strTime2) - strtotime($strTime1)) /  (60 * 60); // 1 Hour =  60*60
}
function DateTimeDiff($strDateTime1, $strDateTime2)
{
    return (strtotime($strDateTime2) - strtotime($strDateTime1)) /  (60 * 60); // 1 Hour =  60*60
}
///////////////////////\\ฟังก์ชั่นเกี่ยวกับการหาค่าต่างของวันที่และเวลา//////////////////////