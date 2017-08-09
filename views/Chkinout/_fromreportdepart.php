<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChkinoutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ' รายงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chkinout-index">
    <div class="panel-body">
        <div class="body-content">
            <div class="well">
                <div class="row">

                    <div class="col-lg-12">

                    <div align="left" ><b> <i class="fa fa-book"></i>  รายงาน แสกนลายนิ้วมือ</b></div>
                        <hr>

                    </div>
                </div>

                <?php 

                    $name = Yii::$app->session["fname"];
                    $fname = Yii::$app->session["lname"];

                    $sql = "SELECT de.intime_id
                        FROM scan_userinfo AS u
                        INNER JOIN scan_department as de
                            ON u.defaultdepid = de.deptid
                        WHERE `name` LIKE '%$name%' AND `name` LIKE '%$fname%';";
                        

                    $data = Yii::$app->db->createCommand($sql)->query();

                   
                    foreach ($data as $r) {
                       $intime = $r['intime_id'];             
                    
                    }
                    if($intime == '4') {
                ?>  

                <div class="row">
                    <div class="col-lg-6"> 
                        <?= Html::a('<i class="fa fa-share"></i>   รายบุคคล', ['chkinout/create_frontdepart']) ?>

                    </div>
                    <div class="col-lg-6"> 
                        <?= Html::a('<i class="fa fa-share"></i>   รายแผนก', ['chkinout/createdart_frontdepart']) ?>

                    </div>

                </div>


                    

                <?php } else { ?>

                <div class="row">
                        <div class="col-lg-6"> 
                            <?= Html::a('<i class="fa fa-share"></i>   รายบุคคล', ['chkinout/createdepart']) ?>

                        </div>
                        <div class="col-lg-6"> 
                            <?= Html::a('<i class="fa fa-share"></i>   รายแผนก', ['chkinout/createdartdepart']) ?>

                        </div>

                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

    
</div>
