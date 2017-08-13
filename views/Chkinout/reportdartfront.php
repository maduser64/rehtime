<?php
include_once '../mpdf/mpdf.php';

$mpdf = new mPDF('th', 'A4', '0', 'THSaraban');
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetFooter('ปริ้นเมื่อ ' . DateThaipint(date('Y-m-d H:i:s')) . '||แผ่นที่ {PAGENO}');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->setAutoBottomMargin;


function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;

    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("", "มกราคม.", "กุมภาพันธ์.", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

function DateThaipint($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;

    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("", "มกราคม.", "กุมภาพันธ์.", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute:$strSeconds น.";
}

function diff2time($time_a, $time_b)
{
    $now_time1 = strtotime(date("Y-m-d " . $time_a));
    $now_time2 = strtotime(date("Y-m-d " . $time_b));

    $time_diff = abs($now_time2 - $now_time1);
    $time_diff_h = floor($time_diff / 3600); // จำนวนชั่วโมงที่ต่างกัน
    $time_diff_m = floor(($time_diff % 3600) / 60); // จำวนวนนาทีที่ต่างกัน
    $time_diff_s = ($time_diff % 3600) % 60; // จำนวนวินาทีที่ต่างกัน
    //return $time_diff_h." ชั่วโมง ".$time_diff_m." นาที ".$time_diff_s." วินาที";


    if ($time_diff_h == 0) {
        return $time_diff_m . " น. ";
    } else {
        return $time_diff_h . " ชม. " . $time_diff_m . " น. ";
    }
}

function CheckPublicHoliday($strChkDate)
{

    $strSQL = "SELECT * FROM scan_holiday WHERE PublicHoliday = '" . $strChkDate . "' ";
    $objResult = Yii::$app->db->createCommand($strSQL)->queryAll();

    foreach ($objResult as $r) {

        $Descripiton = $r['Descripiton'];

        if (!$objResult) {
            return false;
        } else {
            return $Descripiton;
        }
    }

}

$date_time = date('Y-m-d');

//$mpdf->SetAutoFont();
function thainumDigit($num)
{
    return str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), array("o", "๑", "๒", "๓", "๔", "๕", "๖", "๗", "๘", "๙"), $num);
}

class hk_baht
{

    public $result;

    public function __construct($num)
    {
        $this->result = $this->toBaht($num, true);
    }

    public function toBaht($number)
    {
        if (!preg_match('/^([0-9]+)(\.[0-9]{0,4}){0,1}$/', $number = str_replace(',', '', $number), $m))
            return 'This is not currency format';
        $m[2] = count($m) == 3 ? intval(('0' . $m[2]) * 100 + 0.5) : 0;
        $st = $this->cv($m[2]);
        return $this->cv($m[1]) . 'บาท' . $st . ($st > '' ? 'สตางค์' : 'ถ้วน');
    }

    private function cv($num)
    {
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
                    $t .= $th_num[$n];
                }
                $t .= $th_digit[($digit == 0 && $x > 0 ? 6 : $digit)];
            } else {
                $t .= $th_digit[$digit == 0 && $x > 0 ? 6 : 0];
            }
        }
        return $t;
    }

}

function ThaiDate($time)
{
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
    $thai_date_return .= " " . date("j", $time);
    $thai_date_return .= " " . $thai_month_arr[date("n", $time)];
    $thai_date_return .= " " . (date("Yํ", $time) + 543);
    //$thai_date_return.=   "  ".date("H:i",$time)." น.";
    return $thai_date_return;
}


//=====================SQL==========================================
$sql = "SELECT * FROM scan_userinfo u
LEFT JOIN scan_department d ON u.defaultdepid=d.deptid
LEFT JOIN scan_intime i ON d.intime_id=i.intime_id
where u.defaultdepid='$userid';";
//=====================SQL==========================================

$rw1 = Yii::$app->db->createCommand($sql)->queryAll();
$countdeart = count($rw1);

foreach ($rw1 as $r) {
    $name = $r['name'];
    $deptname = $r['deptname'];
    $time_A = $r['time_A'];
    $time_B = $r['time_B'];
    $time_C = $r['time_C'];

}

$header = "<table width='100%' style='magin-top: -20px;' >"
    . "<tr>"
    . "<td width='100%' style='font-size: 16px;'  align='center'><b>" . "บัญชีเวลาปฏิบัติราชการข้าราชการ" . "</b></td>"
    . "</tr>"
    . "<tr>"
    . "<td width='100%' style='font-size: 16px;'  align='center'><b>" . "โรงพยาบาลร้อยเอ็ด  สำนักงานสาธารณสุขจังหวัดร้อยเอ็ด" . "</b></td>"
    . "</tr>"
    . "</table>";

