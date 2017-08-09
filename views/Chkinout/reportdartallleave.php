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
        WHERE intime_id != '0';";
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
. "<td width='100%' style='font-size: 14px;' align='center'>" ."วันที่  ".DateThai($date_strat). "  ถึงวันที่  ".DateThai($date_end)."    เวลาทำการ  ".$intWorkDay."   วัน</td>"
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

            . "<td style='font-size: 14px;' width='15%' align='center' rowspan='2' ><b> เวลาทำงาน</b></td>"
            
            . "<td style='font-size: 14px;' width='30%' align='center' colspan='6' ><b> ประเภทการลา</b></td>"

            . "<td style='font-size: 14px;' width='5%' align='center' rowspan='2' ><b> รวม</b></td>"


    . "</tr>"
    . "<tr style='TEXT-ALIGN: center; BACKGROUND-COLOR: #e6e4e5;'>"
            . "<td style='font-size: 14px;' width='8%' align='center'>ไปราชการ</td>"
            . "<td style='font-size: 14px;' width='10%' align='center'>ลากิจ</td>"
            . "<td style='font-size: 14px;' width='8%' align='center'>ลาพักผ่อน</td>"
            . "<td style='font-size: 14px;' width='10%' align='center'>ลาป่วย</td>"
            . "<td style='font-size: 14px;' width='10%' align='center'>OT เสริม</td>"
            . "<td style='font-size: 14px;' width='10%' align='center'>หยุดงาน (วอร์ด)</td>"
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
        WHERE depart.intime_id != '0'
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
        $time = $time_A." - ".$time_B;
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
                AND SUBSTR(ch.checktime,-8,8) >'$time_C'
                AND SUBSTR(ch.checktime,-8,8) <'09:00:00'
                AND ch.checktime BETWEEN '$date_new' AND '$date_new2'; ";

    $count_daydepart = Yii::$app->db->createCommand($sqldepart)->queryAll();
    $count_daydatepart = count($count_daydepart);


    //นับวันมาสาย รวมทั้งหน่วยงาน
    $sqldepartall = "SELECT ch.userid,ch.checktime,ch.checktype as checktype, SUBSTR(ch.checktime,-8,8) AS time,SUBSTR(ch.checktime,1,11) AS date
                FROM scan_chkinout as ch
                INNER JOIN scan_userinfo  as d
                ON ch.userid = d.badgenumber
                INNER JOIN scan_department as dert
                ON d.defaultdepid = dert.deptid
                WHERE ch.checktype = '0'
                AND SUBSTR(ch.checktime,-8,8) >'$time_C'
                AND SUBSTR(ch.checktime,-8,8) <'09:00:00'
                AND ch.checktime BETWEEN '$date_new' AND '$date_new2'; ";

    $count_daydepartall = Yii::$app->db->createCommand($sqldepartall)->queryAll();
    $count_daydatepartall = count($count_daydepartall);




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


    $strSQL2all = "SELECT DISTINCT SUBSTR(ch.checktime,1,11) AS date,ch.userid
                FROM scan_chkinout ch
                INNER JOIN scan_userinfo u
                ON ch.userid = u.badgenumber
                WHERE DATE_FORMAT(ch.checktime,'%Y-%m-%d') BETWEEN '$date_strat' AND '$date_end'
     ";

    $objResult2all = Yii::$app->db->createCommand($strSQL2all)->queryAll();
    //นับจำนวนวันที่แสกนลายนิ้วมือ หน่วยงาน
    $count_leave1all = count($objResult2all);



    

    $noscan1 = 0;

    if($count_leave1 >= $sumintWorkDay){

        //แสกนนิ้วเกินจากวันทำงาน
        $noscan1= $count_leave1 - $sumintWorkDay;

        //จำนวนวันรวม ที่ไม่มีการแสกนนิ้วมือ
        $sumscandate1 = ($sumintWorkDay - $noscan1) - ($sumintWorkDay - $noscan1);

        
    }else{

        //แสกนนิ้วไม่พอ
        $noscan1 = $sumintWorkDay - ($sumintWorkDay - $noscan1);

        //จำนวนวันรวม ที่ไม่มีการแสกนนิ้วมือ
        $sumscandate1 = $sumintWorkDay - ($count_leave1 - $noscan1);

        
    }



     //นับวัน ลา
    $sqlleave = "SELECT SUM(leavetype_id = '1') as type1,SUM(leavetype_id = '2') as type2
                ,SUM(leavetype_id = '3') as type3,SUM(leavetype_id = '4') as type4,SUM(leavetype_id = '8') as type5,
                SUM(leavetype_id = '10') as type6,
                COUNT(leavetype_id) as sumleave
                FROM scan_leave ch
                INNER JOIN scan_userinfo  as d
                ON ch.userid = d.badgenumber
                INNER JOIN scan_department as dert
                ON d.defaultdepid = dert.deptid
                WHERE dert.deptid = '$deptid'
                AND leavetype_id != '5'
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

        $type6 = $r['type6'];
        if(empty($type6)){
            $type6 = 0;
        }else{
            $type6 = $type6;
        }

        $sumleave = $r['sumleave'];

    }


    $content .="<td style='font-size: 14px;'  align='center'> ".$type1."</td>"
            . "<td style='font-size: 14px;'  align='center'>".$type2."</td>"
            . "<td style='font-size: 14px;'  align='center'> ".$type3."</td>"
            . "<td style='font-size: 14px;'  align='center'> ".$type4."</td>"
            . "<td style='font-size: 14px;'  align='center'> ".$type5."</td>"
            . "<td style='font-size: 14px;'  align='center'> ".$type6."</td>"
            . "<td style='font-size: 14px;'  align='center'> ".$sumleave."</td>"
    ."</tr>";

    $count_daydatepartall +=$count_daydatepart;
    $sumscandate1all +=$sumscandate1;

}


    //นับวัน ลา
    $sqlleave = "SELECT SUM(leavetype_id = '1') as type1,SUM(leavetype_id = '2') as type2
                ,SUM(leavetype_id = '3') as type3,SUM(leavetype_id = '4') as type4,SUM(leavetype_id = '8') as type5,
                SUM(leavetype_id = '10') as type6,
                COUNT(leavetype_id) as sumleave
                FROM scan_leave ch
                INNER JOIN scan_userinfo  as d
                ON ch.userid = d.badgenumber
                INNER JOIN scan_department as dert
                ON d.defaultdepid = dert.deptid
                AND leavetype_id != '5' 
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

        $type6 = $r['type6'];
        if(empty($type6)){
            $type6 = 0;
        }else{
            $type6 = $type6;
        }

        $sumleave = $r['sumleave'];

        
    }

$content .= "
        <tr>
        <td style='font-size: 14px;' align='right' colspan='2'><b>รวม </b></td>
        <td style='font-size: 14px;' align='center'>  ".number_format( $sumcoutser , 0 )." </td>
        <td style='font-size: 14px;' align='center'>  </td>
        <td style='font-size: 14px;'  align='center'> <b> ".$type1."</b></td>
        <td style='font-size: 14px;'  align='center'><b> ".$type2."</b> </td>
        <td style='font-size: 14px;'  align='center'><b>  ".$type3."</b></td>
        <td style='font-size: 14px;'  align='center'><b>  ".$type4."</b></td>
        <td style='font-size: 14px;'  align='center'><b>  ".$type5."</b></td>
        <td style='font-size: 14px;'  align='center'><b>  ".$type6."</b></td>
        <td style='font-size: 14px;'  align='center'> <b> ".$sumleave."</b></td>
 </tr>";


$content .="</tbody></table>";
$html = $header . $content;

$mpdf->WriteHTML($html);
$mpdf->Output();
exit();



?>
