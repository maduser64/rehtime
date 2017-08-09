<?php
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */

$this->title = 'ระบบบริการผ้า (Washing)';
?>
<meta http-equiv="refresh" content="10">
<div class="panel-body">

    <div class="body-content">
        <i class="fa fa-star" aria-hidden="true"></i><b>  รายการ</b>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <b>บุคลากรทั้งหน่วยงาน</b>
                <div class="alert alert-dismissible alert-danger">
                  <strong>
                    
                    <?php 
                        $deptid = Yii::$app->session["defaultdepid"];
                        
                         //=====================SQL==========================================
                        $sql = "SELECT * FROM scan_userinfo u
                        LEFT JOIN scan_department d ON u.defaultdepid=d.deptid
                        LEFT JOIN scan_intime i ON d.intime_id=i.intime_id
                        where u.defaultdepid= '$deptid';";
                            //=====================SQL==========================================

                        $rw1 = Yii::$app->db->createCommand($sql)->queryAll();
                        $countdeart = count($rw1);


                    ?>

                  </strong>    จำนวน <?= $countdeart ?> ราย
                  <p align="right">

                    <a href="<?= Url::to(['/userinfo/indexdepart','id' => $deptid ]);?>" class="alert-link">ตรวจสอบรายชื่อ  >></a>
                  </p>

                </div>
            </div>
            <div class="col-lg-6">
                <b>ลาวันนี้</b>
                <div class="alert alert-dismissible alert-success">
                  <strong>

                  <?php 
                        $date = date('Y-m-d');
                         //=====================SQL==========================================
                        $sql1 = "SELECT *
                                FROM scan_leave
                                WHERE depart = '$deptid'
                                AND date = '$date'; ";
                            //=====================SQL==========================================

                        $rw2 = Yii::$app->db->createCommand($sql1)->queryAll();
                        $countdeart2 = count($rw2);


                    ?>

                  </strong>   จำนวน <?= $countdeart2 ?> ราย

                  <p align="right">
                    <?PHP $date = date('Y-m-d'); ?>

                    <a href="<?= Url::to(['/leave/indexdepartdate', 'date' => $date]);?>" class="alert-link">ตรวจสอบรการลา  >></a>
                  </p>


                </div>
            
            </div>
           
        </div>

        <div class="row">
           <div class="col-lg-6">
                <b><i class="fa fa-book" aria-hidden="true"></i>  คู่มือการใช้งาน</b>
                <div class="alert alert-dismissible alert-warning">
                  <strong>
                    <p align="left">
                      <a href="<?= Url::to('@web/doc/rehtime_user.pdf');?>" class="alert-link" target="_blank" >

                        - ดาวน์โหลด คู่มือการใช้งาน สำหรับ หน่วยงาน  >></a>
                    </p>
                  </strong> 
                  
                </div>
            </div>
            <div class="col-lg-6">
                <b><i class="fa fa-file-text" aria-hidden="true"></i>  เอกสาร</b>
                <div class="alert alert-dismissible alert-info">
                  <strong>
                    <p align="left">
                      <a href="<?= Url::to('@web/doc/leave_out.pdf');?>" class="alert-link" target="_blank" >

                        - แบบใบขอยกเลิกวันลา >></a>
                    </p>
                  </strong> 
                  
                </div>
            </div>
           
        </div>
        
    </div>
</div>