$content = "<table width='100%'>"
    . "<tr>"
    . "<td width='100%' style='font-size: 14px;' align='center'>" . " แผนก  " . $deptname . "  " . $time . "   วันที่  " . DateThai($date_strat) . "  ถึงวันที่  " . DateThai($date_end) . "</td>"
    . "</tr>"
    . "<tr>"
// . "<td width='100%' style='font-size: 14px;' align='center'>" . "วันที่  ".DateThai($date_strat). "  ถึงวันที่  ".DateThai($date_end)."</td>"
    . "</tr>"
    . "</table>";

$content .= "<table width='100%' border='1' style='border-collapse: collapse; border: medium none'>"
    . "<thead>"
    . "<tr style='TEXT-ALIGN: center; BACKGROUND-COLOR: #e6e4e5;'>"
    . "<td style='font-size: 14px;' width='5%' align='left'  rowspan='2' >ลำดับ</td>"
    . "<td style='font-size: 14px;' width='20%' align='center' rowspan='2' >ชื่อ - สกุล</td>"

    . "<td style='font-size: 14px;' width='20%' align='center' colspan='2' ><b> มาสาย / ไม่แสกนลายนิ้วมือ</b></td>"

    . "<td style='font-size: 14px;' width='5%' align='center' rowspan='2' ><b>รวม</b></td>"

    . "<td style='font-size: 14px;' width='20%' align='center' colspan='6' ><b> ประเภทการลา</b></td>"

    . "<td style='font-size: 14px;' width='5%' align='center' rowspan='2' ><b>รวม</b></td>"
    . "</tr>"
    . "<tr style='TEXT-ALIGN: center; BACKGROUND-COLOR: #e6e4e5;'>"
    . "<td style='font-size: 14px;' width='8%' align='center'>มาสาย / ครั้ง</td>"
    . "<td style='font-size: 14px;' width='12%' align='center'>ไม่แสกนลาย / ครั้ง</td>"

    . "<td style='font-size: 14px;' width='8%' align='center'>ไปราชการ</td>"
    . "<td style='font-size: 14px;' width='10%' align='center'>ลากิจ</td>"
    . "<td style='font-size: 14px;' width='8%' align='center'>ลาพักผ่อน</td>"
    . "<td style='font-size: 14px;' width='10%' align='center'> ลาป่วย</td>"
    . "<td style='font-size: 14px;' width='10%' align='center'> OT เสริม</td>"
    . "<td style='font-size: 14px;' width='10%' align='center'>วันหยุด (วอร์ด)</td>"
    . "</tr>"
    . "</thead>"
    . "<tbody>";


$sqldart = "SELECT * FROM scan_userinfo u
LEFT JOIN scan_department d ON u.defaultdepid=d.deptid
LEFT JOIN scan_intime i ON d.intime_id=i.intime_id
where u.defaultdepid='$userid';";

$rwdart = Yii::$app->db->createCommand($sqldart)->queryAll();

$j = 0;
foreach ($rwdart as $r) {
    $name = $r['name'];
    $userid1 = $r['userid'];
    $badgenumber = $r['badgenumber'];
    $j++;

    $content .= "<tr>"
        . "<td style='font-size: 14px;'  align='left'>" . $j . "</td>"
        . "<td style='font-size: 14px;'  align='left'>" . $name . "</td>"
        . "<td style='font-size: 14px;'  align='center'>" . 0 . "</td>"

        //สูตรการคำนวณ ไม่แสกนลายนิ้วมือ คือ (วันทำงาน - วันที่แสกน) - (วันที่ลา - วันที่ลา)
        . "<td style='font-size: 14px;'  align='center'>" .
            \app\controllers\DateThaiController::BadgenumberScan($badgenumber, $date_strat, $date_end)


        . "</td>"

        . "<td style='font-size: 14px;'  align='center'>" . 0 . "</td>"


            . "<td style='font-size: 14px;'  align='center'>" . 0 . "</td>"
            . "<td style='font-size: 14px;'  align='center'>" . 0 . "</td>"
            . "<td style='font-size: 14px;'  align='center'>" . 0 . "</td>"
            . "<td style='font-size: 14px;'  align='center'>" . 0 . "</td>"
            . "<td style='font-size: 14px;'  align='center'>" . 0 . "</td>"
            . "<td style='font-size: 14px;'  align='center'>" . 0 . "</td>"
            . "<td style='font-size: 14px;'  align='center'>" . 0 . "</td>"
            . "</tr>";
}

$content .= "</tbody></table>";


$html = $header . $content;

$mpdf->WriteHTML($html);
$mpdf->Output();
exit();


?>
