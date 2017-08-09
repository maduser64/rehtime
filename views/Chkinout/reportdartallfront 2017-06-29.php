<?php
include_once '../mpdf/mpdf.php';

$mpdf = new mPDF('th', 'A4', '0', 'THSaraban');
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetFooter('ปริ้นเมื่อ ' .DateThaipint(date('Y-m-d H:i:s')).'||แผ่นที่ {PAGENO}');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->setAutoBottomMargin;


function DateThai($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;

    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","มกราคม.","กุมภาพันธ์.","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

function DateThaipint($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;

    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","มกราคม.","กุมภาพันธ์.","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute:$strSeconds น.";
}

function CheckPublicHoliday($strChkDate){
       
        $strSQL = "SELECT * FROM scan_holiday WHERE PublicHoliday = '".$strChkDate."' ";
        $objResult = Yii::$app->db->createCommand($strSQL)->queryAll();

        foreach ($objResult as $r) {

            $Descripiton = $r['Descripiton'];

            if(!$objResult)
            {
                return false ;
            }
            else
            {
                return $Descripiton;
            }
        }
       
}

$date_time = date('Y-m-d');

//$mpdf->SetAutoFont();
    function thainumDigit($num) {
        return str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), array("o", "๑", "๒", "๓", "๔", "๕", "๖", "๗", "๘", "๙"), $num);
}

class hk_baht {

    public $result;

    public function __construct($num) {
        $this->result = $this->toBaht($num, true);
    }

    public function toBaht($number) {
        if (!preg_match('/^([0-9]+)(\.[0-9]{0,4}){0,1}$/', $number = str_replace(',', '', $number), $m))
            return 'This is not currency format';
        $m[2] = count($m) == 3 ? intval(('0' . $m[2]) * 100 + 0.5) : 0;
        $st = $this->cv($m[2]);
        return $this->cv($m[1]) . 'บาท' . $st . ($st > '' ? 'สตางค์' : 'ถ้วน');
    }

    private function cv($num) {
        $th_num = array('', array('หนึ่ง', 'เอ็ด'), array('สอง', 'ยี่'), 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า', 'สิบ');
        $th_digit = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
        $ln = strlen($num);
        $t = '';
        for ($i = $ln; $i > 0; $i--) {
            $x = $i - 1;
            $n = substr($num, $ln - $i, 1);
            $digit = $x % 6;
            if ($n != 0) {
                if ($n == 1) {
                    $t .= $digit == 1 ? '' : $th_num[1][$digit == 0 ? ($t ? 1 : 0) : 0];
                } elseif ($n == 2) {
                    $t .= $th_num[2][$digit == 1 ? 1 : 0];
                } else {
                    $t.= $th_num[$n];
                }
                $t.= $th_digit[($digit == 0 && $x > 0 ? 6 : $digit )];
            } else {
                $t .= $th_digit[$digit == 0 && $x > 0 ? 6 : 0];
            }
        }
        return $t;
    }

}


function ThaiDate($time) {
    global $thai_day_arr, $thai_month_arr;
    $thai_day_arr = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
    $thai_month_arr = array(
        "0" => "",
        "1" => "มกราคม",
        "2" => "กุมภาพันธ์",
        "3" => "มีนาคม",
        "4" => "เมษายน",
        "5" => "พฤษภาคม",
        "6" => "มิถุนายน",
        "7" => "กรกฎาคม",
        "8" => "สิงหาคม",
        "9" => "กันยายน",
        "10" => "ตุลาคม",
        "11" => "พฤศจิกายน",
        "12" => "ธันวาคม"
    );

    //$thai_date_return="วัน".$thai_day_arr[date("w",$time)];
    $thai_date_return.=" " . date("j", $time);
    $thai_date_return.=" " . $thai_month_arr[date("n", $time)];
    $thai_date_return.= " " . (date("Yํ", $time) + 543);
    //$thai_date_return.=   "  ".date("H:i",$time)." น.";
    return $thai_date_return;
}

 //นับไม่แสกนลายนิ้วมือ
    $strStartDate = $date_strat;
    $strEndDate = $date_end;

    $intWorkDay = 0;
    $intHoliday = 0;
    $intPublicHoliday = 0;
    $Descripiton = 0;
    //กำหนดค่า รวมไม่แสกนลายนิ้วมือ
    $ds = 0;
    $sumscandate = 0;
    $count_leave = 0;
    $count_leave1 = 0;

