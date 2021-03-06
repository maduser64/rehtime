<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Scanlocation */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="row">
        <?php if (Yii::$app->session->hasFlash('alert')): ?>
                <?=
                \yii\bootstrap\Alert::widget([
                    'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                    'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),

                ])
                ?>
        <?php endif; ?>
</div>


    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6"> 
                <?php //echo $form->field($model, 'scan_ip')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'scan_ip')->widget(\yii\widgets\MaskedInput::className(), [
                    'clientOptions' => [
                            'alias' =>  'ip'
                    ]
                ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6"> 
            <?= $form->field($model, 'scan_location')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

     <div class="row">
        <div class="col-lg-6"> 
             <?= $form->field($model, 'status_id')->dropDownList(['1' => 'เปิดใช้งาน', '0' => 'ยกเลิกใช้']); ?>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-12"> 
            <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i>  บันทึก' : '<i class="fa fa-save"></i>  ปรับปรุง', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        
        </div>
    </div>


    <?php ActiveForm::end(); ?>


