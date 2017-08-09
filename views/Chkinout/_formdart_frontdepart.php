<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;
//use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Chkinout */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chkinout-form">

    <?php $form = ActiveForm::begin([
                'action' => Url::to(['reportdartfront']),
                'method' => 'get',
                'options' => [
                    'target' => '_blank',
                ]
    ]); ?>
    <div class="row">
        <div class="col-md-10">
        
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

            ?>


            <?php

            if($coutdepart > 1){
                foreach ($data1 as $r) {
                    $a[$i] = $r['depart_id'];
                    $i++;
            }

            $data = \app\models\Department::find()->where(['deptid' => $a])->all();
            }else{
            $data = \app\models\Department::find()->where(['deptid' => Yii::$app->session["defaultdepid"]])->all();
            }

            

            $arr = ArrayHelper::map($data, 'deptid', 'deptname');

            // Normal select with ActiveForm & model
            echo $form->field($model, 'userid')->widget(Select2::classname(), [
                'data' => $arr,
                //'value' => Yii::$app->session["defaultdepid"],
                //'disabled' => true,
                'size' => Select2::MEDIUM,
                //'options' => ['placeholder' => 'กรุณาเลือก หน่วยงาน ...'],
                'language' => 'th',
                'pluginOptions' => [
                    'allowClear' => true
                ],
                //'disabled' => true,
            ])->label(false);
            ?>

        </div>
    </div>

    <div class="row">


        <div class="col-md-5">

            <?=
            $form->field($model, 'date_strat')->widget(
                    DatePicker::className(), [
                'options' => ['placeholder' => 'เลือกวันที่เริ่มต้น...'],
                'language' => 'th',
                'clientOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    //'format' => 'dd/mm/yyyy',
                ]
            ])->label(false);
            ?>


        </div>

        <div class="col-md-5">



            <?=
            $form->field($model, 'date_end')->widget(
                    DatePicker::className(), [
                'options' => ['placeholder' => 'เลือกวันที่สิ้นสุด...'],
                'language' => 'th',
                'clientOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    //'format' => 'dd/mm/yyyy',
                ]
            ])->label(false);
            ?>
        </div>

    </div>
    <hr>
    <div class="row">
        <div class="col-md-10" align="right">
<?= Html::submitButton('<i class="fa fa-print"></i>  ปริ้นรายงาน', ['class' => 'btn btn-success']) ?>
        </div>

    </div>

<?php ActiveForm::end(); ?>
</div>