    $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate)) /  ( 60 * 60 * 24 ))+1;


    $i = 0;
    while (strtotime($strStartDate) <= strtotime($strEndDate)){
            $i++;

            $DayOfWeek = date("w", strtotime($strStartDate));

            if($DayOfWeek == 0 or $DayOfWeek == 6)  // 0 = Sunday, 6 = Saturday;
            {
                $intHoliday++;
                //$strStartDate = "<font color=red>Holiday</font><br>";

                $day = DateThai($strStartDate)." วันหยุดงาน";

                //เชคการมาทำงานสายของ บุคคล
                $strSQL1 = "SELECT DISTINCT SUBSTR(ch.checktime,1,11) AS date
                FROM scan_chkinout ch
                WHERE ch.userid='$badgenumber'
                AND DATE_FORMAT(ch.checktime,'%Y-%m-%d') BETWEEN '$date_strat' AND '$date_end';
                ";

                $strSQL2 = "SELECT DISTINCT SUBSTR(ch.checktime,1,11) AS date,ch.userid
                        FROM scan_chkinout ch
                        INNER JOIN scan_userinfo u
                        ON ch.userid = u.badgenumber
                        WHERE u.defaultdepid='$userid'
                        AND DATE_FORMAT(ch.checktime,'%Y-%m-%d') BETWEEN '$date_strat' AND '$date_end'
                        ";

                $objResult1 = Yii::$app->db->createCommand($strSQL1)->queryAll();
                $objResult2 = Yii::$app->db->createCommand($strSQL2)->queryAll();
                
                //นับจำนวนวันที่แสกนลายนิ้วมือ
                $count_leave = count($objResult1);

                //นับจำนวนวันที่แสกนลายนิ้วมือ หน่วยงาน
                $count_leave1 = count($objResult2);


            }elseif(CheckPublicHoliday($strStartDate)){
                    $intPublicHoliday++;

                    $strSQL = "SELECT * FROM scan_holiday WHERE PublicHoliday = '".$strStartDate."' ";
                    $objResult = Yii::$app->db->createCommand($strSQL)->queryAll();

                    foreach ($objResult as $r) {
                        $Descripiton = $r['Descripiton'];

                        $day = DateThai($strStartDate).' '.$Descripiton;
                    
                    }


            }else{
                $intWorkDay++;
                //$strStartDate = "<b>Work Day</b><br>";
                $day = DateThai($strStartDate)." วันทำงาน";

                //$scan = "";
            }


            
            $strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));

            

    }




    //=====================SQL==========================================
$sql = "SELECT deptid, deptname
        FROM scan_department
        WHERE intime_id = '4'
        AND intime_id != '0';";
    //=====================SQL==========================================

$rw1 = Yii::$app->db->createCommand($sql)->queryAll();
$countdeart = count($rw1);

foreach ($rw1 as $r) {
   $deptid = $r['deptid'];
   $deptname = $r['deptname'];

}

$header = "<table width='100%' style='magin-top: -20px;' >"
    . "<tr>"
    . "<td width='100%' style='font-size: 16px;'  align='center'><b>" . "บัญชีเวลาปฏิบัติราชการข้าราชการ". "</b></td>"
    . "</tr>"
    . "<tr>"
    . "<td width='100%' style='font-size: 16px;'  align='center'><b>" . "โรงพยาบาลร้อยเอ็ด  สำนักงานสาธารณสุขจังหวัดร้อยเอ็ด". "</b></td>"
    . "</tr>"
. "</table>";

$content = "<table width='100%'>"
. "<tr>"
. "<td width='100%' style='font-size: 14px;' align='center'>" ."วันที่  ".DateThai($date_strat). "  ถึงวันที่  ".DateThai($date_end)."    เวลาทำการ  ".$intTotalDay."   วัน</td>"
. "</tr>"
. "<tr>"
// . "<td width='100%' style='font-size: 14px;' align='center'>" . "วันที่  ".DateThai($date_strat). "  ถึงวันที่  ".DateThai($date_end)."</td>"
. "</tr>"
. "</table>";

