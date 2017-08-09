<?php

function DateThaiM($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;

    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","มกราคม.","กุมภาพันธ์.","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strMonthThai";
}
function DateThaiY($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;

    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strYear";
}

function DateThaipint($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;

    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute:$strSeconds น.";
}

function diff2time($time_a,$time_b){
    $now_time1=strtotime(date("Y-m-d ".$time_a));
    $now_time2=strtotime(date("Y-m-d ".$time_b));

    $time_diff=abs($now_time2-$now_time1);
    $time_diff_h=floor($time_diff/3600); // จำนวนชั่วโมงที่ต่างกัน
    $time_diff_m=floor(($time_diff%3600)/60); // จำวนวนนาทีที่ต่างกัน
    $time_diff_s=($time_diff%3600)%60; // จำนวนวินาทีที่ต่างกัน
    //return $time_diff_h." ชั่วโมง ".$time_diff_m." นาที ".$time_diff_s." วินาที";

    
    if($time_diff_h == 0){
        return $time_diff_m." น. ";
    }else{
        return $time_diff_h." ชม. ".$time_diff_m." น. ";
    }
}

//$mpdf->SetAutoFont();
    function thainumDigit($num) {
        return str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), array("o", "๑", "๒", "๓", "๔", "๕", "๖", "๗", "๘", "๙"), $num);
}

//A = 15.57 B= 16.00

function diff2timeout($time_a,$time_b){
    $now_time1=strtotime(date("Y-m-d ".$time_a));
    $now_time2=strtotime(date("Y-m-d ".$time_b));

    $time_diff=abs($now_time2-$now_time1);
    $time_diff_h=floor($time_diff/3600); // จำนวนชั่วโมงที่ต่างกัน
    $time_diff_m=floor(($time_diff%3600)/60); // จำวนวนนาทีที่ต่างกัน
    $time_diff_s=($time_diff%3600)%60; // จำนวนวินาทีที่ต่างกัน
    //return $time_diff_h." ชั่วโมง ".$time_diff_m." นาที ".$time_diff_s." วินาที";

    
    if($time_diff_h == 0){
        return $time_diff_m." น. ";
    }else{
        return $time_diff_h." ชม. ".$time_diff_m." น. ";
    }
}

$m = DateThaiM(date('m'));
$y = DateThaiY(date('Y'));
$d = thainumDigit(date('d'));

$session = Yii::$app->session;
$user = $session['Username'];

$sql = "SELECT *
        FROM scan_leave as l
        INNER JOIN scan_userinfo as d
        ON l.userid = d.badgenumber
        WHERE l.leave_id = '$id'; "; 
    //=====================SQL==========================================

$rw1 = Yii::$app->db->createCommand($sql)->queryAll();

foreach ($rw1 as $r) {
   $title = $r['name'];
}


$header = "<table width='100%' style='magin-top: -20px;' >"
. "<tr>"
. "<td width='100%' style='font-size: 28px;'  align='center'><b><u>" . "แบบใบลาพักผ่อน". "</u></b></td>"
. "</tr>"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='right'>" . "เขียนที่  โรงพยาบาลร้อยเอ็ด". "</td>"
. "</tr>"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='right'>" 
. "วันที่ <span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;".$d."&nbsp;&nbsp;&nbsp;&nbsp;</span>"
. "เดือน <span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;".$m."&nbsp;&nbsp;&nbsp;&nbsp;</span>"

. "พ.ศ. <span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;".thainumDigit($y)."&nbsp;&nbsp;&nbsp;&nbsp;</span>"
. "</td>"
. "</tr>"
."<br><br>"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='left'>" . "เรื่อง  ขอลาพักผ่อน ". "</td>"
. "</tr>"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='left'>" . "เรียน  

<span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;ผู้อำนวยการ&nbsp;&nbsp;&nbsp;&nbsp;</span> ". "</td>"
. "</tr>"
. "</table>";

$content = "<table width='100%' style='magin-top: -20px;' >"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='left'>" 
. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
. "ข้าพเจ้า"
. "<span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$title."
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>"

. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตำแหน่ง..........................................................................................................</span>"
. "</td>"
. "</tr>"
. "<br><br>"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='left'>" . "สังกัด  ........................................................................................  
  ฝ่าย   ........................................................................................      โรงพยาบาลร้อยเอ็ด". "</td>"
. "</tr>"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='left'>" . "มีวันลาพักผ่อนสะสม  ...................................
  ทำการ  มีสืทธิลากพักผ่อนประจำปีนี้อีก 10 วันทำการ  รวมเป็น .......................................... วันทำการ". "</td>"
. "</tr>"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='left'>" . "ขอลาพักผ่อนตั้งแต่วันที่   .............................................................
  ถึงวันที่ .................................................................... กำหนด .......................... วัน". "</td>"
