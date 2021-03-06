<?php

namespace app\controllers;

use Yii;
//use yii\web\Controller;
use yii\console\Controller;

class DateThaiController extends Controller
{
    public static function DateThai($strDate)
    {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strYear = substr($strYear, -2);
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
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

    public static function Depart($depart, $date_strat, $date_end, $time_C)
    {
        $sqldart = "SELECT * FROM scan_userinfo u
        LEFT JOIN scan_department d ON u.defaultdepid=d.deptid
        LEFT JOIN scan_intime i ON d.intime_id=i.intime_id
        where u.defaultdepid='$depart';";

        $rwdart = Yii::$app->db->createCommand($sqldart)->queryAll();

        $date_new = date("Y-m-d 04:00:00", strtotime($date_strat));
        $date_new2 = date("Y-m-d 10:00:00", strtotime($date_end));

        foreach ($rwdart as $r) {

            $badgenumber = $r['badgenumber'];

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

            $count_daydateall += $count_daydate;


        }

        return $count_daydateall;
    }


    public static function Donotscan($deptid, $date_strat, $date_end)
    {

        $sql = "SELECT DISTINCT
            SUBSTR(checktime, 1, 11) AS date,
            c.userid
        FROM
            scan_chkinout AS c
        INNER JOIN scan_userinfo AS u
        ON c.userid = u.badgenumber
        WHERE
            u.defaultdepid = '$deptid'
        AND DATE_FORMAT(c.checktime, '%Y-%m-%d') BETWEEN  '$date_strat' AND '$date_end';";


        $rwdart = Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rwdart as $r){

            $dateof = $r['date'];



            $DayOfWeek = date("w", strtotime($dateof));
            if($DayOfWeek == 0 or $DayOfWeek == 6){
                $dateof = $date_strat;
                $ofweek++;
            }

        }


        $cout = count($rwdart);

        $sumwork = $cout - $ofweek;

        return $sumwork;


    }


    public static function Departforn($depart, $date_strat, $date_end)
    {

        $sqldart = "SELECT * FROM scan_userinfo u
        LEFT JOIN scan_department d ON u.defaultdepid=d.deptid
        LEFT JOIN scan_intime i ON d.intime_id=i.intime_id
        where u.defaultdepid='$depart';";



        $rwdart = Yii::$app->db->createCommand($sqldart)->queryAll();


        $date_new = date("Y-m-d 07:00:00", strtotime($date_strat));
        $date_new2 = date("Y-m-d 10:00:00", strtotime($date_end));

        foreach ($rwdart as $r) {

            $badgenumber = $r['badgenumber'];

            //นับวันมาสาย
            //ตัดช่วงเวลามาทำงานสาย เช้า
            $sql8 = "SELECT ch.userid,ch.checktime,ch.checktype as checktype, SUBSTR(ch.checktime,-8,8) AS time,SUBSTR(ch.checktime,1,11) AS date
            FROM scan_chkinout ch
            WHERE ch.userid='$badgenumber'
            AND ch.checktype = '0' 
            AND SUBSTR(ch.checktime,-8,8) > '08:15:59' 
            AND SUBSTR(ch.checktime,-8,8) < '10:00:00'
            AND ch.checktime BETWEEN '$date_new' AND '$date_new2'; ";


            $count_day = Yii::$app->db->createCommand($sql8)->queryAll();

            $count_daydate = count($count_day);


            $date_newnoon = date("Y-m-d 15:00:00", strtotime($date_strat));
            $date_new2noon = date("Y-m-d 20:00:00", strtotime($date_end));

            //ตัดช่วงเวลามาทำงานสาย บ่าย
            $sql8noon = "SELECT DISTINCT SUBSTR(ch.checktime,1,11) AS date
            FROM scan_chkinout ch
            WHERE ch.userid='$badgenumber'
            AND ch.checktype = '0'
            AND SUBSTR(ch.checktime,-8,8) > '16:15:59' 
            AND SUBSTR(ch.checktime,-8,8) < '20:00:00'
            AND ch.checktime BETWEEN '$date_newnoon' AND '$date_new2noon'; ";


            $count_daynoon = Yii::$app->db->createCommand($sql8noon)->queryAll();

            $count_daydatenoon = count($count_daynoon);


            //กำหนดช่วงเวลา
            $date_newlate = date("Y-m-d 23:00:00", strtotime($strStartDate));
            $date_new1late = date("Y-m-d 03:00:00", strtotime("+1 day", strtotime($strStartDate)));

            $sql6 = "SELECT ch.userid,ch.checktime,ch.checktype as checktype, SUBSTR(ch.checktime,-8,8) AS time,SUBSTR(ch.checktime,1,11) AS date
            FROM scan_chkinout ch
            WHERE ch.userid='$badgenumber'
            AND checktype = '0'
            AND ch.checktime BETWEEN '$date_newlate' AND '$date_new1late' ORDER BY time ASC LIMIT 1;";

            $rw6 = Yii::$app->db->createCommand($sql6)->queryAll();

            $count_daydatelate = count($rw6);

            $count_daydateall += $count_daydate+$count_daydatenoon+$count_daydatelate;


            //$count_daydateall += $count_daydate;


        }

        return $count_daydateall;
    }


    public static function Donotscanforn($deptid, $date_strat, $date_end)
    {

        $sql = "SELECT DISTINCT
            SUBSTR(checktime, 1, 11) AS date,
            c.userid
        FROM
            scan_chkinout AS c
        INNER JOIN scan_userinfo AS u
        ON c.userid = u.badgenumber
        WHERE
            u.defaultdepid = '$deptid'
        AND DATE_FORMAT(c.checktime, '%Y-%m-%d') BETWEEN  '$date_strat' AND '$date_end';";

        $rwdart = Yii::$app->db->createCommand($sql)->queryAll();

        
        $cout = count($rwdart);

        $sumwork = $cout;


        return $sumwork;

    }



}

?>