$content .= "<table width='100%' border='1' style='border-collapse: collapse; border: medium none'>"
    . "<thead>"
    . "<tr style='TEXT-ALIGN: center; BACKGROUND-COLOR: #e6e4e5;'>"
            . "<td style='font-size: 14px;' width='5%' align='left'  rowspan='2' >ลำดับ</td>"

            . "<td style='font-size: 14px;' width='25%' align='center' rowspan='2' >แผนก / หน่วยงาน </td>"

            . "<td style='font-size: 14px;' width='5%' align='center' rowspan='2' ><b> จำนวนคน</b></td>"

            . "<td style='font-size: 14px;' width='10%' align='center' rowspan='2' ><b> เวลาทำงาน</b></td>"

            . "<td style='font-size: 14px;' width='15%' align='center' colspan='2' ><b>มาสาย / ไม่แสกนลายนิ้วมือ </b></td>"
            . "<td style='font-size: 14px;' width='10%' align='center' colspan='5' ><b> ประเภทการลา</b></td>"

            . "<td style='font-size: 14px;' width='5%' align='center' rowspan='2' ><b> รวม</b></td>"


    . "</tr>"
    . "<tr style='TEXT-ALIGN: center; BACKGROUND-COLOR: #e6e4e5;'>"
            . "<td style='font-size: 14px;' width='5%' align='center'>มาสาย / ครั้ง</td>"
            . "<td style='font-size: 14px;' width='5%' align='center'>ไม่แสกนลาย / ครั้ง</td>"

            . "<td style='font-size: 14px;' width='5%' align='center'>ไปราชการ</td>"
            . "<td style='font-size: 14px;' width='5%' align='center'>ลากิจ</td>"
            . "<td style='font-size: 14px;' width='5%' align='center'>ลาพักผ่อน</td>"
            . "<td style='font-size: 14px;' width='5%' align='center'> ลาป่วย</td>"
            . "<td style='font-size: 14px;' width='5%' align='center'> OT เสริม</td>"
    . "</tr>"
    . "</thead>"
. "<tbody>";


 //นับไม่แสกนลายนิ้วมือ
    $strStartDate = $date_strat;
    $strEndDate = $date_end;

    $intWorkDay = 0;
    $intHoliday = 0;
    $intPublicHoliday = 0;
    $Descripiton = 0;
    //กำหนดค่า รวมไม่แสกนลายนิ้วมือ
    $ds = 0;
    $sumscandate = 0;
    $count_leave = 0;
    $count_leave1 = 0;

    $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate)) /  ( 60 * 60 * 24 ))+1;


    $i = 0;
    while (strtotime($strStartDate) <= strtotime($strEndDate)){
            $i++;

            $DayOfWeek = date("w", strtotime($strStartDate));

            if($DayOfWeek == 0 or $DayOfWeek == 6)  // 0 = Sunday, 6 = Saturday;
            {
                $intHoliday++;
                //$strStartDate = "<font color=red>Holiday</font><br>";

                $day = DateThai($strStartDate)." วันหยุดงาน";

            }elseif(CheckPublicHoliday($strStartDate)){
                    $intPublicHoliday++;

            }else{
                $intWorkDay++;
                //$strStartDate = "<b>Work Day</b><br>";
                $day = DateThai($strStartDate)." วันทำงาน";

                //$scan = "";
            }


            
            $strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));
         
    }

    //=====================SQL==========================================
$sql = "SELECT depart.deptid as deptid, depart.deptname as deptname,COUNT(deptid) as coutuser,t.time_A as time_A,t.time_B as time_B,t.time_C as time_C
        FROM scan_department as depart
        INNER JOIN scan_intime as t
        ON depart.intime_id = t.intime_id
        INNER JOIN scan_userinfo as user
        ON depart.deptid = user.defaultdepid
        WHERE depart.intime_id = '4'
        AND depart.intime_id != '0'
        GROUP BY depart.deptid;";
    //=====================SQL==========================================

$rw1 = Yii::$app->db->createCommand($sql)->queryAll();

//$countdeart = count($rw1);

