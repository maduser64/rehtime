<?php
ini_set('max_execution_time', 1000); //300 seconds = 5 minutes
//echo '1';
//print_r($model_report);
$date_time = date('d-m-Y   H:i:s');


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
        

$header = "<table width='100%'>"
        . "<tr>"
        . "<td width='100%' style='font-size: 30px;' colspan='2' align='center'><b>" . "รายการใบเบิกรายการผ้า". "</b></td>"
        . "</tr>"
        . "</table>";

// จัดชุดแยกประเภท
$sql = "SELECT
            m.*, d.name
        FROM
            washing_order_member AS m
        LEFT JOIN sso_depart AS d 
        ON m.dep_id = d. CODE
        WHERE
            m.order_no = '$id';";


$rw = Yii::$app->db->createCommand($sql)->queryAll();

foreach ($rw as $r) {
    $order_no = $r['order_no'];
    $order_date = $r['order_date'];
    $dept_name = $r['name'];
    $member_cost = $r['member_cost'];
    if(empty($member_cost)){
        $title = ".................................................";
    }else{
        $sql = "SELECT
            m.*, d. NAME,u.title,u.firstname,u.surname
        FROM
            washing_order_member AS m
        LEFT JOIN sso_depart AS d 
        ON m.dep_id = d. CODE
        LEFT JOIN sso_user AS u
        ON m.member_cost = u.id
        WHERE
            m.order_no = '$id';";


        $rw2 = Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rw2 as $r) {
            $title1 = $r['title'];
            $firstname = $r['firstname'];
            $surname = $r['surname'];
        }

        $title = $title1.$firstname."&nbsp;&nbsp;".$surname;

    }
    
    
//-SQL-////////////////////////////////////////////////////////////////////////////////////////////////////

    $sql_detailshare = "SELECT
                            m.*,
                            i.item_desc
                        FROM
                            washing_order_member_detail AS m
                        INNER JOIN washing_item_new AS i 
                        ON m.item_id = i.item_id
                        WHERE
                            m.order_no = '$id';";
                
    
    $sqltotalsum = "SELECT
            SUM(s.qty) AS total_number,
            SUM(s.price * s.qty) AS total_money
        FROM
            washing_order_member_detail AS s
        WHERE
            s.order_no = '$id';

    ";


//-SQL-////////////////////////////////////////////////////////////////////////////////////////////////////
//$content .= "sql" . $sql;
    
     $rw2 = Yii::$app->db->createCommand($sql_detailshare)->queryAll();

     $rw3 = Yii::$app->db->createCommand($sqltotalsum)->queryAll();

    if (!empty($rw)) {
        $content = "<table width='100%'>"
                . "<tr>"
                . "<td width='100%' style='font-size: 20px;' align='right'><b>เลขที่ใบเบิก : </b>" . $order_no."</td>"
                . "</tr>"
                . "<tr>"
                . "<tr>"
                . "<td width='100%' style='font-size: 20px;' align='right'><b>วันที่เบิก : </b>" . DateThai($order_date)."</td>"
                . "</tr>"
                . "<tr>"
                . "<td width='100%' style='font-size: 20px;' align='right'><b>หน่วยงาน : </b>" . $dept_name."</td>"
                . "</tr>"
                . "</table>";


                if (!empty($rw)) {
                    $content .= " 
                    <table width='100%' border='1' style='border-collapse: collapse; border: medium none'>
                    <thead>
                        <tr style='TEXT-ALIGN: center; BACKGROUND-COLOR: #e6e4e5;' >
                          <td width='5%' style='font-size: 18px;' align='center'><b>ลำดับ</td>
                          <td width='50%' style='font-size: 18px' align='center'><b>รายการ</td>
                          <td width='10%' style='font-size: 18px;' align='center'><b>ราคา</td>
                          <td width='20%' style='font-size: 18px;' align='center'><b>จำนวน</td>
                          <td width='15%' style='font-size: 18px;' align='center'><b>รวม</td>          
                        </tr>
                    </thead>
                    <tbody>";

                    $i = 0;
                    foreach ($rw2 as $report) {
                        $share_number = $report['qty'];
                        $share_money = $report['price'];
                        $item = $report['item_desc'];
                        $share_total = $share_number * $share_money;

                        $i++;

                        $content .="<tr>
                            <td height='24' style='font-size: 18px;'>" . $i . "</td>
                            <td  height='24' style='font-size: 18px;'>" . $item . "</td>
                            <td  height='24' style='font-size: 18px;' align='right'>" . $share_money . "</td>
                            <td  height='24' style='font-size: 18px;' align='right'>" . $share_number . "</td>
                            <td  height='24' style='font-size: 18px;' align='right'>" . number_format($share_total, 2, '.', ',') . "</td>                                  
                        </tr>";
                    }
                }
        
        
        

        foreach ($rw3 as $total) {

            $total_number = $total['total_number'];
            $total_money = $total['total_money'];

            $content .= 
                        "<tr>
                                <td colspan='4' align='right' style='font-size: 18px;'><b> รวม </b></td>
                               
                            <td align='right' style='font-size: 18px;'><b> " .
                            number_format($total_money, 2, '.', ',') . "</b></td>

                                </tr>";
        }


        $sqlname = " ";
        
        $content .="<tr>
                <td width='100%' style='font-size:20px;' colspan='5'>
                    <b>
                    ลงชื่อเพื่อยืนยันรายการใบเบิกรายการผ้า<br>
                    </b></td>
             </tr>
             <tr width='100%'>
                <td width='50%' style='font-size:20px;' colspan='2' align='center'>ลงชื่อ ........................................................................ ผู้รับ"."<br>"." ( ......................................................................................)"
                    ."<br>"."วันที่...................../.........................../...............................
                 </td>
                <td width='50%' style='font-size:20px;' colspan='3' align='center'>ลงชื่อ ................................................................ ผู้ส่ง"."<br>"."  ( .................................................................................... )"
                    ."<br>"."วันที่...................../.........................../...............................</td>

             </tr>
             <tr width='100%'>
                
                <td width='50%' style='font-size:20px;' colspan='5' align='right'>ลงชื่อ ................................................................ ผู้อนุมัติ"."<br>"."  
                    ( .................".$title."................. )"
                    ."<br>"."วันที่...................../.........................../...............................</td>

             </tr>";
        
        $content .= "
        </tbody>
    </table>";
    }
}


//echo '' . $header . $content;
$date_print = 'พิมพ์วันที่ ' . DateThai($date_time);

$html = $header . $content;

include_once '../mpdf/mpdf.php';

$mpdf = new mPDF('th', 'A4', '0', 'THsaraban');
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetFooter($date_print . '||แผ่นที่ {PAGENO}');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit();

?>