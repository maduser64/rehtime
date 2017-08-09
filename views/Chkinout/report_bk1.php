<?php

function DateThai($strDate){
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

function DateThaipint($strDate){
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

    //=====================SQL==========================================
$sql = "SELECT * FROM scan_userinfo u
LEFT JOIN scan_department d ON u.defaultdepid=d.deptid
LEFT JOIN scan_intime i ON d.intime_id=i.intime_id
where u.badgenumber='$userid'; ";
    //=====================SQL==========================================

$rw1 = Yii::$app->db->createCommand($sql)->queryAll();

foreach ($rw1 as $r) {
   $name = $r['name'];
   $deptname = $r['deptname'];
   $time_A = $r['time_A'];
   $time_B = $r['time_B'];
   $time_C = $r['time_C'];

   if($time_A != '00:00:00'){
        $time = $time_A.' น. - '.$time_B.' น.';
    }else{
        $time ="จัดตารางเวร";
    }

}

$header = "<table width='100%' style='magin-top: -20px;' >"
. "<tr>"
. "<td width='100%' style='font-size: 16px;'  align='center'><b>" . "บัญชีเวลาปฏิบัติราชการข้าราชการ โรงพยาบาลร้อยเอ็ด". "</b></td>"
. "</tr>"
// . "<tr>"
// . "<td width='100%' style='font-size: 16px;'  align='center'><b>" . "โรงพยาบาลร้อยเอ็ด  สำนักงานสาธารณสุขจังหวัดร้อยเอ็ด". "</b></td>"
// . "</tr>"
. "</table>";

$content = "<table width='100%'>"
. "<tr>"
. "<td width='100%' style='font-size: 14px;' align='center'>" . "ชื่อ  ".$name."  แผนก  ".$deptname. "  เวลาทำงานปกติ  ".
$time. "   วันที่  ".DateThai($date_strat). "  ถึงวันที่  ".DateThai($date_end)."</td>"
. "</tr>"
. "<tr>"
// . "<td width='100%' style='font-size: 14px;' align='center'>" . "วันที่  ".DateThai($date_strat). "  ถึงวันที่  ".DateThai($date_end)."</td>"
. "</tr>"
. "</table>";


$content .= "<table width='100%' border='1' style='border-collapse: collapse; border: medium none'>"
. "<thead>"
. "<tr style='TEXT-ALIGN: center; BACKGROUND-COLOR: #e6e4e5;'>"
. "<td style='font-size: 14px;' width='5%' align='left'>ลำดับ</td>"
. "<td style='font-size: 14px;' width='15%' align='center'>วันที่</td>"
. "<td style='font-size: 14px;' width='10%' align='center'>เข้าเช้า (04:00-10:00 น.)</td>"
. "<td style='font-size: 14px;' width='10%' align='center'>ออกเช้า (15:00-23:00 น.) </td>"
. "<td style='font-size: 14px;' width='10%' align='center'>เข้าบ่าย (15:00-20:00 น.)</td>"
. "<td style='font-size: 14px;' width='10%' align='center'>ออกบ่าย (23:00-03:00 น.)</td>"
. "<td style='font-size: 14px;' width='10%' align='center'>เข้าดึก (23:00-03:00 น.)</td>"
. "<td style='font-size: 14px;' width='10%' align='center'>ออกดึก (06:00-10:00 น.)</td>"
. "<td style='font-size: 14px;' width='20%' align='center'>หมายเหตุ</td>"
. "</tr>"
. "</thead>"
. "<tbody>";


$strStartDate = $date_strat;
$strEndDate = $date_end;

$intWorkDay = 0;
$intHoliday = 0;
$intPublicHoliday = 0;
$Descripiton = 0;
$count_leave = 0;


$intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate)) /  ( 60 * 60 * 24 ))+1;


