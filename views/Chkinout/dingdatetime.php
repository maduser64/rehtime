<?php
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

strStartDate = $date_strat;
$strEndDate = $date_end;

$intWorkDay = 0;
$intHoliday = 0;
$intPublicHoliday = 0;
$intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate)) /  ( 60 * 60 * 24 ))+1;


$i = 0;
while (strtotime($strStartDate) <= strtotime($strEndDate)){
    $i++;
    $DayOfWeek = date("w", strtotime($strStartDate));

    if($DayOfWeek == 0)  // 0 = Sunday, 6 = Saturday;
    {
        $intHoliday++;
        $day = "วัน  อาทิตย์ ที่ ".DateThai($strStartDate);
            
    }elseif($DayOfWeek == 6){
        $intHoliday++;

        $day = "วัน  เสาร์ ที่  ".DateThai($strStartDate);

    }elseif(CheckPublicHoliday($strStartDate)){
            $intPublicHoliday++;
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
    }
?>