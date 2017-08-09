<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Holiday */
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
             <?=
            $form->field($model, 'PublicHoliday')->widget(
                    DatePicker::className(), [
                'options' => ['placeholder' => 'เลือกวันที่...'],
                'language' => 'th',
                'clientOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    //'format' => 'dd/mm/yyyy',
                ]
            ]);
            ?>

        </div>
        
    </div> 

    <div class="row">
        <div class="col-lg-10"> 
            <?= $form->field($model, 'Descripiton')->textInput(['maxlength' => true]) ?>
        </div>
    </div> 

    <div class="row">
        <div class="col-lg-12"> 
            <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i>  บันทึก' : '<i class="fa fa-save"></i>  ปรับปรุง', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
        <?php ActiveForm::end(); ?>    