$i = 0;
foreach ($rw1 as $r) {
   $deptid = $r['deptid'];
   $deptname = $r['deptname'];
   $time_A = $r['time_A'];
   $time_B = $r['time_B'];
   $time_C = $r['time_C'];
   if($time_A != '00:00:00'){
        $time = 'เข้างานเวลา '. thainumDigit($time_A)." น.  เวลาเลิกงานเวลา ".thainumDigit($time_B).' น. ';
    }else{
        $time ="จัดตารางเวร";
    }

   $coutuser = $r['coutuser'];
   $i++;

   //วันหยุดรวมหน่วยงาน
    $sumintWorkDay = $intWorkDay * $coutuser;


   $content .="<tr>"
            . "<td style='font-size: 14px;'  align='left'>".$i."</td>"
            . "<td style='font-size: 14px;'  align='left'>".$deptname."</td>"
            . "<td style='font-size: 14px;'  align='center'>".$coutuser."</td>"
            . "<td style='font-size: 14px;'   align='center'>".$time."</td>";
            //มาสาย

    $sumcoutser +=$coutuser;

    $date_new = date("Y-m-d 07:00:00", strtotime($date_strat));
    $date_new2 = date("Y-m-d 09:00:00", strtotime($date_end));

    //นับวันมาสาย รวมทั้งหน่วยงาน
    $sqldepart = "SELECT ch.userid,ch.checktime,ch.checktype as checktype, SUBSTR(ch.checktime,-8,8) AS time,SUBSTR(ch.checktime,1,11) AS date
                FROM scan_chkinout as ch
                INNER JOIN scan_userinfo  as d
                ON ch.userid = d.badgenumber
                INNER JOIN scan_department as dert
                ON d.defaultdepid = dert.deptid
                WHERE dert.deptid = '$deptid'
                AND ch.checktype = '0'
                AND SUBSTR(ch.checktime,-8,8) > '08:15:00' 
                AND SUBSTR(ch.checktime,-8,8) < '10:00:00'
                AND ch.checktime BETWEEN '$date_new' AND '$date_new2'; ";

    $count_daydepart = Yii::$app->db->createCommand($sqldepart)->queryAll();
    $count_daydatepart = count($count_daydepart);


    $date_newnoon = date("Y-m-d 15:00:00", strtotime($date_strat));
    $date_new2noon = date("Y-m-d 20:00:00", strtotime($date_end));


    //นับวันมาสาย รวมทั้งหน่วยงาน
    $sql8noon = "SELECT ch.userid,ch.checktime,ch.checktype as checktype, SUBSTR(ch.checktime,-8,8) AS time,SUBSTR(ch.checktime,1,11) AS date
                FROM scan_chkinout as ch
                INNER JOIN scan_userinfo  as d
                ON ch.userid = d.badgenumber
                INNER JOIN scan_department as dert
                ON d.defaultdepid = dert.deptid
                WHERE dert.deptid = '$deptid'
                AND ch.checktype = '0'
                AND SUBSTR(ch.checktime,-8,8) > '16:15:00' 
                AND SUBSTR(ch.checktime,-8,8) < '20:00:00'
                AND ch.checktime BETWEEN '$date_new' AND '$date_new2' ";

    $count_daynoon = Yii::$app->db->createCommand($sql8noon)->queryAll();

    $count_daydatenoon = count($count_daynoon);


    //กำหนดช่วงเวลา 
    $date_newlate = date("Y-m-d 23:00:00", strtotime($strStartDate));
    $date_new1late = date("Y-m-d 03:00:00", strtotime("+1 day", strtotime($strStartDate)));


    //นับวันมาสาย รวมทั้งหน่วยงาน
    $sql6 = "SELECT ch.userid,ch.checktime,ch.checktype as checktype, SUBSTR(ch.checktime,-8,8) AS time,SUBSTR(ch.checktime,1,11) AS date
                FROM scan_chkinout as ch
                INNER JOIN scan_userinfo  as d
                ON ch.userid = d.badgenumber
                INNER JOIN scan_department as dert
                ON d.defaultdepid = dert.deptid
                WHERE dert.deptid = '$deptid'
                AND ch.checktype = '0'
                AND ch.checktime BETWEEN '$date_newlate' AND '$date_new1late'; ";

    $rw6 = Yii::$app->db->createCommand($sql6)->queryAll();

    $count_daydatelate = count($rw6);

    





    $strSQL2 = "SELECT DISTINCT SUBSTR(ch.checktime,1,11) AS date,ch.userid
                FROM scan_chkinout ch
                INNER JOIN scan_userinfo u
                ON ch.userid = u.badgenumber
                WHERE u.defaultdepid='$deptid'
                AND DATE_FORMAT(ch.checktime,'%Y-%m-%d') BETWEEN '$date_strat' AND '$date_end'
     ";

    $objResult2 = Yii::$app->db->createCommand($strSQL2)->queryAll();
    //นับจำนวนวันที่แสกนลายนิ้วมือ หน่วยงาน
    $count_leave1 = count($objResult2);


     //นับวัน ลา
    $sqlleave = "SELECT SUM(leavetype_id = '1') as type1,SUM(leavetype_id = '2') as type2
                ,SUM(leavetype_id = '3') as type3,SUM(leavetype_id = '4') as type4,SUM(leavetype_id = '8') as type5,
                COUNT(leavetype_id) as sumleave
                FROM scan_leave ch
                INNER JOIN scan_userinfo  as d
                ON ch.userid = d.badgenumber
                INNER JOIN scan_department as dert
                ON d.defaultdepid = dert.deptid
                WHERE dert.deptid = '$deptid'
                AND leavetype_id != '5'
                AND leavetype_id != '10' 
                AND date BETWEEN '$date_strat' AND '$date_end';";
    $count_leave2 = Yii::$app->db->createCommand($sqlleave)->queryAll();

    

    foreach ($count_leave2 as $r) {
        $type1 = $r['type1'];
        if(empty($type1)){
            $type1 = 0;
        }else{
            $type1 = $type1;
        }
        $type2 = $r['type2'];
        if(empty($type2)){
            $type2 = 0;
        }else{
            $type2 = $type2;
        }
        $type3 = $r['type3'];
        if(empty($type3)){
            $type3 = 0;
        }else{
            $type3 = $type3;
        }
        $type4 = $r['type4'];
        if(empty($type4)){
            $type4 = 0;
        }else{
            $type4 = $type4;
        }
        $type5 = $r['type5'];
        if(empty($type5)){
            $type5 = 0;
        }else{
            $type5 = $type5;
        }

        $sumleave = $r['sumleave'];

    }


    $sumdatenoscan = $intTotalDay * $coutuser;

    $sumcount_day = $count_daydatepart+$count_daydatenoon+$count_daydatelate;
    $count_dayleavedepart =  ($sumdatenoscan - $count_leave1) - $sumleave;

    $content .="<td style='font-size: 14px;'  align='center'>".number_format($sumcount_day , 0 )."</td>"
            . "<td style='font-size: 14px;'  align='center'>".number_format($count_dayleavedepart , 0 )."</td>"
            . "<td style='font-size: 14px;'  align='center'> ".$type1."</td>"
             . "<td style='font-size: 14px;'  align='center'>".$type2."</td>"
            . "<td style='font-size: 14px;'  align='center'> ".$type3."</td>"
            . "<td style='font-size: 14px;'  align='center'> ".$type4."</td>"
            . "<td style='font-size: 14px;'  align='center'> ".$type5."</td>"
            . "<td style='font-size: 14px;'  align='center'> ".$sumleave."</td>"
    ."</tr>";

    $count_daydatepartall1 +=$sumcount_day;
    $count_dayleavedepartsum +=$count_dayleavedepart;
    $type11 += $type1;
    $type21 += $type2;
    $type31 += $type3;
    $type41 += $type4;
    $type51 += $type5;
    $sumleave1 += $sumleave;
}


