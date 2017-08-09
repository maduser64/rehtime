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
                    'action' => ['index'],
                    'method' => 'get',
        ]);
        ?>

        <div class="col-lg-5">
            <?php

            //join ข้อมูล 2 ตาราง
            $data = \app\models\Userinfo::find()
                        ->innerJoinWith('depart','depart.deptid,defaultdepid')
                        ->all();

            //สร้าง Array 2 มิติ 
            $arr = ArrayHelper::map( $data , 'badgenumber' , 'name' , 'depart.deptname' );


            // Normal select with ActiveForm & model
            echo $form->field($model, 'userid')->widget(Select2::classname(), [
                'data' => $arr,
                'size' => Select2::MEDIUM,
                'language' => 'th',
                'options' => ['placeholder' => 'กรุณาเลือก ชื่อ สกุล ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);
            
            ?>

        </div>
        
        <div class="col-lg-5">
            <?php echo
                $form->field($model, 'checktime')->widget(
                    DatePicker::className(), [
                'options' => ['placeholder' => 'เลือกวันที่...'],
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


        <div class="col-lg-2">
            <?= Html::submitButton('<i class="fa fa-search"></i>  ค้นหา', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>