. "</tr>"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='left'>" . "ในระหว่างลาจะติดต่อข้าพเจ้าได้ที่บ้านเลขที่................................................................................................................................................................". "</td>"
. "</tr>"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='left'>" . "......................................................................................................................................................................................................................................". "</td>"
. "</tr>"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='left'>" . "ในระหว่างลาข้าพเจ้าขอมอบงานให้ ..........................................................................................................................................................ปฏิบัติแทน ". "</td>"
. "</tr>"
. "<br><br><br>"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='right'>" . "ขอแสดงความนับถือ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". "</td>"
. "</tr>"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='right'>" . "(ลงชื่อ)..........................................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". "</td>"
. "</tr>"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='right'>" . "(..........................................................................)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". "</td>"
. "</tr>"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='right'>" . "(ลงชื่อ)..........................................................................ผู้รับมอบ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". "</td>"
. "</tr>"
. "<tr>"
. "<td width='100%' style='font-size: 20px;'  align='right'>" . "(..........................................................................)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". "</td>"
. "</tr>"
. "</table>";



$content1 = "<table width='100%'>"
. "<tr>"
. "<td width='40%' style='font-size: 20px;'  align='center' rowspan='1'><b><u>" . "สถิติการลาในปีงบประมาณนี้ ". "</b></u>


<table width='100%' border='1' style='table-layout:fixed;empty-cells:show; border-collapse:collapse; width:100%;';>"
. "<tr>"
. "<th>ลงมาแล้ว <br> (วันทำการ)</th><th>ลาครั้งที่ <br> (วันทำการ)</th><th>รวมเป็น <br> (วันทำการ)</th>"    
. "</tr>"
  . "<tr>
    <td rowspan='4'>&nbsp;<br><br><br><br><br><br><br></td>
    <td rowspan='4'>&nbsp;<br><br><br><br><br><br><br></td>
    <td rowspan='4'>&nbsp;<br><br><br><br><br><br><br></td>
  </tr>"
. "</table>"

."</td>"
. "<td width='40%' style='font-size: 20px;'  align='center' rowspan='1'>" . "ความเห็นผู้บังคับบัญชา "
. " .............................................................................................................. <br>
.............................................................................................................. <br>
.............................................................................................................. <br>
.............................................................................................................. <br>
.............................................................................................................. <br>
(ลงชื่อ)................................................................................................... <br>
ตำแหน่ง................................................................................................"
. "</td>"
. "</tr></table> ";


$content1 .="<table width='100%'><tr><td width='40%' style='font-size: 20px;'  align='center' >"
. "<tr>"
. "<td width='40%' style='font-size: 20px;'  align='right'><b><u>" . "คำสั่ง ". "</b></u></td>"
. "<td width='40%' style='font-size: 20px;'  align='center'>" . " <img src='img/box.png' height='15' width='15'>  อนุญาติ   <img src='img/box.png' height='15' width='15'>  ไม่อนุญาติ ". "</td>"
. "</tr>"
. "<tr>"
. "<td width='40%' style='font-size: 20px;'  align='center'>" . " ลงชื่อ .......................................................... ผู้ตรวจ". "</td>"
. "<td width='40%' style='font-size: 20px;'  align='center'>" . " ........................................................................................................................ ". "</td>"
. "</tr>"
. "<tr>"
. "<td width='40%' style='font-size: 20px;'  align='center'>" . "( ............................................................. ) ". "</td>"
. "<td width='40%' style='font-size: 20px;'  align='center'>" . " ........................................................................................................................ ". "</td>"
. "</tr>"
. "<tr>"
. "<td width='40%' style='font-size: 20px;'  align='center'>" . " ตำแหน่ง ..........................................................". "</td>"
. "<td width='40%' style='font-size: 20px;'  align='center'>" . " ........................................................................................................................ ". "</td>"
. "</tr>"
. "<tr>"
. "<td width='40%' style='font-size: 20px;'  align='center'>" . " ". "</td>"
. "<td width='40%' style='font-size: 20px;'  align='center'>" . " ........................................................................................................................ ". "</td>"
. "</tr>"
. "<tr>"
. "<td width='40%' style='font-size: 20px;'  align='center'>" . " ". "</td>"
. "<td width='40%' style='font-size: 20px;'  align='center'>" . " ........................................................................................................................ ". "</td>"
. "</tr>"
. "<tr>"
. "<td width='40%' style='font-size: 20px;'  align='center'>" . " ". "</td>"
. "<td width='40%' style='font-size: 20px;'  align='center'>" . " ........................../.............................................................../............................. ". "</td>"
. "</tr>"
. "</table>";


$html = $header.$content.$content1;

include_once '../mpdf/mpdf.php';

$mpdf = new mPDF('th', 'A4', '0', 'THSaraban','10','10','20','5');
$mpdf->SetDisplayMode('fullpage');
//$mpdf->SetFooter('ปริ้นเมื่อ ' .DateThaipint(date('Y-m-d H:i:s')));
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->setAutoBottomMargin;
$mpdf->WriteHTML($html);
$mpdf->Output();
exit();
?>