$content .= "
        <tr>
        <td style='font-size: 14px;' align='right' colspan='2'><b>รวม </b></td>
        <td style='font-size: 14px;' align='center'>  ".number_format($sumcoutser , 0 )." </td>
        <td style='font-size: 14px;' align='center'>  </td>
        <td style='font-size: 14px;' align='center'><b> ".number_format($count_daydatepartall1 , 0 )."</b></td>

        <td style='font-size: 14px;'  align='center'><b>".number_format($count_dayleavedepartsum , 0 )."</b></td>
        <td style='font-size: 14px;'  align='center'> <b> ".$type11."</b>  </td>
        <td style='font-size: 14px;'  align='center'><b> ".$type21."</b>   </td>
        <td style='font-size: 14px;'  align='center'><b>  ".$type31."</b>  </td>
        <td style='font-size: 14px;'  align='center'><b>  ".$type41."</b>  </td>
        <td style='font-size: 14px;'  align='center'><b>  ".$type51."</b>  </td>
        <td style='font-size: 14px;'  align='center'> <b> ".$sumleave1."</b>  </td>
 </tr>";


$content .="</tbody></table>";
$html = $header . $content;


$mpdf->WriteHTML($html);

//ขึ้นหน้าที่ 2 ========================================================================================================
$mpdf->addPage();

