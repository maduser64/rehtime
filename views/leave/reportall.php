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

function DateThaiD($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;

    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay";
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
    return "$strDay $strMonthThai $strYear";
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

$date = date('Y-m-d');
$m = DateThaiM($date);
$y = DateThaiY($date);
$d = DateThaiD($date);

$session = Yii::$app->session;
$user = $session['Username'];

$sql = "SELECT *
        FROM scan_leave_report as l
        INNER JOIN scan_userinfo as d
        ON l.userid = d.badgenumber
        INNER JOIN scan_leavetype as ty
        ON l.leavetype_id = ty.leavetype_id
        WHERE l.leave_id = '$id'; "; 
    //=====================SQL==========================================

$rw1 = Yii::$app->db->createCommand($sql)->queryAll();

foreach ($rw1 as $r) {

   $title = $r['title'].$r['name'];
   $date = $r['date'];
   $date_end = $r['date_end'];


$leave_beloag = $r['beloag'];
   if($leave_beloag == ''){
      $leave_beloag = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
   }else{
      $leave_beloag = $r['beloag'];
   }

   $leave_cotton = $r['cotton'];
   if($leave_cotton == ''){
      $leave_cotton = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";  
   }else{
      $leave_cotton = $r['cotton'];  
   }


   $leave_address = $r['address'];
   if($leave_address == ''){
      $leave_address = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";  
   }else{
      $leave_address = $r['address'];  
   }

   $leave_ass = $r['leave_ass'];

   $leave_position = $r['position'];
   if($leave_position == ''){
      $leave_position = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";  
   }else{
      $leave_position = $r['position'];  
   }

   $leave_cause = $r['leave_cause'];
   if($leave_cause == ''){
      $leave_cause = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";  
   }else{
      $leave_cause = $r['leave_cause'];  
   }

   $leavetype_name = $r['leavetype_name'];
   $leavetype_id = $r['leavetype_id'];
}


//ลากิจ
if($leavetype_id == '2'){
    $type1 = "<img src='img/boxchk.jpg' height='15' width='15'>";
}else{
    $type1 = "<img src='img/box.png' height='15' width='15'>";
}

//ลาป่วย
if($leavetype_id == '4'){
    $type = "<img src='img/boxchk.jpg' height='15' width='15'>";
}else{
    $type = "<img src='img/box.png' height='15' width='15'>";
}

//ลาคลอดบุตร
if($leavetype_id == '5'){
    $type2 = "<img src='img/boxchk.jpg' height='15' width='15'>";
}else{
    $type2 = "<img src='img/box.png' height='15' width='15'>";
}



$sql1 = "SELECT `name`,title
        FROM scan_userinfo
        WHERE badgenumber = '$leave_ass'; "; 
    //=====================SQL==========================================

$rw2 = Yii::$app->db->createCommand($sql1)->queryAll();
$cout = count($rw2);

if(empty($cout)){
    $name = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}else{
    foreach ($rw2 as $r) {
        $name = $r['title'].$r['name'];
    }
       
}

$header = "<table width='100%' style='magin-top: -22px;' >"
. "<tr>"
. "<td width='100%' style='font-size: 28px;'  align='center'><b><u>" . "แบบใบลาป่วย - ลาคลอดบุตร - ลากิจส่วนตัว". "</u></b></td>"
. "</tr>"
. "<tr>"
. "<td width='100%' style='font-size: 24px;'  align='right'>" . "เขียนที่  โรงพยาบาลร้อยเอ็ด". "</td>"
. "</tr>"
. "<tr>"
. "<td width='100%' style='font-size: 24px;'  align='right'>" 
. "วันที่ <span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;".$d."&nbsp;&nbsp;&nbsp;&nbsp;</span>"
. "เดือน <span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;".$m."&nbsp;&nbsp;&nbsp;&nbsp;</span>"

. "พ.ศ. <span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;".$y."&nbsp;&nbsp;&nbsp;&nbsp;</span>"
. "</td>"
. "</tr>"
."<br><br>"
. "<tr>"
. "<td width='100%' style='font-size: 24px;'  align='left'>" . "เรื่อง  <span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;".$leavetype_name."&nbsp;&nbsp;&nbsp;&nbsp;</span> ". "</td>"
. "</tr>"
. "<tr>"
. "<td width='100%' style='font-size: 24px;'  align='left'>" . "เรียน  

<span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;ผู้อำนวยการโรงพยาบาลร้อยเอ็ด&nbsp;&nbsp;&nbsp;&nbsp;</span> ". "</td>"
. "</tr>"
. "</table>";

$content = "<table width='100%' >"
. "<tr>"
. "<td  style='font-size: 22px;'  align='left'>" 
. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
. "ข้าพเจ้า"
. "<span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;".$title."
&nbsp;&nbsp;&nbsp;&nbsp;</span>"

. "&nbsp;&nbsp;&nbsp;ตำแหน่ง
<span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;".$leave_position."&nbsp;&nbsp;&nbsp;&nbsp;</span> "
. "</td>"
. "</tr>"
. "<br><br>"
. "<tr>"
. "<td  style='font-size: 22px;'  align='left'>" . "สังกัด 
<span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$leave_beloag."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>     โรงพยาบาลร้อยเอ็ด". "</td>"

. "</tr>"
. "<tr>"
    . "<td  style='font-size: 22px;'  align='left'>" . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    ".$type."&nbsp;&nbsp;ป่วย". "</td>"
. "</tr>"
. "<tr>"
    . "<td  style='font-size: 22px;'  align='left'>" . "ขอลา &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
    .$type1."&nbsp;&nbsp;กิจส่วนตัว&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เนื่องมาจาก  <span style='border-bottom:#000 1px dotted;' align='center'> ".$leave_cause."</span></td>"
. "</tr>"
. "<tr>"
    . "<td  style='font-size: 22px;'  align='left'>" . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    ".$type2."&nbsp;&nbsp;คลอดบุตร". "</td>"
. "</tr>"
. "<tr>"
. "<td  style='font-size: 22px;'  align='left'>" . "ตั้งแต่วันที่  <span style='border-bottom:#000 1px dotted;' align='center'>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".DateThaipint($date)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
  ถึงวันที่ <span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".DateThaipint($date_end)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> กำหนด <span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".(((strtotime($date_end) - strtotime($date)) /  ( 60 * 60 * 24 ))+1)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> วัน". "</td>"
. "</tr>"
. "<tr>"
. "<td  style='font-size: 22px;'  align='left'>" . "
    ข้าพเจ้าได้ลา &nbsp;&nbsp;".$type."&nbsp;&nbsp;ป่วย
    &nbsp;&nbsp;".$type1."&nbsp;&nbsp;กิจส่วนตัว
    &nbsp;&nbsp;".$type2."&nbsp;&nbsp;คลอดบุตร
    &nbsp;&nbsp; ครั้งสุดท้ายตั้งแต่วันที่..................................................................
    </td>"
. "</tr>"

. "<tr>"
. "<td  style='font-size: 22px;'  align='left'>" . "ในระหว่างลาจะติดต่อข้าพเจ้าได้ที่บ้านเลขที่ <span style='border-bottom:#000 1px dotted;' align='center'> ".$leave_address."</span></td>"
. "</tr>"
. "<tr>"
. "</tr>"
. "<tr>"
. "<td  style='font-size: 22px;'  align='left'>" . "ในระหว่างลาคลอดบุตรหรือลากิจส่วนตัวข้าพเจ้าขอมอบหมายงานให้ <span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$name."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> ปฏิบัติแทน ". "</td>"
. "</tr>"
. "<br>"
. "<tr>"
. "<td  style='font-size: 22px;'  align='right'>" . "ขอแสดงความนับถือ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". "</td>"
. "</tr>"
. "<tr>"
. "<td  style='font-size: 22px;'  align='right'>" . "(ลงชื่อ)..........................................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". "</td>"
. "</tr>"
. "<tr>"
. "<td  style='font-size: 22px;'  align='right'>" . "(<span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$title."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". "</td>"
. "</tr><br>"
. "<tr>"
. "<td  style='font-size: 22px;'  align='right'>" . "<br>(ลงชื่อ)..........................................................................ผู้รับมอบ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". "</td>"
. "</tr>"
. "<tr>"
. "<td  style='font-size: 22px;'  align='right'>" . "(<span style='border-bottom:#000 1px dotted;' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$name."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". "</td>"
. "</tr>"
. "</table>";



$content1 = "<table width='100%'>"
. "<tr>"
. "<td width='50%' style='font-size: 22px;'  align='center' rowspan='1'><b><u>" . "สถิติการลาในปีงบประมาณนี้ ". "</b></u>


<table width='100%' border='1' style='table-layout:fixed;empty-cells:show; border-collapse:collapse; width:100%;';>"
. "<tr>"
. "<th style='font-size: 22px;' >ประเภท</th>
   <th style='font-size: 16px;'><b>ลามาแล้ว </b><br> (วันทำการ)</th>
   <th style='font-size: 16px;'><b>ลาครั้งที่</b> <br> (วันทำการ)</th>
   <th style='font-size: 16px;'><b>รวมเป็น </b><br> (วันทำการ)</th>"    
. "</tr>"
  . "<tr>
    <td style='font-size: 22px;' >ป่วย</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>"
  . "<tr>
    <td style='font-size: 22px;' >กิจส่วนตัว</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>"
  . "<tr>
    <td style='font-size: 22px;' >คลอดบุตร</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>"
. "</table>"

."</td>"
. "<td width='50%' style='font-size: 22px;'  align='center' rowspan='1'>" . "ความเห็นผู้บังคับบัญชา "
. " .............................................................................................................. <br>
.............................................................................................................. <br>
(ลงชื่อ)................................................................................................... <br>
ตำแหน่ง................................................................................................"
. "</td>"
. "</tr></table> ";


$content1 .="<table width='100%'><tr><td width='50%' style='font-size: 22px;'  align='center' >"
. "<tr>"
. "<td width='50%' style='font-size: 22px;'  align='right'><b><u>" . "คำสั่ง ". "</b></u></td>"
. "<td width='50%' style='font-size: 22px;'  align='center'>" . " <img src='img/box.png' height='15' width='15'>  อนุญาต   <img src='img/box.png' height='15' width='15'>  ไม่อนุญาต ". "</td>"
. "</tr>"
. "<tr>"
. "<td width='50%' style='font-size: 22px;'  align='center'>" . " ลงชื่อ .......................................................... ผู้ตรวจ". "</td>"
. "<td width='50%' style='font-size: 22px;'  align='center'>" . " ........................................................................................................................ ". "</td>"
. "</tr>"
. "<tr>"
. "<td width='50%' style='font-size: 22px;'  align='center'>" . "( ............................................................. ) ". "</td>"
. "<td width='50%' style='font-size: 22px;'  align='center'>" . " ........................................................................................................................ ". "</td>"
. "</tr>"
. "<tr>"
. "<td width='50%' style='font-size: 22px;'  align='center'>" . " ตำแหน่ง ..........................................................". "</td>"
. "<td width='50%' style='font-size: 22px;'  align='center'>" . " ........................../.............................................................../............................. ". "</td>"
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


