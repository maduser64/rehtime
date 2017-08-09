<?php
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */

$this->title = 'ระบบบริการผ้า (Washing)';
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
    return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute";
}

?>

<meta http-equiv="refresh" content="10">
<div class="panel-body">

    <div class="body-content">
      <i class="fa fa-sitemap" aria-hidden="true"></i><b> กราฟแสดงข้อมูลการลา</b>
        <hr>
        <?php
                    $time = date('Y');
                    $strYear = $time + 543;

                    //ไปราชการ
                    $sql = "SELECT date, SUBSTR(date,1,4) as TAHUN , SUBSTR(date,6,2) as BULAN,COUNT( * ) AS JUMLAH
                          FROM scan_leave 
                          WHERE SUBSTR(date,1,4)='$time'
                          AND leavetype_id = '1'
                          GROUP BY BULAN;";
                    
                    $data = Yii::$app->db->createCommand($sql)->queryAll();


                    //ลากิจ
                    $sql1 = "SELECT date, SUBSTR(date,1,4) as TAHUN , SUBSTR(date,6,2) as BULAN,COUNT( * ) AS JUMLAH
                          FROM scan_leave 
                          WHERE SUBSTR(date,1,4)='$time'
                          AND leavetype_id = '2'
                          GROUP BY BULAN;";
                    
                    $data1 = Yii::$app->db->createCommand($sql1)->queryAll();

                    //ลาพักผ่อน
                    $sql3 = "SELECT date, SUBSTR(date,1,4) as TAHUN , SUBSTR(date,6,2) as BULAN,COUNT( * ) AS JUMLAH
                          FROM scan_leave 
                          WHERE SUBSTR(date,1,4)='$time'
                          AND leavetype_id = '3'
                          GROUP BY BULAN;";
                    
                    $data3 = Yii::$app->db->createCommand($sql3)->queryAll();

                    //ลาป่วย
                    $sql4 = "SELECT date, SUBSTR(date,1,4) as TAHUN , SUBSTR(date,6,2) as BULAN,COUNT( * ) AS JUMLAH
                          FROM scan_leave 
                          WHERE SUBSTR(date,1,4)='$time'
                          AND leavetype_id = '4'
                          GROUP BY BULAN;";
                    
                    $data4 = Yii::$app->db->createCommand($sql4)->queryAll();

                    //ลาคลอด
                    $sql5 = "SELECT date, SUBSTR(date,1,4) as TAHUN , SUBSTR(date,6,2) as BULAN,COUNT( * ) AS JUMLAH
                          FROM scan_leave 
                          WHERE SUBSTR(date,1,4)='$time'
                          AND leavetype_id = '5'
                          GROUP BY BULAN;";
                    
                    $data5 = Yii::$app->db->createCommand($sql5)->queryAll();




                    $num1 = "";
                    $num2 = "";
                    $num3 = "";
                    $num4 = "";
                    $num5 = "";
                    $num6 = "";
                    $num7 = "";
                    $num8 = "";
                    $num9 = "";
                    $num10 = "";
                    $num11 = "";
                    $num12 = "";


                    $nm1 = "";
                    $nm2 = "";
                    $nm3 = "";
                    $nm4 = "";
                    $nm5 = "";
                    $nm6 = "";
                    $nm7 = "";
                    $nm8 = "";
                    $nm9 = "";
                    $nm10 = "";
                    $nm11 = "";
                    $nm12 = "";

                    $nm31 = "";
                    $nm32 = "";
                    $nm33 = "";
                    $nm34 = "";
                    $nm35 = "";
                    $nm36 = "";
                    $nm37 = "";
                    $nm38 = "";
                    $nm39 = "";
                    $nm310 = "";
                    $nm311 = "";
                    $nm312 = "";

                    $nm41 = "";
                    $nm42 = "";
                    $nm43 = "";
                    $nm44 = "";
                    $nm45 = "";
                    $nm46 = "";
                    $nm47 = "";
                    $nm48 = "";
                    $nm49 = "";
                    $nm410 = "";
                    $nm411 = "";
                    $nm412 = "";


                     $nm51 = "";
                    $nm52 = "";
                    $nm53 = "";
                    $nm54 = "";
                    $nm55 = "";
                    $nm56 = "";
                    $nm57 = "";
                    $nm58 = "";
                    $nm59 = "";
                    $nm510 = "";
                    $nm511 = "";
                    $nm512 = "";

                    foreach ($data as $r) {
                       
                        $month = $r['BULAN'];
                        $count = $r['JUMLAH'];
                        
                        if ($month == 1) {
                            $num1 = intval($count);
                        } else if ($month == 2) {
                            $num2 = intval($count);
                        } else if ($month == 3) {
                            $num3 = intval($count);
                        } else if ($month == 4) {
                            $num4 = intval($count);
                        } else if ($month == 5) {
                            $num5 = intval($count);
                        } else if ($month == 6) {
                            $num6 = intval($count);
                        } else if ($month == 7) {
                            $num7 = intval($count);
                        } else if ($month == 8) {
                            $num8 = intval($count);
                        } else if ($month == 9) {
                            $num9 = intval($count);
                        } else if ($month == 10) {
                            $num10 = intval($count);
                        } else if ($month == 11) {
                            $num11 = intval($count);
                        } else if ($month == 12) {
                            $num12 = intval($count);
                        }
                       
                    }


                    foreach ($data1 as $r) {
                        $month = $r['BULAN'];
                        $count = $r['JUMLAH'];
                        
                        if ($month == 1) {
                            $nm1 = intval($count);
                        } else if ($month == 2) {
                            $nm2 = intval($count);
                        } else if ($month == 3) {
                            $nm3 = intval($count);
                        } else if ($month == 4) {
                            $nm4 = intval($count);
                        } else if ($month == 5) {
                            $nm5 = intval($count);
                        } else if ($month == 6) {
                            $nm6 = intval($count);
                        } else if ($month == 7) {
                            $nm7 = intval($count);
                        } else if ($month == 8) {
                            $nm8 = intval($count);
                        } else if ($month == 9) {
                            $nm9 = intval($count);
                        } else if ($month == 10) {
                            $nm10 = intval($count);
                        } else if ($month == 11) {
                            $nm11 = intval($count);
                        } else if ($month == 12) {
                            $nm12 = intval($count);
                        }
                       
                    }


                    foreach ($data3 as $r) {
                        $month = $r['BULAN'];
                        $count = $r['JUMLAH'];
                        
                        if ($month == 1) {
                            $nm31 = intval($count);
                        } else if ($month == 2) {
                            $nm32 = intval($count);
                        } else if ($month == 3) {
                            $nm33 = intval($count);
                        } else if ($month == 4) {
                            $nm34 = intval($count);
                        } else if ($month == 5) {
                            $nm35 = intval($count);
                        } else if ($month == 6) {
                            $nm36 = intval($count);
                        } else if ($month == 7) {
                            $nm37 = intval($count);
                        } else if ($month == 8) {
                            $nm38 = intval($count);
                        } else if ($month == 9) {
                            $nm39 = intval($count);
                        } else if ($month == 10) {
                            $nm110 = intval($count);
                        } else if ($month == 11) {
                            $nm111 = intval($count);
                        } else if ($month == 12) {
                            $nm112 = intval($count);
                        }
                       
                    }

                    foreach ($data4 as $r) {
                        $month = $r['BULAN'];
                        $count = $r['JUMLAH'];
                        
                        if ($month == 1) {
                            $nm41 = intval($count);
                        } else if ($month == 2) {
                            $nm42 = intval($count);
                        } else if ($month == 3) {
                            $nm43 = intval($count);
                        } else if ($month == 4) {
                            $nm44 = intval($count);
                        } else if ($month == 5) {
                            $nm45 = intval($count);
                        } else if ($month == 6) {
                            $nm46 = intval($count);
                        } else if ($month == 7) {
                            $nm47 = intval($count);
                        } else if ($month == 8) {
                            $nm48 = intval($count);
                        } else if ($month == 9) {
                            $nm49 = intval($count);
                        } else if ($month == 10) {
                            $nm410 = intval($count);
                        } else if ($month == 11) {
                            $nm411 = intval($count);
                        } else if ($month == 12) {
                            $nm412 = intval($count);
                        }
                       
                    }

                    foreach ($data5 as $r) {
                        $month = $r['BULAN'];
                        $count = $r['JUMLAH'];
                        
                        if ($month == 1) {
                            $nm51 = intval($count);
                        } else if ($month == 2) {
                            $nm52 = intval($count);
                        } else if ($month == 3) {
                            $nm53 = intval($count);
                        } else if ($month == 4) {
                            $nm54 = intval($count);
                        } else if ($month == 5) {
                            $nm55 = intval($count);
                        } else if ($month == 6) {
                            $nm56 = intval($count);
                        } else if ($month == 7) {
                            $nm57 = intval($count);
                        } else if ($month == 8) {
                            $nm58 = intval($count);
                        } else if ($month == 9) {
                            $nm59 = intval($count);
                        } else if ($month == 10) {
                            $nm510 = intval($count);
                        } else if ($month == 11) {
                            $nm511 = intval($count);
                        } else if ($month == 12) {
                            $nm512 = intval($count);
                        }
                       
                    }
          ?>

        <?php 
            // on your view
            echo
                    Highcharts::widget([
                        //ตัวส่งข้อมูล ออก
                        'scripts' => [
                                'modules/exporting',
                                'themes/grid-light',
                            ],
                        'options' => [
                            //เป็นเส้น 
                            // 'chart' => [
                            //     'type' => 'column'
                            // ],
                            'chart' => [
                                'type' => 'column'
                            ],
                            'title' => [
                                'text' => 'กราฟแสดงข้อมูลการลา รายเดือน ปี พ.ศ. ' . $strYear
                            ],
                            'xAxis' => [
                                'categories' => [
                                    "มกราคม",
                                    "กุมภาพันธ์",
                                    "มีนาคม",
                                    "เมษายน",
                                    "พฤษภาคม",
                                    "มิถุนายน",
                                    "กรกฎาคม",
                                    "สิงหาคม",
                                    "กันยายน",
                                    "ตุลาคม",
                                    "พฤศจิกายน",
                                    "ธันวาคม",
                                ]
                            ],
                            'yAxis' => [
                                'title' => [
                                    'text' => 'จำนวน ( ครั้ง )'
                                ]
                            ],
                            'series' => [
                                ['name' => 'ไปราชการ', 'data' => [$num1, $num2, $num3, $num4, $num5, $num6, $num7, $num8, $num9, $num10, $num11, $num12]],
                                ['name' => 'ลากิจ ', 'data' => [$nm1, $nm2, $nm3, $nm4, $nm5, $nm6, $nm7, $nm8, $nm9, $nm10, $nm11, $nm12]],
                                ['name' => 'ลาพักผ่อน ', 'data' => [$nm31, $nm32, $nm33, $nm34, $nm35, $nm36, $nm37, $nm38, $nm39, $nm310, $nm311, $nm312]],
                                ['name' => 'ลาป่วย ', 'data' => [$nm41, $nm42, $nm43, $nm44, $nm45, $nm46, $nm47, $nm48, $nm49, $nm410, $nm411, $nm412]],
                                ['name' => 'ลาคลอด ', 'data' => [$nm51, $nm52, $nm53, $nm54, $nm55, $nm56, $nm57, $nm58, $nm59, $nm510, $nm511, $nm512]],
                            ]
                        ]
                    ]);
        ?>
        <i class="fa fa-star" aria-hidden="true"></i><b>  รายการ</b>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <b><i class="fa fa-clock-o" aria-hidden="true"></i>  ข้อมูลดึงข้อมูลการสแกนล่าสุด</b>
                <div class="alert alert-dismissible alert-info">
                  <strong>
                  <?php 
                         //=====================SQL==========================================
                        $sql1 = "SELECT last_update
                                FROM scan_values
                                LIMIT 1 ";
                            //=====================SQL==========================================

                        $rw2 = Yii::$app->db->createCommand($sql1)->queryAll();
                        //$countdeart2 = count($rw2);

                        foreach($rw2 as $r) {
                            $date = $r['last_update'];                        
                        }
                    ?>

                  </strong> <h6> ข้อมูลล่าสุด วันที่  <?= DateThai($date).' น.' ; ?> </h6>
                </div>
            </div>

            <div class="col-lg-6">
                <b> <i class="fa fa-calendar" aria-hidden="true"></i>  ลาวันนี้</b>
                <div class="alert alert-dismissible alert-success">
                  <strong>

                  <?php 
                        $date = date('Y-m-d');
                         //=====================SQL==========================================
                        $sql1 = "SELECT *
                                FROM scan_leave
                                WHERE date = '$date'; ";
                            //=====================SQL==========================================

                        $rw2 = Yii::$app->db->createCommand($sql1)->queryAll();
                        $countdeart2 = count($rw2);


                    ?>

                  </strong>   <h6> จำนวน <?= $countdeart2 ?> ราย </h6>


                </div>
            
            </div>
           
        </div>

         <div class="row">
            <div class="col-lg-6">
                <b><i class="fa fa-map-marker" aria-hidden="true"></i>  หน่วยงานที่มีการบันทึกข้อมูล</b>
                <div class="alert alert-dismissible alert-success">
                  <strong>
                  <?php 
                         //=====================SQL==========================================
                        $sql1 = "SELECT depart.deptid as deptid, depart.deptname as deptname,COUNT(deptid) as coutuser,t.time_A as time_A,t.time_B as time_B,t.time_C as time_C
                            FROM scan_department as depart
                            INNER JOIN scan_intime as t
                            ON depart.intime_id = t.intime_id
                            INNER JOIN scan_userinfo as user
                            ON depart.deptid = user.defaultdepid
                            GROUP BY depart.deptid;";
                            //=====================SQL==========================================

                        $rw2 = Yii::$app->db->createCommand($sql1)->queryAll();
                        $countscan = count($rw2);
                    ?>

                  </strong>   <h6> จำนวน  <?= $countscan.' หน่วยงาน.'; ?>  </h6>

                  <p align="right">
                    <a href="<?= Url::to('@web/scanlocation/index');?>" class="alert-link">รายงาน >></a>
                 </p>
                  
                </div>
            </div>

            <div class="col-lg-6">
                <b> <i class="fa fa-user" aria-hidden="true"></i>  จำนวนผู้สแกนลายนิ้วมือ</b>
                <div class="alert alert-dismissible alert-danger">
                  <strong>

                  <?php 
                         //=====================SQL==========================================
                        $sql1 = "SELECT *
                                FROM scan_userinfo ";
                            //=====================SQL==========================================

                        $rw2 = Yii::$app->db->createCommand($sql1)->queryAll();
                        $countdeart2 = count($rw2);


                    ?>

                  </strong>   <h6>  จำนวน <?= number_format($countdeart2 , 0 ) ?> ราย </h6>
                  <p align="right">
                    <a href="<?= Url::to('@web/userinfo/index');?>" class="alert-link">รายละเอียด >></a>
                 </p>

                </div>
            
            </div>

           
           
        </div>

        <div class="row">
            <div class="col-lg-6">
                <b><i class="fa fa-users" aria-hidden="true"></i>  หน่วยงาน (ออฟฟิศ Back office)</b>
                <div class="alert alert-dismissible alert-warning">
                  <strong>
                  <?php 
                         //=====================SQL==========================================
                        $sql2 = "SELECT depart.deptid as deptid, depart.deptname as deptname,COUNT(deptid) as coutuser,t.time_A as time_A,t.time_B as time_B,t.time_C as time_C
                            FROM scan_department as depart
                            INNER JOIN scan_intime as t
                            ON depart.intime_id = t.intime_id
                            INNER JOIN scan_userinfo as user
                            ON depart.deptid = user.defaultdepid
                            WHERE time_A != '00:00:00'
                            GROUP BY depart.deptid;";
                            //=====================SQL==========================================

                        $rw3 = Yii::$app->db->createCommand($sql2)->queryAll();
                        $countscan = count($rw3);
                    ?>

                  </strong>   <h6> จำนวน  <?= $countscan.' หน่วยงาน.'; ?>  </h6>

                  <p align="right">
                    <a href="<?= Url::to('@web/chkinout/reportform');?>" class="alert-link">รายงาน >></a>
                 </p>
                  
                </div>
            </div>

            <div class="col-lg-6">
                <b> <i class="fa fa-users" aria-hidden="true"></i>  หน่วยงาน (วอร์ด Front office)</b>
                <div class="alert alert-dismissible alert-info">
                  <strong>
                  <?php 
                         //=====================SQL==========================================
                        $sql4 = "SELECT depart.deptid as deptid, depart.deptname as deptname,COUNT(deptid) as coutuser,t.time_A as time_A,t.time_B as time_B,t.time_C as time_C
                          FROM scan_department as depart
                          INNER JOIN scan_intime as t
                          ON depart.intime_id = t.intime_id
                          INNER JOIN scan_userinfo as user
                          ON depart.deptid = user.defaultdepid
                          WHERE time_A = '00:00:00'
                          GROUP BY depart.deptid;";
                            //=====================SQL==========================================

                        $rw4 = Yii::$app->db->createCommand($sql4)->queryAll();
                        $countscan4 = count($rw4);
                    ?>

                  </strong>   <h6> จำนวน  <?= $countscan4.' หน่วยงาน.'; ?>  </h6>
                
                  <p align="right">
                    <a href="<?= Url::to('@web/chkinout/reportform');?>" class="alert-link">รายงาน >></a>
                 </p>

                </div>
            
            </div>
           
        </div>

        <div class="row">
            <div class="col-lg-6">
                <b><i class="fa fa-save" aria-hidden="true"></i>  ข้อมูลจำนวนเครื่อสแกนลายนิ้วมือ</b>
                <div class="alert alert-dismissible alert-info">
                  <strong>
                  <?php 
                         //=====================SQL==========================================
                        $sql1 = "SELECT *
                                FROM scan_values";
                            //=====================SQL==========================================

                        $rw2 = Yii::$app->db->createCommand($sql1)->queryAll();
                        $countscan = count($rw2);
                    ?>

                  </strong>   <h6>  จำนวน  <?= $countscan.' เครื่อง.'; ?> </h6>
                  <p align="right">
                    <a href="<?= Url::to('@web/scanlocation/index');?>" class="alert-link">รายละเอียด >></a>
                 </p>
                </div>
            </div>

            <div class="col-lg-6">
                <b><i class="fa fa-book" aria-hidden="true"></i>  คู่มือการใช้งาน</b>
                <div class="alert alert-dismissible alert-warning">
                  <strong>
                    <p align="left">
                      <a href="<?= Url::to('@web/doc/rehtime_user.pdf');?>" class="alert-link" target="_blank" >

                        - ดาวน์โหลด คู่มือการใช้งาน สำหรับ หน่วยงาน  >></a>
                    </p>
                    <p align="left">
                      <a href="<?= Url::to('@web/doc/rehtime_admin.pdf');?>" class="alert-link" target="_blank" >

                        - ดาวน์โหลด คู่มือการใช้งาน สำหรับ ผู้ดูแลระบบ  >></a>
                    </p>

                  </strong> 
                  
                </div>
            </div>

            
           
        </div>

       

        
    </div>
</div>