$no_1 = "รอ.0032.101/" . "";
$no_1 = thainumDigit($no_1);


$header ="<table width='100%' border='0'>"
            . "<tr>"
            . "<td height='24' colspan='2' style='font-size: 30px;'><img src='img/crut.gif' height='80' width='80'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>บันทึกข้อความ</b>"
            . "</td>"
            . "</tr>"
            . "<tr>"
            . "<td height='24' colspan='2' style='font-size: 22px;'><b>ส่วนราชการ</b>&nbsp;&nbsp;โรงพยาบาลร้อยเอ็ด กลุ่ม/ฝ่าย/งาน  กลุ่มงานทรัพยากรบุคคล โทร ๗๖๕๖ "
            . "</td>"
            . "</tr>"
            . "<tr>"
            . "<td height='24' width='350' style='font-size: 22px;'><b>ที่</b>&nbsp;&nbsp;" . $no_1.'.......................................'
            . "</td>"
            . "<td height='24' style='font-size: 22px;'> <b>วันที่</b>&nbsp;&nbsp;" . thainumDigit(ThaiDate(strtotime($date_time)))
            . "</td>"
            . "</tr>"
            . "<tr>"
            . "<td height='24' colspan='2' style='font-size: 22px;'><b>เรื่อง</b>&nbsp;&nbsp;รายงานผลการมาปฏิบัติงานของเจ้าหน้าที่ด้วยเครื่องแสกนลายนิ้วมือ"
            . "</td>"
            . "</tr>"
            . "<tr>"
            . "<td height='24' colspan='2' style='font-size: 22px;'><b>เรียน</b>&nbsp;&nbsp;รองผู้อำนวยการฝ่ายบริหาร</span>"
            . "</td>"
            . "</tr>"
. "</table>";


//คำควณ วันทำงาน ทั้งหน่วยงาน
$sumwork = $intWorkDay * $sumcoutser;

//คำนวณ เปอร์วันทำงาน มาสาย
//$sumpersen = ($sumwork - $count_daydatepart) * 100 / $sumwork;

$sumpersen = ($count_daydatepartall1 / $sumwork ) * 100;

//คำนวณ เปอร์วันทำงาน ไม่แสกนนิ้วมือ
//$sumpersenscan = ($sumwork - $sumscandate1) * 100 / $sumwork;

$sumpersenscan = ($count_dayleavedepartsum / $sumwork) * 100;

//คำนวณ เปอร์วันทำงาน ไม่แสกนนิ้วมือ
//$sumpersenscanleave = ($sumwork - $sumleave) * 100 / $sumwork;

$sumpersenscanleave = ($sumleave1 / $sumwork) * 100;



