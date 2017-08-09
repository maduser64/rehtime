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
    . "<td width='100%' style='font-size: 14px;' align='center'>  เวลาทำงาน จัดตารางเวร  " . "วันที่  " . DateThai($date_strat) . "  ถึงวันที่  " . DateThai($date_end) . "</td>"
    . "</tr>"
    . "<tr>"
// . "<td width='100%' style='font-size: 14px;' align='center'>" . "วันที่  ".DateThai($date_strat). "  ถึงวันที่  ".DateThai($date_end)."</td>"
    . "</tr>"
    . "</table>";

$content .= "<table width='100%' border='1' style='border-collapse: collapse; border: medium none'>"
    . "<thead>"
    . "<tr style='TEXT-ALIGN: center; BACKGROUND-COLOR: #e6e4e5;'>"
    . "<td style='font-size: 14px;' width='5%' align='left'>ลำดับ</td>"

    . "<td style='font-size: 14px;' width='25%' align='center' >ชื่อ นามสกุล </td>"

    . "<td style='font-size: 14px;' width='25%' align='center' >แผนก / หน่วยงาน </td>"

    . "<td style='font-size: 14px;' width='15%' align='center'  ><b>มาสาย</b></td>"
    . "</tr></thead>"
    . "<tbody>";


//นับไม่แสกนลายนิ้วมือ
$date_new = date("Y-m-d 04:00:00", strtotime($date_strat));
$date_new2 = date("Y-m-d 10:00:00", strtotime($date_end));

$sql = "SELECT
            ch.userid,
            i.time_C AS timec,
            u.`name` AS nameuser,
            d.deptname AS deptname,
            COUNT(ch.userid) AS cout
        FROM
            scan_chkinout ch
        INNER JOIN scan_userinfo AS u ON ch.userid = u.badgenumber
        INNER JOIN scan_department AS d ON u.defaultdepid = d.deptid
        LEFT JOIN scan_intime i ON d.intime_id = i.intime_id
        
        WHERE
            ch.checktype = '0'
        AND i.intime_id = 4
        AND SUBSTR(ch.checktime,-8,8) > '08:15:00'
        AND SUBSTR(ch.checktime,-8,8) < '10:00:00'
        AND ch.checktime BETWEEN '$date_new'
        AND '$date_new2'
        GROUP BY
            userid
        ORDER BY
            cout DESC;";

$rwdart = Yii::$app->db->createCommand($sql)->queryAll();

$i = 1;

foreach ($rwdart as $r) {
    $name = $r['nameuser'];
    $deptname = $r['deptname'];
    $cout = $r['cout'];


    $content .= "<tr>"
        . "<td style='font-size: 14px;'  align='left'>" . $i++ . "</td>"
        . "<td style='font-size: 14px;'  align='left'>" . $name . "</td>"
        . "<td style='font-size: 14px;'  align='left'>" . $deptname . "</td>"
        . "<td style='font-size: 14px;'   align='center'>" . $cout . "</td>";

    $coutall += $cout;
}

$content .= "<tr>
        <td style='font-size: 14px;' align='right' colspan='3'><b>รวม </b></td>
        <td style='font-size: 14px;' align='center'>  " . number_format($coutall, 0) . " </td>
 </tr>";


$content .= "</tr></tbody></table>";
$html = $header . $content;
$mpdf->WriteHTML($html);
$mpdf->Output();
exit();


?>