$i = 0;
while (strtotime($strStartDate) <= strtotime($strEndDate)){
    $i++;

    $DayOfWeek = date("w", strtotime($strStartDate));

    if($DayOfWeek == 0)  // 0 = Sunday, 6 = Saturday;
    {
        $intHoliday++;
        //$strStartDate = "<font color=red>Holiday</font><br>";

        $day = "วัน  อาทิตย์ ที่ ".DateThai($strStartDate);

        
           

    }elseif($DayOfWeek == 6){
        $intHoliday++;
        //$strStartDate = "<font color=red>Holiday</font><br>";

        $day = "วัน  เสาร์ ที่  ".DateThai($strStartDate);



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
        if($DayOfWeek == 1){
            $day = "วัน  จันทร์ ที่ ".DateThai($strStartDate);
        }elseif($DayOfWeek == 2){
            $day = "วัน  อังคาร ที่ ".DateThai($strStartDate);
        }elseif($DayOfWeek == 3){
            $day = "วัน  พุธ ที่ ".DateThai($strStartDate);       
        }elseif($DayOfWeek == 4){
            $day = "วัน  พฤหัส ที่ ".DateThai($strStartDate);
        }else{
            $day = "วัน  ศุกร์ ที่ ".DateThai($strStartDate);
        }
        
        //$strStartDate = "<b>Work Day</b><br>";
        //$day = DateThai($strStartDate)." วันทำงาน";

        //$scan = "";
    }

   // $strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));

    $content .= "<tr><td  style='font-size: 14px;' align='left'>".$i."</td>
    <td  style='font-size: 14px;' align='left'>".$day."</td>";


    $sqlleave = "SELECT leavetype_name,commend,l.leavetype_id as leavetype_id,commend1
                FROM scan_leave as l
                INNER JOIN scan_leavetype AS t
                ON l.leavetype_id = t.leavetype_id
                WHERE userid='$userid' 
                AND date = '$strStartDate';
                ";

    $rwleave = Yii::$app->db->createCommand($sqlleave)->queryAll();



    //เข้าเช้า
    $scan = "-";

    $date_new = date("Y-m-d 04:00:00", strtotime($strStartDate));
    $date_new1 = date("Y-m-d 10:00:00", strtotime($strStartDate));


    $sql = "SELECT ch.userid,ch.checktime,ch.checktype as checktype, SUBSTR(ch.checktime,-8,8) AS time,SUBSTR(ch.checktime,1,11) AS date
        FROM scan_chkinout ch
        WHERE ch.userid='$userid'
        AND checktype = '0'
        AND ch.checktime BETWEEN '$date_new' AND '$date_new1' ORDER BY time ASC LIMIT 1;";

    $rw = Yii::$app->db->createCommand($sql)->queryAll();


        foreach ($rw as $r) {
                $time = $r['time'];
                $checktype = $r['checktype'];
                $date = $r['date'];

                if(empty($time)){
                    $date = "-";
                }

                if ($time > '04:00:00' and $time < "10:00:00" and $checktype =='0') {

                    //เชคว่ามีการเชค เวลา ไว้หรือเปล่า ถ้าไม่มีจะไม่นำ ไปคำนวณ การเข้างาน
                    if(empty($time_A)){

                            if($time > $time_A){
                                $scan = substr($time, 0, 5);

                           }else{
                            $scan = substr($time, 0, 5);
                            } 
                    }
                    //เงิอนไข กรณี วอด ที่มีการจัดตารางเวร เข้าการเข้าเช้า

                    elseif($time_A == '00:00:00'){
                        
                        if($time > '08:15:00'){
                                //$scan = substr($time, 0, 5);
                                $scan = "<u>".substr($time, 0, 5)." / ". diff2time($time,'08:15:00')."</u>";
                           }else{
                                $scan = substr($time, 0, 5);
                        }

                    }else{

                        if($time > $time_C){
                               //$scan = substr($time, 0, 5)." เข้าเช้า ( สาย)";

                                $scan = "<u>".substr($time, 0, 5)." / ". diff2time($time,$time_C)."</u>";

                           }else{
                            $scan = substr($time, 0, 5);
                            }  
                        }

                }else{
                        $scan = "-";
                    }
                 
        }

    $content .= "<td  style='font-size: 14px;' align='left'>".$scan."</td>
    </tr>";


    //ออกเช้า
    $scan = "-";

    $date_new = date("Y-m-d 15:00:00", strtotime($strStartDate));
    $date_new1 = date("Y-m-d 23:00:00", strtotime($strStartDate));


    $sql2 = "SELECT ch.userid,ch.checktime,ch.checktype as checktype, SUBSTR(ch.checktime,-8,8) AS time,SUBSTR(ch.checktime,1,11) AS date
        FROM scan_chkinout ch
        WHERE ch.userid='$userid'
        AND checktype = '1'
        AND ch.checktime BETWEEN '$date_new' AND '$date_new1' ORDER BY time DESC LIMIT 1;";

        $rw2 = Yii::$app->db->createCommand($sql2)->queryAll();

        foreach ($rw2 as $r) {
                $time = $r['time'];
                $checktype = $r['checktype'];
                $date = $r['date'];

                if(empty($time)){
                    $date = "-";
                }

                if ($time > '15:00:00' and $time < "23:00:00" and $checktype =='1') {

                    //เชคว่ามีการเชค เวลา ไว้หรือเปล่า ถ้าไม่มีจะไม่นำ ไปคำนวณ การเข้างาน
                    if(empty($time_B)){
                            $scan = substr($time_B, 0, 5);
                            
                    }
                    //เงิอนไข กรณี วอด ที่มีการจัดตารางเวร เข้าการออกเช้า

                    elseif($time_B == '00:00:00'){
                        
                        if($time < '16:00:00'){
                                //$scan = substr($time, 0, 5);
                                $scan = "<u>".substr($time, 0, 5)." / ". diff2time($time,'16:00:00')."</u>";
                           }else{
                                $scan = substr($time, 0, 5);
                        }

                    }
                    else{
                            if($time < $time_B){
                                //$scan = substr($time, 0, 5)." เข้าเช้า ( สาย)";
                                //$scan = substr($time, 0, 5);
                                $scan = "<u>".substr($time, 0, 5)." / ". diff2timeout($time,$time_B)."</u>";

                            }else{
                                    $scan = substr($time, 0, 5);
                            }  
                    }
                     
                }else{
                    $scan = "-";
                }
    }

    $content .= "<td  style='font-size: 14px;' align='left'>".$scan."</td>
    </tr>";


    //เข้าบ่าย

    $date_new = date("Y-m-d 15:00:00", strtotime($strStartDate));
    $date_new1 = date("Y-m-d 20:00:00", strtotime($strStartDate));


    $sql3 = "SELECT ch.userid,ch.checktime,ch.checktype as checktype, SUBSTR(ch.checktime,-8,8) AS time,SUBSTR(ch.checktime,1,11) AS date
        FROM scan_chkinout ch
        WHERE ch.userid='$userid'
        AND checktype = '0'
        AND ch.checktime BETWEEN '$date_new' AND '$date_new1' ORDER BY time ASC LIMIT 1;";

    $rw3 = Yii::$app->db->createCommand($sql3)->queryAll();


    $scan = "-";

        $date_leave = date ("H:i:s", strtotime("+8 hour", strtotime($time_C)));

        $date_leave1 = date ("H:i:s", strtotime("+8 hour", strtotime('08:15:00')));

        foreach ($rw3 as $r) {
                $time = $r['time'];
                $checktype = $r['checktype'];
                $date = $r['date'];

                if(empty($time)){
                    $date = "-";
                }

                if ($time > '15:00:00' and $time < "20:00:00" and $checktype =='0') {
                    
                    //$scan = substr($time, 0, 5);

                    if(empty($time)){
                            $scan = substr($time, 0, 5);
                             
                    }
                    //เงิอนไข กรณี วอด ที่มีการจัดตารางเวร เข้าการเข้าบ่าย

                    elseif($time_A == '00:00:00'){
                        
                        if($time > $date_leave1){
                                //$scan = substr($time, 0, 5);
                                $scan = "<u>".substr($time, 0, 5)." / ". diff2time($time,$date_leave1)."</u>";
                           }else{
                                $scan = substr($time, 0, 5);
                        }

                    }

                    else{

                        if($time > $date_leave){
                               //$scan = substr($time, 0, 5)." เข้าเช้า ( สาย)";

                                $scan = "<u>".substr($time, 0, 5)." / ". diff2time($time,$date_leave)."</u>";

                        }else{
                            $scan = substr($date_leave, 0, 5);
                        }  
                    }
                      
                }else{
                    $scan = "-";
                }



                
        }

    $content .= "<td  style='font-size: 14px;' align='left'>".$scan."</td>
    </tr>";


    //ออกบ่าย

    $scan = "หยุดงาน";

    $date_new = date("Y-m-d 22:00:00", strtotime($strStartDate));
    $date_new1 = date("Y-m-d 03:00:00", strtotime("+1 day", strtotime($strStartDate)));


    $sql4 = "SELECT ch.userid,ch.checktime,ch.checktype as checktype, SUBSTR(ch.checktime,-8,8) AS time,SUBSTR(ch.checktime,1,11) AS date
        FROM scan_chkinout ch
        WHERE ch.userid='$userid'
        AND checktype = '1'
        AND ch.checktime BETWEEN '$date_new' AND '$date_new1' ORDER BY time DESC LIMIT 1;";

    $rw4 = Yii::$app->db->createCommand($sql4)->queryAll();

    $coutrw4 = count($rw4);


    if($coutrw4 == 0){
        $scan = "-";
    }else{
         foreach ($rw4 as $r) {
                $time = $r['time'];
                $checktype = $r['checktype'];
                $date1 = $r['date'];
                $checktime = $r['checktime'];

                $date_leave = date ("H:i:s", strtotime("+16 hour", strtotime($time_C)));


                if(empty($time)){
                    $scan = "-";
                }
                elseif($time_B == '00:00:00'){

                    if($time < '23:59:59'){
                        //$scan = substr($time, 0, 5);
                        $scan = substr($time, 0, 5);
                    }elseif($time > '00:00:00'){
                        $scan = substr($time, 0, 5);
                    }

                    else{
                            $scan = substr($time, 0, 5);
                        }

                }

                else{
                    $scan = substr($time, 0, 5);  
                }  
        }
    }
    

    
       

    $content .= "<td  style='font-size: 14px;' align='left'>".$scan."</td>
    </tr>";



    //เข้าดึก

    $scan = "-";


    //กำหนดช่วงเวลา 
    $date_new = date("Y-m-d 23:00:00", strtotime($strStartDate));
    $date_new1 = date("Y-m-d 03:00:00", strtotime("+1 day", strtotime($strStartDate)));


    $sql6 = "SELECT ch.userid,ch.checktime,ch.checktype as checktype, SUBSTR(ch.checktime,-8,8) AS time,SUBSTR(ch.checktime,1,11) AS date
            FROM scan_chkinout ch
            WHERE ch.userid='$userid'
            AND checktype = '0'
            AND ch.checktime BETWEEN '$date_new' AND '$date_new1' ORDER BY time ASC LIMIT 1;";

        $rw6 = Yii::$app->db->createCommand($sql6)->queryAll();

        foreach ($rw6 as $r) {
                $time = $r['time'];
                $checktype = $r['checktype'];
                $date = $r['date'];

                if(empty($time)){
                    $scan = "-";
                }else{
                    if($time_C != '00:00:00'){
                        $date_leave = date ("H:i:s", strtotime("+16 hour", strtotime($time_C)));
                    }else {
                        $date_leave = date ("H:i:s", strtotime("+16 hour", strtotime('08:15:00')));
                    }
                }
                    
                if(empty($time)){
                    $scan = "-";
                }
                 //เงิอนไข กรณี วอด ที่มีการจัดตารางเวร เข้าการเข้าบ่าย
                if(date(strtotime($date)) == date(strtotime($strStartDate))){
                    //$scan = substr($time, 0, 5);
                    $scan = substr($time, 0, 5);
                }else {
                    if($time > $date_leave){
                        $scan = "<u>".substr($time, 0, 5)." / ". diff2time($time,$date_leave)."</u>";
                    }else {
                        $scan = substr($time, 0, 5);
                    }
                    
                } 
        }

    $content .= "<td  style='font-size: 14px;' align='left'>".$scan."</td>
    </tr>";


    //ออกดึก

    $scan = "-";

     //กำหนดช่วงเวลา 
    $date_new = date("Y-m-d 06:00:00", strtotime($strStartDate));
    $date_new2 = date("Y-m-d 10:00:00", strtotime($strStartDate));
    //$date_new2 = date("Y-m-d 09:00:00", strtotime("+1 day", strtotime($strStartDate)));


    $sql7 = "SELECT ch.userid,ch.checktime,ch.checktype as checktype, SUBSTR(ch.checktime,-8,8) AS time,SUBSTR(ch.checktime,1,11) AS date
            FROM scan_chkinout ch
            WHERE ch.userid='$userid'
            AND checktype = '1'
            AND ch.checktime BETWEEN '$date_new' AND '$date_new2' ORDER BY time DESC LIMIT 1;";

    $rw7 = Yii::$app->db->createCommand($sql7)->queryAll();

    foreach ($rw7 as $r) {
        $time = $r['time'];
        $checktype = $r['checktype'];
        $date = $r['date'];

        if(empty($time)){
            $scan = "-";
        }else{
            $scan = $time;
        }

        //เชคว่ามีการเชค เวลา ไว้หรือเปล่า ถ้าไม่มีจะไม่นำ ไปคำนวณ การเข้างาน
        if(empty($time_B)){
                $scan = substr($time_B, 0, 5);
                
        }
        //เงิอนไข กรณี วอด ที่มีการจัดตารางเวร เข้าการออกเช้า

        elseif($time_B == '00:00:00'){
            
            if($time < '08:00:00'){
                    //$scan = substr($time, 0, 5);
                    $scan = "<u>".substr($time, 0, 5)." / ". diff2time($time,'08:00:00')."</u>";
               }else{
                    $scan = substr($time, 0, 5);
            }

        }

        else{
                if($time < $time_B){
                    //$scan = substr($time, 0, 5)." เข้าเช้า ( สาย)";
                    //$scan = substr($time, 0, 5);
                    $scan = "<u>".substr($time, 0, 5)." / ". diff2timeout($time,$time_B)."</u>";

                }else{
                        $scan = substr($time, 0, 5);
                }  
        }
         
    



    }

    $content .= "<td  style='font-size: 14px;' align='left'>".$scan."</td>
    </tr>";


    $type = "-";

    foreach ($rwleave as $r) {
            $type = $r['leavetype_name'];
            $commend = $r['commend'];
            $commend1 = $r['commend1'];
            $leavetype_id = $r['leavetype_id'];


            if(empty($type)){
                $type = "-";
            }elseif($leavetype_id == 8){
                $type = $type.' <font color=\'red\'># สาเหตุ '.$commend.'</font>';
            }elseif($leavetype_id == 12){
                $type = $type.' <font color=\'red\'># สาเหตุ '.$commend1.'</font>';
            }else{
                $type = $type;
            }


    }
    $content .= "<td  style='font-size: 14px;' align='left'>".$type."</td>
    </tr>";


    //เชคการมาทำงานสายของ บุคคล

        $strSQL1 = "SELECT DISTINCT SUBSTR(ch.checktime,1,11) AS date
        FROM scan_chkinout ch
        WHERE ch.userid='$userid'
        AND DATE_FORMAT(ch.checktime,'%Y-%m-%d') BETWEEN '$date_strat' AND '$date_end';
        ";

        $objResult1 = Yii::$app->db->createCommand($strSQL1)->queryAll();

        //นับจำนวนวันที่แสกนลายนิ้วมือ
        $count_leave = count($objResult1);



    
    $strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));

}

