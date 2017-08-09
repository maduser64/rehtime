<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ChkinoutSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="userinfo-search">
    <div class="row">
        <?php
        $form = ActiveForm::begin([
                    'action' => ['indexdepart'],
                    'method' => 'get',
        ]);
        ?>


        <div class="col-lg-8">
            <?php 
                $name = Yii::$app->session["fname"];
                $fname = Yii::$app->session["lname"];

                $sql = "SELECT badgenumber,`name`,defaultdepid
                        FROM scan_userinfo
                        WHERE `name` LIKE '%$name%' AND `name` LIKE '%$fname%';";
                    

                $dataReader = Yii::$app->db->createCommand($sql)->query();

                foreach ($dataReader as $r) {
                    Yii::$app->session["defaultdepid"] = $r['defaultdepid'];
                    $user = $r['badgenumber'];


                }

                $scandepart_id = Yii::$app->session["defaultdepid"];
            ?>

            <?php

                $sql1 = "SELECT depart_id
                        FROM scan_service AS s
                        INNER JOIN scan_userinfo AS u ON s.user_id = u.badgenumber
                        WHERE s.user_id = '$user'; ";

                $data1 = Yii::$app->db->createCommand($sql1)->query();

                $coutdepart = count($data1);

                    
            $i = 0;
            $a = array();
            $depart = "";
            $depart1 = "";

            if($coutdepart > 1){
                foreach ($data1 as $r) {
                    $a[$i] = $r['depart_id'];
                    $i++;
                }

                $data = \app\models\Userinfo::find()
                        ->innerJoinWith('depart','depart.deptid,defaultdepid')
                        ->where(['defaultdepid' => $a])
                        ->all();
  
            }else{
                
                $data = \app\models\Userinfo::find()
                        ->innerJoinWith('depart','depart.deptid,defaultdepid')
                        ->where(['defaultdepid' => $scandepart_id])
                        ->all();

            }

            //สร้าง Array 2 มิติ 
            $result1 = ArrayHelper::map( $data , 'badgenumber' , 'name' , 'depart.deptname' );
           


            // echo '<pre>';
            // print_r($result1);
            // echo '</pre>';

            // Normal select with ActiveForm & model
            echo $form->field($model, 'userid')->widget(Select2::classname(), [
                'data' => $result1,
                'size' => Select2::MEDIUM,
                'language' => 'th',
                'options' => ['placeholder' => 'กรุณาเลือก ชื่อ สกุล ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);

            ?>


        </div>
        
        <!-- <div class="col-lg-5"> -->
            <?php 
                // echo $form->field($model, 'checktime')->widget(
                //     DatePicker::className(), [
                // 'options' => ['placeholder' => 'เลือกวันที่...'],
                // 'language' => 'th',
                // 'clientOptions' => [
                //     'todayHighlight' => true,
                //     'autoclose' => true,
                //     'format' => 'yyyy-mm-dd',
                //     //'format' => 'dd/mm/yyyy',
                // ]
                // ])->label(false);
            ?>

        <!-- </div> -->


        <div class="col-lg-4">
            <?= Html::submitButton('<i class="fa fa-search"></i>  ค้นหา', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>

