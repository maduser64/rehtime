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
        WHERE intime_id != '4'
        AND intime_id != '0'; ";
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


//=====================SQL==========================================
$sql = "SELECT depart.deptid as deptid, depart.deptname as deptname,COUNT(deptid) as coutuser,t.time_A as time_A,t.time_B as time_B,t.time_C as time_C
        FROM scan_department as depart
        INNER JOIN scan_intime as t
        ON depart.intime_id = t.intime_id
        INNER JOIN scan_userinfo as user
        ON depart.deptid = user.defaultdepid
        WHERE depart.intime_id != '4'
        AND depart.intime_id != '0'
        GROUP BY depart.deptid";
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
    $coutuser = $r['coutuser'];
    $i++;

    //วันหยุดรวมหน่วยงาน
    $sumintWorkDay = $intWorkDay * $coutuser;


    $content .="<tr>"
        . "<td style='font-size: 14px;'  align='left'>".$i."</td>"
        . "<td style='font-size: 14px;'  align='left'>".$deptname."</td>"
        . "<td style='font-size: 14px;'  align='center'>".$coutuser."</td>"
        . "<td style='font-size: 14px;'   align='center'>".$time_A.'-'.$time_B."</td>";
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



    $sqldart = "SELECT * FROM scan_userinfo u
                LEFT JOIN scan_department d ON u.defaultdepid=d.deptid
                LEFT JOIN scan_intime i ON d.intime_id=i.intime_id
                where u.defaultdepid='$deptid';";

    $rwdart = Yii::$app->db->createCommand($sqldart)->queryAll();

    foreach ($rwdart as $r) {
        $name = $r['name'];
        $userid1 = $r['userid'];
        $badgenumber = $r['badgenumber'];
        $j++;

        //นับวันมาสาย
        $sql8 = "SELECT ch.userid,ch.checktime,ch.checktype as checktype, SUBSTR(ch.checktime,-8,8) AS time,SUBSTR(ch.checktime,1,11) AS date
                FROM scan_chkinout ch
                WHERE ch.userid='$badgenumber'
                AND ch.checktype = '0'
                AND SUBSTR(ch.checktime,-8,8) > '$time_C'
                AND SUBSTR(ch.checktime,-8,8) < '10:00:00'
                AND ch.checktime BETWEEN '$date_new' AND '$date_new2';
    ";

        $count_day = Yii::$app->db->createCommand($sql8)->queryAll();
        $count_daydate = count($count_day);



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
        $dayoff = 0;
        $dayoffweek = 0;
        $sumscandate = 0;

        $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate)) /  ( 60 * 60 * 24 ))+1;


        $i = 0;
        while (strtotime($strStartDate) <= strtotime($strEndDate)){
            $i++;

            $DayOfWeek = date("w", strtotime($strStartDate));

            if($DayOfWeek == 0) {
                $intHoliday++;
                $day = "วัน  อาทิตย์ ที่ ".DateThai($strStartDate);

                $sqlday = "SELECT DISTINCT SUBSTR(checktime,1,11) AS date,c.userid
            FROM scan_chkinout as c
            WHERE c.userid = '$badgenumber'
            AND DATE_FORMAT(c.checktime,'%Y-%m-%d') = '$strStartDate';";

                $result_dayon = Yii::$app->db->createCommand($sqlday)->queryAll();
                $cout_dayon = count($result_dayon);

                if($cout_dayon > 0){
                    $sumscandate += 0;
                }else{
                    $sumscandate += 0;
                }


            }elseif($DayOfWeek == 6){
                $intHoliday++;

                $day = "วัน  เสาร์ ที่  ".DateThai($strStartDate);

                $sqlday = "SELECT DISTINCT SUBSTR(checktime,1,11) AS date,c.userid
            FROM scan_chkinout as c
            WHERE c.userid = '$badgenumber'
            AND DATE_FORMAT(c.checktime,'%Y-%m-%d') = '$strStartDate';";

                $result_dayon = Yii::$app->db->createCommand($sqlday)->queryAll();
                $cout_dayon = count($result_dayon);

                if($cout_dayon > 0){
                    $sumscandate += 0;
                }else{
                    $sumscandate += 0;
                }

            }elseif(CheckPublicHoliday($strStartDate)){

                $intPublicHoliday++;

                $sqlday = "SELECT DISTINCT SUBSTR(checktime,1,11) AS date,c.userid
        FROM scan_chkinout as c
        WHERE c.userid = '$badgenumber'
        AND DATE_FORMAT(c.checktime,'%Y-%m-%d') = '$strStartDate';";

                $result_dayon = Yii::$app->db->createCommand($sqlday)->queryAll();
                $cout_dayon = count($result_dayon);

                if($cout_dayon > 0){
                    $sumscandate += 0;
                }else{
                    $sumscandate += 0;
                }

            }
            else{
                $intWorkDay++;
                if($DayOfWeek == 1){
                    $day = "วัน  จันทร์ ที่ ".DateThai($strStartDate);

                    $sqlday = "SELECT DISTINCT SUBSTR(checktime,1,11) AS date,c.userid
            FROM scan_chkinout as c
            WHERE c.userid = '$badgenumber'
            AND DATE_FORMAT(c.checktime,'%Y-%m-%d') = '$strStartDate';";

                    $result_dayon = Yii::$app->db->createCommand($sqlday)->queryAll();

                    $cout_dayon = count($result_dayon);
                    if($cout_dayon > 0){
                        $sumscandate += 1;

                        foreach ($result_dayon as $r) {
                            $datescan = $r['date'];

                            $sqldayleave = "SELECT DISTINCT date
                    FROM scan_leave as c
                    WHERE c.userid = '$badgenumber'
                    AND date = '$datescan';";

                            $result_leave = Yii::$app->db->createCommand($sqldayleave)->queryAll();
                            $cout_result_leave = count($result_leave);
                            if($cout_result_leave > 0){
                                $sumscandateleave += 1;


                            }else{
                                $sumscandateleave += 0;
                            }
                        }
                    }else{
                        $sumscandate += 0;
                    }


                }elseif($DayOfWeek == 2){
                    $day = "วัน  อังคาร ที่ ".DateThai($strStartDate);
                    $sqlday = "SELECT DISTINCT SUBSTR(checktime,1,11) AS date,c.userid
            FROM scan_chkinout as c
            WHERE c.userid = '$badgenumber'
            AND DATE_FORMAT(c.checktime,'%Y-%m-%d') = '$strStartDate';";

                    $result_dayon = Yii::$app->db->createCommand($sqlday)->queryAll();

                    $cout_dayon = count($result_dayon);
                    if($cout_dayon > 0){
                        $sumscandate += 1;

                        foreach ($result_dayon as $r) {
                            $datescan = $r['date'];

                            $sqldayleave = "SELECT DISTINCT date
                    FROM scan_leave as c
                    WHERE c.userid = '$badgenumber'
                    AND date = '$datescan';";

                            $result_leave = Yii::$app->db->createCommand($sqldayleave)->queryAll();
                            $cout_result_leave = count($result_leave);
                            if($cout_result_leave > 0){
                                $sumscandateleave += 1;


                            }else{
                                $sumscandateleave += 0;
                            }
                        }
                    }else{
                        $sumscandate += 0;
                    }



                }elseif($DayOfWeek == 3){

                    $day = "วัน  พุธ ที่ ".DateThai($strStartDate);

                    $sqlday = "SELECT DISTINCT SUBSTR(checktime,1,11) AS date,c.userid
            FROM scan_chkinout as c
            WHERE c.userid = '$badgenumber'
            AND DATE_FORMAT(c.checktime,'%Y-%m-%d') = '$strStartDate';";

                    $result_dayon = Yii::$app->db->createCommand($sqlday)->queryAll();

                    $cout_dayon = count($result_dayon);
                    if($cout_dayon > 0){
                        $sumscandate += 1;

                        foreach ($result_dayon as $r) {
                            $datescan = $r['date'];

                            $sqldayleave = "SELECT DISTINCT date
                    FROM scan_leave as c
                    WHERE c.userid = '$badgenumber'
                    AND date = '$datescan';";

                            $result_leave = Yii::$app->db->createCommand($sqldayleave)->queryAll();
                            $cout_result_leave = count($result_leave);
                            if($cout_result_leave > 0){
                                $sumscandateleave += 1;


                            }else{
                                $sumscandateleave += 0;
                            }
                        }
                    }else{
                        $sumscandate += 0;
                    }

                    //นับวัน ลา


                }elseif($DayOfWeek == 4){
                    $day = "วัน  พฤหัส ที่ ".DateThai($strStartDate);

                    $sqlday = "SELECT DISTINCT SUBSTR(checktime,1,11) AS date,c.userid
            FROM scan_chkinout as c
            WHERE c.userid = '$badgenumber'
            AND DATE_FORMAT(c.checktime,'%Y-%m-%d') = '$strStartDate';";

                    $result_dayon = Yii::$app->db->createCommand($sqlday)->queryAll();

                    $cout_dayon = count($result_dayon);
                    if($cout_dayon > 0){
                        $sumscandate += 1;

                        foreach ($result_dayon as $r) {
                            $datescan = $r['date'];

                            $sqldayleave = "SELECT DISTINCT date
                    FROM scan_leave as c
                    WHERE c.userid = '$badgenumber'
                    AND date = '$datescan';";

                            $result_leave = Yii::$app->db->createCommand($sqldayleave)->queryAll();
                            $cout_result_leave = count($result_leave);
                            if($cout_result_leave > 0){
                                $sumscandateleave += 1;


                            }else{
                                $sumscandateleave += 0;
                            }
                        }
                    }else{
                        $sumscandate += 0;
                    }



                }else{
                    $day = "วัน  ศุกร์ ที่ ".DateThai($strStartDate);

                    $sqlday = "SELECT DISTINCT SUBSTR(checktime,1,11) AS date,c.userid
            FROM scan_chkinout as c
            WHERE c.userid = '$badgenumber'
            AND DATE_FORMAT(c.checktime,'%Y-%m-%d') = '$strStartDate';";

                    $result_dayon = Yii::$app->db->createCommand($sqlday)->queryAll();

                    $cout_dayon = count($result_dayon);
                    if($cout_dayon > 0){
                        $sumscandate += 1;

                        foreach ($result_dayon as $r) {
                            $datescan = $r['date'];

                            $sqldayleave = "SELECT DISTINCT date
                    FROM scan_leave as c
                    WHERE c.userid = '$badgenumber'
                    AND date = '$datescan';";

                            $result_leave = Yii::$app->db->createCommand($sqldayleave)->queryAll();
                            $cout_result_leave = count($result_leave);
                            if($cout_result_leave > 0){
                                $sumscandateleave += 1;


                            }else{
                                $sumscandateleave += 0;
                            }
                        }
                    }else{
                        $sumscandate += 0;
                    }


                }
            }


            //เชคการมาทำงานสายของ บุคคล
            $strSQL1 = "SELECT DISTINCT SUBSTR(ch.checktime,1,11) AS date
                FROM scan_chkinout ch
                WHERE ch.userid='$badgenumber'
                AND DATE_FORMAT(ch.checktime,'%Y-%m-%d') BETWEEN '$date_strat' AND '$date_end';
                ";


            $objResult1 = Yii::$app->db->createCommand($strSQL1)->queryAll();
            //$objResult2 = Yii::$app->db->createCommand($strSQL2)->queryAll();

            //นับจำนวนวันที่แสกนลายนิ้วมือ
            $count_leave = count($objResult1);

            //นับจำนวนวันที่แสกนลายนิ้วมือ หน่วยงาน
            //$count_leave1 = count($objResult2);


            $strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));



        }

        //นับวัน ลา
        $sqlleave = "SELECT SUM(leavetype_id = '1') as type1,SUM(leavetype_id = '2') as type2
                ,SUM(leavetype_id = '3') as type3,SUM(leavetype_id = '4') as type4,SUM(leavetype_id = '8') as type5,
                SUM(leavetype_id = '5') as type55,
                SUM(leavetype_id = '10') as type10,
                SUM(leavetype_id = '9') as type9,
                SUM(leavetype_id = '11') as type11,
                SUM(leavetype_id = '12') as type12,
                COUNT(leavetype_id) as sumleave
                FROM scan_leave 
                WHERE userid = '$badgenumber'
                AND date BETWEEN '$date_strat' AND '$date_end';";

        $count_leave1 = Yii::$app->db->createCommand($sqlleave)->queryAll();



        foreach ($count_leave1 as $r) {
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


            if(empty($type55)){
                $type55 = 0;
            }else{
                $type55 = $type55;
            }

            if(empty($type10)){
                $type10 = 0;
            }else{
                $type10 = $type10;
            }
            if(empty($type9)){
                $type9 = 0;
            }else{
                $type9 = $type9;
            }
            if(empty($type11)){
                $type11 = 0;
            }else{
                $type11 = $type11;
            }
            if(empty($type12)){
                $type12 = 0;
            }else{
                $type12 = $type12;
            }

            $sumleaveall = $r['sumleave'];
            $sumleave = $type1+$type2+$type3+$type4+$type5;

        }


        $testdate = $sumscandate;

        $sumscandate = $sumscandate - $sumscandateleave;

        $sumscandate = $intWorkDay - $sumscandate - $sumleaveall;

        $sumscandatedateleave = $count_daydate + $sumscandate;

        $sumscandatesum += $sumscandate;

    }




    $content .="<td style='font-size: 14px;'  align='center'>".$count_daydatepart."</td>"
        . "<td style='font-size: 14px;'  align='center'>".$sumscandatesum. "</td>"

        . "<td style='font-size: 14px;'  align='center'> ".$type1."</td>"
        . "<td style='font-size: 14px;'  align='center'>".$type2."</td>"
        . "<td style='font-size: 14px;'  align='center'> ".$type3."</td>"
        . "<td style='font-size: 14px;'  align='center'> ".$type4."</td>"
        . "<td style='font-size: 14px;'  align='center'> ".$type5."</td>"
        . "<td style='font-size: 14px;'  align='center'> ".$sumleave."</td>"
        ."</tr>";

    $sumscandatesum = 0;
    //$sumscandateall = $sumscandate1-$sumleave;
    //$count_daydatepartall +=$count_daydatepart;
    //$sumscandate1all +=$sumscandateall;

}



$content .="</tbody></table>";


$html = $header . $content;

$mpdf->WriteHTML($html);


//$mpdf = new mPDF('th', 'A4', '0', 'THSaraban');
//$mpdf->SetDisplayMode('fullpage');
//$mpdf->SetFooter(DateThai(date('Y-m-d')). '||แผ่นที่ {PAGENO}');
//$mpdf->WriteHTML($stylesheet, 1);
//$mpdf->setAutoBottomMargin;
$mpdf->Output();
exit();



?>