$content .="</tbody></table>";


$date_new = date("Y-m-d 04:00:00", strtotime($date_strat));
$date_new2 = date("Y-m-d 09:00:00", strtotime($date_end));


//ตัดช่วงเวลามาทำงานสาย
$sql8 = "SELECT ch.userid,ch.checktime,ch.checktype as checktype, SUBSTR(ch.checktime,-8,8) AS time,SUBSTR(ch.checktime,1,11) AS date
        FROM scan_chkinout ch
        WHERE ch.userid='$userid'
        AND ch.checktype = '0' ";

        if($time_C == '00:00:00'){
            $sql8 .= " AND SUBSTR(ch.checktime,-8,8) > '08:15:00' ";

        }else{
            $sql8 .= " AND SUBSTR(ch.checktime,-8,8) > '$time_C' ";
        }
        
        $sql8 .= " AND SUBSTR(ch.checktime,-8,8) < '10:00:00'
                AND ch.checktime BETWEEN '$date_new' AND '$date_new2'; ";


$count_day = Yii::$app->db->createCommand($sql8)->queryAll();

$count_daydate = count($count_day);


$noscan = 0;

//แสกน >  วันทำงาน

if($count_leave > $intWorkDay){

    //แสกนนิ้วเกินจากวันทำงาน
    $noscan = $count_leave - $intWorkDay;

    //จำนวนวันรวม ที่ไม่มีการแสกนนิ้วมือ
    $sumscandate = ($intWorkDay - $noscan) - ($intWorkDay - $noscan);

//แสกน < วันทำงาน 
}if($count_leave < $intWorkDay){

}else{

    //แสกนนิ้วไม่พอ
    $noscan = $intWorkDay - ($intWorkDay - $noscan);

    //จำนวนวันรวม ที่ไม่มีการแสกนนิ้วมือ
    $sumscandate = $intWorkDay - ($count_leave - $noscan);
}