$content    = "<table width='100%' border='0'>"
            . "<tr>"
                . "<td height='24' colspan='2' style='font-size: 22px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                . "กลุ่มงาน/ฝ่าย/งาน/ตึก  กลุ่มงานทรัพยากรบุคคล ขอรายงานการมาปฏิบัติงาน" 
                ."</td>"
            ."</tr>"
            . "<tr>"
                . "<td height='24' colspan='2' style='font-size: 22px;'>ของเจ้าหน้าที่ด้วยเครื่องแสกนลายนิ้วมือ ระหว่างวันที่ ".thainumDigit(ThaiDate(strtotime($date_strat))) ."  ถึงวันที่ ". thainumDigit(ThaiDate(strtotime($date_end)))
                
                ."</td>"
            ."</tr>"

            . "<tr>"
                . "<td height='24' colspan='2' style='font-size: 22px;'>รวม ".thainumDigit($intTotalDay)." วันทำการ  ดังนี้"
                
                ."</td>"
            ."</tr>"

            . "<tr>"
                . "<td height='24'  style='font-size: 22px;' align='left'>
                    บุคลากรทั้งหน่วยงาน "
                
                ."</td>"
                . "<td height='24' style='font-size: 22px;' align='left'>
                    จำนวน ".thainumDigit(number_format($sumcoutser , 0 ))." ราย "
                
                ."</td>"
            ."</tr>"

            . "<tr>"
                . "<td height='24'  style='font-size: 22px;' align='left'>
                    มาสาย "
                
                ."</td>"
                . "<td height='24' style='font-size: 22px;' align='left'>"

                

                . "จำนวน ".thainumDigit(number_format($count_daydatepartall1 , 0 ))." ครั้ง   คิดเป็น ".thainumDigit(SUBSTR($sumpersen , 0,5 ))." %"

                
                ."</td>"
            ."</tr>"

            . "<tr>"
                . "<td height='24'  style='font-size: 22px;' align='left'>
                    ไม่แสกนลายนิ้วมือ "
                
                ."</td>"
                . "<td height='24' style='font-size: 22px;' align='left'>
                    จำนวน ".thainumDigit(number_format($count_dayleavedepartsum , 0 ))." ครั้ง   คิดเป็น ".thainumDigit(SUBSTR($sumpersenscan , 0,5 ))." %"
                
                ."</td>"
            ."</tr>"

            . "<tr>"
                . "<td height='24'  style='font-size: 22px;' align='left'>
                    ไปราชการ/ลากิจ/ลาพักผ่อน/ลาป่วย/OTเสริม/หยุดวอร์ด "
                
                ."</td>"
                . "<td height='24' style='font-size: 22px;' align='left'>
                    จำนวน ". thainumDigit($sumleave1)." ครั้ง   คิดเป็น ". thainumDigit(SUBSTR($sumpersenscanleave,0,5))." %"
                
                ."</td>"
            ."</tr>"

            . "<tr>"
                . "<td height='24'  colspan='2'  style='font-size: 22px;' align='left'>
                    พร้อมทั้งแนบรายงานสรุปมาพร้อมหนังสือนี้" 
                
                ."</td>"
               
            ."</tr>"
            . "<tr>"
                . "<td height='24'  colspan='2'  style='font-size: 22px;' align='left'>
                    &nbsp;&nbsp;&nbsp;&nbsp;๑.  รายงานสรุปการมาปฏิบัติงานสายของเจ้าหน้าที่ของโรงพยาบาลร้อยเอ็ด " 
                
                ."</td>"
               
            ."</tr>"
             . "<tr>"
                . "<td height='24'  colspan='2'  style='font-size: 22px;' align='left'>
                    &nbsp;&nbsp;&nbsp;&nbsp;๒.  รายงานสรุปการไม่สแกนลายนิ้วมือของเจ้าหน้าที่ของโรงพยาบาลร้อยเอ็ด " 
                
                ."</td>"
               
            ."</tr>"
            . "<tr>"
                . "<td height='24' colspan='2'  style='font-size: 22px;' align='left'>
                    จึงเรียนมาเพื่อโปรดทราบ "
                
                ."</td>"
               
            ."</tr>"



        . "</table>";


$content .="<br>"
            . "<br>"
            . "<br>"
            . "<table width='100%'>"
            . "<tr>"
            . "<td width='33%'></td>"
            . "<td style='font-size: 22px;'><center>ลงชื่อ.....................................................ผู้รายงาน</center></td>"
            . "</tr>"
            . "<tr>"
            . "<td width='33%'></td>"
            . "<td style='font-size: 22px;'><center>(......................................................................)</center>"
            . "</td>"
            . "</tr>"
            . "<tr>"
            . "<td width='33%'></td>"
            . "<td style='font-size: 22px;'><center>ตำแหน่ง .................................................................</center></td>"
            . "</tr>"
            . "</table>";


$html = $header.$content;


//$mpdf = new mPDF('th', 'A4', '0', 'THSaraban');
//$mpdf->SetDisplayMode('fullpage');
//$mpdf->SetFooter(DateThai(date('Y-m-d')). '||แผ่นที่ {PAGENO}');
//$mpdf->WriteHTML($stylesheet, 1);
//$mpdf->setAutoBottomMargin;
$mpdf->WriteHTML($html);
$mpdf->Output();
exit();



?>