//นับวัน ลา
$sqlleavesum = "SELECT SUM(leavetype_id = '1') as type1,SUM(leavetype_id = '2') as type2
                ,SUM(leavetype_id = '3') as type3,SUM(leavetype_id = '4') as type4,
                SUM(leavetype_id = '8') as type5,
                COUNT(leavetype_id) as sumleave
                FROM scan_leave 
                WHERE userid = '$userid'
                AND leavetype_id != '5'
                AND leavetype_id != '10' 
                AND date BETWEEN '$date_strat' AND '$date_end';";
$count_leavesum = Yii::$app->db->createCommand($sqlleavesum)->queryAll();
foreach ($count_leavesum as $r) {
    $sumleave = $r['sumleave'];
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
                WHERE userid = '$userid'
                AND date BETWEEN '$date_strat' AND '$date_end';";
    $count_leave = Yii::$app->db->createCommand($sqlleave)->queryAll();

    

    foreach ($count_leave as $r) {
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




$content .= "<table width='100%'>
<tr>
<td style='font-size: 16px;' align='left' colspan='2'><b>" . "วันทั้งหมด  ".$intTotalDay."  วัน   วันทำงาน  ".$intWorkDay. "  วัน   วันหยุดงาน  ".$intHoliday."  วัน</b><b> วันหยุดนักขัตฤกษ์  ".$intPublicHoliday." วัน</b><b> รวมวันหยุดทั้งหมด ".($intHoliday+$intPublicHoliday)." วัน </b></td>
     <td style='font-size: 16px;' align='right' colspan='5'>สรุป มาสาย ".$count_daydate." ครั้ง ไม่แสกนลายนิ้วมือ ".($sumscandate - $sumleave) ."  ครั้ง ลงชื่อ ......................................................................( หัวหน้าแผนก )</td>"
. "</tr>

</table>";


$html = $header . $content;

include_once '../mpdf/mpdf.php';

$mpdf = new mPDF('th', 'A4-L', '0', 'THSaraban','5','5','2','1');
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetFooter('ปริ้นเมื่อ ' .DateThaipint(date('Y-m-d H:i:s')).'||แผ่นที่ {PAGENO}');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->setAutoBottomMargin;
$mpdf->WriteHTML($html);
$mpdf->Output();
exit();
?>


